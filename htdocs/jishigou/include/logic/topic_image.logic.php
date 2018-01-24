<?php
/**
 *
 * ΢��ͼƬ������
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: topic_image.logic.php 5539 2014-02-11 09:22:05Z chenxianfeng $
 */
if(!defined('IN_JISHIGOU')) {
    exit('invalid request');
}

class TopicImageLogic {

    public function __construct() {
        ;
    }
    
    
    public function del($tid, $id) {
    	$id = (int) $id;
    	if($id < 1) {
    		return jerror('Ҫɾ����ͼƬID����Ϊ��', -1);
    	}
    	$info = jlogic('image')->get_info($id);
    	if(!$info) {
    		return jerror('��ָ��һ����ȷ��ͼƬID��ͼƬ�����ڻ��Ѿ���ɾ���ˡ�', -2);
    	}
    	if(jdisallow($info['uid'])) {
    		return jerror('����Ȩ�Ը�ͼƬ���в���', -3);
    	}
    	$tid = (int) $tid;
    	if($tid > 0) {
	    	$tinfo = jlogic('topic')->Get($tid);
	    	if(!$tinfo) {
	    		return jerror('��ָ��һ����ȷ��΢��ID��΢�������ڻ��Ѿ���ɾ���ˡ�', -5);
	    	}
	    	if(jdisallow($tinfo['uid'])) {
	    		return jerror('����Ȩ�Ը�΢�����в���', -6);
	    	}
			$_iids = explode(',', $tinfo['imageid']);
			foreach($_iids as $iid) {
				$iids[$iid] = $iid;
			}
			unset($iids[$id]);
			jlogic('image')->set_topic_imageid($tid, $iids);
    	} else {
    		if(!$info['tid']) {
    			jlogic('image')->delete($id);
    		}elseif($tid){
				return jerror('ɾ��ʧ�ܣ���ͼ������ɾ��', -10);
			}
    	}
    } 

}