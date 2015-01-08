<?php

namespace Admin\Controller;

use Think\Controller;

/**
 * 登陆
 */
class LoginController extends Controller {

    /**
     * 初始化
     */
    function _initialize() {
        
    }

    /**
     * 登陆页面
     */
    public function index() {
        $this->display();
    }

    /**
     * 登陆
     */
    public function doLogin() {
        //验证用户名
        $username = I('post.username');
        if (empty($username)) {
            $this->error('账号不能为空！');
        }
        //验证密码
        $password = I('post.password');
        if (empty($password)) {
            $this->error('密码不能为空！');
        }

        //根据用户名、密码查询用户
        $managerD = D('Manager')->loginCheck($username, $password);
        if ($managerD != null) {
            //登入成功页面跳转
            $_SESSION["ManagerID"] = $managerD['id'];
            $_SESSION['ManagerName'] = $managerD['username'];
            $_SESSION['ManagerRoleId'] = $managerD['roleId'];

            $this->success('登陆成功，自动跳转！', '/admin/index', 0);
        } else {
            $this->error('账号或密码错误！');
        }
    }

    /**
     * 注销
     */
    function doLoginOut() {
        session('ManagerID', null);
        redirect('/admin/login');
    }

}
