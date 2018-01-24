<?php
/**
 *
 * 后台入口
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author 狐狸<foxis@qq.com>
 * @version $Id: admin.php 4035 2013-07-26 09:08:23Z wuliyong $
 */




require './include/jishigou.php';
$jishigou = new jishigou();

$jishigou->run('admin');

?>