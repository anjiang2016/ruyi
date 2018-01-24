<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?> 
<div class="sideBar"> <script type="text/javascript">
$(document).ready(function(){
$("#m_avatar2").mouseover(function(){$(".avatar2_tips").show();});
$("#m_avatar2").mouseout(function(){$(".avatar2_tips").hide();});
var click_attup = $(".side-att-more-btn");
var show_attlist = $(".side-att-more");
//var show_attmoreli = $(".side-att-moreLi");
click_attup.click(function(){
if(show_attlist.css('display') == 'none')
{
show_attlist.show();
click_attup.text("收起更多");
}
else
{
show_attlist.hide();
click_attup.text("更多");
}
});
});
</script> <?php if(($my_member || $member)&&('mydig' == $this->Get['type'] || !in_array($params['code'],array('myblog','outbox')))) { ?> <?php $_mymember = $my_member ? $my_member : $member ?> <div class="memberBox"> <div class="person_info"> <div class="avatar2" id="m_avatar2"> <a href="index.php?mod=<?php echo $_mymember['username']; ?>" title="<?php echo $_mymember['nickname']; ?>"> <img src="<?php echo $_mymember['face_original']; ?>" alt="<?php echo $_mymember['nickname']; ?>" onerror="javascript:faceError(this);" /> </a> <?php if(MEMBER_ID == $_mymember['uid']) { ?> <p class="avatar2_tips"><a id="avatar_upload" href="index.php?mod=settings&code=face">修改头像</a></p> <?php } ?> </div> <div class="avatar2_info"> <p class="name"> <a href="index.php?mod=<?php echo $member['username']; ?>" title="@<?php echo $member['nickname']; ?>"><b><?php echo $member['nickname']; ?></b></a> </p> <p><?php echo $member['validate_html']; ?></p> <?php if($this->Config['level_radio']) { ?> <?php if($this->Config['topic_level_radio']) { ?> <p class="ico_bed"> <a href="index.php?mod=settings&code=exp" title="点击查看微博等级"  target="_blank" class="ico_level wbL<?php echo $member['level']; ?>"><?php echo $member['level']; ?></a> </p> <?php } ?> <?php } ?> <?php if($member['credits']) { ?> <div class="integral">积分：<a title="点击查看我的积分" href="index.php?mod=settings&code=extcredits"><?php echo $member['credits']; ?></a></div> <?php } ?> </div> </div> <div class="edit_sign"> <?php $member_signature = cut_str($member['signature'],20); ?> <?php if($member['uid'] == MEMBER_ID ) { ?> <span> <a href="javascript:viod(0);" onclick="follower_choose(<?php echo $member['uid']; ?>,'<?php echo $member['nickname']; ?>','topic_signature'); return false;" title="编辑个人签名" > <?php if($member['signature']) { ?> <?php echo $member_signature; ?> <?php } else { ?>编辑个人签名
<?php } ?> <img src="static/image/qianming.png"> </a></span> <?php } else { ?> <span> <?php if($member['signature']) { ?> <?php if($val['uid'] == MEMBER_ID ||  'admin' == MEMBER_ROLE_TYPE) { ?> <a href="javascript:void(0);" onclick="follower_choose(<?php echo $member['uid']; ?>,'<?php echo $member['nickname']; ?>','topic_signature');" title="编辑个人签名"> <em ectype="user_signature_ajax_<?php echo $member['uid']; ?>">（<?php echo $member_signature; ?>）</em> </a> <?php } ?> <?php } else { ?><?php echo $member['gender_ta']; ?>没有填写个人签名
<?php } ?> </span> <?php } ?> </div> <div class="geren_msg" style="display:none;"> <p><a href="javascript:void(0);">公司 ：杭州神话信息技术有限公司</a></p> <p><a href="javascript:void(0);">部门 ：运营中心设计部</a></p> <p><a href="javascript:void(0);">岗位 ：UI视觉设计</a></p> </div> <div class="user_atten"> <div class="person_atten_l"> <p><span class="num"><a href="index.php?mod=follow&uid=<?php echo $member['uid']; ?>" title="<?php echo $member['nickname']; ?>关注的"><?php echo $member['follow_count']; ?></a></span></p> <p><a href="index.php?mod=follow&uid=<?php echo $member['uid']; ?>" title="<?php echo $member['nickname']; ?>关注的">关注</a> </p> </div> <div class="person_atten_l"> <p><span class="num"><a href="index.php?mod=fans&uid=<?php echo $member['uid']; ?>" title="关注<?php echo $member['nickname']; ?>的"><?php echo $member['fans_count']; ?></a></span></p> <p><a href="index.php?mod=fans&uid=<?php echo $member['uid']; ?>" title="关注<?php echo $member['nickname']; ?>的">粉丝</a> </p> </div> <div class="person_atten_l"> <p><span class="num"><a href="index.php?mod=<?php echo $member['username']; ?>" title="<?php echo $member['nickname']; ?>的<?php echo $this->Config['changeword']['n_weibo']; ?>"><?php echo $member['topic_count']; ?></a></span></p> <p><a href="index.php?mod=<?php echo $member['username']; ?>" title="<?php echo $member['nickname']; ?>的<?php echo $this->Config['changeword']['n_weibo']; ?>"><?php echo $this->Config['changeword']['n_weibo']; ?></a> </p> </div> <div class="person_atten_l"> <p><span class="num"><a href="index.php?mod=<?php echo $member['username']; ?>&type=mydig" title="赞过<?php echo $member['nickname']; ?>的"><?php echo $member['digcount']; ?></a></span></p> <p><a href="index.php?mod=<?php echo $member['username']; ?>&type=mydig" title="赞过<?php echo $member['nickname']; ?>的">被<?php echo $this->Config['changeword']["dig"]; ?></a> </p> </div> </div> </div> <?php } ?> <script type="text/javascript">
function AutoScroll(obj){
$(obj).find("ul:first").animate({
marginTop:"-39px"
},500,function(){
$(this).css({marginTop:"0px"}).find("li:first").appendTo(this);
});
}
$(document).ready(function(){
setInterval('AutoScroll("#important_scroll")',3000);
});
</script> <script language="javascript">$(document).ready(function(){get_channel_announce_news(8);});</script> <div class="column" id="channel_news_list"></div> <?php if($this->Module=='topic' && $this->Code=='myhome') { ?> <style type="text/css">
.sublist{
display:none;
padding-left:10px;
}
</style> <script>
function show_attach_sub_list(obj,type){
$(obj).parent().next(".sublist").toggle();
if($(obj).parent().next(".sublist:visible").length){
if(type == 'img'){
$(obj).attr("src",'images/cp/close.gif');
}else{
$(obj).prev('img').attr("src",'images/cp/close.gif');
}
} else {
if(type == 'img'){
$(obj).attr("src",'images/cp/open.gif');
}else{
$(obj).prev('img').attr("src",'images/cp/open.gif');
}
}
}
</script> <?php $__all_cat_att = jlogic('attach_category')->get_all_cat_att(); ?> <?php SetADV('group_myhome','middle_right_top'); ?> <script type="text/javascript">
$(document).ready(function(){
$(".side-tab").mouseover(function(){
var tagTab=$(this).attr('id');
if(tagTab=='hot-tag'){
$("#recom-tag").removeClass('tag-select');$("#hot-tag").addClass('tag-select');$(".hot-tagbox").show();$(".recom-tagbox").hide();}
else{$("#hot-tag").removeClass('tag-select');$("#recom-tag").addClass('tag-select');$(".recom-tagbox").show();$(".hot-tagbox").hide();
}});});
</script> <!-- 
<?php $hot_tag_recommend = jconf::get('hot_tag_recommend'); ?>
--> <div class="column" style="overflow:hidden;"> <div class="side-tabtit"> <span id="hot-tag" class="side-tab hot-tag tag-select">热门话题</span > <?php if($hot_tag_recommend['enable']) { ?> <span id="recom-tag" class="side-tab"><?php echo $hot_tag_recommend['name']; ?></span > <?php } ?> </div> <div class="tagpanel"> <div class="hot-tagbox"> <?php if(method_exists($this,'_recommendTag')) { ?> <?php $r_tags = $this->_recommendTag(2,10,$this->CacheConfig['topic_index']['hot_tag']); ?> <?php if(is_array($r_tags)) { foreach($r_tags as $__one_key => $__one) { ?> <span class="ut<?php echo $__one_key; ?>"><a href="index.php?mod=tag&code=<?php echo $__one['name']; ?>" target="_blank"><?php echo $__one['name']; ?></a></span> <?php } } ?> <?php } ?> </div> <?php if($hot_tag_recommend['enable']) { ?> <div class="recom-tagbox"> <?php if(is_array($hot_tag_recommend['list'])) { foreach($hot_tag_recommend['list'] as $hot_tag_recommend_one) { ?> <li> <a href="index.php?mod=tag&code=<?php echo $hot_tag_recommend_one['name']; ?>">#<?php echo $hot_tag_recommend_one['name']; ?>#</a> <?php if($hot_tag_recommend_one['desc']) { ?> <p class="total"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <?php echo $hot_tag_recommend_one['desc']; ?></p> <?php } ?> </li> <?php } } ?> </div> <?php } ?> </div> </div> <?php } ?> <?php if(false!=($week_topic_member=jlogic('member')->get_member_by_topic(12))) { ?> <div class="column" style="padding-bottom:10px;"> <h3><span>活跃用户推荐</span> </h3> <ul class="sideul sideuserList "> <div id="<?php echo MEMBER_ID; ?>_recommend_user"> <?php if(is_array($week_topic_member)) { foreach($week_topic_member as $val) { ?> <li> <a href="index.php?mod=<?php echo $val['username']; ?>" target="_blank"><img onerror="javascript:faceError(this);" src="<?php echo $val['face']; ?>" class="manface" onmouseover="get_user_choose(<?php echo $val['uid']; ?>,'_user',<?php echo $val['uid']; ?>)" onmouseout="clear_user_choose()"/></a> <b><a href="index.php?mod=<?php echo $val['username']; ?>" target="_blank"><?php echo $val['nickname']; ?></a></b> <div id="user_<?php echo $val['uid']; ?>_user"></div> <div id="alert_follower_menu_<?php echo $val['uid']; ?>"></div> <div id="global_select_<?php echo $val['uid']; ?>" class="alertBox"></div> <div id="get_remark_<?php echo $val['uid']; ?>" ></div> <div id="button_<?php echo $val['uid']; ?>" onclick="get_group_choose(<?php echo $val['uid']; ?>);"></div> <div id="Pmsend_to_user_area"></div> </li> <?php } } ?> </div> </ul> </div> <?php } ?> <?php if($GLOBALS['_J']['config']['feed_must']) { ?> <script type="text/javascript">
$(document).ready(function(){get_feed_news(5);});
if(!($.browser.msie && $.browser.version<7)){$("#side_follow").fixbox({distanceToBottom:200,threshold:8});}
function get_feed_news(num){var num = 'undefined' == typeof(num) ? 5 : num;var myAjax=$.post("ajax.php?mod=dig&code=feednews",{num:num},function(d){$('#feed_news_list').html(evalscript(d));});return false;}
function circle_feed(){get_feed_news(5);setTimeout('circle_feed();',60000);}
setTimeout('circle_feed();',60000);
function autoScroll(obj){$(obj).find("#feed_news_list").animate({marginTop:"-50px"},500,function(){$(this).css({marginTop : "0px"}).find("li:first").appendTo(this);})}
$(function(){setInterval('autoScroll(".feed_news_list_cols")',3000)})
</script> <div id="side_follow"> <div class="column" style="border-top:none;"> <div class="cols"> <h3>重要动态</h3> <ul class="feed_news_list_cols"> <ul id="feed_news_list"> </ul> </ul> </div> </div> <?php } ?> <div class="column"> <h3>手机访问<?php echo $this->Config['site_name']; ?></h3> <div class="phoneShow"> <div class="mobi"> <i>客户端：</i> <a href="index.php?mod=other&code=iphone" target="_blank" class="ios" title="ios客户端"></a> <a href="index.php?mod=other&code=android" target="_blank" class="android" title="android客户端"></a> </div> </div> <div class="phoneShow"> <i>其他方式：</i> <a href="index.php?mod=other&code=mobile" target="_blank">3G版</a>&nbsp;&nbsp;
<a href="index.php?mod=other&code=wap" target="_blank">Wap版</a>&nbsp;&nbsp;
<a href="index.php?mod=other&code=wechat" target="_blank">微信</a>&nbsp;&nbsp;
<?php if(!$this->Config['sms_enable'] && !$this->Config['sms_link_display']) { ?>
&nbsp;
<?php } else { ?> <a href="index.php?mod=other&code=sms" rel="nofollow" target="_blank">短信</a> <?php } ?> <?php if($this->Config['wechat_enable'] && $this->Config['wechat_qrcode']) { ?> <div>请关注官方微信（搜索帐号<span style="color:red;"><?php echo $this->Config['my_wechat']; ?></span>或扫一扫）</div> <a href="index.php?mod=other&code=wechat" target="_blank" style="text-align: center;width: 100%;"> <img src="<?php echo $this->Config['wechat_qrcode']; ?>" width="150px" height="150px" alt="微信" title="扫一扫，加关注" > </a> <?php } ?> </div> </div> </div> </div> <script>
function get_channel_announce_news(num){
var num = 'undefined' == typeof(num) ? 5 : num;
var myAjax=$.post("ajax.php?mod=dig&code=cnews",{num:num},function(d){$('#channel_news_list').html(evalscript(d));});
return false;
}
</script>