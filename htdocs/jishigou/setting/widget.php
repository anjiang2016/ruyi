<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename widget.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 425317882 1244 $
 */

 
  
$config['widget'] = array (
	'test' => array(
		'header' => array(),
		'left' => array(),
		'right' => array('test' => array(), ),
		'footer' => array(),
	),
	'public' => array(
		'header' => array(),
		'left' => array(),
		'right' => array(),
		'footer' => array('link' => array(), 'navigation.footer' => array(), ),
	),
	'topic_index' => array(
		'header' => array(),
		'left' => array(),
		'right' => array('notice.right' => array('title'=>'��վ����', 'num'=>3, ), ),
		'footer' => array(),
	),
	'topic_new' => array(
		'header' => array(),
		'left' => array(),
		'right' => array('notice.right' => array('title'=>'���¹���', 'num'=>4, ), ),
		'footer' => array(),
	),
	'company' => array(
		'header' => array(),
		'left' => array(),
		'right' => array('notice.right' => array('title'=>'��վ����', 'num'=>5, ), ),
		'footer' => array(),
	),
	'qun_index' => array(
		'header' => array(),
		'left' => array(),
		'right' => array('qun_announcement.right' => array('num'=>3, ), ),
		'footer' => array(),
	),
	'qun_announcement_index' => array(
		'header' => array(),
		'left' => array(),
		'right' => array('qun_announcement.right' => array('num'=>30, ), ),
		'footer' => array(),
	),
);
?>