<?php
$_POST['imgurl']="http://himg2.huanqiu.com/attachment2010/2014/1215/20141215025543136.jpg";

echo "imgurl".$_POST['imgurl'].'<br />';

$imgurl=trim($_POST['imgurl']) ? trim($_POST['imgurl']) : '';
$patharr=explode('.', $_SERVER['SCRIPT_NAME']);
$path=substr($patharr[0], 0,strrpos($patharr[0],'/'));
$finurl="http://".$_SERVER['SERVER_NAME'].$path.'/'.$imgurl;
if($imgurl=='' or !isset($imgurl)){
    return 'fail';
}
$header = array (  
     "POST HTTP/1.1",  
     "Content-Type: application/json",
     "Ocp-Apim-Subscription-Key:XXXXXXXXX",
 ); 
 /*
$param=array['url':$finurl];
$jsonparam=json_encode($param);
$ch = curl_init(); 
$url="https://api.projectoxford.ai/emotion/v1.0/recognize"; 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonparam);//
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);  //设置头信息的地方  
curl_setopt($ch, CURLOPT_HEADER, 0);    //no取得返回头信息
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   
curl_setopt($ch, CURLOPT_TIMEOUT, 10);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//不直接输出response 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);//如果返回的response 头部中存在Location值，就会递归请求  

try {
     $result = curl_exec($ch);
     //unlink($imgurl);
     echo $result;
 } catch (Exception $e) {
     echo "fail!".'<br>';
     var_dump(curl_error($ch)); 
 }
 */
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>微软表情识别测试</title>
</head>
<body>
</body>
</html>