<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename admin_left_menu.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 37961372 18772 $
 */

 $menu_list = array (
  1 => 
  array (
    'title' => '���ò���',
    'link' => 'admin.php?mod=index&code=home',
  ),
  2 => 
  array (
    'title' => 'ȫ��',
    'link' => 'admin.php?mod=index&code=home',
    'sub_menu_list' => 
    array (
      0 => 
      array (
        'title' => '<font color="#266AAE">��������</font>',
        'link' => 'admin.php?mod=setting&code=modify_normal',
        'shortcut' => true,
      ),
      1 => 
      array (
        'title' => 'ע���½',
        'link' => 'admin.php?mod=setting&code=modify_register',
        'shortcut' => true,
      ),
	  3 => 
      array (
        'title' => '���ֹ���',
        'link' => 'admin.php?mod=setting&code=modify_credits',
        'shortcut' => false,
      ),    
	  4 => 
      array (
        'title' => '���ֵȼ�',
        'link' => 'admin.php?mod=role&code=list&type=normal',
        'shortcut' => false,
      ),          
      5=> 
      array (
        'title' => '�ֻ�Ӧ��',
        'link' => 'admin.php?mod=setting&code=modify_mobile',
        'shortcut' => false,
      ),
	  6 => 
      array(
        'title' => '�ʼ�����',
        'link' => 'admin.php?mod=setting&code=modify_smtp',
        'shortcut' => false,
      ),
	  7 => 
      array (
        'title' => 'ͼƬ����',
        'link' => 'admin.php?mod=setting&code=modify_image',
        'shortcut' => false,
      ),
	
      9=> 
      array (
        'title' => '�ʻ���',
        'link' => 'admin.php?mod=setting&code=modify_sina',
        'shortcut' => false,
      ),   
	  10 => 
      array (
        'title' => 'ʡ������',
        'link' => 'admin.php?mod=city',
        'shortcut' => false,
      ), 	
	  11=> 
      array (
        'title' => 'α��̬����',
        'link' => 'admin.php?mod=setting&code=modify_rewrite',
        'shortcut' => false,
      ),
	  12=> 
	  array(
    		'title' => '����ˮ��֤��',
	    	'link' => 'admin.php?mod=setting&code=modify_seccode',
    		'shortcut' =>false,
		),
		15 => 
      array (
        'title' => 'ϵͳ����',
        'link' => 'hr',
        'shortcut' => false,
      ),  
	    13 => 
      array (
        'title' => '΢������ģ��',
        'link' => 'admin.php?mod=output&code=output_setting',
        'shortcut' => true,
      ),  
	  14=>  
	  array(
    			'title' => '΢��վ�����',
	    		'link' => 'admin.php?mod=share&code=share_setting',
				'shortcut' => false,
    	),	 
	   16 => 
      array (
        'title' => 'UCenter����',
        'link' => 'admin.php?mod=ucenter&code=ucenter',
        'shortcut' => false,
      ),
	   array (
        'title' => '����ͬ����΢��',
        'link' => 'admin.php?mod=setting&code=bbs_plugin',
        'shortcut' => false,
      ),
	   array (
        'title' => '����Discuz',
        'link' => 'admin.php?mod=dzbbs&code=discuz_setting',
        'shortcut' => false,
      ),
	   array (
        'title' => '����PhpWind',
        'link' => 'admin.php?mod=phpwind&code=phpwind_setting',
        'shortcut' => false,
      ),
	   array (
        'title' => '����DedeCMS',
        'link' => 'admin.php?mod=dedecms&code=dedecms_setting',
        'shortcut' => false,
      ),
	  array (
        'title' => 'Windowns AD��',
        'link' => 'admin.php?mod=ldap&code=ldap_setting',
        'shortcut' => false,
      ),	  
    ),
  ),
  
  3 => 
  array (
    'title' => '����',
    'link' => 'admin.php?mod=index&code=home',
    'sub_menu_list' => 
    array ( 
	
	  0 => 
      array (
        'title' => 'ҳ����ʾ',
        'link' => 'admin.php?mod=show&code=modify',
        'shortcut' => true,
      ),
1 => 
      array (
        'title' => '��������',
        'link' => 'admin.php?mod=navigation',
        'shortcut' => false,
      ),	  
	
	   2 => 
	   array(
                'title'=>'����������',
                'link'=>'admin.php?mod=setting&code=topic_publish',
				'shortcut' => false,
		),
       3 => 
      array (
        'title' => '������Դ',
        'link' => 'admin.php?mod=setting&code=modify_topic_from',
        'shortcut' => false,
      ),
	   4=> 
      array (
        'title' => '�����滻',
        'link' => 'admin.php?mod=setting&code=changeword',
        'shortcut' => false,
      ),
	  5=> 
      array (
        'title' => 'Ƥ�����',
        'link' => 'admin.php?mod=show&code=modify_theme',
        'shortcut' => true,
      ),
      6=> 
      array (
        'title' => 'ģ����',
        'link' => 'admin.php?mod=show&code=modify_template',
        'shortcut' => false,
      ),
	 7 => 
      array (
        'title' => '��վlogo',
        'link' => 'admin.php?mod=show&code=editlogo',
        'shortcut' => false,
      ),
    ),
  ),
  4 => 
  array (
    'title' => '����',
    'link' => '',
    'sub_menu_list' => 
    array (
      0 => 
      array (
        'title' => '΢������',
        'link' => 'admin.php?mod=topic&code=topic_manage',
        'shortcut' => false,
      ),
	 
      1 => 
      array (
        'title' => '<font color="#266AAE">�����΢��</font>',
        'link' => 'admin.php?mod=topic&code=verify',
        'shortcut' => true,
      ),
	   5 => 
      array (
        'title' => '�Ƽ�΢��',
        'link' => 'admin.php?mod=recdtopic',
        'shortcut' => false,
      ),
	     4 => 
      array (
        'title' => '΢���ٱ�',
        'link' => 'admin.php?mod=report',
        'shortcut' => true,
      ),
	  3 => 
      array (
        'title' => '���ݹ���',
        'link' => 'admin.php?mod=setting&code=modify_filter',
        'shortcut' => true,
      ),
      2 => 
      array (
        'title' => '΢������վ',
        'link' => 'admin.php?mod=topic&code=del&del=1',
        'shortcut' => false,
      ),   
    
      6 => 
      array (
        'title' => '�����ר��',
        'link' => 'admin.php?mod=tag',
        'shortcut' => false,
      ),
	  28 => 
      array (
        'title' => '΢�����Թ���',
        'link' => 'admin.php?mod=feature',
        'shortcut' => false,
      ),
      7 => 
      array (
        'title' => '΢�������¼',
        'link' => 'admin.php?mod=topic&code=manage',
        'shortcut' => false,
      ), 
      15 =>
      array (
        'title' => 'URL���ӹ���',
        'link' => 'admin.php?mod=url&code=manage',
        'shortcut' => false,
      ), 
      8 => 
      array (
        'title' => '������Ϣ����',
        'link' => 'hr',
        'shortcut' => false,
      ),
	  13 => 
      array (
        'title' => '˽�Ź���',
        'link' => 'admin.php?mod=pm&code=pm_manage',
        'shortcut' => false,
      ),
      9 => 
      array (
        'title' => 'ǩ������',
        'link' => 'admin.php?mod=topic&code=signature',
        'shortcut' => false,
      ),    
      11 => 
      array (
        'title' => '���ҽ���',
        'link' => 'admin.php?mod=topic&code=aboutme',
        'shortcut' => false,
      ),
      12 => 
      array (
        'title' => '���˱�ǩ',
        'link' => 'admin.php?mod=user_tag',
        'shortcut' => false,
      ),
	    10 => 
      array (
        'title' => 'ͷ��ǩ�����',
        'link' => 'admin.php?mod=verify',
        'shortcut' => false,
      ),
    ),
  ),
  5 => 
  array (
    'title' => '�û�',
    'link' => '',
    'sub_menu_list' => 
    array (
     0 => 
      array (
        'title' => '�û��б�',
        'link' => 'admin.php?mod=member&code=newm',
        'shortcut' => true,
      ),     
	   1 => 
	    array (
			'title' => '�û������',
			'link' => 'admin.php?mod=account&code=index',
			 'shortcut' =>false,	
	   ),      
	  2 => 
	    array (
			'title' => '����֤�û�',
			'link' => 'admin.php?mod=member&code=waitvalidate',
	  		'shortcut'=>false,	
	  ),
      3 => 
      array (
        'title' => '�༭�û�',
        'link' => 'admin.php?mod=member&code=search',
        'shortcut' => true,
      ),
	  4 => 
      array (
        'title' => '������û�',
        'link' => 'admin.php?mod=member&code=add',
        'shortcut' => false,
      ),
	  5 => 
      array (
        'title' => '�޸��ҵ�����',
        'link' => 'admin.php?mod=member&code=modify',
        'shortcut' => false,
      ),
      6 => 
      array(
        'title' => '�����Զ���',
        'link' => 'admin.php?mod=member&code=profile',
        'shortcut' => false,
      	),
	
      7 => 
      array (
        'title' => '<font color="#266AAE">�û�V��֤</font>',
        'link' => 'admin.php?mod=vipintro',
        'shortcut' => true,
      ),
    
	  8 => 
      array (
        'title' => '������',
        'link' => 'admin.php?mod=vipintro&code=people_setting',
        'shortcut' => false,
      ),
      9 => 
      array (
        'title' => '�Ƽ��û�',
        'link' => 'admin.php?mod=media',
        'shortcut' => false,
      ),
	  10 => 
      array(
        'title' => '�û����ʼ�¼',
        'link' => 'admin.php?mod=member&code=login',
        'shortcut' => false,
      ),
      11 => 
      array (
        'title' => '�����û���Excel',
        'link' => 'admin.php?mod=member&code=export_all_user',
        'shortcut' => false,
      ),
     
      12 => 
      array (
        'title' => '��ɫȨ������',
        'link' => 'hr',
        'shortcut' => false,
      ),
      13 => 
      array (
        'title' => '����Ա��ɫ',
        'link' => 'admin.php?mod=role&code=list&type=admin',
        'shortcut' => false,
      ),
      14 => 
      array (
        'title' => '��ͨ�û���ɫ',
        'link' => 'admin.php?mod=role&code=list&type=normal',
        'shortcut' => false,
      ),
      15=> 
      array (
        'title' => '����û���ɫ',
        'link' => 'admin.php?mod=role&code=add',
        'shortcut' => false,
      ),
    ),
  ),
    6 => 
  array (
    'title' => '��Ӫ',
    'link' => '',
    'sub_menu_list' => 
    array (
  	0 => 
      array (
        'title' => '������Ϣ',
        'link' => 'admin.php?mod=notice',
        'shortcut' => false,
      ),
	 1=> 
      array (
        'title' => '������',
        'link' => 'admin.php?mod=income',
        'shortcut' => true,
      ),
	
	   2=> 
      array (
        'title' => '��ҳ�õ�',
        'link' => 'admin.php?mod=setting&code=modify_slide',
        'shortcut' => false,
      ),
	    3 => 
      array (
        'title' => 'ѫ�¹���',
        'link' => 'admin.php?mod=medal',
        'shortcut' => false,
      ),
	   4 => 
	    	array(
			'title' => '����Ⱥ��',
			'link' => 'admin.php?mod=sms&code=list',
			 'shortcut' => false,
		),
	    6=> 
      array (
        'title' => '�ؼ�������',
        'link' => 'admin.php?mod=setting&code=modify_meta',
        'shortcut' => false,
      ),
	   7 => 
      array (
        'title' => '��������',
        'link' => 'admin.php?mod=link',
        'shortcut' => false,
       ),
	    8=> 
      array (
        'title' => '��Ӫ����',
        'link' => 'hr',
        'shortcut' => false,
      ),
	   9 => 
      array (
        'title' => '֩������ͳ��',
        'link' => 'admin.php?mod=robot',
        'shortcut' => false,
      ),
	   10 => 
      array (
        'title' => '�������Ӽ��',
        'link' => 'http://checklink.biniu.com',
        'shortcut' => false,
      ),
	   11 => 
      array (
        'title' => '�������ӷ���',
        'link' => 'http://backlink.biniu.com',
        'shortcut' => false,
      ),
	  12 => 
      array (
        'title' => '��¼��ѯ',
        'link' => 'http://shoulu.biniu.com',
        'shortcut' => false,
      ),
	   13 => 
      array (
        'title' => '�ؼ�������',
        'link' => 'http://keyword.biniu.com',
        'shortcut' => false,
      ),
      14 => 
      array (
        'title' => 'alexa����',
        'link' => 'http://alexa.biniu.com',
        'shortcut' => false,
      ),   
      15 => 
      array (
        'title' => 'ͬIP��վ���',
        'link' => 'http://cnrdn.com/G8f4',
        'shortcut' => false,
      ),  
    ),
  ),
  7 => 
  array (
    'title' => 'Ӧ��',
    'link' => '',
    'sub_menu_list' => 
    array (
	  1=> 
      array (
        'title' => '<font color="#266AAE">Ƶ��</font>',
        'link' => 'admin.php?mod=channel&code=index',
        'shortcut' => true,
      ),
      2 => 
      array (
        'title' => '΢Ⱥ',
        'link' => 'admin.php?mod=qun',
        'shortcut' => false,
      ),
      3 => 
      array (
        'title' => 'ͶƱ',
        'link' => 'admin.php?mod=vote&code=index',
        'shortcut' => false,
      ),     
      4 => 
      array (
        'title' => '�',
        'link' => 'admin.php?mod=event&code=manage',
        'shortcut' => false,
      ),
	  5 => 
      array (
        'title' => 'ǩ��',
        'link' => 'admin.php?mod=sign',
        'shortcut' => false,
      ),
      /*
      9 => array(
        'title' => '���',
        'link' => 'admin.php?mod=block',
        'shortcut' => false,
      ),
      10 => array(
      	'title' => '����',
      	'link' => 'admin.php?mod=fenlei',
      	'shortcut' => false,
      ),*/
     
     
      6 => 
      array (
        'title' => '΢ֱ��',
        'link' => 'admin.php?mod=live&code=index',
        'shortcut' => false,
      ),
      7 => 
      array (
        'title' => '΢��̸',
        'link' => 'admin.php?mod=talk&code=index',
        'shortcut' => false,
      ),
	  8 => array(
      	'title' => '�н�ת��',
      	'link' => 'admin.php?mod=reward',
      	'shortcut' => false,
      ),
	  25 => 
      array (
        'title' => '΢�Ź���ƽ̨',
        'link' => 'admin.php?mod=wechat',
        'shortcut' => false,
        'type' => '1',
      ),
	  27 => 
      array (
        'title' => '�����̳�',
        'link' => 'admin.php?mod=mall&code=goods_list',
        'shortcut' => false,
        'type' => '1',
      ),
	  26 => 
      array (
        'title' => '��Ѷ����',
        'link' => 'admin.php?mod=cms',
        'shortcut' => false,
        'type' => '1',
      ),
	   9 => 
      array(
        'title' => '��׹���',
        'link' => 'admin.php?mod=member&code=vest',
        'shortcut' => true,
      ),
   
	 11 => 
      array (
        'title' => '<font color="#266AAE">��λ�Ͳ���</font>',
        'link' => 'admin.php?mod=company',
        'shortcut' => false,
      ),
      12 => 
      array (
        'title' => 'APIӦ����Ȩ',
        'link' => 'admin.php?mod=api',
        'shortcut' => false,
      ),      
      13 => 
      array (
        'title' => '΢����',
        'link' => 'admin.php?mod=tools&code=weibo_show',
        'shortcut' => false,
      ),
	  19 => 
      array (
        'title' => '��̬����',
        'link' => 'admin.php?mod=feed',
        'shortcut' => false,
      ),   
      20 => 
      array (
        'title' => '���',
        'link' => 'hr',
        'shortcut' => false,
      ),
      21 => 
      array (
        'title' => '�Ѱ�װ���',
        'link' => 'admin.php?mod=plugin',
        'shortcut' => false,
      ),
      22 => 
      array (
        'title' => '��װ�²��',
        'link' => 'admin.php?mod=plugin&code=add',
        'shortcut' => false,
      ),
      23 => 
      array (
        'title' => '������',
        'link' => 'admin.php?mod=plugin&code=design',
        'shortcut' => false,
        'type' => '1',
      ),
	  24 => 
      array (
        'title' => '����в��',
        'link' => 'admin.php?mod=plugin&code=designing',
        'shortcut' => false,
        'type' => '1',
      ),
    ),
  ),
 8 => 
  array (
    'title' => '����',
    'link' => '',
    'sub_menu_list' => 
    array (
	   1 => 
      array (
        'title' => '��ջ���',
        'link' => 'admin.php?mod=cache',
        'shortcut' => false,
      ),
       2 => 
      array (
        'title' => '��������',
        'link' => 'admin.php?mod=upgrade',
        'shortcut' => false,
      ),	
      3 => 
      array (
        'title' => '<font color="#D94446">��̨������¼</font>',
        'link' => 'admin.php?mod=logs',
        'shortcut' => true,
      ),
	   4=> 
      array (
        'title' => '���ݿ����',
        'link' => 'hr',
        'shortcut' => false,
      ),
      5 => 
      array (
        'title' => '���ݱ���',
        'link' => 'admin.php?mod=db&code=export',
        'shortcut' => false,
      ),
      6 => 
      array (
        'title' => '���ݻָ�',
        'link' => 'admin.php?mod=db&code=import',
        'shortcut' => false,
      ),
      7 => 
      array (
        'title' => '���ݱ��Ż�',
        'link' => 'admin.php?mod=db&code=optimize',
        'shortcut' => false,
      ),
    ),
  ),
  9 => 
  array (
    'title' => '����',
    'link' => '',
    'sub_menu_list' => 
    array (
	   1 => 
      array (
        'title' => '��װʹ��',
        'link' => 'http://t.jishigou.net/channel/id-5',
        'shortcut' => false,
      ),
	    2 => 
      array (
        'title' => 'bug����',
        'link' => 'http://t.jishigou.net/channel/id-6',
        'shortcut' => false,
      ),
	    3 => 
      array (
        'title' => '���ģ��',
        'link' => 'http://t.jishigou.net/channel/id-7',
        'shortcut' => false,
      ),
	    4 => 
      array (
        'title' => '��չ����',
        'link' => 'http://t.jishigou.net/channel/id-8',
        'shortcut' => false,
      ),
	    5 => 
      array (
        'title' => '���ο���',
        'link' => 'http://t.jishigou.net/channel/id-9',
        'shortcut' => false,
      ),
	    6 => 
      array (
        'title' => '�������',
        'link' => 'http://t.jishigou.net/channel/id-18',
        'shortcut' => false,
      ),
	    7 => 
      array (
        'title' => 'android�ͻ���',
        'link' => 'http://t.jishigou.net/channel/id-22',
        'shortcut' => false,
      ),
	   8 => 
      array (
        'title' => 'iphone�ͻ���',
        'link' => 'http://t.jishigou.net/channel/id-23',
        'shortcut' => false,
      ),
      9 => 
      array (
        'title' => '��ҵ��Ȩ',
        'link' => 'http://cnrdn.com/15f4',
        'shortcut' => false,
      ),
       10 => 
      array (
        'title' => '���°�΢������',
        'link' => 'http://cnrdn.com/35f4',
        'shortcut' => false,
      ),
    ),
  ),
); ?>