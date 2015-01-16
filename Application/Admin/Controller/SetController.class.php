<?php
namespace Admin\Controller;

use Think\Controller;

/**
 * 设置
 */
class SetController extends AdminBaseController
{
    /**
     * 初始化
     */
    function _initialize()
    {
        parent::_initialize();
    }
    
    /**
     * 网站信息
     */
    function sites(){
        if(IS_POST){
            $array=array(
                'title'=>I('post.title'),
                'no'=>I('post.no'),
                'count'=>html_entity_decode(stripslashes(I('post.count'))),
                'copyright'=>I('post.copyright'),
                'phone'=>I('post.phone'),
                'qq'=>I('post.qq'),
                'email'=>I('post.email'),
                'address'=>I('post.address')
            );
            $jsonStr=json_encode($array);
            
            $result=D('KeyValue')->saveM('sitesInfo',$jsonStr);
            if(false===$result){
                $this->error('修改网站信息失败!');
            }
            return $this->success('修改网站信息成功！');
        }
        else{
            $result=D('KeyValue')->getValue('sitesInfo');
            $sites=json_decode($result,true);
            $this->assign('sites',$sites);
            $this->display('sites');
        }
    }
    
    /**
     * 修改密码
     */
    function chgPassword(){
        if(IS_POST){
            $password1=I('post.password1');
            $password2=I('post.password2');
            
            if(empty($password1)){
                $this->error('请输入密码！');
            }
            if($password1!=$password2){
                $this->error('两次密码输入不要一致！');
            }
            
            $where['id']=$_SESSION["ManagerID"];
            $result=D('Manager')->where($where)->setField('password',md5($password1));
            
            if(false===$result){
                $this->error('密码修改失败！');
            }
            
            $this->success('密码修改成功！');
        }
        else{
            $this->display('password');
        }
    }
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}