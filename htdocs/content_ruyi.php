<?php ob_start();require_once('Connections/rymssb.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}


//echo "���ݵ�session����var1��ֵΪ��".$_SESSION['MM_Username']."<br />";
//echo "���ݵ�session����var1��ֵΪ��".$_SESSION['MM_UserGroup']."<br />";
if(!empty($_SESSION['MM_UserGroup'])&&!empty($_SESSION['MM_Username'])){
 //echo "MM_UserGroup�ǿ�<br />";
}else{
  //echo "MM_UserGroup��<br />";
}
$keyword = $_POST[keyword];
mysql_select_db($database_news, $news);//ѡ�����ݿ�
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


//*********************���Ա����Ӧ��*********************//

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
/*<!--$inserttxt="insert into newstext(news_title,news_type,news_content,news_data,news_author) values('项目新闻4','4','项目新闻1的内�?,'4999/03/05','作者：赵明�?);";
mysql_select_db($database_news, $news);
  $Result1 = mysql_query($inserttxt, $news) or die(mysql_error());-->*/
echo "_",isset($_POST["MM_insert"]),"_";
//echo $_POST["MM_insert"];
//echo $_POST["news_author"];
//echo $_POST["news_content"];

//echo "0-";
 //date_defualt_timezone_set('Asiz/Shanghai');
  echo date("Y-m-d");
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_comment")) {
	echo "1-";
  //$news_context_html=nl2br(addslashes($news_context));
  //$news_context_html=str_replace("\n","<br />",$news_context); 
 // $news_context_html = ereg_replace("\n", "<BR>\n", $news_context);
  $insertSQL = sprintf("INSERT INTO novel_comment (author,content,novel_id) VALUES (%s, %s, %d)",
                  
                       GetSQLValueString($_POST['news_author'], "text"),
                      
                  
					   GetSQLValueString(nl2br($_POST['news_content']), "text"),
					   
					   GetSQLValueString($_POST['novel_id'], "int")
					   );
                

  mysql_select_db($database_news, $news);
  //echo "2-";
  $Result1 = mysql_query($insertSQL, $news) or die(mysql_error());
  //echo "3-";
  echo date("Y-m-d")."<br />";
  //echo $Reuslt1."<br />";
  echo date('h:i:s') . "<br />";

//��ͣ 10 ��
//sleep(100);
 //  exit(); ִ�е��˾٣�ֹͣ���˾����ڵ���
//���¿�ʼ
//echo date('h:i:s') ."<br />";
  //$insertGoTo = "admin.php";
  $insertGoTo = "content_ruyi.php?id=";
  $insertGoTo .= $_POST['novel_id'];
  
  //if (isset($_SERVER['QUERY_STRING'])) {
  //  $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
  // $insertGoTo .= $_SERVER['QUERY_STRING'];
  //}
  //header(sprintf("Location: %s", $insertGoTo));
  //exit();
  ob_end_flush();
}

//******************************//

$colname_Recordset4 = "-1";
$colname_Recordset1 = "-1";
$colname_Recordset2 = "-1";

