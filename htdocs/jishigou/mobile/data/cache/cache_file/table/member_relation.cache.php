<?php if(!defined('IN_JISHIGOU')) { exit('invalid request'); } 
$cache = array (
  'key' => 'table/member_relation',
  'dateline' => 1490948045,
  'val' => 
  array (
    'life' => 2592000,
    'data' => 
    array (
      'pri' => 'touid',
      'field' => 
      array (
        'touid' => 
        array (
          'Type' => 'mediumint(8) unsigned',
          'Key' => 'PRI',
        ),
        'totid' => 
        array (
          'Type' => 'int(11) unsigned',
        ),
        'tid' => 
        array (
          'Type' => 'int(11) unsigned',
          'Key' => 'PRI',
        ),
        'uid' => 
        array (
          'Type' => 'mediumint(8) unsigned',
        ),
        'dateline' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
        'type' => 
        array (
          'Type' => 'enum(\'reply\',\'forward\',\'both\')',
          'Default' => 'reply',
        ),
      ),
    ),
  ),
);
?>