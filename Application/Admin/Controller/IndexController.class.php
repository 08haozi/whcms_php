<?php
namespace Admin\Controller;

use Think\Controller;

/**
 * 首页
 */
class IndexController extends AdminBaseController{
    function index()
    {
        $articleM=D('Article');
        $countArticle=$articleM->where('isDel=0')->count();//文章总数
        $countRecycle=$articleM->where('isDel=1')->count();//回收站总数
        
        $this->assign('countArticle',$countArticle)
             ->assign('countRecycle',$countRecycle)
             ->display();
    }
}