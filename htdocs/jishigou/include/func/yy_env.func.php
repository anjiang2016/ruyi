<?php
/**
 * �ļ�����yy_env.func.php
 * @version $Id: yy_env.func.php 3812 2013-06-05 02:24:18Z yupengfei $
 * ���ߣ�����<foxis@qq.com>
 * ��������: YY�ӿں���
 */
if(!defined('IN_JISHIGOU'))
{
	exit('invalid request');
}



function yy_env()
{
	$msgs = array();

	
	$files = array(ROOT_PATH . 'include/class/jishigou_oauth2_client.class.php', ROOT_PATH . 'include/func/yy.func.php', ROOT_PATH . 'modules/yy.mod.php', );
	foreach ($files as $f)
	{
		if (!is_file($f))
		{
			$msgs[] = "�ļ�<b>{$f}</b>������";
		}
	}

	
	$funcs = array('version_compare',array('fsockopen', 'pfsockopen'),'curl_init','preg_replace',array('iconv','mb_convert_encoding'),array("hash_hmac","mhash"));
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