<?php

/**
 * iPhone��ʱ��Ϣ����
 * �ļ����� ios.mod.php
 * ��  �ߣ������� <foxis@qq.com>
 * @version $Id: ios.mod.php  2013-12-18 08:22:22Z chenxianfeng $
 * ���������� api for JishiGou
 * ��Ȩ���У� Powered by JishiGou API 1.0.0 (a) 2005 - 2099 Cenwor Inc.
 * ��˾��վ�� http://cenwor.com
 * ��Ʒ��վ�� http://jishigou.net
 */

if(!defined('IN_JISHIGOU'))
{
    exit('invalid request');
}

class ModuleObject extends MasterObject
{
    
	function ModuleObject($config)
	{
		$this->MasterObject($config);
        $this->Execute();
	}

	function Execute()
	{
		switch($this->Code)
		{
			case 'reg':
				$this->Reg();
				break;
			case 'out':
				$this->Out();
				break;
			default :
				$this->Main();
				break;
		}
	}

	function Main()
	{
		api_output('ios info push api is ok!');
	}

		function Reg(){
		$uid = max(0, (int) $this->Inputs['uid']);
		$token = $this->Inputs['token'];
		if($uid > 0 && strlen($token) == 64 && ctype_alnum($token)){
			jtable('ios')->delete(array('uid' => $uid));
			jtable('ios')->delete(array('token' => $token));
			jtable('ios')->insert(array('uid' => $uid,'token' => $token), 1);
		}
	}

		function Out(){
		$uid = max(0, (int) $this->Inputs['uid']);
		if($uid > 0){
			jlogic('ios')->loginout($uid);
		}
	}
}
?>