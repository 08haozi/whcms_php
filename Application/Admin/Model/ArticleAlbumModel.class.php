<?php

namespace Admin\Model;

use Think\Model;
/**
 * 图文
 * @author Administrator
 *
 */
class ArticleAlbumModel extends Model {
    protected $tableName = 'cms_article_album';
    
    /**
     * 新建图文
     * @param unknown $data 图文数据
     * @param unknown $itemsArray 图片明细项列表
     * @return string|boolean 成功返回true，失败返回错误信息
     */
    function addM($data,$itemsArray){
        $this->startTrans();
        
        $result=$this->add($data);//新建图文
        if($result){
            if(count($itemsArray)>0){
                $itemsModel=D('ArticleAlbumItems');
                //添加图片详细
                foreach ($itemsArray as $index=>$value){
                    $array=explode('#',$value);
                    $itemData['articleID']=$result;
                    $itemData['picUrl']=$array[0];
                    $itemData['picUrlS']=$array[1];
                    $itemData['picUrlSS']=$array[2];
                    $itemData['isTitle']=$array[3];
                    $itemData['sortID']=$index;
                    if(!$itemsModel->add($itemData)){
                        $this->rollback();
                        return '添加图片明细失败！';
                    }
                }
            }
        }
        else{
            $this->rollback();
            return '新建图文失败！';
        }
        $this->commit();
        return true;
    }
    
    /**
     * 修改图文
     * @param unknown $data 图文数据
     * @param unknown $itemsArray 图片明细项列表
     * @return string|boolean 成功返回true，失败返回错误信息
     */
    function editM($id,$data,$itemsArray){
        $this->startTrans();
        
        $where['id']=$id;
        $result=$this->where($where)->save($data);
        if(false!==$result){
            if(count($itemsArray)>0){
                $itemsModel=D('ArticleAlbumItems');
                //删除旧的图片详情
                $where2['articleID']=$id;
                $result2=$itemsModel->where($where2)->delete();
                if(false!==$result2){
                    //添加图片详细
                    foreach ($itemsArray as $index=>$value){
                        $array=explode('#',$value);
                        $itemData['articleID']=$id;
                        $itemData['picUrl']=$array[0];
                        $itemData['picUrlS']=$array[1];
                        $itemData['picUrlSS']=$array[2];
                        $itemData['isTitle']=$array[3];
                        $itemData['sortID']=$index;
                        if(!$itemsModel->add($itemData)){
                            $this->rollback();
                            return '添加图片明细失败！';
                        }
                    }
                }
                else{
                    $this->rollback();
                    return '删除旧的图片详情失败！';
                }
            }
        }
        else{
            $this->rollback();
            return '修改图文失败！';
        }
        $this->commit();
        return true;
    }
}
