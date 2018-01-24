<?php
/**
 * �ļ�����renren.func.php
 * @version $Id: renren.func.php 4095 2013-08-08 02:09:43Z yupengfei $
 * ���ߣ�����<foxis@qq.com>
 * ��������: ���˽ӿں���
 */

if(!defined('IN_JISHIGOU'))
{
    exit('invalid request');
}


function renren_enable($sys_config = array())
{
	if(!$sys_config)
	{
		$sys_config = jconf::get();
	}

	if(!$sys_config['renren_enable'])
	{
		return false;
	}

    if(!$sys_config['renren'])
    {
        $sys_config['renren'] = jconf::get('renren');
    }

	return $sys_config;
}


function renren_oauth($access_token = null, $refresh_token = null)
{
	$renren_oauth = null;

	$sys_config = renren_enable();
	if($sys_config)
	{
		$client_id = $sys_config['renren']['client_id'];
		$client_secret = $sys_config['renren']['client_secret'];

		$renren_oauth = jclass('jishigou_oauth2_client');
		$renren_oauth->init($client_id, $client_secret, $access_token, $refresh_token);
		$renren_oauth->host = 'https:/'.'/graph.renren.com/';
		$renren_oauth->access_token_url = 'https:/'.'/graph.renren.com/oauth/token';
		$renren_oauth->authorize_url = 'https:/'.'/graph.renren.com/oauth/authorize';
	}

	return $renren_oauth;
}


function renren_api($method, $p, $request = 'POST', $renren_oauth = null)
{
	$ret = false;

	$sys_config = renren_enable();
	if($sys_config)
	{
		$renren_oauth = $renren_oauth ? $renren_oauth : renren_oauth();
		if($renren_oauth)
		{
			$url = 'http:/'.'/api.renren.com/restserver.do';

	    	$p['api_key'] = $sys_config['renren']['client_id'];
	    	$p['method'] = $method;
	    	$p['v'] = '1.0';
	    	$p['format'] = 'json';

	    	$p = renren_sign($p, $sys_config['renren']['client_secret']);

			if('POST' == $request)
			{
				$ret = $renren_oauth->post($url, $p);
			}
			else
			{
				$ret = $renren_oauth->get($url, $p);
			}
		}
	}

	return $ret;
}


function renren_sync($data)
{
	$sys_config = renren_init();
	if(!$sys_config)
	{
		return 'renren_init is invalid';
	}

	$tid = is_numeric($data['tid']) ? $data['tid'] : 0;
	if($tid < 1)
	{
		return 'tid is invalid';
	}

	$uid = is_numeric($data['uid']) ? $data['uid'] : 0;
	if($uid < 1)
	{
		return 'uid is invalid';
	}

	$totid = is_numeric($data['totid']) ? $data['totid'] : 0;

	$content = $data['content'];
	if(false !== strpos($content, '['))
	{
		$content = preg_replace('~\[([^\]]{1,6}?)\]~', '(\\1)', $content);
	}
	$content = trim(strip_tags($content));

	$name = array_iconv($sys_config['charset'], 'UTF-8', cutstr($content, 50));

	$content = array_iconv($sys_config['charset'], 'UTF-8', $content);
	if(!$content)
	{
		return 'content is invalid';
	}

	$url = get_full_url($sys_config['site_url'], 'index.php?mod=topic&code=' . $tid);

	

	$renren_bind_info = renren_bind_info($uid);
	if(!$renren_bind_info)
	{
		return 'bind_info is empty';
	}

	if(!renren_has_bind($uid))
	{
		return 'bind_info is invalid';
	}

	$renren_bind_topic = DB::fetch_first("select * from ".DB::table('renren_bind_topic')." where `tid`='$tid'");
	if($renren_bind_topic)
	{
		return 'bind_topic is invalid';
	}
	else
	{
		DB::query("insert into ".DB::table('renren_bind_topic')." (`tid`) values ('$tid')");
	}

	$ret = array();
	if($totid < 1)
	{
		$p = array();
		$p['access_token'] = $renren_bind_info['token'];
		$p['name'] = $name;
		$p['description'] = $content;
		$p['url'] = $url;

		$p['action_name'] = array_iconv($sys_config['charset'], 'UTF-8', '���ԣ�'.$sys_config['site_name']);
				$p['action_link'] = $url;


		$imageid = (int) $data['imageid'];
		if($imageid > 0 && $sys_config['renren']['is_sync_image'])
		{
			$topic_image = topic_image($imageid, 'original');
			if(is_image(ROOT_PATH . $topic_image))
			{
				$p['image'] = $sys_config['site_url'] . '/' . $topic_image;
			}
		}

		$ret = renren_api('feed.publishFeed', $p);
	}


	$renren_id = is_numeric($ret['post_id']) ? $ret['post_id'] : 0;
	if($renren_id > 0)
	{
		DB::query("UPDATE ".DB::table('renren_bind_topic')." SET `renren_id`='$renren_id' WHERE `tid`='$tid'");
	}

	return $ret;
}


