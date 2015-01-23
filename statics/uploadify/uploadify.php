<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

$session_name = session_name();
if (!isset($_POST[$session_name])) {
    echo 404;
    exit();
} 
else {
    session_id($_POST[$session_name]);
    session_start();
    if (!isset($_SESSION["ManagerID"])) {
        echo 404;
        exit();
    }
}

// Define a destination
$targetFolder = '/upload/articleAlbum/image/'.date('Ymd').'/'; // Relative to the root

if (!empty($_FILES)) {
    $folder='../..'.$targetFolder;
    if(!is_dir($folder)){
        mkdir($folder);
    }
    
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	$targetFileName=time().rand(100, 999);
	$targetPath=rtrim($targetPath,'/') . '/';
	$file=$targetFileName.'.'.$fileParts['extension'];
	$thumbFile1=$targetFileName.'s'.'.'.$fileParts['extension'];//缩略图地址300*200
	$thumbFile2=$targetFileName.'ss'.'.'.$fileParts['extension'];//缩略图地址150*100
	$targetFileName.='.'.$fileParts['extension'];
	$targetFile = $targetPath.$targetFileName;
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions	
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		mkThumb($targetFile,300,200,$targetPath.$thumbFile1);
		mkThumb($targetFile,150,100,$targetPath.$thumbFile2);
		echo $targetFolder.$file.'#'.$targetFolder.$thumbFile1.'#'.$targetFolder.$thumbFile2;
	} else {
		echo 'Invalid file type.';
	}
}

/**
 * 生成缩略图
 * @param string $img 原图地址（包括文件名）
 * @param int $width 缩略图宽度
 * @param int $height 缩略图高度
 * @param string $fileName 缩略图地址（包括文件名）
 */
function mkThumb($img,$width,$height,$fileName){
    $imageInfo=getimagesize($img);  //获取原始图片信息
    switch ($imageInfo[2]){
        //图片类型判断
        case 1:
            $image=imagecreatefromgif($img);
            break;
        case 2:
            $image=imagecreatefromjpeg($img);
            break;
        case 3:
            $image=imagecreatefrompng($img);
            break;
    }
    $imageWidth=$imageInfo[0];//原图宽度
    $imageHeight=$imageInfo[1];//原图高度
    $thumb=imagecreatetruecolor($width, $height);//创建缩略图
    imagecopyresampled($thumb, $image, 0, 0, 0, 0, $width, $height, $imageWidth, $imageHeight);//复制图像并改变尺寸
    imagejpeg($thumb,$fileName,100);//输出图像
}
?>