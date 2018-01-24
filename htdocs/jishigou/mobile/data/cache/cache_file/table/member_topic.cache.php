<?php if(!defined('IN_JISHIGOU')) { exit('invalid request'); } 
$cache = array (
  'key' => 'table/member_topic',
  'dateline' => 1490947469,
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
        'tid' => 
        array (
          'Type' => 'int(11) unsigned',
          'Key' => 'PRI',
        ),
        'type' => 
        array (
          'Type' => 'enum(\'first\',\'reply\',\'forward\',\'both\')',
          'Default' => 'first',
        ),
        'totid' => 
        array (
          'Type' => 'int(11) unsigned',
        ),
        'touid' => 
        array (
          'Type' => 'mediumint(8) unsigned',
        ),
        'dateline' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
        'replys' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
        'forwards' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
        'lastupdate' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
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