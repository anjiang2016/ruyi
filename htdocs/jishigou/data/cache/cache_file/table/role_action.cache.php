<?php if(!defined('IN_JISHIGOU')) { exit('invalid request'); } 
$cache = array (
  'key' => 'table/role_action',
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
          'Type' => 'varchar(255)',
        ),
        'module' => 
        array (
          'Type' => 'varchar(50)',
          'Key' => 'MUL',
          'Default' => 'index',
        ),
        'action' => 
        array (
          'Type' => 'varchar(255)',
        ),
        'describe' => 
        array (
          'Type' => 'varchar(255)',
        ),
        'message' => 
        array (
          'Type' => 'varchar(255)',
        ),
        'allow_all' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'credit_require' => 
        array (
          'Type' => 'varchar(255)',
        ),
        'credit_update' => 
        array (
          'Type' => 'varchar(255)',
        ),
        'log' => 
        array (
          'Type' => 'tinyint(1) unsigned',
        ),
        'is_admin' => 
        array (
          'Type' => 'tinyint(1) unsigned',
          'Null' => 1,
        ),
      ),
    ),
  ),
);
?>