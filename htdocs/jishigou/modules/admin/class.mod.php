<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename class.mod.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 680876309 7174 $
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

		switch ($this->Get['code'])
		{
			case 'newclass':
				$this->newClass();
				break;
			case 'addclass':
				$this->addClass();
				break;
			case 'delclass':
				$this->delClass();
				break;
			case 'hidclass':
				$this->hidClass();
				break;
			case 'editclasssort':
				$this->editClassSort();
				break;
			case 'editclass':
				$this->editClass();
				break;
			default:
				$this->main();
				break;
		}

		$body = ob_get_clean();

		$this->ShowBody($body);

	}

		function main(){
				$query = $this->DatabaseHandler->Query("select s.`fid`,s.`fup`,s.`mid`,s.`name` as classname,s.`list`,s.`style`,d.`id`,d.`name` as modulename from `" . TABLE_PREFIX . "fenlei_sort` s left join `" . TABLE_PREFIX . "fenlei_module` d on s.`mid` =  d.`id` where s.`fup` = 0 order by s.list,s.fid");
		$rs = array();
		while($rsdb = $query->GetRow()){
			$rs[$rsdb['fid']] = $rsdb;
						$sql = "select s.`fid`,s.`fup`,s.`mid`,s.`name` as classname,s.`list`,s.`style`,d.`id`,d.`name` as modulename from `" . TABLE_PREFIX . "fenlei_sort` s left join `" . TABLE_PREFIX . "fenlei_module` d on s.`mid` =  d.`id` where s.`fup` = '" . $rsdb['fid'] . "' order by s.list,s.fid";
			$query1 = $this->DatabaseHandler->Query($sql);
			while ($rsdb1 = $query1->GetRow()){
				$rs[$rsdb1['fid']] = $rsdb1;
			}
		}
		include template('admin/class');
	}

		function newClass(){
		$id = (int) $this->Get['id'];
		if($id){
			$act = 'edit';
			$query = $this->DatabaseHandler->Query("select * from ".TABLE_PREFIX."fenlei_sort where fid = '$id'");
			$rs = $query->GetRow();
		}else{
			$act = 'new';
		}



				$query = $this->DatabaseHandler->Query("select `fid` , `name`  from `" . TABLE_PREFIX . "fenlei_sort` where `fup` = 0 order by list");
		$fup_select = "";
		while($rsdb = $query->GetRow()){
			if($rs['fup'] == $rsdb['fid']){
				$fup_select .= "\t<option value='{$rsdb['fid']}' selected>{$rsdb['name']}</option>\r\n";
			}else{
	    		$fup_select .= "\t<option value='{$rsdb['fid']}'>{$rsdb['name']}</option>\r\n";
			}
		}
				$sql = "select id,name from `" . TABLE_PREFIX . "fenlei_module`";
		$query = $this->DatabaseHandler->Query($sql);
		$option = array();
		while ($rsdb = $query->GetRow()){
			$option[$rsdb['id']]['id'] = $rsdb['id'];
			$option[$rsdb['id']]['name'] = $rsdb['name'];
		}
		$module_select = $this->jishigou_form->Select("moduleList",$option,$rs[mid]);

		include template('admin/new_class');
	}

		function addClass(){
		$postList = $this->Post;
		if($this->Get['act'] == 'new'){
			$detail=explode("\r\n",$postList['name']);
			foreach ($detail as $key=>$name){
				if(!$name){
					continue;
				}
				$sql = "insert into `" . TABLE_PREFIX ."fenlei_sort` (fup,name,mid,	style) values('$postList[fid]','$name','$postList[moduleList]','1')";
				$query = $this->DatabaseHandler->Query($sql);
			}
			$this->Messager("���ഴ���ɹ�", "admin.php?mod=class&code=newclass");
		}else{
			IF($postList['hid_fid'] == $postList['fid']){
				$this->Messager("������������Ϊ����Ŀ", -1);
			}
			if(!$postList['editname']){
				$this->Messager("��������Ŀ����", -1);
			}
			$count = DB::result_first("select count(*) from ".TABLE_PREFIX."fenlei_sort where fup = '$postList[hid_fid]'");
			if($count && $postList[fid] <> 0){
				$this->Messager("����Ŀ��������Ŀ��������Ϊ������Ŀ", -1);
			}
			$sql = "update `" . TABLE_PREFIX ."fenlei_sort`
					set
					fup = $postList[fid],
					name = '$postList[editname]',
					mid = '$postList[moduleList]'
					where fid = '$postList[hid_fid]'";
			$query = $this->DatabaseHandler->Query($sql);
			$this->Messager("�����޸ĳɹ�", "admin.php?mod=class");
		}
	}

		function delClass(){
		$fidList = array();
		$id = (int) $this->Get['id'];
		if($id){
			$fidList[$id] = $id;
		}else{
			$cheList = $this->Post['chelist'];
			if($cheList){
				foreach ($cheList as $key=>$value){
					$fidList[$key] = $key;
				}
			}else{
				$this->Messager("ɾ������û�ж���", "admin.php?mod=class");
			}
		}
		foreach ($fidList as $value) {
			$value = (int) $value;
			$followcount = DB::result_first("select count(*) from `" . TABLE_PREFIX . "fenlei_sort` where `fup` = '$value'");
			if($followcount){
				$this->Messager("����������Ŀ�㲻��ɾ��,����ɾ������������Ŀ,��ɾ������", -1);
			}
			$mid = DB::result_first("select mid from `" . TABLE_PREFIX . "fenlei_sort` where `fid` = '{$value}'" );
			$this->DatabaseHandler->Query("delete from `" . TABLE_PREFIX . "fenlei_sort` where `fid`= '$value'");
			$this->DatabaseHandler->Query("delete from `" . TABLE_PREFIX . "fenlei_content_" . $mid ."` where `fid` = '{$value}'");

		}
		$this->Messager("ɾ���ɹ�", "admin.php?mod=class");
	}

		function hidClass(){
		$fidList = array();
		$id = (int) $this->Get['id'];
		$action = $this->Get['action'];
		if($id){
			$fidList[$id] = $id;
		}else{
			$cheList = $this->Post['chelist'];
			if($cheList){
				foreach ($cheList as $key=>$value){
					$fidList[$key] = $key;
				}
			}else{
				$this->Messager("��ѡ��Ҫ��������", "admin.php?mod=class");
			}
		}
		foreach ($fidList as $value) {
			$value = (int) $value;
			if($action == 'hid'){
				$followcount = DB::result_first("select count(*) from `" . TABLE_PREFIX . "fenlei_sort` where `fup` = '$value' and `style` = 1");
				if($followcount){
					$this->Messager("�㲻�ܹر�������Ŀ�ķ���,����ɾ������������Ŀ,�ٹرշ���", -1);
				}
				$this->DatabaseHandler->Query("update `" . TABLE_PREFIX . "fenlei_sort` set `style` = 0 where `fid`= '$value'");
			}else if($action == 'active'){
				$fup = DB::result_first("select `fup` from `".TABLE_PREFIX."fenlei_sort` where `fid` = '$value'");
				if($fup != 0){
					$followcount = DB::result_first("select count(*) from `" . TABLE_PREFIX . "fenlei_sort` where `fid` = '$fup' and `style` = 0");
					if($followcount){
						$this->Messager("����Ŀ�����Ĵ�����ѹر�,�����ô����,����������Ŀ", -1);
					}
				}
				$this->DatabaseHandler->Query("update `" . TABLE_PREFIX . "fenlei_sort` set `style` = 1 where `fid`= '$value'");
			}
		}
		$this->Messager("״̬�޸ĳɹ�", "admin.php?mod=class");
	}

		function editClassSort(){
		$list = $this->Post[order];
		foreach ($list as $key=>$value){
			$key = (int) $key;
			$value = (int) $value;
			$this->DatabaseHandler->Query("update `" . TABLE_PREFIX . "fenlei_sort` set `list` = '$value' where `fid` = '$key'");
		}
		$this->Messager("�����޸ĳɹ�", "admin.php?mod=class");
	}
}
