<?php
/**
 *
 * ���ݱ� mall_goods ��ز�����
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: mall_goods.class.php 701455476 2014 578 foxis@qq.com $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class table_mall_goods extends table {
	
	
	var $table = 'mall_goods';
	
	function table_mall_goods() {
		$this->init($this->table);
	}
		
}

?>