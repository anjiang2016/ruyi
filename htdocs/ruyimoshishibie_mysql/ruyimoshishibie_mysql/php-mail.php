<?
$subject = "������Ϣ";

$mailheaders = "Reply-To:13271929138@163.com\n\n";

$email = "1609772528@qq.com";
$text = "�����Ƿ��ܷ��ͳɹ�1";
mail($email,$subject,$text,$mailheaders);

echo "�ż��Ѿ����͸�$email,�����";
exit();
?>
