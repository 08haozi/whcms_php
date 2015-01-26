<?php

namespace Admin\Model;

use Think\Model;
/**
 * 图文-图片详情
 * @author Administrator
 *
 */
class ArticleAlbumItemsModel extends Model {
    protected $tableName = 'cms_article_album_items';
    
    /**
     * 获取封面图片
     * @param unknown $articleID
     */
    function getTitle($articleID){
        $where['articleID']=$articleID;
        $where['isTitle']=1;
        return $this->where($where)->order('sortID asc')->find();
    }
}
