<?php ob_start();require_once('Connections/rymssb.php'); ?>
<?php 

mysql_select_db($database_news, $news);//选择数据库
$page = intval($_GET['page']); //获取请求的页数 
$start = $page*20; 

$query=mysql_query("select * from novel order by id desc limit $start,20", $news) or die(mysql_error());
while ($row=mysql_fetch_array($query)) { 
$arr[] = array( 
'title'=>$page,
'id'=>$row['id']
); 
} 
echo json_encode($arr); //转换为json数据输出 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>如一模式识别研究</title>
<style type="text/css">

.daohang ul{list-style:none;}
.daohang li{float:left;width:100px;background:#CCC;margin-left:3px;line-height:30px;}
.daohang a{display:block;text-align:center;height:30px;}
.daohang a:link{color:#666;background:url(arrow_off.gif) #CCC no-repeat 5px 12px;text-decoration:none;}
.daohang a:visited{color:#666;text-decoration:underline;}
.daohang a:hover{color:#FFF; font-weight:bold;text-decoration:none;background:url(arrow_on.gif) #0af no-repeat 5px 12px;}
.daohang .clear{
clear:both;
border:none;
}

</style>
<meta name="description" content="模式识别方面材料整理。" />
<link rel="stylesheet" type="text/css" href="/c3.css" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="Content-Language" content="zh-cn" />
<meta name="robots" content="all" />
<meta name="keywords" content="模式识别,图像识别,语音识别,matlab,vc++,c#,opencv,cximage,java,脚本,php,VB,联合编程" />
<meta name="author" content="www.zhaomingming.cn/ruyimoshishibie/AboutMyself.php" />
<meta name="Copyright" content="Copyright www.zhaomingming.cn All Rights Reserved." />
<meta name="MSSmartTagsPreventParsing" content="true" />
<meta http-equiv="imagetoolbar" content="false" />
<link rel="shortcut icon" href="/ru.ico" type="image/x-icon" />
<meta name="baidu_union_verify" content="04ce94aa87f42a4feff958820b8b65ab">

</head>

<body >
</body>
</html>