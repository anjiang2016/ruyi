<?php
/**
 *
 * ���ݱ� user_medal ��ز�����
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: user_medal.class.php 3678 2013-05-24 09:48:20Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class table_user_medal extends table {
	
	
	var $table = 'user_medal';
	
	function table_user_medal() {
		$this->init($this->table);
	}
		
}

?>