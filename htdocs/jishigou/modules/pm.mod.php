<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename pm.mod.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 1719563370 10092 $
 */



if(!defined('IN_JISHIGOU'))
{
    exit('invalid request');
}

class ModuleObject extends MasterObject
{
	
	var $Code = array();

	
	var $ID = 0;

	
	var $Stat=array();

	var $Folder='inbox';

	var $FolderName='';


	
	var $IDS;

	
	function ModuleObject($config)
	{
		$this->MasterObject($config);

		$this->ID = jget('id', 'int');

		if (MEMBER_ID < 1) {
			$this->Messager("����<a onclick='ShowLoginDialog(); return false;'>��˵�¼</a>����<a onclick='ShowLoginDialog(1); return false;'>���ע��</a>һ���ʺ�",null);
		}

		$this->Execute();
	}

	
	function Execute()
	{
		ob_start();
		switch($this->Code)
		{
			case 'list':
				$this->PmList();
				break;
			case 'send':
				$this->Send();
				break;
			case 'dosend':
				$this->DoSend();
				break;
			case 'sendagain':
				$this->sendAgain();
				break;
			case 'history':
				$this->History();
				break;
			default:
				$this->PmList();
				break;
		}
		$Contents=ob_get_clean();
		$this->ShowBody($Contents);
	}

