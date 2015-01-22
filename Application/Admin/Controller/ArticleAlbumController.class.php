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
        $this->model = D('Article');
        
    }
    
    function index(){
        //$img='./upload/article/image/20150114/1421222387343393.jpg';
        //$fileName='./upload/article/image/20150114/1421222387343393_mm.jpg';
        //mkThumb($img,300,200,$fileName);
    }
    
    function add(){
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}