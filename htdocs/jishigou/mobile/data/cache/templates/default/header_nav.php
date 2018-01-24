<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?><div id="g_header"> <?php if($this->Code != "at_my" && $this->Code != "comment_my") { ?> <div class="g_left_nav_toolbar"> <ul> <?php if($this->Code=='publish') { ?> <li><button class="g_nav_btn" onclick="history.go(-1);">取消</button></li><?php } elseif(in_array($this->Module, array('search')) || in_array($this->Code, array('detail', 'hot_comments', 'hot_forwards', 'new', 'comment', 'follow', 'fans', 'my_blog', 'list', 'blacklist', 'my_favorite', 'tag', 'about','introduce'))) { ?> <li><button class="g_nav_btn" onclick="history.go(-1);">返回</button></li> <?php } elseif($this->Code == 'userinfo' && $_GET['uid'] != MEMBER_ID) { ?> <li><button class="g_nav_btn" onclick="history.go(-1);">返回</button></li> <?php } elseif($this->Code=='login') { ?> <li>&nbsp;</li> <?php } elseif($this->Code=='at_my' && $this->Code=='comment_my') { ?> <li><button class="g_nav_btn" onclick="history.go(-1);">返回</button></li> <?php } else { ?> <li><button class="g_nav_btn" onclick="history.go(-1);">返回</button></li> <?php } ?> </ul> </div> <?php } ?> <div class="
<?php if($this->Code != "at_my" && $this->Code != "comment_my") { ?>
g_middle_nav_toolbar
<?php } else { ?>g_middle_nav_toolbar_message
<?php } ?>
"> <?php if($this->Code == "home") { ?> <?php echo Mobile::convert($GLOBALS['_J']['member']['nickname']) ?><?php } elseif($this->Code == "at_my" || $this->Code == "comment_my") { ?> <?php $tab_msg_actives[$this->Code] = "g_middle_chute_on"; ?> <div class="g_middle_chute"> <ul> <li class="<?php echo $tab_msg_actives['at_my']; ?>" onclick="changeMessageTab(TAB_MESSAGE_AT);">@我</li> <li class="s <?php echo $tab_msg_actives['comment_my']; ?>" onclick="changeMessageTab(TAB_MESSAGE_COMMENT);">评论</li> </ul> </div> <?php } elseif($this->Module == "search") { ?> <?php $s_title_ary = array('user'=>'搜索用户','topic'=>'搜索微博') ?> <?php echo $s_title_ary[$this->Code] ?> <?php } elseif($this->Code == "userinfo") { ?> <?php if($_GET['uid'] == MEMBER_ID) { ?>
我的资料
<?php } else { ?>        	资料
<?php } ?> <?php } elseif($this->Module == "more") { ?> <?php if($this->Code == "about") { ?>
关于
<?php } else { ?>        	更多
<?php } ?> <?php } elseif($this->Code == "3g") { ?>            广场
<?php } elseif($this->Code == "publish") { ?> <?php if($_GET['pt'] == "new") { ?>
发送新微博
<?php } elseif($_GET['pt'] == "reply") { ?>        	评论
<?php } elseif($_GET['pt'] == "forward") { ?>        	转发
<?php } ?> <?php } elseif($this->Code == "detail") { ?>            微博正文
<?php } elseif($this->Code == 'hot_comments') { ?>            热门评论
<?php } elseif($this->Code == "new") { ?>            随便看看
<?php } elseif($this->Code == "hot_forwards") { ?>            热门转发
<?php } else { ?><?php $_title_ary = array('follow'=>'关注','fans'=>'粉丝','my_blog'=>'我的微博','list'=>'话题','blacklist'=>'黑名单','my_favorite'=>'收藏','tag'=>'话题', 'comment'=>'评论', 'login'=>'登录') ?> <?php echo $_title_ary[$this->Code] ?> <?php } ?> </div> <div class="g_right_nav_toolbar"> <ul> <?php if($this->Code=='publish') { ?> <?php } elseif($this->Code=='comment') { ?> <li><button class="g_nav_btn_edit" onclick="openPublishBox(PUBLISH_COMMENT, {totid:'<?php echo $tid; ?>'});">&nbsp;</button></li> <?php } elseif($this->Code=='login') { ?> <li>&nbsp;</li> <?php } else { ?> <li><button class="g_nav_btn_ref">&nbsp;</button> <div class="sub-index-nav up-arrow right-arrow"> <a href="javascript:location.reload();"><span><i class="icon refresh"></i>刷新</span></a> <a href="javascript:;" onclick="changeTab(TAB_HOME);"><span><i class="icon home"></i>首页</span></a> <?php if(!in_array($this->Code, array('publish', 'detail', 'userinfo','tag','login', 'about')) || ($this->Code=="userinfo" && $this->Get['uid'] == MEMBER_ID)) { ?> <?php $tab = $this->Code;if(empty($tab))$tab = $this->Module; $tab_actives[$tab] = "g_tabbar_on"; ?> <a href="javascript:;" onclick="openPublishBox(PUBLISH_NEW)"><span><i class="icon write"></i>写微博</span></a> <a href="javascript:;" onclick="changeTab(TAB_MESSAGE);"><span><i class="icon msg"></i>我的信息</span></a> <?php if($member['uid'] == MEMBER_ID) { ?> <a href="javascript:;" onclick="goToMyFavList();"><span><i class="icon favorite"></i>我的收藏</span></a> <a href="javascript:;" onclick="goToBlackList('<?php echo $member['uid']; ?>');"><span><i class="icon blacklist"></i>黑名单</span></a> <?php } ?> <a href="javascript:;" onclick="changeTab(TAB_PROFILE);"><span><i class="icon info"></i>我的资料</span></a> <?php } elseif($this->Code=="userinfo" && $this->Get['uid'] != MEMBER_ID) { ?> <a href="javascript:openPublishBox(PUBLISH_NEW, {'atuid':<?php echo $member['uid']; ?>});">@TA</a> <a href="javascript:
<?php if($is_blacklist) { ?>
delFromBlackList('btn_blacklist', <?php echo $member['uid']; ?>, 1)
<?php } else { ?>addToBlackList('btn_blacklist', <?php echo $member['uid']; ?>, 1)
<?php } ?>
;" class="btn_blacklist" id="btn_blacklist">加入黑名单</a> <?php } ?> <a href="javascript:;" onclick="changeTab(TAB_SQUARE);"><span><i class="icon top"></i>广场</span></a> <a href="javascript:;" onClick="location.href='index.php?mod=member&code=logout'"><span><i class="icon exit"></i>退出</span></a> </div> <script type="text/javascript">
$(".g_nav_btn_ref").click( function(){ $(".sub-index-nav").toggle();});
</script> </li> <?php } ?> </ul> </div> </div> <div id="g_tips" onclick="closeTipsExp();"> </div> <?php if($_GET['code'] == 'login') { ?> <style type="text/css">
#g_isrcollWrapper {
bottom:0px;
}
</style> <?php } ?> <div id="g_isrcollWrapper">