if(empty($_SESSION['MM_UserGroup']))
{
    # �����id
	if (isset($_GET['id'])) {
		$colname_Recordset4 = $_GET['id'];
	#	mysql_select_db($database_news, $news);//ѡ�����ݿ�
	    #����ID������
		$query_Recordset4 = sprintf("SELECT * FROM novel WHERE id = %s ", GetSQLValueString($colname_Recordset4, "int"));
		$Recordset4 = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset4 = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset4 = mysql_num_rows($Recordset4);
		
		#��������ID������
		$query_Recordset_comment = sprintf("SELECT * FROM novel_comment WHERE novel_id = %s ", GetSQLValueString($colname_Recordset4, "int"));
		$Recordset_comment = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset_comment = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset_comment = mysql_num_rows($Recordset4);
		
		
		
		
		$colname_Recordset1 = $row_Recordset4['type_id'];
		#����type_id���������������£����򣬲�20ƪ
		$query_Recordset1 = sprintf("SELECT * FROM novel WHERE type_id = %s ORDER BY id DESC LIMIT 20", GetSQLValueString($colname_Recordset1, "int"));
		$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
		$row_Recordset1 = mysql_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($Recordset1);
		
		$colname_Recordset2 = $row_Recordset4['type_id'];
		#��ѯ����id
		$query_Recordset2 = sprintf("SELECT * FROM typeclass WHERE id = %s", GetSQLValueString($colname_Recordset2, "int"));
		$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
		
		
		
	}
	# �����type_id
	else if(isset($_GET['type_id'])){
		$colname_Recordset1 = $_GET['type_id'];
		$query_Recordset1 = sprintf("SELECT * FROM novel WHERE type_id = %s ORDER BY id DESC LIMIT 20", GetSQLValueString($colname_Recordset1, "int"));
		$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
		$row_Recordset1 = mysql_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($Recordset1);
		
		$colname_Recordset4 = $_GET['type_id'];
	#	mysql_select_db($database_news, $news);//ѡ�����ݿ�
		$query_Recordset4 = sprintf("SELECT * FROM novel WHERE type_id = %s ", GetSQLValueString($colname_Recordset4, "int"));
		$Recordset4 = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset4 = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset4 = mysql_num_rows($Recordset4);
		
		$colname_Recordset2 = $_GET['type_id'];
		$query_Recordset2 = sprintf("SELECT * FROM typeclass WHERE id = %s", GetSQLValueString($colname_Recordset2, "int"));
		$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
	}
	else{
		$colname_Recordset1 = 1;
		$query_Recordset1 = sprintf("SELECT * FROM novel WHERE type_id = %s ORDER BY id DESC LIMIT 20", GetSQLValueString($colname_Recordset1, "int"));
		$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
		$row_Recordset1 = mysql_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($Recordset1);
		
		$colname_Recordset4 = 1;
		mysql_select_db($database_news, $news);//ѡ�����ݿ�
		$query_Recordset4 = sprintf("SELECT * FROM novel WHERE type_id = %s ", GetSQLValueString($colname_Recordset4, "int"));
		$Recordset4 = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset4 = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset4 = mysql_num_rows($Recordset4);
		
		$colname_Recordset2 = $row_Recordset4['type_id'];
		$query_Recordset2 = sprintf("SELECT * FROM typeclass WHERE id = %s", GetSQLValueString($colname_Recordset2, "int"));
		$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
	}
}
else
{
	if (isset($_GET['id'])) {
		$colname_Recordset4 = $_GET['id'];
	#	mysql_select_db($database_news, $news);//ѡ�����ݿ�
		$query_Recordset4 = sprintf("SELECT * FROM novel WHERE id = %s  AND author_name = %s ORDER BY id DESC LIMIT 20", GetSQLValueString($colname_Recordset4, "int"),GetSQLValueString($_SESSION['MM_Username'], "text"));
		$Recordset4 = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset4 = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset4 = mysql_num_rows($Recordset4);
		
		
		
		$colname_Recordset1 = $row_Recordset4['type_id'];
		$query_Recordset1 = sprintf("SELECT * FROM novel WHERE type_id = %s AND author_name = %s ", GetSQLValueString($colname_Recordset1, "int"),GetSQLValueString($_SESSION['MM_Username'], "text"));
		$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
		$row_Recordset1 = mysql_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($Recordset1);
		
		$colname_Recordset2 = $row_Recordset4['type_id'];
		$query_Recordset2 = sprintf("SELECT * FROM typeclass WHERE id = %s ", GetSQLValueString($colname_Recordset2, "int"));
		$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
		
		
		
	}
	else if(isset($_GET['type_id'])){
		$colname_Recordset1 = $_GET['type_id'];
		$query_Recordset1 = sprintf("SELECT * FROM novel WHERE type_id = %s AND author_name = %s ORDER BY id DESC LIMIT 20", GetSQLValueString($colname_Recordset1, "int"),GetSQLValueString($_SESSION['MM_Username'], "text"));
		$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
		$row_Recordset1 = mysql_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($Recordset1);
		
		$colname_Recordset4 = $_GET['type_id'];
	#	mysql_select_db($database_news, $news);//ѡ�����ݿ�
		$query_Recordset4 = sprintf("SELECT * FROM novel WHERE type_id = %s AND author_name = %s", GetSQLValueString($colname_Recordset4, "int"),GetSQLValueString($_SESSION['MM_Username'], "text"));
		$Recordset4 = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset4 = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset4 = mysql_num_rows($Recordset4);
		
		$colname_Recordset2 = $_GET['type_id'];
		$query_Recordset2 = sprintf("SELECT * FROM typeclass WHERE id = %s", GetSQLValueString($colname_Recordset2, "int"));
		$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
	}
	else{
		$colname_Recordset1 = 1;
		$query_Recordset1 = sprintf("SELECT * FROM novel WHERE type_id = %s AND author_name = %s ORDER BY id DESC LIMIT 20", GetSQLValueString($colname_Recordset1, "int"),GetSQLValueString($_SESSION['MM_Username'], "text"));
		$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
		$row_Recordset1 = mysql_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($Recordset1);
		
		$colname_Recordset4 = 1;
		mysql_select_db($database_news, $news);//ѡ�����ݿ�
		$query_Recordset4 = sprintf("SELECT * FROM novel WHERE type_id = %s AND author_name = %s", GetSQLValueString($colname_Recordset4, "int"),GetSQLValueString($_SESSION['MM_Username'], "text"));
		$Recordset4 = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset4 = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset4 = mysql_num_rows($Recordset4);
		
		$colname_Recordset2 = $row_Recordset4['type_id'];
		$query_Recordset2 = sprintf("SELECT * FROM typeclass WHERE id = %s", GetSQLValueString($colname_Recordset2, "int"));
		$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
	}
}

