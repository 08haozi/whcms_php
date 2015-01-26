<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 文章详情页
 * @author Administrator
 *
 */
class LookController extends Controller {
    function index(){
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
        
        $categoryArray = $categoryModel->getList(0,$categoryModel::TypeArticle);
        
        //网站信息
        $sites=json_decode(D('Admin/KeyValue')->getValue('sitesInfo'),true);
        
        //SEO信息
        $seo=D('Admin/Seo')->getM('article',$sites['title'],$result['title']);
        
        $this->assign('result', $result)
             ->assign('list', $list)
             ->assign('categoryTitle', $categoryTitle)
             ->assign('categoryArray', $categoryArray)
             ->assign('categoryID',-1)
             ->assign('sites',$sites)
             ->assign('seo',$seo);
             
        $this->display('look');
    }
    
}