<?php
/**
 *
 * ��������ࣨ�����õķ��������ڴˣ�
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: misc.class.php 3835 2013-06-08 07:15:10Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class misc {

	function misc() {
		;
	}

	function account_bind_info($uid, $key=null, $cache=1) {
		static $S_account_bind_info = null;

		$uid = is_numeric($uid) ? $uid : 0;
		if($uid < 1) {
			return false;
		}

		if(!$cache || !isset($S_account_bind_info[$uid])) {
			$memberfields = array();
			if($uid===MEMBER_ID) {
				$memberfields = $GLOBALS['_J']['member'];
			}
			if(!isset($memberfields['account_bind_info'])) {
				$memberfields = DB::fetch_first("SELECT `uid`, `account_bind_info` FROM ".DB::table('memberfields')." WHERE `uid`='$uid' ");
			}
			if($memberfields['account_bind_info']) {
				$memberfields['account_bind_info'] = unserialize(base64_decode($memberfields['account_bind_info']));
			} else {
				return false;
			}
			$S_account_bind_info[$uid] = $memberfields['account_bind_info'];
		}

		if(is_null($key)) {
			return $S_account_bind_info[$uid];
		} else {
			if(is_null($S_account_bind_info[$uid][$key])) {
				return false;
			} else {
				return $S_account_bind_info[$uid][$key];
			}
		}
	}
	function update_account_bind_info($uid=MEMBER_ID, $key='', $val=array(), $clean=0) {
		if($clean) {
			$val = '';
		} else {
			$info = $this->account_bind_info($uid, null, 0);
			$info[$key] = (array) $val;
			$val = base64_encode(serialize($info));
		}
		$uid = (is_numeric($uid) ? $uid : 0);

		return DB::query("UPDATE ".DB::table('memberfields')." SET `account_bind_info`='$val' ".(($uid > 0 || !$clean) ? " WHERE `uid`='$uid' " : "")." ");
	}

	function sign_modify($uid, $signature) {
		$uid = max(0, (int) $uid);
		if($uid < 1) return jerror('��UID����Ϊ�ա����ȵ�¼����ע��һ���ʺ�');
		$user = jsg_member_info($uid);
		if(!$user) return jerror('��ָ��һ����ȷ��UID');
		if(jdisallow($uid)) return jerror('����Ȩ�޸Ĵ��û�ǩ��');

		$signature = jhtmlspecialchars(cutstr(trim(strip_tags($signature)), 32));
		$f_rets = filter($signature);
		if($f_rets && $f_rets['error']) {
			return jerror($f_rets['msg']);
		}

		if($signature != $user['signature']) {
			$sys_config = jconf::get();
			if($sys_config['sign_verify'] && $signature) {
				$count = DB::result_first("select count(*) from ".TABLE_PREFIX."members_verify where uid = '$uid'");
				if($count){
					DB::query("update ".TABLE_PREFIX."members_verify set signature = '$signature' , is_sign = 1 where uid = '$uid'");
				}else{
					DB::query("insert into ".TABLE_PREFIX."members_verify (uid,nickname,signature,is_sign) values ('$uid','{$user['nickname']}','$signature',1)");
				}
				if($sys_config['notice_to_admin']){
					$pm_post = array(
						'message' => $user['nickname']." �޸���ǩ��������ˣ�<a href='admin.php?mod=verify&code=fs_verify' target='_blank'>���</a>������ˡ�",
						'to_user' => str_replace('|',',',$sys_config['notice_to_admin']),
					);
										$admin_info = jsg_member_info(1);
					jlogic('pm')->pmSend($pm_post,$admin_info['uid'],$admin_info['username'],$admin_info['nickname']);
				}
				return jerror('����ǩ���޸ĳɹ�������Ա�����');
			} else {
				$sets = array(
					'signature' => $signature,
					'signtime' => TIMESTAMP,
				);
				DB::update('members', $sets, " `uid`='$uid' ");
			}
		}

		return $signature;
	}

}

?>