<?php ob_start();
require_once('Connections/rymssb.php');
	echo $_POST["mail"]."<br />";
	echo $_POST['username']."<br />";
	echo $_POST["password"]."<br />";

?><?php
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
?><?php

// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
//echo 'username=';


if (isset($_POST['username'])) 
{
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  	echo $loginUsername."<br />";
	echo $password."<br />";
  $loginStrGroup = "";
  $MM_fldUserAuthorization = "";
  //$MM_redirectLoginSuccess = "admin.php";
  //$MM_redirectLoginFailed = "index_ruyi.php";
  //$MM_redirectLoginSuccess = "register.php";
  //$MM_redirectLoginFailed = "register.php";
  $MM_redirectSuccess = "admin_login.php";
  
  
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_news, $news);
  $insertSQL = sprintf("INSERT INTO ruyi_user (name,password,quanxian) VALUES (%s,%s,%d)",GetSQLValueString($_POST['username'], "text"),GetSQLValueString($_POST['password'], "text"),GetSQLValueString(1, "int"));
  $Result1 = mysql_query($insertSQL, $news) or die(mysql_error());
	$to = $_POST['mail'];
	$subject ="zhaomingming.cn ��һģʽʶ��";
	$message = "�����Ʊ��ܹ���Ա�û���:".$_POST['username']."����:".$_POST['password']."������ϵ��www.zhaomingming.cn";
	$from = "1609772528@qq.com";
	$headers = "From: $from";
	$mailheaders = "Reply-To:471106585@qq.com\n\n";
	mail($to,$subject,$message,$mailhdaders);
	echo "Mail Sent.<br />";
	
	
    //exit();
	
	// $subject = "������Ϣ";

// $mailheaders = "Reply-To:13271929138@163.com\n\n";

// $email = "1609772528@qq.com";
// $text = "�����Ƿ��ܷ��ͳɹ�1";
// mail($email,$subject,$text,$mailheaders);
//header("Location: " . $MM_redirectSuccess  );
  //'SELECT * FROM `ruyi_user` WHERE `name` = CONVERT(_utf8 \'shasha\' USING gbk) COLLATE gbk_chinese_ci AND `password` = CONVERT(_utf8 \'ruyishasha\' USING gbk) COLLATE gbk_chinese_ci';
  //$LoginRS__query=sprintf("SELECT * FROM `ruyi_user` WHERE name=%s AND password=%s",GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  //$LoginRS = mysql_query($LoginRS__query, $news) or die(mysql_error()); //�����ݿ���Ч��
  //$loginFoundUser = mysql_num_rows($LoginRS);
  //if ($loginFoundUser) 
  //{
  //   $row_LoginRS = mysql_fetch_assoc($LoginRS);
  //   $loginStrGroup = $row_LoginRS['quanxian'];
  //  echo $loginStrGroup."<br />";
  //if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id(false);}
    //declare two session variables and assign them
  //  $_SESSION['MM_Username'] = $loginUsername;
  //  $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

  //  if (isset($_SESSION['PrevUrl']) && false) 
//	{
//      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
//    }
//    header("Location: " . $MM_redirectLoginSuccess );

//  }
//  else 
//  {
//    header("Location: ". $MM_redirectLoginFailed );

 // }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>����Աע��</title>
<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' �ʼ���ַ��ʽ����.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' �����������.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' ���䲻��Ϊ��.\n'; }
    } if (errors) alert('����:\n'+errors);
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
	background-color: #ccc;
	float: top;
	height: 50px;
	width: 100%;
	float: left;
	position: relative;
	font-size: 14px;
	color: #ffF;
	font-weight: normal;
	text-decoration: underline;
	page-break-before: always;
	cursor: text;
	filter: Chroma(Color=#00ff00);
	page-break-after: always;
	text-align: center;
}
.daohang_class {
	background-color: #bbb;
	text-align: center;
	color: #FFF;
	float: left;
	width: 100%;
	position: relative;
}
#left_side_id {
	background-color: #bbb;
	text-align: right;
	width: 38%;
	position: relative;
	float: left;
}
#right_side_id {
	text-align: left;
	float: left;
	width: 62%;
	background-color: #bbb;
	position: relative;
}
body {
	background-color: #CCC;
}
</style>
</head>

<body>
<div class="body_class" id="body_id">
  <div class="head_class" id="head_id"><h1>ע��</h1></div>
  <div class="daohang_class" id="`daohang_id">
    <p>ע�����Ա�û�</p>
    <form action="<?php echo $loginFormAction; ?>" method="POST" name="form1" id="form1" onsubmit="MM_validateForm('username','','R','password','','R','repassword','','R','mail','','isEmail','mail','','R');return document.MM_returnValue">
  <table width=95% style="BORDER-COLLAPSE: collapse" borderColor=#bbb cellSpacing=0 align=center bgColor=#eee border=2> 
    <tr>
      <th colspan="2">��һģʽʶ���̨��������</th>
    </tr>
    <tr>
      <td width="335" align="right">�ʺţ�</td>
      <td width="447"><label for="username"></label>
      <input type="" name="username" id="username" /></td>
    </tr>
    <tr>
      <td align="right">���룺</td>
      <td><label for="password"></label>
      <input type="password" name="password" id="password" /></td>
    </tr>
	<tr>
      <td align="right">����ȷ�ϣ�</td>
      <td><label for="repassword"></label>
      <input type="password" name="repassword" id="repassword" /></td>
    </tr>
	<tr>
      <td align="right">����(����ע����Ϣ��)</td>
      <td><label for="mail"></label>
      <input type="" name="mail" id="mail" /></td>
    </tr>
    <tr align="center" valign="middle">
      <td colspan="2"><input type="submit" name="Submit1" id="Submit1" value="ע��" />
      <input type="reset" name="Submit2" id="Submit2" value="����" /></td>
    </tr>
  </table>
</form>

  
  <div>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;</p></div>
</div>

</body>
</html>