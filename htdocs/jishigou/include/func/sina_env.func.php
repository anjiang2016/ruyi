<?php
/**
 * �ļ�����sina_env.func.php
 * @version $Id: sina_env.func.php 3697 2013-05-27 07:18:45Z wuliyong $
 * ���ߣ�����<foxis@qq.com>
 * ��������: ����΢���ӿں���
 */
if(!defined('IN_JISHIGOU'))
{
	exit('invalid request');
}



function sina_env()
{
	$msgs = array();

	
	$files = array(ROOT_PATH . 'include/ext/xwb/sina.php',ROOT_PATH . 'include/ext/xwb/jishigou.env.php',ROOT_PATH . 'include/ext/xwb/set.data.php',ROOT_PATH . 'include/ext/xwb/hack/newtopic.hack.php',ROOT_PATH . 'include/ext/xwb/lib/xwbDB.class.php',);
	foreach ($files as $f)
	{
		if (!is_file($f))
		{
			$msgs[] = "�ļ�<b>{$f}</b>������";
		}
	}

	
	$funcs = array('version_compare', array('fsockopen', 'pfsockopen'), 'preg_replace',array('iconv','mb_convert_encoding'),array("hash_hmac","mhash"));
	foreach ($funcs as $func)
	{
		if (!is_array($func))
		{
			if (!function_exists($func))
			{
				$msgs[] = "����<b>{$func}</b>������";
			}
		}
		else
		{
			$t = false;
			foreach ($func as $f)
			{
				if(function_exists($f))
				{
					$t = true;
					break;
				}
			}

			if (!$t)
			{
				$msgs[] = "����<b>".implode(" , ",$func)."</b>��������";
			}
		}
	}


	return $msgs;
}

?>