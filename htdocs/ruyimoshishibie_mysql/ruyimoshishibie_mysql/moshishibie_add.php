<?php ob_start();require_once('Connections/rymssb.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 

  return $isValid; 
}

$MM_restrictGoTo = "index_ruyi.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
/*<!--$inserttxt="insert into newstext(news_title,news_type,news_content,news_data,news_author) values('椤圭洰鏂伴椈4','4','椤圭洰鏂伴椈1鐨勫唴瀹?,'4999/03/05','浣滆�咃細璧垫槑鏄?);";
mysql_select_db($database_news, $news);
  $Result1 = mysql_query($inserttxt, $news) or die(mysql_error());-->*/
echo isset($_POST["MM_insert"]);
echo $_POST["MM_insert"];
 //date_defualt_timezone_set('Asiz/Shanghai');
  echo date("Y-m-d");
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  //$news_context_html=nl2br(addslashes($news_context));
  //$news_context_html=str_replace("\n","<br />",$news_context); 
 // $news_context_html = ereg_replace("\n", "<BR>\n", $news_context);
  $insertSQL = sprintf("INSERT INTO novel (title,content, time,type_id) VALUES (%s, %s, %s,%d)",
                  
                       GetSQLValueString($_POST['news_title'], "text"),
                      
                  
					   GetSQLValueString(nl2br($_POST['news_content']), "text"),
					   
                       GetSQLValueString($_POST['news_data'], "date"),
					   GetSQLValueString($_POST['news_type'], "int")
					   );
                

  mysql_select_db($database_news, $news);
  $Result1 = mysql_query($insertSQL, $news) or die(mysql_error());

  $insertGoTo = "admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
   $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
  //exit();
  ob_end_flush();
}


mysql_select_db($database_news, $news);
$query_Recordset1 = "SELECT * FROM novel";
$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_news, $news);
$query_Recordset2 = "SELECT * FROM typeclass";
$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>添加新闻</title>
<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>
<style type="text/css">
#body_id {
	background-color: #CCC;
	float: none;
	width: 800px;
	top: 10px;
	right: 100px;
	margin:auto;
}
#head_id {
	background-color: #CCC;
	float: top;
	height: 50px;
	width: 100%;
	float: left;
	position: relative;
	font-size: 14px;
	color: #FFF;
	font-weight: normal;
	text-decoration: underline;
	page-break-before: always;
	cursor: text;
	filter: Chroma(Color=#00ff00);
	page-break-after: always;
	text-align: center;
}
.daohang_class {
	background-color: #BBB;
	text-align: center;
	color: #FFF;
	float: left;
	width: 100%;
	position: relative;
}
#left_side_id {
	background-color: #FFF;
	text-align: right;
	width: 0%;
	position: relative;
	float: left;
}
#right_side_id {
	text-align: left;
	float: left;
	width: 100%;
	background-color: #BBB;
	position: relative;
	opacity: 0.8;
}
body {
	background-color: #CCC;
	
}
</style>

<script type="text/javascript" src="/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="/xheditor-1.2.2.min.js"></script>
<script type="text/javascript" charset="gb2312" src="/xheditor_lang/zh-cn.js"></script>
<script type="text/javascript">
var editor;
$(pageInit);
function pageInit()
{
	var allPlugin={
		subscript:{c:'testClassName',t:'下标:调用execCommand(subscript)'},
		superscript:{c:'testClassName',t:'上标:调用execCommand(superscript)'},
		test1:{c:'testClassName',t:'测试1：加粗 (Ctrl+1)',s:'ctrl+1',e:function(){
			this._exec('Bold');
		}},
		test2:{c:'testClassName',t:'测试2：普通对话框 (Ctrl+2)',s:'ctrl+2',h:1,e:function(){
			var _this=this;
			var jTest=$('<div>测试showDialog</div><div><label for="xheImgUrl">图片文件: </label><input type="text" id="xheImgUrl" value="http://" class="xheText" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="确定" /></div>');
			var jUrl=$('#xheImgUrl',jTest),jSave=$('#xheSave',jTest);
			_this.uploadInit(jUrl,'upload.php','jpg,gif,png');
			jSave.click(function(){
				_this.loadBookmark();
				_this.pasteHTML(jUrl.val());
				_this.hidePanel();
				return false;	
			});
			_this.saveBookmark();
			_this.showDialog(jTest);
		}},
		test3:{c:'testClassName',t:'测试3：需要转移焦点的对话框 (Ctrl+3)',s:'ctrl+3',h:1,e:function(){
			var _this=this;
			var jTest=$('<div>测试需要转移焦点的showDialog</div><div><textarea id="xheTestInput" style="width:260px;height:100px;">当互动界面中有input或者textarea等会产生焦点的表单项时，必需在插入内容前用loadBookmark函数加载之前保存的光标焦点。</textarea></div><div style="text-align:right;"><input type="button" id="xheSave" value="确定" /></div>');
			var jTestInput=$('#xheTestInput',jTest),jSave=$('#xheSave',jTest);
			jSave.click(function(){
				_this.loadBookmark();
				_this.pasteText('您输入了：'+jTestInput.val());
				_this.hidePanel();
				return false;	
			});
			_this.saveBookmark();
			_this.showDialog(jTest);
		}},
		test4:{c:'testClassName',t:'测试4：面板界面 (Ctrl+4)',s:'ctrl+4',h:1,e:function(){
			var _this=this;
			var jTest=$('<div style="padding:5px;">测试showPanel</div>');
			_this.showPanel(jTest);
		}},
		test5:{c:'testClassName',t:'测试5：菜单调用 (Ctrl+5)',s:'ctrl+5',h:1,e:function(){
			var _this=this;
			var arrMenu=[{s:'菜单1',v:'menu1',t:'这是菜单1'},{s:'菜单2',v:'menu2',t:'这是菜单2'},{s:'菜单3',v:'menu3',t:'这是菜单3'}];
			_this.saveBookmark();
			_this.showMenu(arrMenu,function(v){_this.pasteHTML(v);});
		}},
		test6:{c:'testClassName',t:'测试6：showModal (Ctrl+6)',s:'ctrl+6',e:function(){
			var _this=this;
			_this.saveBookmark();
			_this.showModal('测试showModal接口','<div style="padding:5px;">模式窗口主体内容</div>',500,300);
		}},
		test7:{c:'testClassName',t:'测试7：showIframeModal (Ctrl+7)',s:'ctrl+7',e:function(){
			var _this=this;
			_this.saveBookmark();
			_this.showIframeModal('测试showIframeModal接口','uploadgui.php',function(v){_this.loadBookmark();_this.pasteText('返回值：\r\n'+v);},500,300);
		}},
		Code:{c:'btnCode',t:'插入代码',h:1,e:function(){
			var _this=this;
			var htmlCode='<div><select id="xheCodeType"><option value="html">HTML/XML</option><option value="js">Javascript</option><option value="css">CSS</option><option value="php">PHP</option><option value="java">Java</option><option value="py">Python</option><option value="pl">Perl</option><option value="rb">Ruby</option><option value="cs">C#</option><option value="c">C++/C</option><option value="vb">VB/ASP</option><option value="">其它</option></select></div><div><textarea id="xheCodeValue" wrap="soft" spellcheck="false" style="width:300px;height:100px;" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="确定" /></div>';			var jCode=$(htmlCode),jType=$('#xheCodeType',jCode),jValue=$('#xheCodeValue',jCode),jSave=$('#xheSave',jCode);
			jSave.click(function(){
				_this.loadBookmark();
				_this.pasteHTML('<pre class="prettyprint lang-'+jType.val()+'">'+_this.domEncode(jValue.val())+'</pre>');
				_this.hidePanel();
				return false;	
			});
			_this.saveBookmark();
			_this.showDialog(jCode);
		}}
	};
	editor=$('#news_content').xheditor({plugins:allPlugin,tools:'Cut,Copy,Paste,Pastetext,Blocktag,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,SelectAll,Removeformat,Align,List,Outdent,Indent,Link,Unlink,Anchor,Img,Flash,Media,Hr,Emot,Table,Code,|,Source,Fullscreen,About',loadCSS:'<style>pre{margin-left:2em;border-left:3px solid #CCC;padding:0 1em;}</style>',shortcuts:{'ctrl+enter':submitForm}});

}
function submitForm(){$('#frmDemo').submit();}
</script>
</head>

