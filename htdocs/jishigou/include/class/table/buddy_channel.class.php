<?php
/**
 *
 * ���ݱ� buddy_channel ��ز�����
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: buddy_channel.class.php 3678 2013-05-24 09:48:20Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class table_buddy_channel extends table {
	
	
	var $table = 'buddy_channel';
	
	function table_buddy_channel() {
		$this->init($this->table);
	}
		
}

?>