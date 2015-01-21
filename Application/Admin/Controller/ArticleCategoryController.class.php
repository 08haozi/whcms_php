<?php
namespace Admin\Controller;

use Think\Controller;

/**
 * 文章类别
 */
class ArticleCategoryController extends AdminBaseController
{

    protected $model;
    private  $type;
    private  $typeName;

    /**
     * 初始化
     */
    function _initialize()
    {
        parent::_initialize();
        $this->model = D('ArticleCategory');
        $this->type=I('get.type');
        $this->typeName=($this->type==1)?'文章':'图文';
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
                       ->GetList(0,$this->type);
        
        $count = count($result);
        
        $this->assign('result', $result)
             ->assign('count', $count)
             ->assign('type',$this->type)
             ->assign('typeName',$this->typeName);
        
        $this->display('lists');
    }
    
    
    /**
     * 新建
     */
    function add(){
        if(IS_POST){
            $data['parentID']=I('post.parentID');
            $data['title']=I('post.title');
            $data['sortID']=I('post.sortID');
            $data['type']=$this->type;
            
            if(!$this->model->addM($data)){
                $this->error('操作失败！');
            }
            $this->success('新建成功！');
        }
        else{
            $this->assign('type',$this->type)
                 ->assign('typeName',$this->typeName)
                 ->display('add');
        }
    }
    
    /**
     * 修改
     */
    function edit(){
        //判断修改对象是否存在
        $result=$this->model->find(I('get.id'));
        if (!$result){
            $this->error('分类不存在！',$SERVER['HTTP_REFERER']);
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
        $idArray=array_filter(explode(',', I('post.ids')));
        foreach ($idArray as $id){
            $this->model->deleteM($id);
        }

        $this->success('删除成功，页面自动刷新！');
    }
    
}