function renren_login($ico='s')
{
	$return = '';

	if (false != ($sys_config = renren_enable()))
	{
		$icos = array
		(
			's' => $sys_config['site_url'] . '/images/renren/login16.png',
			'm' => $sys_config['site_url'] . '/images/renren/login24.gif',
			'b' => $sys_config['site_url'] . '/images/renren/login.gif',
		);
		$ico = (isset($icos[$ico]) ? $ico : 's');
		$img_src = $icos[$ico];

		$return = '<a class="renrenLogin" href="#" onclick="window.location.href=\''.$sys_config['site_url'].'/index.php?mod=renren&code=login\';return false;"><img src="'.$img_src.'" /></a>';
	}

	return $return;
}

function renren_bind($uid=0)
{
    $bind_info = renren_bind_info($uid);

    return ($bind_info && $bind_info['renren_uid'] && $bind_info['token']);
}
function renren_has_bind($uid=0)
{
    return renren_bind($uid);
}


function renren_bind_info($uid=0)
{
    static $srenren_bind_infos = null;

	$return = array();

	$uid = max(0,(int) ($uid ? $uid : MEMBER_ID));

    if($uid > 0)
    {
        if(null===($return = $srenren_bind_infos[$uid]))
		{
			$return = DB::fetch_first("select * from ".DB::table('renren_bind_info')." where `uid`='{$uid}'");

			$srenren_bind_infos[$uid] = $return;
		}
    }

    return $return;
}


function renren_bind_icon($uid=0)
{
	$return = '';

	$uid = max(0,(int) ($uid ? $uid : MEMBER_ID));

	if ($uid > 0 && ($sys_config = renren_enable()))
	{

		$return = "<img src='{$sys_config['site_url']}/images/renren/off.gif' alt='δ������' />";

		if (renren_bind($uid))
		{
			$return = "<img src='{$sys_config['site_url']}/images/renren/on.gif' alt='�Ѿ�������' />";
		}

		if (MEMBER_ID>0)
		{
			$return = "<a href='#' title='���˰�����' onclick=\"window.location.href='{$sys_config['site_url']}/index.php?mod=account&code=renren';return false;\">{$return}</a>";
		}
	}

	return $return;
}


function renren_syn_html($uid = 0)
{
	$return = '';

	$uid = max(0,(int) ($uid ? $uid : MEMBER_ID));

	if ($uid > 0 && ($sys_config = renren_enable()) && $sys_config['renren']['is_sync_topic'])
	{
		$row = renren_bind_info($uid);

		$a = $b = $c = $d = $e = '';
		if ($row && $row['renren_uid'])
		{
			$b = "{$sys_config['site_url']}/images/renren/icon_on.gif";

			if((true === IN_JISHIGOU_INDEX || true === IN_JISHIGOU_AJAX || true === IN_JISHIGOU_ADMIN) && 'output'!=jget('mod')) {
	            $dataSetting = 0;
				if (!($row['renren_uid']))
				{
	                $dataSetting = 1;
					$b = "{$sys_config['site_url']}/images/renren/icon_off.gif";
				}
				$e = "<i></i><img id='syn_to_renren' src='{$b}' data-setting='{$dataSetting}' data-type='renren' onclick='modifySync(this);' title='ͬ������������'/>";
			} else {
								$e = '<label><input type="checkbox" name="syn_to_renren" value="1" '.($row['renren_uid'] ? ' checked="checked" ' : '').' />
					<img src="'.$b.'" title="ͬ������������" /></label>';
			}

		}
		else
		{
			$b = "{$sys_config['site_url']}/images/renren/icon_off.gif";
			$c = "disabled='disabled'";
			$e = "<a href='{$sys_config['site_url']}/index.php?mod=account&code=renren' title='��ͨ�˹��ܣ������´��ڣ�'><i></i><img src='{$b}' title='ͬ������������'/></a>";
		}

		$return = "{$a}{$e}";
	}

	return $return;
}


function renren_sign($p, $secret_key, $signk = 'sig')
{
	ksort($p);
	reset($p);

	$str = '';
	foreach($p as $k=>$v)
	{
		$str .= $k.'='.$v;
	}

	$signv = md5($str . $secret_key);

	if($signk)
	{
		$p[$signk] = $signv;
		return $p;
	}
	else
	{
		return $signv;
	}
}

function renren_session_key($access_token)
{
	return substr($access_token, strpos($access_token, '|') + 1);
}

?>