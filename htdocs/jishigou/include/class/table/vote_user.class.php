<?php
/**
 *
 * ���ݱ� vote_user ��ز�����
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: vote_user.class.php 3678 2013-05-24 09:48:20Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class table_vote_user extends table {
	
	
	var $table = 'vote_user';
	
	function table_vote_user() {
		$this->init($this->table);
	}
		
}

?>