<?php
namespace Admin\Controller;

use Think\Controller;

/**
 * 文章类别
 */
class ArticleCategoryController extends AdminBaseController
{

    protected $model;

    /**
     * 初始化
     */
    function _initialize()
    {
        parent::_initialize();
        $this->model = D('ArticleCategory');
    }

    /**
     * 默认显示列表
     */
    function index()
    {
        $this->lists();
    }

    /**
     * 列表
     */
    function lists()
    {
        $result = $this->model
                       ->GetList(0);
        
        $count = count($result);
        
        $this->assign('result', $result)
             ->assign('count', $count);
        
        $this->display('lists');
    }
    
    
    /**
     * 回收站
     */
    function recycle(){
        $where['id']=array('in',I('post.ids'));
        
        $data['isDel']=1;
        
        $this->model
            ->where($where)
            ->save($data);
        $this->success('移至回收站成功，页面自动刷新！');
    }
    
    /**
     * 新建
     */
    function add(){
        if(IS_POST){
            $data['parentID']=I('post.parentID');
            $data['title']=I('post.title');
            $data['sortID']=I('post.sortID');
            
            if(!$this->model->addM($data)){
                $this->error('操作失败！');
            }
            $this->success('新建成功！');
        }
        else{
            $this->display('add');
        }
    }
    
    /**
     * 修改
     */
    function edit(){
        //判断修改对象是否存在
        $result=$this->model->find(I('get.id'));
        if (!$result){
            $this->error('文章分类不存在！',$SERVER['HTTP_REFERER']);
        } 
        
        if(IS_POST){   
            $data['parentID']=I('post.parentID');
            $data['title']=I('post.title');
            $data['sortID']=I('post.sortID');
            
            $msg=$this->model->editM($result,$data);
            if($msg===true){
                $this->success('修改成功！',$SERVER['HTTP_REFERER']);
            }
            else{
                $this->error($msg,$SERVER['HTTP_REFERER']);
            }
            
//             $this->model->create();

//             if($this->model->where('id='.$result['id'])->save()===false){
//                 $this->error('操作失败！',$SERVER['HTTP_REFERER']);
//             }
//             $this->success('修改成功！',$SERVER['HTTP_REFERER']);
        }
        else{
            $this->assign('result',$result);
            $this->display('edit');
        }
    }
    
    /**
     * 删除
     */
    function delete(){
        
    }
    
}
