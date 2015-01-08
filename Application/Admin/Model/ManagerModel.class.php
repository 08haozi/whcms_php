<?php

namespace Admin\Model;

use Think\Model;

class ManagerModel extends Model {
    protected $tableName = 'manager';
    
    /**
     * 登陆验证
     * 失败返回null 成功返回用户data
     */
    function loginCheck($username, $password) {
        $password = md5($password);
        $result = $this->where("username='%s' and password='%s'", $username, $password)->find();
        if ($result == null) {
            return null;
        } else {
            return $result;
        }
    }

}
