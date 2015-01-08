<?php

namespace Admin\Controller;

use Think\Controller;

/**
 * 后台权限基类
 */
class AdminBaseController extends Controller {
    
    /**
     * 初始化
     */
    function _initialize() {
        //判断是否已经登陆
        if (!isset($_SESSION["ManagerID"])) {
            $this->error('请先登录！','/admin/login');
        }
        
    }

}
