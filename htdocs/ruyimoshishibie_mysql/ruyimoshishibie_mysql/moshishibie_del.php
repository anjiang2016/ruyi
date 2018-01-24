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

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM novel WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_news, $news);
  $Result1 = mysql_query($deleteSQL, $news) or die(mysql_error());

  $deleteGoTo="admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_news, $news);
$query_Recordset1 = sprintf("SELECT * FROM novel WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $news) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

mysql_select_db($database_news, $news);
$query_Recordset2 = "SELECT * FROM typeclass";
$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
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
	background-color: #06C;
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
	background-color: #F90;
	text-align: center;
	color: #FFF;
	float: left;
	width: 100%;
	position: relative;
}
#left_side_id {
	background-color: #FC0;
	text-align: right;
	width: 38%;
	position: relative;
	float: left;
}
#right_side_id {
	text-align: left;
	float: left;
	width: 62%;
	background-color: #69F;
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
 
  </div>
  <div class="right_side_class" id="right_side_id">
    <h1>内容管理</h1>
    
  </div>
  
  <div>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;</p></div>
</div>
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="post">
  <p>管理员你好，您要删除此新闻么？</p>
  <table width="716" border="1">
    <tr>
      <td width="74">新闻标题</td>
      <td width="626"><label for="news_title"></label>
      <input type="hidden" name="MM_update" value="form1" />
        <input name="news_title" type="text" id="news_title" value="<?php echo $row_Recordset1['title']; ?>" /></td>
    </tr>
    <tr>
      <td>更新时间</td>
      <td><label for="news_data"></label>
        <input type="text" name="news_data" id="news_data" value = "<?php echo date('Y-m-d'); ?>"/></td>
    </tr>
    <tr>
      <td>新闻分类</td>
      <td><label for="news_type"></label>
        <select name="news_type" id="news_type">
          <?php
do {  
?>
          <option value="<?php echo $row_Recordset2['id']?>"<?php if (!(strcmp($row_Recordset2['id'], $row_Recordset2['id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset2['name']?></option>
          <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
        </select>
        作者：
        <label for="news_author"></label>
        <input name="news_author" type="text" id="news_author" value="<?php echo $row_Recordset1['news_author']; ?>" />
        id:
        <label for="news_id"></label>
        <input name="news_id" type="text" id="news_id" value="<?php echo $row_Recordset1['id']; ?>" /></td>
    </tr>
    <tr>
      <td height="221">新闻内容</td>
      <td><label for="news_content"></label>
        <textarea name="news_content" id="news_content" cols="60" rows="20
      "><?php echo $row_Recordset1['content']; ?></textarea></td>
    </tr>
    <tr>
      <td height="25" colspan="2" align="center"><input type="submit" name="refresh" id="refresh" value="删除" />
      <input type="reset" name="reset" id="reset" value="重置" /></td>
    </tr>
  </table>
  
</form>
</body>
</html>
<?php
mysql_free_result($Recordset2);

mysql_free_result($Recordset1);
?>
