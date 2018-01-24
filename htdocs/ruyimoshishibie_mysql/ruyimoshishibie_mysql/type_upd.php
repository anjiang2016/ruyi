<?php ob_start();require_once('Connections/rymssb.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE typeclass SET name=%s WHERE id=%s",
                       GetSQLValueString($_POST['type_name'], "text"),
                       GetSQLValueString($_POST['type_id'], "int"));
   echo $updateSQL;
  mysql_select_db($database_news, $news);
  $Result1 = mysql_query($updateSQL, $news) or die(mysql_error());

  $updateGoTo = "admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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
	background-color: #ccC;
	float: top;
	height: 50px;
	width: 100%;
	float: left;
	position: relative;
	font-size: 14px;
	color: #fff;
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
	width: 100%;
	position: relative;
	float: left;
}
#right_side_id {
	text-align: left;
	float: left;
	width: 0%;
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
  <div class="head_class" id="head_id"><h1>如一模式识别后台管理系统</h1></div>
  <div class="daohang_class" id="`daohang_id">
    <p><a href="admin_logout.php"> 退出后台</a></p>
  </div>
  <div class="left_side_class" id="left_side_id">
  <h1 align=center >类型管理</h1>
 <form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <table width=95% style="BORDER-COLLAPSE: collapse" borderColor=#CCF cellSpacing=0 align=center bgColor=#EEE border=1>
    <tr>
      <td colspan="3">修改分类</td>
    </tr>
    <tr>
      <td width="136" align="right">分类：</td>
      <td width="184" colspan="2" align="left"><label for="type_name"></label>
      <input name="type_name" type="text" id="type_name" value="<?php echo $row_Recordset1['name']; ?>" />
      <label for="type_id"></label>
      <input name="type_id" type="text" id="type_id" value="<?php echo $row_Recordset1['id']; ?>" /></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="submit" name="update" id="update" value="修改" />
      <input type="submit" name="re" id="re" value="重置" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
</form>
  </div>
  <div class="right_side_class" id="right_side_id">
    <h1></h1>
    
  </div>
  
  <div>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;</p></div>
</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
