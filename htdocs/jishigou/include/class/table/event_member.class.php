<?php
/**
 *
 * ���ݱ� event_member ��ز�����
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: event_member.class.php 3678 2013-05-24 09:48:20Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class table_event_member extends table {
	
	
	var $table = 'event_member';
	
	function table_event_member() {
		$this->init($this->table);
	}
		
}

?>