<?php
/**
 * ��̨����ҳ���Ӳ˵�
 *
 * ֱ���ڴ˹������ӾͿ��ԣ��������ڳ����������� By foxis 2012.03.06
 *
 * @version $Id: admin_page_menu.php 5466 2014-01-18 02:44:57Z chenxianfeng $
 */

$menu_list = array(
	'qun' => array(
		array(
			'name' => '��������',
			'link' => 'admin.php?mod=qun&code=setting',
		),
		array(
			'name' => '΢Ⱥ����',
			'link' => 'admin.php?mod=qun&code=category',
		),
		/*
		array(
			'name' => '΢Ⱥ�ȼ�',
			'link' => 'admin.php?mod=qun&code=level',
		),*/
		array(
			'name' => '΢Ⱥ����',
			'link' => 'admin.php?mod=qun&code=ploy',
		),
		array(
			'name' => '΢Ⱥ����',
			'link' => 'admin.php?mod=qun&code=manage',
		),
		array(
			'name' => '����΢Ⱥ',
			'link' => 'admin.php?mod=qun&code=add',
		),
		array(
			'name' => '���Ⱥģ��',
			'link' => 'admin.php?mod=qun&code=module',
		),
	),

	'sms' => array(
		array(
    			'name' => '�ֻ�Ӧ������',
	    		'link' => 'admin.php?mod=setting&code=modify_mobile',
    		),
    	/*
		array(
			'name' => '�ֻ���������',
			'link' => 'admin.php?mod=sms&code=setting',
		),
		array(
			'name' => '����Ⱥ��',
			'link' => 'admin.php?mod=sms&code=list',
		),
		array(
			'name' => '���ͼ�¼�б�',
			'link' => 'admin.php?mod=sms&code=send_log',
		),
		array(
			'name' => '���ռ�¼�б�',
			'link' => 'admin.php?mod=sms&code=receive_log',
		),
		*/
	),

	'tag' => array(
		array(
			'name' => '�������',
			'link' => 'admin.php?mod=tag&code=list',
		),
		array(
			'name' => '�����Ƽ�',
			'link' => 'admin.php?mod=tag&code=recommend',
		),
		array(
			'name' => '����ר��',
			'link' => 'admin.php?mod=tag&code=extra',
		),
	),

	'plugin' => array(
		array(
			'name' => '�Ѱ�װ���',
			'link' => 'admin.php?mod=plugin',
		),
		array(
			'name' => '��װ�²��',
			'link' => 'admin.php?mod=plugin&code=add',
		),
		array(
			'name' => '������',
			'link' => 'admin.php?mod=plugin&code=design',
			'type' => '1',
		),
		array(
			'name' => '����в��',
			'link' => 'admin.php?mod=plugin&code=designing',
			'type' => '1',
		),
	),

	'plugindesign' => array(
		array(
			'name' => '����б�',
			'link' => 'admin.php?mod=plugin',
		),
		array(
			'name' => '����',
			'link' => 'admin.php?mod=plugindesign&code=design',
		),
		array(
			'name' => 'ģ��',
			'link' => 'admin.php?mod=plugindesign&code=modules',
		),
		array(
			'name' => '����',
			'link' => 'admin.php?mod=plugindesign&code=vars',
		),
		array(
			'name' => '����',
			'link' => 'admin.php?mod=plugindesign&code=export',
		),
	),

	'vote' => array(
		array(
			'name' => 'ͶƱ����',
			'link' => 'admin.php?mod=vote&code=setting',
		),
		array(
			'name' => 'ͶƱ����',
			'link' => 'admin.php?mod=vote&code=index',
		),
		array(
			'name' => 'ͶƱ���',
			'link' => 'admin.php?mod=vote&code=verify',
		),
	),
	'event' => array(
		array(
			'name' => '�����',
			'link' => 'admin.php?mod=event&code=setting',
		),
		array(
			'name' => '�����',
			'link' => 'admin.php?mod=event&code=index',
		),
		array(
			'name' => '��ѡ������',
			'link' => 'admin.php?mod=event&code=profile',
		),
		array(
			'name' => '�����',
			'link' => 'admin.php?mod=event&code=manage',
		),
		array(
			'name' => '����',
			'link' => 'admin.php?mod=event&code=verify',
		),
	),

	'live' => array(
		array(
			'name' => 'ֱ������',
			'link' => 'admin.php?mod=live&code=config',
		),
		array(
			'name' => '���ֱ��',
			'link' => 'admin.php?mod=live&code=add',
		),
		array(
			'name' => 'ֱ������',
			'link' => 'admin.php?mod=live&code=index',
		),
	),

	'talk' => array(
		array(
			'name' => '��̸����',
			'link' => 'admin.php?mod=talk&code=config',
		),
		array(
			'name' => '��̸����',
			'link' => 'admin.php?mod=talk&code=category',
		),
		array(
			'name' => '��ӷ�̸',
			'link' => 'admin.php?mod=talk&code=add',
		),
		array(
			'name' => '��̸����',
			'link' => 'admin.php?mod=talk&code=index',
		),
	),

	//* //����ʱ�ر�
	'account' => array(
		array(
			'name' => '�û������',
			'link' => 'admin.php?mod=account&code=index',
		),
		array(
			'name' => 'YY�ʻ�����',
			'link' => 'admin.php?mod=account&code=yy',
		),
		array(
			'name' => '�����ʻ�����',
			'link' => 'admin.php?mod=account&code=renren',
		),
		array(
			'name' => '�����ʻ�����',
			'link' => 'admin.php?mod=account&code=kaixin',
		),
		/*
		array(
			'name' => 'FJAU����',
			'link' => 'admin.php?mod=account&code=fjau',
		),
		*/
		array(
			'name' => '����΢����',
			'link' => 'admin.php?mod=setting&code=modify_sina',
		),
		array(
			'name' => '��Ѷ΢����',
			'link' => 'admin.php?mod=setting&code=modify_qqwb',
		),
		/*
		array(
			'name' => 'QQ�����˰�',
			'link' => 'admin.php?mod=imjiqiren&code=imjiqiren_setting',
		),
		*/
	),


	//�Ӳ˵� ע��ͷ���
	'_setting_access' => array(
    		array(
    			'name' => '�û�ע�����',
	    		'link' => 'admin.php?mod=setting&code=modify_register',
    		),
			array(
    			'name' => 'ע����������',
	    		'link' => '	admin.php?mod=setting&code=modify_register_guide',
    		),
    		array(
    			'name' => 'ȫ��IP���ʿ���',
	    		'link' => 'admin.php?mod=setting&code=modify_access',
    		),
    		array(
    			'name' => '�û�IP��¼����',
	    		'link' => 'admin.php?mod=failedlogins&code=index',
    		),
   			array(
    			'name' => '�Զ���ע�Ƽ�',
	    		'link' => 'admin.php?mod=setting&code=regfollow',
    		),
    		array(
    			'name' => 'Ĭ�Ϲ�ע����',
	    		'link' => 'admin.php?mod=setting&code=follow',
    		),
    		array(
    			'name' => '����ע�����',
	    		'link' => 'admin.php?mod=setting&code=invite',
    		),

    	),
	'sign' => array(
		array(
			'name' => 'ǩ������',
			'link' => 'admin.php?mod=sign&code=index',
		),
		array(
			'name' => 'ǩ����������',
			'link' => 'admin.php?mod=sign&code=sign_list',
		),
	),

    //�Ӳ˵� �������
	'_setting_credit' => array(
    		array(
    			'name' => '������Ŀ����',
	    		'link' => 'admin.php?mod=setting&code=modify_credits',
    		),
    		array(
    			'name' => '���ֹ�������',
	    		'link' => 'admin.php?mod=setting&code=list_credits_rule',
    		),
			/*
			array(
    			'name' => '����Ա�ȼ�����',
	    		'link' => 'admin.php?mod=role&code=list&type=admin',
    		),
    		array(
    			'name' => '���ֵȼ�����',
	    		'link' => 'admin.php?mod=role&code=list&type=normal',
    		),

			*/
    		array(
    			'name' => '�鿴��������',
	    		'link' => 'admin.php?mod=sign&code=credits_top',
    		),
    	),
    //�Ӳ˵� SEO���
	'_setting_seo' => array(
    		array(
    			'name' => 'URLα��̬',
	    		'link' => 'admin.php?mod=setting&code=modify_rewrite',
    		),
    		array(
    			'name' => '�ؼ�������',
	    		'link' => 'admin.php?mod=setting&code=modify_meta',
    		),
    	),
    //�Ӳ˵� ��վ����
	'_setting_normal' => array(
    		array(
    			'name' => '��������',
	    		'link' => 'admin.php?mod=setting&code=modify_normal',
    		),
			array(
    			'name' => 'վ��״̬',
	    		'link' => 'admin.php?mod=setting&code=visit_state',
    		),
			array(
    			'name' => '��˿���',
	    		'link' => 'admin.php?mod=setting&code=check_switch',
    		),
			array (
        		'name' => 'ϵͳ����',
        		'link' => 'admin.php?mod=setting&code=modify_sysload',
             ),

    	),

		//�Ӳ˵� ��������
   		 '_setting_content' => array(
			array(
    			'name' => '��ҳ����',
	    		'link' => 'admin.php?mod=notice',
    		),
    		array(
    			'name' => '��������',
	    		'link' => 'admin.php?mod=web_info',
    		),
    	),

		//�Ӳ˵� �ʼ���������
		'_setting_email' => array(
		array(
    			'name' => '�ʼ���������',
	    		'link' => 'admin.php?mod=setting&code=modify_smtp',
    		),
		array(
      		  'name' => '�ʼ�����',
      		  'link' => 'admin.php?mod=notice&code=mailq',
  		    ),
		),


		//�Ӳ˵� �����ĵ�
	   '_setting_attachment' => array(
	       	array(
    			'name' => 'ͼƬ�ϴ�',
	    		'link' => 'admin.php?mod=setting&code=modify_image',
    		),

    		array(
    			'name' => 'ͼƬǩ����',
	    		'link' => 'admin.php?mod=setting&code=modify_qmd',
    		),

	    array (
      		  'name' => '�����ĵ�',
        	  'link' => 'admin.php?mod=attach',
            ),
		array(
    			'name' => 'Զ�̸���',
	    		'link' => 'admin.php?mod=setting&code=modify_ftp',
    		),
		),
		/*
    //�Ӳ˵� վ�㹦��
    '_setting_function' => array(
    		array(
    			'name' => 'UCenter����',
	    		'link' => 'admin.php?mod=ucenter&code=ucenter',
    		),
			array(
				'name' => '����Discuz!��̳',
				'link' => 'admin.php?mod=dzbbs&code=discuz_setting',
				),
			array(
    			'name' => '��̳����ͬ����΢��',
	    		'link' => 'admin.php?mod=setting&code=bbs_plugin',
    		),
			array(
				'name' => '����DedeCMS����',
				'link' => 'admin.php?mod=dedecms&code=dedecms_setting',
				),
			array(
				'name' => '���ϵ���PhpWind',
				'link' => 'admin.php?mod=phpwind&code=phpwind_setting',
				),
    	),
		*/
	//�Ӳ˵� ��ҳ�õ�
	'_setting_slide' => array(
    		array(
    			'name' => '�ҵ���ҳ�õ�',
	    		'link' => 'admin.php?mod=setting&code=modify_slide',
    		),
    		array(
    			'name' => '��վ��ҳ�õ�',
	    		'link' => 'admin.php?mod=setting&code=modify_slide_index',
    		),
		),
	//�Ӳ˵� ������
	'_setting_ad' => array(
    		array(
    			'name' => '���λ',
	    		'link' => 'admin.php?mod=income',
    		),
    		array(
    			'name' => '���й��',
	    		'link' => 'admin.php?mod=income&code=ad_list',
    		),
		),

    //�Ӳ˵� ˽�Ź���
    '_manage_pm' => array(
    		array(
    			'name' => '˽�Ź���',
	    		'link' => 'admin.php?mod=pm&code=pm_manage',
    		),
    		array(
    			'name' => '˽��Ⱥ��',
	    		'link' => 'admin.php?mod=pm&code=pmsend',
    		),
    		array(
    			'name' => '������Ա����',
	    		'link' => 'admin.php?mod=pm&code=to_admin',
    		),
    	),
		/*
    //�Ӳ˵� ������Ϣ����
    '_manage_userinfo' => array(
    		array(
    			'name' => 'ǩ������',
	    		'link' => 'admin.php?mod=topic&code=signature',
    		),
    		array(
    			'name' => 'ͷ��ǩ�����',
	    		'link' => 'admin.php?mod=verify&code=fs_verify',
    		),
			array(
    			'name' => '���ҽ��ܹ���',
	    		'link' => 'admin.php?mod=topic&code=aboutme',
    		),
    		array(
    			'name' => '���˱�ǩ����',
	    		'link' => 'admin.php?mod=user_tag&code=user_tag_manage',
    		),
      	),
		*/
		/*
    //�Ӳ˵� ���ݹ���
    '_manage_content' => array(
    		array(
    			'name' => '΢������',
	    		'link' => 'admin.php?mod=topic&code=topic_manage',
    		),
    		array(
    			'name' => '�����΢��',
	    		'link' => 'admin.php?mod=topic&code=verify',
    		),
			array(
    			'name' => '�ٷ��Ƽ�΢��',
	    		'link' => 'admin.php?mod=recdtopic&code=recdtopic_manage',
    		),
			array(
    			'name' => '΢���ٱ�����',
	    		'link' => 'admin.php?mod=report&code=report_manage',
    		),
    		array(
    			'name' => '���ݹ�������',
	    		'link' => 'admin.php?mod=setting&code=modify_filter',
    		),
    		array(
    			'name' => '΢������վ',
	    		'link' => 'admin.php?mod=topic&code=del&del=1',
    		),
      	),
		*/
		/*
    //�Ӳ˵� ϵͳ����
	  '_tool_system' => array(
    		array(
    			'name' => '���ϵͳ����',
	    		'link' => 'admin.php?mod=cache',
    		),
    		array(
    			'name' => 'ϵͳ��������',
	    		'link' => 'admin.php?mod=upgrade',
    		),
    		 array (
        		'name' => '��̨������¼',
        		'link' => 'admin.php?mod=logs',
        	),
    	),
		*/
		/*
    '_tool_seotools' => array(
		array(
    			'name' => '֩������ͳ��',
	    		'link' => 'admin.php?mod=robot',
    		),
		 array (
        		'name' => '�������Ӽ��',
        		'link' => 'http://checklink.biniu.com',
           	),
		 array (
        		'name' => '�������ӷ���',
        		'link' => 'http://backlink.biniu.com',
        	),
		 array (
       			 'name' => '��¼��ѯ',
        		 'link' => 'http://shoulu.biniu.com',
            ),
		 array (
        		'name' => '�ؼ�������',
        		'link' => 'http://keyword.biniu.com',
              ),
		 array (
        		'name' => 'alxea����',
        		'link' => 'http://keyword.biniu.com',
              ),
    	 array(
    			'name' => 'ͬIp��վ���',
	    		'link' => 'http://cnrdn.com/G8f4',
    		),

    	),
		*/
    //�Ӳ˵� �û�����
	/*
    '_manage_member' => array(
    		array(
    			'name' => '�༭�û�',
	    		'link' => 'admin.php?mod=member&code=search',
    		),
			  array (
				'name' => '������û�',
				'link' => 'admin.php?mod=member&code=add',
			  ),
			  array (
				'name' => '�޸��ҵ�����',
				'link' => 'admin.php?mod=member&code=modify',
			  ),
    	),
		*/
    //�Ӳ˵� �û�����
    '_member_list' => array(
    		array(
    			'name' => '�û��б�',
	    		'link' => 'admin.php?mod=member&code=newm',
    		),
			  array (
				'name' => '��ɱ�û��б�',
				'link' => 'admin.php?mod=member&code=force_out',
			  ),
			  array (
				'name' => '�ϱ��쵼�б�',
				'link' => 'admin.php?mod=member&code=leaderlist',
			  ),
    	),
	  //�Ӳ˵� �û����ʼ�¼
    '_member_loginsessions' => array(
			  array(
				'name' => '�û����ʼ�¼',
				'link' => 'admin.php?mod=member&code=login',
			  ),
			    array (
				'name' => '��ǰ�����û�',
				'link' => 'admin.php?mod=sessions',
			  ),
			    array (
				'name' => '�û���¼��־',
				'link' => 'admin.php?mod=member&code=user_login_log',
			  ),
    	),
    //�Ӳ˵� V��֤
    '_validate' => array(
    		array(
    			'name' => '�û�V��֤',
	    		'link' => 'admin.php?mod=vipintro',
    		),
    		array(
    			'name' => 'V��֤����',
	    		'link' => 'admin.php?mod=vipintro&code=setting',
    		),
    		array(
    			'name' => 'V��֤����',
	    		'link' => 'admin.php?mod=vipintro&code=validate_setting',
    		),
    		array(
    			'name' => 'V��֤���',
	    		'link' => 'admin.php?mod=vipintro&code=categorylist',
    		),
    		array(
    			'name' => '�ֶ������֤',
	    		'link' => 'admin.php?mod=vipintro&code=addvip',
    		),
			/*
			array(
    			'name' => '������',
	    		'link' => 'admin.php?mod=vipintro&code=people_setting',
    		),
			 array (
        		'name' => '�Ƽ��û�',
        		'link' => 'admin.php?mod=media',
       		),
			*/
    	),
		//�Ӳ˵� ��������
		 '_setting_navigation' => array(
    		array(
    			'name' => '��������ർ���˵�',
	    		'link' => 'admin.php?mod=navigation',
    		),
			/*
			array(
    			'name' => '��ർ���˵�',
	    		'link' => 'admin.php?mod=navigation&code=left_navigation',
    		),
			*/
			array(
    			'name' => '�ײ������˵�',
	    		'link' => 'admin.php?mod=navigation&code=footer_navigation',
    		),
		),

    //�Ӳ˵� ��ʾ����
    '_setting_show' => array(
    		array(
    			'name' => 'ҳ����ʾ����',
	    		'link' => 'admin.php?mod=show&code=modify',
    		),
			/*
			 array(
                'name'=>'����������',
                'link'=>'admin.php?mod=setting&code=topic_publish',
            ),
			array(
    			'name' => '������Դ����',
	    		'link' => 'admin.php?mod=setting&code=modify_topic_from',
    		),
			 array(
                'name' => 'ǰ̨�����滻',
                'link'=>'admin.php?mod=setting&code=changeword',
            ),
    	*/
    	),
		/*
		 //�Ӳ˵� ��վlogo����������
    '_setting_logolink' => array(
       		array(
    			'name' => '��վlogo',
	    		'link' => 'admin.php?mod=show&code=editlogo',
    		),
			array(
    			'name' => '��������',
	    		'link' => 'admin.php?mod=link',
    		),
    	),
		*/
		//�Ӳ˵� Ƥ�����ģ��������
	  '_setting_theme' => array(
    		array(
    			'name' => 'Ƥ���������',
	    		'link' => 'admin.php?mod=show&code=modify_theme',
    		),
    		array(
    			'name' => 'ģ��������',
	    		'link' => 'admin.php?mod=show&code=modify_template',
    		),
    	),
    //�Ӳ˵� վ�����
    '_setting_share' => array(
    		array(
    			'name' => '΢��վ��չʾ����',
	    		'link' => 'admin.php?mod=share&code=share_setting',
    		),
    		array(
    			'name' => '΢������ģ��',
	    		'link' => 'admin.php?mod=output&code=output_setting',
    		),
    ),
	//�Ӳ˵� ��λ����
    '_company' => array(
    		array(
    			'name' => '����˵��',
	    		'link' => 'admin.php?mod=setting&code=cp_ad',
    		),
			array(
    			'name' => '��λ����',
	    		'link' => 'admin.php?mod=company',
    		),
    		array(
    			'name' => '���Ź���',
	    		'link' => 'admin.php?mod=department',
    		),
			array(
    			'name' => '��λ����',
	    		'link' => 'admin.php?mod=job',
    		),
    ),
	//���
    'vest' => array(
    	array(
    		'name' => '�������',
	    	'link' => 'admin.php?mod=member&code=config',
    	),
		array(
    		'name' => '��׹���',
	    	'link' => 'admin.php?mod=member&code=vest',
    	),
    ),
	//Ƶ��
    'channel' => array(
    	array(
    		'name' => 'Ƶ������',
	    	'link' => 'admin.php?mod=channel&code=config',
    	),
		array(
    		'name' => 'Ƶ������',
	    	'link' => 'admin.php?mod=channel&code=channeltype',
    	),
		array(
    		'name' => 'Ƶ������',
	    	'link' => 'admin.php?mod=channel&code=index',
    	),
    ),
    //url
    'url' => array(
    	array(
    		'name' => '˵��',
    		'link' => 'admin.php?mod=url&code=index',
    	),
    	array(
    		'name' => '�������',
    		'link' => 'admin.php?mod=url&code=setting',
    	),
    	array(
    		'name' => 'URL���ӵ�ַ����',
    		'link' => 'admin.php?mod=url&code=manage',
    	),
    ),
    //tools
    'tools' => array(
    	array(
    		'name' => '˵��',
    		'link' => 'admin.php?mod=tools&code=index',
    	),
    	array(
    		'name' => '����΢������',
    		'link' => 'admin.php?mod=tools&code=share_to_weibo',
    	),
    	array(
    		'name' => '΢��������',
    		'link' => 'admin.php?mod=tools&code=weibo_show',
    	),
    ),
    //mall
    'mall' => array(
    	array(
    		'name' => '˵��',
    		'link' => 'admin.php?mod=mall&code=index',
    	),
    	array(
    		'name' => '����',
    		'link' => 'admin.php?mod=mall&code=setting',
    	),
		array(
    		'name' => '�����Ʒ',
    		'link' => 'admin.php?mod=mall&code=add_goods',
    	),
    	array(
    		'name' => '��Ʒ����',
    		'link' => 'admin.php?mod=mall&code=goods_list',
    	),
    	array(
    		'name' => '��������',
    		'link' => 'admin.php?mod=mall&code=order_list',
    	),
    ),
    //wechat
    'wechat' => array(
    	array(
    		'name' => '����',
    		'link' => 'admin.php?mod=wechat',
    	),
    	array(
    		'name' => '�����',
    		'link' => 'admin.php?mod=wechat&code=do_list',
    	),
    ),

	'feed' => array(
		array(
    		'name' => '��̬��¼',
    		'link' => 'admin.php?mod=feed',
    	),
    	array(
    		'name' => 'ϵͳ����',
    		'link' => 'admin.php?mod=feed&code=setting',
    	),
		array(
    		'name' => '��Ҫ����',
    		'link' => 'admin.php?mod=feed&code=leader',
    	),
    ),

);
?>