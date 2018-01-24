<?php require_once('Connections/rymssb.php'); ?>
<?php

$keyword = $_POST[keyword];
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
mysql_select_db($database_news, $news);//选择数据库
$query_Recordset1 = "SELECT * FROM novel ORDER BY id DESC LIMIT 10"; //查询语句
$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$fetch=$totalRows_Recordset1-10; //显示更新数目

$query_Recordset2 = "SELECT * FROM novel where id = 19"; //查询语句
$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$query_Recordset3 = "SELECT * FROM typeclass"; //查询语句
$Recordset3 = mysql_query($query_Recordset3, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

/*
$colname_Recordset2 = "-1";
if (isset($_GET['news_id'])) {
  $colname_Recordset2 = $_GET['news_id'];
}
mysql_select_db($database_news, $news);
$query_Recordset2 = sprintf("SELECT * FROM newstext WHERE news_title like '%%".$keyword."%%' and news_id = %s ", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_news, $news);
$query_Recordset3 = "SELECT * FROM newstext WHERE news_title like '%".$keyword."%'";
$Recordset3 = mysql_query($query_Recordset3, $news) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>云丛-爬虫数据下载-管理中心</title>
<!--
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

</style>-->
<!--以下是为了兼容IE6的hack--> 
<!--[if IE 6]> 
<style type="text/css"> 
div#headnav
{
	position:absolute;
	} 
</style> 
<![endif]--> 
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
<script type="text/javascript" src="http://cbjs.baidu.com/js/m.js"></script>
</head>

<body id="homefirst">
<!-- 顶部悬浮位置 -->
<div id="headnav">
<p>&nbsp;</p>
<!--p>&nbsp;</p-->

</div>
<p>&nbsp;</p>
<p>&nbsp;</p>




<div id="maincontent">

<div id="w3">
<h2><?php echo $row_Recordset2['title']; ?></h2>
<p><?php echo $row_Recordset2['content']; ?></p>
 <!-- 广告位：顶部右侧 -->

</div>










</div>

<div id="sidebar">


</div>


<div id="footer">
<p>如一模式识别提供的内容仅用于自己学习。我们不保证内容的正确性。通过使用本站内容随之而来的风险与本站无关。当使用本站时，代表您已接受了本站的<a href="/about/about_use.asp" title="关于使用">使用条款</a>和<a href="/about/about_privacy.asp" title="关于隐私">隐私条款</a>。版权所有，保留一切权利。如一模式识别 简体中文版的所有内容仅供测试，对任何法律问题及风险不承担任何责任。
<a href="http://www.miitbeian.gov.cn">《中华人民共和国电信与信息服务业务》信息产业部备案号 豫ICP备13014036号</a>


<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5009795'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/stat.php%3Fid%3D5009795%26online%3D1%26show%3Dline' type='text/javascript'%3E%3C/script%3E"));</script>
</p>
</div>

<?php
// 站长统计
?>

</body>

<script type="text/javascript">
    /*创建于 2015-03-19悬浮*/
var cpro_id = "u1997219";
</script>

</html>

<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);
mysql_free_result($Recordset3);
?>