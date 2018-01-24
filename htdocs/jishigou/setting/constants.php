<?php
/**
 *
 * ���¹����������ļ�
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: constants.php 5511 2014-01-24 02:04:46Z wuliyong $
 */

if(true === DEBUG) {
	error_reporting(E_ALL ^ E_NOTICE);
} else {
	error_reporting(E_ERROR);
}

if(!defined('ROOT_PATH')) {
	define(ROOT_PATH, substr(dirname(__FILE__), 0, -8) . '/');
}

if(!isset($config['auth_key'])) {
	include(ROOT_PATH . 'setting/settings.php');
}

//IN_JISHIGOU
define('IN_JISHIGOU',       true);

//�������Ϣ
define('SYS_VERSION',		'4.7.4');
//define('SYS_PUBLISHED',     'stable');
define('SYS_PUBLISHED',     '');
define('SYS_BUILD',			'build 20140922');

//�������
if(!defined('GZIP')) {
	define('GZIP',			(bool) $config['gzip']);
}

//���ݱ�ǰ�
if(!defined('TABLE_PREFIX')) {
	define('TABLE_PREFIX',	$config['db_table_prefix']);
}

//ʱ������
if(function_exists('date_default_timezone_set')) {
    $config['timezone'] = ((isset($config['timezone']) && is_numeric($config['timezone'])) ? $config['timezone'] : 8);

	@date_default_timezone_set('Etc/GMT'.($config['timezone'] > 0 ? '-' : '+').(abs($config['timezone'])));
}


//Ucenter ����
if($config['ucenter_enable']) {
	$config['ucenter'] = jconf::get('ucenter');

	define('UCENTER' , 			($config['ucenter']['enable'] ? true : false));//��ʶUcenter�Ƿ��Ѿ�����

	if (true === UCENTER) {
        define('UCENTER_MODIFY_NICKNAME', ($config['ucenter']['modify_nickname'] ? true : false)); //����Ucenter���Ƿ��������û��޸��ǳƣ�

        define('UCENTER_FACE' , 	($config['ucenter']['face'] ? true : false));//��ʶUcenter�Ƿ�������UCͷ��

		define('UC_CONNECT', 		$config['ucenter']['uc_connect']);	// ���� UCenter �ķ�ʽ: mysql/NULL, Ĭ��Ϊ��ʱΪ fscoketopen()

		//���ݿ���� (mysql ����ʱ, ����û������ UC_DBLINK ʱ, ��Ҫ�������±���)
		define('UC_DBHOST',		 	$config['ucenter']['uc_db_host']);			// UCenter ���ݿ�����
		define('UC_DBUSER', 		$config['ucenter']['uc_db_user']);				// UCenter ���ݿ��û���
		define('UC_DBPW', 			$config['ucenter']['uc_db_password']);					// UCenter ���ݿ�����
		define('UC_DBNAME', 		$config['ucenter']['uc_db_name']);				// UCenter ���ݿ�����
		define('UC_DBCHARSET',		str_replace('-','',$config['charset']));				// UCenter ���ݿ��ַ���
		define('UC_DBTABLEPRE', 	$config['ucenter']['uc_db_table_prefix']);			// UCenter ���ݿ��ǰ׺

		//ͨ�����
		define('UC_KEY', 			$config['ucenter']['uc_key']);				// �� UCenter ��ͨ����Կ, Ҫ�� UCenter ����һ��
		define('UC_API', 			$config['ucenter']['uc_api']);	// UCenter �� URL ��ַ, �ڵ���ͷ��ʱ�����˳���
		define('UC_CHARSET', 		$config['charset']);				// UCenter ���ַ���
		define('UC_IP', 			$config['ucenter']['uc_ip']);					// UCenter �� IP, �� UC_CONNECT Ϊ�� mysql ��ʽʱ, ���ҵ�ǰӦ�÷�������������������ʱ, �����ô�ֵ
		define('UC_APPID', 			$config['ucenter']['uc_app_id']);					// ��ǰӦ�õ� ID
	}
}

//Phpwind ����
elseif($config['phpwind_enable']) {
	$config['phpwind'] = jconf::get('phpwind');

	define('PWUCENTER' , 			($config['phpwind']['enable'] ? true : false));//��ʶPhpwind�Ƿ��Ѿ�����

	if (true === PWUCENTER) {

        define('UCENTER_FACE' , 	($config['phpwind']['face'] ? true : false));//��ʶphpwind�Ƿ��������û�ͷ��

		define('UC_CONNECT', 		'mysql');	// ���� phpwind �ķ�ʽ: mysql/NULL, Ĭ��Ϊ��ʱΪ fscoketopen()

		define('UC_DBHOST',		 	$config['phpwind']['pw_db_host']);			// phpwind ���ݿ�����
		define('UC_DBUSER', 		$config['phpwind']['pw_db_user']);				// phpwind ���ݿ��û���
		define('UC_DBPW', 			$config['phpwind']['pw_db_password']);			// phpwind ���ݿ�����
		define('UC_DBNAME', 		$config['phpwind']['pw_db_name']);				// phpwind ���ݿ�����
		define('UC_DBCHARSET',		str_replace('-','',$config['phpwind']['pw_db_charset']));	// phpwind ���ݿ��ַ���
		define('UC_DBTABLEPRE', 	$config['phpwind']['pw_db_table_prefix']);		// phpwind ���ݿ��ǰ׺

		//ͨ�����
		define('UC_KEY', 			$config['phpwind']['pw_key']);				// �� phpwind ��ͨ����Կ, Ҫ�� phpwind ����һ��
		define('UC_API', 			$config['phpwind']['pw_api']);	// phpwind �� URL ��ַ, �ڵ���ͷ��ʱ�����˳���
		define('UC_CHARSET', 		$config['pw_charset']);				// phpwind ���ַ���
		define('UC_IP', 			$config['phpwind']['pw_ip']);		// phpwind �� IP, ��Ӧ�÷�������������������ʱ, �����ô�ֵ
		define('UC_APPID', 			$config['phpwind']['pw_app_id']);	// ��ǰӦ�õ� ID
	}
}

//ȫ��ʱ���
define('TIMESTAMP', time());

//���������(0���رգ�1������)
define('PLUGINDEVELOPER', 1);

//UC_KEY
if(!defined('UC_KEY')) {
	define('UC_KEY', $config['auth_key'] . $config['safe_key']);
}

//����֤��
define("PRIVATE_KEY",(isset($config['seccode_pri_key']) ? $config['seccode_pri_key'] : 'ba654d1411c3ba4e3ed6b8b2ef29a470'));
define("PUBLIC_KEY",(isset($config['seccode_pub_key']) ? $config['seccode_pub_key'] : '98583a76eb813b39381fdb1684908dc0'));
define("YXMCURL","http:/" . "/api.yinxiangma.com/api2/");
define("VERSION","YinXiangMa_Js_Pop_SDK");
?>