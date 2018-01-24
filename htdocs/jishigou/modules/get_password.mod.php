<?php
/**
 *
 * ȡ������ģ��
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: get_password.mod.php 5467 2014-01-18 06:14:04Z wuliyong $
 */


if(!defined('IN_JISHIGOU')) {
    exit('invalid request');
}

class ModuleObject extends MasterObject
{


	function ModuleObject($config)
	{
		$this->MasterObject($config);

		if (MEMBER_ID>0) {
			}
		if($GLOBALS['_J']['config']['ldap_enable']){
			$this->Messager("��վ����AD���ʺŵ�¼����֧���û�����������κβ�����",null);
		}

		$this->Execute();
	}

	
	function Execute()
	{
		ob_start();
		switch ($this->Code) {
			case 'do_send':
				$this->DoSend();
				break;
			case 'do_reset':
				$this->DoReset();
				break;

			case 'sms':
				$this->Sms();
				break;
			case 'sms_send':
				$this->SmsSend();
				break;
			case 'sms_reset':
				$this->SmsReset();
				break;

			default:
				$this->Main();
		}
		$body=ob_get_clean();

		$this->ShowBody($body);
	}

	function Main()
	{
		$act_list = array();
		$act_list['base'] = '�һ�����';
		$act_list['reset'] = '��������';

		$act = isset($act_list[$this->Code]) ? $this->Code : 'base';
		$act_name = $act_list[$act];

		if('reset' == $act) {
			extract($this->_resetCheck());
		}


		$this->Title = $act_list[$act];
		include(template('get_password_main'));
	}

	function DoSend() {
		if ($this->Config['seccode_enable']==1 && $this->Config['seccode_password']) {
			if (!ckseccode(@$_POST['seccode'])) {
				$this->Messager("��֤���������",-1);
			}
		}elseif ($this->Config['seccode_enable']>1 && $this->Config['seccode_password'] && $this->yxm_title && $this->Config['seccode_pub_key'] && $this->Config['seccode_pri_key']) {
			$YinXiangMa_response=jlogic('seccode')->CheckYXM(@$_POST['add_YinXiangMa_challenge'],@$_POST['add_YXM_level'][0],@$_POST['add_YXM_input_result']);
			if($YinXiangMa_response != "true"){
				$this->Messager("��֤���������",-1);
			}
		}
		$to = trim($this->Post['to']);
		if(!$to) {
			$this->Messager('���ݲ���Ϊ��', -1);
		}
		if(false === strpos($to, '@')) {
			$member = jsg_get_member($to, 'nickname', 0);
			if(!$member) {
				$this->Messager('�û������ڣ��뷵�����Ի��������Աȡ����ϵ��', -1);
			}
			$to = $member['email'];
		}

		$sql="select M.uid,M.username,M.nickname,M.email,MF.authstr
		FROM
			".TABLE_PREFIX.'members'." M LEFT JOIN ".TABLE_PREFIX.'memberfields'." MF ON(M.uid=MF.uid)
		WHERE
			M.email='{$to}'";
		$query = $this->DatabaseHandler->Query($sql);
		$member=$query->GetRow();
		if ($member==false) {
			$this->Messager("�û��Ѿ�������", -1);
		}
		$timestamp=time();
		if ($member['authstr']) {
			list($dateline, $operation, $idstring) = explode("\t", $member['authstr']);
			$inteval = 1800;			if ($dateline+$inteval>$timestamp) {
				$this->Messager("�ʼ��ո��Ѿ������ˣ����Ժ������ʱ�䶼û���յ��ʼ������Сʱ���ٷ���һ�λ��������Աȡ����ϵ��",-1,null);
			}
		}

		$idstring = random(32);
		$member['authstr'] = "{$timestamp}\t1\t{$idstring}";
		$member['auth_try_times'] = 0;
		$result = jtable('memberfields')->update($member, array('uid'=>$member['uid']));
		if (!$result) {
			jtable('memberfields')->insert($member, 0, 1);
		}
		$onlineip= $GLOBALS['_J']['client_ip'];
				$email_message="���ã�
���յ�����ʼ�������ΪEmail��ַ��{$this->Config['site_name']}�ϱ��Ǽ�Ϊ�û����䣬
���û�����ʹ�� Email �������ù������¡�
----------------------------------------------------------------------
��Ҫ�������û���ύ�������õ��������{$this->Config['site_name']}��ע���û�������������
��ɾ������ʼ���
----------------------------------------------------------------------
��������������һ��������룬������Сʱ֮�ڣ�ͨ�������������������������룺
{$this->Config['site_url']}/index.php?mod=get_password&code=reset&uid={$member['uid']}&id={$idstring}
(������治��������ʽ���뽫��ַ�ֹ�ճ�����������ַ���ٷ���)

�����ҳ��򿪺������µ�������ύ��֮��������ʹ���µ������¼
{$this->Config['site_name']}�ˡ��������ڸ�����������ʱ�޸��������롣

�������ύ�ߵ� IP Ϊ $onlineip
����
{$this->Config['site_name']} �����Ŷ�.
{$this->Config['site_url']}";
			$subject="[{$this->Config['site_name']}] ȡ������˵��";
			send_mail($member['email'],$subject,
			$email_message,$this->Config['site_name'],$this->Config['site_admin_email'],
			array(),3,$html=false) ;
		$email_head = $member['email']{0} . $member['email']{1} . $member['email']{2};
		$mail_service=strstr($member['email'], '@');
		$message=array(
		"����Ϊ\"<b>{$subject}</b>\"���ʼ��Ѿ����͵���<b>\"{$email_head}******\"</b>��ͷ�Һ�׺Ϊ<b>\"{$mail_service}\"</b>�������У����� 2Сʱ֮���޸��������롣",
		"�ʼ����Ϳ��ܻ��ӳټ����ӣ������ĵȴ���",
		"�����ʼ��ṩ�̻Ὣ���ʼ����������ʼ���������������Խ��������ҵ����ʼ���",
		);
		$this->Messager($message,null,null);
	}

