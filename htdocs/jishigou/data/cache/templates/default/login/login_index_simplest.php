<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?><!doctype html> <html> <head> <?php $__my=$GLOBALS['_J']['member']; ?> <base href="<?php echo $this->Config['site_url']; ?>/" /> <?php $conf_charset=$this->Config['charset']; ?> <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $conf_charset; ?>" /> <meta http-equiv="X-UA-Compatible" content="Chrome=1,IE=edge" /> <title><?php echo $this->Config['site_name']; ?>(<?php echo $this->Config['site_domain']; ?>)<?php echo $GLOBALS['_J']['config']['page_title']; ?></title> <meta name="Keywords" content="<?php echo $this->Config['index_meta_keywords']; ?>,<?php echo $this->MetaKeywords; ?>,<?php echo $GLOBALS['_J']['config']['site_name']; ?><?php echo $GLOBALS['_J']['config']['meta_keywords']; ?>" /> <meta name="Description" content="<?php echo $this->Config['index_meta_description']; ?>,<?php echo $this->MetaDescription; ?>,<?php echo $GLOBALS['_J']['config']['site_notice']; ?><?php echo $GLOBALS['_J']['config']['meta_description']; ?>" /> <link rel="shortcut icon" href="favicon.ico" /> <link href="static/style/global.css?build+20140922" rel="stylesheet" type="text/css" /> <link href="static/style/main.css?build+20140922" rel="stylesheet" type="text/css" /> <link href="static/style/qingblog.css?build+20140922" rel="stylesheet" type="text/css" /> <link href="static/style/hack.css?build+20140922" rel="stylesheet" type="text/css" /><script type="text/javascript">
var thisSiteURL = '<?php echo $GLOBALS['_J']['config']['site_url']; ?>/';
var thisTopicLength = '<?php echo $GLOBALS['_J']['config']['topic_input_length']; ?>';
var thisMod = '<?php echo $this->Module; ?>';
var thisCode = '<?php echo $this->Code; ?>';
var thisFace = '<?php echo $__my['face_small']; ?>';
var YXM_POP_Title = '<?php echo $this->yxm_title; ?>';
var YXM_CODE_COM = '<?php echo $this->Config['seccode_comment']; ?>';
var YXM_CODE_FOR = '<?php echo $this->Config['seccode_forward']; ?>';
var __N_WEIBO__ = '<?php echo $this->Config['changeword']['n_weibo']; ?>';
var __P_WEIBO__ = '<?php echo $this->Config['changeword']['p_weibo']; ?>';
var __WEIQUN__ = '<?php echo $this->Config['changeword']['weiqun']; ?>';
var publish_in_str=[<?php echo $this->Config['in_publish_notice_js']; ?>];
var __ALERT__='<?php echo $this->Config['verify_alert']; ?>';
<?php if($GLOBALS['_J']['config']['qun_setting']['qun_open']) { ?>
var isQunClosed = false;
<?php } else { ?>var isQunClosed = true;
<?php } ?>
function faceError(imgObj) {
var errorSrc = '<?php echo $GLOBALS['_J']['config']['site_url']; ?>/images/noavatar.gif';
imgObj.src = errorSrc;
}
</script> <script type="text/javascript" src="static/js/min.js?build+20140922"></script> <script type="text/javascript" src="static/js/common.js?build+20140922"></script> </head> <?php echo $additional_str; ?> <body> <script type="text/javascript">
$(document).ready(function(){
//  $("#username").focus(function(){$("#username_label").hide(); });
//  $("#pwd").focus(function(){$("#pwd_label").hide();});
$(".ztag").click(function(){$(".c").toggleClass("c_ok");});
});			
</script> <div class="q_main"> <div class="q_login-b" style="opacity:1"> <img src="static/image/qing_bg1.jpg" style="width:100%;height:100%;margin-left:0;opacity:1;visibility:visible"> </div> <div class="q_index"> <div class="q_logo"> <a href="index.php" title="<?php echo $this->Config['site_name']; ?>"></a> </div> <div class="q_login"> <?php if($this->Config['seccode_enable']>1 && $this->Config['seccode_login'] && $this->yxm_title) { ?> <form method="<?php echo $login_extract_forms['method']; ?>" action="<?php echo $login_extract_forms['action']; ?>" id="guest_login" onKeyDown="if(event.keyCode==13) YXM_float();"autocomplete="off"   > <?php } else { ?><?php $login_seccode = $this->Config['seccode_enable']==1 && $this->Config['seccode_login'] ? 1 : 0; ?> <form method="<?php echo $login_extract_forms['method']; ?>" action="<?php echo $login_extract_forms['action']; ?>" id="guest_login" onKeyDown="if(event.keyCode==13) guestLoginSubmit(<?php echo $login_seccode; ?>);" autocomplete="off"  > <?php } ?> <div> <ul> <li class="li_name"> <div style="position:relative"> <input id="username_input" type="text" name="username" value="<?php echo $this->Config['changeword']['username']; ?>" onfocus="javascript:if(this.value=='<?php echo $this->Config['changeword']['username']; ?>')this.value='';" onblur="checkUsername(this.value);if(this.value==''){this.value='<?php echo $this->Config['changeword']['username']; ?>';}"> </div> <div id="username_tip"></div> </li> <li class="li_name"> <div style="position:relative"> <input id="password_input" type="password"  name="password" placeholder="√‹¬Î" onfocus="javascript:if(this.value=='<?php echo $this->Config['changeword']['username']; ?>')this.value='';"> <?php if($this->Config['seccode_login']) { ?> <span id="yxm_pub_button" onclick="YXM_popBox(this,'login','<?php echo $this->yxm_title; ?>');">&nbsp;</span> <?php } ?> </div> </li> <li class="li_name libtn"> <?php if($this->Config['seccode_enable']>1 && $this->Config['seccode_login'] && $this->yxm_title) { ?> <input class="btn" type="button" value="" onclick="YXM_float();"> <?php } else { ?> <?php $login_seccode = $this->Config['seccode_enable']==1 && $this->Config['seccode_login'] ? 1 : 0; ?> <input type="hidden" id="seccode_input" name="seccode_input"> <input class="btn" type="button" value="" onclick="guestLoginSubmit(<?php echo $login_seccode; ?>);"> <?php } ?> </li> </ul> <ul class="w_account"> <?php if(!$GLOBALS['_J']['config']['register_link_display'] && jsg_member_register_is_closed()) { ?> <?php } else { ?> <li> <a title="◊¢≤·<?php echo $GLOBALS['_J']['config']['site_name']; ?>" href="<?php echo $GLOBALS['_J']['config']['site_url']; ?>/index.php?mod=member">◊¢≤·<?php echo $GLOBALS['_J']['config']['site_name']; ?></a> </li> <?php } ?> <li class="chkbox"> <span class="c ztag c_ok"><input id="c0" type="checkbox" name="savelogin" value="1"></span> <a tabindex="3" class="ztag" href="javascript:void(0)">◊‘∂Øµ«¬º</a> <a href="<?php echo $GLOBALS['_J']['config']['site_url']; ?>/index.php?mod=get_password" class="forgetPass">Õ¸º«√‹¬Î</a> </li> <li> </li> </ul> </div> <p> <div class="loginother"><span>∆‰À¸∑Ω Ωµ«¬º£∫</span> <?php if($this->Config['sina_enable'] && sina_weibo_init()) { ?> <?php echo sina_weibo_login('s'); ?> <?php } ?> <?php if($this->Config['qqwb_enable'] && qqwb_init()) { ?> <?php echo qqwb_login('s'); ?> <?php } ?> <?php if($this->Config['yy_enable'] && yy_init()) { ?> <?php echo yy_login('s'); ?> <?php } ?> <?php if($this->Config['renren_enable'] && renren_init()) { ?> <?php echo renren_login('s'); ?> <?php } ?> <?php if($this->Config['kaixin_enable'] && kaixin_init()) { ?> <?php echo kaixin_login('s'); ?> <?php } ?> <?php if($this->Config['fjau_enable'] && fjau_init()) { ?> <?php echo fjau_login('s'); ?> <?php } ?> </div> </p> </form> </div> </div> </div> <?php if($this->Config['ad_enable']) { ?> <?php SetADV('topic_','footer'); ?> <?php } ?> </div> <div style="text-align:center;margin:20px auto 0; position:absolute; width:100%;"> <?php if($this->Config['default_module']==$this->Module && $this->Code==$this->Config['default_code']) { ?> <?php $link_config=jconf::get('link'); ?> <?php if($link_config) { ?>
”—«È¡¥Ω”£∫
<?php if(is_array($link_config)) { foreach($link_config as $link) { ?> <?php if(!empty($link['logo'])) { ?> <a href="<?php echo $link['url']; ?>" target="_blank"><img src="<?php echo $link['logo']; ?>" width="88" height="31" border="0" alt="<?php echo $link['name']; ?>"></a> <?php } else { ?><a href="<?php echo $link['url']; ?>" target="_blank"><?php echo $link['name']; ?></a> <?php } ?>
&nbsp;
<?php } } ?> <?php } ?> <br> <?php } ?> <?php echo $GLOBALS['_J']['config']['copyright']; ?>&nbsp;<a href="http://www.miibeian.gov.cn/" rel="nofollow" target="_blank" title="Õ¯’æ±∏∞∏"><?php echo $GLOBALS['_J']['config']['icp']; ?></a> <?php echo $GLOBALS['_J']['config']['tongji']; ?></div> <div id="show_message_area"></div> <?php echo $this->js_show_msg(); ?> <?php echo $GLOBALS['schedule_html']; ?> <?php if($GLOBALS['jsg_schedule_mark'] || jsg_getcookie('jsg_schedule')) echo jsg_schedule(); ?> <div id="ajax_output_area"></div> <script type="text/javascript">
function checkUsername(username){
if(!username || username == ''){
//		$('#username_tip').html('«Î ‰»Î’ ∫≈');
//		$('#username_tip').show();
//		$('#username_input').css({'border-color':'#F87F7F'});
//		$('#username_tip').addClass('username_tip_error');
//		$('#username_tip').css({'width':'135px','right':'5px','top':'7px','position':'absolute'});
$('.btn_login').attr('disabled',true);
return false;
}
$.post(
'ajax.php?mod=member&code=checkuser',
{username:username},
function(d){
if(d.done == false){
$('#username_tip').html(d.msg);
$('#username_tip').show();
$('#username_tip').addClass('username_tip_error');
$('#username_tip').css({'width':'75px','right':'5px','top':'43px','position':'absolute','background-image':'none'});
$('.btn_login').attr('disabled',true);
} else {
$('#username_tip').show();
$('#username_input').css({'border-color':'#999'});
$('#username_tip').removeClass('username_tip_error');
$('#username_tip').css({'width':'35px','right':'9px','top':'38px','position':'absolute'});
var html = "<img sr" + "c='" + d.msg+  "' onerror='javascript:faceError(this);'/>";
$('#username_tip').html(html);
$('.btn_login').attr('disabled',false);
}
},
'json'
)
}
function logincheckUsername(username){
if(!username || username == ''){
//		$('#username_tip').html('«Î ‰»Î’ ∫≈');
//		$('#username_tip').show();
//		$('#username_input').css({'border-color':'#F87F7F'});
//		$('#username_tip').addClass('username_tip_error');
//		$('#username_tip').css({'width':'135px','right':'5px','top':'7px','position':'absolute'});
$('.btn_login').attr('disabled',true);
return false;
}
$.post(
'ajax.php?mod=member&code=checkuser',
{username:username},
function(d){
if(d.done == false){
$('#username_tip').html(d.msg);
$('#username_tip').show();
$('#username_tip').addClass('username_tip_error');
$('#username_tip').css({'width':'auto'});
$('.btn_login').attr('disabled',true);
} else {
$('#username_tip').show();
$('#username_input').css({'border-color':'#d2d2d2'});
$('#username_tip').removeClass('username_tip_error');
$('#username_tip').css({'width':'35px','right':'5px','top':'7px','position':'absolute'});
var html = "<img sr" + "c='" + d.msg+  "' onerror='javascript:faceError(this);'/>";
$('#username_tip').html(html);
$('.btn_login').attr('disabled',false);
}
},
'json'
)
}
</script> <?php echo $this->yxm_html; ?> </body> </html>