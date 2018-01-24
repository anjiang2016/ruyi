<?php
/**
 *[JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 �ļ�����index.mod.php
 * @version $Id: index.mod.php 5094 2013-11-25 02:11:19Z wuliyong $
 * ���ߣ�����<foxis@qq.com>
 * ������������ҳģ��
 */
if(!defined('IN_JISHIGOU'))
{
	exit('invalid request');
}

class ModuleObject extends MasterObject
{

	
	var $Config = array(); 

	function ModuleObject(& $config)
	{

		$this->MasterObject($config);

		$this->Execute();

	}

	
	function Execute()
	{
        if($this->Get['jump_url']){
                        $this->Main();
        } else {
            switch($this->Code)
            {
                case 'menu':
                    $this->Menu();
                    break;
                case 'home':
                    $this->Home();
                    break;
                case 'help':
                    $this->Help();
                    break;
                case 'theme':
                    $this->Theme();
                    break;
                case 'affiche':
                    $this->Affiche();
                    break;
                case 'recommend':
                    $this->recommend();
                    break;
                case 'upgrade_check':
                    $this->upgrade_check();
                    break;
                case 'lrcmd_nt':
                    $this->lrcmd_nt();
                    break;
                case 'ccdsp':
                    upsCtrl()->dspControlDone();
                    break;                
                case 'iframe':
                    $this->iframe();
                    break;                
                default:
                    $this->Main();
            }
        }
		$body = ob_get_clean();

		$this->ShowBody($body);

	}

	
	function main()
	{
		if(MEMBER_ID<1) {
			$this->Messager("�ο���Ȩ�޽����̨,����<a href='index.php?mod=login'>��˵�¼</a>��",null);
		}

		$has_p=$this->MemberHandler->HasPermission('index','',1);
		if($has_p)
		{
			$menuList = $this->Menu();
			$action = 'admin.php?mod=index&code=home';
			if($this->Get['jump_url']){
				$parseUrl = array_filter(explode('?',$this->Get['jump_url'],2));
				unset($this->Get['jump_url']);
				if($this->Get['mod'] == 'index'){
					unset($this->Get['mod']);
				}
				$url = reset($parseUrl).'?'.end($parseUrl).'&'.http_build_query($this->Get);
				$action = $url?$url:$action;
			}
			include(template('admin/index'));
			exit;
		}
		else
		{
			$this->Messager("����Ȩ�����̨��",null);
		}
	}

	function Affiche()
	{

		include(template('admin/affiche'));

		exit;
	}

	function _recommendList() {
		
	}

	
	function Menu()
	{
		global $jishigou_rewrite,$config;
		$default_open=true;		$open_onlyone=false;
				$open_list=explode('_',$this->Get['open']);
		require(ROOT_PATH.'setting/admin_left_menu.php');
		#if NEDU
		if (defined('NEDU_MOYO'))
		{
			$menu_list = nlogic('admin.menu')->hooks_nav($menu_list);
		}
		#endif
				foreach ($menu_list as $_key=>$_menu)
		{
			if($_menu['sub_menu_list'])
			{
				foreach ($_menu['sub_menu_list'] as $_sub_key=>$_sub_menu)
				{
					if(strpos($_sub_menu['link'],":\/\/")!==false)continue;
					preg_match("~mod=([^&\x23]+)&?(code=([^&\x23]*))?~",$_sub_menu['link'],$match);
					list(,$_mod,,$_code)=$match;
					if(!empty($_mod) && $this->MemberHandler->HasPermission($_mod,$_code,1)==false)
					{
						unset($menu_list[$_key]['sub_menu_list'][$_sub_key]);
					}
				}
			}
		}

		$all_open_list=array_keys($menu_list);
		if($default_open && isset($this->Get['open'])==false)
		{
			$open_list=$all_open_list;
		}

		foreach($menu_list as $key=>$menu)
		{
			if ($key == 1)
			{
								foreach ($menu_list as $_menu_list_s)
				{
					foreach((array)$_menu_list_s['sub_menu_list'] as $menu_s)
					{
						if($menu_s['shortcut'])
						{
							$menu['sub_menu_list'][] = $menu_s;
						}
					}
				}
				if($this->Config['tongji_admin_url'] && $this->Config['tongji']) {
					$menu['sub_menu_list'][] = array(
						'title' => '����ͳ�Ʊ���',
						'link' => 'admin.php?mod=index&code=iframe&url=' . urlencode($this->Config['tongji_admin_url']),
					);
				}
			}
			if(empty($menu['sub_menu_list']))continue;
			$menu_tmp_list[$key]=$menu;
			if(in_array($key,$open_list)!=false)
			{
				$menu_tmp_list[$key]['img']='minus';
				$open_list_tmp=$open_list;
				unset($open_list_tmp[array_search($key, $open_list_tmp)]);
							}
			else
			{
				$menu_tmp_list[$key]['img']='plus';
								$menu_tmp_list[$key]['sub_menu_list']=array();
			}
			if(isset($menu['sub_menu_list']))
			{

				$menu_tmp_list[$key]['link']="?mod=index&code=menu"; 				$menu_tmp_list[$key]['target']="";

			}
			else
			{
				$menu_tmp_list[$key]['target']='target="main"';
			}
		}
		$menu_list=$menu_tmp_list;

		return $menu_list;
	}
	
