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
mysql_select_db($database_news, $news);//ѡ�����ݿ�
$query_Recordset1 = "SELECT * FROM novel ORDER BY id DESC LIMIT 10"; //��ѯ���
$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$fetch=$totalRows_Recordset1-10; //��ʾ������Ŀ

$query_Recordset2 = "SELECT * FROM novel where id = 19"; //��ѯ���
$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$query_Recordset3 = "SELECT * FROM typeclass"; //��ѯ���
$Recordset3 = mysql_query($query_Recordset3, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
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
<title>�ƴ�-������������-��������</title>
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
<!--������Ϊ�˼���IE6��hack--> 
<!--[if IE 6]> 
<style type="text/css"> 
div#headnav
{
	position:absolute;
	} 
</style> 
<![endif]--> 
<meta name="description" content="ģʽʶ�����������" />
<link rel="stylesheet" type="text/css" href="/c3.css" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="Content-Language" content="zh-cn" />
<meta name="robots" content="all" />
<meta name="keywords" content="ģʽʶ��,ͼ��ʶ��,����ʶ��,matlab,vc++,c#,opencv,cximage,java,�ű�,php,VB,���ϱ��" />
<meta name="author" content="www.zhaomingming.cn/ruyimoshishibie/AboutMyself.php" />
<meta name="Copyright" content="Copyright www.zhaomingming.cn All Rights Reserved." />
<meta name="MSSmartTagsPreventParsing" content="true" />
<meta http-equiv="imagetoolbar" content="false" />
<link rel="shortcut icon" href="/ru.ico" type="image/x-icon" />
<meta name="baidu_union_verify" content="04ce94aa87f42a4feff958820b8b65ab">
<script type="text/javascript" src="http://cbjs.baidu.com/js/m.js"></script>
</head>

<body id="homefirst">
<!-- ��������λ�� -->
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
 <!-- ���λ�������Ҳ� -->

</div>










</div>

<div id="sidebar">


</div>


<div id="footer">
<p>��һģʽʶ���ṩ�����ݽ������Լ�ѧϰ�����ǲ���֤���ݵ���ȷ�ԡ�ͨ��ʹ�ñ�վ������֮�����ķ����뱾վ�޹ء���ʹ�ñ�վʱ���������ѽ����˱�վ��<a href="/about/about_use.asp" title="����ʹ��">ʹ������</a>��<a href="/about/about_privacy.asp" title="������˽">��˽����</a>����Ȩ���У�����һ��Ȩ������һģʽʶ�� �������İ���������ݽ������ԣ����κη������⼰���ղ��е��κ����Ρ�
<a href="http://www.miitbeian.gov.cn">���л����񹲺͹���������Ϣ����ҵ����Ϣ��ҵ�������� ԥICP��13014036��</a>


<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5009795'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/stat.php%3Fid%3D5009795%26online%3D1%26show%3Dline' type='text/javascript'%3E%3C/script%3E"));</script>
</p>
</div>

<?php
// վ��ͳ��
?>

</body>

<script type="text/javascript">
    /*������ 2015-03-19����*/
var cpro_id = "u1997219";
</script>

</html>

<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);
mysql_free_result($Recordset3);
?>