<?php 
ob_start();
require_once('Connections/rymssb.php');
?>

<?php

// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
echo 'username=';
echo $_POST['username'];
echo "0";

if (isset($_POST['username'])) 
{
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $loginStrGroup = "";
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "admin.php";
  $MM_redirectLoginFailed = "index_ruyi.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_news, $news);
  //'SELECT * FROM `ruyi_user` WHERE `name` = CONVERT(_utf8 \'shasha\' USING gbk) COLLATE gbk_chinese_ci AND `password` = CONVERT(_utf8 \'ruyishasha\' USING gbk) COLLATE gbk_chinese_ci';
  $LoginRS__query=sprintf("SELECT * FROM `ruyi_user` WHERE name=%s AND password=%s",GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $news) or die(mysql_error()); //从数据库中效验
  $loginFoundUser = mysql_num_rows($LoginRS);
  
  
  echo 'username=';
  echo $loginUsername.'<br/>';
  echo 'username=';
  echo $password.'<br/>';
  echo $loginFoundUser;
 
  if ($loginFoundUser) 
  {
     $row_LoginRS = mysql_fetch_assoc($LoginRS);
     $loginStrGroup = $row_LoginRS['quanxian'];
    echo "quanxian=";
	echo $loginStrGroup."<br />"; 
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id(false);}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) 
	{
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
	echo "success location:";
	echo $MM_redirectLoginSuccess;
	echo '<br />';
	echo $_SESSION['MM_Username'];
	echo '<br />';
	//exit(); //调试语句，如果登陆了，程序执行到这里就退出
	
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else 
  {
    header("Location: ". $MM_redirectLoginFailed );
  }
  

}
else{
	
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>如一模式识别后台管理登录</title>
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
  <div class="head_class" id="head_id"><h1>后台管理系统</h1></div>
  <div class="daohang_class" id="`daohang_id">
    <p>后台登录窗口</p>
    <form action="<?php echo $loginFormAction; ?>" method="POST" name="form1" id="form1" onsubmit="MM_validateForm('username','','R','password','','R');return document.MM_returnValue">
  <table width=95% style="BORDER-COLLAPSE: collapse" borderColor=#bbb cellSpacing=0 align=center bgColor=#eee border=2> 
    <tr>
      <th colspan="2">如一模式识别后台管理中心</th>
    </tr>
    <tr>
      <td width="335" align="right">帐号：</td>
      <td width="447"><label for="username"></label>
      <input type="text" name="username" id="username" /></td>
    </tr>
    <tr>
      <td align="right">密码：</td>
      <td><label for="password"></label>
      <input type="password" name="password" id="password" /></td>
    </tr>
    <tr align="center" valign="middle">
      <td colspan="2"><input type="submit" name="Submit1" id="Submit1" value="登录" />
      <input type="reset" name="Submit2" id="Submit2" value="重置" /></td>
    </tr>
  </table>
</form>

  
  <div>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;</p></div>
</div>

</body>
</html>