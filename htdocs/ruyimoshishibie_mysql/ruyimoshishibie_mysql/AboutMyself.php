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
$query_Recordset1 = "SELECT * FROM novel where id=-1"; //��ѯ���
$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$query_Recordset2 = "SELECT * FROM novel"; //��ѯ���
$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
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
<title>��һģʽʶ���о�</title>
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
</head>

<body id="homefirst">
<div id="wrapper">

<div id="header_index"><h1><a href="index_ruyi.php" title="��һģʽʶ���о�">��һģʽʶ���о�</a></h1></div>

<div id="navfirst">
<ul id="menu">
<li id="h"><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?type_id=3" title="������ѧ֪ʶ">������ѧ֪ʶ</a></li>
<li id="x"><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?type_id=1" title="����ʶ���о�">����ʶ����</a></li>
<li id="b"><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?type_id=2" title="ͼ��ʶ���о�">ͼ��ʶ���о�</a></li>
<li id="w"><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/AboutMyself.php" title="����">����</a></li>
</ul>
</div>

<div id="navsecond">
    
	<ul>
	<li><h2><a href="http://www.zhaomingming.cn">����ҳ</a></h2></li>
		<?php do { ?>
		  <li><h2><a href="content_ruyi.php?id=<?php echo $row_Recordset1['id']; ?>"><?php echo $row_Recordset1['title']; ?></a></h2></li>
		  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </ul>
    
	<h2><a href="/ruyimoshishibie/about/index.asp" title="���� ��һģʽʶ��" id="link_about">���� ��һģʽʶ��</a></h2>
	<h2><a href="/ruyimoshishibie/about/about_helping.asp" title="���� ��һģʽʶ��" id="link_help">���� ��һģʽʶ��</a></h2>
    
</div>


<div id="maincontent">
<h3> &emsp;  </h3>
<h1>������</h1>
<h3> &emsp;  </h3>

<div id="intro">
<h3> &emsp;  </h3>
<h2>������Ϣ</h2>
<h5> &emsp;  </h5>
<pre>
������ ��1986- ���������� ģʽʶ���� ˶ʿ
13271929138@163.com  13271929138
</pre>
</div>


<div>
<h3> &emsp;  </h3>
<h2>��������</h2>
<h5> &emsp;  </h5>
<pre>
A.ĳ���е�λ �о�Ա
    1.����һ����������ʶ��������ȡ�ķ���������Ԥ��в���λ����ϵ����Linear Pr-edictive R-
esidual Phase Cepstrum Coefficients,RPCC);
    2.��ɶ�һ����ѧģ�͵ĸĽ�������ΰ�����������ɷ�ģ�ͣ�Nonho-mogeneous Se-micontinuo-
us Hidden Markov Model,  NSCHMM��;
    3.������дһ���ַ������֣���ĸ��ʶ����򣻿�������Ϊmatlab7.0.1�����н������ͼ��
<a href="11.rar"><img  border="0" src="http://www.zhaomingming.cn/person/num.jpg" width="400" height="300" /></a>
               ���<a href="http://www.zhaomingming.cn/person/����ʶ��matlab.rar" >����</a>����ִ�г���.
    4.����ͬ�����ı�д��Ϊ����ɺ����㷨ʵ�顣һ����Լ�����Ż��������顣
    5.ʹ��OPCV���VS2005��дһ��������ͷ��Ƶ���ж��������и��ٳ��򣬳����ͼ����:
<img src="http://www.zhaomingming.cn/person/face_play.gif"/>
               ���<a href="http://www.zhaomingming.cn/person/11.rar">����</a>����ִ�г���.
    6.�����VC++6.0��ʵ��ͼ��Ԥ����һ���㷨,����������£�
<img src="http://www.zhaomingming.cn/person/pic_pre_process.jpg" width="400" height="300"/>
    7.����VC++ ���������㷨��дһ���ַ�ʶ���㷨�����������������ʱ��������:
<img src="http://www.zhaomingming.cn/person/recognition.jpg"/>
        ͼ������ʶ���������ġ�ҵ���֣�������ʾʶ����Ϊ��ҵ.
<img src="http://www.zhaomingming.cn/person/����ʶ��_ʶ��.jpg" width="400" height="260"/>
<img src="http://www.zhaomingming.cn/person/����ʶ���ͼ.jpg" width="400" height="260"/>
        ������ͼΪ�Ľ������������<a href="http://www.zhaomingming.cn/person/����ʶ����ʾ.rar" >����</a>����ִ�г���.
        �����ҽ��˳�����ֲ��WINDOWS CE,WINDOWS MOBILE ϵ��Ƕ��ʽϵ�в���ϵͳ�ϣ�������н�ͼ���£�
