<?php
/**
 *
 * ���ݱ� force_out ��ز�����
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: force_out.class.php 3678 2013-05-24 09:48:20Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class table_force_out extends table {
	
	
	var $table = 'force_out';
	
	function table_force_out() {
		$this->init($this->table);
	}
		
}

?>