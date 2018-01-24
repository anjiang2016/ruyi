<?php ob_start();require_once('Connections/rymssb.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}


//echo "传递的session变量var1的值为：".$_SESSION['MM_Username']."<br />";
//echo "传递的session变量var1的值为：".$_SESSION['MM_UserGroup']."<br />";
if(!empty($_SESSION['MM_UserGroup'])&&!empty($_SESSION['MM_Username'])){
 //echo "MM_UserGroup非空<br />";
}else{
  //echo "MM_UserGroup空<br />";
}
$keyword = $_POST[keyword];
mysql_select_db($database_news, $news);//选择数据库
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


//*********************留言表格响应区*********************//

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
/*<!--$inserttxt="insert into newstext(news_title,news_type,news_content,news_data,news_author) values('椤圭洰鏂伴椈4','4','椤圭洰鏂伴椈1鐨勫唴瀹?,'4999/03/05','浣滆�咃細璧垫槑鏄?);";
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

//暂停 10 秒
//sleep(100);
 //  exit(); 执行到此举，停止，此句用于调试
//重新开始
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
    # 如果有id
	if (isset($_GET['id'])) {
		$colname_Recordset4 = $_GET['id'];
	#	mysql_select_db($database_news, $news);//选择数据库
	    #依据ID查文章
		$query_Recordset4 = sprintf("SELECT * FROM novel WHERE id = %s ", GetSQLValueString($colname_Recordset4, "int"));
		$Recordset4 = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset4 = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset4 = mysql_num_rows($Recordset4);
		
		#依据文章ID查评论
		$query_Recordset_comment = sprintf("SELECT * FROM novel_comment WHERE novel_id = %s ", GetSQLValueString($colname_Recordset4, "int"));
		$Recordset_comment = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset_comment = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset_comment = mysql_num_rows($Recordset4);
		
		
		
		
		$colname_Recordset1 = $row_Recordset4['type_id'];
		#依据type_id文章类型来查文章，降序，查20篇
		$query_Recordset1 = sprintf("SELECT * FROM novel WHERE type_id = %s ORDER BY id DESC LIMIT 20", GetSQLValueString($colname_Recordset1, "int"));
		$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
		$row_Recordset1 = mysql_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($Recordset1);
		
		$colname_Recordset2 = $row_Recordset4['type_id'];
		#查询所有id
		$query_Recordset2 = sprintf("SELECT * FROM typeclass WHERE id = %s", GetSQLValueString($colname_Recordset2, "int"));
		$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
		
		
		
	}
	# 如果有type_id
	else if(isset($_GET['type_id'])){
		$colname_Recordset1 = $_GET['type_id'];
		$query_Recordset1 = sprintf("SELECT * FROM novel WHERE type_id = %s ORDER BY id DESC LIMIT 20", GetSQLValueString($colname_Recordset1, "int"));
		$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
		$row_Recordset1 = mysql_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($Recordset1);
		
		$colname_Recordset4 = $_GET['type_id'];
	#	mysql_select_db($database_news, $news);//选择数据库
		$query_Recordset4 = sprintf("SELECT * FROM novel WHERE type_id = %s ", GetSQLValueString($colname_Recordset4, "int"));
		$Recordset4 = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset4 = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset4 = mysql_num_rows($Recordset4);
		
		$colname_Recordset2 = $_GET['type_id'];
		$query_Recordset2 = sprintf("SELECT * FROM typeclass WHERE id = %s", GetSQLValueString($colname_Recordset2, "int"));
		$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
	}
	else{
		$colname_Recordset1 = 1;
		$query_Recordset1 = sprintf("SELECT * FROM novel WHERE type_id = %s ORDER BY id DESC LIMIT 20", GetSQLValueString($colname_Recordset1, "int"));
		$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
		$row_Recordset1 = mysql_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($Recordset1);
		
		$colname_Recordset4 = 1;
		mysql_select_db($database_news, $news);//选择数据库
		$query_Recordset4 = sprintf("SELECT * FROM novel WHERE type_id = %s ", GetSQLValueString($colname_Recordset4, "int"));
		$Recordset4 = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset4 = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset4 = mysql_num_rows($Recordset4);
		
		$colname_Recordset2 = $row_Recordset4['type_id'];
		$query_Recordset2 = sprintf("SELECT * FROM typeclass WHERE id = %s", GetSQLValueString($colname_Recordset2, "int"));
		$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
	}
}
else
{
	if (isset($_GET['id'])) {
		$colname_Recordset4 = $_GET['id'];
	#	mysql_select_db($database_news, $news);//选择数据库
		$query_Recordset4 = sprintf("SELECT * FROM novel WHERE id = %s  AND author_name = %s ORDER BY id DESC LIMIT 20", GetSQLValueString($colname_Recordset4, "int"),GetSQLValueString($_SESSION['MM_Username'], "text"));
		$Recordset4 = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset4 = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset4 = mysql_num_rows($Recordset4);
		
		
		
		$colname_Recordset1 = $row_Recordset4['type_id'];
		$query_Recordset1 = sprintf("SELECT * FROM novel WHERE type_id = %s AND author_name = %s ", GetSQLValueString($colname_Recordset1, "int"),GetSQLValueString($_SESSION['MM_Username'], "text"));
		$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
		$row_Recordset1 = mysql_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($Recordset1);
		
		$colname_Recordset2 = $row_Recordset4['type_id'];
		$query_Recordset2 = sprintf("SELECT * FROM typeclass WHERE id = %s ", GetSQLValueString($colname_Recordset2, "int"));
		$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
		
		
		
	}
	else if(isset($_GET['type_id'])){
		$colname_Recordset1 = $_GET['type_id'];
		$query_Recordset1 = sprintf("SELECT * FROM novel WHERE type_id = %s AND author_name = %s ORDER BY id DESC LIMIT 20", GetSQLValueString($colname_Recordset1, "int"),GetSQLValueString($_SESSION['MM_Username'], "text"));
		$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
		$row_Recordset1 = mysql_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($Recordset1);
		
		$colname_Recordset4 = $_GET['type_id'];
	#	mysql_select_db($database_news, $news);//选择数据库
		$query_Recordset4 = sprintf("SELECT * FROM novel WHERE type_id = %s AND author_name = %s", GetSQLValueString($colname_Recordset4, "int"),GetSQLValueString($_SESSION['MM_Username'], "text"));
		$Recordset4 = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset4 = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset4 = mysql_num_rows($Recordset4);
		
		$colname_Recordset2 = $_GET['type_id'];
		$query_Recordset2 = sprintf("SELECT * FROM typeclass WHERE id = %s", GetSQLValueString($colname_Recordset2, "int"));
		$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
	}
	else{
		$colname_Recordset1 = 1;
		$query_Recordset1 = sprintf("SELECT * FROM novel WHERE type_id = %s AND author_name = %s ORDER BY id DESC LIMIT 20", GetSQLValueString($colname_Recordset1, "int"),GetSQLValueString($_SESSION['MM_Username'], "text"));
		$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
		$row_Recordset1 = mysql_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($Recordset1);
		
		$colname_Recordset4 = 1;
		mysql_select_db($database_news, $news);//选择数据库
		$query_Recordset4 = sprintf("SELECT * FROM novel WHERE type_id = %s AND author_name = %s", GetSQLValueString($colname_Recordset4, "int"),GetSQLValueString($_SESSION['MM_Username'], "text"));
		$Recordset4 = mysql_query($query_Recordset4, $news) or die(mysql_error());
		$row_Recordset4 = mysql_fetch_assoc($Recordset4);
		$totalRows_Recordset4 = mysql_num_rows($Recordset4);
		
		$colname_Recordset2 = $row_Recordset4['type_id'];
		$query_Recordset2 = sprintf("SELECT * FROM typeclass WHERE id = %s", GetSQLValueString($colname_Recordset2, "int"));
		$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
	}
}

$colname_Recordset10 = 1;
$query_Recordset10= sprintf("SELECT * FROM novel ORDER BY id DESC");
$Recordset10 = mysql_query($query_Recordset10, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
$row_Recordset10 = mysql_fetch_assoc($Recordset10);
$totalRows_Recordset10 = mysql_num_rows($Recordset10);

$query_Recordset_g = "SELECT * FROM novel ORDER BY id DESC LIMIT 10"; //查询语句
$Recordset_g = mysql_query($query_Recordset_g, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
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

.contentA a{text-align:center;height:30px;}
.contentA a:link{color:#000;background:url(arrow_off.gif) #CCC no-repeat 5px 12px;text-decoration:none;}
.contentA a:visited{color:#000;text-decoration:underline;}
.contentA a:hover{color:#FFF; font-weight:bold;text-decoration:none;background:url(arrow_on.gif) #0af no-repeat 5px 12px;}

</style>-->
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
<script type="text/javascript" src="jquery-1.4.js"></script>

<script type="text/javascript"> 

//获取get参数函数
//使用历程
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
     // 自动加载程序，这里需要优化，
     //alert("有效");
	var winH = $(window).height(); //页面可视区域高度 
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
		var scrollT = $(window).scrollTop(); //滚动条top 
		var scrollB = scrollT+winH; //滚动条bottom 
		
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
						//$(".nodata").show().html("别滚动了，已经到底了。。。"); 
						$("#navsecond ul").append("<li><h2><a >已经到最后一篇</a></h2></li>"); 
					}
					return false; 
				} 
			});  
			//alert("别滚动了，已经到底了。。。"+i);
			//$("#navsecond ul").append("<li><h2><a href=\"content_ruyi.php?id=array['id']\">aa<0.02</a></h2></li>"); 
		} 
	}); 
});
*/

/*
*滚动条滑动，位置不变的DIV层
*div_id：DIV的ID属性值，必填参数
*offsetTop：滚动条滑动时DIV层距顶部的高度，可选参数
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
    /*主题链接代码位0327*/
    var cpro_id = "u2937649";
</script>
<script type="text/javascript" src="http://cpro.baidustatic.com/cpro/ui/c.js"></script>

<div  id="guding">
<!--<p>固定在此了</p>-->
</div>
<div id="wrapper">


<div id="header_index"><h1><a href="index_ruyi.php" title="如一模式识别研究">如一模式识别研究</a></h1></div>

<div id="navfirst">
<ul id="menu">
<?php if($_SESSION['MM_UserGroup']==0){ ?>
<li id="h"><a href="content_ruyi.php?type_id=3" title="基本数学知识">基本数学知识</a></li>
<li id="x"><a href="content_ruyi.php?type_id=1" title="语音识别研究">语音识别研</a></li>
<li id="b"><a href="content_ruyi.php?type_id=2" title="图像识别研究">图像识别研究</a></li>
<li id="w"><a href="AboutMyself.php" title="关于">关于</a></li>
<?php }elseif($_SESSION['MM_UserGroup']==1){ ?>
<li id="h"><a href="" title="基本数学知识">基本数学知识</a></li>
<li id="x"><a href="" title="语音识别研究">语音识别研</a></li>
<li id="b"><a href="" title="图像识别研究">图像识别研究</a></li>
<li id="w"><a href="AboutMyself.php" title="关于">关于</a></li>
<?php } ?>
</ul>
</div>

<div id="navsecond"> <!--类内文章列表-->
	<ul>
	<li><h2><a href="http://www.zhaomingming.cn">回首页</a></h2></li>
		<?php do { ?>
		  <li><h2><a href="content_ruyi.php?id=<?php echo $row_Recordset1['id']; ?>"><?php echo $row_Recordset1['title']; ?></a></h2></li>
		  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </ul>
    
	<h2 id="aboutRUYI"><a href="/ruyimoshishibie/about/index.asp" title="关于 如一模式识别" id="link_about">关于 如一模式识别</a></h2>
	<h2><a href="/ruyimoshishibie/about/about_helping.asp" title="帮助 如一模式识别" id="link_help">帮助 如一模式识别</a></h2>
    
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



<h2><?php echo "编辑：".$row_Recordset4['author_name']; ?></h2>
<h2><?php echo "时间：".$row_Recordset4['time']; ?></h2>
<ul>
		  <li><a href="">&nbsp;&nbsp;&nbsp;</a></li>
		  <li><a href="moshishibie_add.php?id=<?php echo $Rows_Recordset10['id']+1; ?>">&nbsp;添加&nbsp;</a></li>
		  <li><a href="moshishibie_upd.php?id=<?php echo $row_Recordset4['id']; ?>">&nbsp;修改&nbsp;</a></li>
		  <?php if($_SESSION['MM_UserGroup']==0&&!empty($_SESSION['MM_Username'])){?>
		  <li><a href="moshishibie_del.php?id=<?php echo $row_Recordset4['id']; ?>">&nbsp;删除&nbsp;</a></li>
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
<h2>本站文章分类</h2>
<?php
$query_Recordset31 = "SELECT * FROM typeclass"; //查询语句
$Recordset31 = mysql_query($query_Recordset31, $news) or die(mysql_error());//利用查询语句查询，然后将查询结果放入$Recordset1变量中
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
<h3>评论留言区</h3>

</div>

<div class="partner" id="idea">
<?php echo $row_Recordset_comment['content'];?>
</div>
-->

<div class="partner" id="idea">
<h2>评论留言区</h2>
</div>


<?php

		#依据文章ID查评论
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
    <!--<h1>内容管理</h1>-->
    <form action="<?php echo $editFormAction; ?>" method="POST" name="form_comment" id="form_comment" onsubmit="MM_validateForm('news_author','','R','news_content','','R',<?php echo $row_Recordset4['id']; ?>,'','R');return document.MM_returnValue">
  <!--<p>请添加新闻：</p>-->
  <table width=95% style="BORDER-COLLAPSE: collapse" borderColor=#CCF cellSpacing=0 align=center bgColor=#EEE border=1>
    
    <tr>
      <td>
        
        作者：
<label for="news_author"></label>
      <input name="news_author" type="text" id="news_author" value="安喜" />
	  <input name="novel_id" type="int" id="novel_id" value= <?php echo $row_Recordset4['id']; ?> />;
	  <input type="hidden" name="MM_insert" value="form_comment" />
      *</td>
    </tr>
    <tr>
      <td height="219" valign="middle" onfocus="MM_validateForm('news_author','','R','news_content','','R',<?php echo $row_Recordset4['id']; ?>,'','R');return document.MM_returnValue">评论内容：
        
      <textarea name="news_content" size="20" style="height:80%;width:90%;font-family:'黑体';color:#000" id="news_content">
      </textarea>
	  
      *</td>
    </tr>
    <tr>
      <td>
      <input type="submit" name="Submit1" id="Submit1" value="添加" size="20" style="width:30%;height:100%" />
      <input type="reset" name="Submit2" id="Submit2" value="重置" size="20"  style="width:30%;height:100%"  />
      带*号为必填项目  
       </td>
    </tr>
  </table>
  
</form>
  </div>


<div>
<h3>如一模式识别更新提示</h3>
<p class="partner">
<a href="/ruyimoshishibie/matlab/matlabtuxiangshibie/index.php" title="matlab在图像处理方面的应用有更新">matlab在图像处理方面的应用有更新</a>
</p>
</div>


<div>
<h3>如一模式识别 友情链接</h3>
<p class="partner">
<a href="/ruyimoshishibie/AboutMyself.php">关于本站作者</a> &nbsp;&nbsp;&nbsp; 
<a href="http://www.chinaw3c.org/">chinaw3c</a> &nbsp;&nbsp;&nbsp;
<a href="http://mozilla.com.cn/">mozilla</a>
</p>
</div>

</div>

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



<h4>文章更新提示:</h4>
<p class="partner">

		<?php do { ?>
	 	  <h5><a href="/ruyimoshishibie_mysql/ruyimoshishibie_mysql/content_ruyi.php?id=<?php echo $row_Recordset_g['id']; ?>"><?php echo $row_Recordset_g['title']."。"."Edit by[".$row_Recordset_g['author_name']."][".$row_Recordset_g['time']."]"; ?></a></h5><br />
	 	  <?php } while ($row_Recordset_g = mysql_fetch_assoc($Recordset_g)); ?>


</p>

<!-- 广告位：右侧边栏 -->

</div>


<div id="footer">
<p>如一模式识别提供的内容仅用于自己学习。我们不保证内容的正确性。通过使用本站内容随之而来的风险与本站无关。当使用本站时，代表您已接受了本站的<a href="/about/about_use.asp" title="关于使用">使用条款</a>和<a href="/about/about_privacy.asp" title="关于隐私">隐私条款</a>。版权所有，保留一切权利。如一模式识别 简体中文版的所有内容仅供测试，对任何法律问题及风险不承担任何责任。
<a href="http://www.miitbeian.gov.cn">《中华人民共和国电信与信息服务业务》信息产业部备案号 豫ICP备13014036号</a>
<script src="http://s22.cnzz.com/stat.php?id=5009795&web_id=5009795&online=1&show=line" language="JavaScript"></script>
<a href="admin_login.php">登录后台</a>
	<a href="admin_logout.php">退出</a>
	<a href="admin.php">后台管理</a>
	<a href="moshishibie_add.php">添加文章</a>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</div>

<?php
// 站长统计
?>
<script type="text/javascript">
    /*主题悬浮代码位0327*/
    var cpro_id = "u2937671";
</script>
<script type="text/javascript" src="http://cpro.baidustatic.com/cpro/ui/c.js"></script>

<script type="text/javascript">
    /*底部超宽*/
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