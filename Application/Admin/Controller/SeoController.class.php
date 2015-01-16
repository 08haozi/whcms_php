<?php
namespace Admin\Controller;

use Think\Controller;

/**
 * 页面SEO
 */
class SeoController extends AdminBaseController
{
    protected $model;
    
    /**
     * 初始化
     */
    function _initialize()
    {
        parent::_initialize();
        $this->model = D('Seo');
    }
    
    /**
     * 列表
     */
    function lists()
    {
        $result = $this->model
                       ->where('1=1')
                       ->select();
    
        $count = count($result);
    
        $this->assign('result', $result)
             ->assign('count', $count);
    
        $this->display('lists');
    }
    
    
    /**
     * 修改
     */
    function edit(){
        //判断修改对象是否存在
        $result=$this->model->find(I('get.id'));
        if (!$result){
            $this->error('页面SEO不存在！',$SERVER['HTTP_REFERER']);
        }
    
        if(IS_POST){
            $data['title']=I('post.title');
            $data['keywords']=I('post.keywords');
            $data['description']=I('post.description');

            if(false===$this->model->where('id='.$result['id'])->save($data)){
                $this->error('修改失败！',$SERVER['HTTP_REFERER']);
            }
            
            $this->success('修改成功！',$SERVER['HTTP_REFERER']);
        }
        else{
            $this->assign('result',$result);
            $this->display('edit');
        }
    }
}