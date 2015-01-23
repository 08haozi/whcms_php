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
                $index=1;
                foreach ($itemsArray as $value){
                    $array=explode('#',$value);
                    $itemData['articleID']=$result;
                    $itemData['picUrl']=$array[0];
                    $itemData['picUrlS']=$array[1];
                    $itemData['picUrlSS']=$array[2];
                    $itemData['isTitle']=$array[3];
                    $itemData['sortID']=1;
                    if(!$itemsModel->add($itemData)){
                        $this->rollback();
                        return '添加图片明细失败！';
                    }
                    $index++;
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
}
