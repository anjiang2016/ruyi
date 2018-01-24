DROP TABLE IF EXISTS `jishigou_api_oauth2_code`;
CREATE TABLE `jishigou_api_oauth2_code` (
`id` bigint(20) NOT NULL AUTO_INCREMENT,
`client_id` varchar(32) NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`code` varchar(40) NOT NULL,
`redirect_uri` varchar(200) NOT NULL,
`expires` int(11) NOT NULL,
`scope` varchar(255) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `code` (`code`),
KEY `expires` (`expires`),
KEY `uid-client_id` (`uid`,`client_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_api_oauth2_token`;
CREATE TABLE `jishigou_api_oauth2_token` (
`id` bigint(20) NOT NULL AUTO_INCREMENT,
`client_id` varchar(32) NOT NULL,
`uid` mediumint(8) NOT NULL,
`access_token` varchar(40) NOT NULL,
`refresh_token` varchar(40) NOT NULL,
`expires` int(11) NOT NULL,
`scope` varchar(255) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `access_token` (`access_token`),
KEY `expires` (`expires`),
KEY `uid-client_id` (`uid`,`client_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_app`;
CREATE TABLE `jishigou_app` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`username` char(15) NOT NULL DEFAULT '',
`app_name` char(100) NOT NULL DEFAULT '',
`source_url` char(255) NOT NULL DEFAULT '',
`show_from` tinyint(1) NOT NULL DEFAULT '0',
`app_desc` text NOT NULL,
`app_key` char(32) NOT NULL,
`app_secret` char(32) NOT NULL DEFAULT '',
`allows_ip` text NOT NULL,
`status` tinyint(1) NOT NULL DEFAULT '0',
`request_times` bigint(20) unsigned NOT NULL DEFAULT '0',
`request_times_day` int(10) unsigned NOT NULL DEFAULT '0',
`request_times_last_day` int(10) unsigned NOT NULL DEFAULT '0',
`request_times_week` int(10) unsigned NOT NULL DEFAULT '0',
`request_times_last_week` int(10) unsigned NOT NULL DEFAULT '0',
`request_times_month` int(10) unsigned NOT NULL DEFAULT '0',
`request_times_last_month` int(10) unsigned NOT NULL DEFAULT '0',
`request_times_year` bigint(20) unsigned NOT NULL DEFAULT '0',
`request_times_last_year` bigint(20) unsigned NOT NULL DEFAULT '0',
`last_request_time` int(10) unsigned NOT NULL DEFAULT '0',
`redirect_uri` char(255) NOT NULL,
`create_time` int(11) unsigned NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `app_key_secret` (`app_key`,`app_secret`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_blacklist`;
CREATE TABLE `jishigou_blacklist` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) NOT NULL DEFAULT '0',
`touid` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `uid_touid` (`uid`,`touid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_fans`;
CREATE TABLE `jishigou_buddy_fans` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('2','3') NOT NULL DEFAULT '2',
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_fans_1`;
CREATE TABLE `jishigou_buddy_fans_1` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('2','3') NOT NULL DEFAULT '2',
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_fans_10`;
CREATE TABLE `jishigou_buddy_fans_10` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('2','3') NOT NULL DEFAULT '2',
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_fans_2`;
CREATE TABLE `jishigou_buddy_fans_2` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('2','3') NOT NULL DEFAULT '2',
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_fans_3`;
CREATE TABLE `jishigou_buddy_fans_3` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('2','3') NOT NULL DEFAULT '2',
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_fans_4`;
CREATE TABLE `jishigou_buddy_fans_4` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('2','3') NOT NULL DEFAULT '2',
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_fans_5`;
CREATE TABLE `jishigou_buddy_fans_5` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('2','3') NOT NULL DEFAULT '2',
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_fans_6`;
CREATE TABLE `jishigou_buddy_fans_6` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('2','3') NOT NULL DEFAULT '2',
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_fans_7`;
CREATE TABLE `jishigou_buddy_fans_7` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('2','3') NOT NULL DEFAULT '2',
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_fans_8`;
CREATE TABLE `jishigou_buddy_fans_8` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('2','3') NOT NULL DEFAULT '2',
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_fans_9`;
CREATE TABLE `jishigou_buddy_fans_9` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('2','3') NOT NULL DEFAULT '2',
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_fans_table_id`;
CREATE TABLE `jishigou_buddy_fans_table_id` (
`uid` mediumint(8) unsigned NOT NULL,
`table_id` smallint(4) unsigned NOT NULL,
PRIMARY KEY (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow`;
CREATE TABLE `jishigou_buddy_follow` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('1','3') NOT NULL DEFAULT '1',
`remark` char(255) NOT NULL,
`gids` char(255) NOT NULL,
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_1`;
CREATE TABLE `jishigou_buddy_follow_1` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('1','3') NOT NULL DEFAULT '1',
`remark` char(255) NOT NULL,
`gids` char(255) NOT NULL,
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_10`;
CREATE TABLE `jishigou_buddy_follow_10` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('1','3') NOT NULL DEFAULT '1',
`remark` char(255) NOT NULL,
`gids` char(255) NOT NULL,
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_2`;
CREATE TABLE `jishigou_buddy_follow_2` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('1','3') NOT NULL DEFAULT '1',
`remark` char(255) NOT NULL,
`gids` char(255) NOT NULL,
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_3`;
CREATE TABLE `jishigou_buddy_follow_3` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('1','3') NOT NULL DEFAULT '1',
`remark` char(255) NOT NULL,
`gids` char(255) NOT NULL,
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_4`;
CREATE TABLE `jishigou_buddy_follow_4` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('1','3') NOT NULL DEFAULT '1',
`remark` char(255) NOT NULL,
`gids` char(255) NOT NULL,
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_5`;
CREATE TABLE `jishigou_buddy_follow_5` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('1','3') NOT NULL DEFAULT '1',
`remark` char(255) NOT NULL,
`gids` char(255) NOT NULL,
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_6`;
CREATE TABLE `jishigou_buddy_follow_6` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('1','3') NOT NULL DEFAULT '1',
`remark` char(255) NOT NULL,
`gids` char(255) NOT NULL,
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_7`;
CREATE TABLE `jishigou_buddy_follow_7` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('1','3') NOT NULL DEFAULT '1',
`remark` char(255) NOT NULL,
`gids` char(255) NOT NULL,
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_8`;
CREATE TABLE `jishigou_buddy_follow_8` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('1','3') NOT NULL DEFAULT '1',
`remark` char(255) NOT NULL,
`gids` char(255) NOT NULL,
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_9`;
CREATE TABLE `jishigou_buddy_follow_9` (
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`relation` enum('1','3') NOT NULL DEFAULT '1',
`remark` char(255) NOT NULL,
`gids` char(255) NOT NULL,
PRIMARY KEY (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_group`;
CREATE TABLE `jishigou_buddy_follow_group` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL,
`name` char(100) NOT NULL,
`remark` char(255) NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`count` int(10) unsigned NOT NULL,
`order` int(10) NOT NULL DEFAULT '99',
`mode` enum('private','friend','public') NOT NULL DEFAULT 'private',
PRIMARY KEY (`id`),
UNIQUE KEY `uid-name` (`uid`,`name`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_group_relation`;
CREATE TABLE `jishigou_buddy_follow_group_relation` (
`gid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
KEY `gid-uid` (`gid`,`uid`),
KEY `uid-touid` (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_group_relation_1`;
CREATE TABLE `jishigou_buddy_follow_group_relation_1` (
`gid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
KEY `gid-uid` (`gid`,`uid`),
KEY `uid-touid` (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_group_relation_10`;
CREATE TABLE `jishigou_buddy_follow_group_relation_10` (
`gid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
KEY `gid-uid` (`gid`,`uid`),
KEY `uid-touid` (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_group_relation_2`;
CREATE TABLE `jishigou_buddy_follow_group_relation_2` (
`gid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
KEY `gid-uid` (`gid`,`uid`),
KEY `uid-touid` (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_group_relation_3`;
CREATE TABLE `jishigou_buddy_follow_group_relation_3` (
`gid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
KEY `gid-uid` (`gid`,`uid`),
KEY `uid-touid` (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_group_relation_4`;
CREATE TABLE `jishigou_buddy_follow_group_relation_4` (
`gid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
KEY `gid-uid` (`gid`,`uid`),
KEY `uid-touid` (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_group_relation_5`;
CREATE TABLE `jishigou_buddy_follow_group_relation_5` (
`gid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
KEY `gid-uid` (`gid`,`uid`),
KEY `uid-touid` (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_group_relation_6`;
CREATE TABLE `jishigou_buddy_follow_group_relation_6` (
`gid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
KEY `gid-uid` (`gid`,`uid`),
KEY `uid-touid` (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_group_relation_7`;
CREATE TABLE `jishigou_buddy_follow_group_relation_7` (
`gid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
KEY `gid-uid` (`gid`,`uid`),
KEY `uid-touid` (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_group_relation_8`;
CREATE TABLE `jishigou_buddy_follow_group_relation_8` (
`gid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
KEY `gid-uid` (`gid`,`uid`),
KEY `uid-touid` (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_group_relation_9`;
CREATE TABLE `jishigou_buddy_follow_group_relation_9` (
`gid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
KEY `gid-uid` (`gid`,`uid`),
KEY `uid-touid` (`uid`,`touid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_follow_table_id`;
CREATE TABLE `jishigou_buddy_follow_table_id` (
`uid` mediumint(8) unsigned NOT NULL,
`table_id` smallint(4) unsigned NOT NULL,
PRIMARY KEY (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddys`;
CREATE TABLE `jishigou_buddys` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`buddyid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`grade` tinyint(1) unsigned NOT NULL DEFAULT '1',
`remark` char(30) NOT NULL DEFAULT '',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`description` char(255) NOT NULL DEFAULT '',
`buddy_lastuptime` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `uid_buddyid` (`uid`,`buddyid`),
KEY `buddyid` (`buddyid`),
KEY `dateline` (`dateline`),
KEY `buddy_lastuptime` (`buddy_lastuptime`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache`;
CREATE TABLE `jishigou_cache` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_1`;
CREATE TABLE `jishigou_cache_1` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_2`;
CREATE TABLE `jishigou_cache_2` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_3`;
CREATE TABLE `jishigou_cache_3` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_4`;
CREATE TABLE `jishigou_cache_4` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_5`;
CREATE TABLE `jishigou_cache_5` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_6`;
CREATE TABLE `jishigou_cache_6` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_7`;
CREATE TABLE `jishigou_cache_7` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_8`;
CREATE TABLE `jishigou_cache_8` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_9`;
CREATE TABLE `jishigou_cache_9` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_10`;
CREATE TABLE `jishigou_cache_10` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_11`;
CREATE TABLE `jishigou_cache_11` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_12`;
CREATE TABLE `jishigou_cache_12` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_13`;
CREATE TABLE `jishigou_cache_13` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_14`;
CREATE TABLE `jishigou_cache_14` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cache_15`;
CREATE TABLE `jishigou_cache_15` (
`key` char(255) NOT NULL,
`val` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_common_district`;
CREATE TABLE `jishigou_common_district` (
`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`name` char(255) NOT NULL,
`level` tinyint(4) unsigned NOT NULL DEFAULT '0',
`upid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`list` smallint(6) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `name` (`name`),
KEY `upid` (`upid`),
KEY `list` (`list`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_credits_log`;
CREATE TABLE `jishigou_credits_log` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`rid` tinyint(2) NOT NULL,
`relatedid` int(10) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`remark` varchar(255) NOT NULL DEFAULT '',
`extcredits1` int(10) NOT NULL DEFAULT '0',
`extcredits2` int(10) NOT NULL DEFAULT '0',
`extcredits3` int(10) NOT NULL DEFAULT '0',
`extcredits4` int(10) NOT NULL DEFAULT '0',
`extcredits5` int(10) NOT NULL DEFAULT '0',
`extcredits6` int(10) NOT NULL DEFAULT '0',
`extcredits7` int(10) NOT NULL DEFAULT '0',
`extcredits8` int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `uid` (`uid`),
KEY `operation` (`rid`),
KEY `relatedid` (`relatedid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_credits_rule`;
CREATE TABLE `jishigou_credits_rule` (
`rid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`rulename` varchar(20) NOT NULL DEFAULT '',
`action` varchar(20) NOT NULL DEFAULT '',
`cycletype` tinyint(1) NOT NULL DEFAULT '0',
`cycletime` int(10) NOT NULL DEFAULT '0',
`rewardnum` tinyint(2) NOT NULL DEFAULT '1',
`norepeat` tinyint(1) NOT NULL DEFAULT '0',
`extcredits1` int(10) NOT NULL DEFAULT '0',
`extcredits2` int(10) NOT NULL DEFAULT '0',
`extcredits3` int(10) NOT NULL DEFAULT '0',
`extcredits4` int(10) NOT NULL DEFAULT '0',
`extcredits5` int(10) NOT NULL DEFAULT '0',
`extcredits6` int(10) NOT NULL DEFAULT '0',
`extcredits7` int(10) NOT NULL DEFAULT '0',
`extcredits8` int(10) NOT NULL DEFAULT '0',
`related` char(20) NOT NULL DEFAULT '',
PRIMARY KEY (`rid`),
UNIQUE KEY `action` (`action`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_credits_rule_log`;
CREATE TABLE `jishigou_credits_rule_log` (
`clid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`rid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`total` mediumint(8) unsigned NOT NULL DEFAULT '0',
`cyclenum` mediumint(8) unsigned NOT NULL DEFAULT '0',
`extcredits1` int(10) NOT NULL DEFAULT '0',
`extcredits2` int(10) NOT NULL DEFAULT '0',
`extcredits3` int(10) NOT NULL DEFAULT '0',
`extcredits4` int(10) NOT NULL DEFAULT '0',
`extcredits5` int(10) NOT NULL DEFAULT '0',
`extcredits6` int(10) NOT NULL DEFAULT '0',
`extcredits7` int(10) NOT NULL DEFAULT '0',
`extcredits8` int(10) NOT NULL DEFAULT '0',
`starttime` int(10) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`relatedid` int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (`clid`),
KEY `uid` (`uid`,`rid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cron`;
CREATE TABLE `jishigou_cron` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`touid` int(11) NOT NULL DEFAULT '0',
`toemail` char(40) NOT NULL DEFAULT '',
`at_content` text NOT NULL,
`pm_content` text NOT NULL,
`reply_content` text NOT NULL,
`sendtime` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_event`;
CREATE TABLE `jishigou_event` (
`id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
`type_id` mediumint(10) NOT NULL,
`title` char(100) NOT NULL,
`fromt` int(10) NOT NULL,
`tot` int(10) NOT NULL,
`content` text NOT NULL,
`image` char(255) NOT NULL,
`province_id` mediumint(7) NOT NULL,
`area_id` mediumint(7) NOT NULL,
`city_id` mediumint(7) NOT NULL,
`address` char(255) NOT NULL,
`money` int(10) NOT NULL DEFAULT '0',
`app_num` int(10) NOT NULL DEFAULT '0',
`play_num` int(10) NOT NULL DEFAULT '0',
`postman` int(7) NOT NULL,
`posttime` int(10) NOT NULL,
`lasttime` int(10) NOT NULL,
`qualification` text NOT NULL,
`need_app_info` text NOT NULL,
`recd` tinyint(1) NOT NULL DEFAULT '0',
`verify` tinyint(1) NOT NULL DEFAULT '1',
`postip` char(15) NOT NULL DEFAULT '',
`item` char(15) NOT NULL DEFAULT '',
`item_id` int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_event_favorite`;
CREATE TABLE `jishigou_event_favorite` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`type_id` mediumint(10) NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `type_id` (`type_id`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_event_member`;
CREATE TABLE `jishigou_event_member` (
`oid` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
`id` mediumint(10) NOT NULL,
`title` char(100) NOT NULL,
`fid` mediumint(8) NOT NULL,
`app` mediumint(1) NOT NULL DEFAULT '0',
`play` mediumint(1) NOT NULL DEFAULT '0',
`app_info` text NOT NULL,
`store` mediumint(1) NOT NULL DEFAULT '0',
`app_time` int(10) NOT NULL,
`play_time` int(10) NOT NULL,
`store_time` int(10) NOT NULL,
PRIMARY KEY (`oid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_event_sort`;
CREATE TABLE `jishigou_event_sort` (
`id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
`type` char(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_failedlogins`;
CREATE TABLE `jishigou_failedlogins` (
`ip` char(15) NOT NULL DEFAULT '',
`count` int(10) unsigned NOT NULL DEFAULT '0',
`lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`ip`),
KEY `count` (`count`),
KEY `lastupdate` (`lastupdate`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_force_out`;
CREATE TABLE `jishigou_force_out` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`role_id` smallint(4) unsigned NOT NULL,
`douid` int(10) unsigned NOT NULL DEFAULT '0',
`cause` char(100) NOT NULL DEFAULT '',
`dateline` int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_group`;
CREATE TABLE `jishigou_group` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) NOT NULL DEFAULT '0',
`group_name` char(15) NOT NULL DEFAULT '',
`group_count` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_groupfields`;
CREATE TABLE `jishigou_groupfields` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`gid` int(11) NOT NULL DEFAULT '0',
`uid` mediumint(8) NOT NULL DEFAULT '0',
`touid` int(11) NOT NULL DEFAULT '0',
`g_name` char(15) NOT NULL DEFAULT '',
`display` tinyint(4) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `gid_uid` (`gid`,`uid`),
KEY `uid_touid` (`uid`,`touid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_invite`;
CREATE TABLE `jishigou_invite` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`code` char(16) NOT NULL DEFAULT '',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`fuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`fusername` char(15) NOT NULL DEFAULT '',
`femail` char(50) NOT NULL DEFAULT '',
PRIMARY KEY (`id`),
KEY `uidcode` (`uid`,`code`),
KEY `femail` (`femail`),
KEY `fuid` (`fuid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_item_sms`;
CREATE TABLE `jishigou_item_sms` (
`sid` int(11) NOT NULL AUTO_INCREMENT,
`item` varchar(10) NOT NULL,
`itemid` int(10) unsigned NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`sid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_item_user`;
CREATE TABLE `jishigou_item_user` (
`iid` int(11) NOT NULL AUTO_INCREMENT,
`item` varchar(10) NOT NULL,
`itemid` int(10) unsigned NOT NULL DEFAULT '0',
`type` varchar(10) NOT NULL DEFAULT '',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`description` varchar(254) NOT NULL,
PRIMARY KEY (`iid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_kaixin_bind_info`;
CREATE TABLE `jishigou_kaixin_bind_info` (
`uid` mediumint(8) unsigned NOT NULL,
`kaixin_uid` char(32) NOT NULL default '',
`kaixin_name` char(32) NOT NULL default '',
`kaixin_gender` char(64) NOT NULL default '',
`kaixin_logo50` char(32) NOT NULL default '',
`token` char(128) NOT NULL default '',
`token_time` int(10) NOT NULL,
`token_expire` int(10) NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY  (`uid`),
UNIQUE KEY `renren_uid` (`kaixin_uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_kaixin_bind_topic`;
CREATE TABLE `jishigou_kaixin_bind_topic` (
`tid` int(10) unsigned NOT NULL,
`kaixin_id` bigint(20) unsigned NOT NULL,
KEY `tid` (`tid`),
KEY `kaixin_id` (`kaixin_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_live`;
CREATE TABLE `jishigou_live` (
`lid` int(11) NOT NULL AUTO_INCREMENT,
`livename` varchar(60) NOT NULL,
`description` text NOT NULL,
`starttime` int(10) unsigned NOT NULL DEFAULT '0',
`endtime` int(10) unsigned NOT NULL DEFAULT '0',
`image` varchar(100) NOT NULL,
PRIMARY KEY (`lid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_log`;
CREATE TABLE `jishigou_log` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`username` char(15) NOT NULL,
`nickname` char(30) NOT NULL,
`role_action_id` int(10) unsigned NOT NULL DEFAULT '0',
`role_action_name` char(15) NOT NULL,
`mod` char(50) NOT NULL,
`code` char(255) NOT NULL DEFAULT '',
`ip` char(15) NOT NULL DEFAULT '',
`ip_port` CHAR(6) NOT NULL DEFAULT '',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`request_method` enum('POST','GET') NOT NULL DEFAULT 'GET',
`data_length` int(10) unsigned NOT NULL,
`uri` char(255) NOT NULL,
PRIMARY KEY (`id`),
KEY `role_action_id` (`role_action_id`),
KEY `mod_code` (`mod`,`code`),
KEY `uid` (`uid`),
KEY `ip` (`ip`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_log_data`;
CREATE TABLE `jishigou_log_data` (
`log_id` int(10) NOT NULL,
`user_agent` char(255) NOT NULL,
`log_data` longblob NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`log_id`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_manage_detail`;
CREATE TABLE `jishigou_manage_detail` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`type` char(8) NOT NULL DEFAULT '',
`tuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`tusername` char(15) NOT NULL DEFAULT '',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`username` char(15) NOT NULL DEFAULT '',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`postip` char(15) NOT NULL DEFAULT '',
PRIMARY KEY (`id`),
KEY `uid` (`uid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_medal`;
CREATE TABLE `jishigou_medal` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`medal_img` char(255) NOT NULL,
`medal_img2` char(200) NOT NULL,
`medal_name` char(30) NOT NULL,
`medal_depict` char(50) NOT NULL,
`medal_count` int(11) NOT NULL DEFAULT '0',
`is_open` tinyint(4) NOT NULL DEFAULT '1',
`conditions` varchar(250) NOT NULL,
`dateline` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_medal_apply`;
CREATE TABLE `jishigou_medal_apply` (
`apply_id` int(10) NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) NOT NULL DEFAULT '0',
`nickname` char(30) NOT NULL DEFAULT '',
`medal_id` smallint(6) NOT NULL DEFAULT '0',
`dateline` int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (`apply_id`),
KEY `uid` (`uid`),
KEY `medal_id` (`medal_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_media`;
CREATE TABLE `jishigou_media` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`media_name` char(20) NOT NULL DEFAULT '',
`media_count` smallint(6) NOT NULL DEFAULT '0',
`order` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_member_relation`;
CREATE TABLE `jishigou_member_relation` (
`touid` mediumint(8) unsigned NOT NULL,
`totid` int(11) unsigned NOT NULL,
`tid` int(11) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`type` enum('reply','forward','both') NOT NULL DEFAULT 'reply',
PRIMARY KEY (`touid`,`tid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_member_table_id`;
CREATE TABLE `jishigou_member_table_id` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `uid` (`uid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_member_topic`;
CREATE TABLE `jishigou_member_topic` (
`uid` mediumint(8) unsigned NOT NULL,
`tid` int(11) unsigned NOT NULL,
`type` enum('first','reply','forward','both') NOT NULL DEFAULT 'first',
`totid` int(11) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`replys` int(10) unsigned NOT NULL,
`forwards` int(10) unsigned NOT NULL,
`lastupdate` int(10) unsigned NOT NULL,
`digcounts` int(10) unsigned NOT NULL,
`lastdigtime` int(10) unsigned NOT NULL,
PRIMARY KEY (`uid`,`tid`),
UNIQUE KEY `tid` (`tid`),
KEY `dateline` (`dateline`),
KEY `replys` (`replys`),
KEY `forwards` (`forwards`),
KEY `lastupdate` (`lastupdate`),
KEY `digcounts` (`digcounts`),
KEY `lastdigtime` (`lastdigtime`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_member_validate`;
CREATE TABLE `jishigou_member_validate` (
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`email` char(50) NOT NULL DEFAULT '',
`role_id` smallint(4) unsigned NOT NULL DEFAULT '0',
`key` char(16) NOT NULL DEFAULT '',
`status` tinyint(1) unsigned NOT NULL DEFAULT '0',
`verify_time` int(10) unsigned NOT NULL DEFAULT '0',
`regdate` int(10) unsigned NOT NULL DEFAULT '0',
`type` enum('email','admin') NOT NULL DEFAULT 'email',
UNIQUE KEY `key` (`key`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_mailqueue`;
CREATE TABLE `jishigou_mailqueue` (
`qid` int(10) NOT NULL auto_increment,
`uid` mediumint(8) unsigned NOT NULL default '0',
`email` char(50) NOT NULL default '',
`msg` text NOT NULL,
`dateline` int(10) NOT NULL default '0',
PRIMARY KEY  (`qid`),
UNIQUE KEY `uid` (`uid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_memberfields`;
CREATE TABLE `jishigou_memberfields` (
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`site` varchar(75) NOT NULL DEFAULT '',
`location` varchar(30) NOT NULL DEFAULT '',
`authstr` varchar(50) NOT NULL DEFAULT '',
`auth_try_times` TINYINT(1) UNSIGNED NOT NULL,
`question` varchar(255) NOT NULL DEFAULT '',
`answer` varchar(255) NOT NULL DEFAULT '',
`address` varchar(40) NOT NULL DEFAULT '',
`validate_true_name` varchar(50) NOT NULL DEFAULT '',
`validate_card_type` varchar(10) NOT NULL DEFAULT '',
`validate_card_id` varchar(50) NOT NULL DEFAULT '',
`validate_remark` varchar(100) NOT NULL DEFAULT '',
`validate_card_pic` char(100) NOT NULL,
`validate_extra` char(200) NOT NULL,
`account_bind_info` text NOT NULL,
`profile_set` text NOT NULL,
PRIMARY KEY (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_members_profile`;
CREATE TABLE `jishigou_members_profile` (
`uid` mediumint(8) unsigned NOT NULL default '0',
`constellation` char(3) NOT NULL default '',
`zodiac` char(1) NOT NULL default '',
`telephone` char(50) NOT NULL default '',
`address` char(150) NOT NULL default '',
`zipcode` char(15) NOT NULL default '',
`nationality` char(50) NOT NULL default '',
`education` char(15) NOT NULL default '',
`birthcity` char(100) NOT NULL default '',
`graduateschool` char(50) NOT NULL default '',
`pcompany` char(50) NOT NULL default '',
`occupation` char(50) NOT NULL default '',
`position` char(50) NOT NULL default '',
`revenue` char(50) NOT NULL default '',
`affectivestatus` char(50) NOT NULL default '',
`lookingfor` char(50) NOT NULL default '',
`bloodtype` char(10) NOT NULL default '',
`height` char(50) NOT NULL default '',
`weight` char(50) NOT NULL default '',
`alipay` char(50) NOT NULL default '',
`icq` char(50) NOT NULL default '',
`yahoo` char(50) NOT NULL default '',
`taobao` char(50) NOT NULL default '',
`site` char(150) NOT NULL default '',
`interest` char(255) NOT NULL default '',
`linkaddress` char(50) NOT NULL default '',
`field1` char(255) NOT NULL default '',
`field2` char(255) NOT NULL default '',
`field3` char(255) NOT NULL default '',
`field4` char(255) NOT NULL default '',
`field5` char(255) NOT NULL default '',
`field6` char(255) NOT NULL default '',
`field7` char(255) NOT NULL default '',
`field8` char(255) NOT NULL default '',
`last_update` INT(10) UNSIGNED NOT NULL default 0,
`realname` char(50) DEFAULT '',
`mobile` char(50) DEFAULT '0',
PRIMARY KEY  (`uid`),
KEY `last_update` (`last_update`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_common_member_profile_setting`;
CREATE TABLE `jishigou_common_member_profile_setting` (
`fieldid` varchar(255) NOT NULL default '',
`title` varchar(255) NOT NULL default '',
`displayorder` smallint(6) unsigned NOT NULL default '0',
`formtype` varchar(255) NOT NULL,
`size` smallint(6) unsigned NOT NULL default '0',
`choices` text NOT NULL,
PRIMARY KEY  (`fieldid`),
KEY `order` (`displayorder`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_members`;
CREATE TABLE `jishigou_members` (
`uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`username` char(15) NOT NULL DEFAULT '',
`nickname` char(50) NOT NULL DEFAULT '',
`password` char(32) NOT NULL DEFAULT '',
`medal_id` char(20) NOT NULL DEFAULT '',
`media_id` int(11) NOT NULL DEFAULT '0',
`media_order_id` int(11) NOT NULL DEFAULT '0',
`gender` tinyint(1) NOT NULL DEFAULT '0',
`regip` char(15) NOT NULL DEFAULT '',
`reg_ip_port` CHAR(6) NOT NULL DEFAULT '',
`regdate` int(10) unsigned NOT NULL DEFAULT '0',
`lastip` char(15) NOT NULL DEFAULT '',
`last_ip_port` CHAR(6) NOT NULL DEFAULT '',
`lastactivity` int(10) unsigned NOT NULL DEFAULT '0',
`lastpost` int(10) unsigned NOT NULL DEFAULT '0',
`credits` int(10) NOT NULL DEFAULT '0',
`extcredits1` int(10) NOT NULL DEFAULT '0',
`extcredits2` int(10) NOT NULL DEFAULT '0',
`extcredits3` int(10) NOT NULL DEFAULT '0',
`extcredits4` int(10) NOT NULL DEFAULT '0',
`extcredits5` int(10) NOT NULL DEFAULT '0',
`extcredits6` int(10) NOT NULL DEFAULT '0',
`extcredits7` int(10) NOT NULL DEFAULT '0',
`extcredits8` int(10) NOT NULL DEFAULT '0',
`email` char(50) NOT NULL DEFAULT '',
`email_checked` tinyint(1) NOT NULL DEFAULT 0,
`bday` date NOT NULL DEFAULT '0000-00-00',
`newpm` tinyint(1) NOT NULL DEFAULT '0',
`face_url` char(60) NOT NULL DEFAULT '',
`face` char(60) NOT NULL DEFAULT '',
`tag_count` mediumint(6) NOT NULL DEFAULT '0',
`role_id` smallint(4) unsigned NOT NULL DEFAULT '0',
`role_type` enum('admin','normal') NOT NULL DEFAULT 'normal',
`tag` char(255) NOT NULL DEFAULT '',
`phone` char(15) NOT NULL DEFAULT '',
`use_tag_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
`create_tag_count` smallint(4) unsigned NOT NULL DEFAULT '0',
`image_count` int(10) unsigned NOT NULL DEFAULT '0',
`ucuid` mediumint(8) NOT NULL DEFAULT '0',
`invite_uid` mediumint(8) unsigned NOT NULL,
`invite_count` smallint(4) unsigned NOT NULL DEFAULT '0',
`invitecode` char(16) NOT NULL DEFAULT '0',
`topic_count` mediumint(6) unsigned NOT NULL DEFAULT '0',
`at_count` mediumint(6) unsigned NOT NULL DEFAULT '0',
`follow_count` mediumint(6) unsigned NOT NULL DEFAULT '0',
`fans_count` mediumint(6) unsigned NOT NULL DEFAULT '0',
`email2` char(50) NOT NULL DEFAULT '',
`qq` char(10) NOT NULL DEFAULT '',
`msn` char(50) NOT NULL DEFAULT '',
`aboutme` char(255) NOT NULL DEFAULT '',
`aboutmetime` int(10) NOT NULL DEFAULT '0',
`signature` char(30) NOT NULL DEFAULT '',
`signtime` int(10) NOT NULL DEFAULT '0',
`at_new` smallint(4) NOT NULL DEFAULT '0',
`comment_new` smallint(4) unsigned NOT NULL DEFAULT '0',
`event_new` smallint(4) unsigned NOT NULL DEFAULT '0',
`fans_new` smallint(4) unsigned NOT NULL DEFAULT '0',
`vote_new` smallint(4) unsigned NOT NULL DEFAULT '0',
`qun_new` smallint(4) NOT NULL DEFAULT '0',
`topic_new` smallint(4) NOT NULL DEFAULT '0',
`topic_favorite_count` smallint(4) unsigned NOT NULL DEFAULT '0',
`tag_favorite_count` smallint(4) unsigned NOT NULL DEFAULT '0',
`disallow_beiguanzhu` tinyint(1) NOT NULL DEFAULT '0',
`validate` tinyint(1) NOT NULL DEFAULT '0',
`validate_category` tinyint(1) NOT NULL DEFAULT '0',
`favoritemy_new` smallint(4) unsigned NOT NULL DEFAULT '0',
`notice_at` tinyint(1) NOT NULL default '0',
`notice_pm` tinyint(1) NOT NULL default '0',
`notice_reply` tinyint(1) NOT NULL default '0',
`notice_fans` tinyint(1) NOT NULL default '0',
`notice_event` tinyint(1) NOT NULL default '0',
`user_notice_time` tinyint(1) NOT NULL default '0',
`last_notice_time` int(10) NOT NULL default '0',
`companyid` int(6) NOT NULL default '0',
`company` char(50) NOT NULL default '',
`jobid` int(6) NOT NULL default '0',
`job` char(50) NOT NULL default '',
`departmentid` int(6) NOT NULL default '0',
`department` char(50) NOT NULL default '',
`theme_id` char(6) NOT NULL DEFAULT '',
`theme_bg_image` char(60) NOT NULL DEFAULT '',
`theme_bg_color` char(7) NOT NULL DEFAULT '',
`theme_text_color` char(7) NOT NULL DEFAULT '',
`theme_link_color` char(7) NOT NULL DEFAULT '',
`theme_bg_image_type` enum('repeat','center','left','right','bottom') NOT NULL DEFAULT 'repeat',
`theme_bg_repeat` tinyint(1) NOT NULL,
`theme_bg_fixed` tinyint(1) NOT NULL,
`profile_image` char(120) NOT NULL default './images/art_bg.jpg',
`last_topic_content_id` int(10) NOT NULL DEFAULT '0',
`level` int(10) NOT NULL,
`style_three_tol` tinyint(3) NOT NULL DEFAULT '0',
`province` char(16) NOT NULL DEFAULT '',
`city` char(16) NOT NULL DEFAULT '',
`area` char(16) NOT NULL DEFAULT '',
`street` char(16) NOT NULL DEFAULT '',
`qmd_url` char(60) NOT NULL DEFAULT '',
`event_post_new` smallint(4) unsigned NOT NULL DEFAULT '0',
`fenlei_post_new` smallint(4) unsigned NOT NULL DEFAULT '0',
`qmd_img` char(30) NOT NULL,
`open_extra` tinyint(1) NOT NULL DEFAULT '0',
`digcount` int(10) UNSIGNED NOT NULL DEFAULT '0',
`dig_new` smallint(4) UNSIGNED NOT NULL DEFAULT '0',
`channel_new` smallint(4) UNSIGNED NOT NULL DEFAULT '0',
`company_new` smallint(4) UNSIGNED NOT NULL DEFAULT '0',
`close_recd_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
`salt` char(10) NOT NULL,
PRIMARY KEY (`uid`),
KEY `username` (`username`),
KEY `nickname` (`nickname`),
KEY `email` (`email`),
KEY `role_id` (`role_id`),
KEY `ucuid` (`ucuid`),
KEY `companytid` (`companyid`),
KEY `departmentid` (`departmentid`),
KEY `jobid` (`jobid`),
KEY `phone` (`phone`),
KEY `regdate` (`regdate`),
KEY `regip` (`regip`),
KEY `lastactivity` (`lastactivity`),
KEY `last_notice_time` (`last_notice_time`),
KEY `invite_uid` (`invite_uid`),
KEY `province_city` (`province`,`city`),
KEY `credits` (`credits`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_members_verify`;
CREATE TABLE `jishigou_members_verify` (
`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL,
`nickname` char(30) NOT NULL DEFAULT '',
`face_url` char(60) NOT NULL DEFAULT '',
`face` char(60) NOT NULL DEFAULT '',
`signature` char(30) NOT NULL DEFAULT '',
`is_sign` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_my_tag`;
CREATE TABLE `jishigou_my_tag` (
`user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`tag_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`total_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
`topic_count` smallint(6) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`user_id`,`tag_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_my_topic_tag`;
CREATE TABLE `jishigou_my_topic_tag` (
`user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`item_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`tag_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`count` smallint(4) unsigned NOT NULL DEFAULT '1',
PRIMARY KEY (`user_id`,`item_id`,`tag_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_notice`;
CREATE TABLE `jishigou_notice` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` char(200) NOT NULL DEFAULT '',
`content` text NOT NULL,
`dateline` int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_output`;
CREATE TABLE `jishigou_output` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`name` char(100) NOT NULL,
`hash` char(32) NOT NULL,
`lock_host` text NOT NULL,
`per_page_num` int(10) unsigned NOT NULL DEFAULT '20',
`content_default` char(100) NOT NULL,
`type_first` tinyint(1) NOT NULL,
`open_times` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`tpl_enable` tinyint(1) unsigned NOT NULL,
`tpl_file` char(100) NOT NULL,
`width` char(10) NOT NULL,
`height` char(10) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_plugin`;
CREATE TABLE `jishigou_plugin` (
`pluginid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
`available` tinyint(1) NOT NULL DEFAULT '0',
`adminid` tinyint(1) unsigned NOT NULL DEFAULT '0',
`name` varchar(40) NOT NULL DEFAULT '',
`identifier` varchar(40) NOT NULL DEFAULT '',
`description` varchar(255) NOT NULL DEFAULT '',
`datatables` varchar(255) NOT NULL DEFAULT '',
`directory` varchar(100) NOT NULL DEFAULT '',
`copyright` varchar(100) NOT NULL DEFAULT '',
`modules` text NOT NULL,
`version` varchar(20) NOT NULL DEFAULT '',
PRIMARY KEY (`pluginid`),
UNIQUE KEY `identifier` (`identifier`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_pluginvar`;
CREATE TABLE `jishigou_pluginvar` (
`pluginvarid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`pluginid` smallint(6) unsigned NOT NULL DEFAULT '0',
`displayorder` tinyint(3) NOT NULL DEFAULT '0',
`title` varchar(100) NOT NULL DEFAULT '',
`description` varchar(255) NOT NULL DEFAULT '',
`variable` varchar(40) NOT NULL DEFAULT '',
`type` varchar(20) NOT NULL DEFAULT 'text',
`value` text NOT NULL,
`extra` text NOT NULL,
PRIMARY KEY (`pluginvarid`),
KEY `pluginid` (`pluginid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_pms`;
CREATE TABLE `jishigou_pms` (
`pmid` int(10) unsigned NOT NULL AUTO_INCREMENT,
`msgfrom` char(15) NOT NULL DEFAULT '',
`msgnickname` char(15) NOT NULL DEFAULT '',
`msgfromid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`msgto` char(15) NOT NULL DEFAULT '',
`tonickname` char(15) NOT NULL DEFAULT '',
`msgtoid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`folder` enum('inbox','outbox') NOT NULL DEFAULT 'inbox',
`new` tinyint(1) NOT NULL DEFAULT '0',
`subject` varchar(75) NOT NULL DEFAULT '',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`imageids` char(100) NOT NULL default '',
`attachids` char(100) NOT NULL default '',
`message` text NOT NULL,
`delstatus` tinyint(1) unsigned NOT NULL DEFAULT '0',
`is_hi` tinyint(1) NOT NULL DEFAULT '0',
`topmid` int(11) NOT NULL DEFAULT '0',
`plid` mediumint(8) NOT NULL DEFAULT '0',
PRIMARY KEY (`pmid`),
KEY `msgtoid` (`msgtoid`,`folder`,`dateline`),
KEY `msgfromid` (`msgfromid`,`folder`,`dateline`),
KEY `dateline` (`dateline`),
KEY `plid` (`plid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_pms_index`;
CREATE TABLE `jishigou_pms_index` (
`plid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`uids` char(17) NOT NULL,
PRIMARY KEY (`plid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_pms_list`;
CREATE TABLE `jishigou_pms_list` (
`plid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`pmnum` int(10) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`lastmessage` text NOT NULL,
`is_new` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`plid`,`uid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qqwb_bind_info`;
CREATE TABLE `jishigou_qqwb_bind_info` (
`uid` mediumint(8) unsigned NOT NULL,
`qqwb_username` char(20) NOT NULL DEFAULT '',
`token` char(32) NOT NULL,
`tsecret` char(32) NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`synctoqq` tinyint(1) NOT NULL,
`last_read_time` int(10) unsigned NOT NULL,
`last_read_id` char(30) NOT NULL,
`sync_weibo_to_jishigou` tinyint(1) NOT NULL,
`sync_reply_to_jishigou` tinyint(1) NOT NULL,
`code` char(32) NOT NULL,
`openid` char(32) NOT NULL,
`openkey` char(32) NOT NULL,
`access_token` char(32) NOT NULL,
`refresh_token` char(32) NOT NULL,
`expires_in` int(10) unsigned NOT NULL,
`name` char(100) NOT NULL,
`nick` char(100) NOT NULL,
`state` char(100) NOT NULL,
`expires_time` int(10) unsigned NOT NULL,
`last_update` int(10) unsigned NOT NULL,
PRIMARY KEY (`uid`),
UNIQUE KEY `qqwb_username` (`qqwb_username`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qqwb_bind_topic`;
CREATE TABLE `jishigou_qqwb_bind_topic` (
`tid` int(10) unsigned NOT NULL,
`qqwb_id` bigint(20) unsigned NOT NULL,
`last_read_time` int(10) unsigned NOT NULL,
KEY `tid` (`tid`),
KEY `qqwb_id` (`qqwb_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qun`;
CREATE TABLE `jishigou_qun` (
`qid` int(10) unsigned NOT NULL AUTO_INCREMENT,
`cat_id` smallint(6) unsigned NOT NULL DEFAULT '0',
`name` char(50) NOT NULL,
`icon` char(100) NOT NULL,
`desc` char(200) NOT NULL,
`founderuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`foundername` char(15) NOT NULL,
`level` smallint(6) unsigned NOT NULL DEFAULT '0',
`credits` int(10) unsigned NOT NULL DEFAULT '0',
`province` char(16) NOT NULL,
`city` char(16) NOT NULL,
`recd` tinyint(1) unsigned NOT NULL DEFAULT '0',
`join_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
`gview_perm` tinyint(1) unsigned NOT NULL DEFAULT '0',
`member_num` mediumint(8) unsigned NOT NULL DEFAULT '0',
`topic_num` mediumint(8) unsigned NOT NULL DEFAULT '0',
`thread_num` mediumint(8) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`closed` tinyint(1) unsigned NOT NULL DEFAULT '0',
`qun_theme_id` char(6) NOT NULL DEFAULT '',
`postip` char(15) NOT NULL DEFAULT '0',
`lastactivity` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`qid`),
KEY `cat_id` (`cat_id`),
KEY `founderuid` (`founderuid`),
KEY `lastactivity` (`lastactivity`),
KEY `dateline` (`dateline`),
KEY `member_num` (`member_num`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qun_announcement`;
CREATE TABLE `jishigou_qun_announcement` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`author` char(15) NOT NULL,
`qid` int(10) unsigned NOT NULL DEFAULT '0',
`author_id` mediumint(9) unsigned NOT NULL DEFAULT '0',
`message` text NOT NULL,
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `qid` (`qid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qun_apply`;
CREATE TABLE `jishigou_qun_apply` (
`qid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`username` varchar(15) NOT NULL,
`message` varchar(255) NOT NULL,
`apply_time` int(10) unsigned NOT NULL,
PRIMARY KEY (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qun_category`;
CREATE TABLE `jishigou_qun_category` (
`cat_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
`cat_name` char(15) NOT NULL,
`qun_num` int(10) unsigned NOT NULL DEFAULT '0',
`parent_id` smallint(6) unsigned NOT NULL DEFAULT '0',
`display_order` smallint(6) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qun_event`;
CREATE TABLE `jishigou_qun_event` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`qid` int(10) unsigned NOT NULL DEFAULT '0',
`eid` int(10) NOT NULL DEFAULT '0',
`recd` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `q_e_id` (`qid`,`eid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qun_level`;
CREATE TABLE `jishigou_qun_level` (
`level_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
`level_name` char(20) NOT NULL,
`credits_higher` int(10) NOT NULL DEFAULT '0',
`credits_lower` int(10) NOT NULL DEFAULT '0',
`member_num` int(10) unsigned NOT NULL DEFAULT '0',
`admin_num` smallint(6) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`level_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qun_ploy`;
CREATE TABLE `jishigou_qun_ploy` (
`id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
`fans_num_min` int(10) unsigned NOT NULL DEFAULT '0',
`fans_num_max` int(10) unsigned NOT NULL DEFAULT '0',
`topics_higher` int(10) unsigned NOT NULL DEFAULT '0',
`topics_lower` int(10) unsigned NOT NULL DEFAULT '0',
`qun_num` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qun_tag`;
CREATE TABLE `jishigou_qun_tag` (
`tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tag_name` char(30) NOT NULL,
`count` mediumint(8) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qun_tag_fields`;
CREATE TABLE `jishigou_qun_tag_fields` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tag_id` int(10) unsigned NOT NULL DEFAULT '0',
`qid` int(10) unsigned NOT NULL DEFAULT '0',
`tag_name` char(30) NOT NULL,
PRIMARY KEY (`id`),
KEY `qid-tag_id` (`qid`,`tag_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qun_user`;
CREATE TABLE `jishigou_qun_user` (
`qid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`username` char(15) NOT NULL,
`level` tinyint(3) unsigned NOT NULL DEFAULT '0',
`join_time` int(10) unsigned NOT NULL DEFAULT '0',
`lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`qid`,`uid`),
KEY `uid` (`uid`),
KEY `join_time` (`join_time`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_qun_vote`;
CREATE TABLE `jishigou_qun_vote` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`qid` int(10) unsigned NOT NULL DEFAULT '0',
`vid` int(10) NOT NULL DEFAULT '0',
`recd` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `q_vid` (`qid`,`vid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_renren_bind_info`;
CREATE TABLE `jishigou_renren_bind_info` (
`uid` mediumint(8) unsigned NOT NULL,
`renren_uid` char(32) NOT NULL default '',
`renren_name` char(32) NOT NULL default '',
`renren_sex` char(10) NOT NULL default '',
`renren_star` char(10) NOT NULL default '',
`renren_headurl` char(64) NOT NULL default '',
`token` char(128) NOT NULL,
`token_time` int(10) NOT NULL,
`token_expire` int(10) NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY  (`uid`),
UNIQUE KEY `renren_uid` (`renren_uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_renren_bind_topic`;
CREATE TABLE `jishigou_renren_bind_topic` (
`tid` int(10) unsigned NOT NULL,
`renren_id` bigint(20) unsigned NOT NULL,
KEY `tid` (`tid`),
KEY `renren_id` (`renren_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_report`;
CREATE TABLE `jishigou_report` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) NOT NULL DEFAULT '0',
`username` char(15) NOT NULL DEFAULT '',
`ip` char(15) NOT NULL DEFAULT '',
`type` tinyint(1) NOT NULL DEFAULT '0',
`reason` tinyint(1) NOT NULL DEFAULT '0',
`content` text NOT NULL,
`tid` int(10) NOT NULL DEFAULT '0',
`dateline` int(10) NOT NULL DEFAULT '0',
`process_user` char(15) NOT NULL DEFAULT '',
`process_time` int(10) NOT NULL DEFAULT '0',
`process_result` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_robot`;
CREATE TABLE `jishigou_robot` (
`name` char(50) NOT NULL DEFAULT '',
`times` int(10) unsigned NOT NULL DEFAULT '0',
`first_visit` int(10) NOT NULL DEFAULT '0',
`last_visit` int(10) NOT NULL DEFAULT '0',
`agent` char(255) NOT NULL DEFAULT '',
`disallow` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`name`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_robot_ip`;
CREATE TABLE `jishigou_robot_ip` (
`ip` char(15) NOT NULL DEFAULT '',
`name` char(50) NOT NULL DEFAULT '',
`times` int(10) unsigned NOT NULL DEFAULT '0',
`first_visit` int(10) NOT NULL DEFAULT '0',
`last_visit` int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (`ip`),
KEY `name` (`name`),
KEY `times` (`times`),
KEY `last_visit` (`last_visit`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_robot_log`;
CREATE TABLE `jishigou_robot_log` (
`name` char(50) NOT NULL DEFAULT '',
`date` date NOT NULL DEFAULT '0000-00-00',
`times` int(10) unsigned NOT NULL DEFAULT '0',
`first_visit` int(10) unsigned NOT NULL DEFAULT '0',
`last_visit` int(10) unsigned NOT NULL DEFAULT '0',
UNIQUE KEY `date-name` (`date`,`name`),
KEY `name` (`name`),
KEY `times` (`times`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_role`;
CREATE TABLE `jishigou_role` (
`id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL DEFAULT '',
`creditshigher` int(10) NOT NULL DEFAULT '0',
`creditslower` int(10) NOT NULL DEFAULT '0',
`privilege` mediumtext NOT NULL,
`type` enum('normal','admin') NOT NULL DEFAULT 'normal',
`rank` tinyint(1) unsigned NOT NULL DEFAULT '0',
`icon` char(100) NOT NULL,
`allow_sendpm_to` text NOT NULL,
`allow_sendpm_from` text NOT NULL,
`allow_topic_forward_to` text NOT NULL,
`allow_topic_forward_from` text NOT NULL,
`allow_topic_reply_to` text NOT NULL,
`allow_topic_reply_from` text NOT NULL,
`allow_topic_at_to` text NOT NULL,
`allow_topic_at_from` text NOT NULL,
`allow_follow_to` text NOT NULL,
`allow_follow_from` text NOT NULL,
`system` tinyint(1) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_role_action`;
CREATE TABLE `jishigou_role_action` (
`id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(255) NOT NULL DEFAULT '',
`module` varchar(50) NOT NULL DEFAULT 'index',
`action` varchar(255) NOT NULL DEFAULT '',
`describe` varchar(255) NOT NULL DEFAULT '',
`message` varchar(255) NOT NULL DEFAULT '',
`allow_all` tinyint(1) NOT NULL DEFAULT '0',
`credit_require` varchar(255) NOT NULL DEFAULT '',
`credit_update` varchar(255) NOT NULL DEFAULT '',
`log` tinyint(1) unsigned NOT NULL DEFAULT '0',
`is_admin` tinyint(1) unsigned DEFAULT '0',
PRIMARY KEY (`id`),
UNIQUE KEY `action` (`module`,`name`,`is_admin`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_role_module`;
CREATE TABLE `jishigou_role_module` (
`module` varchar(50) NOT NULL DEFAULT '',
`name` varchar(255) NOT NULL DEFAULT '',
UNIQUE KEY `module` (`module`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_schedule`;
CREATE TABLE `jishigou_schedule` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`type` char(255) NOT NULL DEFAULT '',
`vars` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_sessions`;
CREATE TABLE `jishigou_sessions` (
`sid` char(6) NOT NULL DEFAULT '',
`ip1` tinyint(1) unsigned NOT NULL DEFAULT '0',
`ip2` tinyint(1) unsigned NOT NULL DEFAULT '0',
`ip3` tinyint(1) unsigned NOT NULL DEFAULT '0',
`ip4` tinyint(1) unsigned NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`action` smallint(4) unsigned NOT NULL DEFAULT '0',
`slastactivity` int(10) unsigned NOT NULL DEFAULT '0',
UNIQUE KEY `sid` (`sid`),
KEY `uid` (`uid`),
KEY `slastactivity` (`slastactivity`)
) ENGINE=HEAP;

DROP TABLE IF EXISTS `jishigou_setting`;
CREATE TABLE `jishigou_setting` (
`key` char(255) NOT NULL,
`val` text NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_share`;
CREATE TABLE `jishigou_share` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` char(50) NOT NULL,
`type` char(20) NOT NULL,
`topic_style` text NOT NULL,
`show_style` text NOT NULL,
`condition` text NOT NULL,
`nickname` char(255) NOT NULL,
`tag` char(255) NOT NULL,
`dateline` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_sign_tag`;
CREATE TABLE `jishigou_sign_tag` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tag` text NOT NULL,
`credits` char(20) NOT NULL DEFAULT '',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_site`;
CREATE TABLE `jishigou_site` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`host` char(50) NOT NULL,
`name` char(50) NOT NULL,
`description` char(255) NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`url_count` int(10) unsigned NOT NULL,
`status` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `host` (`host`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_sms_client_user`;
CREATE TABLE `jishigou_sms_client_user` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`username` char(30) NOT NULL DEFAULT '',
`user_im` char(20) NOT NULL DEFAULT '',
`bind_key` char(10) NOT NULL DEFAULT '',
`bind_key_time` int(10) unsigned NOT NULL DEFAULT '0',
`try_bind_times` int(10) unsigned NOT NULL DEFAULT '0',
`last_try_bind_time` int(10) unsigned NOT NULL DEFAULT '0',
`send_times` int(10) unsigned NOT NULL DEFAULT '0',
`last_send_time` int(10) unsigned NOT NULL DEFAULT '0',
`last_send_message_id` int(10) unsigned NOT NULL DEFAULT '0',
`stop_receive` tinyint(1) unsigned NOT NULL DEFAULT '0',
`receive_times` int(10) unsigned NOT NULL DEFAULT '0',
`last_receive_time` int(10) unsigned NOT NULL DEFAULT '0',
`last_receive_message_id` int(10) unsigned NOT NULL DEFAULT '0',
`reset_password_times` int(10) unsigned NOT NULL DEFAULT '0',
`last_reset_password_time` int(10) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`enable` tinyint(1) unsigned NOT NULL DEFAULT '1',
`t_enable` tinyint(1) unsigned NOT NULL DEFAULT '0',
`p_enable` tinyint(1) unsigned NOT NULL DEFAULT '0',
`m_enable` tinyint(1) unsigned NOT NULL DEFAULT '0',
`f_enable` tinyint(1) unsigned NOT NULL DEFAULT '0',
`share_time` int(10) unsigned NOT NULL DEFAULT '0',
`verify_key` char(10) NOT NULL DEFAULT '',
`verify_key_time` int(10) unsigned NOT NULL DEFAULT '0',
`try_verify_times` int(10) unsigned NOT NULL DEFAULT '0',
`last_try_verify_time` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `uid` (`uid`),
KEY `user_im` (`user_im`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_sms_failedlogins`;
CREATE TABLE `jishigou_sms_failedlogins` (
`ip` char(15) NOT NULL DEFAULT '',
`count` tinyint(1) unsigned NOT NULL DEFAULT '0',
`lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`ip`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_sms_receive_log`;
CREATE TABLE `jishigou_sms_receive_log` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL,
`username` char(15) NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`mobile` char(20) NOT NULL DEFAULT '',
`message` text NOT NULL,
`msg_id` char(20) NOT NULL,
`status` tinyint(1) NOT NULL,
`tid` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `dateline` (`dateline`),
KEY `uid` (`uid`),
KEY `mobile` (`mobile`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_sms_send_log`;
CREATE TABLE `jishigou_sms_send_log` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL,
`username` char(15) NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`mobile` char(20) NOT NULL DEFAULT '',
`message` text NOT NULL,
`msg_id` char(20) NOT NULL,
`status` tinyint(1) NOT NULL,
PRIMARY KEY (`id`),
KEY `dateline` (`dateline`),
KEY `uid` (`uid`),
KEY `mobile` (`mobile`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_sms_send_queue`;
CREATE TABLE `jishigou_sms_send_queue` (
`to` int(10) unsigned NOT NULL DEFAULT '0',
`message` text NOT NULL,
`salt` char(10) NOT NULL DEFAULT '',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
UNIQUE KEY `to` (`to`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_tag`;
CREATE TABLE `jishigou_tag` (
`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`name` char(30) NOT NULL DEFAULT '',
`user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`username` char(15) NOT NULL DEFAULT '',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`last_post` int(10) unsigned NOT NULL DEFAULT '0',
`total_count` int(10) unsigned NOT NULL DEFAULT '0',
`user_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
`topic_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
`tag_count` mediumint(8) NOT NULL DEFAULT '0',
`status` tinyint(1) NOT NULL DEFAULT '0',
`extra` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
UNIQUE KEY `name` (`name`),
KEY `total_count` (`total_count`),
KEY `last_post` (`last_post`),
KEY `user_id` (`user_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_tag_extra`;
CREATE TABLE `jishigou_tag_extra` (
`id` int(10) unsigned NOT NULL,
`name` char(50) NOT NULL,
`data` longtext NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_tag_favorite`;
CREATE TABLE `jishigou_tag_favorite` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tag` char(64) NOT NULL DEFAULT '',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `tag` (`tag`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_tag_recommend`;
CREATE TABLE `jishigou_tag_recommend` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`name` char(50) NOT NULL,
`desc` text NOT NULL,
`uid` mediumint(8) NOT NULL,
`username` char(30) NOT NULL,
`dateline` int(10) NOT NULL,
`last_update` int(10) NOT NULL,
`order` int(10) NOT NULL,
`enable` tinyint(1) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`),
KEY `order` (`order`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_talk`;
CREATE TABLE `jishigou_talk` (
`lid` int(11) NOT NULL AUTO_INCREMENT,
`cat_id` int(11) unsigned NOT NULL,
`talkname` varchar(60) NOT NULL,
`description` text NOT NULL,
`starttime` int(10) unsigned NOT NULL DEFAULT '0',
`endtime` int(10) unsigned NOT NULL DEFAULT '0',
`image` varchar(100) NOT NULL,
PRIMARY KEY (`lid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_talk_category`;
CREATE TABLE `jishigou_talk_category` (
`cat_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
`cat_name` char(15) NOT NULL,
`talk_num` int(10) unsigned NOT NULL DEFAULT '0',
`parent_id` smallint(6) unsigned NOT NULL DEFAULT '0',
`display_order` smallint(6) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_task`;
CREATE TABLE `jishigou_task` (
`id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
`available` tinyint(1) NOT NULL DEFAULT '0',
`type` enum('user','system') NOT NULL DEFAULT 'user',
`name` char(50) NOT NULL DEFAULT '',
`filename` char(50) NOT NULL DEFAULT '',
`lastrun` int(10) unsigned NOT NULL DEFAULT '0',
`nextrun` int(10) unsigned NOT NULL DEFAULT '0',
`weekday` tinyint(1) NOT NULL DEFAULT '0',
`day` tinyint(1) NOT NULL DEFAULT '0',
`hour` tinyint(1) NOT NULL DEFAULT '0',
`minute` char(36) NOT NULL DEFAULT '',
PRIMARY KEY (`id`),
KEY `nextrun` (`available`,`nextrun`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_task_log`;
CREATE TABLE `jishigou_task_log` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`task_id` int(10) unsigned NOT NULL DEFAULT '0',
`exec_time` float unsigned NOT NULL DEFAULT '0',
`message` text NOT NULL,
`error` int(10) NOT NULL DEFAULT '0',
`dateline` int(10) NOT NULL DEFAULT '0',
`ip` varchar(16) NOT NULL DEFAULT '0',
`username` varchar(15) NOT NULL DEFAULT '',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`agent` varchar(255) NOT NULL DEFAULT '',
PRIMARY KEY (`id`),
KEY `uid` (`uid`),
KEY `task_id` (`task_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic`;
CREATE TABLE `jishigou_topic` (
`tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`username` char(15) NOT NULL DEFAULT '',
`content` char(255) NOT NULL DEFAULT '',
`content2` char(255) NOT NULL DEFAULT '',
`imageid` char(100) NOT NULL DEFAULT '',
`videoid` int(10) unsigned NOT NULL DEFAULT '0',
`musicid` int(10) unsigned NOT NULL DEFAULT '0',
`longtextid` int(10) unsigned NOT NULL DEFAULT '0',
`attachid` char(100) NOT NULL DEFAULT '',
`roottid` int(10) unsigned NOT NULL DEFAULT '0',
`replys` smallint(4) unsigned NOT NULL DEFAULT '0',
`forwards` smallint(6) NOT NULL DEFAULT '0',
`totid` int(10) unsigned NOT NULL DEFAULT '0',
`touid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`tousername` char(15) NOT NULL DEFAULT '',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
`from` enum('web','wap','mobile','qq','msn','api','sina','qqwb','vote','qun','event','android','iphone','ipad','sms','androidpad','fenlei','wechat','reward') NOT NULL DEFAULT 'web',
`type` char(15) NOT NULL DEFAULT '',
`item_id` int(10) unsigned NOT NULL DEFAULT '0',
`item` char(15) NOT NULL DEFAULT '',
`postip` char(15) NOT NULL DEFAULT '',
`post_ip_port` char(6) NOT NULL DEFAULT '',
`managetype` tinyint(1) NOT NULL DEFAULT '0',
`digcounts` int(10) unsigned NOT NULL DEFAULT '0',
`lastdigtime` int(10) unsigned NOT NULL DEFAULT '0',
`lastdiguid` int(10) unsigned NOT NULL DEFAULT '0',
`lastdigusername` char(15) NOT NULL DEFAULT '',
`tag_count` smallint(4) unsigned NOT NULL default '0',
`tag` char(255) NOT NULL default '',
`recommend` tinyint(1) unsigned NOT NULL default '0',
`featureid` smallint(4) NOT NULL DEFAULT '0',
`relateid` int(10) NOT NULL DEFAULT '0',
`anonymous` tinyint(1) unsigned NOT NULL default '0',
PRIMARY KEY (`tid`),
KEY `uid_type` (`uid`,`type`),
KEY `dateline` (`dateline`),
KEY `lastdigtime` (`lastdigtime`),
KEY `managetype` (`managetype`),
KEY `item_id_item` (`item_id`,`item`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_api`;
CREATE TABLE `jishigou_topic_api` (
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`item_id` int(10) unsigned NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL,
PRIMARY KEY (`tid`,`item_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_table_id`;
CREATE TABLE `jishigou_topic_table_id` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tid` bigint(20) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `tid` (`tid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_attach`;
CREATE TABLE `jishigou_topic_attach` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tid` int(10) NOT NULL DEFAULT '0',
`site_url` char(255) NOT NULL DEFAULT '',
`file` char(255) NOT NULL DEFAULT '',
`name` char(255) NOT NULL DEFAULT '',
`description` char(255) NOT NULL DEFAULT '',
`filesize` int(10) unsigned NOT NULL DEFAULT '0',
`filetype` varchar(10) NOT NULL DEFAULT '',
`uid` mediumint(8) unsigned DEFAULT '0',
`username` char(15) NOT NULL DEFAULT '',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`file_url` char(255) NOT NULL DEFAULT '',
`item` char(100) NOT NULL DEFAULT '',
`itemid` int(10) unsigned NOT NULL DEFAULT '0',
`download` int(10) unsigned NOT NULL DEFAULT '0',
`score` int(10) unsigned NOT NULL DEFAULT '0',
`category` char(100) NOT NULL DEFAULT '',
PRIMARY KEY (`id`),
KEY `tid` (`tid`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_attach_category`;
CREATE TABLE `jishigou_attach_category` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` char(20) NOT NULL,
`parent_id` int(11) NOT NULL DEFAULT '0',
`upid` char(60) NOT NULL,
`order` int(11) NOT NULL DEFAULT '0',
`count_num` int(11) NOT NULL DEFAULT '0',
`total_count_num` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_event`;
CREATE TABLE `jishigou_topic_event` (
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`item_id` int(10) unsigned NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL,
PRIMARY KEY (`tid`,`item_id`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_favorite`;
CREATE TABLE `jishigou_topic_favorite` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`tuid` mediumint(10) unsigned NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
UNIQUE KEY `uid-tid` (`uid`,`tid`),
KEY `tuid` (`tuid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_image`;
CREATE TABLE `jishigou_topic_image` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tid` int(10) NOT NULL DEFAULT '0',
`site_url` char(255) NOT NULL DEFAULT '',
`photo` char(255) NOT NULL DEFAULT '',
`name` char(255) NOT NULL DEFAULT '',
`description` char(255) NOT NULL DEFAULT '',
`filesize` int(10) unsigned NOT NULL DEFAULT '0',
`width` smallint(4) unsigned NOT NULL DEFAULT '0',
`height` smallint(4) unsigned NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`username` char(15) NOT NULL DEFAULT '',
`item` char(100) NOT NULL DEFAULT '',
`itemid` int(10) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`image_url` char(255) NOT NULL,
`albumid` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `tid` (`tid`),
KEY `uid` (`uid`),
KEY `albumid` (`albumid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_album`;
CREATE TABLE `jishigou_album` (
`albumid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`albumname` varchar(50) NOT NULL default '',
`uid` mediumint(8) unsigned NOT NULL default '0',
`username` varchar(50) NOT NULL default '',
`dateline` int(10) unsigned NOT NULL default '0',
`picnum` smallint(6) unsigned NOT NULL default '0',
`pic` varchar(255) NOT NULL default '',
`depict` varchar(255) NOT NULL default '',
`purview` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`albumid`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_live`;
CREATE TABLE `jishigou_topic_live` (
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`item_id` int(10) unsigned NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL,
PRIMARY KEY (`tid`,`item_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_longtext`;
CREATE TABLE `jishigou_topic_longtext` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`username` char(15) NOT NULL DEFAULT '',
`longtext` longtext NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`last_modify` int(10) unsigned NOT NULL,
`modify_times` int(10) unsigned NOT NULL,
`views` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `tid` (`tid`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_mention`;
CREATE TABLE `jishigou_topic_mention` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`tuid` mediumint(8) unsigned NOT NULL default '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
UNIQUE KEY `uid-tid` (`uid`,`tid`),
KEY `tid` (`tid`),
KEY `tuid` (`tuid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_more`;
CREATE TABLE `jishigou_topic_more` (
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`parents` text NOT NULL,
`replyids` longtext NOT NULL,
`replyidscount` smallint(4) unsigned NOT NULL DEFAULT '0',
`diguids` longtext NOT NULL,
`longtext` longtext NOT NULL,
PRIMARY KEY (`tid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_music`;
CREATE TABLE `jishigou_topic_music` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) NOT NULL DEFAULT '0',
`tid` int(11) NOT NULL DEFAULT '0',
`username` varchar(50) NOT NULL DEFAULT '',
`music_url` varchar(255) NOT NULL DEFAULT '',
`dateline` int(11) NOT NULL DEFAULT '0',
`xiami_id` int(20) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `uid` (`uid`),
KEY `tid` (`tid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_qun`;
CREATE TABLE `jishigou_topic_qun` (
`tid` int(10) unsigned NOT NULL,
`item_id` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
PRIMARY KEY (`tid`,`item_id`),
KEY `uid` (`uid`),
KEY `item_id` (`item_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_recommend`;
CREATE TABLE `jishigou_topic_recommend` (
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`item` char(15) NOT NULL,
`item_id` int(10) unsigned NOT NULL DEFAULT '0',
`recd` tinyint(1) unsigned NOT NULL,
`display_order` smallint(6) unsigned NOT NULL DEFAULT '0',
`expiration` int(10) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`r_title` char(200) NOT NULL default '',
`r_uid` int(10) unsigned NOT NULL default '0',
`r_nickname` char(15) NOT NULL default '',
PRIMARY KEY (`tid`),
KEY `expiration` (`expiration`),
KEY `recd` (`recd`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_relation`;
CREATE TABLE `jishigou_topic_relation` (
`totid` int(11) unsigned NOT NULL,
`touid` mediumint(8) unsigned NOT NULL,
`tid` int(11) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`type` enum('reply','forward','both') NOT NULL DEFAULT 'reply',
`digcounts` int(10) unsigned NOT NULL,
`lastdigtime` int(10) unsigned NOT NULL,
PRIMARY KEY (`totid`,`tid`),
KEY `dateline` (`dateline`),
KEY `digcounts` (`digcounts`),
KEY `lastdigtime` (`lastdigtime`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_relation_table_id`;
CREATE TABLE `jishigou_topic_relation_table_id` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tid` bigint(20) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `tid` (`tid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_reply`;
CREATE TABLE `jishigou_topic_reply` (
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`replyid` int(10) unsigned NOT NULL DEFAULT '0',
KEY `tid` (`tid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_show`;
CREATE TABLE `jishigou_topic_show` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) NOT NULL DEFAULT '0',
`stylevalue` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_tag`;
CREATE TABLE `jishigou_topic_tag` (
`item_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`tag_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`count` mediumint(6) NOT NULL DEFAULT '0',
PRIMARY KEY (`item_id`,`tag_id`),
KEY `tag_id` (`tag_id`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_talk`;
CREATE TABLE `jishigou_topic_talk` (
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`item_id` int(10) unsigned NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`touid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`totid` int(10) unsigned NOT NULL DEFAULT '0',
`istop` tinyint(1) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`tid`,`item_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_url`;
CREATE TABLE `jishigou_topic_url` (
`tid` int(10) unsigned NOT NULL,
`item_id` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL,
PRIMARY KEY (`tid`,`item_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_verify`;
CREATE TABLE `jishigou_topic_verify` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tid` int(10) unsigned NOT NULL,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`username` char(15) NOT NULL DEFAULT '',
`content` char(255) NOT NULL DEFAULT '',
`content2` char(255) NOT NULL DEFAULT '',
`imageid` char(100) NOT NULL DEFAULT '',
`videoid` int(10) unsigned NOT NULL DEFAULT '0',
`musicid` int(10) unsigned NOT NULL DEFAULT '0',
`longtextid` int(10) unsigned NOT NULL DEFAULT '0',
`attachid` char(100) NOT NULL DEFAULT '',
`roottid` int(10) unsigned NOT NULL DEFAULT '0',
`replys` smallint(4) unsigned NOT NULL DEFAULT '0',
`forwards` smallint(6) NOT NULL DEFAULT '0',
`totid` int(10) unsigned NOT NULL DEFAULT '0',
`touid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`tousername` char(15) NOT NULL DEFAULT '',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
`from` enum('web','wap','mobile','qq','msn','api','sina','qqwb','vote','qun','event','android','iphone','ipad','sms','androidpad','fenlei','wechat','reward') NOT NULL DEFAULT 'web',
`type` char(15) NOT NULL DEFAULT '',
`item_id` int(10) unsigned NOT NULL DEFAULT '0',
`item` char(15) NOT NULL DEFAULT '',
`postip` char(15) NOT NULL DEFAULT '',
`post_ip_port` char(6) NOT NULL DEFAULT '',
`managetype` tinyint(1) NOT NULL DEFAULT '0',
`digcounts` int(10) unsigned NOT NULL DEFAULT '0',
`lastdigtime` int(10) unsigned NOT NULL DEFAULT '0',
`lastdiguid` int(10) unsigned NOT NULL DEFAULT '0',
`lastdigusername` char(15) NOT NULL DEFAULT '',
`tag_count` smallint(4) unsigned NOT NULL default '0',
`tag` char(255) NOT NULL default '',
`recommend` tinyint(1) unsigned NOT NULL default '0',
`featureid` smallint(4) NOT NULL DEFAULT '0',
`relateid` int(10) NOT NULL DEFAULT '0',
`anonymous` tinyint(1) unsigned NOT NULL default '0',
PRIMARY KEY (`id`),
KEY (`tid`),
KEY `uid_type` (`uid`,`type`),
KEY `dateline` (`dateline`),
KEY `lastdigtime` (`lastdigtime`),
KEY `managetype` (`managetype`),
KEY `item_id_item` (`item_id`,`item`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_video`;
CREATE TABLE `jishigou_topic_video` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) NOT NULL DEFAULT '0',
`tid` int(11) NOT NULL DEFAULT '0',
`username` varchar(50) NOT NULL DEFAULT '',
`video_hosts` varchar(255) NOT NULL DEFAULT '',
`video_link` varchar(255) NOT NULL DEFAULT '',
`video_url` varchar(255) NOT NULL DEFAULT '',
`video_img_url` varchar(255) NOT NULL DEFAULT '',
`video_img` varchar(255) NOT NULL DEFAULT '',
`dateline` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `tid` (`tid`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_vote`;
CREATE TABLE `jishigou_topic_vote` (
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`item_id` int(10) unsigned NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL,
PRIMARY KEY (`tid`,`item_id`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_url`;
CREATE TABLE `jishigou_url` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`key` varchar(10) COLLATE gbk_bin NOT NULL DEFAULT '',
`url` text NOT NULL,
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`open_times` mediumint(8) unsigned NOT NULL DEFAULT '0',
`url_hash` char(32) NOT NULL DEFAULT '',
`title` varchar(100) NOT NULL,
`description` varchar(255) NOT NULL,
`site_id` int(10) unsigned NOT NULL,
`status` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
UNIQUE KEY `url_hash` (`url_hash`),
UNIQUE KEY `key` (`key`),
KEY `dateline` (`dateline`),
KEY `open_times` (`open_times`),
KEY `site_id` (`site_id`),
FULLTEXT KEY `url` (`url`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_user_medal`;
CREATE TABLE `jishigou_user_medal` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) NOT NULL,
`nickname` char(50) NOT NULL,
`medalid` int(11) NOT NULL,
`is_index` tinyint(4) NOT NULL DEFAULT '1',
`dateline` int(11) NOT NULL,
PRIMARY KEY (`id`),
KEY `uidmedalid` (`uid`,`medalid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_user_tag`;
CREATE TABLE `jishigou_user_tag` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` char(30) NOT NULL DEFAULT '',
`count` int(11) NOT NULL DEFAULT '0',
`type` char(20) NOT NULL DEFAULT '',
`dateline` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `name` (`name`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_user_tag_fields`;
CREATE TABLE `jishigou_user_tag_fields` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`tag_id` int(11) NOT NULL DEFAULT '0',
`uid` mediumint(8) NOT NULL DEFAULT '0',
`tag_name` char(50) NOT NULL DEFAULT '',
PRIMARY KEY (`id`),
KEY `uid` (`uid`),
KEY `tag_id` (`tag_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_validate_category`;
CREATE TABLE `jishigou_validate_category` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`category_id` int(10) NOT NULL DEFAULT '0',
`category_name` char(20) NOT NULL,
`category_pic` char(200) NOT NULL,
`num` tinyint(4) NOT NULL DEFAULT '0',
`dateline` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_validate_category_fields`;
CREATE TABLE `jishigou_validate_category_fields` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) NOT NULL,
`category_fid` int(10) NOT NULL,
`category_id` int(10) NOT NULL,
`province` char(20) NOT NULL,
`city` char(20) NOT NULL,
`validate_info` char(200) NOT NULL,
`is_audit` tinyint(1) NOT NULL DEFAULT '0',
`audit_info` char(200) NOT NULL,
`order` int(10) NOT NULL,
`is_push` tinyint(1) NOT NULL DEFAULT '0',
`dateline` int(10) NOT NULL,
PRIMARY KEY (`id`),
KEY `uid` (`uid`),
KEY `category_fid` (`category_fid`),
KEY `category_id` (`category_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_validate_extra`;
CREATE TABLE `jishigou_validate_extra` (
`id` int(10) NOT NULL,
`data` longtext NOT NULL
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_vote`;
CREATE TABLE `jishigou_vote` (
`vid` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`username` char(15) NOT NULL,
`subject` char(80) NOT NULL,
`voter_num` mediumint(8) unsigned NOT NULL DEFAULT '0',
`reply_num` mediumint(8) unsigned NOT NULL DEFAULT '0',
`maxchoice` tinyint(3) unsigned NOT NULL DEFAULT '0',
`multiple` tinyint(1) unsigned NOT NULL DEFAULT '0',
`is_view` tinyint(1) unsigned NOT NULL DEFAULT '1',
`recd` tinyint(1) unsigned NOT NULL DEFAULT '0',
`expiration` int(10) unsigned NOT NULL DEFAULT '0',
`lastvote` int(10) unsigned NOT NULL DEFAULT '0',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`postip` char(15) NOT NULL DEFAULT '',
`item` char(15) NOT NULL DEFAULT '',
`item_id` int(10) NOT NULL DEFAULT '0',
`verify` tinyint(1) NOT NULL DEFAULT '1',
`tab` tinyint(1) NOT NULL default '0',
`time_val` int(10) unsigned NOT NULL DEFAULT '0',
`time_unit` enum('s','i','h','d','m','y') NOT NULL DEFAULT 'h',
`vote_limit` tinyint(1) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`vid`),
KEY `uid` (`uid`),
KEY `dateline` (`dateline`),
KEY `lastvote` (`lastvote`),
KEY `voter_num` (`voter_num`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_vote_image`;
CREATE TABLE `jishigou_vote_image` (
`id` int(10) NOT NULL auto_increment,
`uid` mediumint(8) NOT NULL default '0',
`vid` int(10) NOT NULL default '0',
`picurl` char(255) NOT NULL,
`picurl_big` char(255) NOT NULL,
`dateline` int(10) unsigned NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `vid` (`vid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_vote_field`;
CREATE TABLE `jishigou_vote_field` (
`vid` int(10) unsigned NOT NULL,
`message` text NOT NULL,
`option` text NOT NULL,
`img` char(250) NOT NULL DEFAULT '',
PRIMARY KEY (`vid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_vote_option`;
CREATE TABLE `jishigou_vote_option` (
`oid` int(10) unsigned NOT NULL AUTO_INCREMENT,
`vid` int(10) unsigned NOT NULL DEFAULT '0',
`vote_num` mediumint(8) unsigned NOT NULL DEFAULT '0',
`option` varchar(100) NOT NULL,
`pid` int(10) NOT NULL default '0',
PRIMARY KEY (`oid`),
KEY `vid` (`vid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_vote_user`;
CREATE TABLE `jishigou_vote_user` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL,
`username` varchar(50) NOT NULL,
`vid` int(10) unsigned NOT NULL,
`option` text NOT NULL,
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`follow_vote` tinyint(1) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `uid_vid` (`uid`,`vid`),
KEY `dateline` (`dateline`),
KEY `username` (`username`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_vote_user_lottery`;
CREATE TABLE `jishigou_vote_user_lottery` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`vid` int(10) unsigned NOT NULL DEFAULT '0',
`uids` text NOT NULL,
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`option` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_wall`;
CREATE TABLE `jishigou_wall` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL,
`status` tinyint(1) unsigned NOT NULL DEFAULT '1',
`show_mod` tinyint(1) NOT NULL,
`wall_reload_time` tinyint(1) unsigned NOT NULL DEFAULT '5',
`last_load_time` int(10) unsigned NOT NULL,
`last_load_tid` int(10) unsigned NOT NULL,
`auto_wall_tid` int(10) unsigned NOT NULL,
`auto_wall_tag` char(255) NOT NULL,
`screen_ad_top` text NOT NULL,
`screen_ad_left` text NOT NULL,
`screen_ad_right` text NOT NULL,
PRIMARY KEY (`id`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_wall_draft`;
CREATE TABLE `jishigou_wall_draft` (
`wall_id` int(10) unsigned NOT NULL,
`tid` int(10) unsigned NOT NULL,
`mark` tinyint(1) unsigned NOT NULL,
PRIMARY KEY (`wall_id`,`tid`,`mark`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_wall_material`;
CREATE TABLE `jishigou_wall_material` (
`wall_id` int(10) unsigned NOT NULL,
`type` tinyint(1) unsigned NOT NULL,
`key` char(255) NOT NULL,
PRIMARY KEY (`wall_id`,`type`,`key`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_wall_playlist`;
CREATE TABLE `jishigou_wall_playlist` (
`wall_id` int(10) unsigned NOT NULL,
`tid` int(10) unsigned NOT NULL,
`order` int(10) unsigned NOT NULL,
PRIMARY KEY (`wall_id`,`tid`),
KEY `order` (`order`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_xwb_bind_info`;
CREATE TABLE `jishigou_xwb_bind_info` (
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`sina_uid` bigint(20) unsigned NOT NULL DEFAULT '0',
`token` char(32) NOT NULL DEFAULT '',
`tsecret` char(32) NOT NULL DEFAULT '',
`profile` text NOT NULL,
`share_time` int(10) NOT NULL DEFAULT '0',
`last_read_time` int(10) unsigned NOT NULL DEFAULT '0',
`last_read_id` bigint(20) unsigned NOT NULL DEFAULT '0',
`name` char(100) NOT NULL,
`screen_name` char(100) NOT NULL,
`domain` char(100) NOT NULL,
`avatar_large` char(100) NOT NULL,
`access_token` char(32) NOT NULL,
`expires_in` int(10) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL,
`last_pm_time` int(10) unsigned NOT NULL,
PRIMARY KEY (`uid`),
UNIQUE KEY `sina_uid` (`sina_uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_xwb_bind_topic`;
CREATE TABLE `jishigou_xwb_bind_topic` (
`tid` bigint(20) unsigned NOT NULL DEFAULT '0',
`mid` char(50) NOT NULL DEFAULT '',
`last_read_time` int(10) unsigned NOT NULL DEFAULT '0',
KEY `tid` (`tid`),
KEY `mid` (`mid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_yy_bind_info`;
CREATE TABLE `jishigou_yy_bind_info` (
`uid` mediumint(8) unsigned NOT NULL,
`yy_uid` char(32) NOT NULL default '',
`yy_no` char(32) NOT NULL,
`yy_nick` char(64) NOT NULL,
`yy_email` char(64) NOT NULL,
`yy_real_id` char(32) NOT NULL,
`yy_real_name` char(64) NOT NULL,
`token` char(32) NOT NULL,
`token_time` int(10) NOT NULL,
`token_expire` int(10) NOT NULL,
`dateline` int(10) unsigned NOT NULL,
PRIMARY KEY  (`uid`),
UNIQUE KEY `yy_uid` (`yy_uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_reward`;
CREATE TABLE `jishigou_reward` (
`id` int(10) unsigned NOT NULL auto_increment,
`tid` int(10) unsigned NOT NULL default '0',
`uid` mediumint(8) unsigned NOT NULL default '0',
`event_image` int(10) unsigned default '0',
`title` char(50) NOT NULL default '',
`fromt` int(10) unsigned NOT NULL default '0',
`tot` int(10) unsigned NOT NULL default '0',
`content` text NOT NULL,
`prize` text NOT NULL,
`rules` text NOT NULL,
`image` int(10) NOT NULL default '0',
`posttime` int(10) unsigned NOT NULL default '0',
`postip` int(10) unsigned NOT NULL default '0',
`recd` tinyint(1) NOT NULL default '0',
`verify` tinyint(1) NOT NULL default '1',
`f_num` int(10) unsigned NOT NULL default '0',
`a_num` int(10) unsigned NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `uid` (`uid`,`posttime`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_reward`;
CREATE TABLE `jishigou_topic_reward` (
`tid` int(10) unsigned NOT NULL default '0',
`item_id` int(10) unsigned NOT NULL default '0',
`uid` mediumint(8) unsigned NOT NULL,
PRIMARY KEY  (`tid`,`item_id`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_reward_win_user`;
CREATE TABLE `jishigou_reward_win_user` (
`id` int(10) unsigned NOT NULL auto_increment,
`uid` mediumint(8) unsigned NOT NULL,
`rid` int(10) unsigned NOT NULL default '0',
`pid` int(3) unsigned NOT NULL,
`dateline` int(10) unsigned NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `uid` (`uid`),
KEY `rid` (`rid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_reward_image`;
CREATE TABLE `jishigou_reward_image` (
`id` int(10) unsigned NOT NULL auto_increment,
`uid` mediumint(8) unsigned NOT NULL default '0',
`rid` int(10) unsigned NOT NULL default '0',
`image` char(255) NOT NULL default '',
PRIMARY KEY  (`id`),
KEY `rid` (`rid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_reward_user`;
CREATE TABLE `jishigou_reward_user` (
`id` int(10) unsigned NOT NULL auto_increment,
`uid` mediumint(8) unsigned NOT NULL,
`tid` int(10) unsigned NOT NULL default '0',
`rid` int(10) unsigned NOT NULL default '0',
`on` tinyint(1) NOT NULL default '0',
`dateline` int(10) unsigned NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;





DROP TABLE IF EXISTS `jishigou_bulletin`;
CREATE TABLE `jishigou_bulletin` (
`id` int(10) unsigned NOT NULL auto_increment,
`type` tinyint(3) NOT NULL default '0',
`cpid` int(10) unsigned NOT NULL default '0',
`uid` mediumint(8) unsigned NOT NULL default '0',
`username` char(100) NOT NULL default '',
`message` text NOT NULL,
`dateline` int(10) unsigned NOT NULL default '0',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_ad`;
CREATE TABLE `jishigou_ad` (
`adid` int(10) unsigned NOT NULL auto_increment,
`location` char(20) NOT NULL default '',
`title` char(100) NOT NULL default '',
`type` tinyint(1) NOT NULL default '1',
`ftime` int(10) NOT NULL default '0',
`ttime` int(10) NOT NULL default '0',
`hcode` text NOT NULL,
PRIMARY KEY  (`adid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_feed_log`;
CREATE TABLE `jishigou_feed_log` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` int(10) NOT NULL DEFAULT '0',
`nickname` char(50) NOT NULL DEFAULT '',
`item` char(30) NOT NULL DEFAULT '',
`item_id` int(10) NOT NULL DEFAULT '0',
`tid` int(10) NOT NULL DEFAULT '0',
`action` char(20) NOT NULL DEFAULT '',
`msg` char(200) NOT NULL DEFAULT '',
`dateline` int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_channel`;
CREATE TABLE `jishigou_channel` (
`ch_id` smallint(6) unsigned NOT NULL auto_increment,
`ch_name` char(15) NOT NULL default '',
`feed` tinyint(1) NOT NULL DEFAULT '0',
`recommend` tinyint(1) NOT NULL DEFAULT '0',
`topic_num` int(10) unsigned NOT NULL default '0',
`total_topic_num` int(10) unsigned NOT NULL default '0',
`parent_id` smallint(6) unsigned NOT NULL default '0',
`description` text NOT NULL,
`purview` text NOT NULL,
`purpostview` text NOT NULL,
`verify` tinyint(1) NOT NULL default '0',
`filter` text NOT NULL,
`display_order` smallint(6) unsigned NOT NULL default '0',
`display_list` varchar(4) NOT NULL,
`display_view` varchar(4) NOT NULL,
`in_home` tinyint(1) unsigned NOT NULL default '0',
`picture` char(200) NOT NULL default '',
`buddy_numbers` int(10) unsigned NOT NULL default '0',
`manageid` char(200) NOT NULL DEFAULT '',
`managename` char(250) NOT NULL DEFAULT '',
`template` char(50) NOT NULL DEFAULT '',
`channel_typeid` smallint(4) NOT NULL DEFAULT '0',
`topictype` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY  (`ch_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_channel`;
CREATE TABLE `jishigou_topic_channel` (
`tid` int(10) unsigned NOT NULL default '0',
`item_id` int(10) unsigned NOT NULL default '0',
`uid` mediumint(8) unsigned NOT NULL,
PRIMARY KEY  (`tid`,`item_id`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_buddy_channel`;
CREATE TABLE `jishigou_buddy_channel` (
`id` int(10) NOT NULL auto_increment,
`uid` mediumint(8) unsigned NOT NULL,
`ch_id` int(10) unsigned NOT NULL,
PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_feature`;
CREATE TABLE `jishigou_feature` (
`featureid` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
`featurename` char(100) NOT NULL DEFAULT '',
PRIMARY KEY (`featureid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_job`;
CREATE TABLE `jishigou_job` (
`jobid` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
`jobname` char(100) NOT NULL DEFAULT '',
PRIMARY KEY (`jobid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_channel_type`;
CREATE TABLE `jishigou_channel_type` (
`channel_typeid` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
`channel_type` char(20) NOT NULL DEFAULT '',
`channel_typename` char(100) NOT NULL DEFAULT '',
`template` char(100) NOT NULL DEFAULT '',
`child_template` char(100) NOT NULL,
`topic_template` char(100) NOT NULL,
`featureid` char(250) NOT NULL DEFAULT '',
`default_feature` char(100) NOT NULL DEFAULT '',
PRIMARY KEY (`channel_typeid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cms_category`;
CREATE TABLE `jishigou_cms_category` (
`catid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
`catname` char(50) NOT NULL DEFAULT '',
`articles` int(10) unsigned NOT NULL DEFAULT '0',
`parentid` smallint(6) unsigned NOT NULL DEFAULT '0',
`upid` char(200) NOT NULL DEFAULT '0',
`likecatid` char(200) NOT NULL DEFAULT '0',
`description` varchar(250) NOT NULL DEFAULT '',
`purview` char(250) NOT NULL DEFAULT '',
`verify` tinyint(1) NOT NULL DEFAULT '0',
`filter` char(250) NOT NULL DEFAULT '',
`displayorder` smallint(6) unsigned NOT NULL DEFAULT '0',
`manageid` char(200) NOT NULL DEFAULT '',
`managename` char(250) NOT NULL DEFAULT '',
`template` char(50) NOT NULL DEFAULT '',
PRIMARY KEY (`catid`),
KEY `parentid` (`parentid`),
KEY `likecatid` (`likecatid`),
KEY `displayorder` (`displayorder`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cms_article`;
CREATE TABLE `jishigou_cms_article` (
`aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
`catid` smallint(6) unsigned NOT NULL DEFAULT '0',
`likecatid` char(200) NOT NULL DEFAULT '0',
`title` char(200) NOT NULL DEFAULT '',
`description` char(250) NOT NULL DEFAULT '',
`content` text,
`uid` mediumint(8) NOT NULL DEFAULT '0',
`username` char(50) NOT NULL DEFAULT '',
`imageid` char(100) NOT NULL DEFAULT '',
`attachid` char(100) NOT NULL DEFAULT '',
`dateline` int(10) NOT NULL DEFAULT '0',
`lastupdate` int(10) NOT NULL DEFAULT '0',
`check` tinyint(1) NOT NULL DEFAULT '0',
`checkname` char(50) NOT NULL DEFAULT '',
`checktime` int(10) NOT NULL DEFAULT '0',
`replys` smallint(4) NOT NULL DEFAULT '0',
`likemanageid` char(200) NOT NULL DEFAULT '',
PRIMARY KEY (`aid`),
KEY `likecatid` (`likecatid`),
KEY `likemanageid` (`likemanageid`),
KEY `check` (`check`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_cms_reply`;
CREATE TABLE `jishigou_cms_reply` (
`rid` int(10) unsigned NOT NULL AUTO_INCREMENT,
`aid` int(10) unsigned NOT NULL DEFAULT '0',
`content` char(250) NOT NULL DEFAULT '',
`uid` mediumint(8) NOT NULL DEFAULT '0',
`username` char(50) NOT NULL DEFAULT '',
`dateline` int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (`rid`),
KEY `aid` (`aid`),
KEY `dateline` (`dateline`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_dig`;
CREATE TABLE `jishigou_topic_dig` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`tid` int(10) UNSIGNED NOT NULL default '0',
`uid` mediumint(8) UNSIGNED NOT NULL default '0',
`touid` int(10) UNSIGNED NOT NULL default '0',
`dateline` int(10) unsigned NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `tid` (`tid`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_members_vest`;
CREATE TABLE `jishigou_members_vest` (
`uid` mediumint(8) unsigned NOT NULL,
`useruid` mediumint(8) unsigned NOT NULL,
PRIMARY KEY  (`uid`,`useruid`),
KEY `useruid` (`useruid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_wechat`;
CREATE TABLE `jishigou_wechat` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`wechat_id` char(60) NOT NULL,
`jsg_id` int(11) NOT NULL,
`dateline` INT(10) UNSIGNED NOT NULL,
PRIMARY KEY (`id`),
KEY `wechat_id` (`wechat_id`),
KEY `jsg_id` (`jsg_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_mall_goods`;
CREATE TABLE `jishigou_mall_goods` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL,
`sn` char(30) NOT NULL,
`name` char(200) NOT NULL,
`price` int(10) unsigned NOT NULL,
`credit` int(10) unsigned NOT NULL,
`desc` text NOT NULL,
`image` char(200) NOT NULL,
`dateline` int(10) NOT NULL,
`last_uid` int(10) unsigned NOT NULL,
`last_update` int(10) NOT NULL,
`total` int(10) unsigned NOT NULL,
`order_count` int(10) unsigned NOT NULL,
`seal_count` int(10) unsigned NOT NULL,
`click_count` int(10) unsigned NOT NULL,
`order` int(10) unsigned NOT NULL DEFAULT '100',
`expire` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_mall_order`;
CREATE TABLE `jishigou_mall_order` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`sn` CHAR(30) NOT NULL,
`uid` INT(10) UNSIGNED NOT NULL,
`username` varchar(50) NOT NULL DEFAULT '',
`goods_id` INT(10) UNSIGNED NOT NULL,
`goods_name` varchar(100) NOT NULL DEFAULT '',
`goods_num` INT(10) UNSIGNED NOT NULL,
`goods_price` DECIMAL(10,2) NOT NULL,
`goods_credit` INT(10) UNSIGNED NOT NULL,
`pay_price` DECIMAL(10,2) NOT NULL,
`pay_credit` INT(10) UNSIGNED NOT NULL,
`address` CHAR(250) NOT NULL,
`tel` CHAR(100) NOT NULL,
`qq` CHAR(100) NOT NULL,
`mobile` CHAR(100) NOT NULL,
`add_time` INT(10) UNSIGNED NOT NULL,
`confirm_time` INT(10) UNSIGNED NOT NULL,
`pay_time` INT(10) UNSIGNED NOT NULL,
`status` TINYINT(1) UNSIGNED NOT NULL,
PRIMARY KEY (`id`),
KEY `status` (`status`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_mall_order_action`;
CREATE TABLE `jishigou_mall_order_action` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`uid` INT(10) UNSIGNED NOT NULL,
`order_id` INT(10) UNSIGNED NOT NULL,
`status` TINYINT(1) UNSIGNED NOT NULL,
`msg` CHAR(250) NOT NULL,
`dateline` INT(10) UNSIGNED NOT NULL,
PRIMARY KEY (`id`),
KEY `status` (`status`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_login_log`;
CREATE TABLE `jishigou_login_log` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` int(10) unsigned NOT NULL,
`user_nickname` char(100) NOT NULL,
`ip` char(15) NOT NULL,
`ip_port` char(6) DEFAULT NULL,
`dateline` int(11) NOT NULL,
`time` char(30) NOT NULL,
`type` char(100) NOT NULL,
PRIMARY KEY (`id`),
KEY `time` (`time`),
KEY `ip` (`ip`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_topic_image`;
CREATE TABLE `jishigou_topic_topic_image` (
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`item_id` int(10) unsigned NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`tid`,`item_id`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_topic_mall`;
CREATE TABLE `jishigou_topic_mall` (
`tid` int(10) unsigned NOT NULL DEFAULT '0',
`item_id` int(10) unsigned NOT NULL DEFAULT '0',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`tid`,`item_id`),
KEY `uid` (`uid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `jishigou_ios`;
CREATE TABLE `jishigou_ios` (
`id` bigint(20) NOT NULL AUTO_INCREMENT,
`uid` mediumint(8) unsigned NOT NULL,
`token` varchar(64) NOT NULL,
PRIMARY KEY (`id`),
KEY `token` (`token`)
) ENGINE=MyISAM;

REPLACE INTO `jishigou_role`(`id`,`name`,`creditshigher`,`creditslower`,`privilege`,`type`,`rank`,`icon`,`allow_sendpm_to`,`allow_sendpm_from`,`allow_topic_forward_to`,`allow_topic_forward_from`,`allow_topic_reply_to`,`allow_topic_reply_from`,`allow_topic_at_to`,`allow_topic_at_from`,`allow_follow_to`,`allow_follow_from`,`system`) values (1,'�ο�',0,0,'273,274,275,281,282,283,284,285,286,288,289,290,291,292,293,295,297,299,300,303,448,472','normal',0,'','','','','','','','','','','',1),(2,'����Ա',0,0,'7,8,9,11,13,84,88,90,91,92,93,101,102,106,107,108,111,115,123,125,126,132,133,134,135,136,137,138,139,154,158,159,169,172,176,182,183,184,186,187,188,189,190,191,192,193,194,195,196,197,198,200,201,202,204,205,206,208,210,211,212,213,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,267,268,269,270,271,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,304,305,306,307,308,311,315,317,318,319,320,321,323,324,325,327,328,329,330,340,361,363,374,375,376,377,378,379,380,381,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,400,401,403,404,405,406,407,408,409,410,411,412,413,415,416,417,418,419,420,421,422,424,425,426,427,428,429,430,431,432,435,443,445,446,447,448,449,450,451,452,456,461,464,466,470,471,472,474,475,476,477,478,479,480,481,482,483,484,485,486,487,488,489,490,492,493,494,495,496,497,502,503,504,505,506,507,508,509,510,511,512,513,514,516,517,518,519,520,521,523,524,525,526,527,528,529,530,531,533,534,535,536,537,538,539,540,541,542,543,544,545,546,547,548,551,553,554,561,566,567,570,571,572,573,574,575,576,577,578,579,580,581,582,583,584,585,586,587,588,589,590,591,592,593,594,595,596,597,598,599,600,601,602,603,604,605,606,607,608,609,610,611,612,613,614,615,616,617,618,619,620,621,622,623,624,625,626,627,628,629','admin',0,'./images/role/2.gif','0','','0','','0','','0','','0','',1),(3,'��ͨ��Ա',0,20,'7,176,193,194,195,196,197,198,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,448,472','normal',0,'./images/role/3.gif','0','','0','','0','','0','','0','',1),(4,'������',0,0,'','normal',0,'./images/role/4.gif','0','','0','','0','','0','','0','',1),(5,'����֤��Ա',0,0,'273,274,275,281,282,283,284,285,288,289,290,291,292,293,294,295,297,299,300,303,448,472','normal',0,'./images/role/5.gif','0','','0','','0','','0','','0','',1),(7,'��̨�鿴',0,0,'7,8,11,13,88,92,125,126,133,135,137,158,176,193,194,195,196,197,198,200,202,205,211,213,215,216,217,218,219,220,221,222,223,226,228,230,235,236,238,241,246,250,251,252,253,254,255,264,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,304,305,306,311,315,319,323,330,340,361,374,377,378,379,380,381,382,383,384,386,387,388,391,392,393,394,395,401,403,404,405,406,407,410,411,413,418,421,424,425,429,435,443,446,447,448,449,450,470,471,472,474,477,478,481,484,486,488,492,497,502,503,504,505,506,507,508,509,510,511,512,513,514,516,517,518,519,520,521,523','admin',0,'','0','','0','','0','','0','','0','',1),(118,'���',0,0,'','normal',0,'./images/role/108.gif','','','','','','','','','','',1),(108,'LV1��Ա',20,300,'7,176,193,194,195,196,197,198,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,377,378,448,472','normal',1,'','0','','0','','0','','0','','0','',1),(109,'LV2��Ա',300,1000,'7,176,193,194,195,196,197,198,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,330,340,377,378,447,448,471,472','normal',2,'','0','','0','','0','','0','','0','',1),(110,'LV3��Ա',1000,3000,'7,176,193,194,195,196,197,198,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,330,340,377,378,447,448,471,472','normal',3,'','','','','','','','','','','',1),(111,'LV4��Ա',3000,6000,'7,176,193,194,195,196,197,198,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,330,340,377,378,447,448,471,472','normal',4,'','','','','','','','','','','',1),(112,'LV5��Ա',6000,12000,'7,176,193,194,195,196,197,198,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,330,340,377,378,447,448,471,472','normal',5,'','','','','','','','','','','',1),(113,'LV6��Ա',12000,20000,'7,176,193,194,195,196,197,198,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,330,340,377,378,447,448,471,472','normal',6,'','','','','','','','','','','',1),(114,'LV7��Ա',20000,30000,'7,176,193,194,195,196,197,198,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,330,340,377,378,447,448,471,472','normal',7,'','','','','','','','','','','',1),(115,'LV8��Ա',30000,45000,'7,176,193,194,195,196,197,198,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,330,340,377,378,447,448,471,472','normal',8,'','','','','','','','','','','',1),(116,'LV9��Ա',45000,60000,'7,176,193,194,195,196,197,198,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,330,340,377,378,447,448,471,472','normal',9,'','','','','','','','','','','',1),(117,'LV10��Ա',60000,0,'7,176,193,194,195,196,197,198,273,274,275,276,281,282,283,284,285,286,288,289,290,291,292,293,294,295,296,297,298,299,300,302,303,330,340,377,378,447,448,471,472','normal',10,'','','','','','','','','','','',1);
REPLACE INTO `jishigou_role_action`(`id`,`name`,`module`,`action`,`describe`,`message`,`allow_all`,`credit_require`,`credit_update`,`log`,`is_admin`) values (7,'����΢��','topic','add|do_add','','',0,'','',0,0),(8,'�鿴��ɫ�б�','role','list','','',0,'','',0,1),(9,'�޸Ľ�ɫȨ��','role','domodify','','',0,'','',0,1),(11,'���ж����б�','role_action','list','','',0,'','',0,1),(13,'�鿴��������','setting','modify_normal','','',0,'','',0,1),(84,'�޸�������������','link','domodify','','',0,'','',0,1),(88,'�����̨','index','*','','',0,'','',0,1),(90,'�ύ���ݿⱸ��','db','doexport','','',0,'','',0,1),(91,'�޸ĺ�������','setting','domodify_normal','','',0,'','',0,1),(92,'�鿴URL��ַ����','setting','modify_rewrite','','',0,'','',0,1),(93,'�޸�URL��ַ����','setting','domodify_rewrite','','',0,'','',0,1),(101,'�޸Ķ�������','role_action','domodify','','',0,'','',0,1),(102,'ɾ������','role_action','delete','','',0,'','',0,1),(106,'�޸Ľ�����ʾ����','show','domodify','','',0,'','',0,1),(107,'��ѹ�����ݱ��ݰ�','db','importzip','','',0,'','',0,1),(108,'����֩��ͳ��','robot','domodify','','',0,'','',0,1),(111,'�޸����ݹ�������','setting','domodify_filter','','',0,'','',0,1),(115,'�޸�IP���ʿ���','setting','domodify_access','','',0,'','',0,1),(123,'ִ�����ݿ��Ż�','db','dooptimize','','',0,'','',0,1),(125,'�鿴���ݹ�������','setting','modify_filter','','',0,'','',0,1),(126,'�鿴IP���ʿ���','setting','modify_access','','',0,'','',0,1),(132,'�������ݻָ�','db','doimport','','',0,'','',0,1),(133,'�鿴���ݻָ�ҳ��','db','import','','',0,'','',0,1),(134,'ɾ�����ݿⱸ��','db','dodelete','','',0,'','',0,1),(135,'�鿴UC��������','ucenter','ucenter','','',0,'','',0,1),(136,'�޸�UC��������','ucenter','do_setting','','',0,'','',0,1),(137,'�鿴��ɫȨ��','role','modify','','',0,'','',0,1),(138,'��ģ�鶯���б�','role_action','list_action','','',0,'','',0,1),(139,'��������','role_action','modify|domodify','','',0,'','',0,1),(154,'�޸��ʼ���������','setting','do_modify_smtp','','',0,'','',0,1),(158,'��ջ���','cache','*','','',0,'','',0,1),(159,'ϵͳ��̨����','upgrade','*','','',0,'','',0,1),(169,'��ֹ��������','robot','disallow0|disallow1','','',0,'','',0,1),(172,'ִ�оٱ�����','report','batch_process','','',0,'','',0,1),(176,'����˽��','pm','send|dosend','','',0,'','',0,0),(182,'ִ�б༭΢��','topic','domodify','','',0,'','',0,1),(183,'ִ��ɾ��΢��','topic','delete','','',0,'','',0,1),(184,'ɾ��˽��','pm','delete','','',0,'','',0,1),(186,'ִ��ɾ���������','tag','delete','','',0,'','',0,1),(187,'ִ������û�����','member','doadd','','',0,'','',0,1),(188,'�����û�ҳ��','member','search','','',0,'','',0,1),(189,'�޸Ĺ������','income','domodify','','',0,'','',0,1),(190,'��ӹ���','notice','add','','',0,'','',0,1),(191,'ִ�б༭�������','notice','domodify','','',0,'','',0,1),(192,'��ӽ�ɫ','role','add|doadd','','',0,'','',0,1),(193,'��ȡ����΢������','xwb','__synctopic','','',0,'','',0,0),(194,'��ȡ����΢������','xwb','__syncreply','','',0,'','',0,0),(195,'�����µ�ͶƱ','vote','create','','',0,'','',0,0),(196,'����ͶƱ','vote','vote','','',0,'','',0,0),(197,'ת��΢��','topic','forward','','',0,'','',0,0),(198,'����΢��','topic','reply','','',0,'','',0,0),(200,'�鿴��������','setting','modify_credits','','',0,'','',0,1),(201,'�޸Ļ�������','setting','do_modify_credits','','',0,'','',0,1),(202,'�鿴���ֹ����б�','setting','list_credits_rule','','',0,'','',0,1),(204,'�޸Ļ��ֹ���','setting','do_modify_credits_rule','','',0,'','',0,1),(205,'�鿴ĳ����ֹ���','setting','modify_credits_rule','','',0,'','',0,1),(206,'ɾ��վ�����','share','delete','','',0,'','',0,1),(208,'���վ�����','share','add|do_add','','',0,'','',0,1),(210,'�༭վ�����','share','modify|domodify','','',0,'','',0,1),(211,'�鿴QQ΢������','setting','modify_qqwb','','',0,'','',0,1),(212,'�޸�QQ΢������','setting','do_modify_qqwb','','',0,'','',0,1),(213,'�鿴����΢������','setting','modify_sina','','',0,'','',0,1),(215,'�鿴�ʼ���������','setting','modify_smtp','','',0,'','',0,1),(216,'�鿴Զ�̸�������','setting','modify_ftp','','',0,'','',0,1),(217,'�鿴�Ƽ�����','setting','modify_hot_tag_recommend','','',0,'','',0,1),(218,'�鿴��ҳ�õƹ���','setting','modify_slide_index','','',0,'','',0,1),(219,'�鿴��ҳ�õƹ���','setting','modify_slide','','',0,'','',0,1),(220,'�༭�û�ҳ��','member','modify','','',0,'','',0,1),(221,'����û�ҳ��','member','add','','',0,'','',0,1),(222,'�鿴���ݱ���ҳ��','db','export','','',0,'','',0,1),(223,'�鿴���ݱ��Ż�ҳ��','db','optimize','','',0,'','',0,1),(224,'�޸�����΢������','setting','do_modify_sina','','',0,'','',0,1),(225,'�޸�QQ����������','imjiqiren','do_modify_setting','','',0,'','',0,1),(226,'�鿴���ŷ��ͼ�¼','sms','send_log','','',0,'','',0,1),(227,'�޸��ֻ���������','sms','do_modify_setting','','',0,'','',0,1),(228,'�鿴���Ž��ռ�¼','sms','receive_log','','',0,'','',0,1),(229,'ɾ�������շ���¼','sms','delete_log','','',0,'','',0,1),(230,'�鿴΢���б�','topic','modifylist','','',0,'','',0,1),(231,'�޸��Ƽ�����','setting','do_modify_hot_tag_recommend','','',0,'','',0,1),(232,'�޸���ҳ�õ�����','setting','do_modify_slide_index','','',0,'','',0,1),(233,'�޸���ҳ�õ�����','setting','do_modify_slide','','',0,'','',0,1),(234,'�޸Ķ���ƻ�����','task','dobatchmodify','','',0,'','',0,1),(235,'�鿴�ƻ�����','task','list','','',0,'','',0,1),(236,'�鿴�����ƻ�����','task','modify','','',0,'','',0,1),(237,'�޸ĵ����ƻ�����','task','domodify','','',0,'','',0,1),(238,'�鿴�ƻ������¼','task','log_list','','',0,'','',0,1),(239,'ɾ���ƻ�����','task','log_delete','','',0,'','',0,1),(240,'�޸�Զ�̸�������','setting','do_modify_ftp','','',0,'','',0,1),(241,'�鿴ͶƱ','vote','edit','','',0,'','',0,1),(242,'�޸�ͶƱ','vote','doedit','','',0,'','',0,1),(243,'ɾ��ͶƱ','vote','delete','','',0,'','',0,1),(244,'��Ӹ��˱�ǩ','user_tag','add','','',0,'','',0,1),(245,'ɾ�����˱�ǩ','user_tag','delete','','',0,'','',0,1),(246,'�鿴���˱�ǩ','user_tag','modify','','',0,'','',0,1),(247,'�޸ĸ��˱�ǩ','user_tag','domodify','','',0,'','',0,1),(248,'�޸Ĺ�����������','web_info','domodify','','',0,'','',0,1),(249,'ִ��ɾ���������','notice','delete','','',0,'','',0,1),(250,'�鿴�༭����ҳ��','notice','modify','','',0,'','',0,1),(251,'�鿴΢Ⱥ����','qun','category','','',0,'','',0,1),(252,'�鿴΢Ⱥ�ȼ�','qun','level','','',0,'','',0,1),(253,'�鿴΢Ⱥ����','qun','ploy','','',0,'','',0,1),(254,'�鿴΢Ⱥ����','qun','manage','','',0,'','',0,1),(255,'�鿴΢Ⱥ����','qun','setting','','',0,'','',0,1),(256,'�޸�΢Ⱥ����','qun','dosetting','','',0,'','',0,1),(257,'�޸�΢Ⱥ����','qun','docategory','','',0,'','',0,1),(258,'�޸�΢���ȼ�','qun','dolevel','','',0,'','',0,1),(259,'�޸�΢Ⱥ����','qun','doploy','','',0,'','',0,1),(260,'ִ��΢Ⱥ����','qun','domanage','','',0,'','',0,1),(261,'�û��������','member','dosearch','','',0,'','',0,1),(262,'�޸��û���Ϣ','member','domodify','','',0,'','',0,1),(263,'ִ��ɾ���û�����','member','delete','','',0,'','',0,1),(264,'�鿴�����û�','sessions','search','','',0,'','',0,1),(265,'���ѫ��','medal','add','','',0,'','',0,1),(267,'�޸�ѫ��','medal','modify|domodify','','',0,'','',0,1),(268,'ɾ��ѫ��','medal','delete','','',0,'','',0,1),(269,'���V��֤','vipintro','add','','',0,'','',0,1),(270,'ȡ��V��֤','vipintro','open_validate','','',0,'','',0,1),(271,'�޸�V��֤','vipintro','modify','','',0,'','',0,1),(273,'�鿴�ҵ���ҳ','topic','myhome','','',0,'','',0,0),(274,'�鿴TA��ע���û�','topic','follow','','',0,'','',0,0),(275,'�鿴��עTA���û�','topic','fans','','',0,'','',0,0),(276,'�����ҵ�ģ�壨��ʽ��������','skin','do_modify','','',0,'','',0,0),(281,'�鿴�ǳ�����ҳ��','search','user','','',0,'','',0,0),(282,'�鿴��ǩ����ҳ��','search','usertag','','',0,'','',0,0),(283,'�鿴�ؼ�����΢��ҳ��','search','topic','','',0,'','',0,0),(284,'�鿴������΢��ҳ��','search','tag','','',0,'','',0,0),(285,'�鿴�ؼ�����ͶƱҳ��','search','vote','','',0,'','',0,0),(286,'����΢�������','show','show','','',0,'','',0,0),(288,'�鿴ý���ҳ��','other','media','','',0,'','',0,0),(289,'�鿴���˰�ҳ��','topic','top','','',0,'','',0,0),(290,'�鿴���·�����΢��','topic','new','','',0,'','',0,0),(291,'�鿴�������۵�΢��','topic','newreply','','',0,'','',0,0),(292,'�鿴�ҵ�ѫ��ҳ��','settings','user_medal','','',0,'','',0,0),(293,'�鿴�ҵ�����ҳ��','settings','base','','',0,'','',0,0),(294,'ִ���޸ĸ������ϲ���','settings','do_modify_profile','','',0,'','',0,0),(295,'�鿴�޸�ͷ��ҳ��','settings','face','','',0,'','',0,0),(296,'ִ��ͷ���޸Ĳ���','settings','do_modify_face','','',0,'','',0,0),(297,'�鿴�޸�����ҳ��','settings','secret','','',0,'','',0,0),(298,'ִ���޸��������','settings','do_modify_password','','',0,'','',0,0),(299,'�鿴�ҵĻ���','settings','extcredits','','',0,'','',0,0),(300,'�鿴˽���б�','pm','list','','',0,'','',0,0),(302,'����˽��Ϊδ��','pm','markunread','','',0,'','',0,0),(303,'�鿴ͶƱ����','vote','view','','',0,'','',0,0),(304,'�鿴������չ','tag','extra','','',0,'','',0,1),(305,'�鿴�����ƽ�','tag','recommend','','',0,'','',0,1),(306,'�鿴�����б�','tag','list','','',0,'','',0,1),(307,'�༭�����ƽ�','tag','do_recommend','','',0,'','',0,1),(308,'�༭������չ','tag','add_extra','','',0,'','',0,1),(311,'�鿴��������','setting','navigation','','',0,'','',0,1),(315,'�鿴�����','event','manage','','',0,'','',0,1),(317,'�޸ĵ�������','setting','do_navigation','','',0,'','',0,1),(318,'����Ĭ�Ϲ�ע���ƽ�','setting','do_regfollow','','',0,'','',0,1),(319,'�鿴�����û�','sms','list','','',0,'','',0,1),(320,'���������û�','sms','export_to_excel','','',0,'','',0,1),(321,'ɾ���','event','delete','','',0,'','',0,1),(323,'�鿴����б�','plugin','main','','',0,'','',0,1),(324,'�����װ','plugin','add','','',0,'','',0,1),(325,'��Ʋ��','plugin','design|adddesign','','',0,'','',0,1),(327,'���ò��','plugin','action','','',0,'','',0,1),(328,'ж�ز��','plugin','uninstall','','',0,'','',0,1),(329,'���������û�','member','export_all_user','','',0,'','',0,1),(330,'ʹ��΢��ǽ����','wall','control','','',0,'','',0,0),(340,'����΢Ⱥ','qun','create|docreate','','',0,'','',0,0),(361,'�鿴�������','fenlei','manage','','',0,'','',0,1),(363,'�޸�API����','api','do_modify_setting','','',0,'','',0,1),(374,'�鿴������б�','verify','edit|doedit','','',0,'','',0,1),(375,'����û���Ϣ','verify','doverify','','',0,'','',0,1),(376,'���΢��','topic','doverify','','',0,'','',0,1),(377,'�����ϴ�','uploadattach','attach','','',0,'','',0,0),(378,'��������','uploadattach','down','','',0,'','',0,0),(379,'�鿴ע�����ѡ��','setting','modify_register','','',0,'','',0,1),(380,'�鿴�Զ���ע����','setting','regfollow','','',0,'','',0,1),(381,'�鿴Discuz��̳��������','dzbbs','discuz_setting','','',0,'','',0,1),(382,'�鿴Ƥ���������','show','modify_theme','','',0,'','',0,1),(383,'�鿴����������','vipintro','people_setting','','',0,'','',0,1),(384,'�鿴΢�����۵����б�','output','output_setting','','',0,'','',0,1),(385,'����΢���б�','topic','topic_manage','','',0,'','',0,1),(386,'�鿴����΢��','topic','verify','','',0,'','',0,1),(387,'�鿴΢������վ','topic','del','','',0,'','',0,1),(388,'�鿴΢����˹���','topic','manage','','',0,'','',0,1),(389,'�û�ǩ������','topic','signature','','',0,'','',0,1),(390,'���ҽ��ܹ���','topic','aboutme','','',0,'','',0,1),(391,'�鿴�û��б�','member','newm','','',0,'','',0,1),(392,'�鿴�����û�','member','force_out','','',0,'','',0,1),(393,'�鿴�ϱ��쵼','member','leaderlist','','',0,'','',0,1),(394,'�鿴ͶƱ�б�','vote','index','','',0,'','',0,1),(395,'�鿴�����','event','index','','',0,'','',0,1),(396,'ֱ������','live','index','','',0,'','',0,1),(400,'��Ӷ���Ȩ��','role_action','add','','',0,'','',0,1),(401,'�鿴��֤������','setting','modify_seccode','','',0,'','',0,1),(403,'�鿴Ĭ�Ϲ�ע����','setting','follow','','',0,'','',0,1),(404,'�鿴ͼƬ�ϴ�����','setting','modify_image','','',0,'','',0,1),(405,'�鿴������Դ����','setting','modify_topic_from','','',0,'','',0,1),(406,'�鿴ͼƬǩ��������','setting','modify_qmd','','',0,'','',0,1),(407,'�鿴��������˵��','setting','invite','','',0,'','',0,1),(408,'�޸����ݷ�����Դ','setting','do_modify_topic_from','','',0,'','',0,1),(409,'���ֱ��','live','add','','',0,'','',0,1),(410,'�鿴ֱ������','live','config','','',0,'','',0,1),(411,'�鿴΢�����۵�������','output','modify','','',0,'','',0,1),(412,'���΢�����۵���','output','add','','',0,'','',0,1),(413,'�鿴������Ϣ��������','fenlei','setting','','',0,'','',0,1),(415,'˽��Ⱥ���б�','pm','pmsend','','',0,'','',0,1),(416,'ִ��˽��Ⱥ��','pm','dopmsend','','',0,'','',0,1),(417,'ɾ��Ⱥ��˽��','pm','delmsg','','',0,'','',0,1),(418,'�鿴˽���б�','pm','pm_manage','','',0,'','',0,1),(419,'�����û�V��֤����','vipintro','tuijian','','',0,'','',0,1),(420,'��̨������¼','logs','*','','',0,'','',0,1),(421,'�鿴ģ��������','show','modify_template','','',0,'','',0,1),(422,'��վLOGO����','show','editlogo','','',0,'','',0,1),(424,'�鿴DeDeCMS��������','dedecms','dedecms_setting','','',0,'','',0,1),(425,'�鿴PHPWind��������','phpwind','phpwind_setting','','',0,'','',0,1),(426,'�༭վ���������','output','do_modify','','',0,'','',0,1),(427,'ɾ��΢�����۵���','output','delete','','',0,'','',0,1),(428,'�޸�Ƥ���������','show','domodifytheme','','',0,'','',0,1),(429,'�鿴վ������б�','share','share_setting','','',0,'','',0,1),(430,'�޸�DeDeCMS��������','dedecms','dedecms_save','','',0,'','',0,1),(431,'�޸�PHPWind��������','phpwind','phpwind_save','','',0,'','',0,1),(432,'�޸�Discuz��̳��������','dzbbs','dzbbs_save','','',0,'','',0,1),(435,'�鿴������ʾ����','show','show','','',0,'','',0,1),(443,'��̨��������','search','*','','',0,'','',0,1),(445,'��̨���ŷ���','sms','do_send','','',0,'','',0,1),(446,'�鿴����֤�û�','member','waitvalidate','','',0,'','',0,1),(447,'�����»','event','create','','',0,'','',0,0),(448,'�鿴�','event','detail','','',0,'','',0,0),(449,'�鿴�ֻ�Ӧ������','setting','modify_mobile','','',0,'','',0,1),(450,'�鿴V��֤����','vipintro','categorylist','','',0,'','',0,1),(451,'�༭V��֤����','vipintro','domodify','','',0,'','',0,1),(452,'ɾ��V��֤����','vipintro','delcategory','','',0,'','',0,1),(456,'�½�Ⱥ','qun','add','','',0,'','',0,1),(461,'�ֶ����V��֤','vipintro','addvip|doaddvip','','',0,'','',0,1),(464,'��׹���','member','vest','','',0,'','',0,1),(466,'����APP SECRET','api','reset_app_secret','','',0,'','',0,1),(470,'�Ƽ�΢��','topic','do_recd','','',0,'','',0,0),(471,'�����н�ת��','reward','add','','',0,'','',0,0),(472,'�鿴�н�ת������','reward','detail','','',0,'','',0,0),(474,'�鿴֪ͨ�е��ʼ�����','notice','mailq','','',0,'','',0,1),(475,'�û����ʼ�¼','member','login','','',0,'','',0,1),(476,'�鿴�û���Ŀ��ѡ������','member','profile','','',0,'','',0,1),(477,'�����̸����ҳ��','talk','*','','',0,'','',0,1),(478,'�鿴����Ƶ����Ϣ','channel','index','','',0,'','',0,1),(479,'�޸�ǩ������','sign','dosetting','','',0,'','',0,1),(480,'ǩ����������','sign','sign_list','','',0,'','',0,1),(481,'�鿴ǩ������','sign','*','','',0,'','',0,1),(482,'�����û���Ŀ��ѡ������','member','setprofile','','',0,'','',0,1),(483,'�޸ľ���Ƶ����Ϣ','channel','docategory','','',0,'','',0,1),(484,'�鿴Ƶ������','channel','config','','',0,'','',0,1),(485,'�޸�Ƶ������','channel','doset','','',0,'','',0,1),(486,'�鿴��̸����','talk','config','','',0,'','',0,1),(487,'�޸ķ�̸����','talk','doconfig','','',0,'','',0,1),(488,'�鿴��̸����','talk','category','','',0,'','',0,1),(489,'�޸ķ�̸����','talk','docategory','','',0,'','',0,1),(490,'��ӷ�̸','talk','add|doadd','','',0,'','',0,1),(492,'�鿴������̸�ľ�����Ϣ','talk','edit','','',0,'','',0,1),(493,'�޸ĵ�����̸�ľ�����Ϣ','talk','doedit','','',0,'','',0,1),(494,'ɾ����̸','talk','delete','','',0,'','',0,1),(495,'ɾ���ʼ������е�����','notice','delMailQueue','','',0,'','',0,1),(496,'ϵͳ��������','setting','modify_sysload|do_wqueue','','',0,'','',0,1),(497,'�鿴Ⱥģ������','qun','module','','',0,'','',0,1),(502,'�鿴ͶƱ����','vote','setting','','',0,'','',0,1),(503,'�鿴�����ͶƱ','vote','verify','','',0,'','',0,1),(504,'�鿴�����','event','setting','','',0,'','',0,1),(505,'�鿴����˻','event','verify','','',0,'','',0,1),(506,'�鿴�û������','account','index','','',0,'','',0,1),(507,'�鿴YY������','account','yy','','',0,'','',0,1),(508,'�鿴���˰�����','account','renren','','',0,'','',0,1),(509,'�鿴���İ�����','account','kaixin','','',0,'','',0,1),(510,'�鿴QQ����������','imjiqiren','imjiqiren_setting','','',0,'','',0,1),(511,'�鿴���������û��б�','sign','credits_top','','',0,'','',0,1),(512,'�鿴��վ�ؼ�������','setting','modify_meta','','',0,'','',0,1),(513,'�鿴����������','setting','topic_publish','','',0,'','',0,1),(514,'�鿴ǰ̨�����滻����','setting','changeword','','',0,'','',0,1),(516,'�鿴���й��','income','ad_list','','',0,'','',0,1),(517,'�鿴ͷ��ǩ��������û�','verify','fs_verify','','',0,'','',0,1),(518,'�鿴���˱�ǩ����ҳ��','user_tag','user_tag_manage','','',0,'','',0,1),(519,'�鿴�ٱ�����','report','report_manage','','',0,'','',0,1),(520,'����ٷ��Ƽ�΢������ҳ��','recdtopic','*','','',0,'','',0,1),(521,'�鿴V��֤����','vipintro','validate_setting','','',0,'','',0,1),(523,'�鿴�������','member','config','','',0,'','',0,1),(524,'���õ������ʺŰ󶨿���','account','on_off','','',0,'','',0,1),(525,'ɾ�����','income','dodeladv','','',0,'','',0,1),(526,'�޸�ǰ̨�����滻����','setting','dochangeword','','',0,'','',0,1),(527,'�޸ķ���������','setting','do_topic_publish','','',0,'','',0,1),(528,'�޸��������','member','setvest','','',0,'','',0,1),(529,'��������ͶƱ','vote','doverify','','',0,'','',0,1),(530,'�޸�ͶƱ����','vote','dosetting','','',0,'','',0,1),(531,'����ͶƱ����','vote','batch','','',0,'','',0,1),(533,'�༭һ���','event','editevent|doeditevent','','',0,'','',0,1),(534,'ɾ���Ƽ���΢��','recdtopic','delete','','',0,'','',0,1),(535,'ִ��һ����������Ƽ���΢��','recdtopic','onekey','','',0,'','',0,1),(536,'�༭һ���ٷ��Ƽ���΢��','recdtopic','edit|doedit','','',0,'','',0,1),(537,'�޸�YY������','account','do_modify_yy','','',0,'','',0,1),(538,'�޸����˰�����','account','do_modify_renren','','',0,'','',0,1),(539,'�޸Ŀ��İ�����','account','do_modify_kaixin','','',0,'','',0,1),(540,'�޸�Ⱥģ������','qun','add_module','','',0,'','',0,1),(541,'�鿴��ർ������','setting','left_navigation','','',0,'','',0,1),(542,'�鿴����ͬ����΢������','setting','bbs_plugin','','',0,'','',0,1),(543,'�޸���ർ������','setting','do_left_navigation','','',0,'','',0,1),(544,'�鿴�ײ���������','setting','footer_navigation','','',0,'','',0,1),(545,'΢������','topic','domanage','','',0,'','',0,1),(546,'�鿴��˿�������','setting','check_switch','','',0,'','',0,1),(547,'�޸���˿�������','setting','do_check_switch','','',0,'','',0,1),(548,'�鿴վ��״̬����','setting','visit_state','','',0,'','',0,1),(551,'΢���Ƽ�','topic','do_recd','','',0,'','',0,1),(553,'ѫ�����','medal','verify','','',0,'','',0,1),(554,'ѫ�»�Ա�б�','medal','user','','',0,'','',0,1),(561,'ɾ���û�','member','dodelete','','',0,'','',0,1),(566,'������е�¼�����IP','failedlogins','clean','','',0,'','',0,1),(567,'��¼����IP����','failedlogins','modify','','',0,'','',0,1),(570,'URL���ӵ�ַ����','url','setting','','',0,'','',0,1),(571,'URL���ӵ�ַ�б�','url','manage','','',0,'','',0,1),(572,'URL���ӵ�ַ����ɾ����','url','do_manage','','',0,'','',0,1),(573,'��ർ������','navigation','left_navigation','','',0,'','',0,1),(574,'�ײ���������','navigation','footer_navigation','','',0,'','',0,1),(575,'ɾ����ɫ','role','delete','','',0,'','',0,1),(578,'POST_vipintro_check_category','vipintro','check_category','','',0,'','',0,1),(586,'POST_setting_do_invite','setting','do_invite','','',0,'','',0,1),(594,'POST_mall_do_add_goods','mall','do_add_goods','','',0,'','',0,1),(596,'POST_mall_modify_order_status','mall','modify_order_status','','',0,'','',0,1),(598,'POST_mall_do_modify_goods','mall','do_modify_goods','','',0,'','',0,1),(604,'POST_contest_save_index','contest','save_index','','',0,'','',0,1),(606,'POST_contest_do_create_project','contest','do_create_project','','',0,'','',0,1),(616,'�޸�վ��״̬','setting','do_visit_state','','',0,'','',0,1),(620,'����ͼ���趨','navigation','icon','','',0,'','',0,1),(621,'�����༭','navigation','new_save','','',0,'','',0,1),(625,'΢������','wechat','do_setting','','',0,'','',0,1),(627,'POST_feed_doleader','feed','doleader','','',0,'','',0,1),(629,'Ƶ���༭','channel','doedit','','',0,'','',0,1);
REPLACE INTO `jishigou_role_module`(`module`,`name`) values ('account','�û���'),('api','APIӦ��'),('cache','�������'),('channel','Ƶ��'),('db','���ݿ����'),('dedecms','DeDeCMS����'),('dzbbs','Discuz��̳����'),('event','�'),('fenlei','������Ϣ'),('imjiqiren','QQ������'),('income','������'),('index','��̨����'),('link','������������'),('live','΢ֱ��'),('login','��¼�˳�'),('logs','��̨������¼'),('medal','ѫ��(�û�����)'),('member','�û�����'),('module','ģ��'),('notice','��վ����'),('other','����'),('output','΢������վ�����'),('phpwind','PHPWind����'),('plugin','���ģ��'),('plugindesign','������'),('pm','˽�Ź���'),('profile','��������'),('qun','΢Ⱥ'),('recdtopic','�ٷ��Ƽ�΢��'),('report','�ٱ�����'),('reward','�н�ת��'),('robot','֩�����м�¼'),('role','��ɫ����'),('role_action','����Ȩ�޹���'),('role_module','����ģ������'),('search','����'),('sessions','�����û�'),('setting','ϵͳ����'),('settings','����'),('share','վ�����'),('show','��������ʾ����'),('sign','ǩ��'),('skin','ǰ̨����'),('sms','�ֻ�����'),('tag','�������'),('talk','΢��̸'),('task','�ƻ�����'),('tools','����'),('topic','΢������'),('ucenter','Ucenter����'),('upgrade','ϵͳ����'),('uploadattach','����'),('user_tag','���˱�ǩ'),('verify','ͷ��ǩ�����'),('vipintro','�û�V��֤'),('vote','ͶƱ'),('wall','΢��ǽ'),('web_info','��������'),('xwb','����΢��'),('ldap','ldap'),('company','company'),('failedlogins','��¼����IP'),('media','media'),('url','URL���ӵ�ַ'),('navigation','����'),('cms','cms'),('mall','�����̳�'),('contest','contest'),('wechat','΢��'),('feed','��Ҫ��̬');

REPLACE INTO `jishigou_credits_rule` (`rid`,`rulename`,`action`,`cycletype`,`cycletime`,`rewardnum`,`norepeat`,`extcredits1`,`extcredits2`,`extcredits3`,`extcredits4`,`extcredits5`,`extcredits6`,`extcredits7`,`extcredits8`,`related`) values (1,'����ԭ��΢��','topic',1,0,10,0,0,2,0,0,0,0,0,0,''),(7,'���Ͷ���Ϣ','pm',1,0,1,0,0,1,0,0,0,0,0,0,''),(3,'��ע����','buddy',1,0,10,0,0,1,0,0,0,0,0,0,''),(8,'����ͷ��','face',0,0,1,0,0,10,0,0,0,0,0,0,''),(9,'VIP��֤','vip',0,0,1,0,0,20,0,0,0,0,0,0,''),(6,'ÿ���¼','login',1,0,1,0,0,2,0,0,0,0,0,0,''),(2,'���ۻ�ת��΢��','reply',1,0,10,0,0,1,0,0,0,0,0,0,''),(4,'����ע��','register',1,0,10,0,0,10,0,0,0,0,0,0,''),(10,'����ָ������','_T84202031',1,0,2,0,0,5,0,0,0,0,0,0,'���˱���'),(11,'��עָ���û�','_U-2012344970',0,0,1,0,0,5,0,0,0,0,0,0,'admin'),(12,'ɾ��΢��','topic_del',4,0,0,0,0,-5,0,0,0,0,0,0,''),(13,'ȡ����ע����','buddy_del',4,0,0,0,0,-5,0,0,0,0,0,0,''),(15,'����ָ������','_T',1,0,1,0,0,0,0,0,0,0,0,0,''),(16,'��עָ���û�','_U',1,0,1,0,0,0,0,0,0,0,0,0,''),(17,'����ͶƱ','vote_add',1,0,10,0,0,2,0,0,0,0,0,0,''),(18,'ɾ��ͶƱ','vote_del',4,0,0,0,0,-5,0,0,0,0,0,0,''),(19,'�ϴ�����','attach_add',1,0,10,0,0,0,0,0,0,0,0,0,''),(20,'ɾ������','attach_del',4,0,10,0,0,0,0,0,0,0,0,0,''),(21,'���ظ���','attach_down',4,0,0,0,0,1,0,0,0,0,0,0,''),(22,'����������','down_my_attach',4,0,0,0,0,1,0,0,0,0,0,0,''),(23,'��΢��','topic_dig',1,0,10,0,0,1,0,0,0,0,0,0,''),(24,'΢������','my_dig',4,0,0,0,0,1,0,0,0,0,0,0,''),(25,'΢�����Ƽ�','recommend',4,0,0,0,0,1,0,0,0,0,0,0,''),(26,'�һ���Ʒ','convert',4,0,0,0,0,1,0,0,0,0,0,0,''),(27,'ȡ����Ʒ�һ�','unconvert',4,0,0,0,0,1,0,0,0,0,0,0,'');

REPLACE INTO `jishigou_event_sort` (`id`, `type`) VALUES (1, '�ݳ�/��Ӱ'), (2, '����/�ۻ�'), (3, '����/����'), (4, 'չ��/ɳ��'), (5, '����/����'), (6, '����/����'), (7, '�ɶ�/ҹ��'), (8, '��Ʒ����'), (9, '�м�/��԰'), (10, '����/����'), (11, '����');

REPLACE INTO `jishigou_medal` (`id`, `medal_img`, `medal_img2`, `medal_name`, `medal_depict`, `medal_count`, `is_open`, `conditions`, `dateline`) VALUES (1, './images/medal/1301651267/1_o.jpg', './images/medal/1301651267/1_s.jpg', 'ԭ������', '����3�췢��ԭ�����ݣ����ܻ��΢������ѫ��', 0, 1, 'a:4:{s:4:"type";s:5:"topic";s:3:"day";s:1:"3";s:6:"endday";s:0:"";s:7:"tagname";N;}', 1301651267), (2, './images/medal/1301651359/2_o.jpg', './images/medal/1301651359/2_s.jpg', '����ר��', '����3����������ݽ������ۣ����ܻ�á�����ר�ҡ�ѫ��', 0, 1, 'a:4:{s:4:"type";s:5:"reply";s:3:"day";s:1:"3";s:6:"endday";N;s:7:"tagname";N;}', 1301651359);
REPLACE INTO `jishigou_validate_category`(`id`,`category_id`,`category_name`,`category_pic`,`num`,`dateline`) values (1,0,'����','',0,1322040871),(2,1,'վ��','',0,1322040878),(3,1,'����','',0,1324547052),(24,4,'����','',0,1362037393),(7,1,'���ָ߹�','',0,1324547013),(11,1,'���ֻ','',0,1324547043),(12,1,'����','',0,1324547052),(14,1,'����ѧ��','',0,1324547185),(19,1,'Ͷ��','',0,1324547219),(4,0,'��ҵ','',0,1333156076),(13,1,'�̽�����','',0,1324547176),(23,4,'ý��','',0,1333291705),(22,4,'����','',0,1333291687),(21,4,'ѧУ','',0,1333291678),(8,1,'������','',0,1324547021),(9,1,'���','',0,1324547029),(10,1,'������','',0,1324547037),(15,1,'��Ʊ','',0,1324547192),(16,1,'����','',0,1324547199),(17,1,'���','',0,1324547204),(18,1,'�ڻ�','',0,1324547210);
REPLACE INTO `jishigou_common_member_profile_setting` (`fieldid`, `title`, `displayorder`, `formtype`, `size`, `choices`) values ('realname','��ʵ����','4','text','0',''),('gender','�Ա�','3','select','0','1|��\r\n2|Ů'),('bday','����������','2','date','0',''),('constellation','����','1','select','0','������\r\n��ţ��\r\n˫����\r\n��з��\r\nʨ����\r\n��Ů��\r\n�����\r\n��Ы��\r\n������\r\nĦ����\r\nˮƿ��\r\n˫����'),('zodiac','��Ф','0','select','0','��\r\nţ\r\n��\r\n��\r\n��\r\n��\r\n��\r\n��\r\n��\r\n��\r\n��\r\n��'),('telephone','�̶��绰','0','text','0',''),('mobile','�ֻ�','0','text','0',''),('idcardtype','֤������','0','select','0','���֤\r\nѧ��֤\r\n����֤\r\n����\r\nӪҵִ��\r\n�ٷ�����\r\n��ʻ֤\r\n����'),('idcard','֤����','0','text','0',''),('address','�ʼĵ�ַ','0','text','0',''),('zipcode','�ʱ�','0','text','0',''),('nationality','����','0','text','0',''),('residecity','���ڵ�','0','select','0',''),('education','ѧ��','0','select','0','��ʿ\r\n˶ʿ\r\n����\r\nר��\r\n��ѧ\r\nСѧ\r\n����'),('birthcity','������','0','select','0',''),('graduateschool','��ҵѧУ','0','text','0',''),('pcompany','��˾','0','text','0',''),('occupation','ְҵ','0','text','0',''),('position','ְλ','0','text','0',''),('revenue','������','0','text','0',''),('affectivestatus','���״̬','0','text','0',''),('lookingfor','����Ŀ��','0','text','0',''),('bloodtype','Ѫ��','0','select','0','A\r\nB\r\nAB\r\nO\r\n����'),('height','���','0','text','0',''),('weight','����','0','text','0',''),('alipay','֧����','0','text','0',''),('icq','ICQ','0','text','0',''),('qq','QQ','0','text','0',''),('yahoo','YAHOO�ʺ�','0','text','0',''),('msn','MSN','0','text','0',''),('taobao','��������','0','text','0',''),('site','������ҳ','0','text','0',''),('aboutme','���ҽ���','0','textarea','0',''),('linkaddress','��ϵ��ַ','6','text','0',''),('interest','��Ȥ����','0','textarea','0',''),('field1','�Զ���','0','text','0',''),('field2','�Զ�����','0','text','0',''),('field3','�Զ����ֶ�','0','text','0',''),('field4','�Զ����ֶ�4','0','text','0',''),('field5','�Զ����ֶ�5','0','text','0',''),('field6','�Զ����ֶ�6','0','text','0',''),('field7','�Զ����ֶ�7','0','text','0',''),('field8','�Զ����ֶ�8','0','text','0','');
REPLACE INTO `jishigou_sign_tag`(`id`,`tag`,`credits`) values (1,'ǩ��','');

REPLACE INTO `jishigou_qun_category`(`cat_id`,`cat_name`,`qun_num`,`parent_id`,`display_order`) values (2,'IT������',0,1,0),(3,'��ҵ�ƾ�',0,1,0),(4,'��ý����',0,1,0),(5,'��Ȥ����',0,0,0),(6,'����',0,5,0),(7,'��Ϸ',0,5,0),(8,'����',0,5,0),(27,'���¹�΢��ϵͳ',0,0,0),(1,'��ҵ����',0,0,0),(10,'��Ӱ',0,5,0),(11,'����',0,5,0),(12,'����',0,5,0),(13,'��Ӱ',0,5,0),(9,'����',0,5,0),(16,'����',0,14,0),(18,'����',0,14,0),(20,'��Ӱ',0,14,0),(19,'����',0,14,0),(14,'��Ȥ����',0,0,0),(17,'��Ϸ',0,14,0),(15,'��Ц��',0,14,0),(21,'����',0,14,0),(22,'����',0,14,0),(23,'��Ӱ',0,14,0),(24,'�ƽ�����',0,0,0),(25,'��ѧ����',0,24,0),(26,'��������',0,24,0);
REPLACE INTO `jishigou_qun_level`(`level_id`,`level_name`,`credits_higher`,`credits_lower`,`member_num`,`admin_num`) values (1,'����Ⱥ',-999999999,999999999,100,3);
REPLACE INTO `jishigou_qun_ploy`(`id`,`fans_num_min`,`fans_num_max`,`topics_higher`,`topics_lower`,`qun_num`) values (1,10,999999999,999999999,10,3),(2,11,100,100,22,1);

REPLACE INTO `jishigou_channel`(`ch_id`,`ch_name`,`feed`,`recommend`,`topic_num`,`total_topic_num`,`parent_id`,`description`,`purview`,`purpostview`,`verify`,`filter`,`display_order`,`display_list`,`display_view`,`in_home`,`picture`,`buddy_numbers`,`manageid`,`managename`,`template`,`channel_typeid`,`topictype`) values (1,'�ٷ�վ��',0,0,0,0,0,'','','',0,'',0,'','',0,'',0,'','','',0,0),(2,'���ѽ���',0,0,0,0,0,'','','',0,'',0,'','',0,'',0,'','','',0,0),(3,'վ����',0,0,0,0,1,'','','',0,'',0,'','',0,'',0,'','','',0,0),(4,'�ٷ�����',1,0,0,0,1,'','','',0,'',0,'','',0,'',0,'','','',0,0),(5,'���˱���',0,0,0,0,2,'','','',0,'',0,'','',0,'',0,'','','',0,0),(6,'��ͼ����',0,0,0,0,2,'','','',0,'',0,'','',0,'',0,'','','',0,0),(7,'��������',0,1,1,1,0,'','','',0,'',0,'','',0,'',0,'','','',1,0),(8,'��������',0,1,1,1,0,'','','',0,'',0,'','',0,'',0,'','','',2,0);
REPLACE INTO `jishigou_channel_type`(`channel_typeid`,`channel_type`,`channel_typename`,`template`,`child_template`,`topic_template`,`featureid`,`default_feature`) values (1,'ask','�ʴ�ģ��','','','','1,2,3','������'),(2,'idea','����ģ��','','','','4,5,6','������');
REPLACE INTO `jishigou_feature`(`featureid`,`featurename`) values (1,'��ȷ��'),(2,'������'),(3,'�ѽ��'),(4,'�ѱ�����'),(5,'�������'),(6,'�ȴ�����');
