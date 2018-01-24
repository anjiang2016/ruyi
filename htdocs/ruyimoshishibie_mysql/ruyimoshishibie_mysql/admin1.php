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
//    if (($strUsers == "") && true) { 
//      $isValid = true; 
//    } 
  } 
  echo $isValid;
  return $isValid; 
}

$MM_restrictGoTo = "index_ruyi.php";
//echo $_SESSION['MM_Username'];
//echo isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup']);

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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 50;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_news, $news);
//$query_Recordset1 = "SELECT * FROM novel ORDER BY id DESC";
$query_Recordset1 = 'SELECT * FROM `novel` WHERE `author_name` = CONVERT(_utf8 \'anxi\' USING gbk) COLLATE gbk_chinese_ci';
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $news) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

mysql_select_db($database_news, $news);
$query_Recordset2 = "SELECT * FROM typeclass";
$Recordset2 = mysql_query($query_Recordset2, $news) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>如一模式识别后台管理中心</title>
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
	background-color: #BBB;
	text-align: center;
	color: #FFF;
	float: left;
	width: 100%;
	position: relative;
}
#left_side_id {
    border:1px solid #ccc;//或者#00f;
	background-color: #BBB;
	text-align: center;
	width: 37%;
	height:600px;
	position: relative;
	float: left;
}
#right_side_id {
    border:1px solid ccc;//或者#00f;
	text-align: center;
	float: right;
	width: 62%;
	height:600px;
	background-color: #BBB;
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
  <h1>类型</h1>
  <p><a href="type_add.php?news_id=<?php echo $row_Recordset1['id']; ?>">添加新闻分类</a></p>
  <?php do { ?>
      
        <p><?php echo $row_Recordset2['name']; ?>
        <!--<a href="type_upd.php?type_id=<?php echo $row_Recordset2['id']; ?>">[修改]</a> <a href="type_del.php?type_id=<?php echo $row_Recordset2['id']; ?>">[删除]</a></p>-->
      
      <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
  </div>
  <div class="right_side_class" id="right_side_id">
    <h1>内容管理</h1>
    <form id="form1" name="form1" method="post" action="">
  
  
  <table width="100%" border="0" cellpadding="2" cellspacing="2" id="biaoge">
    <tr>
      <td width="196" colspan="3"><a href="moshishibie_add.php?id=<?php echo $row_Recordset1['id']+1; ?>">添加文章</a></td>
    </tr>
    </table>
  <table width="400" border="0" cellpadding="2" cellspacing="2">
    <?php do { ?>
      <tr>
        <td width="242">标题：<a href="content_ruyi.php?id=<?php echo $row_Recordset1['id']; ?>"><?php echo $row_Recordset1['title']; ?></a></td>
        <td width="71">[<a href="moshishibie_upd.php?id=<?php echo $row_Recordset1['id']; ?>">修改</a>] </td>
        <td width="71">[<a href="moshishibie_del.php?id=<?php echo $row_Recordset1['id']; ?>">删除</a>]</td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
  <table border="0" >
    <tr>
      <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">第一页</a>
      <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">前一页</a>
      <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">下一个</a>
      <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">最后一页</a>
      <?php } // Show if not last page ?></td>
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
