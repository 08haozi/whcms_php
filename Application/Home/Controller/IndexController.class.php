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
    
    function look(){
        $id=I('get.id');
        if(empty($id)){
            return;
        }
        
        $model=D('Admin/Article');
        $where['isDel']=0;
        $where['id']=$id;
        
        $result=$model->where($where)//文章信息
                       ->find();
        if(false===$result){
            return;
        }
        
        $where2['isDel']=0;
        $where2['id']=array('neq',$id);
        $where2['categoryID']=$result['categoryID'];
        $list = $model->where($where2)
                      ->page(1, 5)
                      ->order('sortID asc,createTime desc')
                      ->select();

        $categoryModel=D('Admin/ArticleCategory');

        $categoryTitle=$categoryModel->getTitle($result['categoryID']);
        
        $categoryArray = $categoryModel->getList(0);
        
        $this->assign('result', $result)
             ->assign('list', $list)
             ->assign('categoryTitle', $categoryTitle)
             ->assign('categoryArray', $categoryArray)
             ->assign('categoryID',-1);
             
        $this->display('look');
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