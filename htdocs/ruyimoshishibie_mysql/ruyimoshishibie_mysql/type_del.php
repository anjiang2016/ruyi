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

$MM_restrictGoTo = "index.php";
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
echo $_GET['type_id'];
if ((isset($_GET['type_id'])) && ($_GET['type_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM typeclass WHERE id=%s",
                       GetSQLValueString($_GET['type_id'], "int"));

  mysql_select_db($database_news, $news);
  $Result1 = mysql_query($deleteSQL, $news) or die(mysql_error());

  $deleteGoTo = "admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['type_id'])) {
  $colname_Recordset1 = $_GET['type_id'];
}
mysql_select_db($database_news, $news);
$query_Recordset1 = sprintf("SELECT * FROM typeclass WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
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
	background-color: #ccC;
	float: top;
	height: 50px;
	width: 100%;
	float: left;
	position: relative;
	font-size: 14px;
	color: #CCC;
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
	width: 62%;
	position: relative;
	float: left;
}
#right_side_id {
	text-align: left;
	float: left;
	width: 38%;
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
    <p><a href="admin_logout.php"> 退出后台</a></p>
  </div>
  <div class="left_side_class" id="left_side_id">
  <h1>类型管理</h1>
 <table width="398" border="1" align="center">
  <tr>
    <td colspan="3">管理员你好，你要删除这个新闻分类么？</td>
  </tr>
<tr>
    <td width="29">分类</td>
    <td width="353" colspan="2"><?php echo $row_Recordset1['name']; ?></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><form id="form1" name="form1" method="post" action="">
      <input type="submit" name="del" id="del" value="删除" />
      <input type="submit" name="re" id="re" value="重置" />
    </form></td>
  </tr>
</table>
  </div>
  <div class="right_side_class" id="right_side_id">
    <h1>内容管理</h1>
    
  </div>
  
  <div>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;</p></div>
</div>
<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
