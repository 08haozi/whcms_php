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
        
        $categoryArray = D('Admin/ArticleCategory')->getList(0);
        
        $this->assign('categoryID', $categoryID)
             ->assign('count', $count)
             ->assign('result', $result)
             ->assign('categoryArray', $categoryArray);
        
        $this->display('index');
    }
}