<table  cellspacing="5">
<caption>��ֲ��Ч��</caption>
<tr>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/ͼƬ 031.jpg"><img src="http://www.zhaomingming.cn/person/ͼƬ 031.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/ͼƬ 032.jpg"><img src="http://www.zhaomingming.cn/person/ͼƬ 032.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/ͼƬ 032.jpg"><img src="http://www.zhaomingming.cn/person/ͼƬ 033.jpg" width="160" height="140"/></a></td>
</tr>
<tr>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/ͼƬ 032.jpg"><img src="http://www.zhaomingming.cn/person/ͼƬ 034.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/ͼƬ 032.jpg"><img src="http://www.zhaomingming.cn/person/ͼƬ 035.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/ͼƬ 032.jpg"><img src="http://www.zhaomingming.cn/person/ͼƬ 036.jpg" width="160" height="140"/></a></td>
</tr>
<tr>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/ͼƬ 032.jpg"><img src="http://www.zhaomingming.cn/person/ͼƬ 037.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/ͼƬ 032.jpg"><img src="http://www.zhaomingming.cn/person/ͼƬ 038.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/ͼƬ 032.jpg"><img src="http://www.zhaomingming.cn/person/ͼƬ 039.jpg" width="160" height="140"/></a></td>
</tr>

<tr>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/ͼƬ 032.jpg"><img src="http://www.zhaomingming.cn/person/ͼƬ 040.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/ͼƬ 032.jpg"><img src="http://www.zhaomingming.cn/person/ͼƬ 041.jpg" width="160" height="140"/></a></td>
  <td><a target = "_blank" href="http://www.zhaomingming.cn/person/ͼƬ 032.jpg"><img src="http://www.zhaomingming.cn/person/ͼƬ 042.jpg" width="160" height="140"/></a></td>
</tr>
</table>
B.ĳ��ͨ�Ź�˾ ���������Ӽ��� ���ӹ���ʦ 
    8.��д����ջ��Զ���������㷨����,�˵�����,��������,���ݴ����ֳ���,
    9.���Թ�Ŵ������ȿ��Ƴ����㷨��
    10.��д�����ʷŴ�����ҿ��Ŵ����Ĺ����Զ����Ƴ���,ϵͳ�������,˫�����ݳ���
    11.�Ա����Ѿ��е�LCD������������,ʹ�ø�����,���,�ٳ�BUG�� 
C.ĳ���ӹ�˾ �������� 
    12.�����ռ��ܿ죬����ͻ��,�ڹ�˾7��㱻���ɳ���(һ������Ҫ�ڹ�˾��ѵһ����),����ɽ���ĳǵ糧����������
	������е糧������ص糧�����ɹź��ͺ����е糧�����ݺ������ҵ�糧���м�������. 
</pre>
</div>



<div>
<h3> &emsp;  </h3>
<h2>ְҵ�س�</h2>
<h5> &emsp;  </h5>
<pre>
��ͨ����ʶ���㷨,��Ϥ����ʶ���㷨.
��ͨ���ֵ�Ƭ������,����51ϵ��,AVRϵ�е�������Ƭ��.
��ͨC����,��Ʋ����ƶ���·PCB��ͼ.
����ʹ��LINUX����ϵ��ϵͳ��macϵͳ.
</pre>
<a href="/GoolgeAdSense.html">GoogleAdSense</a>
</div>


</div>



<!--  ������д���� -->

<div id="sidebar">


<div id="searchui">
<form method="get" id="searchform" action="http://www.google.com.hk/search">
<p><label for="searched_content">������վ:</label></p>
<p><input type="hidden" name="sitesearch" value="www.zhaomingming.cn" /></p>
<p>
<input type="text" name="as_q" class="box"  id="searched_content" title="�ڴ������������ݡ�" />
<input type="submit" value="Go" class="button" title="������" />
</p>
</form>
</div>

</div>


<div id="footer">
<p>��һģʽʶ���ṩ�����ݽ������Լ�ѧϰ�����ǲ���֤���ݵ���ȷ�ԡ�ͨ��ʹ�ñ�վ������֮�����ķ����뱾վ�޹ء���ʹ�ñ�վʱ���������ѽ����˱�վ��<a href="/about/about_use.asp" title="����ʹ��">ʹ������</a>��<a href="/about/about_privacy.asp" title="������˽">��˽����</a>����Ȩ���У�����һ��Ȩ������һģʽʶ�� �������İ���������ݽ������ԣ����κη������⼰���ղ��е��κ����Ρ�
<a href="http://www.miitbeian.gov.cn">���л����񹲺͹���������Ϣ����ҵ����Ϣ��ҵ�������� ԥICP��13014036��</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/admin_login.php">��¼��̨</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/admin_logout.php">�˳�</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/admin.php">��̨����</a>
<a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/moshishibie_add.php">�������</a>
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5009795'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/stat.php%3Fid%3D5009795%26online%3D1%26show%3Dline' type='text/javascript'%3E%3C/script%3E"));</script>
</p>
</div>

<?php
// վ��ͳ��
?>



</body>
</html>

<?php
mysql_free_result($Recordset1);
?>