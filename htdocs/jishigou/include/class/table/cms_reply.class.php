<?php
/**
 *
 * ���ݱ� cms_reply ��ز�����
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: cms_reply.class.php 2002950776 2014 573 foxis@qq.com $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class table_cms_reply extends table {
	
	
	var $table = 'cms_reply';
	
	function table_cms_reply() {
		$this->init($this->table);
	}
		
}

?>