<body>
<div class="body_class" id="body_id">
  <div class="head_class" id="head_id"><h1>如一模式识别后台管理系统</h1></div>
  <div class="daohang_class" id="`daohang_id">
    <p><a href="admin_logout.php"> 退出后台</a></p>
  </div>
  <div class="left_side_class" id="left_side_id">
  <h1></h1>
 
  </div>
  <div class="right_side_class" id="right_side_id">
    <h1>内容管理</h1>
    <form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1" onsubmit="MM_validateForm('news_title','','R','new_author','','R','news_content','','R');return document.MM_returnValue">
  <p>请添加新闻：</p>
  <table width=95% style="BORDER-COLLAPSE: collapse" borderColor=#CCF cellSpacing=0 align=center bgColor=#EEE border=1>
    <tr>
      <td>新闻标题：
        <label for="news_title"></label>
        <input type="hidden" name="MM_insert" value="form1" />
        <input type="hidden" name="news_data" id="news_data2" value="<?php  echo date("Y-m-d");?>" />
      <input name="news_title" type="text" id="news_title" value="新添加新闻" />
      *</td>
    </tr>
    <tr>
      <td>新闻分类：
        <label for="news_type"></label>
        <select name="news_type" id="news_type">
          <?php
              do{  
          ?>
          <option value="<?php echo $row_Recordset2['id']?>"<?php if (!(strcmp($row_Recordset1['type_id'], $row_Recordset1['type_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset2['name']?></option>
          <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
        </select>
        作者：
<label for="news_author"></label>
      <input name="news_author" type="text" id="news_author" value="安喜" />
      *</td>
    </tr>
    <tr>
      <td height="219" valign="middle" onfocus="MM_validateForm('news_title','','R','news_author','','R','news_id','','RisNum','news_content','','R');return document.MM_returnValue">新闻内容：
        <label for="news_content"></label>
		<select name="select" id=fontslt onChange=NYSfont()> 
		<option selected>选择字体
		<script language=javascript>
		for (i=9;i<200;i++) 
		{
		    document.write("<option value="+i+">"+i+"号大小\n");
		} 
		function NYSfont() 
		{
			 if((fontslt.selectedIndex!=-1)&(fontslt.selectedIndex!=0))
			 {
				 news_content.style.fontSize=fontslt.options[fontslt.selectedIndex].value;
			 }
		}
		</script> 
		</option> 
		</select> 
      <textarea name="news_content" size="20" style="height:600;width:90%;font-family:'楷体';color:#F00" id="news_content">
      </textarea>
	  
      *</td>
    </tr>
    <tr>
      <td>
      <input type="submit" name="Submit1" id="Submit1" value="添加" size="20" style="width:30%;height:30px" />
      <input type="reset" name="Submit2" id="Submit2" value="重置" size="20"  style="width:30%;height:30px"  />
      带*号为必填项目  
       </td>
    </tr>
  </table>
  
</form>
  </div>
  
  <div>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;</p></div>
</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);

?>
