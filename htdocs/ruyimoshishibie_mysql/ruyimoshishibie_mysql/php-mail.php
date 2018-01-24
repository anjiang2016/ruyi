<?
$subject = "反馈信息";

$mailheaders = "Reply-To:13271929138@163.com\n\n";

$email = "1609772528@qq.com";
$text = "试验是否能发送成功1";
mail($email,$subject,$text,$mailheaders);

echo "信件已经发送给$email,请查收";
exit();
?>
