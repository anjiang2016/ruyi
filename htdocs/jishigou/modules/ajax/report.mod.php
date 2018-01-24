<?php

/**
 *
 * report ģ��
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: report.mod.php 5268 2013-12-16 08:28:12Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class ModuleObject extends MasterObject {

	function ModuleObject($config) {
		$this->MasterObject($config);

		$this->Execute();
	}

	function Execute() {
		switch($this->Code) {
			case 'topic':
				$this->Topic();
				break;

			default : {
					$this->Main();
					break;
				}
		}
	}

	function Main() {
		response_text('page is not exits');
	}

	
	function Topic() {
		if(MEMBER_ID < 1)
		{
			response_text('�����οͣ�û��Ȩ�޾ٱ�');
		}

		$tid =  jget('totid','int','P');
		$report_reason = $this->Post['report_reason'];
		$report_content = $this->Post['report_content'];

		
		$data = array(
				'uid' => MEMBER_ID,
				'username' => MEMBER_NICKNAME,
				'ip' => $GLOBALS['_J']['client_ip'],
				'reason' => (int) $report_reason,
				'content' => strip_tags($report_content),
				'tid' => (int) $tid,
				'dateline' => time(),
		);

		$result = jtable('report')->insert($data);

		if($notice_to_admin = $this->Config['notice_to_admin']){
			$message = "�û�".MEMBER_NICKNAME."�ٱ���΢��ID��$tid(".$data['content'].")��<a href='admin.php?mod=report&code=report_manage' target='_blank'>���</a>�������";
			$pm_post = array(
				'message' => $message,
				'to_user' => str_replace('|',',',$notice_to_admin),
			);
						$admin_info = DB::fetch_first('select `uid`,`username`,`nickname` from `'.TABLE_PREFIX.'members` where `uid` = 1');
			load::logic('pm');
			$PmLogic = new PmLogic();
			$PmLogic->pmSend($pm_post,$admin_info['uid'],$admin_info['username'],$admin_info['nickname']);
		}

		response_text('�ٱ��ɹ�');
	}

}

?>
