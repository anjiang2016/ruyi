<?php
/* 
��ִ�����ն���ʱ���������̨php����������ϴ�ͼƬ��ɺ��򷵻���Ӧ����Ϣ��

PHP

action.php�����ľ��ǽ��������յ�ͼ���ϴ���������������ͼƬ·�����ظ�ǰ�ˡ�ע����ͼƬ��·��Ҫ��дȨ�ޡ�
*/

$filename = date('YmdHis') . '.jpg';
$result = file_put_contents( 'pics/'.$filename, file_get_contents('php://input') );

if (!$result) {

print "ERROR: Failed to write data to $filename, check permissions\n";

exit();

}

$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/pics/' . $filename;

print "$url\n";

//����ֻ�Ǽ򵥵Ľ��������������պ��ϴ����ܣ���ʵ����Ӧ�ó������ϴ����ٲü������ɶ��Ų�ͬ������ͼ��ȵȣ�����Լ�ȥ��ĥ��
?>