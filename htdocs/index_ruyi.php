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
<title>如一模式识别研究</title>
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
</head>

<body id="homefirst">
<!-- 顶部悬浮位置 -->
<div id="headnav">
<p>&nbsp;</p>
<!--p>&nbsp;</p-->
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/admin_login.php">登录后台</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/admin_logout.php">退出</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/admin.php">后台管理</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/moshishibie_add.php">添加文章</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/register.php">注册管理员</a>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="wrapper">

<div id="header_index">
<h1><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/index_ruyi.php" title="如一模式识别研究">如一模式识别研究</a></h1>

</div>

<div id="navfirst">
<ul id="menu">
<li id="h"><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?type_id=3" title="基本数学知识">基本数学知识</a></li>
<li id="x"><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?type_id=1" title="语音识别研究">语音识别研</a></li>
<li id="b"><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?type_id=2" title="图像识别研究">图像识别研究</a></li>
<li id="w"><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/AboutMyself.php" title="关于">关于</a></li>
</ul>
</div>

<div id="navsecond">
	<ul>
	    <li><h2><a href="http://www.zhaomingming.cn">回首页</a></h2></li>
		  
		<?php do { ?>
		  <li><h2><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?type_id=<?php echo $row_Recordset3['id']; ?>"><?php echo $row_Recordset3['name']; ?></a></h2></li>
		  <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
    </ul>
    
	<ul>
		<?php// do { ?>
	 	  <!--<li><h2><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?id=<?php //echo $row_Recordset1['id']; ?>"><?php //echo $row_Recordset1['title']; ?></a></h2></li>-->
	 	  <?php //} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </ul>
	<h2><a href="/ruyimoshishibie/about/index.asp" title="关于 如一模式识别" id="link_about">关于 如一模式识别</a></h2>
	<h2><a href="/ruyimoshishibie/about/about_helping.asp" title="帮助 如一模式识别" id="link_help">帮助 如一模式识别</a></h2>

</div>


<div id="maincontent">

<div id="w3">
<h2><?php echo $row_Recordset2['title']; ?></h2>
<p><?php echo $row_Recordset2['content']; ?></p>
 <!-- 广告位：顶部右侧 -->

</div>


<div class="daohang" id="idea">

<h2>本站文章分类</h2>
<?php
$query_Recordset3 = "SELECT * FROM typeclass"; //查询语句
$Recordset3 = mysql_query($query_Recordset3, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<ul>
<?php do { ?>
		  <li><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?type_id=<?php echo $row_Recordset3['id']; ?>">&nbsp;<?php echo $row_Recordset3['name']; ?>&nbsp;</a></li>
		  <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
</ul>
<p class="clear"></p>
</div>

<div class="idea">

<!--预留广告位-->
<script type="text/javascript">
    /*嵌入自定义*/
    var cpro_id = "u1997279";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>


</div>


<div class="idea">
<h3>如一模式识别 更新提示</h3>
<p class="partner">
<ul>
		<?php do { ?>
	 	  <li><h2><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?id=<?php echo $row_Recordset1['id']; ?>"><?php echo $row_Recordset1['title']."。"."Edit by[".$row_Recordset1['author_name']."][".$row_Recordset1['time']."]"; ?></a></h2></li>
	 	  <?php $fetch=$fetch+1;} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</ul>

</p>

</div>


<div>
<h3>如一模式识别 友情链接</h3>
<p class="partner">
<a href="/ruyimoshishibie/AboutMyself.php">关于本站作者</a> &nbsp;&nbsp;&nbsp; 
<a href="http://www.chinaw3c.org/">chinaw3c</a> &nbsp;&nbsp;&nbsp;
<a href="http://mozilla.com.cn/">mozilla</a>
<a href="/bb/bo-blog/index.php">Bo-blog</a>
</p>

</div>

</div>

<div id="sidebar">


<div id="searchui">
<form method="get" id="searchform" action="http://www.baidu.com/s">
<p><label for="searched_content">搜索本站:</label></p>
<p><input type="hidden" name="si" value="www.zhaomingming.cn" />
<input type="hidden" name="ct" value="2097157" />
<input type="hidden" name="tn" value="sitehao123" />
</p>
<p>
<input type="text" name="wd" class="box"  id="searched_content" title="在此输入搜索内容。" />
<input type="submit" value="Go" class="button" title="搜索！" />
</p>
</form>
</div>
</div>


<div id="footer">
<p>如一模式识别提供的内容仅用于自己学习。我们不保证内容的正确性。通过使用本站内容随之而来的风险与本站无关。当使用本站时，代表您已接受了本站的<a href="/about/about_use.asp" title="关于使用">使用条款</a>和<a href="/about/about_privacy.asp" title="关于隐私">隐私条款</a>。版权所有，保留一切权利。如一模式识别 简体中文版的所有内容仅供测试，对任何法律问题及风险不承担任何责任。
<a href="http://www.miitbeian.gov.cn">《中华人民共和国电信与信息服务业务》信息产业部备案号 豫ICP备13014036号</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/admin_login.php">登录后台</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/admin_logout.php">退出</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/admin.php">后台管理</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/moshishibie_add.php">添加文章</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/register.php">注册管理员</a>

<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5009795'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/stat.php%3Fid%3D5009795%26online%3D1%26show%3Dline' type='text/javascript'%3E%3C/script%3E"));</script>
</p>
</div>

<?php
// 站长统计
?>
<script type="text/javascript">
    /*1024*74 创建于 2017年3月27日*/
    var cpro_id = "u2937569";
</script>
<script type="text/javascript" src="http://cpro.baidustatic.com/cpro/ui/c.js"></script>
</body>


<script type="text/javascript">
    /*底部超宽*/
    var cpro_id = "u1997290";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>
</html>

<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);
mysql_free_result($Recordset3);
?>
