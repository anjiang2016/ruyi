<php?
$_POST['imgurl']="http://himg2.huanqiu.com/attachment2010/2014/1215/20141215025543136.jpg";
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
 ); 32879366.jpg"; 
$param=array('url'=>$finurl);
$jsonparam=json_encode($param);
$ch = curl_init(); 
$url="https://api.projectoxford.ai/emotion/v1.0/recognize"; 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonparam);//
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);  //����ͷ��Ϣ�ĵط�  
curl_setopt($ch, CURLOPT_HEADER, 0);    //noȡ�÷���ͷ��Ϣ
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   
curl_setopt($ch, CURLOPT_TIMEOUT, 10);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//��ֱ�����response 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);//������ص�response ͷ���д���Locationֵ���ͻ�ݹ�����  

try {
     $result = curl_exec($ch);
     //unlink($imgurl);
     echo $result;
 } catch (Exception $e) {
     echo "fail!".'<br>';
     var_dump(curl_error($ch)); 
 }
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>΢�����ʶ�����</title>
</head>
<body>
</body>
</html>