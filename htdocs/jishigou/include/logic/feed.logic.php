<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename feed.logic.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 1490459402 3325 $
 */




if(!defined('IN_JISHIGOU')) {
    exit('invalid request');
}

class FeedLogic
{
	function FeedLogic()
	{
	}

	function addfeed($item='channel',$action='post',$tid=0,$msg='',$item_id=0,$anonymous=0)
	{
		if($GLOBALS['_J']['config']['feed_must'] || $item == 'mall'){		$default_items = array(
			'mall' => '���ֶһ�',
			'leader' => '��Ҫ����',
			'recommend' => '�Ƽ��ö�',
			'channel' => 'Ƶ��΢��',
		);
		$default_actions = array(
			'post' => '������',
			'reply' => '������',
			'forward' => 'ת����',
			'dig' => '������',
			'exchange' => '�һ���',
			'favorite' => '�ղ���',
			'recommend' => '�Ƽ���',
		);
		if($GLOBALS['_J']['config']['feed_must'] && $GLOBALS['_J']['config']['feed_user'] && is_array($GLOBALS['_J']['config']['feed_user']) && array_key_exists(MEMBER_ID,$GLOBALS['_J']['config']['feed_user'])){			$item = 'leader';
		}
		$set_ary = array(
			'uid' => MEMBER_ID,
			'nickname' => MEMBER_NICKNAME,
			'tid' => $tid,
			'item' => $default_items[$item] ? $default_items[$item] : '΢������',
			'item_id' => $item_id,
			'action' => $default_actions[$action] ? $default_actions[$action] : '������',
			'msg' => strip_tags($msg),
			'dateline' => time(),
		);
		$add_feed_msg = false;		
		if($item=='channel'){
			$cat_ary = jconf::get('channel');
			if($item_id && $cat_ary['feeds'] && is_array($cat_ary['feeds'])){
				if(array_key_exists($item_id,$cat_ary['feeds'])){
					$set_ary['item'] = $cat_ary['feeds'][$item_id];
					$add_feed_msg = true;
				}
			}
		}elseif($item=='mall'){
			$config = jconf::get('mall');
			$mall_enable = (int)$config['enable'];
			$feed_exchange = (int)$config['exchange'];
			$feed_post = (int)$config['post'];
			if($mall_enable && (($action=='post' && $feed_post) || ($action=='exchange' && $feed_exchange))){
				$add_feed_msg = true;
			}
		}elseif(in_array($item,array('leader','recommend'))){
			$add_feed_msg = true;
		}
		if($add_feed_msg){
			if($anonymous){				$set_ary['uid'] = 0;
				$set_ary['nickname'] = '������';
				$set_ary['item'] = '��������';
			}
			$id = DB::insert('feed_log', $set_ary, true);
			return $id;
		}
		}
	}

	function delete_feed($p=array()){
		$time = TIMESTAMP;
		if($p['all']){
			DB::Query("delete from ".DB::table('feed_log'));
		}elseif($p['week']){
			$time = $time - 7*24*3600;
			DB::Query("delete from ".DB::table('feed_log')." where `dateline` < '$time'");
		}elseif($p['month']){
			$time = $time - 30*24*3600;
			DB::Query("delete from ".DB::table('feed_log')." where `dateline` < '$time'");
		}elseif($p['ids']){
			$dids = is_array($p['ids']) ? $p['ids'] : (array)$p['ids'];
			DB::Query("delete from ".DB::table('feed_log')." where `id` in(".jimplode($dids).")");
		}
	}

	function get_feed($num = 5, $where = ''){
		$feed_lists = array();
		if($where){
			$where = " WHERE ".$where;
		}
		$query = DB::query("select * from ".DB::table('feed_log').$where." order by id desc limit ".$num);
		while (false != ($row = DB::fetch($query))){
			$feed_lists[$row['id']] = $row;
		}
		return $feed_lists;
	}
}
?>