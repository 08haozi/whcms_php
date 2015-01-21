<?php
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