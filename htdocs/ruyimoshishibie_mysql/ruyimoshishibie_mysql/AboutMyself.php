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
$query_Recordset1 = "SELECT * FROM novel where id=-1"; //查询语句
$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$query_Recordset2 = "SELECT * FROM novel"; //查询语句
$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);


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

<body id="homefirst">
<div id="wrapper">

<div id="header_index"><h1><a href="index_ruyi.php" title="如一模式识别研究">如一模式识别研究</a></h1></div>

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
		  <li><h2><a href="content_ruyi.php?id=<?php echo $row_Recordset1['id']; ?>"><?php echo $row_Recordset1['title']; ?></a></h2></li>
		  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </ul>
    
	<h2><a href="/ruyimoshishibie/about/index.asp" title="关于 如一模式识别" id="link_about">关于 如一模式识别</a></h2>
	<h2><a href="/ruyimoshishibie/about/about_helping.asp" title="帮助 如一模式识别" id="link_help">帮助 如一模式识别</a></h2>
    
</div>


<div id="maincontent">
<h3> &emsp;  </h3>
<h1>关于我</h1>
<h3> &emsp;  </h3>

<div id="intro">
<h3> &emsp;  </h3>
<h2>基本信息</h2>
<h5> &emsp;  </h5>
<pre>
赵明明 男1986- 河南洛阳人 模式识别方向 硕士
13271929138@163.com  13271929138
</pre>
</div>


<div>
<h3> &emsp;  </h3>
<h2>工作经历</h2>
<h5> &emsp;  </h5>
<pre>
A.某科研单位 研究员
    1.发现一种新型语音识别特征提取的方法。线性预测残差相位倒谱系数（Linear Pr-edictive R-
esidual Phase Cepstrum Coefficients,RPCC);
    2.完成对一种声学模型的改进。非齐次半连续隐马尔可夫模型（Nonho-mogeneous Se-micontinuo-
us Hidden Markov Model,  NSCHMM）;
    3.独立编写一个字符（数字，字母）识别程序；开发环境为matlab7.0.1，运行结果如下图：
<a href="11.rar"><img  border="0" src="http://www.zhaomingming.cn/person/num.jpg" width="400" height="300" /></a>
               点击<a href="http://www.zhaomingming.cn/person/数字识别matlab.rar" >下载</a>本例执行程序.
    4.参与同事论文编写，为其完成核心算法实验。一个带约束最优化仿真试验。
    5.使用OPCV结合VS2005编写一个从摄像头视频流中对人脸进行跟踪程序，程序截图如下:
<img src="http://www.zhaomingming.cn/person/face_play.gif"/>
               点击<a href="http://www.zhaomingming.cn/person/11.rar">下载</a>本例执行程序.
    6.完成在VC++6.0中实现图像预处理一般算法,程序界面如下：
<img src="http://www.zhaomingming.cn/person/pic_pre_process.jpg" width="400" height="300"/>
    7.采用VC++ 和神经网络算法编写一个字符识别算法测试软件，程序运行时界面如下:
<img src="http://www.zhaomingming.cn/person/recognition.jpg"/>
        图中是在识别加噪声后的“业”字，下面显示识别结果为：业.
<img src="http://www.zhaomingming.cn/person/文字识别_识别.jpg" width="400" height="260"/>
<img src="http://www.zhaomingming.cn/person/文字识别截图.jpg" width="400" height="260"/>
        此两张图为改进后的软件。点击<a href="http://www.zhaomingming.cn/person/文字识别演示.rar" >下载</a>本例执行程序.
        另外我将此程序移植到WINDOWS CE,WINDOWS MOBILE 系列嵌入式系列操作系统上，软件运行截图如下：
<table  cellspacing="5">
<caption>移植后效果</caption>
<tr>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/图片 031.jpg"><img src="http://www.zhaomingming.cn/person/图片 031.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/图片 032.jpg"><img src="http://www.zhaomingming.cn/person/图片 032.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/图片 032.jpg"><img src="http://www.zhaomingming.cn/person/图片 033.jpg" width="160" height="140"/></a></td>
</tr>
<tr>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/图片 032.jpg"><img src="http://www.zhaomingming.cn/person/图片 034.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/图片 032.jpg"><img src="http://www.zhaomingming.cn/person/图片 035.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/图片 032.jpg"><img src="http://www.zhaomingming.cn/person/图片 036.jpg" width="160" height="140"/></a></td>
</tr>
<tr>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/图片 032.jpg"><img src="http://www.zhaomingming.cn/person/图片 037.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/图片 032.jpg"><img src="http://www.zhaomingming.cn/person/图片 038.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/图片 032.jpg"><img src="http://www.zhaomingming.cn/person/图片 039.jpg" width="160" height="140"/></a></td>
</tr>

<tr>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/图片 032.jpg"><img src="http://www.zhaomingming.cn/person/图片 040.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/图片 032.jpg"><img src="http://www.zhaomingming.cn/person/图片 041.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/图片 032.jpg"><img src="http://www.zhaomingming.cn/person/图片 042.jpg" width="160" height="140"/></a></td>
</tr>
</table>
B.某光通信公司 激光与光电子技术 电子工程师 
    8.编写光接收机自动增益控制算法程序,菜单程序,按键程序,数据处理部分程序,
    9.调试光放大器精度控制程序算法；
    10.编写超大功率放大器铒铱光放大器的功率自动控制程序,系统处理程序,双机备份程序；
    11.对本来已经有的LCD驱动加以完善,使用更方便,快捷,少出BUG。 
C.某电子公司 技术服务 
    12.因掌握技能快，表现突出,在公司7天便被外派出差(一般流程要在公司培训一个月),曾到山东聊城电厂、黑龙江齐
	齐哈尔市电厂、天津蓟县电厂、内蒙古呼和浩特市电厂、兰州红谷区铝业电厂进行技术服务. 
</pre>
</div>



<div>
<h3> &emsp;  </h3>
<h2>职业特长</h2>
<h5> &emsp;  </h5>
<pre>
精通语音识别算法,熟悉人脸识别算法.
精通各种单片机开发,包括51系列,AVR系列等主流单片机.
精通C语言,设计并绘制多层电路PCB板图.
熟练使用LINUX及其系列系统，mac系统.
</pre>
<a href="/GoolgeAdSense.html">GoogleAdSense</a>
</div>


</div>



<!--  上面填写内容 -->

<div id="sidebar">


<div id="searchui">
<form method="get" id="searchform" action="http://www.google.com.hk/search">
<p><label for="searched_content">搜索本站:</label></p>
<p><input type="hidden" name="sitesearch" value="www.zhaomingming.cn" /></p>
<p>
<input type="text" name="as_q" class="box"  id="searched_content" title="在此输入搜索内容。" />
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
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5009795'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/stat.php%3Fid%3D5009795%26online%3D1%26show%3Dline' type='text/javascript'%3E%3C/script%3E"));</script>
</p>
</div>

<?php
// 站长统计
?>



</body>
</html>

<?php
mysql_free_result($Recordset1);
?>