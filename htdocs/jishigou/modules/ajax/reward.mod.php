<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename reward.mod.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 2024577227 8473 $
 */


if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class ModuleObject extends MasterObject {

	var $Type = 'normal';

	function ModuleObject($config) {
		$this->MasterObject($config);

		if(!$this->Config['event_open']){
			$this->_image_error("����Ա�ѹر��н�ת������");
		}
		if(MEMBER_ID < 1){
			$this->_image_error('����Ҫ�ȵ�¼���ܼ���������');
		}

		$this->Execute();
	}

	function Execute(){
		ob_start();
		switch ($this->Code) {
			case 'detail':
				$this->RewardDetail();
				break;
			case 'addPrize':
				$this->addPrize();
				break;
			case 'delprize':
				$this->delPrize();
				break;
			case 'showtab':
				$this->showTab();
				break;
			case 'dodraw':
				$this->DoDraw();
				break;
			default:
								break;
		}
		response_text(ob_get_clean());
	}

	
	function RewardDetail(){
		$rid = jget('rid','int');
		$tid = jget('tid','int');

		if(!$rid || !$tid){
			response_text('��Ч���н�ת��ID');
		}

		$reward = jlogic('reward')->getRewardInfo($rid);

		if(!$reward){
			response_text('��Ч���н�ת��ID');
		}


		if($reward['time_lesser'] > 0){
			$hours = $reward['time_lesser'] % 86400;
			$day = floor($reward['time_lesser'] / 86400) ? floor($reward['time_lesser'] / 86400) .'��' : '';

			$i = $hours % 3600;
			$hours = floor($hours / 3600) ? floor($hours / 3600) .'ʱ' : '';

			$i = floor($i / 60) ? floor($i / 60) .'��' : '';

			$reward['time_lesser'] = '����ת���������� ' . $day . $hours . $i;
		} else {
			$reward['time_lesser'] = '�н�ת������';
		}
		if ($reward['rules']['tag']) {
			$content = '#'.implode('##',$reward['rules']['tag']).'#';
		}

		include template('widget/widget_reward_view');
	}

	
	function DoDraw(){
		#�н�ת���ID
		$rid = (int) get_param('rid');
		#��Ʒ�ȼ�
		$pid = get_param('pid');

		if(!$rid){ exit('��ȷ����Ҫ�齱���н�ת�����Ʒ�ȼ�'); }

		$ret = jlogic('reward')->DoDraw($rid,$pid);
		if(!$ret){
			exit('û�г�������������û���');
		} elseif (is_string($ret)){
			exit($ret);
		} elseif (is_array($ret)) {
			$html = '<table cellspacing="1" width="100%" align="center" class="tableborder">
					   <tr>
					     <td width="30%">�ǳ�</td><td width="30%">�ȼ�</td><td width="40%">��Ʒ</td>
					   </tr>';
			foreach ($ret as $k=>$v) {
				$html .= '<td><a href="index.php?mod='.$v['username'].'" target="_blank">'.$v['nickname'].'</td><td>'.$v['prize_name'].'</td><td>'.$v['prize'].'</td>';
			}
			$html .= '</table>';
		} else {
			exit('δ֪����');
		}

		exit($html);
	}

	function _image_error($msg)
	{
		if('normal' == $this->Type)
		{
						echo "<script type='text/javascript'>window.parent.MessageBox('warning', '{$msg}');</script>";
			exit ;
		}
		else
		{
			json_error($msg);
		}
	}

	function addPrize(){
		$id = (int) $this->Get['id'];


		$file = 'image_'.$id;
        if($_FILES[$file]['name']){

						$name = time();
			$image_name = $name.MEMBER_ID.".jpg";
			$image_path = RELATIVE_ROOT_PATH . 'images/reward/'.face_path(MEMBER_ID);
			$image_file = $image_path . $image_name;

			if (!is_dir($image_path))
			{
				jio()->MakeDir($image_path);
			}

			jupload()->init($image_path,$file,true);

			jupload()->setNewName($image_name);
			$result=jupload()->doUpload();

			if($result)
	        {
				$result = is_image($image_file);
			}
			if(!$result)
	        {
				unlink($image_file);
		        echo "<script type='text/javascript'>";
				echo "parent.document.getElementById('message').style.display='none';";
		        echo "</script>";
				$this->_image_error(jupload()->_error);
				exit();
			}
			image_thumb($image_file,$image_file,100,100);
			if($this->Config['ftp_on']) {
	            $ftp_key = randgetftp();
				$get_ftps = jconf::get('ftp');
	            $site_url = $get_ftps[$ftp_key]['attachurl'];
	            $ftp_result = ftpcmd('upload',$image_file,'',$ftp_key);
	            if($ftp_result > 0) {
	                jio()->DeleteFile($image_file);
	                $image_file = $site_url .'/'. str_replace('./','',$image_file);
	            }
	        }
			DB::query("insert into `".TABLE_PREFIX."reward_image` set `uid` = '".MEMBER_ID."',`image` = '$image_file' ");
			$image_id = DB::insert_id();
        } else {
	        echo "<script type='text/javascript'>";
			echo "alert('û��ͼƬ');";
	        echo "</script>";
	        exit();
        }

        echo "<script type='text/javascript'>";

		echo "parent.document.getElementById('message').style.display='none';";
		echo "parent.document.getElementById('show_image_$id').src='{$image_file}';";
		echo "parent.document.getElementById('show_image_$id').style.display='block';";
		echo "parent.document.getElementById('hid_image_$id').value='{$image_id}';";
        echo "</script>";
        exit;
	}

	
	function delPrize(){
		$iid = (int) $this->Get['iid'];
		if($iid < 1){
			return '';
		}

		$ret = DB::fetch_first("select `uid`,`image` from `".TABLE_PREFIX."reward_image` where `id` = '$iid'");
		$image = $ret['image'];
		$uid = $ret['uid'];
		if($uid < 1 || $uid != MEMBER_ID){
			return '';
		}
		if($image){
			unlink($image);
		}
		DB::query("delete from `".TABLE_PREFIX."reward_image` where id = '$iid'");

		return 'ɾ���ɹ�';
	}

	function showTab(){
		$html = '';
		$rid = (int) get_param('fid');
		$id = (int) get_param('id');

		if(!$rid || !$id){
			return '<div>δ֪����</div>';
		} else if(MEMBER_ID < 1){

			return '<div>��Ҫ��¼�ſ��Բ鿴�н���Ϣ��</div>';

		} else {
			#ת������
			if($id == 1){
				$html .= '<p>1���н�ת���ɷ������趨��Ʒ��ת��ԭ���Լ��ɲμӳ齱������ </p>';
				$html .= '<p>2��������߲������������ȡ���ã�������Ϊ��Ч����н��������ϵͳ�Զ��·����н�֪ͨΪ׼������־ܾ��������������Ϊ��ٻ��  </p>';
				$html .= '<p>3�����з���ת���������û���������Ѳμ�ת�����齱��</p>';
				$html .= '<p>4�������˽��ڽ�����ʹ��ϵͳ���߶���Чת���߽��г齱���������н�������  </p>';
				$html .= '<p>5���н�����������������"��ƽ������������"��ԭ�򣬼���������  </p>';
				$html .= '<p>6���н�������ؼ�ʱ��ϵ��������ȡ��Ʒ�� </p>';
				$html .= '<p>7����ֹ�κβ������ֶΣ��Ի�ΪĿ�ģ�����ע�����ʺţ��������Ϊ���뱾���һ�����֣����������Ȩȡ�����û��Ļ��ʸ�  </p>';
				$html .= '<p>8�����н��û�ɾ���˲��뱾���ת��΢�������������Ȩȡ������ʸ�</p>';
				$html .= '<p>9������ת�������Ȩ�鷢�������У�</p>';
				$html .= '<p>10��������Ӧ�ϸ��ܻ��û��ύ�������ϵ��Ϣ���Ͻ���й����������⣬�����ɷ����߳е���</p>';
				$html .= '<p>11�����н��û�ɾ���˲��뱾���ת��΢�������������Ȩȡ������ʸ�</p>';
			}

			#�н�����
			else if($id == 2){
				$reward = jlogic('reward')->getRewardInfo($rid);
				if(!$reward){$html .= '<div>�н�ת�����Ч��</div>';}

				$prize = $reward['prize'];

				$where = " where u.`rid` = '$rid' ";
				$pid = get_param('pid');
				if(isset($pid)) {
					$where .= " and u.`pid` = '$pid' ";
					$selected[$pid] = ' selected ';
				}

				$page = empty($this->Get['page']) ? 0 : (int) $this->Get['page'];
				$perpage = 8;
				if ($page == 0) {
					$page = 1;
				}
				$start = ($page - 1) * $perpage;
				$sql = "select u.*,m.username,m.nickname
						 from `".TABLE_PREFIX."reward_win_user` u
						 left join `".TABLE_PREFIX."members` m  on m.uid = u.uid
						 $where
						 limit $start,$perpage";
				$query = DB::query($sql);
				while($rs = DB::fetch($query)){
					$rs['dateline'] = date('Y-m-d H:i:s',$rs['dateline']);
					$prize_user_list[$rs['uid']] = $rs;
					$prize_user_list[$rs['uid']]['prize_name'] = $prize[$rs['pid']]['prize_name'];
					$prize_user_list[$rs['uid']]['prize'] = $prize[$rs['pid']]['prize'];
				}
				$count = DB::result_first('select count(*) from `'.TABLE_PREFIX."reward_win_user` u $where ");

				$param = array('rid'=>$rid,'id'=>$id,'pid'=>$pid);
				$multi = ajax_page($count, $perpage, $page, 'manage',$param);
			}

			#�ҵĽ�Ʒ
			else if ($id == 3) {
				$my_prize = jlogic('reward')->getUserPrize($rid);
			}
		}

		include_once template('reward/reward_tab_ajax');
	}
}
?>