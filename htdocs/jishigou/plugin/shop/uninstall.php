<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename uninstall.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 268362859 138 $
 */


if(!defined('IN_JISHIGOU')) {
    exit('invalid request');
}
$sql = <<<EOF
DROP TABLE IF EXISTS {jishigou}topic_shop;
EOF;
?>