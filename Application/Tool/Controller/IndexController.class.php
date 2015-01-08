<?php

namespace Tool\Controller;

use Think\Controller;

class IndexController extends Controller {

    /**
     * 验证码
     */
    public function verify() {
        $Verify =     new \Think\Verify();
        $Verify->fontSize = 20;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->entry();
    }

}
