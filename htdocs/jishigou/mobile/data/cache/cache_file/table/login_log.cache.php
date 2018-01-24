<?php if(!defined('IN_JISHIGOU')) { exit('invalid request'); } 
$cache = array (
  'key' => 'table/login_log',
  'dateline' => 1490947458,
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
          'Type' => 'int(10) unsigned',
          'Key' => 'PRI',
          'Extra' => 'auto_increment',
        ),
        'uid' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
        'user_nickname' => 
        array (
          'Type' => 'char(100)',
        ),
        'ip' => 
        array (
          'Type' => 'char(15)',
          'Key' => 'MUL',
        ),
        'ip_port' => 
        array (
          'Type' => 'char(6)',
          'Null' => 1,
        ),
        'dateline' => 
        array (
          'Type' => 'int(11)',
        ),
        'time' => 
        array (
          'Type' => 'char(30)',
          'Key' => 'MUL',
        ),
        'type' => 
        array (
          'Type' => 'char(100)',
        ),
      ),
    ),
  ),
);
?>