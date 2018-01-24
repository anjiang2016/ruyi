<?php if(!defined('IN_JISHIGOU')) { exit('invalid request'); } 
$cache = array (
  'key' => 'table/role',
  'dateline' => 1490947396,
  'val' => 
  array (
    'life' => 2592000,
    'data' => 
    array (
      'pri' => 'id',
      'field' => 
      array (
        'id' => 
        array (
          'Type' => 'smallint(4) unsigned',
          'Key' => 'PRI',
          'Extra' => 'auto_increment',
        ),
        'name' => 
        array (
          'Type' => 'varchar(50)',
        ),
        'creditshigher' => 
        array (
          'Type' => 'int(10)',
        ),
        'creditslower' => 
        array (
          'Type' => 'int(10)',
        ),
        'privilege' => 
        array (
          'Type' => 'mediumtext',
        ),
        'type' => 
        array (
          'Type' => 'enum(\'normal\',\'admin\')',
          'Default' => 'normal',
        ),
        'rank' => 
        array (
          'Type' => 'tinyint(1) unsigned',
        ),
        'icon' => 
        array (
          'Type' => 'char(100)',
        ),
        'allow_sendpm_to' => 
        array (
          'Type' => 'text',
        ),
        'allow_sendpm_from' => 
        array (
          'Type' => 'text',
        ),
        'allow_topic_forward_to' => 
        array (
          'Type' => 'text',
        ),
        'allow_topic_forward_from' => 
        array (
          'Type' => 'text',
        ),
        'allow_topic_reply_to' => 
        array (
          'Type' => 'text',
        ),
        'allow_topic_reply_from' => 
        array (
          'Type' => 'text',
        ),
        'allow_topic_at_to' => 
        array (
          'Type' => 'text',
        ),
        'allow_topic_at_from' => 
        array (
          'Type' => 'text',
        ),
        'allow_follow_to' => 
        array (
          'Type' => 'text',
        ),
        'allow_follow_from' => 
        array (
          'Type' => 'text',
        ),
        'system' => 
        array (
          'Type' => 'tinyint(1)',
          'Default' => '1',
        ),
      ),
    ),
  ),
);
?>