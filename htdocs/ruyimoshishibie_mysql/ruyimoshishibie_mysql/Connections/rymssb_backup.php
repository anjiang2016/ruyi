<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
#$hostname_news = "27.54.227.137";
#$hostname_news1 = "27.54.195.137";
$hostname_news = "hdm-122.hichina.com";


#$database_news = "rymssb";

#$username_news = "rymssb";
#$password_news = "0304028mysql";

$database_news = "hdm1220044_db";
$username_news = "hdm1220044";
$password_news = "0304028Ms";


$news = mysql_pconnect($hostname_news, $username_news, $password_news);

if (!$news)
{

  die('227 Could not connect: ' . mysql_error());
  $news = mysql_pconnect($hostname_news1, $username_news, $password_news) or trigger_error(mysql_error(),E_USER_ERROR); 
}

mysql_query("SET NAMES gbk;");
?>