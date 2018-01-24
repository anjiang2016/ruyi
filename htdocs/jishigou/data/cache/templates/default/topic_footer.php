<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?></div> </div> <?php if(!empty($GLOBALS['_J']['pluginhooks']['global_footer_top'])) echo $GLOBALS['_J']['pluginhooks']['global_footer_top'];?> <?php if(!defined('NEDU_MOYO')) { ?> <div class="g-ft"> <div class="m-ft"><?php jwidget('public', 'footer'); ?> </div> </div> <?php } ?> <?php if(!empty($GLOBALS['_J']['pluginhooks']['global_footer'])) echo $GLOBALS['_J']['pluginhooks']['global_footer'];?> <div id="f-top" class="f-top"><a href="/#" class="f-top-a" title="返回顶部"></a></div> <div id="show_message_area"></div> <?php echo $this->js_show_msg(); ?> <?php if($sendMail) { ?> <span style='display:none;'><img src='<?php echo $GLOBALS['_J']['config']['site_url']; ?>/ajax.php?mod=misc&code=sendmailqueue' border='0' width='0' height='0' /></span> <?php } ?> <?php if($checkUser) { ?> <span style='display:none;'><img src='<?php echo $GLOBALS['_J']['config']['site_url']; ?>/ajax.php?mod=misc&code=checkuser' border='0' width='0' height='0' /></span> <?php } ?> <?php echo $GLOBALS['schedule_html']; ?> <?php if($GLOBALS['jsg_schedule_mark'] || jsg_getcookie('jsg_schedule')) echo jsg_schedule(); ?> <div id="ajax_output_area"></div> <?php $_web_info = jconf::get('web_info'); ?> <?php if($_web_info['float_align'] && $_web_info['float_align'] != 'none') { ?> <?php if($_web_info['float_style']=='mini') { ?> <?php $fs_mini='';$fs_normal='display:none;'; ?> <?php } else { ?><?php $fs_mini='display:none;';$fs_normal=''; ?> <?php } ?> <script type="text/javascript" src="static/js/scrollBox.js?build+20140922"></script> <div id="jsg-global-float-div" style="display:none;"> <div id="jsg-global-float-mini" style="<?php echo $fs_mini; ?>"> <img src="./images/global_float_infomation.gif" /> </div> <div id="jsg-global-float-content" class="jsg-global-float-content" style="<?php echo $fs_normal; ?>"> <?php echo $_web_info['float']; ?> </div> </div> <script type="text/javascript">
$(document).ready(function(){
$('#jsg-global-float-div').scrollBox({
top: 200,
align: '<?php echo $_web_info["float_align"]; ?>',
mix: 12
});
// 
<?php if($_web_info['float_style']=='mini') { ?>
$('#jsg-global-float-mini').bind('mouseenter', function(){
$('#jsg-global-float-content').show();
$('#jsg-global-float-mini').hide();
});
$('#jsg-global-float-content').bind('mouseleave', function(){
$('#jsg-global-float-mini').show();
$('#jsg-global-float-content').hide();
});
// 
<?php } ?>
});
</script> <?php } ?> <script type="text/javascript">
$(document).ready(function(){
//图片延迟加载
$("ul.imgList img, div.avatar img.lazyload").lazyload({
skip_invisible : false,
threshold : 200,
effect : "fadeIn"
});
//微博悬浮显示已赞用户
showdiguser();
//显示推荐人
showrcduser();
//返回顶部
$('.f-top-a').click(function(e){
e.stopPropagation();
$('html, body').animate({scrollTop: 0},300);
backTop();
return false;
});
});
window.onscroll=backTop;
function backTop(){
var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
if(scrollTop==0){
document.getElementById('f-top').style.display="none";
}else{
document.getElementById('f-top').style.display="block";
}
}
backTop();
<?php if($this->Config['ajax_topic_time'] > 0 && MEMBER_ID > 0 && !$this->Config['acceleration_mode'] && ('myhome'==$this->Code || 'ico_ongoing'==$live['status_css'] || ('topicnew'==jget('code') && 'post'==jget('orderby')))) { ?> <?php $ajax_time = $this->Config['ajax_topic_time'] * 1000; ?>
function circle_topic() {
ajax_reminded(<?php echo MEMBER_ID; ?>,0,'<?php echo $GLOBALS['_J']['code']; ?>');
ajax_recommend(<?php echo MEMBER_ID; ?>);
setTimeout('circle_topic();', <?php echo $ajax_time; ?>);
}
setTimeout('circle_topic();', <?php echo $ajax_time; ?>);
<?php } ?> </script> <?php echo $this->yxm_html; ?> </div> </body> </html> <?php echo $GLOBALS['iframe']; ?>