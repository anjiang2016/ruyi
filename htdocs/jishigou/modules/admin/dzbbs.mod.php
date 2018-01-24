<?php
/**
 * �ļ����� dzbbs.mod.php
 * ��  �ߣ������� <foxis@qq.com>
 * @version $Id: dzbbs.mod.php 3740 2013-05-28 09:38:05Z wuliyong $
 * ���������� dzbbs for JishiGou
 * ��Ȩ���У� Powered by JishiGou dzbbs 1.0.0 (a) 2005 - 2099 Cenwor Inc.
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
			case 'dzbbs_save':
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
        $dzbbs = $dzbbs_config = jconf::get('dzbbs');
        if(!$dzbbs_config)
        {
            $dzbbs = $dzbbs_config = array
            (
                'enable' => 0,
            	'db_host' => 'localhost',
				'db_name' => 'discuz',
				'db_user' => 'root',
				'db_pass' => 'root',
				'db_port' => '3306',
				'db_pre'  => 'pre_',
				'charset' => 'gbk',
				'db_url'  => 'http:/'.'/',
				'dz_ver'  => 'dzx',
            );

            jconf::set('dzbbs',$dzbbs_config);
        }



		$dzbbs_enable = $this->jishigou_form->YesNoRadio('dzbbs[enable]',(int) ($dzbbs_config['enable']));
		$dzbbs_charset = $this->jishigou_form->Radio('dzbbs[charset]',array(array("name"=>"GBK","value"=>"gbk"),array("name"=>"UTF-8","value"=>"utf8")),$dzbbs_config['charset']);
		$dzbbs_dzver = $this->jishigou_form->Select('dzbbs[dz_ver]',array(array("name"=>"Discuz! ϵ��","value"=>"dz"),array("name"=>"Discuz! Xϵ��","value"=>"dzx")),$dzbbs_config['dz_ver']);

		include(template('admin/dzbbs'));
	}

    function DoSave()
    {

        $dzbbs = $this->Post['dzbbs'];

        $dzbbs_config_default = $dzbbs_config = jconf::get('dzbbs');
        $dzbbs_config['enable']  = ($dzbbs['enable'] ? 1 : 0);
		$dzbbs_config['db_host'] = $dzbbs['db_host'];
		$dzbbs_config['db_name'] = $dzbbs['db_name'];
		$dzbbs_config['db_user'] = $dzbbs['db_user'];
		$dzbbs_config['db_pass'] = $dzbbs['db_pass'];
		$dzbbs_config['db_port'] = $dzbbs['db_port'];
		$dzbbs_config['db_pre']  = $dzbbs['db_pre'];
		$dzbbs_config['charset'] = $dzbbs['charset'];
		$dzbbs_config['db_url']  = $dzbbs['db_url'];
		$dzbbs_config['dz_ver']  = $dzbbs['dz_ver'];

		if($dzbbs_config['enable']){
			$table_m = ($dzbbs['dz_ver'] == 'dzx') ? $dzbbs['db_pre'].'common_member' : $dzbbs['db_pre'].'members';
			include_once(ROOT_PATH.'./api/uc_api_db.php');
			$dz_db = new JSG_UC_API_DB();
			@$dz_db->connect($dzbbs['db_host'],$dzbbs['db_user'],$dzbbs['db_pass'],$dzbbs['db_name'],$dzbbs['charset'],1,$dzbbs['db_pre']);
			if(!($dz_db->link) || !($dz_db->query("SHOW COLUMNS FROM {$table_m}",'SILENT'))){
				$this->Messager("�޷�����Discuz���ݿ⣬��������д��Discuz���ݿ�������Ϣ�Ƿ���ȷ.");exit;
			}
		}

        if($dzbbs_config_default != $dzbbs_config)
        {
        	jconf::set('dzbbs',$dzbbs_config);
        }

		if($dzbbs_config['enable']!=$this->Config['dzbbs_enable'])
        {
            $config = array();
			$config['dzbbs_enable'] = $dzbbs_config['enable'];
			if($dzbbs_config['enable'] == 1){
				$config['ucenter_enable'] = 1;
				$config['pwbbs_enable'] = 0;
				$config['phpwind_enable'] = 0;
			}

            jconf::update($config);
        }

        $this->Messager("�޸ĳɹ�");
    }
}

?>
