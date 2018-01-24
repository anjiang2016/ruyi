<?php ob_start();require_once('Connections/rymssb.php'); ?>
<?php 


$page = intval($_GET['page']); //获取请求的页数 
$start = $page*20; 
$query=mysql_query("select * from novel order by id desc limit $start,20", $news) or die(mysql_error());
while ($row=mysql_fetch_array($query)) { 
$arr[] = array( 
'title'=>$page, 
'id'=>$row['id']
); 
} 
echo json_encode($arr); //转换为json数据输出 
?> 