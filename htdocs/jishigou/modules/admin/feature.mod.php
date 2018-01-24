<?php
/**
 * �ļ�����feature.mod.php
 * ���ߣ�����<foxis@qq.com>
 * ��������: ΢�������������ԣ�ģ�顣
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
				$this->Main();
				break;
		}
		$body = ob_get_clean();
		$this->ShowBody($body);
	}


	function Main()
	{
		$per_page_num = min(500, max(20, (int) (isset($_GET['pn']) ? $_GET['pn'] : $_GET['per_page_num'])));
		$info = jlogic('feature')->get_featurelist($per_page_num);
		$total_record = $info['total'];
		$page_arr = $info['page'];
		$feature_list = $info['list'];
		include(template('admin/feature'));
	}

	function Add()
	{
		$featurename = strip_tags($this->Post['featurename']);
		if(empty($featurename)){
			$this->Messager("��������������",-1);
		}
		$return = jlogic('feature')->add_feature($featurename);
		if($return > 0){
			$this->Messager("��ӳɹ�",'admin.php?mod=feature');
		}else{
			$this->Messager("{$featurename} �����Ѿ�����",-1);
		}
	}

	function Modify()
	{
		$ids = (int) $this->Get['ids'];
		$action = "admin.php?mod=feature&code=domodify";
		$featurelist = jlogic('feature')->id2feature($ids);
		include template('admin/feature');
	}

	function DoModify()
	{
		$featureid = (int) $this->Post['featureid'];
		$featurename = strip_tags($this->Post['featurename']);
		$oldfeaturename = $this->Post['oldfeaturename'];
		if($featurename != $oldfeaturename){
			$return = jlogic('feature')->modify_feature($featureid,$featurename);
			if($return > 0){
				$this->Messager("�༭�ɹ�",'admin.php?mod=feature');
			}else{
				$this->Messager("{$featurename} �����Ѿ�����");
			}
		}else{
			$this->Messager("û���κ��޸�",'admin.php?mod=feature');
		}
	}

	function Delete()
	{
		$ids = (array) ($this->Post['ids'] ? $this->Post['ids'] : $this->Get['ids']);
		$nids = array();
		if(!$ids) {
			$this->Messager("��ָ��Ҫɾ���Ķ���");
		}
		foreach($ids as $k => $v){			if(in_array($v,array(1,2,3))){
				$nids[] = $v;
				unset($ids[$k]);
			}
		}
		if($ids){
			jlogic('feature')->delete_feature($ids);
			if($nids){
				$this->Messager("�����ɹ�����ϵͳĬ�����ԡ�".implode(',',$nids)."��������ɾ��������");
			}else{
				$this->Messager("�����ɹ�");
			}
		}else{
			$this->Messager("ɾ��ʧ�ܣ���Ҫɾ���Ķ���ϵͳ��֧��ɾ��������");
		}
	}
}
?>