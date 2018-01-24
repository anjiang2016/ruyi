<?php
/**
 *
 * ����ģ��
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: attach.mod.php 5422 2014-01-15 09:19:15Z chenxianfeng $
 */

if(!defined('IN_JISHIGOU')) {
	exit('invalid request');
}

class ModuleObject extends MasterObject {

	function ModuleObject($config) {
		$this->MasterObject($config);
		$this->AttachLogic = jlogic('attach');
		$this->Execute();
	}

	
	function Execute() {
		ob_start();
		switch ($this->Code) {
			case 'download':
				$this->Download();
				break;

			case 'get_sub_cat':
				$this->get_sub_cat();
				break;
			default:
				$this->Code = '';
				$this->Main();
		}
		$body=ob_get_clean();

		$this->ShowBody($body);
	}

	function Main() {
		global $attach_list,$_J;
		$pagenum = 10;
		$listcpattach = $this->Config['company_enable'] && $_J['member']['companyid'] > 0 ? true : false;
		if($_GET['code'] == 'myattach'){
			$where = "AND uid = '".MEMBER_ID."'";
		}elseif($_GET['code'] == 'myfollowattach'){
			$buddyids = get_buddyids(MEMBER_ID,$this->Config['topic_myhome_time_limit']);
			if($buddyids){$where = "AND item<>'company' AND uid IN(".implode(',',$buddyids).")";}else{$where = "AND uid = 0";}
		}elseif($listcpattach && $_GET['code'] == 'company'){
			$where = "AND item='company' AND itemid='".$_J['member']['companyid']."'";$current_cp = 'current';
		}else{
			$where = "AND item<>'company'";$current_new = 'current';
		}
		$attach = $this->AttachLogic->attachs_list($pagenum,$where);
		$attach_list = $attach['list'];
		if($attach['page']){
			$page_arr = $attach['page'];
		}
		$hot_down_list = $this->AttachLogic->down_hot_attach();
		$this->Title = '�����ĵ�';
		include(template("attach"));
	}

