<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename square.mod.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 681388213 801 $
 */




if (!defined('IN_JISHIGOU')) {
    exit('Access Denied');
}

class ModuleObject extends MasterObject
{
	var $CacheConfig;

	function ModuleObject($config)
	{
		$this->MasterObject($config);
		$this->CacheConfig = jconf::get('cache');
		$this->Execute();
	}

	
	function Execute()
	{
		ob_start();
		switch($this->Code) {
			case '3g':
				$this->gsquare();
				break;
			default:
				$this->main();
				break;
		}
		$body=ob_get_clean();
		echo $body;
	}

	function main()
	{
		$this->Config['is_mobile_client'] = 1;
		include(template('square'));
	}

	function gsquare()
	{
		Mobile::is_login();
		include(template('g_search'));
	}
}
?>