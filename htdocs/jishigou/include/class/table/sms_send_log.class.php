<?php
/**
 *
 * ���ݱ� sms_send_log ��ز�����
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: sms_send_log.class.php 3678 2013-05-24 09:48:20Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class table_sms_send_log extends table {
	
	
	var $table = 'sms_send_log';
	
	function table_sms_send_log() {
		$this->init($this->table);
	}
		
}

?>