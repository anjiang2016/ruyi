<?php
/**
 *
 * ���ݱ� xwb_bind_info ��ز�����
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: xwb_bind_info.class.php 3678 2013-05-24 09:48:20Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class table_xwb_bind_info extends table {
	
	
	var $table = 'xwb_bind_info';
	
	function table_xwb_bind_info() {
		$this->init($this->table);
	}
		
}

?>