	function DoReset()
	{
		if ($this->Config['seccode_enable']==1 && $this->Config['seccode_password']) {
			if (!ckseccode(@$_POST['seccode'])) {
				$this->Messager("��֤���������",-1);
			}
		}elseif ($this->Config['seccode_enable']>1 && $this->Config['seccode_password'] && $this->yxm_title && $this->Config['seccode_pub_key'] && $this->Config['seccode_pri_key']) {
			$YinXiangMa_response=jlogic('seccode')->CheckYXM(@$_POST['add_YinXiangMa_challenge'],@$_POST['add_YXM_level'][0],@$_POST['add_YXM_input_result']);
			if($YinXiangMa_response != "true"){
				$this->Messager("��֤���������",-1);
			}
		}
		$this->_resetCheck();

		if($this->Post['password']!=$this->Post['confirm'] or $this->Post['password']=='') {
			$this->Messager('������������벻һ��,�������벻��Ϊ�ա�',-1,null);
		}

		$uid = (int) get_param('uid');
        $member_info = jsg_member_info($uid);
        if(!$member_info) {
            $this->Messager("�û��Ѿ���������",null);
        }


		$sql="UPDATE ".TABLE_PREFIX.'memberfields'." SET `authstr`='', `auth_try_times`='0' WHERE uid='$uid'";
		DB::query($sql);


        jsg_member_edit($member_info['nickname'], '', '', $this->Post['password'], '', '', 1);


		$this->Messager("���������óɹ�������Ϊ��ת���¼����.",$this->Config['site_url'] . "/index.php?mod=login");
	}

