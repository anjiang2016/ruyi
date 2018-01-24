<?php if(!defined('IN_JISHIGOU')) { exit('invalid request'); } 
$cache = array (
  'key' => 'table/buddy_follow',
  'dateline' => 1490947419,
  'val' => 
  array (
    'life' => 2592000,
    'data' => 
    array (
      'pri' => 'uid',
      'field' => 
      array (
        'uid' => 
        array (
          'Type' => 'mediumint(8) unsigned',
          'Key' => 'PRI',
        ),
        'touid' => 
        array (
          'Type' => 'mediumint(8) unsigned',
          'Key' => 'PRI',
        ),
        'dateline' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
        'relation' => 
        array (
          'Type' => 'enum(\'1\',\'3\')',
          'Default' => '1',
        ),
        'remark' => 
        array (
          'Type' => 'char(255)',
        ),
        'gids' => 
        array (
          'Type' => 'char(255)',
        ),
      ),
    ),
  ),
);
?>