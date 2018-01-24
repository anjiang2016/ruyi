<?php
/**
 * �ļ�����item.mod.php
 * @version $Id: item.mod.php 4681 2013-10-11 08:17:47Z chenxianfeng $
 * ���ߣ�����<foxis@qq.com>
 * ��������: Ӧ�ò�����AJAX��,Ŀǰ��live��talk�͵�λ�벿�����õ�
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

		if (!MEMBER_ID) {
			js_alert_output("���ȵ�¼����ע��һ���ʺ�");
		}
		Load::logic('live');
		$this->LiveLogic = new LiveLogic();
		Load::logic('talk');
		$this->TalkLogic = new TalkLogic();
		$this->Execute();
	}

	
	function Execute()
	{
		switch ($this->Code)
		{

			case 'checkname':
				$this->Checkname();
				break;
			case 'del':
				$this->Del();
				break;
			case 'sms':
				$this->Sms();
				break;
			case 'publishbox':
				$this->PublishBox();
				break;
			case 'second_cat':
				$this->second_cat();
				break;
			default:
				$this->Main();
				break;
		}
	}

	
	function Main()
	{
		response_text("���ڽ����С���");
	}

	
	function PublishBox()
	{
		$type = trim($this->Get['type']);
		$this->item = $item = trim($this->Get['item']);
		$this->item_id = $itemid = jget('itemid','int','G');
		$this->totid = $totid = jget('totid','int','G');
		$this->touid = $touid = jget('touid','int','G');
		$url = jurl('index.php?mod='.$item.'&code=view&id='.$itemid);
		$users = '';
		if($item == 'live'){
			$live = $this->LiveLogic->id2liveinfo($itemid);
			if(!empty($live) && $live['host_guest']){
				foreach($live['host_guest'] as $key => $val){
					$users .= ' @'.$val.' ';
				}
			}
			$defaust_value = '����΢������ֱ���Ƽ�������';
			$content = '������Ƽ�һ�������ֱ�����������ɣ���'.$live['livename'].'����ֱ��ʱ��:'.$live['date'].'&nbsp;'.$live['time'].'�����ֺͼα��� '.$users.'���ܸ����ϡ�ֱ����ַ��'.$url;
		}elseif($item == 'talk'){
			$talk = $this->TalkLogic->id2talkinfo($itemid);
			if(!empty($talk) && $talk['guest']){
				foreach($talk['guest'] as $key => $val){
					$users .= ' @'.$val['nickname'].' ';
				}
			}
			if($type == 'ask'){
				if($touid > 0){
					$username = '@'.DB::result_first("SELECT nickname FROM ".DB::table('members')." WHERE uid='{$touid}'");
				}else{
					$username = $users;
				}
				$defaust_value = '����΢������α�����';
				$content = '�� '.$username.' ����: ';
			}elseif($type == 'answer'){
				$username =  '@'.DB::result_first("SELECT nickname FROM ".DB::table('members')." WHERE uid='{$touid}'");
				$defaust_value = '����΢�����ش���������';
				$content = '�� '.$username.' �ظ�: ';
			}else{
				$defaust_value = '����΢�����ѷ�̸�Ƽ�������';
				$talk['time'] = str_replace('<br>','',$talk['time']);
				$content = '������Ƽ�һ������ķ�̸: ��'.$talk['talkname'].'������̸�α� '.$users.' ����̸����ʱ��'.$talk['date'].'&nbsp;'.$talk['time'].'���Ͻ�ȥ���ʰɡ�'.$url;
			}
		}
		$this->Code = $type;
		$albums = jlogic('image')->getalbum();
		include(template('topic_publish_ajax'));
		exit;
	}

	
	function Checkname()
	{
		$nickname=trim($this->Post['nickname']);
		$item=trim($this->Post['item']);
		$type=trim($this->Post['type']);
		$itemid=(int)$this->Post['itemid'];
		$uid = DB::result_first("SELECT uid FROM `".DB::table('members')."` WHERE nickname = '$nickname'");
		if($uid){
			if('company'==$item || 'department'==$item){
				$count = DB::result_first("SELECT COUNT(*) FROM `".DB::table('cp_manager')."` WHERE type = '$item' AND cpid = '$itemid' AND uid = '$uid' AND part = '$type'");
			}else{
				$count = DB::result_first("SELECT COUNT(*) FROM `".DB::table('item_user')."` WHERE item = '$item' AND itemid = '$itemid' AND uid = '$uid'");
			}
			if($count){
				$return = -1;
			}else{
				$return = $uid;
			}
		}else{
			$return = -2;
		}
		response_text($return);
	}

		function Del()
	{
		$id = (int)$this->Post['id'];
		$type = trim($this->Post['type']);
				if($id > 0 && 'admin' == MEMBER_ROLE_TYPE) {
			if('cp'==$type){
				DB::Query("DELETE FROM `".DB::table('cp_manager')."` WHERE id ='$id'");
			}else{
				DB::Query("DELETE FROM `".DB::table('item_user')."` WHERE iid ='$id'");
			}
		}
	}

		function Sms()
	{
		$uid = (int)$this->Post['uid'];
		$item = trim($this->Post['item']);
		$itemid = (int)$this->Post['itemid'];
		if($item == 'live'){
			$isdesign = $this->LiveLogic->is_design($uid,$itemid);
		}elseif($item == 'talk'){
			$isdesign = $this->TalkLogic->is_design($uid,$itemid);
		}
				if($uid > 0 && $itemid > 0 && ($item == 'live' || $item == 'talk')) {
			$setuser = array(
			'item' => $item,
			'itemid' => $itemid,
			'uid' => $uid,
			);
			if(empty($isdesign)){
				DB::insert('item_sms', $setuser, true);
				$return = 1;
			}else{
				$return = -1;
			}
		}else{
			$return = 0;
		}
		response_text($return);
	}

	
	function second_cat()
	{
		$cat_id = jget('cat_id','int','G');
		$groupselect = $this->TalkLogic->get_catselect($cat_id, 0, true);
		echo $groupselect['second'];
		exit;
	}
}
?>