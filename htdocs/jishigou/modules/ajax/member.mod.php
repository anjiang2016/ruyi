<?php
/**
 * �ļ�����member.mod.php
 * @version $Id: member.mod.php 5501 2014-01-23 02:28:27Z chenxianfeng $
 * ���ߣ�����<foxis@qq.com>
 * ��������: ע����֤ģ�飬�Ѿ�ͳһ��member.func.php�ļ��еĺ���������֤
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

		
		$this->Execute();
	}

	
	function Execute()
	{
		ob_start();
		switch ($this->Code)
		{
			case 'login':
				$this->Login();
				break;
			case 'checkuser':
				$this->DoCheckUser();
				break;
			case 'check_username':
				$this->CheckUsername();
				break;
			case 'check_email':
				$this->CheckEmail();
				break;
			case 'check_nickname':
				$this->CheckNickname();
				break;
			case 'check_seccode':
				$this->CheckSeccode();
				break;
			case 'sel':
				$this->makeSel();
				break;
			case 'cp':
				$this->Cp();
				break;
			case 'check_ajax_reg':
				$this->CheckAjaxReg();
				break;
			default:
				$this->Main();
				break;
		}
		 response_text(ob_get_clean());
	}

	
	function Main()
	{
		response_text("���ڽ����С���");
	}

	function Cp()
	{
		$cid = jget('cid','int');
		$CpLogic = jlogic('cp');
		$departmentselect = $CpLogic->GetOption('departmentid','department','��',0,0,$cid);
		response_text($departmentselect);
	}

		function makeSel(){
					$show_h = "<option value=''>��ѡ��</option>\t\n";
						$province = (int) $this->Get['province'];
		$hid_city = $this->Get['hid_city'];
		if($province && $province != 0){
			$query = $this->DatabaseHandler->Query("select * from `".TABLE_PREFIX."common_district` where `upid` = '$province' order by list ");
			while ($rs = $query->GetRow()){
				if($hid_city == $rs['id']){
					$show .= "<option value={$rs['id']} selected>{$rs['name']}</option>\t\n";
				}else{
					$show .= "<option value={$rs['id']}>{$rs['name']}</option>";
				}
			}
		}

				$city = (int) $this->Get['city'];
		$hid_area = $this->Get['hid_area'];
		if($city && $city != 0){
			$query = $this->DatabaseHandler->Query("select * from `".TABLE_PREFIX."common_district` where `upid` = '$city' order by list ");
			while ($rs = $query->GetRow()){
				if($hid_area == $rs['id']){
					$show .= "<option value={$rs['id']} selected>{$rs['name']}</option>\t\n";
				}else{
					$show .= "<option value={$rs['id']}>{$rs['name']}</option>";
				}
			}
		}

				$area = (int) $this->Get['area'];
		$hid_street = $this->Get['hid_street'];
		if($area && $area != 0){
			$query = $this->DatabaseHandler->Query("select * from `".TABLE_PREFIX."common_district` where `upid` = '$area' order by list ");
			while ($rs = $query->GetRow()){
				if($hid_street == $rs['id']){
					$show .= "<option value={$rs['id']} selected>{$rs['name']}</option>\t\n";
				}else{
					$show .= "<option value={$rs['id']}>{$rs['name']}</option>";
				}
			}
		}
		if($show){
			echo ($show_h.$show);
			exit();
		}else{
			response_text('');
		}
	}

	
	function CheckUsername()
	{
		$username=trim($this->Post['username'] ? $this->Post['username'] : $this->Post['check_value']);

		$ret = jsg_member_checkname($username, 0, 0, MEMBER_ID);
		if($ret < 1) {
			$rets = array(
				'0' => '[δ֪����] �п�����վ��ر���ע�Ṧ��',
				'-1' => '��������/΢����ַ ���Ϸ�',
				'-2' => '��������/΢����ַ ������ע��',
				'-3' => '��������/΢����ַ �Ѿ�������',
			);

			json_error($rets[$ret]);
		} else {
			json_result('ͨ����⣬����ʹ�ã�');
		}
	}

	
	function CheckEmail()
	{
		$email=trim($this->Post['email'] ? $this->Post['email'] : $this->Post['check_value']);

		$ret = jsg_member_checkemail($email);
		if($ret < 1)
		{
			$rets = array(
				'0' => '[δ֪����] �п�����վ��ر���ע�Ṧ��',
				'-4' => 'Email ���Ϸ�',
				'-5' => 'Email ������ע��',
				'-6' => 'Email �Ѿ�������',
			);
			if($ret == '-6'){
                json_error('�Ѵ���');
			}
			json_error($rets[$ret]);
		}
		json_result('��ע��');
	}

	
	function CheckNickname()
	{
		$nickname=trim($this->Post['nickname'] ? $this->Post['nickname'] : $this->Post['check_value']);

		$ret = jsg_member_checkname($nickname, 1);
		if($ret < 1) {
			$rets = array(
				'0' => '[δ֪����] �п�����վ��ر���ע�Ṧ��',
				'-1' => '�ǳ� ���Ϸ�',
				'-2' => '�ǳ� ������ע��',
				'-3' => '�ǳ� �Ѿ�������',
			);

			if('-3' == $ret && 'register' != jget('from')) {
				$uid = DB::result_first("select `uid` from `" . TABLE_PREFIX . "members` where `username`='$nickname' or `nickname`='$nickname' limit 1");
				if($uid > 0) {
					$face = face_get($uid);
					$html = "<img src=$face class=u-reg-login onerror=javascript:faceError(this) /><a href=index.php?username=$nickname>��˵�¼</a>";
					json_error($html);
				}
			}

			json_error($rets[$ret]);
		} else {
			json_result('��ע��');
		}
	}


		function CheckSeccode()
	{
		$seccode = $this->Post['check_value'];
		if (!ckseccode($seccode)) {
			json_error("��֤�벻��ȷ�����������°ɡ�");
		} else {
			json_result('&nbsp;');
		}
	}

		function CheckAjaxReg(){
		$email = $this->Post['email'];
		$nickname = $this->Post['nickname'];
		$seccode = $this->Post['seccode'];
		$type = $this->Post['type'] ? 0 : 1;
		if ($this->Config['seccode_enable']==1 && $this->Config['seccode_register']){
			if(!ckseccode($seccode)){
				json_error("��֤���������");
			}
		}
		$ret = jsg_member_checkemail($email);
		if($ret < 1){
			$rets = array('0' => '[δ֪����] �п�����վ��ر���ע�Ṧ��','-4' => 'Email ���Ϸ�','-5' => 'Email ������ע��','-6' => 'Email �Ѿ�������');
			json_error($rets[$ret]);
		}else{
			$ret = jsg_member_checkname($nickname,1);
			if($ret < 1){
				$rets = array('0' => '[δ֪����] �п�����վ��ر���ע�Ṧ��','-1' => '�ǳ� ���Ϸ�',	'-2' => '�ǳ� ������ע��','-3' => '�ǳ� �Ѿ�������');
				json_error($rets[$ret]);
			}elseif($type){
				json_result('��֤��ͨ��������ע����');
			}else{
				json_result('�밴ͼ����ʾ������֤��');
			}
		}
	}

	
	function DoCheckUser(){
		$ret = false;
		$username = trim(jget('username'));
		if(!$username){
			json_error('�������ʺ�');
		}
		#if NEDU
		if (defined('NEDU_MOYO'))
		{
			nlogic('user/passport')->onlogin($username);
		}
		#endif

		if($this->Config['ldap_enable']){
			if($this->_is_email($username)){
				$uid = DB::result_first("select `uid` from `".TABLE_PREFIX."members` where `email` = '$username' ");
				$uid = $uid ? $uid : 0;
				$face = face_get($uid);
				json_result($face);
			}
			json_error('���ʺŲ�����');
		}else{
			$uid = jsg_member_uid($username);
			if($uid > 0) {
				$face = face_get($uid);
				json_result($face);
			}elseif(true === UCENTER){				include_once ROOT_PATH . 'api/uc_client/client.php';
				if($this->_is_email($username)){
					$return = uc_user_checkemail($username);
				}else{
					$return = uc_user_checkname($username);
				}
				if($return == '-3' || $return == '-6'){
					json_result(face_get(0));
				}
			}
			json_error('�ʺŲ�����');
		}
	}

	
	function Login(){
		$username = trim(jget('username'));
		$password = jget('password');

		
		if ($this->Config['seccode_enable']==1 && $this->Config['seccode_login']) {
			if (!ckseccode(@$_POST['seccode'])) {
				json_error("��֤���������");
			}
		}elseif ($this->Config['seccode_enable']>1 && $this->Config['seccode_login'] && $this->yxm_title && $this->Config['seccode_pub_key'] && $this->Config['seccode_pri_key']) {
			$YinXiangMa_response=jlogic('seccode')->CheckYXM(@$_POST['YinXiangMa_challenge'],@$_POST['YXM_level'][0],@$_POST['YXM_input_result']);
			if($YinXiangMa_response != "true"){
				json_error("��֤���������");
			}
		}

		if($username=="" || $password=="")
		{
			json_error("�޷���¼,�û��������벻��Ϊ��");
		}


        
        if($this->Config['login_by_uid']) {
            is_numeric($username) && json_error("��ֹʹ��UID��¼");
        }

		if($GLOBALS['_J']['plugins']['func']['login']) {
			hookscript('login', 'funcs', array('param' => $this->Post, 'step' => 'check'), 'login');
		}

		
		$referer = jget('referer');
		if(!$referer) {
			$referer = jsg_getcookie('referer');
		}

		$rets = jsg_member_login($username, $password);
		$uid = (int) $rets['uid'];
		if($uid < 1) {
			json_error($rets['error']);
		}

		$member = jsg_member_info($uid);

		

		
		$this->Config['email_must_be_true'] == 2 && $member['email_checked'] == 0 && $referer = 'index.php?mod=member&code=setverify&ids='.$uid;

		if($this->Config['extcredits_enable'] && $uid > 0)
		{
			
			update_credits_by_action('login',$uid);
		}

		
		Load::logic('other');
		$otherLogic = new OtherLogic();
		$sql = "SELECT m.id as medal_id,m.medal_img,m.medal_name,m.medal_depict,m.conditions,u.dateline,y.apply_id
				FROM ".TABLE_PREFIX."medal m
				LEFT JOIN ".TABLE_PREFIX."user_medal u ON (u.medalid = m.id AND u.uid = '$uid')
				LEFT JOIN ".TABLE_PREFIX."medal_apply y ON (y.medal_id = m.id AND y.uid = '$uid')
				WHERE m.is_open = 1
				ORDER BY u.dateline DESC,m.id";

		$query = $this->DatabaseHandler->Query($sql);
		while (false != ($rs = $query->GetRow())){
			$rs['conditions'] = unserialize($rs['conditions']);
			if(in_array($rs['conditions']['type'],array('topic','reply','tag','invite','fans')) && !$rs['dateline']){
				$result .= $otherLogic->autoCheckMedal($rs['medal_id'],$uid);
			}
		}


		
		$redirecto = $referer?$referer:referer();
		if(!$redirecto || strpos($redirecto, 'login')!==false) {
			$redirecto = "index.php?" ;
		}
		$redirecto = str_replace('#','',$redirecto);
		if($rets['uc_syn_html'])
		{
			json_result("��¼�ɹ�{$rets['uc_syn_html']}",$redirecto);
		}
		else
		{
			json_result('��¼�ɹ�',$redirecto);
		}
	}

	function _is_email($email) {
		$ret = false;
		if($email && false !== strpos($email,'@')) {
			$ret = preg_match('~^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+([a-z]{2,4})|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$~i', $email);
		}
		return $ret;
	}
}


?>