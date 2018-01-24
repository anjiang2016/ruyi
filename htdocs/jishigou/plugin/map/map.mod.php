<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename map.mod.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 700002158 804 $
 */


if(!defined('IN_JISHIGOU'))
{
    exit('invalid request');
}

$sql = "select t.*,m.province,m.city,m.area from ".TABLE_PREFIX."topic AS t, ".TABLE_PREFIX."members AS m WHERE t.uid = m.uid AND t.uid IN(SELECT uid FROM ".TABLE_PREFIX."members WHERE province <>'' OR city <>'') ORDER BY t.tid DESC LIMIT 20";
$query = $this->DatabaseHandler->Query($sql);
$list = array();
$i = 0;
while (false != ($row = $query->GetRow())) 
{
	$list[$i] = $this->TopicLogic->Make($row);
	$list[$i]['address'] = ($row['province'].$row['city'] == '��������') ? '�㽭ʡ������������' : $row['province'].$row['city'].$row['area'];
	$list[$i] = str_replace("'","\'",str_replace("\\","",str_replace("\n","",str_replace("\r","",$list[$i]))));
	$i = $i + 1;
}
$topics = $list;
include template('map:map');
?>