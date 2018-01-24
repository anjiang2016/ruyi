<?php if(!defined('IN_JISHIGOU')) { exit('invalid request'); } 
$cache = array (
  'key' => 'table/buddy_follow_group',
  'dateline' => 1490947419,
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
          'Type' => 'mediumint(8) unsigned',
          'Key' => 'MUL',
        ),
        'name' => 
        array (
          'Type' => 'char(100)',
        ),
        'remark' => 
        array (
          'Type' => 'char(255)',
        ),
        'dateline' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'count' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'order' => 
        array (
          'Type' => 'int(10)',
          'Default' => '99',
        ),
        'mode' => 
        array (
          'Type' => 'enum(\'private\',\'friend\',\'public\')',
          'Default' => 'private',
        ),
      ),
    ),
  ),
);
?>