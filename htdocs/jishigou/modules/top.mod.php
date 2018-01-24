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
 * @version $Id: top.mod.php 5139 2013-12-02 06:28:28Z wuliyong $
 */

if(!defined('IN_JISHIGOU')) {
    exit('invalid request');
}

class ModuleObject extends MasterObject {

    
    function ModuleObject($config) {
        $this->MasterObject($config, 1);
    }
    
    function index() {
        $this->Messager('����Ϊ����ת�������û��Ƽ�ҳ��', 'index.php?mod=top&code=member');
    }

    function member() {
        $this->Title = '�����û��Ƽ�';
        
        $show_conf = jconf::get('show', 'topic_top');
        $cache_conf = jconf::get('cache', 'topic_top');
        $credits = $this->Config['credits_filed'];
		$credits_name = $this->Config['credits']['ext'][$credits]['name'];
        
		        $top_fans_member = jlogic('member')->get_member_by_top_fans($show_conf['guanzhu'], $cache_conf['guanzhu']);
                $week_fans_member = jlogic('member')->get_member_by_fans($show_conf['renqi'], $cache_conf['renqi']);
                $week_topic_member = jlogic('member')->get_member_by_topic($show_conf['huoyue'], $cache_conf['huoyue']);
                $week_reply_member = jlogic('member')->get_member_by_reply($show_conf['yingxiang'], $cache_conf['yingxiang']);
                $top_credits_member = jlogic('member')->get_member_by_top_credits($show_conf['credits'], $cache_conf['credits'], $credits);
        
        include template();
    }
	
}