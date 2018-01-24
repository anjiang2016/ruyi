<?php
/**
 *
 * APIÈë¿Ú
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ºüÀê<foxis@qq.com>
 * @version $Id: api.php 5233 2013-12-11 08:09:48Z wuliyong $
 */




define('IN_JISHIGOU_API', true);

require './include/jishigou.php';
$jishigou = new jishigou();

$jishigou->run('api');

?>