<?php
/**
 *
 * TAG�����ļ�
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: tag.php 3320 2013-04-11 03:42:14Z wuliyong $
 */

/*------------------------- �������ÿ�ʼ --------------------------------*/

/*��tag�����ơ�*/
$config['tag']['table_name'] = TABLE_PREFIX.'tag';

/* user���������� */
$config['tag']['user_table_name'] = TABLE_PREFIX.'members';
$config['tag']['user_table_pri'] = 'uid';

/* my_tag������ */
$config['tag']['my_tag_table_name'] = TABLE_PREFIX.'my_tag';

/*------------------------- �������ý��� --------------------------------*/

/*��ҳ��Ĭ�ϵı��⡡*/
$config['tag']['page_title_default'] = "����";
$config['tag']['per_page_num'] = 200;
$config['tag']['total_record'] = 1000;
$config['tag']['cache_time'] = 1800;

$config['tag']['list_similar_tag_count'] = 10;

$config['tag']['user_list_per_page_num'] = 100;
$config['tag']['item_list_per_page_num'] = 20;
$config['tag']['item_default'] = 'topic';
$config['tag']['item_list'] = array(
	
	'topic' => array(
		'table_name' => TABLE_PREFIX . 'topic',
		'table_pri' => 'tid',
		'name' => $GLOBALS['_J']['config']['changeword']['n_weibo'],
		'value' => 'topic',
		'url' => 'index.php?mod=topic',
		'disable_update_item_table' => 1, //��ʱ��ֹ���´�topic���е�tag_count��tag�ֶ���Ϣ����Ϊ�������ֶ�û��ʹ�õ���
	),
);
?>