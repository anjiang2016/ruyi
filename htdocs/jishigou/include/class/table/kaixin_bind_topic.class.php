<?php
/**
 *
 * ���ݱ� kaixin_bind_topic ��ز�����
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: kaixin_bind_topic.class.php 3678 2013-05-24 09:48:20Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class table_kaixin_bind_topic extends table {
	
	
	var $table = 'kaixin_bind_topic';
	
	function table_kaixin_bind_topic() {
		$this->init($this->table);
	}
		
}

?>