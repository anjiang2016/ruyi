<?php

/**
 *[JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 ��̨��¼
 *
 * @author ����<foxis@qq.com>
 * @package www.jishigou.net
 */

if(!defined('IN_JISHIGOU'))
{
    exit('invalid request');
}

class ModuleObject extends MasterObject
{

	
	var $Username = '';

	
	var $Password = '';


	
	function ModuleObject($config) {
		$this->MasterObject($config);

		$this->Username = isset($this->Post['username']) ? trim($this->Post['username']) : "";
		$this->Password = isset($this->Post['password']) ? trim($this->Post['password']) : "";

		if(MEMBER_ID > 0) {
	        if('normal' == MEMBER_ROLE_TYPE) {
	        	$this->Messager("��ͨ�û����Ա��Ȩ���ʺ�̨", null);
	        }

			if('admin' == MEMBER_ROLE_TYPE) {
				$this->_loginfailed(3);
			}
		}

		$this->Execute();
	}

	
	function Execute()
	{
		ob_start();
		switch($this->Code)
		{
			case 'logout':
				$this->LogOut();
				break;
			case 'dologin':
				$this->DoLogin();
				break;
			default:
				$this->login();
				break;
		}
		$body = ob_get_clean();

		$this->ShowBody($body);

	}
	
	function login() {
		

		$this->Title="�û���¼";
        if(jget('referer')){
            $referer = jget('referer');
        } else {
            $referer = referer($this->Config['site_url'] . '/admin.php');
        }

		if (jsg_getcookie('referer')=='') {
			jsg_setcookie('referer', $referer);
		}
		$action="admin.php?mod=login&code=dologin";


		include(template("admin/login"));
	}


	
	function DoLogin() {
		if(!$this->Username) {
			$this->Messager("�޷���¼,�û��������벻��Ϊ��");
		}

		if('' == $this->Password) {
			$this->Messager("�޷���¼,�û��������벻��Ϊ��");
		}

		$loginperm = $this->_logincheck();
		if(!$loginperm) {
			$this->Messager("�ۼ� 5 �δ����ԣ�15 �������������ܵ�¼��",null);
		}

		$rets = $UserFields = array();
		$rets = jsg_member_login_check($this->Username, $this->Password);
		if($rets['uid'] > 0) {
			$UserFields = jsg_member_login_set_status($rets['uid']);
		}

        if($rets['uid'] < 1 || !$UserFields) {
        	$this->Messager("�޷���¼,�û������������,������������ 5 �γ��ԡ�", -1);
        }

        if('normal' == $UserFields['role_type']) {
        	$this->Messager("��ͨ�û����Ա��Ȩ��¼��̨", null);
        }

        $this->_loginfailed(3);

        if(!($this->Config['close_second_verify_enable'])) {
			$authcode=authcode("{$UserFields['password']}\t{$UserFields['uid']}",'ENCODE',$this->jsgAuthKey);
			jsg_setcookie('jsgAuth', $authcode, 0, true);
        }

        $referer = jsg_getcookie('referer');
        if(!trim($referer)){
            $referer = referer($this->Config['site_url'] . '/admin.php');
        }

		$this->Messager("��¼�ɹ������ڽ����̨", $referer);
	}

	
	function LogOut() {
		jsg_setcookie('jsgAuth', '');
		jsg_setcookie('ajhAuth', '');
		jsg_setcookie('referer', '');

		$this->Messager('���Ѿ��ɹ��˳��˺�̨��<a href="'.$this->Config['site_url'].'"><b>��˷�����վ��ҳ</b></a>', null);
	}

	function _logincheck() {
		$onlineip= $GLOBALS['_J']['client_ip'];
		$timestamp=time();
		$query = $this->DatabaseHandler->Query("SELECT count, lastupdate FROM ".TABLE_PREFIX.'failedlogins'." WHERE ip='$onlineip'");
		if(false != ($login = $query->GetRow())) {
			if($timestamp - $login['lastupdate'] > 900) {
				return 3;
			} elseif($login['count'] < 5) {
				return 2;
			} else {
				return 0;
			}
		} else {
			return 1;
		}
	}

	function _loginfailed($permission) {
		$onlineip= $GLOBALS['_J']['client_ip'];
		$timestamp=time();

		$failedlogins = DB::fetch_first("SELECT count, lastupdate FROM ".TABLE_PREFIX.'failedlogins'." WHERE ip='$onlineip'");

		switch($permission) {
			case 1:	$this->DatabaseHandler->Query("REPLACE INTO ".TABLE_PREFIX.'failedlogins'." (ip, count, lastupdate) VALUES ('$onlineip', '1', '$timestamp')");
				break;
			case 2:
				if($failedlogins)
				{
					$this->DatabaseHandler->Query("UPDATE ".TABLE_PREFIX.'failedlogins'." SET count=count+1, lastupdate='$timestamp' WHERE ip='$onlineip'");
				}
				break;
			case 3:
				if($failedlogins)
				{
					$this->DatabaseHandler->Query("UPDATE ".TABLE_PREFIX.'failedlogins'." SET count='1', lastupdate='$timestamp' WHERE ip='$onlineip'");
				}
				$this->DatabaseHandler->Query("DELETE FROM ".TABLE_PREFIX.'failedlogins'." WHERE lastupdate<$timestamp-901", 'UNBUFFERED');
				break;
		}
	}
}

?>