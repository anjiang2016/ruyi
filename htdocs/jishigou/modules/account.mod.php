<?php
/**
 * �ļ�����account.mod.php
 * ��     �ߣ�����<foxis@qq.com>
 * @version $Id: account.mod.php 5676 2014-05-09 09:20:56Z wuliyong $
 * ��������: �ʺŵ�¼ǰ̨ģ��
 * @todo �������ˡ����Ľӿ� 2011��9��22��
 */


if(!defined('IN_JISHIGOU'))
{
    exit('invalid request');
}

class ModuleObject extends MasterObject
{
	var $ID = '';

	function ModuleObject($config)
	{
		$this->MasterObject($config);

		$this->ID = jget('id', 'int');

		$this->Execute();
	}

	
	function Execute()
	{
		ob_start();
		switch ($this->Code)
		{
			;

			default:
				$this->Main();
		}
		$body=ob_get_clean();

		$this->ShowBody($body);
	}

	function Main()
	{
		if(!$this->Config['ldap_enable']){
		$member = jsg_member_info(MEMBER_ID);
		$act_list = array();
		$act_list['qqwb'] = '��Ѷ΢��';
		$act_list['sina'] = '����΢��';
		$act_list['yy'] = 'YY�ʺ�';
		$act_list['renren'] = '�����ʺ�';
		$act_list['kaixin'] = '�����ʺ�';
		if($this->Config['fjau_enable']) {
			$act_list['fjau'] = 'FJAU�ʺ�';
		}
		$act = isset($act_list[$this->Code]) ? $this->Code : 'qqwb';
		$this->Code = $act;

        
        if('qqwb' == $act)
        {
            $qqwb_init = qqwb_init($this->Config);

            if($qqwb_init)
            {


	            $qqwb = jconf::get('qqwb');

	            $qqwb_bind_info = qqwb_bind_info(MEMBER_ID);

	            if($qqwb_bind_info)
	            {
	                if($qqwb['is_synctopic_toweibo'])
	                {
	                    $synctoqq_radio = jform()->YesNoRadio('synctoqq',(int) $qqwb_bind_info['synctoqq']);
	                }
	                if($qqwb['is_synctopic_tojishigou']) {
	                	$sync_weibo_to_jishigou_radio = jform()->YesNoRadio('sync_weibo_to_jishigou', (int) $qqwb_bind_info['sync_weibo_to_jishigou']);
	                }
	                if($qqwb['is_syncreply_tojishigou']) {
	                	$sync_reply_to_jishigou_radio = jform()->YesNoRadio('sync_reply_to_jishigou', (int) $qqwb_bind_info['sync_reply_to_jishigou']);
	                }
	                
	                $expires_in_time = my_date_format($qqwb_bind_info['expires_time'], 'Y-m-d H:i');
	            }
            }

            ;
        }

		
		elseif ('sina' == $act)
		{
			$profile_bind_message = '����΢���ʺŰ󶨹���δ���ã�����ϵ����Ա';
			$sina_init = sina_init($this->Config);
			if($sina_init) {
				$sina = jconf::get('sina');
				if($sina['oauth2_enable']) {
					$sina_bind_info = sina_weibo_bind_info(MEMBER_ID);
					if($sina_bind_info) {
						$profiles = $sina_bind_info['profiles'];
						if($sina['is_synctopic_toweibo']) {
							$synctoweibo_radio = jform()->YesNoRadio('bind_setting', (int) sina_weibo_bind_setting(MEMBER_ID));
						}
						if($sina['is_synctopic_tojishigou']) {
							$synctopic_tojishigou_radio = jform()->YesNoRadio('synctopic_tojishigou', (int) $profiles['synctopic_tojishigou']);
						}
						if($sina['is_syncreply_tojishigou']) {
							$syncreply_tojishigou_radio = jform()->YesNoRadio('syncreply_tojishigou', (int) $profiles['syncreply_tojishigou']);
						}

						$expires_in_time = my_date_format($sina_bind_info['dateline'] + $sina_bind_info['expires_in'], 'Y-m-d H:i');
					}
				} else {
					$xwb_start_file = ROOT_PATH . 'include/ext/xwb/sina.php';
					if (!is_file($xwb_start_file)) {
						$profile_bind_message = '&#25554;&#20214;&#25991;&#20214;&#20002;&#22833;&#65292;&#26080;&#27861;&#21551;&#21160;&#65281;';
					} else {
						require($xwb_start_file);
						$profile_bind_message = '<a href="javascript:XWBcontrol.bind()">&#22914;&#26524;&#30475;&#19981;&#21040;&#26032;&#28010;&#24494;&#21338;&#32465;&#23450;&#35774;&#32622;&#31383;&#21475;&#65292;&#35831;&#28857;&#20987;&#36825;&#37324;&#21551;&#21160;&#12290;</a>';
						$GLOBALS['xwb_tips_type'] = 'bind';
						$profile_bind_message .= jsg_sina_footer();
					}
				}
			}
		}

		
		elseif ('yy' == $act)
		{
            $yy_init = yy_init($this->Config);

            if($yy_init)
            {
            	$yy_bind_info = yy_bind_info(MEMBER_ID);
            }

            ;
		}

		
		elseif ('renren' == $act)
		{
            $renren_init = renren_init($this->Config);

            if($renren_init)
            {
            	$renren_bind_info = renren_bind_info(MEMBER_ID);
            }

            ;
		}


		
		elseif ('kaixin' == $act)
		{
			$kaixin_init = kaixin_init($this->Config);

			if($kaixin_init)
			{
				$kaixin_bind_info = kaixin_bind_info(MEMBER_ID);
			}

			;
		}


		
		elseif ('fjau' == $act)
		{
			$fjau_init = fjau_init($this->Config);

			if($fjau_init)
			{
				$fjau_bind_info = fjau_bind_info(MEMBER_ID);
			}

			;
		}


		else
		{
			;
		}


		$this->Title = $act_list[$act];
		}
		include(template('setting/account_main'));
	}

}


?>
