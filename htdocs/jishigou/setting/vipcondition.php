<?php 
 /* save by 1 127.0.0.1 2013-02-25 15:22:38 */
				
 $config['vipcondition'] = array (
  'email' => 
  array (
    'key' => 'email',
    'forward' => 'index.php?mod=settings&code=email_check',
    'enable' => 1,
    'message' => '��վ��ͨ��Email��֤��������V��֤��',
  ),
  'topic_num' => 
  array (
    'key' => 'topic_num',
    'forward' => 'index.php?mod=topic',
    'enable' => 100,
    'message' => '��վ�跢100�����ݲ�������V��֤��',
  ),
  'face' => 
  array (
    'key' => 'face',
    'forward' => 'index.php?mod=settings&code=face',
    'enable' => 1,
    'message' => '��վ���ϴ�ͷ���������V��֤��',
  ),
  'fans_num' => 
  array (
    'key' => 'fans_num',
    'forward' => 'index.php?mod=profile&code=invite',
    'enable' => 10,
    'message' => '��վ��10λ��˿��������V��֤��',
  ),
  'city' => 
  array (
    'key' => 'city',
    'forward' => 'index.php?mod=settings',
    'enable' => 1,
    'message' => '��վ���������������������V��֤��',
  ),
); 
?>