<?php
/**
 * �ļ����� ldap.mod.php
 * ��  �ߣ������� <foxis@qq.com>
 * @version $Id: ldap.mod.php 3727 2013-05-28 03:35:00Z wuliyong $
 * ���������� ldap for JishiGou
 * ��Ȩ���У� Powered by JishiGou ldap 1.0.0 (a) 2005 - 2099 Cenwor Inc.
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
		ob_start();
		switch($this->Code)
		{
			case 'ldap_save':
                {
                    $this->DoSave();
                    break;
                }

			default :
    			{
    				$this->Main();
    				break;
    			}
		}
		$this->ShowBody(ob_get_clean());
	}

	function Main()
	{
		if(@is_file(ROOT_PATH . 'include/class/ldap.class.php')){
			$ldap_server_enable = true;
			$ldap = jclass('ldap')->initialize();

			$ldap_enable = $this->jishigou_form->YesNoRadio('ldap_enable',(int) ($ldap['enable']));
		}else{
			$ldap_server_enable = false;
		}
		include(template('admin/ldap'));
	}

    function DoSave()
    {
		$msg = array(
			'1' => "�޸ĳɹ���",
			'0' => "�޸�ʧ�ܣ�",
			'-1' => "����ϵͳ<font color='red'>��֧��</font>�ù��ܣ��������������Ƿ�װ��������<font color='red'>php_ldap.dll</font>ģ�飡",
			'-2' => "<font color='red'>�޷������������</font>����������д�ķ�������ַ��˿��Ƿ���ȷ��",
			'-3' => "��û����д<font color='red'>AD���������ַ</font>���뷵��������д��",
			'-4' => "��û����д<font color='red'>�������ʺŻ���д����</font>���뷵��������д��"
		);
		$return = 0;
		if(@is_file(ROOT_PATH . 'include/class/ldap.class.php')){
			$return = jclass('ldap')->adsave($this->Post['ldap_email'],$this->Post['ldap_enable'],$this->Post['ldap_host'],$this->Post['ldap_port']);
		}
        $this->Messager($msg[$return],'',5);
    }
}

?>
