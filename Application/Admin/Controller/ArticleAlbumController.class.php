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
        $this->display('add');
    }
    
    function checkExists(){
        echo 0;
    }
    
    function uploadify(){
    $targetFolder = '/upload'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) 
    //&& $_POST['token'] == $verifyToken
    ) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小,3M
        $upload->exts = array('jpg','gif','png','jpeg'); // 设置附件上传类型
        $upload->rootPath  = './upload/articleAlbum/image/'; // 设置附件上传目录
        $upload->saveName = 'time'; // 采用时间戳命名
        

        if( !$upload->upload() )
        {
            echo '0';
        }else{
            $info=$upload->getUploadFileInfo();
            $src='s_'.$info[0]['savename'];
            echo $src;
        } 
    }
}