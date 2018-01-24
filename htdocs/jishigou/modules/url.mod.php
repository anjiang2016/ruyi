<?php
/**
 *
 * ������תģ��
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

	function ModuleObject($config) {
		$this->MasterObject($config, 1);
	}

	function index() {
		$val = $this->Code;
		$key = $val;
		if (!$key && strlen($key) < 1) {
			$this->Messager("��ָ��URL���ӵ�ַ", null);
		}

		$url_info = jlogic('url')->get_info_by_key($key);
		if (!$url_info || !$url_info['url']) {
			$this->Messager("��ָ��һ����ȷ��URL���ӵ�ַ", null);
		}
		jlogic('url')->set_open_times($url_info['id'], '+1');

		$url = jconf::get('url');
		$status = (int) $url['status_set'][(int) $url_info['status']];
		if(3 === $status) {
			$this->Messager('��Ҫ���ʵ�URL���ӵ�ַ�Ѿ������ڻ��Ǳ���ֹ������', null);
		} elseif (2 === $status) {
			$this->Messager('��Ҫ���ʵ����ӵ�ַΪ����ȫ��δ֪����������ʣ�<br />' . $url_info['url'], null);
		} elseif (1 === $status) {
			$this->Messager("��Ҫ���ʵ����ӵ�ַΪ����ȫ��δ֪����������ʣ�<br />
				<a href='{$url_info['url']}' target=_blank title='������� {$url_info['url']}'>{$url_info['url']}</a>
				��<a href='{$url_info['url']}' target=_blank  title='������� {$url_info['url']}'>��˷���</a>��", null);
		} else {
						$this->Messager(null, $url_info['url']);
		}
	}

}
?>
