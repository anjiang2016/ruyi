<?php
 ob_start();require_once('Connections/rymssb.php'); 
 ?>
 
<?php
if (!isset($_SESSION)) {
  session_start();
}
echo "传递的session变量var1的值为：".$_SESSION['MM_Username']."<br />";
echo "传递的session变量var1的值为：".$_SESSION['MM_UserGroup']."<br />";
echo "当前管理员姓名：".$_SESSION['MM_Username']."-->";
echo "<a href='admin_logout.php'> 退出后台</a><br />";
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";
$cccc=0;

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 
  //echo '显示isAuthorized输入变量：'.'<br />';
  //echo 'strUsers:'.$strUsers.'<br />';
  //echo 'strGroups:'.$strGroups.'<br />';
  //echo 'UserName:'.$UserName.'<br />';
  //echo 'UserGroup:'.$UserGroup.'<br />';
  

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
//      $isValid = true; 
    }
 //  
 // echo 'isValid:'.$isValid.'<br />';
 //  // 用户查询，校验
 // 
 // //'SELECT * FROM `ruyi_user` WHERE `name` = CONVERT(_utf8 \'shasha\' USING gbk) COLLATE gbk_chinese_ci AND `password` = CONVERT(_utf8 \'ruyishasha\' USING gbk) COLLATE gbk_chinese_ci';
 // $LoginRS__query=sprintf("SELECT * FROM `ruyi_user` WHERE name=%s",GetSQLValueString($UserName, "text")); 
 // echo 'news:'.$news.'<br />'; 
 // $LoginRS = mysql_query($LoginRS__query, $news) or die(mysql_error()); //从数据库中效验
 // $loginFoundUser = mysql_num_rows($LoginRS);
 // if($loginFoundUser){ 
 //     $isValid=False;
 // }
  
  }
  if($UserName=="游客") $isValid=False;  
  echo 'isValid:'.$isValid.'<br />';
  return $isValid; 
}

$MM_restrictGoTo = "index_ruyi.php";
//echo $_SESSION['MM_Username'];
//echo "是否注册：";
//$flag = isAuthorized($_SESSION['MM_Username'],$_SESSION['MM_UserGroup'], $_SESSION['MM_Username'], $_SESSION['MM_UserGroup']);
//echo $flag."<br />";

if (!(             (isset($_SESSION['MM_Username'])) && (isAuthorized("",$_SESSION['MM_UserGroup'], $_SESSION['MM_Username'], $_SESSION['MM_UserGroup']))    )) 
{   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  echo $MM_restrictGoTo."<br />";
  exit();
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

?>




<?php

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 50;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_news, $news);

if($_SESSION['MM_UserGroup']==1)
{
    //$_SESSION['MM_Username']
	//$LoginRS__query=sprintf("SELECT * FROM `ruyi_user` WHERE name=%s AND password=%s",GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
    $query_Recordset1 = sprintf('SELECT * FROM `novel` WHERE `author_name` = %s ORDER BY id DESC',GetSQLValueString($_SESSION['MM_Username'], "text"));
	//$query_Recordset1 = 'SELECT * FROM `novel` WHERE `author_name` = CONVERT(_utf8 \'anxi\' USING gbk) COLLATE gbk_chinese_ci';
}
elseif($_SESSION['MM_UserGroup']==0)
	$query_Recordset1 = "SELECT * FROM novel ORDER BY id DESC";

$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $news) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);


$Recordset111 = mysql_query($query_Recordset1, $news) or die(mysql_error());
$row_Recordset111 = mysql_fetch_assoc($Recordset111);
$c_all=mysql_num_rows($Recordset111);
echo "共发文".$c_all."篇。<br />";

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

mysql_select_db($database_news, $news);
$query_Recordset2 = "SELECT * FROM typeclass ORDER  BY id ASC";
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
    <!--<p><a href="admin_logout.php"> 退出后台</a></p>-->
	<p></p>
  </div>
  <div class="left_side_class" id="left_side_id">
  <h1>类型管理</h1>
  <?php if($_SESSION['MM_UserGroup']==0){ ?>
  <p><a href="type_add.php?news_id=<?php echo $row_Recordset1['id']; ?>">添加文章分类</a></p>
  <?php }elseif($_SESSION['MM_UserGroup']==1){ }?>
  <?php do { ?>
      
        <p><?php echo $row_Recordset2['name']; ?>
		<?php if($_SESSION['MM_UserGroup']==0){ ?>
        <a href="type_upd.php?type_id=<?php echo $row_Recordset2['id']; ?>">[修改]</a> <a href="type_del.php?type_id=<?php echo $row_Recordset2['id']; ?>">[删除]</a></p>
        <?php }elseif($_SESSION['MM_UserGroup']==1){ }?>
		
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
    <?php do {$cccc=$cccc+1; ?>
      <tr>
        <td width="242">标题：<a href="content_ruyi.php?id=<?php echo $row_Recordset1['id']; ?>"><?php echo "(".$cccc.")".$row_Recordset1['title']; ?></a></td>
        <td width="71">[<a href=""><?php echo $row_Recordset1['author_name']; ?></a>] </td>
        
		<td width="71">[<a href="moshishibie_upd.php?id=<?php echo $row_Recordset1['id']; ?>">修改</a>] </td>
        <?php if($_SESSION['MM_UserGroup']==0){ ?>
		<td width="71">[<a href="moshishibie_del.php?id=<?php echo $row_Recordset1['id']; ?>">删除</a>]</td>
        <?php }elseif($_SESSION['MM_UserGroup']==1){ }?>
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