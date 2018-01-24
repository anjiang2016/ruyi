<?php if(!defined('IN_JISHIGOU')) { exit('invalid request'); } 
$cache = array (
  'key' => 'table/topic',
  'dateline' => 1490947419,
  'val' => 
  array (
    'life' => 2592000,
    'data' => 
    array (
      'pri' => 'tid',
      'field' => 
      array (
        'tid' => 
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
        'username' => 
        array (
          'Type' => 'char(15)',
        ),
        'content' => 
        array (
          'Type' => 'char(255)',
        ),
        'content2' => 
        array (
          'Type' => 'char(255)',
        ),
        'imageid' => 
        array (
          'Type' => 'char(100)',
        ),
        'videoid' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'musicid' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'longtextid' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'attachid' => 
        array (
          'Type' => 'char(100)',
        ),
        'roottid' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'replys' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'forwards' => 
        array (
          'Type' => 'smallint(6)',
        ),
        'totid' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'touid' => 
        array (
          'Type' => 'mediumint(8) unsigned',
        ),
        'tousername' => 
        array (
          'Type' => 'char(15)',
        ),
        'dateline' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
        'lastupdate' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'from' => 
        array (
          'Type' => 'enum(\'web\',\'wap\',\'mobile\',\'qq\',\'msn\',\'api\',\'sina\',\'qqwb\',\'vote\',\'qun\',\'event\',\'android\',\'iphone\',\'ipad\',\'sms\',\'androidpad\',\'fenlei\',\'wechat\',\'reward\')',
          'Default' => 'web',
        ),
        'type' => 
        array (
          'Type' => 'char(15)',
        ),
        'item_id' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
        'item' => 
        array (
          'Type' => 'char(15)',
        ),
        'postip' => 
        array (
          'Type' => 'char(15)',
        ),
        'post_ip_port' => 
        array (
          'Type' => 'char(6)',
        ),
        'managetype' => 
        array (
          'Type' => 'tinyint(1)',
          'Key' => 'MUL',
        ),
        'digcounts' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'lastdigtime' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
        'lastdiguid' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'lastdigusername' => 
        array (
          'Type' => 'char(15)',
        ),
        'tag_count' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'tag' => 
        array (
          'Type' => 'char(255)',
        ),
        'recommend' => 
        array (
          'Type' => 'tinyint(1) unsigned',
        ),
        'featureid' => 
        array (
          'Type' => 'smallint(4)',
        ),
        'relateid' => 
        array (
          'Type' => 'int(10)',
        ),
        'anonymous' => 
        array (
          'Type' => 'tinyint(1) unsigned',
        ),
      ),
    ),
  ),
);
?>