$colname_Recordset10 = 1;
$query_Recordset10= sprintf("SELECT * FROM novel ORDER BY id DESC");
$Recordset10 = mysql_query($query_Recordset10, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
$row_Recordset10 = mysql_fetch_assoc($Recordset10);
$totalRows_Recordset10 = mysql_num_rows($Recordset10);

$query_Recordset_g = "SELECT * FROM novel ORDER BY id DESC LIMIT 10"; //��ѯ���
$Recordset_g = mysql_query($query_Recordset_g, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
$row_Recordset_g = mysql_fetch_assoc($Recordset_g);
$totalRows_Recordset_g = mysql_num_rows($Recordset_g);




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

.contentA a{text-align:center;height:30px;}
.contentA a:link{color:#000;background:url(arrow_off.gif) #CCC no-repeat 5px 12px;text-decoration:none;}
.contentA a:visited{color:#000;text-decoration:underline;}
.contentA a:hover{color:#FFF; font-weight:bold;text-decoration:none;background:url(arrow_on.gif) #0af no-repeat 5px 12px;}

</style>-->
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
<script type="text/javascript" src="jquery-1.4.js"></script>

<script type="text/javascript"> 

//��ȡget��������
//ʹ������
//var TelNumber=GetQueryString("tel")
//alert( TelNumber);     
        
function GetQueryString(name) 
{ 
	var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); 
	var r = window.location.search.substr(1).match(reg); 
	if (r!=null){
			return unescape(r[2]);
	}
	else{
			return null; 
	}
}
/*
$(function(){ 
     // �Զ����س���������Ҫ�Ż���
     //alert("��Ч");
	var winH = $(window).height(); //ҳ���������߶� 
	var i = 0; 
	var typedata = GetQueryString('type_id');
	var lastone=0;
	//var typedata = 0;
	$(window).scroll(function () 
	{ 
	    var abouttop=$('#aboutRUYI').offset().top;
		var footertop=$('#footer').offset().top;
		
		var aboutposi=$('#aboutRUYI').position();
		var pageH = $(document.body).height(); 
		var scrollT = $(window).scrollTop(); //������top 
		var scrollB = scrollT+winH; //������bottom 
		
		//fixDiv('guding',winH*winH/pageH);
		
		
		var aa = (pageH-winH-scrollT)/winH; 
		var bb = pageH-abouttop;
		
		//$("#guding p").text(pageH+"-"+scrollT+"-"+winH+"-"+bb+"-"+abouttop+"-"+scrollB);
        //$("#guding p").text(aboutposi.top+"-"+aa);
        //$("#guding p").text(i);
          		
		//if(aa<0.02)
		//if(bb>(winH/2))
		var cc=abouttop-scrollB;
		var dd=footertop-scrollB;
		 $("#guding p").text(cc+"-"+dd);
		if( ((abouttop-scrollB)<-(winH/2)) || (footertop-scrollB<=-100))
		{ 
		    i++;  
			$.getJSON("result_title.php",{page:i,page1:typedata},function(json)
			{ 
				if(json)
				{ 
					var str = ""; 
					$.each(json,function(index,array){ 
					//var str = "<div class=\"single_item\"><div class=\"element_head\">"; 
					//var str = str + "<div class=\"date\">"+array['date']+"</div>"; 
					//var str = str + "<div class=\"author\">"+array['author']+"</div>"; 
					//var str = str + "</div><div class=\"content\">"+array['content']+"</div></div>"; 
					//$("#container").append(str); 
					$("#navsecond ul").append("<li><h2><a href='content_ruyi.php?id="+array['id']+"'>"+array['title']+"</a></h2></li>");
					
					//$("#navsecond ul").append("<li><h2><a href='content_ruyi.php?id="+array['id']+"'>"+pageH+"-"+scrollT+"-"+winH+"</a></h2></li>"); 
					}); 
			       // $("#navsecond ul").append("<li><h2><a href='content_ruyi.php?id="+array['id']+"'>"+pageH+"-"+scrollT+"-"+winH+"</a></h2></li>"); 
					//$("#navsecond ul").append("<li><h2><a href='content_ruyi.php?id="+array['id']+"'>"+"1111111111"+"</a></h2></li>"); 
					
					
				}
				else
				{   if(!lastone)
				    {
						lastone=1;
						//$(".nodata").show().html("������ˣ��Ѿ������ˡ�����"); 
						$("#navsecond ul").append("<li><h2><a >�Ѿ������һƪ</a></h2></li>"); 
					}
					return false; 
				} 
			});  
			//alert("������ˣ��Ѿ������ˡ�����"+i);
			//$("#navsecond ul").append("<li><h2><a href=\"content_ruyi.php?id=array['id']\">aa<0.02</a></h2></li>"); 
		} 
	}); 
});
*/

/*
*������������λ�ò����DIV��
*div_id��DIV��ID����ֵ���������
*offsetTop������������ʱDIV��ඥ���ĸ߶ȣ���ѡ����
*/
function fixDiv(div_id,offsetTop){
    var Obj=$('#'+div_id);
	if(Obj.length!=1){return false;}
	var offsetTop=arguments[1]?arguments[1]:0;
    var ObjTop=Obj.offset().top;
    var isIE6=$.browser.msie && $.browser.version == '6.0';
    if(isIE6){
        $(window).scroll(function(){
			if($(window).scrollTop()<=ObjTop){
                    Obj.css({
                        'position':'relative',
                        'top':0
                    });
            }else{
                Obj.css({
                    'position':'absolute',
                    'top':$(window).scrollTop()+offsetTop+'px',
                    'z-index':1
                });
            }
        });
    }else{
        $(window).scroll(function(){
            if($(window).scrollTop()<=ObjTop){
                Obj.css({
                    'position':'relative',
					'top':0
					});
            }else{
                Obj.css({
                    'position':'fixed',
                    'top':0+offsetTop+'px',
					'z-index':1
                });
            }
        });
    }
} 

</script> 

</head>

<body id="homefirst">
<script type="text/javascript">
    /*�������Ӵ���λ0327*/
    var cpro_id = "u2937649";
</script>
<script type="text/javascript" src="http://cpro.baidustatic.com/cpro/ui/c.js"></script>

<div  id="guding">
<!--<p>�̶��ڴ���</p>-->
</div>
<div id="wrapper">


<div id="header_index"><h1><a href="index_ruyi.php" title="��һģʽʶ���о�">��һģʽʶ���о�</a></h1></div>

<div id="navfirst">
<ul id="menu">
<?php if($_SESSION['MM_UserGroup']==0){ ?>
<li id="h"><a href="content_ruyi.php?type_id=3" title="������ѧ֪ʶ">������ѧ֪ʶ</a></li>
<li id="x"><a href="content_ruyi.php?type_id=1" title="����ʶ���о�">����ʶ����</a></li>
<li id="b"><a href="content_ruyi.php?type_id=2" title="ͼ��ʶ���о�">ͼ��ʶ���о�</a></li>
<li id="w"><a href="AboutMyself.php" title="����">����</a></li>
<?php }elseif($_SESSION['MM_UserGroup']==1){ ?>
<li id="h"><a href="" title="������ѧ֪ʶ">������ѧ֪ʶ</a></li>
<li id="x"><a href="" title="����ʶ���о�">����ʶ����</a></li>
<li id="b"><a href="" title="ͼ��ʶ���о�">ͼ��ʶ���о�</a></li>
<li id="w"><a href="AboutMyself.php" title="����">����</a></li>
<?php } ?>
</ul>
</div>

<div id="navsecond"> <!--���������б�-->
	<ul>
	<li><h2><a href="http://www.zhaomingming.cn">����ҳ</a></h2></li>
		<?php do { ?>
		  <li><h2><a href="content_ruyi.php?id=<?php echo $row_Recordset1['id']; ?>"><?php echo $row_Recordset1['title']; ?></a></h2></li>
		  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </ul>
    
	<h2 id="aboutRUYI"><a href="/ruyimoshishibie/about/index.asp" title="���� ��һģʽʶ��" id="link_about">���� ��һģʽʶ��</a></h2>
	<h2><a href="/ruyimoshishibie/about/about_helping.asp" title="���� ��һģʽʶ��" id="link_help">���� ��һģʽʶ��</a></h2>
    
</div>

<div id="maincontent">

<div id="idea">
<h1><a href="http://www.zhaomingming.cn"></a><?php echo $row_Recordset2['name'].'>>'.$row_Recordset4['title'];; ?></h1>
</div>
<?php if((empty($_SESSION['MM_UserGroup']) || $_SESSION['MM_UserGroup']==1) &&!empty($_SESSION['MM_Username'])){?>
<div class="daohang" id="idea">
<p><p>
<br />
<h2><?php echo $row_Recordset4['title']; ?></h2>



<h2><?php echo "�༭��".$row_Recordset4['author_name']; ?></h2>
<h2><?php echo "ʱ�䣺".$row_Recordset4['time']; ?></h2>
<ul>
		  <li><a href="">&nbsp;&nbsp;&nbsp;</a></li>
		  <li><a href="moshishibie_add.php?id=<?php echo $Rows_Recordset10['id']+1; ?>">&nbsp;���&nbsp;</a></li>
		  <li><a href="moshishibie_upd.php?id=<?php echo $row_Recordset4['id']; ?>">&nbsp;�޸�&nbsp;</a></li>
		  <?php if($_SESSION['MM_UserGroup']==0&&!empty($_SESSION['MM_Username'])){?>
		  <li><a href="moshishibie_del.php?id=<?php echo $row_Recordset4['id']; ?>">&nbsp;ɾ��&nbsp;</a></li>
	      <?php }else{ ?>
		  <li><a href="">&nbsp;&nbsp;&nbsp;</a></li>
		  <?php } ?>
		  <li><a href="">&nbsp;&nbsp;&nbsp;</a></li>
		  
</ul>

<p class="clear"></p>
<p class="clear"></p>
<p class="clear"></p>
<br />
<br />
</div><?php } ?>
<div class="partner" id="idea">
<?php echo $row_Recordset4['content'];?>
</div>

<div class="daohang" id="idea">
<h2>��վ���·���</h2>
<?php
$query_Recordset31 = "SELECT * FROM typeclass"; //��ѯ���
$Recordset31 = mysql_query($query_Recordset31, $news) or die(mysql_error());//���ò�ѯ����ѯ��Ȼ�󽫲�ѯ�������$Recordset1������
$row_Recordset31 = mysql_fetch_assoc($Recordset31);
$totalRows_Recordset31 = mysql_num_rows($Recordset31);
?>
<ul>
<?php do { ?>
		  <li><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?type_id=<?php echo $row_Recordset31['id']; ?>">&nbsp;<?php echo $row_Recordset31['name']; ?>&nbsp;</a></li>
		  <?php } while ($row_Recordset31 = mysql_fetch_assoc($Recordset31)); ?>
</ul>
<p class="clear"></p>
</div>
<!--
<div>
<h3>����������</h3>

</div>

<div class="partner" id="idea">
<?php echo $row_Recordset_comment['content'];?>
</div>
-->

<div class="partner" id="idea">
<h2>����������</h2>
</div>


<?php

		#��������ID������
		$query_Recordset_comment = sprintf("SELECT * FROM novel_comment WHERE novel_id = %s ", GetSQLValueString($colname_Recordset4, "int"));
		$Recordset_comment = mysql_query($query_Recordset_comment, $news) or die(mysql_error());
		$row_Recordset_comment = mysql_fetch_assoc($Recordset_comment);
		$totalRows_Recordset_comment = mysql_num_rows($Recordset_comment);
?>
<?php do { ?>
<div class="daohang" id="idea">
<ul>
<li><?php echo $row_Recordset_comment['author'].":"; ?></li>
<li><p>&nbsp;<?php echo $row_Recordset_comment['content']; ?>&nbsp;</p></li>
</ul> 
<p class="clear"></p>
</div>
<?php } while ($row_Recordset_comment = mysql_fetch_assoc($Recordset_comment)); ?>

 <div class="right_side_class" id="right_side_id">
    <!--<h1>���ݹ���</h1>-->
    <form action="<?php echo $editFormAction; ?>" method="POST" name="form_comment" id="form_comment" onsubmit="MM_validateForm('news_author','','R','news_content','','R',<?php echo $row_Recordset4['id']; ?>,'','R');return document.MM_returnValue">
  <!--<p>��������ţ�</p>-->
  <table width=95% style="BORDER-COLLAPSE: collapse" borderColor=#CCF cellSpacing=0 align=center bgColor=#EEE border=1>
    
    <tr>
      <td>
        
        ���ߣ�
<label for="news_author"></label>
      <input name="news_author" type="text" id="news_author" value="��ϲ" />
	  <input name="novel_id" type="int" id="novel_id" value= <?php echo $row_Recordset4['id']; ?> />;
	  <input type="hidden" name="MM_insert" value="form_comment" />
      *</td>
    </tr>
    <tr>
      <td height="219" valign="middle" onfocus="MM_validateForm('news_author','','R','news_content','','R',<?php echo $row_Recordset4['id']; ?>,'','R');return document.MM_returnValue">�������ݣ�
        
      <textarea name="news_content" size="20" style="height:80%;width:90%;font-family:'����';color:#000" id="news_content">
      </textarea>
	  
      *</td>
    </tr>
    <tr>
      <td>
      <input type="submit" name="Submit1" id="Submit1" value="���" size="20" style="width:30%;height:100%" />
      <input type="reset" name="Submit2" id="Submit2" value="����" size="20"  style="width:30%;height:100%"  />
      ��*��Ϊ������Ŀ  
       </td>
    </tr>
  </table>
  
</form>
  </div>


<div>
<h3>��һģʽʶ�������ʾ</h3>
<p class="partner">
<a href="/ruyimoshishibie/matlab/matlabtuxiangshibie/index.php" title="matlab��ͼ�������Ӧ���и���">matlab��ͼ�������Ӧ���и���</a>
</p>
</div>


<div>
<h3>��һģʽʶ�� ��������</h3>
<p class="partner">
<a href="/ruyimoshishibie/AboutMyself.php">���ڱ�վ����</a> &nbsp;&nbsp;&nbsp; 
<a href="http://www.chinaw3c.org/">chinaw3c</a> &nbsp;&nbsp;&nbsp;
<a href="http://mozilla.com.cn/">mozilla</a>
</p>
</div>

</div>

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



<h4>���¸�����ʾ:</h4>
<p class="partner">

		<?php do { ?>
	 	  <h5><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?id=<?php echo $row_Recordset_g['id']; ?>"><?php echo $row_Recordset_g['title']."��"."Edit by[".$row_Recordset_g['author_name']."][".$row_Recordset_g['time']."]"; ?></a></h5><br />
	 	  <?php } while ($row_Recordset_g = mysql_fetch_assoc($Recordset_g)); ?>


</p>

<!-- ���λ���Ҳ���� -->

</div>


<div id="footer">
<p>��һģʽʶ���ṩ�����ݽ������Լ�ѧϰ�����ǲ���֤���ݵ���ȷ�ԡ�ͨ��ʹ�ñ�վ������֮�����ķ����뱾վ�޹ء���ʹ�ñ�վʱ���������ѽ����˱�վ��<a href="/about/about_use.asp" title="����ʹ��">ʹ������</a>��<a href="/about/about_privacy.asp" title="������˽">��˽����</a>����Ȩ���У�����һ��Ȩ������һģʽʶ�� �������İ���������ݽ������ԣ����κη������⼰���ղ��е��κ����Ρ�
<a href="http://www.miitbeian.gov.cn">���л����񹲺͹���������Ϣ����ҵ����Ϣ��ҵ�������� ԥICP��13014036��</a>
<script src="http://s22.cnzz.com/stat.php?id=5009795&web_id=5009795&online=1&show=line" language="JavaScript"></script>
<a href="admin_login.php">��¼��̨</a>
	<a href="admin_logout.php">�˳�</a>
	<a href="admin.php">��̨����</a>
	<a href="moshishibie_add.php">�������</a>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</div>

<?php
// վ��ͳ��
?>
<script type="text/javascript">
    /*������������λ0327*/
    var cpro_id = "u2937671";
</script>
<script type="text/javascript" src="http://cpro.baidustatic.com/cpro/ui/c.js"></script>

<script type="text/javascript">
    /*�ײ�����*/
    var cpro_id = "u1997290";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>

</body>

</html>

<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset4);
mysql_free_result($Recordset2);


?>