	function _resetCheck() {
		$uid = (int) get_param('uid');
		$id = trim(get_param('id'));
		if (!$id || $uid<1) {
			$this->Messager("��������ӵ�ַ����",null);
		}

		$sql="select M.uid,M.username,M.nickname,M.email,MF.authstr,MF.auth_try_times
		FROM
			".TABLE_PREFIX.'members'." M LEFT JOIN ".TABLE_PREFIX.'memberfields'." MF ON(M.uid=MF.uid)
		WHERE
			M.uid='$uid'";
		$query = $this->DatabaseHandler->Query($sql);
		$member=$query->GetRow();
		if ($member==false) {
			$this->Messager("�û��Ѿ���������",null);
		}
		if(empty($member['authstr'])) {
			$this->Messager("������������󲻴���", null);
		}
		$member['auth_try_times'] = (max(0, (int) $member['auth_try_times']) + 1);
		DB::query("UPDATE ".DB::table('memberfields')." SET `auth_try_times`='{$member['auth_try_times']}' WHERE `uid`='{$uid}'");
		if($member['auth_try_times']>=10) {
			$this->Messager('��'.$member['auth_try_times'].'�������ԵĴ������̫���ˣ������·����һ����������', null);
		}
		$timestamp=time();
		list($dateline, $operation, $idstring) = explode("\t", $member['authstr']);
		if(($dateline < ($timestamp - 3600 * 2)) || $operation != 1 || $idstring != $id) {
			$message=array(
				"������������󲻴��ڻ��Ѿ����ڣ��޷�ȡ�����롣",
				"�����������������룬��<a href='index.php?mod=get_password'>�����˴�</a>��"
			);
			$this->Messager($message,null);
		}
		$member['id'] = $id;

		return $member;
	}

	
	function Sms() {
		if(!sms_init()) {
			$this->Messager('��û�п����ֻ����Ź���', null);
		}
		include template('get_password_sms');
	}
	function SmsSend() {
		if(!sms_init()) {
			$this->Messager('��û�п����ֻ����Ź���', null);
		}
		$act_name = '�������ֻ���֤��';
		$rets = array();
		$key = jget('key', 'txt');
		$gsms = jget('sms', 'txt');
		if($key && $gsms) {
			$sms = $gsms;
			$act_name = '�����������ֻ���֤��';
		} else {
			
			if ($this->Config['seccode_enable']==1 && $this->Config['seccode_password']) {
				if (!ckseccode(@$_POST['seccode'])) {
					$this->Messager("��֤���������",-1);
				}
			}elseif ($this->Config['seccode_enable']>1 && $this->Config['seccode_password'] && $this->yxm_title && $this->Config['seccode_pub_key'] && $this->Config['seccode_pri_key']) {
				$YinXiangMa_response=jlogic('seccode')->CheckYXM(@$_POST['add_YinXiangMa_challenge'],@$_POST['add_YXM_level'][0],@$_POST['add_YXM_input_result']);
				if($YinXiangMa_response != "true"){
					$this->Messager("��֤���������",-1);
				}
			}

			$sms = jpost('sms', 'txt');
			$rets = sms_send_verify($sms);
		}
		if($rets['error']) {
			$this->Messager($rets['result']);
		} else {
			include template('get_password_sms_send');
		}
	}
	function SmsReset() {
		if(!sms_init()) {
			$this->Messager('��û�п����ֻ����Ź���', null);
		}

		$sms = jpost('sms', 'txt');
		$key = jpost('key', 'txt');

		$rets = sms_check_verify($sms, $key);
		if($rets['error']) {
			$this->Messager($rets['result'] . " �뷵�����ԣ�����<a href='index.php?mod=get_password'>������·�����֤</a>",
				"index.php?mod=get_password&code=sms_send&sms=$sms&key=$key");
		} else {
			if(jpost('reset_pwd_submit')) {
				$pwd = jpost('password');
				if(empty($pwd) || $pwd != jpost('confirm') || strlen($pwd) < 6) {
					$this->Messager('������������벻һ�£�������5λ���ϵ����룡', 'index.php?mod=get_password');
				}
				$info = sms_bind_info($sms);
				$uid = $info['uid'];
				if(empty($info) || $uid < 1) {
					$this->Messager('���ֻ���δ���κ��ʺ�', null);
				}
				$member = jsg_member_info($uid);
				if(!$member) {
					$this->Messager("�û�ID��{$uid}���Ѿ���������", null);
				}

				sms_enter_verify($sms);

				jsg_member_edit($member['nickname'], '', '', $pwd, '', '', 1);

				$msg = "��{$member['uid']}��{$member['nickname']}����������������������Ϊ {$pwd} ����ע�Ᵽ�ܣ�";
				sms_send($sms, $msg, 0);

				$this->Messager("���������óɹ�������Ϊ��ת���¼����.",$this->Config['site_url'] . "/index.php?mod=login");
			} else {
				$act_name = '��������������';
				include template('get_password_sms_reset');
			}
		}
	}

}

?>
