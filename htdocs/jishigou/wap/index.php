<?php
/**
 *
 * WAP入口
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author 狐狸<foxis@qq.com>
 * @version $Id: index.php 3274 2013-04-09 09:13:30Z wuliyong $
 */

define('IN_JISHIGOU_WAP', true);
define('CHARSET', 'utf-8');
define('ROOT_PATH',substr(dirname(__FILE__),0,-4) . '/');
define('TEMPLATE_ROOT_PATH', ROOT_PATH . 'wap/');
define('RELATIVE_ROOT_PATH','../');

require ROOT_PATH . 'include/jishigou.php';
$jishigou = new jishigou();

$jishigou->run('wap');


?>