		function History(){
		$uid = MEMBER_ID;
		$touid = jget('uid', 'int');

		load::logic('pm');
		$PmLogic = new PmLogic();

		$link_folder = "history_{$touid}";
		$query_link = "index.php?mod=pm&code=history&uid=$touid&folder=$link_folder";

		$page = array();
		$page['per_page_num'] = 20;
		$page['query_link'] = $query_link;

		if($touid < 1){
			$return_arr = $PmLogic->getNotice($page);
		}else{
			$return_arr = $PmLogic->getHistory($uid,$touid,$page);
		}
		extract($return_arr);

		$member = jsg_member_info(MEMBER_ID);
		
		$TopicLogic = jlogic('topic');
		if ($member['medal_id']) {
			$medal_list = $TopicLogic->GetMedal($member['medal_id'],$member['uid']);
		}

		if($touid > 0) {
			if(empty($nickname)) {
				$_info = jsg_member_info($touid);
				$nickname = $_info['nickname'];
			}
			if(empty($nickname)) {
				$this->Messager('��Ҫ�鿴���û��Ѿ���������');
			}
			$n = "�Һ�{$nickname}��˽�ŶԻ�";
						$left_menu = $this->LeftMenu(array('name' => $n, 'link' => $query_link, 'icon' => 'history', 'touid' => $touid), $link_folder);
		} else {
			$n = "����Ա����֪ͨ";
		}
		$this->Title = $n;
		include template('pm/pm_history_list');
	}

	
	function sendAgain(){
		$pmid = (int) $this->Get['pmid'];
		$pm_list = array();
		$query = $this->DatabaseHandler->Query("select * FROM ".TABLE_PREFIX."pms WHERE pmid = '$pmid'");
		$pm_list = $query->GetRow();
		if($pm_list){
			$this->DatabaseHandler->Query("delete from ".TABLE_PREFIX."pms where pmid = '$pmid' ");
			$this->Post['to_user'] = $pm_list['tonickname'];
			$this->Post['message'] = $pm_list['message'];

			$this->DoSend('outbox');
		}else{
			$this->Messager("˽�Ų����ڻ���ɾ��");
		}
	}

	
	function PmList()
	{
		load::logic('pm');
		$PmLogic = new PmLogic();
		$member = jsg_member_info(MEMBER_ID);
		$folder = $this->Get['folder'] ? $this->Get['folder'] : 'inbox';
		$read = get_param('read');

		
		$TopicLogic = jlogic('topic');
		if ($member['medal_id']) {
			$medal_list = $TopicLogic->GetMedal($member['medal_id'],$member['uid']);
		}

		$topic_selected = 'pm';

		if($member['newpm'])
		{
						jlogic('member')->clean_new_remind('newpm', $member['uid']);
		}

				$page['per_page_num'] = 20;
		$return_arr = array();

		if($folder == 'inbox')
		{
			$query_link = "index.php?mod=" . ($_GET['mod_original'] ? get_safe_code($_GET['mod_original']) : $this->Module) . ($this->Code ? "&code={$this->Code}&folder=inbox" : "") . ($read ? "&read=1" : "");
			$page['query_link'] = $query_link;
			$page['read'] = $read;
			$return_arr = $PmLogic->getPmList($folder,$page);
			$this->Title = '�ҵ�˽��';
		}
		elseif($folder=='outbox')
		{
			$query_link = "mod=pm&code=list&folder=outbox";
			$page['query_link'] = $query_link;
			$return_arr = $PmLogic->getPmList($folder,$page);
			$this->Title = '�ݸ���';
		}

		extract($return_arr);

		$left_menu = $this->LeftMenu();

		include template('pm/pm_list');

	}

	
	function Send()
	{
		$member = jsg_member_info(MEMBER_ID);
		
		$TopicLogic = jlogic('topic');
		if ($member['medal_id']) {
			$medal_list = $TopicLogic->GetMedal($member['medal_id'],$member['uid']);
		}

		$topic_selected = 'pm';

		$this->Title='��������Ϣ';
		$action="index.php?mod=pm&code=dosend";
				$to_user = jget('to_user', 'txt');
		if(empty($to_user)) {
			$to_user = jget('nickname', 'txt');
			if(empty($to_user)) {
				$to_user = jget('to', 'txt');
			}
		}
		$message = jget('message');
		$subject = $this->Get['subject']?$this->Get['subject']:$this->Post['subject'];
		$to_admin = jget('to_admin', 'int');
		$to_admin_id = jget('to_admin_id', 'int');

		if($this->ID!=1)
		{
			$sql="select msgtoid,msgfrom,subject,message from ".TABLE_PREFIX.'pms'." where pmid = '{$this->ID}'";
			$query = $this->DatabaseHandler->Query($sql);
			$pm=$query->GetRow();

			if ($pm!=false)
			{
				$to_user = $pm['msgfrom'];
				$subject="�ظ�:".$pm['subject'];
				$pm['message'] = $pm['message'];
			}
		}
		$left_menu=$this->LeftMenu();

		        $my_grouplist = jlogic('buddy_follow_group')->get_my_group(MEMBER_ID);

		include template('pm/pm_write');
	}

	
	function DoSend($folder='')
	{
		if(MEMBER_ID < 1)
		{
		  $this->Messager("����<a onclick='ShowLoginDialog(); return false;'>��˵�¼</a>����<a onclick='ShowLoginDialog(1); return false;'>���ע��</a>һ���ʺ�",null);
		}

		$this->Post['message'] = jpost('message', 'txt');

		load::logic('pm');
		$PmLogic = new PmLogic();
		$return = $PmLogic->pmSend($this->Post);
		switch ($return){
			case '1':
				$this->Messager("���ݲ���Ϊ��");
				break;
			case '2':
				$this->Messager("�ռ��˲���Ϊ��");
				break;
			case '3':
				$this->Messager("�ռ��˲�����");
				break;
			case '4':
				$this->Messager("��Ϣ�Ѿ�����ݸ���","index.php?mod=pm&code=list&folder=outbox");
				break;
			case '5':
				$this->Messager("��Ϣ�����ڻ���ɾ��");
			case '6':
				$this->Messager("�����û���û�з�˽�ŵ�Ȩ��");
			case '7':
			default:
				if($return && is_string($return)) {
					$this->Messager($return);
				}
				break;
		}
		$folder = $folder ? $folder : 'inbox';
  		$this->Messager(NULL,"index.php?mod=pm&code=list&folder=$folder");
	}


	
	function LeftMenu($add_row = array(), $folder_key = '')
	{
				$folder = jget('folder', 'txt');
		if(empty($folder)) {
			$folder = $folder_key ? $folder_key : 'inbox';
		}


		$ks = array('send', 'inbox', 'outbox', );

		$left_menu_list=
		array
		(
			"���Ų���"=>
			array
			(
				'send'=>array('name'=>"��������Ϣ",'link'=>"?mod=pm&code=send&folder=send",'icon'=>'write'),
			),
			"��������"=>
			array
			(
				'inbox'=>array('name'=>"�ҵ�˽��",'link'=>"?mod=pm&code=list&folder=inbox",'icon'=>'inbox','stat'=>" [<a  href='index.php?mod=pm&code=list&folder=inbox&filter=newpm' title='δ��'>δ�� <span id='pm_inbox_unread'>{$this->Stat['inbox_unread_count']}</span></a>] [�� <span id='pm_inbox'>{$this->Stat['inbox_count']}</span>]"),
				'outbox'=>array('name'=>"�ݸ���",'link'=>"?mod=pm&code=list&folder=outbox",'icon'=>'send','stat'=>" [{$this->Stat['outbox_count']}]")
			)
		);

		$pm_to_admin = jconf::get('pm_to_admin');
		if($pm_to_admin && $pm_to_admin['list']) {
			foreach($pm_to_admin['list'] as $k => $row) {
				if($row['enable'] && $row['name'] && $row['to_admin'] && $row['to_uids']) {
					if(!in_array(MEMBER_ID, $row['to_uids'])) {
						if($row['link_to_list'] && is_numeric($row['to_uid']) && $row['to_uid'] > 0) {
							$key = "history_{$row['to_uid']}";
							$link = "?mod=pm&code=history&uid={$row['to_uid']}&folder={$key}";
						} else {
							$key = "send_$k";
							$link = "?mod=pm&code=send&folder=$key&to_admin=1&to_admin_id=$k&nickname={$row['to_admin']}";
						}
						$left_menu_list[] = array(
							$key => array('name' => $row['name'], 'link' => $link, 'icon' => 'write'),
						);
						$ks[] = $key;
					} else {
						if($add_row['touid'] > 0 && MEMBER_ID == $add_row['touid']) {
							$this->Messager(null, 'index.php?mod=pm&code=list&folder=inbox');
						}
					}
				}
			}
		}

				if(is_array($add_row) && $add_row['name'] && $add_row['link'] && $folder_key && !in_array($folder_key, $ks)) {
			$left_menu_list[] = array($folder_key => $add_row);
		}

		ob_start();

		include template('pm/pm_left_menu');
		Return ob_get_clean();
	}
}

?>