	function home()
	{

		#if NEDU
		if (defined('NEDU_MOYO'))
		{
			nmodule('admin/jsg')->home();
		}
		#endif

		$program_name = "���¹�";

				include(ROOT_PATH . 'setting/admin_left_menu.php');
		$shorcut_list=array();
		foreach ($menu_list as $_menu_list)
		{
			foreach((array)$_menu_list['sub_menu_list'] as $menu)
			{
				if($menu['shortcut'])
				{
					$shortcut_list[$_menu_list['title']][]=$menu;
				}
			}
		}

				$cache_id = "misc/data_length";
		if (false === ($data_length = cache_file('get', $cache_id))) {
			$sql="show table status from `{$this->Config['db_name']}` like '".TABLE_PREFIX."%'";
			$query=$this->DatabaseHandler->query($sql,"SKIP_ERROR");
			$data_length=0;
			while ($row=$query->GetRow())
			{
				$data_length+=$row['Data_length']+$row['Index_length'];
			}
			if($data_length>0)
			{

				$data_length=jio()->SizeConvert($data_length);
			}
			$sys_env['sys_data_length'] = $data_length;

			cache_file('set', $cache_id, $data_length, 36000);
		}

		#ע���¼ͳ�ƣ�����һСʱ��
		$logic_statistics = jlogic('other')->getLoginStatistics();

		#���ݷ���ͳ�ƣ�����һСʱ��
		$content_statistics = jlogic('other')->getContentStatistics();

		#���������ͳ�ƣ�����10���ӣ�
		$data_verify = jlogic('other')->getVerifyStatistics();

		#Ӧ������ͳ�ƣ������Сʱ��
		$app_statistics = jlogic('other')->getAppStatistics();

		#�û����ࣺ����Ա����������������֤��Ա����ͨ��Ա��LV1~LV2��Lv3~Lv4��Lv5~lv6��Lv7����
		$user_statistics = jlogic('other')->getUserStatistics();

		#�û����ࣺ����Ա����������������֤��Ա����ͨ��Ա��LV1~LV2��Lv3~Lv4��Lv5~lv6��Lv7����
		$role_statistics = jlogic('other')->getRoleStatistics();

		#����ͳ��
	    $other_statistics = jlogic('other')->getOtherStatistics();

		include(template('admin/home'));

	}

	function recommend()
	{
		$cache_id = "misc/recommend_list";
		if(false === ($recommend_list = cache_file('get', $cache_id)))
		{
			@$recommend_list=request('recommend',array('f'=>'text'),$error);

			if(!$error && is_array($recommend_list) && count($recommend_list)) {
				cache_file('set', $cache_id, (array) $recommend_list, 864000);
			}
		}
		if (!$recommend_list || count($recommend_list) < 1 || is_string($recommend_list))
		{
			$recommend_list = $this->_recommendList();
		}
		if (time() < $recommend_list['overtime'])
		{
			echo $recommend_list['string'];
		}
		exit;
	}

	function upgrade_check()
	{
		$ckey = 'fcache/home.console.upgrade.check';
		$ctim = 86400*3;
		$last = cache_file('get', $ckey);
		$last && exit($last);
		$response = request('upgrade', array(), $error);
		upsCtrl()->RPSFailed($response) && exit('~');
		$version = is_array($response) ? $response['version'] : SYS_VERSION;
		$build = is_array($response) ? 'build '.$response['build'] : SYS_BUILD;
		if ($version == SYS_VERSION)
		{
			$alert = 'noups';
			cache_file('set', $ckey, $alert, $ctim);
			exit($alert);
		}
		$version == '' && exit('noups');
		$aver = '�����°汾��'.$version.' '.$build;
		cache_file('set', $ckey, $aver, $ctim);
		exit($aver);
	}

	function lrcmd_nt()
	{
		$lv = $this->Get['lv'];
		$ckey = 'fcache/home.console.lrcmd.nt';
		$ctim = 86400;
		$last = cache_file('get', $ckey);
		$last && exit($last);
		$response = request('lrcmd', array('lv'=>$lv), $error);
		$error && exit('false');
		$nt = $response['transfer'] ? $response['recommend'] : 'false';
		cache_file('set', $ckey, $nt, $ctim);
		exit($nt);
	}

	function Help()
	{
		$new=(int)$this->Get['new'];
		include(template('admin/help'));
		exit;
	}

	function Theme()
	{
		include(template('admin/theme'));
		exit;
	}

	function iframe() {
		$url = jget('url', 'txt');
		if(empty($url)) {
			$this->Messager('URL��ַ����Ϊ��');
		}

		include template('admin/index_iframe');
	}

}

?>