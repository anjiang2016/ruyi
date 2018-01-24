<?php
/**
 *
 * ������ת����ģ��
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: url.mod.php 3740 2013-05-28 09:38:05Z wuliyong $
 */


if(!defined('IN_JISHIGOU')) {
    exit('invalid request');
}


class ModuleObject extends MasterObject {

	
	var $auto_run = true;

	function ModuleObject($config) {
		$this->MasterObject($config);
	}

	
	function index() {
		;

		
		include template();
	}

	
	function setting() {
		
		if(jget('settingsubmit')) {
			$url = jget('url');
			$url['status_default'] = (int) $url['status_default'];
			foreach($url['status_set'] as $k=>$v) {
				$url['status_set'][$k] = (int) $v;
			}
			jconf::set('url', $url);

			$this->Messager('���óɹ�');
		}


		
		$url = jconf::get('url');
		$options = array(
			1 => array('value' => 1, 'name' => '�����������������ʣ�����<br />'),
			0 => array('value' => 0, 'name' => '���볣�棨Ĭ�ϣ�����<br />'),
			-1 => array('value' => -1, 'name' => '�������������ֹ���ʣ�����<br />'),
		);
		$status_default_radio = $this->jishigou_form->Radio('url[status_default]', $options, (int) $url['status_default']);
		$options = array(
			0 => array('value' => 0, 'name' => 'ֱ����ת����Ӧ�����ӵ�ַ���Ƽ����ڰ�������������ʣ����У�<br />'),
			1 => array('value' => 1, 'name' => '�������Ե�������ӵ�ַ����Ҫ����������ת���Ƽ����ڳ��棨Ĭ�ϣ����У�<br />'),
			2 => array('value' => 2, 'name' => '�������ӵ�ַ����Ҫ���и������ӵ�ַ���������ַ���н��з��ʣ��Ƽ����ڳ��棨Ĭ�ϣ����У�<br />'),
			3 => array('value' => 3, 'name' => '��ֹ���ʣ��Ƽ����ں���������ֹ���ʣ����У�<br />'),
		);
		$status_set_allow_radio = $this->jishigou_form->Radio('url[status_set][1]', $options, (int) $url['status_set'][1]);
		$status_set_normal_radio = $this->jishigou_form->Radio('url[status_set][0]', $options, (int) $url['status_set'][0]);
		$status_set_disallow_radio = $this->jishigou_form->Radio('url[status_set][-1]', $options, (int) $url['status_set'][-1]);

		
		include template();
	}

	
	function manage() {
		$p = array(
			'perpage' => 100,
			'page_url' => 'admin.php?mod=url&code=manage',
			'sql_order' => ' `id` DESC ',
		);
		$id = jget('id', 'int');
		if($id > 0) {
			$p['id'] = $id;
			$p['page_url'] .= "&id=$id";
		}
		$key = jget('key');
		if($key) {
			$p['key'] = $key;
			$p['page_url'] .= "&key=$key";
		}
		$url = jget('url');
		if($url) {
			$p['sql_where'] = " MATCH (`url`) AGAINST ('{$url}') ";
			$p['page_url'] .= "&url=$url";
		}
		$site_id = jget('site_id', 'int');
		if($site_id > 0) {
			$p['site_id'] = $site_id;
			$p['page_url'] .= "&site_id=$site_id";
		}
		$order = jget('order');
		if($order && in_array($order, array('dateline', 'open_times'))) {
			$p['sql_order'] = " `{$order}` DESC ";
			$p['page_url'] .= "&order=$order";
		}
		$rets = jlogic('url')->get($p);

		include template();
	}

	
	function do_manage() {
		$id = jget('id', 'int');
		$ids = jget('ids');
		if(!$ids && $id < 1) {
			$this->Messager('����ָ��Ҫ�����Ķ���');
		}
		$ids = (array) ($id > 0 ? $id : $ids);

		$info = array();
		if($id > 0) {
			$info = jlogic('url')->get_info_by_id($id);
		}

		$action = jget('action');
		if('delete' == $action) {
			jlogic('url')->delete(array('id' => $ids));
		} elseif('status') {
			$status = jget('status', 'int');
			jlogic('url')->set_status($ids, $status);
			if($info && ($site = jlogic('site')->get_info_by_id($info['site_id']))) {
				if(jget('confirm')) {
					jlogic('url')->set_status(array('site_id'=>$site['id']), $status);
					jlogic('site')->set_status(array('id'=>$site['id']), $status);
				} else {
					$url = "admin.php?mod=url&code=do_manage&action=status&status=$status&id=$id&confirm=1";
					$this->Messager("�Ѿ����óɹ���<a href='{$url}'>��˿��Խ���վ�� {$site['host']} �µ�����URL���ӵ�ַ������Ϊ��ͬ��״̬</a><br />��Ĭ�ϲ����ʱ��Ϊ����ת���б�ҳ�棩��", '', 5);
				}
			}
		}

		$this->Messager('�����ɹ�', 'admin.php?mod=url&code=manage');
	}

}
?>
