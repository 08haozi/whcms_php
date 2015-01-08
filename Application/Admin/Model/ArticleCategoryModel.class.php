<?php

namespace Admin\Model;

use Think\Model;
/**
 * 文章分类Model
 * @author Administrator
 *
 */
class ArticleCategoryModel extends Model {
    protected $tableName = 'article_category'; 
    
    /**
     * 获取分类列表
     * @param int $parentID 上级ID
     * @return array 分类列表
     */
    function getList($parentID) {
        $list=array();
        $this->_getList($list, $parentID);
        return $list;
    }
    
    /**
     * 获取分类列表
     * @param array $list 分类列表
     * @param int $parentID 上级ID
     * @return array 分类列表
     */
    private function _getList(&$list,$parentID) {
        $where['parentID']=$parentID;
        $result=$this->where($where)
                     ->order('sortID asc')
                     ->select();
        if($result){
            for($i=0;$i<count($result);$i++) {
                $result[$i]['classLayer']=$this->getPrefix($result[$i]['classLayer']);
                array_push($list, $result[$i]);
                $this->_getList($list, $result[$i]['id']);
            }
        }
    }
    
    /**
     * 获取分类下拉框代码
     * @param int $selectedValue 选中值
     * @return string 分类下拉框代码
     */
    function getSelectHtml($selectedValue) {
        $selectHtml=($selectedValue==null)?
            '<option value="0" selected="selected">根目录</option>':'<option value="0">根目录</option>';
        $this->_getSelectHtml($selectHtml, $selectedValue,0);
        return '<select class="form-control" name="parentID">'.$selectHtml.'</select>';
    }
    
    /**
     * 获取分类下拉框代码
     * @param string $selectHtml 分类下拉框代码
     * @param int $selectedValue 选中值
     * @param int $parentID 上级ID
     */
    function _getSelectHtml(&$selectHtml,$selectedValue,$parentID){
        $where['parentID']=$parentID;
        $result=$this->where($where)
                     ->order('sortID asc')
                     ->select();
        if($result){
            for($i=0;$i<count($result);$i++) {
                $selectHtml.='<option value="'.$result[$i]['id'].'" '.($selectedValue==$result[$i]['id']?'selected="selected"':'').'>'.
                             $this->getPrefix($result[$i]['classLayer']).$result[$i]['title']
                             .'</option>';
                $this->_getSelectHtml($selectHtml, $selectedValue,$result[$i]['id']);
            }
        }
    }
    
    /**
     * 获取前缀
     * @param int $classLayer 类别层数
     * @return string
     */
    private function getPrefix($classLayer){ 
        $prefix='|-';
        if($classLayer>0){    
            for($i=0;$i<$classLayer;$i++){
                $prefix='　　'.$prefix;
            }
        }
        return $prefix;
    }
    
    /**
     * 新建
     * @param array $data 输入数据
     * @return boolean 操作成功返回true，失败返回错误信息
     */
    function addM($data){
        //启动事务
        $this->startTrans();
        //1：新建分类 获取分类ID
        if($data['parentID']=='0'){
            $data['classLayer']=0;
        }
        else{
            $where1['id']=$data['parentID'];
            $parentData = $this->where($where1)->find();
            $data['classLayer']=$parentData['classLayer']+1;
        }
          
        $result =$this->add($data);
        if(!$result){
            $this->rollback();
            return '新建失败！';
        }
        //2：更新分类的classList
        if(!$this->where('id='.$result)->setField('classList',','.$result.',')){
            $this->rollback();
            return '更新分类的classList失败！';
        }
        
        //3：更新所有上级的classList
        while($parentData){
            $where2['id']=$parentData['id'];
            if(!$this->where($where2)->setField('classList',$parentData['classList'].$result.',')){
                $this->rollback();
                return '更新上级的classList失败！';
            }
            $where3['id']=$parentData['parentID'];
            $parentData = $this->where($where3)->find();
        }
        
        // 提交事务
        $this->commit();
        return true;
    }
    
    function editM($result,$data){
        if($data['parentID']==$result['parentID']){
            if($this->where('id='.$result['id'])->save($data)===false){
                return '修改失败！';
            }
        }
        else{
            $this->startTrans();
            
            $classLayer=$data['classLayer'];//保留原classLayer 用于更新子类
            
            //1：更新该分类
            if($data['parentID']=='0'){
                $data['classLayer']=0;
            }
            else{
                $where1['id']=$data['parentID'];
                $parentData = $this->where($where1)->find();
                $data['classLayer']=$parentData['classLayer']+1;
            }
            if($this->where('id='.$id)->save($data)===false){
                $this->rollback();
                return '修改失败！';
            }
            
            //2：更新所有父类的classList
            $classListArray=explode(',', $data['classList']);
            while($parentData){
                $where2['id']=$parentData['id'];
                if(!$this->where($where2)->setField('classList',$this->_getUpdateClassList($parentData['classList'], $classListArray))){
                    $this->rollback();
                    return '更新所有父类的classList失败！';
                }
                $where3['id']=$parentData['parentID'];
                $parentData = $this->where($where3)->find();
            }
            
            //3：更新所有子类的classLayer
            foreach ($classListArray as $value){
                if($value!=$id){
                    $where4['id']=$value;
                    $childData = $this->where($where4)->find();
                    if($childData){
                        if(!$this->where($where4)->setField('classLayer',$data['classLayer']-$classLayer+$childData['classLayer'])){
                            $this->rollback();
                            return '更新所有子类的classLayer失败！';
                        }
                    }
                }
            }
            
            $this->commit();
        }
        
        return true;
    }
    
    /**
     * 获取更新后父类的classList
     * @param string $parentClassList 父类原classList
     * @param array $classList 子类的classList转换成array
     * @return string 更新后父类的classList
     */
    function _getUpdateClassList($parentClassList,$classListArray){
        foreach ($classList as $value){
            str_replace($value.',', '', $parentClassList);
        }
        return $parentClassList;
    }

}


