<?php if(!defined('IN_JISHIGOU')) { exit('invalid request'); } 
$cache = array (
  'key' => 'table/members',
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
          'Extra' => 'auto_increment',
        ),
        'username' => 
        array (
          'Type' => 'char(15)',
          'Key' => 'MUL',
        ),
        'nickname' => 
        array (
          'Type' => 'char(50)',
          'Key' => 'MUL',
        ),
        'password' => 
        array (
          'Type' => 'char(32)',
        ),
        'medal_id' => 
        array (
          'Type' => 'char(20)',
        ),
        'media_id' => 
        array (
          'Type' => 'int(11)',
        ),
        'media_order_id' => 
        array (
          'Type' => 'int(11)',
        ),
        'gender' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'regip' => 
        array (
          'Type' => 'char(15)',
          'Key' => 'MUL',
        ),
        'reg_ip_port' => 
        array (
          'Type' => 'char(6)',
        ),
        'regdate' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
        'lastip' => 
        array (
          'Type' => 'char(15)',
        ),
        'last_ip_port' => 
        array (
          'Type' => 'char(6)',
        ),
        'lastactivity' => 
        array (
          'Type' => 'int(10) unsigned',
          'Key' => 'MUL',
        ),
        'lastpost' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'credits' => 
        array (
          'Type' => 'int(10)',
          'Key' => 'MUL',
        ),
        'extcredits1' => 
        array (
          'Type' => 'int(10)',
        ),
        'extcredits2' => 
        array (
          'Type' => 'int(10)',
        ),
        'extcredits3' => 
        array (
          'Type' => 'int(10)',
        ),
        'extcredits4' => 
        array (
          'Type' => 'int(10)',
        ),
        'extcredits5' => 
        array (
          'Type' => 'int(10)',
        ),
        'extcredits6' => 
        array (
          'Type' => 'int(10)',
        ),
        'extcredits7' => 
        array (
          'Type' => 'int(10)',
        ),
        'extcredits8' => 
        array (
          'Type' => 'int(10)',
        ),
        'email' => 
        array (
          'Type' => 'char(50)',
          'Key' => 'MUL',
        ),
        'email_checked' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'bday' => 
        array (
          'Type' => 'date',
          'Default' => '0000-00-00',
        ),
        'newpm' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'face_url' => 
        array (
          'Type' => 'char(60)',
        ),
        'face' => 
        array (
          'Type' => 'char(60)',
        ),
        'tag_count' => 
        array (
          'Type' => 'mediumint(6)',
        ),
        'role_id' => 
        array (
          'Type' => 'smallint(4) unsigned',
          'Key' => 'MUL',
        ),
        'role_type' => 
        array (
          'Type' => 'enum(\'admin\',\'normal\')',
          'Default' => 'normal',
        ),
        'tag' => 
        array (
          'Type' => 'char(255)',
        ),
        'phone' => 
        array (
          'Type' => 'char(15)',
          'Key' => 'MUL',
        ),
        'use_tag_count' => 
        array (
          'Type' => 'mediumint(8) unsigned',
        ),
        'create_tag_count' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'image_count' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'ucuid' => 
        array (
          'Type' => 'mediumint(8)',
          'Key' => 'MUL',
        ),
        'invite_uid' => 
        array (
          'Type' => 'mediumint(8) unsigned',
          'Key' => 'MUL',
        ),
        'invite_count' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'invitecode' => 
        array (
          'Type' => 'char(16)',
        ),
        'topic_count' => 
        array (
          'Type' => 'mediumint(6) unsigned',
        ),
        'at_count' => 
        array (
          'Type' => 'mediumint(6) unsigned',
        ),
        'follow_count' => 
        array (
          'Type' => 'mediumint(6) unsigned',
        ),
        'fans_count' => 
        array (
          'Type' => 'mediumint(6) unsigned',
        ),
        'email2' => 
        array (
          'Type' => 'char(50)',
        ),
        'qq' => 
        array (
          'Type' => 'char(10)',
        ),
        'msn' => 
        array (
          'Type' => 'char(50)',
        ),
        'aboutme' => 
        array (
          'Type' => 'char(255)',
        ),
        'aboutmetime' => 
        array (
          'Type' => 'int(10)',
        ),
        'signature' => 
        array (
          'Type' => 'char(30)',
        ),
        'signtime' => 
        array (
          'Type' => 'int(10)',
        ),
        'at_new' => 
        array (
          'Type' => 'smallint(4)',
        ),
        'comment_new' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'event_new' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'fans_new' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'vote_new' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'qun_new' => 
        array (
          'Type' => 'smallint(4)',
        ),
        'topic_new' => 
        array (
          'Type' => 'smallint(4)',
        ),
        'topic_favorite_count' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'tag_favorite_count' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'disallow_beiguanzhu' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'validate' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'validate_category' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'favoritemy_new' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'notice_at' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'notice_pm' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'notice_reply' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'notice_fans' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'notice_event' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'user_notice_time' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'last_notice_time' => 
        array (
          'Type' => 'int(10)',
          'Key' => 'MUL',
        ),
        'companyid' => 
        array (
          'Type' => 'int(6)',
          'Key' => 'MUL',
        ),
        'company' => 
        array (
          'Type' => 'char(50)',
        ),
        'jobid' => 
        array (
          'Type' => 'int(6)',
          'Key' => 'MUL',
        ),
        'job' => 
        array (
          'Type' => 'char(50)',
        ),
        'departmentid' => 
        array (
          'Type' => 'int(6)',
          'Key' => 'MUL',
        ),
        'department' => 
        array (
          'Type' => 'char(50)',
        ),
        'theme_id' => 
        array (
          'Type' => 'char(6)',
        ),
        'theme_bg_image' => 
        array (
          'Type' => 'char(60)',
        ),
        'theme_bg_color' => 
        array (
          'Type' => 'char(7)',
        ),
        'theme_text_color' => 
        array (
          'Type' => 'char(7)',
        ),
        'theme_link_color' => 
        array (
          'Type' => 'char(7)',
        ),
        'theme_bg_image_type' => 
        array (
          'Type' => 'enum(\'repeat\',\'center\',\'left\',\'right\',\'bottom\')',
          'Default' => 'repeat',
        ),
        'theme_bg_repeat' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'theme_bg_fixed' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'profile_image' => 
        array (
          'Type' => 'char(120)',
          'Default' => './images/art_bg.jpg',
        ),
        'last_topic_content_id' => 
        array (
          'Type' => 'int(10)',
        ),
        'level' => 
        array (
          'Type' => 'int(10)',
        ),
        'style_three_tol' => 
        array (
          'Type' => 'tinyint(3)',
        ),
        'province' => 
        array (
          'Type' => 'char(16)',
          'Key' => 'MUL',
        ),
        'city' => 
        array (
          'Type' => 'char(16)',
        ),
        'area' => 
        array (
          'Type' => 'char(16)',
        ),
        'street' => 
        array (
          'Type' => 'char(16)',
        ),
        'qmd_url' => 
        array (
          'Type' => 'char(60)',
        ),
        'event_post_new' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'fenlei_post_new' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'qmd_img' => 
        array (
          'Type' => 'char(30)',
        ),
        'open_extra' => 
        array (
          'Type' => 'tinyint(1)',
        ),
        'digcount' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'dig_new' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'channel_new' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'company_new' => 
        array (
          'Type' => 'smallint(4) unsigned',
        ),
        'close_recd_time' => 
        array (
          'Type' => 'int(10) unsigned',
        ),
        'salt' => 
        array (
          'Type' => 'char(10)',
        ),
      ),
    ),
  ),
);
?>