<?php
/**
 *
 * ���ݱ� medal_apply ��ز�����
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: medal_apply.class.php 3678 2013-05-24 09:48:20Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class table_medal_apply extends table {
	
	
	var $table = 'medal_apply';
	
	function table_medal_apply() {
		$this->init($this->table);
	}
		
}

?>