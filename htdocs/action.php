<?php
/* 
当执行拍照动作时，代码与后台php交互，如果上传图片完成后，则返回相应的信息。

PHP

action.php所做的就是将本地拍照的图像上传到服务器，并将图片路径返回给前端。注意存放图片的路径要给写权限。
*/

$filename = date('YmdHis') . '.jpg';
$result = file_put_contents( 'pics/'.$filename, file_get_contents('php://input') );

if (!$result) {

print "ERROR: Failed to write data to $filename, check permissions\n";

exit();

}

$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/pics/' . $filename;

print "$url\n";

//本文只是简单的介绍了下在线拍照和上传功能，其实深入应用场景如上传后再裁剪，生成多张不同比例的图像等等，大家自己去琢磨吧
?>