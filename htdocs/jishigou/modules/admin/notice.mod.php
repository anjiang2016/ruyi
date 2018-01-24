<?php
/**
 *
 * ��վ����ģ��
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: notice.mod.php 5462 2014-01-18 01:12:59Z wuliyong $
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


		$this->Execute();
	}

	
	function Execute()
	{
		ob_start();
		switch($this->Code)
		{
			case 'mailq':
				$this->MailQueue();
				break;
			case 'delMailQueue':
				$this->delMailQueue();
				break;
			case 'delete':
				$this->Delete();
				break;
			case 'add':
				$this->Add();
				break;
			case 'modify':
				$this->Modify();
				break;
			case 'domodify':
				$this->DoModify();
				break;
			default:
				$this->Code = 'notice_setting';
				$this->Main();
				break;
		}
		$body = ob_get_clean();

		$this->ShowBody($body);

	}

	
	function delMailQueue(){
		$ids = jget('ids');
		if($ids && is_array($ids)) {
			$list = jtable('mailqueue')->get($ids);
			foreach($list as $row) {
				jtable('mailqueue')->delete(array('uid'=>$row['uid']));
			}
		}
		$this->Messager('�����ɹ�','admin.php?mod=notice&code=mailq');
	}

	function MailQueue(){
		$msg_config = jconf::get('mail_msg');
		$site_url = $this->Config['site_url'];
		$site_name =  $this->Config['site_name'];

		$page_url = 'admin.php?mod=notice&code=mailq';
		$per_page_num = min(500, max(20, (int) (isset($_GET['pn']) ? $_GET['pn'] : $_GET['per_page_num'])));
		$count = DB::result_first("select count(*) from `".TABLE_PREFIX."mailqueue` ");

		$page_arr = page($count,$per_page_num,$page_url,array('return'=>'array',),'20 50 100 200 500');

		$sql = "select mq.*,m.username,m.nickname
				 from `".TABLE_PREFIX."mailqueue` mq
				 left join `".TABLE_PREFIX."members` m on m.uid = mq.uid
				 where `dateline` > 0
				 order by `dateline` {$page_arr['limit']}";
		$query = DB::query($sql);
		while ($rs = db::fetch($query)) {
			$msg = array();
			$rs['dateline'] = date('Y-m-d H:i:s',$rs['dateline']);
			if($rs['msg']){
				$nickname = $rs['nickname'];
				$msg = unserialize($rs['msg']);
				$site_new_data = array();
				$newpm = $msg['newpm'] ? $msg['newpm'] : 0;$newpm && $site_new_data['newpm'] = "��{$newpm}��δ��˽��";

				$at_new = $msg['at_new'] ? $msg['at_new'] : 0;$at_new && $site_new_data['at_new'] = "��@{$at_new}��";

				$comment_new = $msg['comment_new'] ? $msg['comment_new'] :0;$comment_new && $site_new_data['comment_new'] = "������{$comment_new}��";

				$event_new = $msg['event_new'] ? $msg['event_new'] : 0;$event_new && $site_new_data['event_new'] = "��{$event_new}�������";

				$fans_new = $msg['fans_new'] ? $msg['fans_new'] : 0 ;$fans_new && $site_new_data['fans_new'] = "������{$fans_new}����˿";

				$qun_new = $msg['qun_new'] ? $msg['qun_new'] : 0;$qun_new && $site_new_data['qun_new'] = "��{$qun_new}��Ⱥ����";

				$vote_new = $msg['vote_new'] ? $msg['vote_new'] : 0;$vote_new && $site_new_data['vote_new'] = "ͶƱ��{$vote_new}������";

				$dig_new = $msg['dig_new'] ? $msg['dig_new'] : 0;$dig_new && $site_new_data['dig_new'] = "����{$dig_new}��";

				$channel_new = $msg['channel_new'] ? $msg['channel_new'] : 0;$channel_new && $site_new_data['channel_new'] = "Ƶ����{$channel_new}������";

				$company_new = $msg['company_new'] ? $msg['company_new'] : 0;$company_new && $site_new_data['company_new'] = "��λ��{$company_new}������";

				$load = $msg['load'] ? $msg['load']."��" : '';

				$site_new_data = $site_new_data ? '<br>��'.implode('��',$site_new_data) .'��' : '';
				if($msg_config['msg']){
					$message = $msg_config['msg'];
					$message = str_replace(array(
						'newpm',
						'at_new',
						'comment_new',
						'event_new',
						'fans_new',
						'qun_new',
						'vote_new',
						'dig_new',
						'channel_new',
						'company_new',
						'load',
						'site_url',
						'site_name',
	                    'time',
	                    'nickname',
	                    'site_new_data','time'),array(
						$newpm,
						$at_new,
						$comment_new,
						$event_new,
						$fans_new,
						$qun_new,
						$vote_new,
						$dig_new,
						$channel_new,
						$company_new,
						$load,
						$site_url,
						$site_name,
	                    date('Y:m:d H:i:s'),
	                    $nickname,
	                    $site_new_data,$time),$message);
				} else {
					$message = "�𾴵�$nickname��<br>���ã�<br>��δ��¼{$site_name}��{$load}�ڼ䣬���յ���һЩ��Ϣ��".
							   "$site_new_data<br>���<a href='$site_url'>{$site_url}</a>�鿴" .
							   "<br><br>��<font color='gray'>����ʼ����Ѷ��������˸��ţ���<a href='$site_url/index.php?mod=settings&code=sendmail' targegt='_blank'>����޸���������</a></font>��<br>".data('Y-m-d H:i:s');
				}

				$message .= ($recommend_tips ? '<br><br><b>�ٷ��Ƽ����ݣ�</b>'.$recommend_tips : '');
				$rs['message'] = $message;
			}
			$mailQueue[$rs['qid']] = $rs;
		}

		include template('admin/mail_queue');
	}

	function Main()
	{
		$ButtonTitle = '���';
		$sql = "select `id`,`title`,`dateline` from `".TABLE_PREFIX."notice` order by `id` desc";
		$query = $this->DatabaseHandler->Query($sql);

		$notice_list=array();
		while($row=$query->GetRow())
		{
			$row['dateline'] = date('Y-m-d H:s:i',$row['dateline']);
			$notice_list[] = $row;
		}

		include template('admin/notice');
	}



	function Add()
	{
		$title   = $this->Post['title'];
		$content = $this->Post['content'];
		$timestamp = time();


		if(empty($title))
		{
			$this->Messager("�����빫�����",-1);
		}

		if(empty($content))
		{
			$this->Messager("�����빫������",-1);
		}

		$content = unfilterHtmlChars($content);


				$f_rets = filter($content);
		if($f_rets && $f_rets['error'])
		{
			$this->Messager($f_rets['msg'],-1);
		}


		$sql = "insert into `".TABLE_PREFIX."notice`(`title`,`content`,`dateline`) values ('{$title}','{$content}','{$timestamp}')";
		$this->DatabaseHandler->Query($sql);

		$this->_update_cache();
		$this->Messager("��ӳɹ�",'admin.php?mod=notice');
	}


	function Modify()
	{
		$ids = jget('ids', 'int');

		$sql="SELECT * FROM ".TABLE_PREFIX.'notice'." WHERE id='$ids'";
		$query = $this->DatabaseHandler->Query($sql);
		$notice_info=$query->GetRow();

		if($notice_info==false)
		{
			$this->Messager("��Ҫ�༭����Ϣ�Ѿ�������!");
		}

		$ButtonTitle = "�༭";
		$action = "admin.php?mod=notice&code=domodify";

		$notice_id = $notice_info['id'];
		$notice_title = $notice_info['title'];
		$notice_content = $notice_info['content'];

		include template('admin/notice_info');
	}

	function DoModify()
	{

		$title   = $this->Post['title'];
		$content = $this->Post['content'];

		if(empty($title))
		{
			$this->Messager("�����빫�����",-1);
		}

		if(empty($content))
		{
			$this->Messager("�����빫������",-1);
		}

				$f_rets = filter($content);
		if($f_rets && $f_rets['error'])
		{
			$this->Messager($f_rets['msg'],-1);
		}

		$content = unfilterHtmlChars($content);

		$dateline = time();

		$sql = "update `".TABLE_PREFIX."notice` set  `title`='{$title}' ,`content`='{$content}' ,`dateline` ='{$dateline}'  where `id`='" . (int) $this->Post['notice_id'] . "'";
		$this->DatabaseHandler->Query($sql);

		$this->_update_cache();
		$this->Messager("�༭�ɹ�",'admin.php?mod=notice');

	}

	function Delete()
	{
		$ids = (array) ($this->Post['ids'] ? $this->Post['ids'] : $this->Get['ids']);

		if(!$ids) {
			$this->Messager("��ָ��Ҫɾ���Ķ���");
		}

		$sql = "delete from `".TABLE_PREFIX."notice` where `id` in (".jimplode($ids).")";

		$this->DatabaseHandler->Query($sql);

		$this->_update_cache();
		$this->Messager($return ? $return : "�����ɹ�");

	}

	function _update_cache() {
		cache_file('rm', 'notice/', 1);
	}

}

?>
