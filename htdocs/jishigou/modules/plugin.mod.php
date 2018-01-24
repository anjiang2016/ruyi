<?php
/**
 * �ļ�����plugin.mod.php
 * @version $Id: plugin.mod.php 3729 2013-05-28 04:33:29Z chenxianfeng $
 * ���ߣ�����<foxis@qq.com>
 * ��������: ΢���������ģ�����
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

		$this->TopicLogic = jlogic('topic');

		$this->Execute();
	}
	function Execute()
	{
		ob_start();
		$this->Main();
		$body=ob_get_clean();
		$this->ShowBody($body);
	}
	function Main()
    {
		global $_J;
		if(!isset($_J['plugins'])) {
			jlogic('plugin')->loadplugincache();
		}
		$pluginid = jget('id');
		if(!empty($pluginid)) {
			list($identifier, $module) = explode(':', $pluginid);
			$module = $module !== NULL ? $module : $identifier;
		}
		$member = $this->_member();

		if(!is_array($_J['plugins']['hookmod']) || !array_key_exists($pluginid, $_J['plugins']['hookmod'])) {
			$this->Messager("��������ڻ��ѹر�");
		}
		if(empty($identifier) || !preg_match("/^[a-z]+[a-z0-9_]*[a-z]+$/i", $identifier) || !preg_match("/^[a-z]+[a-z0-9_]*[a-z]+$/i", $module)) {
			$this->Messager("δ����Ĳ���");
		}
		if(@!file_exists($modfile = PLUGIN_DIR.'/'.$identifier.'/'.$module.'.mod.php')) {
			$this->Messager("���ģ���ļ�(".$modfile.")�����ڻ��߲���ļ�������");
		}
		if($_J['plugins']['hookmod'][$pluginid]['role_id'] && 'admin' != MEMBER_ROLE_TYPE){
			$this->Messager("��û��Ȩ�޽��иò���");
		}
		$this->Title = $_J['plugins']['hookmod'][$pluginid]['navname'];
		include $modfile;
    }
	function _member()
	{
		$member = $this->TopicLogic->GetMember(MEMBER_ID);
		return $member;
	}
}
?>