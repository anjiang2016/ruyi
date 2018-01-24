<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename qun.mod.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 503800212 15536 $
 */





if(!defined('IN_JISHIGOU')) {
    exit('invalid request');
}

class ModuleObject extends MasterObject
{
	var $item = 'qun';
	function ModuleObject($config)
	{
		$this->MasterObject($config);


				if ($this->Code != 'widgets') {
			if (MEMBER_ID < 1) {
				json_error("���ȵ�¼����ע��һ���ʺ�");
			}
		}

		$this->TopicLogic = jlogic('topic');

		Load::logic('qun');
		$this->QunLogic = new QunLogic();
		$this->Execute();
	}


	

	function Execute()
	{
		ob_start();
		switch($this->Code)
		{
			case 'setvoterecd':
				$this->setVoteRecd();
				break;
			case 'seteventrecd':
				$this->setEventRecd();
				break;
			case 'second_cat':
				$this->second_cat();
				break;
			case 'join':
				$this->join();
				break;
			case 'quit':
				$this->quit();
				break;
			case 'recd2w':
				$this->recd2w();
				break;
			case 'recdqun':
				$this->recdqun();
				break;
			case 'tcqun':
				$this->tcQun();
				break;
			case 'block':
				$this->block();
				break;
			case 'userfriends':
				$this->userfriends();
				break;
			case 'userfans':
				$this->userfans();
				break;
			case 'send_invite':
				$this->send_invite();
				break;
			case 'widgets':
				$this->widgets();
				break;
			default:
				exit();
				break;
		}
		response_text(ob_get_clean());
	}

	
	function setVoteRecd(){
		$qid = (int) $this->Post['qid'];
		$vid = (int) $this->Post['vid'];
		if($qid < 1 || $vid < 1){
			json_error('����ͶƱID');
		}

		$recd = DB::result_first("select recd from ".DB::table('qun_vote')." where qid = '$qid' and vid = '$vid' ");
		$msg = $recd ? 'ȡ���Ƽ��ɹ�' : '�Ƽ��ɹ��������Ҳ�ҳ�濴��';
		$recd = $recd ? 0 : 1;
		DB::query("update ".DB::table('qun_vote')." set recd = '$recd' where qid = '$qid' and vid = '$vid' ");
		json_result($msg);
	}

	
	function setEventRecd(){
		$qid = (int) $this->Post['qid'];
		$eid = (int) $this->Post['eid'];
		if($qid < 1 || $eid < 1){
			json_error('����ID');
		}

		$recd = DB::result_first("select recd from ".DB::table('qun_event')." where qid = '$qid' and eid = '$eid' ");
		$msg = $recd ? 'ȡ���Ƽ��ɹ�' : '�Ƽ��ɹ��������Ҳ�ҳ�濴��';
		$recd = $recd ? 0 : 1;
		DB::query("update ".DB::table('qun_event')." set recd = '$recd' where qid = '$qid' and eid = '$eid' ");
		json_result($msg);
	}

	
	function second_cat()
	{
		$cat_id = $this->Get['cat_id'];
		$groupselect = $this->QunLogic->get_catselect($cat_id, 0, true);
		echo $groupselect['second'];
		exit;
	}

	
	function join()
	{
		$qid = empty($this->Post['qid']) ? 0 : intval(trim($this->Post['qid']));
		if ($qid == 0) {
			json_error('����Ĳ���');
		}
		$qun_info = $this->QunLogic->get_qun_info($qid);
		if (empty($qun_info)) {
			json_error('��ǰ'.$this->Config[changeword][weiqun].'�����ڻ��Ѿ���ɾ��');
		}
		$r = $this->QunLogic->is_qun_member($qid, MEMBER_ID);
		if ($r) {
			json_error('���Ѿ��ǵ�ǰ'.$this->Config[changeword][weiqun].'��Ա��');
		}

				$join_type = $qun_info['join_type'];
		$tmp = $GLOBALS['_J']['member'];
		
		if(2 == $join_type) {
			json_error('��ǰ'.$this->Config[changeword][weiqun].'�ѽ�ֹ�κ����ټ���');
		}

		$message = '';
		if ($join_type == 1) {
			$message = trim($this->Post['message']);
			if (empty($message)) {
				$message = 'ʲô��û��д';
							}
			$message = getstr($message, 280, 1, 1);
		}
		$member = array(
			'uid' => MEMBER_ID,
			'username' => $tmp['username'],
			'message' => $message,
		);
		unset($tmp);

		$level = $this->QunLogic->qun_level($qid);
		if ($level['member_num'] <= $qun_info['member_num']) {
			json_error('�Ѿ��ﵽ���������޷��ټ���');
		}

		$this->QunLogic->join_qun($qid, $member, $join_type);
		if ($join_type == 0) {
									$nickname = DB::result_first("SELECT nickname
										  FROM ".DB::table('members')."
										  WHERE uid='{$qun_info['founderuid']}'");
			$data = array(
				'qid' => $qid,
				'nickname' => $nickname,
				'qun_name' => $qun_info['name'],
			);
			$txt_content = $this->_recd_msg('join_success', $data);

			
			$recd = true;
			$value = $txt_content;
						include template('qun/response_join');
								} else if ($join_type == 1) {
			            $sendMessage= "���������".$qun_info['name']."���������ɣ�".
                    $message."��������ˣ�".  jurl("index.php?mod=qun&code=manage&op=check_member&qid=".$qun_info['qid']);
            $founderinfo=jsg_member_info($qun_info['founderuid']);

            $sendR = jlogic("pm")->pmSend(array('to_user'=>$founderinfo['nickname'],'message'=>$sendMessage));
            			json_result('�������ɹ������ڵȴ����');
		}
		exit;
	}

	
	function quit()
	{
		$qid = empty($this->Post['qid']) ? 0 : intval(trim($this->Post['qid']));
		if ($qid == 0) {
			json_error('����Ĳ���');
		}
		$qun_info = $this->QunLogic->get_qun_info($qid);
		if (empty($qun_info)) {
			json_error('��ǰ'.$this->Config[changeword][weiqun].'�����ڻ��Ѿ���ɾ��');
		}
		$r = $this->QunLogic->is_qun_member($qid, MEMBER_ID);
		if ($r == 0) {
			json_error('����Ĳ���');
		}
		$this->QunLogic->quit_qun($qid, MEMBER_ID);
		json_result("�˳��ɹ�");
	}

		function create()
	{
	}

		function _recd_msg($type, $parma)
	{
		$message = '';
		$sys_config = jconf::get();
		$qun_url = $sys_config['site_url'].'/index.php?mod=qun&qid='.$parma['qid'];
		if ($type == 'join_success') {
			$message = '�Ҹռ����� @'.$parma['nickname'].' ��'.$this->Config[changeword][weiqun].' ��'.$parma['qun_name'].'�� ͦ����� '.$qun_url.' �Ƽ����Ҳ������~ ';
		} else if ($type == 'recd2w') {
			$message = '@'.$parma['nickname'].' ��'.$this->Config[changeword][weiqun].' "'.$parma['qun_name'].'" ͦ����� '.$qun_url.' �Ƽ����Ҳ������~ ';
		}
		return $message;
	}

	
	function userfriends()
	{
		$page = empty($this->Get['page']) ? 0 : intval($this->Get['page']);
		$qid = empty($this->Get['qid']) ? 0 : intval(trim($this->Get['qid']));
		if ($qid == 0) {
			js_alert_output('����Ĳ���');
		}
		$qun_info = $this->QunLogic->get_qun_info($qid);
		if (empty($qun_info)) {
			js_alert_output('��ǰ'.$this->Config[changeword][weiqun].'�����ڻ��Ѿ���ɾ��');
		}

				$prepage = 12;
		if ($page == 0) {
			$page = 1;
		}
		$start = ($page - 1) * $prepage;

		$buddyids = array();
		$uid = MEMBER_ID;
		$count = DB::result_first("SELECT COUNT(*)
								   FROM ".DB::table("buddys")."
								   WHERE `uid`='{$uid}' AND buddyid!='{$qun_info[founderuid]}'");

		if ($count) {
			$query = DB::query("SELECT `buddyid`
								FROM ".DB::table("buddys")."
								WHERE `uid`='{$uid}' AND buddyid!='{$qun_info[founderuid]}'
								LIMIT $start,$prepage");
			while ($value = DB::fetch($query)) {
				$buddyids[] = $value['buddyid'];
			}
			$members = $this->TopicLogic->GetMember($buddyids);
			$multi = ajax_page($count, $prepage, $page, 'getUserFriends', array('qid' => $qid));
			include_once(template("qun/userfriends"));
		}
	}

	
	function userfans()
	{
				$page = empty($this->Get['page']) ? 0 : intval($this->Get['page']);
		$qid = empty($this->Get['qid']) ? 0 : intval(trim($this->Get['qid']));
		if ($qid == 0) {
			json_error('����Ĳ���');
		}
		$qun_info = $this->QunLogic->get_qun_info($qid);
		if (empty($qun_info)) {
			json_error('��ǰ'.$this->Config[changeword][weiqun].'�����ڻ��Ѿ���ɾ��');
		}

		$prepage = 20;		if ($page == 0) {
			$page = 1;
		}
		$start = ($page - 1) * $prepage;
		$fans_ids = array();
		$uid = MEMBER_ID;
		$count = DB::result_first("SELECT count(*)
							FROM ".DB::table("buddys")."
							WHERE `buddyid`='{$uid}' AND uid!='{$qun_info[founderuid]}'");
		if ($count) {
			$query = DB::query("SELECT `uid`
								FROM ".DB::table("buddys")."
								WHERE `buddyid`='{$uid}' AND uid!='{$qun_info[founderuid]}'
								LIMIT $start,$prepage");
			while ($value = DB::fetch($query)) {
				$fans_ids[] = $value['uid'];
			}
			$members = $this->TopicLogic->GetMember($fans_ids);
			$multi = ajax_page($count, $prepage, $page, 'getUserFans', array('qid' => $qid));
		}
		include_once(template("qun/userfans"));
	}

	
	function send_invite()
	{
		$qid = empty($this->Post['qid']) ? 0 : intval(trim($this->Post['qid']));
		if ($qid == 0) {
			js_alert_output('����Ĳ���');
		}
		$qun_info = $this->QunLogic->get_qun_info($qid);
		if (empty($qun_info)) {
			js_alert_output('��ǰ'.$this->Config[changeword][weiqun].'�����ڻ��Ѿ���ɾ��');
		}

				if (!$this->QunLogic->is_qun_member($qid, MEMBER_ID)) {
			js_alert_output('û��Ȩ�޽��е�ǰ����');
		}

		$my = $GLOBALS['_J']['member'];
		$config = jconf::get();
		$qun_url = $config['site_url']."/index.php?mod=qun&qid=".$qid;
		$message = "��ã�{$my['nickname']} ��������� \"{$qun_info['name']}\" �����{$qun_url}���롣{$my['nickname']} ˵��\"\"";

	}

		function recd2w()
	{
		$qid = empty($this->Get['qid']) ? 0 : intval(trim($this->Get['qid']));
		if ($qid == 0) {
			js_alert_output('����Ĳ���');
		}
		$qun_info = $this->QunLogic->get_qun_info($qid);
		if (empty($qun_info)) {
			js_alert_output('��ǰ'.$this->Config[changeword][weiqun].'�����ڻ��Ѿ���ɾ��');
		}
		$nickname = DB::result_first("SELECT nickname
									  FROM ".DB::table('members')."
									  WHERE uid='{$qun_info['founderuid']}'");
		$data = array(
			'qid' => $qid,
			'nickname' => $nickname,
			'qun_name' => $qun_info['name'],
		);
		$value = $this->_recd_msg('recd2w', $data);
						include(template('qun/recommend2weibo'));
		
	}

		function recdqun()
	{
		$cat_id = empty($this->Get['cat_id']) ? 0 : intval(trim($this->Get['cat_id']));
		if (empty($cat_id)) {
			response_text('����Ĳ���');
		}
		$cat_ary = $this->QunLogic->get_category();		if (empty($cat_ary)) {
						exit;
		}

		$top_cat_ary = $cat_ary['first'];
		$sub_cat_ary = $cat_ary['second'];
		if (!isset($top_cat_ary[$cat_id])) {
			response_text('��ǰ���಻���ڻ����Ѿ���ɾ��');
		}

		if (empty($sub_cat_ary)) {
			response_text('��ǰ�����²�����'.$this->Config[changeword][weiqun]);
		}

		$cat_ids = array();
		foreach ($sub_cat_ary as $value) {
			if ($cat_id == $value['parent_id']) {
				$cat_ids[] = $value['cat_id'];
			}
		}
		$cat_ids[] = $cat_id;

		if (empty($cat_ids)) {
						exit;
		}

		$where_sql = "cat_id IN(".jimplode($cat_ids).")";

				$where_sql .= ' AND gview_perm=0 ';

				$where_sql .=' AND recd = 1 ';

				$limit = 10;
		$qun_list = array();
		$query = DB::query("SELECT *
							FROM ".DB::table('qun')."
							WHERE {$where_sql}
							ORDER BY member_num DESC
							LIMIT {$limit}");
		while ($value = DB::fetch($query)) {
			$value['icon'] = $this->QunLogic->qun_avatar($value['qid'], 's');
			$value['desc'] = getstr($value['desc'], 80);
			$qun_list[] = $value;
		}
		include_once template('qun/qun_list');
	}

		function tcQun(){
		$tc = 1;
		$province = (int) trim($this->Get['province']);
		$city = (int) trim($this->Get['city']);
		if (empty($province) && empty($city)) {
			response_text('����Ĳ���');
			exit;
		}

		$filed = $city ? "city" : "province";
		$id = $city ? $city : $province;

		$name = DB::result_first("select name from ".DB::table('common_district')." where id='$id'");;

		$limit = 10;
		$qun_list = array();
		$query = DB::query("SELECT *
							FROM ".DB::table('qun')."
							WHERE {$filed} = '$name'
							ORDER BY member_num DESC
							LIMIT {$limit}");
		while ($value = DB::fetch($query)) {
			$value['icon'] = $this->QunLogic->qun_avatar($value['qid'], 's');
			$value['desc'] = getstr($value['desc'], 80);
			$qun_list[] = $value;
		}
		include_once template('qun/qun_list');
	}

	
	function block()
	{
		$type = trim($this->Get['type']);
		$qun_list = array();
		if ($type == '24hot') {
			$qun_list = $this->QunLogic->get_hot_list();
			include_once template('qun/qun_block_list');
		}
		exit;
	}

	
	function widgets()
	{
		$op_ary = array('simple_desc', 'my_qun');
		$op = $this->Get['op'];
		if (!in_array($op, $op_ary)) {
						exit;
		}
		if ($op == 'simple_desc') {
			$qid = intval($this->Get['qid']);
			if (!$this->QunLogic->is_qun_member($qid, MEMBER_ID)) {
								exit;
			}
			$qun_info = $this->QunLogic->get_qun_info($qid);
			if (!empty($qun_info)) {
				$qun_info['icon'] = $this->QunLogic->qun_avatar($qun_info['qid'], 's');
			} else {
								exit;
			}
			include template('qun/widgets_simple_desc');
		} else if ($op == 'my_qun') {
						$uid = intval($this->Post['uid']);
			$where_sql = '';
			$limit_sql = '';
			$order_sql = '';
			if (!empty($uid)) {
				$where_sql = ' AND q.gview_perm=0 ';
								$limit_sql = ' LIMIT 12';
				$order_sql = ' ORDER BY q.topic_num DESC,q.member_num DESC';
			} else {
				if (MEMBER_ID < 1) {
					js_alert_output("���ȵ�¼����ע��һ���ʺ�");
				}
				$uid = MEMBER_ID;
			}
			$type = intval($this->Get['type']);
			$query = DB::query("SELECT q.qid,q.name
								FROM ".DB::table('qun_user')." AS qu
								LEFT JOIN ".DB::table('qun')." AS q
								USING(qid)
								WHERE qu.uid='{$uid}' {$where_sql}
								{$order_sql}
								{$limit_sql}");
			$myquns = array();
			while ($value = DB::fetch($query)) {
				$value['icon'] = $this->QunLogic->qun_avatar($value['qid'], 's');
				$myquns[] = $value;
			}

			if (!empty($uid)) {
				include template('qun/widgets_my_qun');
			} else {
				include template('qun/widgets_my_qun');
			}
		}
	}
}
?>
