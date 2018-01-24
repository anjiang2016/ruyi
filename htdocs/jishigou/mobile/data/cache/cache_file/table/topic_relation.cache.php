<?php if(!defined('IN_JISHIGOU')) { exit('invalid request'); } 
$cache = array (
  'key' => 'table/topic_relation',
  'dateline' => 1490948045,
  'val' => 
  array (
    'life' => 2592000,
    'data' => 
    array (
      'pri' => 'totid',
      'field' => 
      array (
        'totid' => 
        array (
          'Type' => 'int(11) unsigned',
          'Key' => 'PRI',
        ),
        'touid' => 
        array (
          'Type' => 'mediumint(8) unsigned',
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
        'digcounts' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
        'lastdigtime' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
      ),
    ),
  ),
);
?>