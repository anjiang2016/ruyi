<?php
/**
 * ��Ѷ΢��OAuth��Ȩ��API�ӿ���
 *
 * @author ���� <foxis@qq.com>
 * @version $Id$
 */

class qqwbOAuth
{
    public static $client_id = '';
    public static $client_secret = '';

    private static $accessTokenURL = 'https://open.t.qq.com/cgi-bin/oauth2/access_token';
    private static $authorizeURL = 'https://open.t.qq.com/cgi-bin/oauth2/authorize';

    public static $openid = '';
    public static $openkey = '';
    public static $access_token = '';
    private static $api_host = 'https://open.t.qq.com/api/';
    private static $debug = false;

    /**
     * ��ʼ��
     * @param $client_id �� appid
     * @param $client_secret �� appkey
     * @return
     */
    public static function init($client_id, $client_secret, $access_token = '', $openid = '', $openkey = '')
    {
        if (!$client_id || !$client_secret) exit('client_id or client_secret is null');
        self::$client_id = $client_id;
        self::$client_secret = $client_secret;
        self::$access_token = $access_token;
        self::$openid = $openid;
        self::$openkey = $openkey;
    }

    /**
     * ��ȡ��ȨURL
     * @param $redirect_uri ��Ȩ�ɹ���Ļص���ַ����������Ӧ�õ�url
     * @param $response_type ��Ȩ���ͣ�Ϊcode
     * @param $wap ����ָ���ֻ���Ȩҳ�İ汾��Ĭ��PC��ֵΪ1ʱ����wap1.0����Ȩҳ��Ϊ2ʱͬ��
     * @return string
     */
    public static function getAuthorizeURL($redirect_uri, $response_type = 'code', $wap = false)
    {
        $params = array(
            'client_id' => self::$client_id,
            'redirect_uri' => $redirect_uri,
            'response_type' => $response_type,
            'wap' => $type
        );
        return self::$authorizeURL.'?'.http_build_query($params);
    }

    /**
     * ��ȡ����token��url
     * @param $code ����authorizeʱ���ص�code
     * @param $redirect_uri �ص���ַ�����������codeʱ��redirect_uriһ��
     * @return string
     */
    public static function getAccessToken($code, $redirect_uri)
    {
        $params = array(
            'client_id' => self::$client_id,
            'client_secret' => self::$client_secret,
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirect_uri
        );
        $url = self::$accessTokenURL.'?'.http_build_query($params);
        $r = self::request($url);
        parse_str($r, $out);
        return $out;
    }

    /**
     * ����һ����ѶAPI����
     * @param $command �ӿ����� �磺t/add
     * @param $params �ӿڲ���  array('content'=>'test');
     * @param $method ����ʽ POST|GET
     * @param $multi ͼƬ��Ϣ
     * @return string
     */
    public static function api($command, $params = array(), $method = 'GET', $multi = false)
    {    	
		//OAuth 2.0 ��ȨĬ�ϲ���
		$params_def = array();
		$params_def['format'] = 'json';
		$params_def['access_token'] = self::$access_token;
		$params_def['oauth_consumer_key'] = self::$client_id;
		$params_def['openid'] = self::$openid;
		$params_def['oauth_version'] = '2.a';
		$params_def['clientip'] = $GLOBALS['_J']['client_ip'];
		$params_def['scope'] = 'all';
		$params_def['appfrom'] = 'JishiGou OAuth2 Client v0.2';
		$params_def['seqid'] = time();
		$params_def['serverip'] = $_SERVER['SERVER_ADDR'];
		
		settype($params, 'array');
		$params = array_merge($params_def, $params);
		
		if(empty($params['access_token']) || empty($params['openid'])) {
			exit('openid or access_token is empty');
		}
		
		$url = self::$api_host.trim($command, '/');


        //����ӿ�
        $r = self::request($url, $params, $method, $multi);
        $r = preg_replace('/[^\x20-\xff]*/', "", $r); //������ɼ��ַ�
        $r = iconv("utf-8", "utf-8//ignore", $r); //UTF-8ת��
        //������Ϣ
        if (self::$debug) {
            echo '<pre>';
            echo '�ӿڣ�'.$url;
            echo '<br>���������<br>';
            print_r($params);
            echo '���ؽ����'.$r;
            echo '</pre>';
        }
        $r = json_decode($r, true);
        $r = array_iconv('utf-8', $GLOBALS['_J']['config']['charset'], $r);
        return $r['data'];
    }
    
    /**
     * ����һ��HTTP/HTTPS������
     * @param $url �ӿڵ�URL
     * @param $params �ӿڲ���   array('content'=>'test', 'format'=>'json');
     * @param $method ��������    GET|POST
     * @param $multi ͼƬ��Ϣ
     * @param $extheaders ��չ�İ�ͷ��Ϣ
     * @return string
     */
    public static function request( $url , $params = array(), $method = 'GET' , $multi = false, $extheaders = array())
    {
        if(!function_exists('curl_init')) {
        	exit('Need to open the curl extension');
        }
        $method = strtoupper($method);
        $ci = curl_init();
        curl_setopt($ci, CURLOPT_USERAGENT, $params['appfrom']);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 3);
        $timeout = $multi?30:3;
        curl_setopt($ci, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ci, CURLOPT_HEADER, false);
        $headers = (array)$extheaders;
        switch ($method)
        {
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, TRUE);
                if (!empty($params))
                {
                    if($multi)
                    {
                        foreach($multi as $key => $file)
                        {
                            $params[$key] = '@' . $file;
                        }
                        curl_setopt($ci, CURLOPT_POSTFIELDS, $params);
                        $headers[] = 'Expect: ';
                    }
                    else
                    {
                        curl_setopt($ci, CURLOPT_POSTFIELDS, http_build_query($params));
                    }
                }
                break;
            case 'DELETE':
            case 'GET':
                $method == 'DELETE' && curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty($params))
                {
                    $url = $url . (strpos($url, '?') ? '&' : '?')
                        . (is_array($params) ? http_build_query($params) : $params);
                }
                break;
        }
        curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE );
        curl_setopt($ci, CURLOPT_URL, $url);
        if($headers)
        {
            curl_setopt($ci, CURLOPT_HTTPHEADER, $headers );
        }

        $response = curl_exec($ci);
        curl_close ($ci);
        return $response;
    }
    
	function tAdd($content = '')
	{
		$params = array();
		$params['content'] = $content;
		$params['clientip'] = $GLOBALS['_J']['client_ip'];

		return self::api('t/add', $params, 'POST');
	}

	function tAddPic($content = '',$pic=array())
	{
		$params = array();
		$params['content'] = $content;
		$params['clientip'] = $GLOBALS['_J']['client_ip'];
		$params['pic'] = $pic;
		
		return self::api('t/add_pic', $params, 'POST', true);
	}

	function tReply($reid,$content)
	{
		$params = array(
            'reid' => $reid,
            'content' => $content,
            'clientip' => $GLOBALS['_J']['client_ip'],
		);

		return self::api('t/reply', $params, 'POST');
	}
}