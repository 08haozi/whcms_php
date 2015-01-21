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
     * 回收站
     */
    function recycle()
    {
        if (IS_POST) {
            $where['id'] = array('in',I('post.ids')
            );
            
            $data['isDel'] = 1;
            
            $this->model->where($where)->save($data);
            $this->success('移至回收站成功，页面自动刷新！');
        } else {
            $this->_search(1, 'recycle');
        }
    }

    /**
     * 删除
     */
    function delete()
    {
        if (IS_POST) {
            $where['id'] = array('in',I('post.ids')
            );
            
            $this->model->where($where)->delete();
            $this->success('删除成功，页面自动刷新！');
        }
    }

    /**
     * 清空回收站
     */
    function deleteAll()
    {
        if (IS_POST) {
            $where['isDel'] = 1;
            
            $this->model->where($where)->delete();
            $this->success('清空回收站成功，页面自动刷新！');
        }
    }

    /**
     * 还原
     */
    function restore()
    {
        if (IS_POST) {
            $where['id'] = array('in',I('post.ids')
            );
            
            $data['isDel'] = 0;
            
            $this->model->where($where)->save($data);
            $this->success('还原成功，页面自动刷新！');
        }
    }

    /**
     * 新建
     */
    function add()
    {
        if (IS_POST) {
            $this->model->create();
            $this->model->contents=html_entity_decode(stripslashes($this->model->contents));
            $this->model->creatorID = $_SESSION["ManagerID"];
            $this->model->auditorID = $_SESSION["ManagerID"];
            $this->model->isDel = 0;
            
            // 保存标题图片
            if (count($_FILES)>0){
                $uploadResult=$this->upload();
                if(false===$uploadResult){
                    $this->error('图片有误！');
                }
                else{
                    $this->model->imgLink=$uploadResult;
                }
            }
            
            $result = $this->model->add();
            if ($result) {
                $this->success('新建成功！');
            }
            $this->error('操作失败！');
        } else {
            $this->display('add');
        }
    }

    /**
     * 标题图片上传
     * @return boolean|string 失败返回false，成功返回图片路径
     */
    function upload()
    {
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小,3M
        $upload->exts = array('jpg','gif','png','jpeg'); // 设置附件上传类型
        $upload->rootPath  = './upload/article/title/'; // 设置附件上传目录 
        $upload->saveName = 'time'; // 采用时间戳命名
        // 上传文件
        $info = $upload->upload();
        if (!$info) {
            // 上传错误提示错误信息
            //return $upload->getError();
            return false;
        } else {
            // 上传成功
            return '/upload/article/title/'.$info['imgLink']['savepath'].$info['imgLink']['savename'];
        }
    }

    /**
     * 修改
     */
    function edit()
    {
        // 判断修改对象是否存在
        $result = $this->model->find(I('get.id'));
        if (! $result) {
            $this->error('文章不存在！', $SERVER['HTTP_REFERER']);
        }
        
        if (IS_POST) {
            $this->model->create();
            $this->model->contents=html_entity_decode(stripslashes($this->model->contents));
            
            // 保存标题图片
            if (count($_FILES)>0){
                $uploadResult=$this->upload();
                if(false===$uploadResult){
                    $this->error('图片有误！');
                }
                else{
                    $this->model->imgLink=$uploadResult;
                }
            }
            else{
                $this->model->imgLink=$result['imgLink'];
            }
            
            if (false===$this->model->where('id=' . $result['id'])->save()) {
                $this->error('操作失败！', $SERVER['HTTP_REFERER']);
            }
            $this->success('修改成功！', $SERVER['HTTP_REFERER']);
        } else {
            $this->assign('result', $result);
            $this->display('edit');
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
        $pageLink = '/Admin/Article/' . $templateName;
        
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
        $categoryArray = $categoryModel->getArray($categoryModel::TypeArticle);
        
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