		function Download() {
		global $_J;
		$attach_config = jconf::get('attach');
		$uid = MEMBER_ID;
		if($uid < 1) {
			$this->Messager("����<a onclick='ShowLoginDialog(); return false;'>��˵�¼</a>����<a onclick='ShowLoginDialog(1); return false;'>���ע��</a>һ���ʺ�",null);
		}
		$candown = jclass('member')->HasPermission('uploadattach','down');
		if(!$candown){
			$this->Messager("��û�����ظ�����Ȩ��",null);
		}
				$readmod = 2;
		$downfile = get_param('downfile');
		if(!$downfile){
			$this->Messager("�����������ӵ�ַ����",null);
		}
		@list($dasize, $daid, $datime, $dadown) = explode('|', base64_decode($downfile));
		$daid = (int) $daid;
		if($daid <= 0){
			$this->Messager("�����������ӵ�ַ����",null);
		}
		$down_attach_file = $this->AttachLogic->get_down_info($daid);
		if(empty($down_attach_file)){
			$this->Messager("�����������ӵ�ַ����",null);
		}
		if($dadown != $down_attach_file['download']){			defined('NEDU_MOYO') || $this->Messager("�����������ӵ�ַ�Ѿ����ڻ�ʧЧ������ʹ�õ���<font class='R'>360�����</font>������ϵͳȱ�ݣ����������������������أ�",null);
		}
		$MIMETypes = array(
			'doc'  => 'application/msword',
			'ppt'  => 'application/vnd.ms-powerpoint',
			'pdf'  => 'application/pdf',
			'xls'  => 'application/vnd.ms-excel',
			'txt'  => 'text/plain',
			'rar'  => 'application/octet-stream',
			'zip'  => 'application/zip',
			'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
		);
		$de_attach_file_type = explode('|',$this->Config['attach_file_type']);
		foreach($de_attach_file_type as $val){
			if(!isset($MIMETypes[$val])){
				$MIMETypes[$val] = 'application/octet-stream';
			}
		}
		if(!isset($MIMETypes[$down_attach_file['filetype']])){
			$this->Messager("��ֻ�����أ�".strtoupper(str_replace('|',',',$this->Config['attach_file_type']))."�����͵��ļ�",null);
		}
		if(!$down_attach_file['file'] || (empty($down_attach_file['site_url']) && !(file_exists($down_attach_file['file']) && is_readable($down_attach_file['file'])))){
			$this->Messager("�ڷ��������Ҳ�����Ҫ���ص��ļ������ļ����ɶ�����ɾ���������ݴ�������ϵ��վ����Ա",null);
		}
				$auid = $down_attach_file['uid'];
		$score = $down_attach_file['score'];
		$this->AttachLogic->mod_download_num($daid);
				if($score > 0){
						if(!in_array($_J['member']['role_id'],explode(',',$attach_config['no_score_user']))){
				update_credits_by_action('attach_down',$uid,1,-$score);
			}
						if($auid != $uid){
				update_credits_by_action('down_my_attach',$auid,1,$score);
			}
		}
				if($down_attach_file['site_url']){
			$ftptype = getftptype($down_attach_file['site_url']);
			if($ftptype == 'Aliyun'){				$ftpkey = getftpkey($down_attach_file['site_url']);
				$ftps = jconf::get('ftp');
				if($ftps[$ftpkey]['type']=='Aliyun'){
					define('ALI_LOG', FALSE);
					define('ALI_DISPLAY_LOG', FALSE);
					define('ALI_LANG', 'zh');
					define('OSS_ACCESS_ID', $ftps[$ftpkey]['username']);
					define('OSS_ACCESS_KEY', $ftps[$ftpkey]['password']);
					define('OSS_BUCKET', $ftps[$ftpkey]['attachdir']);
					define('OSS_HOST_NAME',$ftps[$ftpkey]['host']);
					define('OSS_HOST_PORT',$ftps[$ftpkey]['port']);
					define('OSS_SIGN_TIMEOUT',$ftps[$ftpkey]['timeout']);
					define('OSS_ENABLED',$ftps[$ftpkey]['on']);
					$oss = jclass('jishigou/oss');
					$file = str_replace('./','',$down_attach_file['file']);
					$filename = urlencode(array_iconv($this->Config['charset'],'UTF-8',$down_attach_file['name']));					$res=$oss->sign_url($file.'?response-content-disposition=attachment; filename='.$filename,str_replace('http:/'.'/','',$down_attach_file['site_url']));					$res=str_replace("?OSSAccessKeyId","&OSSAccessKeyId",$res); 					$res=str_replace("%3F","?",$res);  					$res=str_replace("disposition%3Dattachment","disposition=attachment",$res); 					header('location:'.$res);
				}
			}else{
				$fileurl = $down_attach_file['site_url'].'/'.str_replace('./','',$down_attach_file['file']);
				$this->Messager("�ļ��洢���ⲿ��ַ��FTP�ռ䣬������ת�����Ժ�......",$fileurl);
			}
		}else{
			$fileType = $MIMETypes[$down_attach_file['filetype']];
			$down_attach_file['name'] = '"'.(strtolower(str_replace('-','',$this->Config['charset'])) == 'utf8' && strexists($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? urlencode($down_attach_file['name']) : $down_attach_file['name']).'"';			ob_end_clean();
			ob_start();			header('Cache-control: max-age=31536000');
			header('Expires: ' . gmdate('D, d M Y H:i:s', time()+31536000) . ' GMT');
			header('Content-Encoding: none');
			header('Content-type: '.$fileType);
			header('Content-Disposition: attachment; filename=' . $down_attach_file['name']);
			header('Content-Length: ' . filesize($down_attach_file['file']));
			if($readmod == 1 || $readmod == 3){
				if($fp = @fopen($down_attach_file['file'], 'rb')){
					@fseek($fp, 0);
					if(function_exists('fpassthru') && $readmod == 3){
						@fpassthru($fp);
					}else{
						echo @fread($fp, filesize($down_attach_file['file']));
					}
				}
				@fclose($fp);
			}else{
				@readfile($down_attach_file['file']);
			}
			@flush();
			@ob_flush();
		}
	}
	
	
    public function get_sub_cat() {
        $id = (int) jget('id');
        $html = jlogic('attach_category')->get_select_html($id);
        if ($html) {
            echo $html;
        }
        exit;
    }
}
?>