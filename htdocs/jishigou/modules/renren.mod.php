<?php
/**
 * �ļ�����renren.mod.php
 * @version $Id: renren.mod.php 3773 2013-06-03 03:45:01Z yupengfei $
 * ���ߣ�����<foxis@qq.com>
 * ��������: ���˽ӿ�ģ��
 */

/**
 * ModuleObject
 *
 * @package www.jishigou.com
 * @author ����<foxis@qq.com>
 * @copyright 2011
 * @version $Id: renren.mod.php 3773 2013-06-03 03:45:01Z yupengfei $
 * @access public
 */
if(!defined('IN_JISHIGOU'))
{
    exit('invalid request');
}

class ModuleObject extends MasterObject
{
	var $callback_url = '';

    var $renrenConfig = array();

    var $renrenBindInfo = array();

    var $renrenOauth = '';


	function ModuleObject($config)
	{
		$this->MasterObject($config);

		$this->_init_renren();

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

            case 'login_check':
                $this->LoginCheck();
                break;

            case 'do_login':
                $this->DoLogin();
                break;

            case 'reg_check':
                $this->RegCheck();
                break;

            case 'do_reg':
                $this->DoReg();
                break;

            case 'unbind':
                $this->UnBind();
                break;

            case 'do_modify_bind_info':
                $this->DoModifyBindInfo();
                break;

			default:
                $this->AuthCallback();
		}
		$body=ob_get_clean();

