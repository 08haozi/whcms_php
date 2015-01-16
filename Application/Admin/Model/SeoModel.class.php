<?php

namespace Admin\Model;

use Think\Model;
/**
 * 页面SEO信息
 * @author Administrator
 *
 */
class SeoModel extends Model {
    protected $tableName = 'cms_seo';
    
    /*
     *首页：index
     *文章页：article 
     */
    
    function getM($callIndex,$sitesName,$articleTitle){
        $where['callIndex']=$callIndex;
        $model=$this->where($where)->find();
        if($model){
            if($sitesName){
                $model['title']=str_replace('{sitesName}', $sitesName, $model['title']);
                $model['keywords']=str_replace('{sitesName}', $sitesName, $model['keywords']);
                $model['description']=str_replace('{sitesName}', $sitesName, $model['description']);
            }
            if($articleTitle){
                $model['title']=str_replace('{articleTitle}', $articleTitle, $model['title']);
                $model['keywords']=str_replace('{articleTitle}', $articleTitle, $model['keywords']);
                $model['description']=str_replace('{articleTitle}', $articleTitle, $model['description']);
            }
            return $model;
        }
        return null;
    }
}
