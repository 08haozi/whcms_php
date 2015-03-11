<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 网站首页
 * @author Administrator
 *
 */
class IndexController extends Controller {
    function index(){
        $this->_search();
    }
    
    function s(){
        $this->_search();
    }
    
    /**
     * 搜索
     */
    function _search(){
        $model=D('Admin/Article');
        $where['isDel']=0;
        $categoryID=I('get.categoryID');
        if(!empty($categoryID)){
            $where['categoryID']=$categoryID;
        }
        else{
            $categoryID=0;
        }
        
        $result = $model->where($where)
                        ->order('sortID asc,createTime desc')
                        ->select();
        
        $count = $model->where($where)->count();
        
        $categoryModel=D('Admin/ArticleCategory');
        $categoryList = $categoryModel->getArray(1);
        $categoryArray = $categoryModel->getList(0,1);
        
        //网站信息
        $sites=json_decode(D('Admin/KeyValue')->getValue('sitesInfo'),true);
        
        //SEO信息
        $seo=D('Admin/Seo')->getM('index',$sites['title']);
        
        $this->assign('categoryID', $categoryID)
             ->assign('count', $count)
             ->assign('result', $result)
             ->assign('categoryList', $categoryList)
             ->assign('categoryArray', $categoryArray)
             ->assign('sites',$sites)
             ->assign('seo',$seo);
        
        $this->display('index');
    }
}