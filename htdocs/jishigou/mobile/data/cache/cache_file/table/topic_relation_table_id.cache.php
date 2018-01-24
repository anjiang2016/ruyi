<?php if(!defined('IN_JISHIGOU')) { exit('invalid request'); } 
$cache = array (
  'key' => 'table/topic_relation_table_id',
  'dateline' => 1490948045,
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
        'tid' => 
        array (
          'Type' => 'bigint(20) unsigned',
          'Key' => 'MUL',
        ),
        'dateline' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
      ),
    ),
  ),
);
?>