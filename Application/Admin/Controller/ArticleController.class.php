<?php
namespace Admin\Controller;

use Think\Controller;

/**
 * 文章
 */
class ArticleController extends AdminBaseController
{

    protected $model;

    /**
     * 初始化
     */
    function _initialize()
    {
        parent::_initialize();
        $this->model = D('Article');
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
        $this->_search();
    }
    
    /**
     * 搜索
     */
    function search()
    {
        $this->_search();
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
            $this->model->create();
            $this->model->creatorID=$_SESSION["ManagerID"];
            $this->model->auditorID=$_SESSION["ManagerID"];
            $this->model->isDel=0;
            
            $result =$this->model->add(); 
            if($result){        
                $this->success('新建成功！');   
            }
            $this->error('操作失败！');
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
            $this->error('文章不存在！',$SERVER['HTTP_REFERER']);
        } 
        
        if(IS_POST){          
            $this->model->create();

            if($this->model->where('id='.$result['id'])->save()===false){
                $this->error('操作失败！',$SERVER['HTTP_REFERER']);
            }
            $this->success('修改成功！',$SERVER['HTTP_REFERER']);
        }
        else{
            $this->assign('result',$result);
            $this->display('edit');
        }
    }

    /**
     * 搜索
     */
    private function _search()
    {
        $pageLink='/Admin/Article/lists';
        
        $where['isDel']=0;
        
        $categoryID=I('get.categoryID');    //分类ID
        $begin=I('get.beginTime');   //开始时间
        $end=I('get.endTime');       //结束时间
        $title=I('get.title');   //标题
        if(!empty($categoryID)&&$categoryID!=='0'){
            $where['categoryID']=$categoryID;
            $pageLink.='/categoryID/'.$categoryID;
        }
        if(!empty($begin)&&!empty($end)){
            $where['createtime']=array('between',$begin.' 00:00:00,'.$end.' 23:59:59');
            $pageLink.='/txbBegin/'.$begin.'/txbEnd/'.$end;
        }
        else if(!empty($begin)){
            $where['createtime']=array('egt',$begin.' 00:00:00');
            $pageLink.='/txbBegin/'.$begin;
        }
        else if(!empty($end)){
            $where['createtime']=array('elt',$end.' 23:59:59');
            $pageLink.='/txbEnd/'.$end;
        }
        if(!empty($title)){
            $where['title']=array('like','%'.$title.'%');
            $pageLink.='/txbTitle/'.$title;
        }
        
        $page = I('get.page'); // 显示第几页
        if (empty($page) || $page < 1) {
            $page = 1;
        }
        $pageNum = 20; // 每页显示数目
        $result = $this->model
                       ->where($where)
                       ->page($page, $pageNum)
                       ->order('sortID asc,createTime desc')
                       ->select();
        
        $count = $this->model->where($where)->count();
        
        $categoryArray=D('ArticleCategory')->getArray();
        
        $this->assign('categoryID', $categoryID)
             ->assign('sBegin', $begin)
             ->assign('sEnd', $end)
             ->assign('sTitle', $title)
             ->assign('result', $result)
             ->assign('pageLink', $pageLink)
             ->assign('page', $page)
             ->assign('pageNum', $pageNum)
             ->assign('count', $count)
             ->assign('categoryArray',$categoryArray);
        
        $this->display('lists');
    }
}
