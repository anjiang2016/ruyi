<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * YY Ӧ�ó��򿪷� API BY JishiGou
 *
 * ���ļ�Ϊ api/yy.php ������ YY ֪ͨ��JishiGou������
 *
 * @author ����<foxis@qq.com>
 *
 * @version $Id: yy.php 3622 2013-05-15 08:22:35Z wuliyong $
 */

error_reporting(E_ERROR);

if(empty($_POST) && empty($_GET))
{
	exit('invalid request');
}


$_GET['mod'] = $_POST['mod'] = 'yy';


include('../index.php');


?>