		$this->ShowBody($body);
	}

    function Login()
    {
    	$keys = array(
    		'scope' => 'publish_feed',
    	);

        $aurl = $this->renrenOauth->getAuthorizeURL($this->callback_url, 'code', $keys);

        
        $this->Messager(null,$aurl);
    }

    function AuthCallback()
    {
    	if(!$this->Code)
    	{
    		$this->Messager("δ����Ĳ���", null);
    	}


    	$last_keys = $this->_get_last_keys();
		if(!$last_keys) {
			$this->Messager("��������Ϊ�գ����ķ������Ƿ�֧��OpenSSL�����顭��");
		}
    	if($last_keys['error'])
    	{
    		$last_keys = array_iconv('UTF-8', $this->Config['charset'], $last_keys);
    		$this->Messager("[{$last_keys['error']}]{$last_keys['error_description']}", null);
    	}
    	if(!$last_keys['access_token'])
    	{
    		$this->Messager("�������", null);
    	}

                $renren_user_info = $this->_get_renren_user_info4($last_keys['access_token']);
        $renren_user_info = array_iconv('UTF-8', $this->Config['charset'], $renren_user_info);
    	if($renren_user_info['error_code'])
    	{
    		$this->Messager("[{$renren_user_info['error_code']}]{$renren_user_info['error_msg']}", null);
    	}
        if(!$renren_user_info['uid'])
        {
        	$this->Messager('��ȡ�û���Ϣʧ��', null);
        }


        $renren_bind_info = DB::fetch_first("select * from ".TABLE_PREFIX."renren_bind_info where `renren_uid`='{$renren_user_info['uid']}'");
        if($renren_bind_info)
        {
        	$this->_update($renren_bind_info, $renren_user_info, $last_keys);

                        if(false != ($user_info = $this->_user_login($renren_bind_info['uid'])))
            {
                if(true === UCENTER && ($ucuid = (int) $user_info['ucuid']) > 0)
                {
                    include_once(ROOT_PATH . './api/uc_client/client.php');

                    $uc_syn_html = uc_user_synlogin($ucuid);

                    $this->Messager("��¼�ɹ�������Ϊ����ת����ҳ��{$uc_syn_html}", $this->Config['site_url'], 5);
                }

                $this->Messager(null, $this->Config['site_url']);
            }
            else
            {
                $this->DatabaseHandler->Query("delete from ".TABLE_PREFIX."renren_bind_info where `renren_uid`='{$renren_user_info['uid']}'");

                $this->Messager("�󶨵��û��Ѿ���������", $this->Config['site_url']);
            }
        }
        else
        {
        	$bind_info = array_merge($renren_user_info, $last_keys);

            if(MEMBER_ID > 0)
            {
            	$this->_bind(MEMBER_ID, $bind_info);

                $this->Messager(null, $this->Config['site_url']);
            }
            else
            {
                                $hash = authcode(md5($bind_info['uid'] . $bind_info['access_token']), 'ENCODE');

                $reg = array();
                $renren_uid = (string) $renren_user_info['uid'];
                $renren_uid{0} = $renren_uid{1} = 'x';
                $reg['username'] = 'rr_' . $renren_uid;
                $reg['email'] = $renren_user_info['email'];
                $reg['nickname'] = $renren_user_info['name'];


                $this->Title = '�����ʺŰ�';
                include(template('bind/bind_info_renren'));
            }
        }
    }

    function RegCheck()
    {
        exit($this->_reg_check());
    }
    function _reg_check()
    {
        $regstatus = jsg_member_register_check_status();
		if($regstatus['error'])
		{
			Return $regstatus['error'];
		}
		if(true!==JISHIGOU_FORCED_REGISTER && $regstatus['invite_enable'])
		{
			if(!$regstatus['normal_enable'])
			{
				Return '��վĿǰ��Ҫ���������Ӳ���ע�ᡣ' . jsg_member_third_party_reg_msg();
			}
		}

        $in_ajax = get_param('in_ajax');
        if($in_ajax)
        {
            $this->Post = array_iconv('utf-8',$this->Config['charset'],$this->Post, 1);
        }

		$nickname = trim($this->Post['nickname']);
        $email = trim($this->Post['email']);



        $rets = array(
        	'0' => '[δ֪����] �п�����վ��ر���ע�Ṧ��',
        	'-1' => '���Ϸ�',
        	'-2' => '������ע��',
        	'-3' => '�Ѿ�������',
        	'-4' => '���Ϸ�',
        	'-5' => '������ע��',
        	'-6' => '�Ѿ�������',
        );

        $ret = jsg_member_checkname($nickname, 1);
        if($ret < 1)
        {
        	return "�ʻ�/�ǳ� " . $rets[$ret];
        }

        $ret = jsg_member_checkemail($email);
        if($ret < 1)
        {
        	return "Email " . $rets[$ret];
        }

        $password = trim($this->Post['password']);
        if(strlen($password) < 6) {
        	return "��������5λ����";
        }

        return '';
    }
    function DoReg()
    {
    	$this->_hash_check();

        if(false != ($check_result = $this->_reg_check()))
        {
            $this->Messager($check_result,null);
        }

        $username = trim($this->Post['username']);
        $nickname = trim($this->Post['nickname']);
        $password = trim($this->Post['password']);
        $email = trim($this->Post['email']);



        $uid = $ret = jsg_member_register($nickname, $password, $email);
        if($ret < 1)
        {
        	$this->Messager("ע��ʧ��{$ret}",null);
        }

        $rets = jsg_member_login($uid, $password, 'uid');


        $bind_info = $this->Post['bind_info'];
        if($bind_info)
        {
            $this->_bind($rets['uid'], $bind_info);
        }


        if($this->renrenConfig['reg_pwd_display'])
        {
            $this->Messager("�����ʻ� <strong>{$rets['nickname']}</strong> �Ѿ�ע��ɹ������μ��������� <strong>{$password}</strong>������Ϊ��ת�뵽��ҳ{$rets['uc_syn_html']}", $this->Config['site_url'],10);
        }
        else
        {
            if($rets['uc_syn_html'])
            {
                $this->Messager("ע��ɹ�������Ϊ��ת�뵽��ҳ{$rets['uc_syn_html']}", $this->Config['site_url']);
            }
            else
            {
                $this->Messager(null, $this->Config['site_url']);
            }
        }
    }

    function LoginCheck()
    {
        exit($this->_login_check());
    }
    function _login_check()
    {
        $in_ajax = get_param('in_ajax');
        if($in_ajax)
        {
            $this->Post = array_iconv('utf-8',$this->Config['charset'],$this->Post, 1);
        }

        $username = trim($this->Post['username']);
        $password = trim($this->Post['password']);


        $rets = jsg_member_login_check($username, $password);
        $ret = $rets['uid'];
        if($ret < 1)
        {
        	$rets = array(
        		'0' => 'δ֪���� ',
        		'-1' => '�û��������������',
        		'-2' => '�û��������������',
        		'-3' => '�ۼ� ' . jconf::get('failedlogins', 'limit') . ' �δ����ԣ�' . jconf::get('failedlogins', 'time') . ' �������������ܵ�¼',
        	);

        	return $rets[$ret];
        }

        return '';
    }
    function DoLogin()
    {
        $this->_hash_check();

        if(false != ($check_result = $this->_login_check()))
        {
            $this->Messager($check_result,null);
        }

        $timestamp = time();
        $username = trim($this->Post['username']);
        $password = trim($this->Post['password']);


        $rets = jsg_member_login($username, $password);


        $bind_info = $this->Post['bind_info'];
        if($bind_info)
        {
            $this->_bind($rets['uid'], $bind_info);
        }


    	if($rets['uc_syn_html'])
        {
            $this->Messager("��¼�ɹ�������Ϊ��ת�뵽��ҳ{$rets['uc_syn_html']}", $this->Config['site_url'], 5);
        }
        else
        {
        	$this->Messager(null, $this->Config['site_url']);
        }
    }

    
    function _hash_check()
    {
    	$hash = '';
    	if($this->Post['hash'])
    	{
    		$hash = authcode($this->Post['hash'], 'DECODE');
    	}

    	$md5 = md5($this->Post['bind_info']['uid'] . $this->Post['bind_info']['access_token']);

    	if($hash != $md5)
    	{
    		$this->Messager("�Ƿ�����", null);
    	}
    }

    function UnBind()
    {
        $uid = max(0, (int) MEMBER_ID);
        if($uid < 1)
        {
            $this->Messager("����<a onclick='ShowLoginDialog(); return false;'>��˵�¼</a>����<a onclick='ShowLoginDialog(1); return false;'>���ע��</a>һ���ʺ�",null);
        }

        $this->_unbind($uid);


        $this->Messager("�Ѿ��ɹ������");
    }
    function _unbind($uid)
    {
    	$this->DatabaseHandler->Query("delete from ".TABLE_PREFIX."renren_bind_info where `uid`='$uid'");
    }

    function DoModifyBindInfo()
    {
        $uid = max(0, (int) MEMBER_ID);
        if($uid < 1)
        {
            $this->Messager("����<a onclick='ShowLoginDialog(); return false;'>��˵�¼</a>����<a onclick='ShowLoginDialog(1); return false;'>���ע��</a>һ���ʺ�",null);
        }

        $synctoqq = (get_param('synctoqq') ? 1 : 0);

        $this->DatabaseHandler->Query("update ".TABLE_PREFIX."renren_bind_info set `synctoqq`='$synctoqq' where `uid`='$uid'");


        $this->Messager("���óɹ�");
    }

    function _bind($uid, $bind_info, $last_keys = array())
    {
    	$ret = false;

    	$uid = is_numeric($uid) ? $uid : 0;
    	if($uid > 0)
    	{
    		if($last_keys)
	    	{
	    		foreach($last_keys as $k=>$v)
	    		{
	    			if(!isset($bind_info[$k]))
	    			{
	    				$bind_info[$k] = $v;
	    			}
	    		}
	    	}

    		$this->DatabaseHandler->Query("delete from ".TABLE_PREFIX."renren_bind_info where `uid`='$uid'");
	    	$this->DatabaseHandler->Query("delete from ".TABLE_PREFIX."renren_bind_info where `renren_uid`='{$bind_info['uid']}'");
    		$user_info = DB::fetch_first("select * from ".TABLE_PREFIX."members where `uid`='$uid'");
	    	if(!$user_info)
	    	{
	    		return false;
	    	}

    		if($bind_info['uid'] && $bind_info['access_token'])
    		{
    			$timestamp = time();

	    		$ret = $this->DatabaseHandler->Query("insert into ".TABLE_PREFIX."renren_bind_info
					(`uid`,`renren_uid`,`renren_name`,`renren_sex`,`renren_star`,`renren_headurl`,`token`,`token_time`,`token_expire`,`dateline`) values
				('$uid','{$bind_info['uid']}','{$bind_info['name']}','{$bind_info['sex']}','{$bind_info['star']}','{$bind_info['headurl']}','{$bind_info['access_token']}','$timestamp','{$bind_info['expires_in']}','$timestamp')");
    		}
    	}

		return $ret;
    }

    function _update($renren_bind_info, $renren_user_info, $last_keys = array())
    {
    	$ret = 0;

    	if(!$renren_bind_info['renren_uid'] || $renren_bind_info['renren_uid']!=$renren_user_info['uid'])
    	{
    		return $ret;
    	}

    	$updates = array('name'=>'renren_name', 'sex'=>'renren_sex', 'star'=>'renren_star', 'headurl'=>'renren_headurl', 'access_token'=>'token', );

    	if($last_keys)
    	{
    		foreach($last_keys as $k=>$v)
    		{
    			if(!isset($renren_user_info[$k]))
    			{
    				$renren_user_info[$k] = $v;
    			}
    		}
    	}

    	$sets = array();
    	foreach($renren_user_info as $k=>$v)
    	{
    		$k = $updates[$k];
    		if($k && isset($renren_bind_info[$k]) && $renren_bind_info[$k] != $v)
    		{
    			$sets[$k] = "`$k`='$v'";
    		}
    	}

    	if($sets)
    	{
    		$ret = $this->DatabaseHandler->Query("update ".TABLE_PREFIX."renren_bind_info set ".implode(" , ", $sets)." where `renren_uid`='{$renren_bind_info['renren_uid']}'");
    	}

    	return $ret;
    }

    function _init_renren()
    {
        if ($this->Config['renren_enable'] && renren_init($this->Config))
		{
			$this->callback_url = $this->Config['site_url'] . "/index.php?mod=renren";

            $this->renrenConfig = jconf::get('renren');

			if(MEMBER_ID > 0)
            {
                $this->renrenBindInfo = DB::fetch_first("select * from ".TABLE_PREFIX."renren_bind_info where `uid`='".MEMBER_ID."'");
            }


            $this->_init_renren_oauth();

			if($this->Config['third_party_regstatus'] && in_array('renren', $this->Config['third_party_regstatus'])) {
	    		define('JISHIGOU_FORCED_REGISTER', true);
	    	}
		}
		else
		{
			$this->Messager("�������˵Ĺ���δ����",null);
		}
    }

    function _init_renren_oauth($access_token = null)
    {
        $this->renrenOauth = renren_oauth($access_token);
    }

    function _user_login($uid)
    {


    	return jsg_member_login_set_status($uid);
    }

    function _get_last_keys()
    {
    	$p = array(
    		'code' => $this->Code,
    		'redirect_uri' => $this->callback_url,
    	);

    	return $this->renrenOauth->getAccessToken('code', $p);
    }

    function _get_renren_user_info4($access_token = null)
    {
    	$rets = $this->_get_renren_loggend_user_info($access_token);
    	$uid = $rets['uid'];
    	if($uid)
    	{
    		$session_key = renren_session_key($access_token);

    		$rets = $this->_get_renren_user_info($uid, $session_key);
    		if(!$rets['error_code'] && $rets[0])
    		{
    			$rets = $rets[0];

    			if($rets['name'])
    			{
    				$rets['uid'] = $uid;
    			}
    		}
    	}

    	return $rets;
    }

    function _get_renren_loggend_user_info($access_token = null)
    {
    	$p = array(
    		'access_token' => $access_token,
    	);

    	$ret = $this->_api_call('users.getLoggedInUser', $p);

    	return $ret;
    }

    function _get_renren_user_info($uids, $session_key = null)
    {
    	$p = array(
    		'uids' => $uids,
    	);
    	if($session_key)
    	{
    		$p['session_key'] = $session_key;
    	}

    	$ret = $this->_api_call('users.getInfo', $p);

    	return $ret;
    }

    function _api_call($method, $p)
    {
    	$ret = renren_api($method, $p, 'POST', $this->renrenOauth);

    	return $ret;
    }
}


?>
