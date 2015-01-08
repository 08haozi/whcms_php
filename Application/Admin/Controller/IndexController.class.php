<?php
namespace Admin\Controller;

use Think\Controller;

/**
 * 首页
 */
class IndexController extends AdminBaseController{
    function index()
    {
        $this->display();
    }
}