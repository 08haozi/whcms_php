<?php
namespace Admin\Controller;

use Think\Controller;

/**
 * 图片文章
 */
class ArticleAlbumController extends AdminBaseController
{

    protected $model;
    
    /**
     * 初始化
     */
    function _initialize()
    {
        parent::_initialize();
        $this->model = D('ArticleAlbum');
        
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
        $this->_search(0, 'lists');
    }

    /**
     * 搜索
     */
    function search()
    {
        $this->_search(0, 'lists');
    }
    
    /**
     * 新建
     */
    function add()
    {
        if (IS_POST) {
            $data['categoryID']=I('post.categoryID');
            $data['title']=I('post.title');
            $data['createtime']=I('post.createtime');
            $data['isAudit']=I('post.isAudit');
            $data['sortID']=I('post.sortID');
            $data['creatorID'] = $_SESSION["ManagerID"];
            $data['auditorID'] = $_SESSION["ManagerID"];
            $data['isDel'] = 0;
            
            $result=$this->model->addM($data,I('post.thumbList'));
            
            if (true===$result) {
                $this->success('新建成功！');
            }
            $this->error($reuslt);
        } else {
            $this->display('add');
        }
    }
    
    function add123(){
        if(IS_POST){
            foreach(I('post.thumbList') as $value){
                $a.=','.$value;
            }
            $this->success($a);   
        }
        else{
            $this->display('add');
        }
    }
    
    /**
     * 删除图片
     */
    function delThumb(){
       $value=I('post.value');
       if(!empty($value)){
           $array=explode('#',$value);
           $this->_delFile($array[0]);
           $this->_delFile($array[1]);
           $this->_delFile($array[2]);
       }
       $this->success('删除成功！');
    }
    
    /**
     * 删除文件
     * @param unknown $fileName
     */
    private function _delFile($fileName){
        if(!empty($fileName)){
            $fileName='.'.$fileName;
            if(file_exists($fileName))
            {
                $result=unlink($fileName);
            }
        }
    }
    
    /**
     * 搜索
     *
     * @param int $isDel
     *            是否已删除 1是 0否
     * @param string $templateName
     *            模板名称
     */
    private function _search($isDel, $templateName)
    {
        $pageLink = '/Admin/ArticleAlbum/' . $templateName;
    
        $where['isDel'] = $isDel;
    
        $categoryID = I('get.categoryID'); // 分类ID
        $begin = I('get.beginTime'); // 开始时间
        $end = I('get.endTime'); // 结束时间
        $title = I('get.title'); // 标题
        if (! empty($categoryID) && $categoryID !== '0') {
            $where2['id']=$categoryID;
            $category=D('ArticleCategory')->where($where2)->find();
            if(false!==$category){
                $where['categoryID'] = array('in',substr($category['classList'], 1,-1));
                $pageLink .= '/categoryID/' . $categoryID;
            }
        }
        if (! empty($begin) && ! empty($end)) {
            $where['createtime'] = array('between',$begin . ' 00:00:00,' . $end . ' 23:59:59');
            $pageLink .= '/txbBegin/' . $begin . '/txbEnd/' . $end;
        } else if (! empty($begin)) {
            $where['createtime'] = array('egt',$begin . ' 00:00:00');
            $pageLink .= '/txbBegin/' . $begin;
        } else if (! empty($end)) {
            $where['createtime'] = array('elt',$end . ' 23:59:59');
            $pageLink .= '/txbEnd/' . $end;
        }
        if (! empty($title)) {
            $where['title'] = array('like','%' . $title . '%'
            );
            $pageLink .= '/txbTitle/' . $title;
        }
    
        $page = I('get.page'); // 显示第几页
        if (empty($page) || $page < 1) {
            $page = 1;
        }
        $pageNum = 20; // 每页显示数目
        $result = $this->model->where($where)
        ->page($page, $pageNum)
        ->order('sortID asc,createTime desc')
        ->select();
    
        $count = $this->model->where($where)->count();
    
        $categoryModel=D('ArticleCategory');
        $categoryArray = $categoryModel->getArray($categoryModel::TypeArticleAlbum);
    
        $this->assign('categoryID', $categoryID)
        ->assign('sBegin', $begin)
        ->assign('sEnd', $end)
        ->assign('sTitle', $title)
        ->assign('result', $result)
        ->assign('pageLink', $pageLink)
        ->assign('page', $page)
        ->assign('pageNum', $pageNum)
        ->assign('count', $count)
        ->assign('categoryArray', $categoryArray);
    
        $this->display($templateName);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}