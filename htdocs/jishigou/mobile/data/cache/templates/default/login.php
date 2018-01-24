<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?><!DOCTYPE html> <html> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no; width=device-width;"> <title> <?php echo Mobile::convert($this->Config['site_name']) ?> </title> <link href="templates/default/styles/common.css?build+20140922" rel="stylesheet" type="text/css" /> <link href="templates/default/styles/base.css?build+20140922" rel="stylesheet" type="text/css" /> <script src="templates/default/js/jquery-1.6.2.min.js?build+20140922"></script> <script src="templates/default/js/iscroll.js?build+20140922"></script> <script src="templates/default/js/common.js?build+20140922"></script> <style type="text/css">
body {
height: 100%;
background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#4E94C4), to(#EFF8FF));
background-image: linear-gradient(#4E94C4, #EFF8FF);
background-image: -moz-linear-gradient(#4E94C4, #EFF8FF);
filter:progid:DXImageTransform.Microsoft.Gradient(GradientType=0, EndColorStr='#EFF8FF', StartColorStr='#4E94C4')
}
body, html {
background-color: #EFF8FF;
}
</style> </head> <body> <script type="text/javascript">
//一些初始化操作
var PerPage_MBlog = parseInt("<?php echo $this->Config['perpage_mblog']; ?>");
var PerPage_Pm = parseInt("<?php echo $this->Config['perpage_pm']; ?>");
var PerPage_Member = parseInt("<?php echo $this->Config['perpage_member']; ?>");
var PerPage_Def = parseInt("<?php echo $this->Config['perpage_def']; ?>");
var Code = "<?php echo $this->Code; ?>";
var Module = "<?php echo $this->Module; ?>";
var Uid = "<?php echo MEMBER_ID; ?>";
<?php if($this->Config['is_mobile_client']) { ?>
var MobileClient = true;
<?php } else { ?>var MobileClient = false;
<?php } ?> <?php if(!$this->Config['is_mobile_client'] && !in_array($_GET['code'], array('3g', 'publish', 'login'))) { ?>
var myScroll;
function loaded() {
var scrollName = "g_isrcollWrapper";
if (Module == "topic" && Code == "detail") {
//scrollName = "";
}
if (scrollName != "") {
myScroll = new iScroll(scrollName, {checkDOMChanges:true});
}
}
document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);
<?php } ?> </script> <div data-role="page" data-theme="f" class="page"> <div class="logo"> <div class="loginIcon"> <?php echo Mobile::convert($this->Config['site_name']) ?> </div> <!--<div class="loginIcon"><img src="<?php echo $GLOBALS['_J']['config']['site_url']; ?>/images/logo.png"></div>--> </div> <div class="dec_line1"></div> <div id="g_tips" onclick="closeTipsExp();"></div> <?php if($_GET['code'] == 'login') { ?> <style type="text/css">
#g_isrcollWrapper {
top:70px;
bottom:0px;
}
</style> <?php } ?> <div id="g_isrcollWrapper"> <div id="setting_wp" class="mc"> <ul class="lv_4"> <li> <div class="login-main-account-word">帐号：</div> <div class="col2"><input name="nickname" type="text" id="nickname" value="昵称" class="login_txt" onFocus="this.value=''" onBlur="if(this.value==''){this.value='昵称';}" /></div> </li> <li class="nb"> <div class="login-main-account-word">密码：</div> <div class="col2"><input name="password" type="password" id="password" value="密码" class="login_txt" onFocus="this.value=''" onBlur="if(this.value==''){this.value='密码';}" /></div> </li> </ul> <div class="loginbar"> <button class="btn_login" onclick="login('nickname', 'password')">登录</button> </div> </div> <div class="loginFooter"> <?php echo Mobile::convert($this->Config['site_name']) ?>
手机微博3G触屏版</div> <?php if(!$this->Config['is_mobile_client']) { ?> </div> <?php } ?> </div><?php echo $GLOBALS['_J']['config']['tongji']; ?></body> </html>