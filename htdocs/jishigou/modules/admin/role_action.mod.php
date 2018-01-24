<?php
/**
 *
 * ��̨��ɫȨ������ģ��
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: role_action.mod.php 5467 2014-01-18 06:14:04Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
    exit('invalid request');
}

class ModuleObject extends MasterObject
{


	
	var $ID = 0;

	
	var $ModuleList;

	
	function ModuleObject($config) {
		$this->MasterObject($config);

		$this->ID = max(0, (int) get_param('id'));

		if(true!==JISHIGOU_FOUNDER) {
			$this->Messager("��û����Ӧ��Ȩ�ޣ�������վ��ʼ�˷���", null);
		}


		$this->Execute();
	}

	
	function Execute()
	{
		ob_start();
		switch($this->Code)
		{
			case 'list':
				$this->ListAction();
				break;
			case 'add':
				$this->Add();
				break;
			case 'doadd':
				$this->DoAdd();
				break;

			case 'delete':
				$this->DoDelete();
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
		$this->ListAction();

	}

	
	function ListAction()
	{
				$sql="SELECT name,module from ".TABLE_PREFIX.'role_module';
		$query = $this->DatabaseHandler->Query($sql);
		while ($row=$query->GetRow())
		{
			$this->ModuleList[$row['module']]=$row['name'];
		}

				$sql="
		SELECT distinct
			module,is_admin
		FROM
			".TABLE_PREFIX.'role_action';
		$query = $this->DatabaseHandler->Query($sql);
		while($row=$query->GetRow())
		{
			if($row['is_admin'])
			{
				$admin_module_list[$row['module']]=isset($this->ModuleList[$row['module']])?$this->ModuleList[$row['module']]:$row['module'];
			}
			else
			{
				$module_list[$row['module']]=isset($this->ModuleList[$row['module']])?$this->ModuleList[$row['module']]:$row['module'];
			}

		}

				$filter=$this->Get['filter'];

		$filter_list=array
		(
			'all' => array('name'=>'�鿴ȫ��', 'where'=>' 1 ',),
			'credit_require'=>array('name'=>"�л���Ҫ���",'where'=>"credit_require!=''"),
			'credit_update'=>array('name'=>"��Ի��ֽ��в���",'where'=>"credit_update!=''"),
			'message'=>array('name'=>"���Զ�����ʾ��Ϣ",'where'=>"message!=''"),
			'allow_all'=>array('name'=>"ȫ�������",'where'=>"allow_all=1"),
			'disallow_all'=>array('name'=>"����ֹ��",'where'=>"allow_all=-1"),
		);
		if(isset($filter_list[$filter]))
		{
			$where='where '.$filter_list[$filter]['where'];
			$filter_title=$filter_list[$filter]['name'];
		}
		else
		{
			if(
			$filter=='module'
			and (isset($module_list[$this->Get['name']]) or isset($admin_module_list[$this->Get['name']])))
			{
				$where="where module='{$this->Get['name']}'";

				$filter_title="�鿴ģ��&nbsp;<U>{$this->ModuleList[$this->Get['name']]}</U>&nbsp;�Ĳ���";

			}
			else
			{
				$filter_title='�鿴ȫ��';
			}

		}
		if(isset($this->Get['is_admin']))
		{
			$is_admin=(int)$this->Get['is_admin'];
			$where.=empty($where)?"where is_admin='$is_admin'":"and is_admin='$is_admin'";
		}

		$sql="select *
		FROM
			".TABLE_PREFIX.'role_action'."
		$where
		ORDER BY `module` , `is_admin`";
		$query = $this->DatabaseHandler->Query($sql);
		while($row=$query->GetRow())
		{
			$action_list[]=$row;
		}

		$action = 'admin.php?mod=role_action&code=batch_modify';
		include template('admin/role_action_list');

	}

	function _makeAllowList()
	{
		$list=array();
		$list[]=array('name'=>"ȫ������",'value'=>'1');
		$list[]=array('name'=>"��ɫ����",'value'=>'0');
		$list[]=array('name'=>"ȫ����ֹ",'value'=>-1);
		Return $list;
	}

	
	function Modify()
	{
		$title="�޸�";

		$action_info = jtable('role_action')->info($this->ID);
		if(!$action_info) $this->Messager("��Ҫ�༭�Ķ����Ѿ���������",null);


		$allow_all_radio=$this->jishigou_form->Radio('allow_all',$this->_makeAllowList(),$action_info['allow_all']);
		$log_radio=$this->jishigou_form->YesNoRadio('log',$action_info['log']);
		$action_type=array("0"=>array("name"=>"ǰ̨Ȩ��","value"=>0),1=>array('name'=>"��̨Ȩ��","1"));
		$action_type_radio=$this->jishigou_form->Radio("is_admin",$action_type,$action_info['is_admin']);
				$sql="SELECT name,module as value from ".TABLE_PREFIX.'role_module';
		$query = $this->DatabaseHandler->Query($sql);
		while ($row=$query->GetRow())
		{
			$module_list[]=$row;
		}
		$module_select=$this->jishigou_form->Select('module',$module_list,$action_info['module']);

		preg_match_all("~([a-z0-9]{3,15})>=([\+\-0-9]+)~",$action_info['credit_require'],$require,2);
		foreach($require as $val)
		{
			$require_list[$val[1]]=$val[2];
		}


		preg_match_all("~([a-z0-9]{3,15})([\+\-][0-9]+)~",$action_info['credit_update'],$update,2);
		foreach($update as $val)
		{
			$update_list[$val[1]]=$val[2];
		}
		

		
		
		$sql = "select * from `".TABLE_PREFIX."role` order by `type`";
		$query = $this->DatabaseHandler->Query($sql);
		$_tmp_arr = $_tmp_arr_checked = $role_list = array();
		while (false != ($row = $query->GetRow()))
		{
			$role_list[] = $row;

			$_tmp_arr[$row['id']] = array(
				'name' => $row['name'],
				'value' => $row['id'],
			);

			if($action_info['allow_all'] > 0 || false!==strpos(",{$row['privilege']},",",{$this->ID},")) {
				$_tmp_arr_checked[$row['id']] = $row['id'];
			}
			if($action_info['allow_all'] < 0) {
				unset($_tmp_arr_checked[$row['id']]);
			}
		}
		$role_ids_chekbox = $this->jishigou_form->Checkbox('role_ids[]',$_tmp_arr,$_tmp_arr_checked);
		
		if ($action_info['allow_all']==-1) {
			$disallow_checked = ' checked ';
		} else {
			${"allow_all_{$action_info['allow_all']}_checked"} = " checked ";
		}


		foreach($this->Config as $key=>$val)
		{
			if(strpos($key,'credit')!==false)
			{
				if($val=='')
				{
					$credit=array(
					'name'=>"�û����ֶ�δ����",
					'disabled'=>'disabled',
					'require_value'=>'0',
					'update_value'=>'0');
				}
				else
				{
					$credit=array(
					'name'=>$val,
					'disabled'=>'',
					'require_value'=>$require_list[$key]!=""?$require_list[$key]:0,
					'update_value'=>$update_list[$key]!=""?$update_list[$key]:0);
				}
				$credit_list[$key]=$credit;
			}
		}

		$action="admin.php?mod=role_action&code=domodify";
		include template('admin/role_action_info');
	}

	
	function DoModify()
	{
        $datas = array();
        $datas['id'] = max(0, (int) $this->Post['id']);
        if(!$datas['id'])
        {
            $this->Messager("��ָ��һ��ID",null);
        }
        if(!(DB::fetch_first("select * from ".TABLE_PREFIX."role_action where `id`='{$datas['id']}' ")))
        {
            $this->Messager("��ָ��һ����ȷ��ID",null);
        }
        $datas['module'] = trim(strip_tags($this->Post['module']));
        $datas['action'] = trim(strip_tags($this->Post['action']));
        $datas['name'] = trim(strip_tags($this->Post['name']));
        $datas['describe'] = trim(strip_tags($this->Post['describe']));
        $datas['message'] = trim(strip_tags($this->Post['message']));
        $datas['allow_all'] = ((($i=(int) $this->Post['allow_all']) < 2 && $i > -2) ? $i : 0);
        $datas['log'] = ($this->Post['log'] ? 1 : 0);
        $datas['is_admin'] = ($this->Post['is_admin'] ? 1 : 0);


		
		$query = $this->DatabaseHandler->Query("select `id`,`privilege` from `".TABLE_PREFIX."role`");
		$all_role_ids = array();
		while (false != ($row = $query->GetRow()))
		{
			$all_role_ids[$row['id']]=$row['privilege'];
		}
		if(1==$this->Post['allow_all']) {
			$this->Post['role_ids'] = array_keys($all_role_ids);
		} elseif (-1==$this->Post['allow_all']) {
			$this->Post['role_ids'] = array();
		}

		foreach ($all_role_ids as $role_id=>$role_privilege) {
			$_tmp_arr = explode(',',$role_privilege);
			$role_privilege_list = array();
			foreach ($_tmp_arr as $_tmp_id) {
				$_tmp_id = (int) $_tmp_id;
				if($_tmp_id > 0) {
					$role_privilege_list[$_tmp_id] = $_tmp_id;
				}
			}
			if (in_array($role_id,$this->Post['role_ids'])) {
				$role_privilege_list[$this->Post['id']] = $this->Post['id'];
			} else {
				unset($role_privilege_list[$this->Post['id']]);
			}
			sort($role_privilege_list);
			$role_privilege_new = implode(',',$role_privilege_list);

			if($role_privilege_new!=$role_privilege) {
				$this->DatabaseHandler->Query("update `".TABLE_PREFIX."role` set `privilege`='{$role_privilege_new}' where `id`='{$role_id}'");
			}
		}
		


		$result = jtable('role_action')->update($datas);
		if($result!==false)
		{
			jtable('role_action')->cache_rm($datas['module']);

			$this->Messager("�༭�ɹ�");
		}
		else
		{
			$this->Messager("�༭ʧ��");
		}
	}

	
	function Add()
	{
		$title="���";


		$allow_all_radio=$this->jishigou_form->Radio('allow_all',$this->_makeAllowList(),0);
		$log_radio=$this->jishigou_form->YesNoRadio('log',0);
		$action_type=array("0"=>array("name"=>"ǰ̨Ȩ��","value"=>0),1=>array('name'=>"��̨Ȩ��","1"));
		$action_type_radio=$this->jishigou_form->Radio("is_admin",$action_type,0);

				$sql="SELECT name,module as value from ".TABLE_PREFIX.'role_module order by module';
		$query = $this->DatabaseHandler->Query($sql);
		while ($row=$query->GetRow())
		{
			$row['name'] = '['.$row['value'].'] ' . $row['name'];
			$module_list[]=$row;
		}
		$module_select=$this->jishigou_form->Select('module',$module_list);

		foreach($this->Config as $key=>$val)
		{
			if(strpos($key,'credit')!==false)
			{
				if($val=='')
				{
					$credit=array(
					'name'=>"�û����ֶ�δ����",
					'disabled'=>'disabled',
					'require_value'=>'0',
					'update_value'=>'0');
				}
				else
				{
					$credit=array(
					'name'=>$val,
					'disabled'=>'',
					'require_value'=>$require_list[$key]!=""?$require_list[$key]:0,
					'update_value'=>$update_list[$key]!=""?$update_list[$key]:0);
				}
				$credit_list[$key]=$credit;
			}
		}

		$action="admin.php?mod=role_action&code=doadd";
		include template('admin/role_action_info');
	}

	
	function DoAdd()
	{
		$datas = array();
        $datas['module'] = trim(strip_tags($this->Post['module']));
        $datas['action'] = trim(strip_tags($this->Post['action']));
        $datas['name'] = trim(strip_tags($this->Post['name']));
        $datas['describe'] = trim(strip_tags($this->Post['describe']));
        $datas['message'] = trim(strip_tags($this->Post['message']));
        $datas['allow_all'] = ((($i=(int) $this->Post['allow_all']) < 2 && $i > -2) ? $i : 0);
        $datas['log'] = ($this->Post['log'] ? 1 : 0);
        $datas['is_admin'] = ($this->Post['is_admin'] ? 1 : 0);

		$result = jtable('role_action')->insert($datas);
		if($result!=false)
		{
			jtable('role_action')->cache_rm($datas['module']);

			$this->Messager("��ӳɹ�","admin.php?mod=role_action&code=modify&id={$result}");
		}
		else
		{
			$this->Messager("���ʧ��");
		}
	}

	
	function DoDelete()
	{
		$sql="select module from ".TABLE_PREFIX."role_action where id='{$this->ID}'";
		$query = $this->DatabaseHandler->Query($sql);
		$action=$query->GetRow();

		if($action==false)$this->Messager("Ȩ���Ѿ�������");

		$sql="delete from ".TABLE_PREFIX."role_action where id='{$this->ID}'";
		$query = $this->DatabaseHandler->Query($sql);

		jtable('role_action')->cache_rm($action['module']);

		$this->Messager("ɾ���ɹ�");
	}

}

?>