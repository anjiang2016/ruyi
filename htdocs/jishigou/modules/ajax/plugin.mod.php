<?php
/**
 * �ļ�����plugin.mod.php
 * @version $Id: plugin.mod.php 3700 2013-05-27 07:27:54Z wuliyong $
 * ���ߣ�����<foxis@qq.com>
 * ��������: ���ģ�鵥���õ���AJAX��
 */
if(!defined('IN_JISHIGOU'))
{
    exit('invalid request');
}

class ModuleObject extends MasterObject
{

	function ModuleObject(& $config)
	{
		$this->MasterObject($config);
		$this->Main();
	}

	function Main()
	{
		if(MEMBER_ID < 1) {
            response_text('��¼����ܼ�������');
        }
		global $_J;
		if(!isset($_J['plugins'])) {
			jlogic('plugin')->loadplugincache();
		}
		$pluginid = jget('id');
		if(!empty($pluginid)) {
			list($identifier, $module) = explode(':', $pluginid);
			$module = $module !== NULL ? $module : $identifier;
		}
		if(!is_array($_J['plugins']['hookmod']) || !array_key_exists($pluginid, $_J['plugins']['hookmod'])) {
			response_text("��������ڻ��ѹر�");
		}
		if(empty($identifier) || !preg_match("/^[a-z]+[a-z0-9_]*[a-z]+$/i", $identifier) || !preg_match("/^[a-z]+[a-z0-9_]*[a-z]+$/i", $module)) {
			response_text("δ����Ĳ���");
		}
		if(@!file_exists($modfile = PLUGIN_DIR.'/'.$identifier.'/'.$module.'.mod.php')) {
			response_text("���ģ���ļ�(".$modfile.")�����ڻ��߲���ļ�������");
		}
		if($_J['plugins']['hookmod'][$pluginid]['role_id'] && 'admin' != MEMBER_ROLE_TYPE){
			response_text("��û��Ȩ�޽��иò���");
		}
		include $modfile;
	}
}
?>