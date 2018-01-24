<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename live.logic.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 630728086 15251 $
 */




if(!defined('IN_JISHIGOU')) {
    exit('invalid request');
}

class LiveLogic
{
	var $mybuddys;
	function LiveLogic()
	{
		$buddyids = get_buddyids(MEMBER_ID);
		$this->mybuddys = is_array($buddyids) ? $buddyids : array($buddyids);
		$this->TopicLogic = jlogic('topic');
	}

	
	function get_list($param)
	{
		$live_list = array();
		$lids = array();		$guestall = array();		$time = time();
		extract($param);
		$limit_sql = '';
		$order_sql = '';
		$where_sql = ' WHERE 1=1 ';
		if ($where) {
			$where_sql .= ' AND '.$where;
		}
		if ($order) {
			$order_sql .= $order;
		}
		if ($limit) {
			$limit_sql = ' LIMIT '.$limit;
		}
		$total_record = DB::result_first("SELECT COUNT(*) FROM ".DB::table('live')." {$where_sql}");
		if ($total_record > 0) {
			if ($param['perpage']) {
				$page_arr = page($total_record, $param['perpage'], $param['page_url'], array('return'=>'array'));
				$limit_sql = $page_arr['limit'];
			} else {
				if ($param['limit']) {
					$limit_sql = ' LIMIT '.$param['limit'];
				}
			}
			$query = DB::query("SELECT * FROM ".DB::table('live')." {$where_sql} {$order_sql} {$limit_sql}");
			while($value = DB::fetch($query)) {
				if($value['starttime'] > $time){
					$value['status_css'] = 'ico_notyet';
					$value['status'] = 'δ��ʼ';
				}elseif($value['endtime'] < $time){
					$value['status_css'] = 'ico_complete';
					$value['status'] = '�����';
				}else{
					$value['status_css'] = 'ico_ongoing';
					$value['status'] = '������';
				}
				$value['datetime'] = date('Y-m-d H:i',$value['starttime']).' - '.date('Y-m-d H:i',$value['endtime']);
				if(date('Y-m-d',$value['starttime']) != date('Y-m-d',$value['endtime'])){
					$value['ldate'] = date('m-d H:i',$value['starttime']).'��'.date('m-d H:i',$value['endtime']);
				}else{
					$value['ldate'] = date('Y-m-d H:i',$value['starttime']).'-'.date('H:i',$value['endtime']);
				}
				$value['shortname'] = cut_str($value['livename'], 18);
				$live_list[$value['lid']] = $value;
				$lids[]=$value['lid'];
			}
			$guestall = $this->Getguest($lids);
			foreach($live_list as $key => $val){
				$live_list[$key] = array_merge($live_list[$key],$guestall[$key]);
			}
			$info = array(
				'list' => $live_list,
				'count' => $total_record,
				'page' => $page_arr,
			);
			return $info;
		}
	}

	
	function get_user($itemid=0,$type='guest')
	{
		$list = $this->Getguest($itemid);
		return $list[$itemid][$type];
	}

	
	function get_users($type='',$itemid=0,$limit=3)
	{
		$list = $this->Getguest($itemid);
		return $list[$itemid][$type];
	}

	
	function get_liveinfo($lid,$list = array())
	{
		$live = DB::fetch_first("SELECT * FROM ".DB::table('live')." WHERE lid='{$lid}'");
		$list = empty($list) ? $this->Getguest($lid) : $list;
		foreach($list[$lid] as $key => $val){
			if($key != 'host_guest' && !empty($val) && $key != 'all'){
				foreach($val as $k => $v){
					$list[$lid][$key][$k]['followed'] = $this->is_followed($v['uid']);
				}
			}
			$live[$key] = $list[$lid][$key];
		}
		$live['starttime'] = date('Y-m-d H:i',$live['starttime']);
		$live['endtime'] = date('Y-m-d H:i',$live['endtime']);
		return $live;
	}
	function id2liveinfo($lid,$list = array())
	{
		$time = time();
		$live = DB::fetch_first("SELECT * FROM ".DB::table('live')." WHERE lid='{$lid}'");
		if(date('Y-m-d',$live['starttime']) != date('Y-m-d',$live['endtime'])){
			$live['date'] = date('m��d',$live['starttime']).'��'.date('m��d',$live['endtime']);
		}else{
			$live['date'] = date('Y��m��d��',$live['starttime']);
		}
		$live['time'] = date('H:i',$live['starttime']).'-'.date('H:i',$live['endtime']);
		if($live['starttime'] > $time){
			$live['status_css'] = 'ico_notyet';
			$live['clock_css'] = 'ico_clock_normal';
			if($this->is_design(MEMBER_ID,$live['lid'])){
				$live['btn_css'] = 'btn_dzwc';
			}else{
				$live['btn_css'] = 'btn_wydz';
			}
			$live['status'] = 'δ��ʼ';
			$live['str'] = '����';
			$live['banner'] = 'Ԥ��';
		}elseif($live['endtime'] < $time){
			$live['status_css'] = 'ico_complete';
			$live['clock_css'] = 'ico_clock_gray';
			$live['btn_css'] = 'btn_wyfx';
			$live['status'] = '�����';
			$live['str'] = '����';
			$live['banner'] = '�ع�';
		}else{
			$live['status_css'] = 'ico_ongoing';
			$live['clock_css'] = 'ico_clock_on';
			$live['btn_css'] = 'btn_wycy';
			$live['status'] = '������';
			$live['str'] = '����';
			$live['banner'] = '����ʱ';
		}
		$list = empty($list) ? $this->Getguest($lid) : $list;
		foreach($list[$lid] as $key => $val){
			if($key != 'host_guest' && !empty($val) && $key != 'all'){
				foreach($val as $k => $v){
					$list[$lid][$key][$k]['followed'] = $this->is_followed($v['uid']);
				}
			}
			$live[$key] = $list[$lid][$key];
		}
		$live['starttime'] = date('Y-m-d H:i',$live['starttime']);
		$live['endtime'] = date('Y-m-d H:i',$live['endtime']);
		return $live;
	}

	
	function id2subject($lid)
	{
		static $livename;
		if($livename[$lid]){
			$subject = $livename[$lid];
		}else{
			$subject = DB::result_first("SELECT livename FROM ".DB::table('live')." WHERE lid='{$lid}' ");
			$livename[$lid] = $subject;
		}
		return $subject;
	}

	
	function id2usertype($lid=0,$uid=0,$list = array())
	{
		$list = empty($list) ? $this->Getguest($lid) : $list;
		foreach($list[$lid]['all'] as $k => $v){
			if($k == $uid){
				$return = $v;
				break;
			}
		}
		return $return;
	}

	
	function is_exists($lid)
	{
		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('live')." WHERE lid='{$lid}'");
		return $count > 0 ? true : false;
	}

	
	function is_design($uid=0,$itemid=0)
	{
		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('item_sms')." WHERE uid='{$uid}' AND item='live' AND itemid='$itemid'");
		return $count;
	}

	
	function is_followed($buid=0)
	{
				return in_array($buid,$this->mybuddys);
	}

	
	function create($post)
	{
		$setarr = array(
			'livename' => $post['livename'],
			'description' => $post['description'],
			'image' => $post['image'],
			'starttime' => strtotime($post['starttime']),
			'endtime' => strtotime($post['endtime']),
		);
		$lid = DB::insert('live', $setarr, true);
		if($lid && !empty($_FILES['image']['name'])){
						$this->upload_pic($lid);
		}
		return ($lid ? $lid : 0);
	}

	
	function adduser($item='live',$type='guest',$itemid=0,$uid=0,$userabout='')
	{
		$setuser = array(
			'item' => $item,
			'type' => $type,
			'itemid' => $itemid,
			'uid' => $uid,
			'description' => $userabout,
		);
		DB::insert('item_user', $setuser, true);
	}

	
	function modify($post)
	{
		$setarr = array(
			'livename' => $post['livename'],
			'description' => $post['description'],
			'image' => $post['image'],
			'starttime' => strtotime($post['starttime']),
			'endtime' => strtotime($post['endtime']),
		);
		$return = DB::update('live', $setarr, array('lid' => jget('lid','int','P')));
		if($return && !empty($_FILES['image']['name'])){
						$this->upload_pic(jget('lid','int','P'));
		}
		return ($return ? $return : 0);
	}

	
	function delete($ids)
	{
		if (!is_array($ids)) {
			$ids = (array)$ids;
		}
				DB::query("DELETE FROM ".DB::table('item_user')." WHERE item = 'live' AND itemid IN (".jimplode($ids).")");
				DB::query("DELETE FROM ".DB::table('item_sms')." WHERE item = 'live' AND itemid IN (".jimplode($ids).")");
				DB::update('topic', array('item'=>'','item_id'=>0), " WHERE `tid` IN (SELECT tid FROM ".DB::table('topic_live')." WHERE item_id IN (".jimplode($ids)."))");
		DB::update('topic', array('type'=>'first'), " WHERE `tid` IN (SELECT tid FROM ".DB::table('topic_live')." WHERE item_id IN (".jimplode($ids).")) AND `type` = 'live'");
				DB::query("DELETE FROM ".DB::table('topic_live')." WHERE item_id IN (".jimplode($ids).")");
				$polls = DB::query("DELETE FROM ".DB::table('live')." WHERE lid IN (".jimplode($ids).")");
		return $polls;
	}

	
	function dopost($post,$type='')
	{
		if(empty($post['livename'])){
			$return = "ֱ�����ⲻ��Ϊ��";
		}elseif(empty($post['description'])){
			$return = "ֱ��˵������Ϊ��";
		}elseif(empty($post['starttime'])){
			$return = "ֱ����ʼʱ�䲻��Ϊ��";
		}elseif(empty($post['endtime'])){
			$return = "ֱ������ʱ�䲻��Ϊ��";
		}elseif(strtotime($post['starttime']) >= strtotime($post['endtime'])){
			$return = "ֱ������ʱ�䲻�����ڿ�ʼʱ��";
		}elseif(empty($post['old_uid_host']) && empty($post['uid_host'])){
			$return = "ֱ�������˲���Ϊ��";
		}elseif(empty($post['old_uid_guest']) && empty($post['uid_guest'])){
			$return = "ֱ���α�����Ϊ��";
		}else{
			if($type == 'edit'){
				$this->modify($post);
				$lid = jget('lid','int','P');
			}else{
				$lid = $this->create($post);
			}
			if(isset($post['userabout_host']) && $post['uid_host'] && is_array($post['uid_host'])){
				foreach($post['userabout_host'] as $key => $value){
					$this->adduser('live','host',$lid,$post['uid_host'][$key],$value);
				}
			}
			if(isset($post['userabout_guest']) && $post['uid_guest'] && is_array($post['uid_guest'])){
				foreach($post['userabout_guest'] as $key => $value){
					$this->adduser('live','guest',$lid,$post['uid_guest'][$key],$value);
				}
			}
			if(isset($post['userabout_media']) && $post['uid_media'] && is_array($post['uid_media'])){
				foreach($post['userabout_media'] as $key => $value){
					$this->adduser('live','media',$lid,$post['uid_media'][$key],$value);
				}
			}
			if($type == 'edit'){
				$return = "ֱ���޸ĳɹ�";
			}else{
				$return = "ֱ�����ӳɹ�";
			}
		}
		return $return;
	}

	function upload_pic($id){

		$image_name = $id.".png";
		$image_path = RELATIVE_ROOT_PATH . 'images/live/'.face_path($id);
		$image_file = $image_path . $image_name;

		if (!is_dir($image_path))
		{
			jio()->MakeDir($image_path);
		}

		jupload()->init($image_path,'image',true);
		jupload()->setMaxSize(1000);
		jupload()->setNewName($image_name);
		$result=jupload()->doUpload();

		if($result)
        {
			$result = is_image($image_file);
		}
		if(!$result)
        {
			unlink($image_file);
			return false;
		}else{
			DB::update('live', array('image' => $image_file), array('lid' => $id));
		}
		return true;
	}

		function Getguest($ids)
	{
		$list = array();$uids = array();$guests = array();
		$ids = is_array($ids) ? $ids : array((int)$ids);
		$query = DB::query("SELECT iid,itemid,uid,description,type FROM ".DB::table('item_user')." WHERE item = 'live' AND itemid IN(".jimplode($ids).")");
		while($row = DB::fetch($query)) {
			$uids[] = $row['uid'];
			$guests[$row['itemid']][$row['uid']]['type'] = $row['type'];
			$guests[$row['itemid']][$row['uid']]['iid'] = $row['iid'];
			$guests[$row['itemid']][$row['uid']]['description'] = $row['description'];
		}
		$uids = array_unique($uids);
		$users = $this->TopicLogic->GetMember($uids, "`uid`,`ucuid`,`username`,`nickname`,`face`,`face_url`,`fans_count`,`validate`,`validate_category`");
		foreach($guests as $key => $val ){
			$guests_g = array();			$guests_h = array();			$guests_m = array();			$guests_hg = array();			$guests_a = array();			foreach($val as $k => $v ){
				$users[$k] = (array) $users[$k];
				$guests_a[$key][$k] = (array) $guests[$key][$k]['type'];
				if($guests[$key][$k]['type'] == 'guest'){
					unset($guests[$key][$k]['type']);
					$guests_g[$key][$k] = array_merge($users[$k],$guests[$key][$k]);
					$guests_hg[$key][$k] = $users[$k]['nickname'];
				}elseif($guests[$key][$k]['type'] == 'host'){
					unset($guests[$key][$k]['type']);
					$guests_h[$key][$k] = array_merge($users[$k],$guests[$key][$k]);
					$guests_hg[$key][$k] = $users[$k]['nickname'];
				}elseif($guests[$key][$k]['type'] == 'media'){
					unset($guests[$key][$k]['type']);
					$guests_m[$key][$k] = array_merge($users[$k],$guests[$key][$k]);
				}
			}
			$list[$key]['guest'] = $guests_g[$key];
			$list[$key]['host'] = $guests_h[$key];
			$list[$key]['media'] = $guests_m[$key];
			$list[$key]['host_guest'] = $guests_hg[$key];
			$list[$key]['all'] = $guests_a[$key];
		}
		return $list;
	}

	
	function get_script_out_list($live_num = 1, $topic_num = 2, $str_num = 200)
	{
		$time = time();
		$out_script_live = array();
		$query = DB::query("SELECT * FROM ".DB::table('live')." WHERE starttime <= '$time' ORDER BY `endtime` DESC LIMIT ".$live_num);
		while($row = DB::fetch($query)) {
			$out_script_live[] = $row;
		}
		if($out_script_live){
			foreach($out_script_live as $key => $val){
				$uids = $tids = $topic_list = array();
				$guestall = $this->Getguest($val['lid']);
				$uids = array_keys($guestall[$val['lid']]['host_guest']);
				$query = DB::query("SELECT tid FROM ".DB::table('topic_live')." WHERE item_id='".$val['lid']."' AND uid IN(".implode(",",$uids).") ORDER BY `tid` DESC LIMIT ".$topic_num);
				while($row = DB::fetch($query)) {
					$tids[] = $row['tid'];
				}
				if($tids){
					$options = array('tid'=>$tids,'count'=>'20','order'=>'dateline DESC');
					$TopicListLogic = jlogic('topic_list');
					$info = $TopicListLogic->get_data($options);
					$topic_list = array_merge($info['list']);
					foreach($topic_list as $k => $v){
						$topic_list[$k]['content'] = cut_str(strip_tags($v['content']),$str_num);
					}
				}
				if($val['endtime'] < $time){
					$out_script_live[$key]['status'] = '�����';
				}else{
					$out_script_live[$key]['status'] = '������';
				}
				$out_script_live[$key]['datetime'] = date('Y-m-d H:i',$val['starttime']).' - '.date('Y-m-d H:i',$val['endtime']);
								$out_script_live[$key]['host_user'] = array_merge($guestall[$val['lid']]['host']);				$out_script_live[$key]['guest_user'] = array_merge($guestall[$val['lid']]['guest']);				$out_script_live[$key]['topic'] = $topic_list;
			}
		}
		return $out_script_live;
	}
}
?>