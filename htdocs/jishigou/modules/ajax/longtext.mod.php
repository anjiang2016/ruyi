<?php
/**
 *
 * ����AJAXģ��
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: longtext.mod.php 4769 2013-10-30 09:35:01Z wuliyong $
 */


if(!defined('IN_JISHIGOU'))
{
    exit('invalid request');
}

class ModuleObject extends MasterObject
{
	var $ID = 0;

	var $LongtextLogic;

	function ModuleObject($config)
	{
		$this->MasterObject($config);


		$this->ID = max(0, (int) ($this->Post['id'] ? $this->Post['id'] : $this->Get['id']));

		$this->LongtextLogic = jlogic('longtext');

		$this->Execute();
	}

	function Execute()
	{
		switch($this->Code)
		{
            case 'add':
            	$this->Add();
            	break;
            case 'do_add':
            	$this->DoAdd();
            	break;

            case 'modify':
            	$this->Modify();
            	break;
            case 'do_modify':
            	$this->DoModify();
            	break;

            case 'view':
            	$this->View();
            	break;

			default:
				$this->Main();
				break;
		}
	}

	function Main()
    {
        response_text('���ڽ����С���');
    }

    function Add()
    {
    	$this->_show();
    }
    function DoAdd()
    {
    	$this->_check_login();

    	$longtext = $this->Post['longtext'] ? $this->Post['longtext'] : $this->Get['longtext'];
    	if('' == (trim(strip_tags($longtext))))
    	{
    		json_error('���ݲ���Ϊ��');
    	}
    	$f_rets = filter($longtext);
    	if($f_rets && $f_rets['error'])
    	{
    		json_error('���� ' . $f_rets['msg']);
    	}

    	$data_length_limit = ($this->Config['topic_cut_length'] * 2);
    	$retval_data = trim(strip_tags($longtext));
    	$retval_data_length = strlen($retval_data);

    	$ret = 0;
    	$ret_msg = '';
    	if($retval_data_length > $data_length_limit)
    	{
	    	$ret = $this->LongtextLogic->add($longtext);
	    	if($ret < 1)
	    	{
	    		json_error('�������ʧ��');
	    	}
	    	else
	    	{
	    		$ret_msg = '������ӳɹ�';
	    	}
    	}
    	else
    	{
    		$ret_msg = '���ݳ��ȹ��̣����ȷ����ťֱ�ӷ���һ��΢��';
    	}


    	$retval = array(
    		'id' => $ret,
    		'data' => cut_str($retval_data, $data_length_limit, ''),
    	);
    	json_result($ret_msg, $retval);
    }

    function Modify()
    {
    	$this->_show(1);
    }
    function DoModify()
    {
    	;
    }

    function _show($is_modify = 0)
    {
    	$this->_check_login();

    	$longtext_info = array();


    	$action = 'ajax.php?mod=longtext&code=do_add';
    	if($is_modify)
    	{
    		$action = 'ajax.php?mod=longtext&code=do_modify';

	    	$longtext_info = $this->LongtextLogic->get_info($this->ID);

    		if(!$longtext_info)
    		{
    			js_alert_output('��ָ��һ����ȷ��ID');
    		}
    	}
    	else
    	{
    		$longtext = trim($this->Post['longtext'] ? $this->Post['longtext'] : $this->Get['longtext']);
    		if($longtext)
    		{
    			$longtext_info['longtext'] = $longtext;
    		}
    	}


    	$content_id = trim($this->Post['content_id'] ? $this->Post['content_id'] : $this->Get['content_id']);
    	if(!$content_id)
    	{
    		$content_id = 'i_already';
    	}

    	$button_id = trim($this->Post['button_id'] ? $this->Post['button_id'] : $this->Get['button_id']);
    	if(!$button_id)
    	{
    		$button_id = 'publishSubmit';
    	}

    	$from_cls = trim($this->Post['from_cls'] ? $this->Post['from_cls'] : $this->Get['from_cls']);


    	include(template('topic_longtext_info_ajax'));
    }

    function _check_login()
    {


		if(MEMBER_ID < 1)
		{
			json_error("���ȵ�¼����ע��һ���ʺ�");
		}
    }

    function View() {
        $tid = 0;
        $tidv = jget('tid','txt');
        if(!is_numeric($tidv) && false !== strpos($tidv, '_')) {
        	$tid = end(explode('_', $tidv));
        } else {
        	$tid = $tidv;
        }
        $tid = jfilter($tid, 'int');
        
        
		$view_rets = jlogic('topic')->check_view($tid);
		if($view_rets['error']) {
			exit($view_rets['result']);
		}

        $option = array(
            'TPT_id' => jget('TPT_id'),
            'ptidv' => jget('ptidv')
        );

        $ret = '';
        if ($tid > 0) {
            $info = $this->LongtextLogic->get_info($tid, $option);
            if($info) {
            	$ret = $info['content'];
            	if($info['longtextid'] > 0) {
            		$ret = nl2br($ret);
            	}
            }
        }

    	exit($ret);
    }

}

?>
