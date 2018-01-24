<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?>
<style type="text/css">
.relaycontent .Contant,.relaycontent .topicTxt {
width: auto;
float: none;
position: relative;
padding: 0;
}
.relaycontent .feedCell .avatar {
width: 25px;
box-shadow: none;
}
.relayFloorface .feedCell .avatar img {
width: 25px;
height: 25px;
}
.relayFloorface .feedCell .wb_l_face,.relayFloorface .feedCell .avatar {
width: 25px;
height: 25px;
box-shadow: none;
margin: 0;
}
.relaycontent .topicTxt {
box-shadow: none;
background: none;
}
.relaycontent .feedCell .avatar {
width: 25px;
height: 25px;
box-shadow: none;
}
.relaycontent .from {
width: 100%;
}
.feedCell .avatar {
width: 25px;
height: 25px;
box-shadow: none;
}
.user_floor a {
float: left;
margin-right: 5px;
}
.con_floor {
display: block;
margin: 0;
float: none;
}
.con_floor ul.attachList{ 
width:auto;
}
.user_floor {
float: none;
width: 100%;
float:left;
clear:both;
}
.relayFloor .relaycontent .relayFloorface {
position: static;
float: left;
left: initial;
}
#listTopicArea .feedCell .relayFloor .relaycontent .relayFloorface .wb_l_face {
margin: 0;
width:25px;
height:25px;
}
.relayFloor .relaycontent .Contant {
float: none;
background: none;
margin: 0;
}
</style> <div class="Contant"> <div id="topic_lists_<?php echo $val['tid']; ?>" style="_overflow: hidden;"> <div class="topicTxt"> <div class="user_floor"><span class="un"> <?php if($val['anonymous']) { ?> <a title="<?php echo $val['nickname']; ?>" href="javascript:void(0)" class="photo_vip_t_name"><?php echo $val['nickname']; ?></a> <?php } else { ?><a title="查看<?php echo $val['nickname']; ?>的<?php echo $this->Config['changeword']['n_weibo']; ?>" href="index.php?mod=<?php echo $val['username']; ?>" class="photo_vip_t_name"  onmouseover="get_at_user_choose('<?php echo $val['nickname']; ?>',this)"><?php echo $val['nickname']; ?></a> <?php if($val['validate_html']) { ?> <?php echo $val['validate_html']; ?> <?php } else { ?> <?php if($this->Config['topic_level_radio']) { ?> <span class="wb_l_level"> <a class="ico_level wbL<?php echo $val['level']; ?>" title="等级：<?php echo $val['level']; ?>级" href="index.php?mod=settings&code=exp" target="_blank"><?php echo $val['level']; ?></a> </span> <?php } ?> <?php } ?> <?php if($this->Config['is_signature']) { ?> <?php if(!$_GET['mod_original'] && 'photo'!=$this->Code) { ?> <?php if($val['signature']) { ?> <span class="signature"> <?php if($val['uid'] == MEMBER_ID ||  'admin' == MEMBER_ROLE_TYPE) { ?> <a href="javascript:void(0);" onclick="follower_choose(<?php echo $val['uid']; ?>,'<?php echo $val['nickname']; ?>','topic_signature');" title="点击修改个人签名"> <em ectype="user_signature_ajax_<?php echo $val['uid']; ?>">（<?php echo $val['signature']; ?>）</em> </a> <?php } else { ?><em> (<?php echo $val['signature']; ?>)</em> <?php } ?> </span> <?php } ?> <?php } ?> <?php } ?> <?php } ?> </span></div> <div class="con_floor"> <?php if(($val["item"]=="vote")&&$val["item_id"]) { ?> <?php $myOption=jlogic('vote')->get_vote_item($val["item_id"],
$val["uid"],
1, $val['addtime']);!$myOption['option']||$string=implode('，',$myOption['option']); ?> <?php if($string) { ?> <span class="topic_select" title="投票给：<?php echo $string; ?>"><span>投票给：<?php echo $string; ?></span> </span><br /> <?php } ?> <?php } ?> <span id="topic_content_<?php echo $val['tid']; ?>_short"> <?php echo $val['content']; ?> <?php if($val['imageid'] && $val['image_list']) { ?> <div
onclick="view_longtext('<?php echo $val['longtextid']; ?>', '<?php echo $val['tid']; ?>', '<?php echo $val['tid']; ?>');
if(($.trim(($('#<?php echo $talkanswerid; ?>reply_area_<?php echo $val['tid']; ?>').html()))).length < 1) {
$('#topic_list_reply_<?php echo $val['tid']; ?>_aid').click();
}; return false;"> <ul class="imgList"> <?php if(is_array($val['image_list'])) { foreach($val['image_list'] as $iv) { ?> <li><img src="static/image/grey.gif"
data-original="<?php echo $iv['image_small']; ?>" class="showcursor d"> </li> <?php } } ?> </ul> </div> <?php } ?> </span> <?php if($val['imageid'] && $val['image_list']) { ?> <div style="display: none;"> <ul class="imgList"> <?php if(is_array($val['image_list'])) { foreach($val['image_list'] as $iv) { ?> <li><img src="static/image/grey.gif"
data-original="<?php echo $iv['image_original']; ?>"> </li> <?php } } ?> </ul> </div> <?php } ?> <span id="topic_content_<?php echo $val['tid']; ?>_full"></span> <?php if($val['longtextid'] > 0) { ?> <a class="longText" href="javascript:;" id="longText_<?php echo $val['tid']; ?>"
onclick="view_longtext('<?php echo $val['longtextid']; ?>', '<?php echo $val['tid']; ?>', '<?php echo $val['tid']; ?>');return false;">查看全文</a> <?php } ?> <?php if($val['attachid'] && $val['attach_list']) { ?> <?php $val['attach_key']=$val['tid'].'_'.mt_rand(); ?> <ul class="attachList" id="attach_area_<?php echo $val['attach_key']; ?>"> <?php if(is_array($val['attach_list'])) { foreach($val['attach_list'] as $iv) { ?> <?php $attachaid=$iv['id']; ?> <li><img src="<?php echo $iv['attach_img']; ?>" class="attachList_img" /> <div class="attachList_att"> <p class="attachList_att_name"><b><?php echo $iv['attach_name']; ?></b>
&nbsp;（<?php echo $iv['attach_size']; ?>）</p> <p class="attachList_att_doc"> <?php if($iv['onlineview']) { ?> <a href="<?php echo $iv['onlineview']; ?>" target="_blank">在线预览</a> | 
<?php } ?> <a href="javascript:void(0);"
onclick="downattach(<?php echo $iv['id']; ?>);">点此下载</a>（需<font id="attach_score_<?php echo $iv['id']; ?>"><?php echo $iv['attach_score']; ?></font>积分，已下载<font id="attach_downnum_<?php echo $iv['id']; ?>" class="attach_downnum_<?php echo $iv['id']; ?>"><?php echo $iv['attach_down']; ?></font>次）<?php if(!empty($GLOBALS['_J']['pluginhooks']['global_item_attach'][$attachaid])) echo $GLOBALS['_J']['pluginhooks']['global_item_attach'][$attachaid];?></p> </div> </li> <?php } } ?> </ul> <?php } ?> <?php if($val['is_vote'] > 0) { ?> <?php $val['vote_key']=$val['tid'].'_'.$val['random'] ?> <ul class="imgList" id="vote_detail_<?php echo $val['vote_key']; ?>"> <li><a href="javascript:;"
onclick="getVoteDetailWidgets('<?php echo $val['vote_key']; ?>', <?php echo $val['is_vote']; ?>);"><img
src='./images/vote_pic_01.gif' /></a></li> </ul> <div id="vote_area_<?php echo $val['vote_key']; ?>" style="display: none;"> <div class="relayTxt"> <div class="mid" id="vote_content_<?php echo $val['vote_key']; ?>"></div> </div> </div> <?php } ?> <?php if($val['is_reward'] > 0) { ?> <ul class="imgList" id="reward_detail_<?php echo $val['tid']; ?>"> <li> <a href="javascript:;" onclick="getRewardDetailWidgets('<?php echo $val['tid']; ?>','<?php echo $val['item_id']; ?>');"><img src="<?php echo $val['reward_image']; ?>"/></a> </li> <li> <a href="javascript:;" onclick="getRewardDetailWidgets('<?php echo $val['tid']; ?>','<?php echo $val['item_id']; ?>');"><img src="./images/reword1.png"  style="padding:68px 0 0 40px;"/></a> </li> </ul> <div id="reward_area_<?php echo $val['tid']; ?>" style="display: none;"> <div class="relayTxt"> <div class="mid" id="reward_content_<?php echo $val['tid']; ?>" style="padding:10px 0"></div> </div> </div> <?php } ?> <?php if($val['videoid'] and $this->Config['video_status']) { ?> <div class="feedUservideo a"><a
onClick="javascript:showFlash('<?php echo $val['VideoHosts']; ?>', '<?php echo $val['VideoLink']; ?>', this, '<?php echo $val['VideoID']; ?>','<?php echo $val['VideoUrl']; ?>');"> <div id="play_<?php echo $val['VideoID']; ?>" class="vP"><img
src="images/feedvideoplay.gif" /></div> <img src="<?php echo $val['VideoImg']; ?>" style="border: none" /> </a></div> <?php } ?> <?php if($val['musicid']) { ?> <?php if($val['xiami_id']) { ?> <div class="feedUserImg"><embed width="257" height="33"
wmode="transparent" type="application/x-shockwave-flash"
src="http://www.xiami.com/widget/0_<?php echo $val['xiami_id']; ?>/singlePlayer.swf"></embed></div> <?php } else { ?><div class="feedUserImg"> <div id="play_<?php echo $val['MusicID']; ?>"></div> <img src="static/image/music.gif" title="点击播放音乐"
onClick="javascript:showFlash('music', '<?php echo $val['MusicUrl']; ?>', this, '<?php echo $val['MusicID']; ?>');"
style="cursor: pointer; border: none;" /></div> <?php } ?> <?php } ?> <script type="text/javascript"> var __TOPIC_VIEW__ = '<?php echo $topic_view; ?>'; </script> <?php if(($tpid=$val['top_parent_id'])>0 && !in_array($this->Code, array('forward', 'reply'))) { ?> <?php if(!$topic_view) { ?> <?php $pt=$parent_list[$tpid]; ?> <div class="relayTxt"> <div class="mid"> <p> <?php if($pt) { ?> <span> <?php if($pt['anonymous']) { ?> <a href="javascript:void(0)"> <?php echo $pt['nickname']; ?> </a> <?php } else { ?><a
href="index.php?mod=<?php echo $pt['username']; ?>"
onmouseover="get_user_choose(<?php echo $pt['uid']; ?>,'_reply_user',<?php echo $val['tid']; ?>);"
onmouseout="clear_user_choose();"> <?php echo $pt['nickname']; ?> </a> <?php echo $pt['validate_html']; ?> <?php } ?>
:   <span
id="user_<?php echo $val['tid']; ?>_reply_user"></span> </span> <?php if(($pt["item"]=="vote")&&$pt["item_id"]) { ?> <?php $myOption=jlogic('vote')->get_vote_item($pt["item_id"], $pt["uid"], 1, $pt['addtime']);$string='';!$myOption['option']||$string=implode('，',$myOption['option']); ?> <?php if($string) { ?> <br><span class="topic_select"><span>投票给：<?php echo $string; ?></span></span><br /> <?php } ?> <?php } ?> <?php $TPT_ = $val['tid'].'_'; ?> <div id="topic_content_<?php echo $TPT_; ?><?php echo $pt['tid']; ?>_short"> <?php echo $pt['content']; ?> <?php if(!empty($GLOBALS['_J']['pluginhooks']['global_item_parent_extra'][$topictid])) echo $GLOBALS['_J']['pluginhooks']['global_item_parent_extra'][$topictid];?> <?php if($pt['imageid'] && $pt['image_list']) { ?> <div onclick="view_longtext('<?php echo $pt['longtextid']; ?>', '<?php echo $pt['tid']; ?>', '<?php echo $pt['tid']; ?>', '<?php echo $TPT_; ?>', '<?php echo $pt['tid']; ?>');return false;"> <ul class="imgList"> <?php if(is_array($pt['image_list'])) { foreach($pt['image_list'] as $iv) { ?> <li><img src="static/image/grey.gif" data-original="<?php echo $iv['image_small']; ?>"></li> <?php } } ?> </ul> </div> <?php } ?> </div> <?php if($pt['imageid'] && $pt['image_list']) { ?> <div style="display:none;"> <ul class="imgList"> <?php if(is_array($pt['image_list'])) { foreach($pt['image_list'] as $iv) { ?> <li><img src="static/image/grey.gif" data-original="<?php echo $iv['image_original']; ?>"></li> <?php } } ?> </ul> </div> <?php } ?> <span id="topic_content_<?php echo $TPT_; ?><?php echo $pt['tid']; ?>_full"></span> <?php if($pt['longtextid'] > 0) { ?> <a class="longText" id="longText_<?php echo $val['tid']; ?><?php echo $pt['tid']; ?>" href="javascript:;" onclick="view_longtext('<?php echo $pt['longtextid']; ?>', '<?php echo $pt['tid']; ?>', '<?php echo $val['tid']; ?><?php echo $pt['tid']; ?>', '<?php echo $TPT_; ?>', '<?php echo $val['tid']; ?>');return false;">查看全文</a> <?php } ?> <?php if($pt['attachid'] && $pt['attach_list']) { ?> <table class="attachst" style="width:490px;"> <?php if(is_array($pt['attach_list'])) { foreach($pt['attach_list'] as $iv) { ?> <?php $attachaid=$iv['id']; ?> <tr> <td class="attachst_img"><img src="<?php echo $iv['attach_img']; ?>" /></td> <td class="attachst_att"> <p class="attachList_att_name"><b><?php echo $iv['attach_name']; ?></b>&nbsp;（<?php echo $iv['attach_size']; ?>）</p> <p class="attachList_att_doc"> <?php if($iv['onlineview']) { ?> <a href="<?php echo $iv['onlineview']; ?>" target="_blank">在线预览</a> | 
<?php } ?> <a href="javascript:void(0);"
onclick="downattach(<?php echo $iv['id']; ?>);">点此下载</a>（需<font id="attach_score_<?php echo $iv['id']; ?>"><?php echo $iv['attach_score']; ?></font>积分，已下载<font id="attach_downnum_<?php echo $iv['id']; ?>" class="attach_downnum_<?php echo $iv['id']; ?>"><?php echo $iv['attach_down']; ?></font>次）<?php if(!empty($GLOBALS['_J']['pluginhooks']['global_item_attach'][$attachaid])) echo $GLOBALS['_J']['pluginhooks']['global_item_attach'][$attachaid];?></p> </td> </tr> <?php } } ?> </table> <?php } ?> <?php if($pt['is_vote'] > 0) { ?> <?php $__vote_key = $pt['tid'].'_'.$pt['random'] ?> <ul class="imgList" id="vote_detail_<?php echo $__vote_key; ?>"> <li><a href="javascript:;" onclick="getVoteDetailWidgets('<?php echo $__vote_key; ?>', <?php echo $pt['is_vote']; ?>);"><img src='./images/vote_pic_01.gif' /></a></li> </ul> <div id="vote_area_<?php echo $__vote_key; ?>" style="display: none;"> <div class="vote_zf_box" id="vote_content_<?php echo $__vote_key; ?>"></div> </div> <?php } ?> <?php if($pt['is_reward'] > 0) { ?> <ul class="imgList" id="reward_detail_<?php echo $pt['tid']; ?>_<?php echo $val['tid']; ?>"> <li> <a href="javascript:;" onclick="getRewardDetailWidgets('<?php echo $pt['tid']; ?>','<?php echo $pt['item_id']; ?>',<?php echo $val['tid']; ?>);"><img src="<?php echo $pt['reward_image']; ?>" style="width:120px;height:120px;"/></a> </li> <li> <a href="javascript:;" onclick="getRewardDetailWidgets('<?php echo $pt['tid']; ?>','<?php echo $pt['item_id']; ?>',<?php echo $val['tid']; ?>);"><img src="./images/reword1.png" style="padding:90px 0 0 40px;"/></a> </li> </ul> <div id="reward_area_<?php echo $pt['tid']; ?>_<?php echo $val['tid']; ?>" style="display: none;"> <div class="relayTxt"> <div class="mid" id="reward_content_<?php echo $pt['tid']; ?>_<?php echo $val['tid']; ?>" style="padding:10px 0"></div> </div> </div> <?php } ?> <?php if($pt['videoid'] and $this->Config['video_status']) { ?> <div class="feedUservideo"> <a onClick="javascript:showFlash('<?php echo $pt['VideoHosts']; ?>', '<?php echo $pt['VideoLink']; ?>', this, '<?php echo $pt['VideoID']; ?>','<?php echo $pt['VideoUrl']; ?>');"> <div id="play_<?php echo $pt['VideoID']; ?>" class="vP"><img src="static/image/feedvideoplay.gif" /></div> <img src="<?php echo $pt['VideoImg']; ?>" style="border: none" /> </a></div> <?php } ?> <?php if($pt['musicid']) { ?> <?php if($pt['xiami_id']) { ?> <div class="feedUserImg"> <embed width="257" height="33" wmode="transparent" type="application/x-shockwave-flash" src="http://www.xiami.com/widget/0_<?php echo $pt['xiami_id']; ?>/singlePlayer.swf"></embed></div> <?php } else { ?><div class="feedUserImg"> <div id="play_<?php echo $pt['MusicID']; ?>"></div> <img src="static/image/music.gif" title="点击播放音乐" onClick="javascript:showFlash('music', '<?php echo $pt['MusicUrl']; ?>', this, '<?php echo $pt['MusicID']; ?>');" style="cursor: pointer; border: none;" /></div> <?php } ?> <?php } ?> </p> <div class="favorTag"> <a 
<?php if(MEMBER_ID <1 ) { ?>
onclick="ShowLoginDialog();"
<?php } else { ?>onclick="topicdig(<?php echo $pt['tid']; ?>,<?php echo $pt['uid']; ?>,<?php echo $pt['digcounts']; ?>,'<?php echo $this->Config['changeword']['dig']; ?>',1);return false;"
<?php } ?>
class="topicdig_<?php echo $pt['tid']; ?>" href="javascript:void(0)" value="<?php echo $pt['tid']; ?>" rel="<?php echo $pt['digcounts']; ?>"><?php echo $this->Config['changeword']['dig']; ?>原文
<?php if($pt['digcounts']) { ?>
(<?php echo $pt['digcounts']; ?>)
<?php } ?> </a>
&nbsp;<a href="index.php?mod=topic&code=<?php echo $tpid; ?>" target="_blank">原文评论(<?php echo $pt['replys']; ?>)</a>&nbsp;
<a onclick="get_forward_choose(<?php echo $tpid; ?>,0,0,0);return false;"href="index.php?mod=topic&code=<?php echo $tpid; ?>" target="_blank">转发原文(<?php echo $pt['forwards']; ?>)</a>&nbsp;
<?php echo $pt['from_html']; ?>&nbsp;&nbsp;<span class="recd_r_img_<?php echo $pt['tid']; ?>"> <?php if($pt['recommend'] > 0) { ?> <img src="images/recommend.gif"> <?php } ?> </span></div> <?php } else { ?> <?php $val['reply_disable']=0; ?> <p><span>原始<?php echo $this->Config['changeword']['n_weibo']; ?>已删除</span></p> <?php } ?> </div> </div> <?php } ?> <?php } ?> <?php if($this->Module=='qun') { ?> <script type="text/javascript">
$(document).ready(function(){
var objStr1 = "#topic_lists_<?php echo $val['tid']; ?>_a";
var objStr2 = "#topic_lists_<?php echo $val['tid']; ?>_b";
$(objStr1).mouseover(function(){$(objStr2).show();});
$(objStr1).mouseout(function(){$(objStr2).hide();});
});
</script> <?php if($this->Config['qun_attach_enable']) $allow_attach = 1; else $allow_attach = 0  ?> <?php $allow_pic = $this->Config['image_enable'] ? $this->Config['image_enable'] : 0 ?> <?php $allow_face = $this->Config['face_enable'] ? $this->Config['face_enable'] : 0 ?> <div class="from"> <div class="handle"> <ul> <?php if(MEMBER_ID>0) { ?> <li> <?php if($val['managetype'] != 2) { ?> <span><a href="javascript:void(0);" onclick="
<?php if($allow_list_manage) { ?>
get_forward_choose(<?php echo $val['tid']; ?>,<?php echo $allow_attach; ?>,<?php echo $allow_pic; ?>,<?php echo $allow_face; ?>,{appitem:'<?php echo $val['item']; ?>', appitem_id:'<?php echo $val['item_id']; ?>',noReply:1});
<?php } else { ?>get_forward_choose(<?php echo $val['tid']; ?>,<?php echo $allow_attach; ?>);
<?php } ?>
" style="cursor:pointer;">转发
<?php if($val['forwards']) { ?>
(<?php echo $val['forwards']; ?>)
<?php } ?> </a></span> <?php } else { ?><span title="设置了特殊的权限，不允许转发">转发</span> <?php } ?> </li> <li class="o_line_l">|</li> <li> <?php if(!$val['reply_disable'] && $val['managetype'] != 2) { ?> <span> <a href="javascript:void(0)" onclick="
<?php if($allow_list_manage) { ?>
replyTopic(<?php echo $val['tid']; ?>,'<?php echo $talkanswerid; ?>reply_area_<?php echo $val['tid']; ?>','<?php echo $val['replys']; ?>',1,<?php echo $allow_attach; ?>,<?php echo $allow_face; ?>,<?php echo $allow_pic; ?>,1,{appitem:'<?php echo $val['item']; ?>', appitem_id:'<?php echo $val['item_id']; ?>'});
<?php } else { ?>replyTopic(<?php echo $val['tid']; ?>,'<?php echo $talkanswerid; ?>reply_area_<?php echo $val['tid']; ?>','<?php echo $val['replys']; ?>',0,<?php echo $allow_attach; ?>,<?php echo $allow_face; ?>,<?php echo $allow_pic; ?>,1);
<?php } ?>
return false;">评论
<?php if($val['replys']) { ?>
(<?php echo $val['replys']; ?>)
<?php } ?> </a> </span> <?php } else { ?><span>评论</span> <?php } ?> </li> <li class="o_line_l">|</li> <li id="topic_lists_<?php echo $val['tid']; ?>_a" class="mobox"><a href="javascript:void(0)" class="moreti" ><span class="txt">更多</span><span class="more"></span></a> <div id="topic_lists_<?php echo $val['tid']; ?>_b" class="molist" style="display:none"> <?php if(MEMBER_ID>0) { ?> <?php if('myfavorite'==$this->Code) { ?> <span id="favorite_<?php echo $val['tid']; ?>"><a href="javascript:void(0)" onclick="favoriteTopic(<?php echo $val['tid']; ?>,'delete');return false;">取消收藏</a></span> <?php } else { ?><span id="favorite_<?php echo $val['tid']; ?>"><a href="javascript:void(0)" onclick="favoriteTopic(<?php echo $val['tid']; ?>,'add');return false;">收藏</a></span> <?php } ?> <?php } ?> <a href="index.php?mod=topic&code=<?php echo $val['tid']; ?>" target="_blank" title="去<?php echo $this->Config['changeword']["n_weibo"]; ?>详细页面浏览">详情</a> <?php if(jallow($val['uid'])) { ?> <?php if($this->Code > 0  ||  in_array($this->Code,array('list_reply','do_add'))) $eid = 'reply_list'; else $eid = 'topic_list'  ?> <a href="javascript:void(0)" onclick="deleteTopic(<?php echo $val['tid']; ?>,'<?php echo $eid; ?>_<?php echo $val['tid']; ?>');return false;">删除</a> <?php $datetime = time(); $modify_time = $this->Config['topic_modify_time'] * 60 ?> <?php if($datetime - $val['addtime'] < $modify_time || 'admin'==MEMBER_ROLE_TYPE ) { ?> <?php if($val['replys'] <= 0 && $val['forwards'] <= 0 || 'admin'==MEMBER_ROLE_TYPE) { ?> <a href="javascript:void(0);" onclick="modifyTopic(<?php echo $val['tid']; ?>,'modify_topic_<?php echo $val['tid']; ?>','<?php echo $eid; ?>',<?php echo $allow_attach; ?>);return false;" style="cursor:pointer;">编辑</a> <?php } ?> <?php } ?> <?php } ?> <?php if(true===jaccess('topic', 'do_recd')) { ?> <a href="javascript:void(0)" onclick="showTopicRecdDialog({'tid':'<?php echo $val['tid']; ?>'});return false;">推荐</a> <?php } ?> <span 
<?php if(MEMBER_ID <1 ) { ?>
onclick="ShowLoginDialog();" 
<?php } ?>
><a href="javascript:;" onclick="ReportBox('<?php echo $val['tid']; ?>')" title="举报不良信息"><font color="red">举报</font></a></span> </div> </li> <?php } ?> </ul> </div> <div class="mycome"> <?php if(!$no_from) { ?> <?php echo $val['from_html']; ?> <?php } ?> </div> </div> <?php } else { ?><script type="text/javascript">
$(document).ready(function(){
var objStr1 = "#<?php echo $talkanswerid; ?>topic_lists_<?php echo $val['tid']; ?>_a";
var objStr2 = "#<?php echo $talkanswerid; ?>topic_lists_<?php echo $val['tid']; ?>_b";
$(objStr1).mouseover(function(){$(objStr2).show();});
$(objStr1).mouseout(function(){$(objStr2).hide();});
});
</script> <?php if($this->Config['attach_enable']) $allow_attach = 1; else $allow_attach = 0  ?> <?php $allow_pic = $this->Config['image_enable'] ? $this->Config['image_enable'] : 0 ?> <?php $allow_face = $this->Config['face_enable'] ? $this->Config['face_enable'] : 0 ?> <div class="from"> <div class="handle"> <ul> <?php if($this->Get['type'] != 'my_verify') { ?> <?php $tpid=$val['top_parent_id']; if ($tpid&&$parent_list[$tpid]) $root_type=$parent_list[$tpid]['type']; ?> <?php if($this->Get['mod'] == 'talk' &&  $val['reply_ok']) { ?> <li><span id="answer_<?php echo $val['tid']; ?>" class="talkreply" onclick="showMainPublishBox('answer','talk','<?php echo $talk['lid']; ?>','<?php echo $val['tid']; ?>','<?php echo $val['uid']; ?>');return false;">回答</span></li><li class="o_line_l">|</li> <?php } ?> <?php if($val['uid']>0) { ?> <li style="_margin-top:-1px;"> <span 
<?php if(MEMBER_ID <1 ) { ?>
onclick="ShowLoginDialog();"
<?php } else { ?> onclick="topicdig(<?php echo $val['tid']; ?>,<?php echo $val['uid']; ?>,<?php echo $val['digcounts']; ?>,'<?php echo $this->Config['changeword']['dig']; ?>');return false;"
<?php } ?>
> <a class="topicdig_<?php echo $val['tid']; ?> digusers" id="topicdig_<?php echo $val['tid']; ?>" href="javascript:;" value="<?php echo $val['tid']; ?>" rel="<?php echo $val['digcounts']; ?>" title="<?php echo $this->Config['changeword']['dig']; ?>"> <?php if($val['digcounts']) { ?>
(<?php echo $val['digcounts']; ?>)
<?php } else { ?>&nbsp;
<?php } ?> </a></span></li> <li class="o_line_l">|</li> <?php } ?> <?php if((!isset($root_type)) || (isset($root_type) && in_array($root_type, get_topic_type('forward')))) { ?> <li> <?php if((in_array($val['type'], get_topic_type('forward')) || $this->Module=='qun') && !($val['managetype'] == 2 || $val['managetype'] == 8)) { ?> <?php $not_allow_forward=0; ?> <span 
<?php if(MEMBER_ID <1 ) { ?>
onclick="ShowLoginDialog();" 
<?php } ?>
> <a href="javascript:void(0);" onclick="get_forward_choose(<?php echo $val['tid']; ?>,<?php echo $allow_attach; ?>,<?php echo $allow_pic; ?>,<?php echo $allow_face; ?>);" style="cursor:pointer;">转发
<?php if($val['forwards']) { ?>
(<?php echo $val['forwards']; ?>)
<?php } ?> </a> </span> <?php } else { ?> <?php $not_allow_forward=1; ?> <?php if(isset($val['fansgroup'])) { ?> <span><?php echo $val['fansgroup']; ?></span> <?php } else { ?> <span title="设置了特殊的权限，不允许转发">转发</span> <?php } ?> <?php } ?> </li> <li class="o_line_l">|</li> <?php } else { ?><?php $not_allow_forward=1; ?> <?php } ?> <li> <?php if('topic_favorite'==jget('mod') && 'me'!=$this->Code) { ?> <span id="favorite_<?php echo $val['tid']; ?>" 
<?php if(MEMBER_ID <1 ) { ?>
onclick="ShowLoginDialog();" 
<?php } ?>
> <a href="javascript:;" onclick="favoriteTopic(<?php echo $val['tid']; ?>,'delete');return false;">取消收藏</a> </span> <?php } else { ?><span id="favorite_<?php echo $val['tid']; ?>" 
<?php if(MEMBER_ID < 1) { ?>
onclick="ShowLoginDialog();" 
<?php } ?>
> <a href="javascript:;" onclick="favoriteTopic(<?php echo $val['tid']; ?>,'add');return false;">收藏</a> </span> <?php } ?> </li> <li class="o_line_l">|</li> <li> <?php if(!$val['reply_disable'] && !($val['managetype'] == 2 || $val['managetype'] == 9)) { ?> <span> <?php $opstring = (!$topic_view && ($val['ismanager'] || 'admin'==MEMBER_ROLE_TYPE) && in_array($val['channel_type'],array('ask','idea'))) ? chr(123).'relate:1,itemid:'.$val['item_id'].',featureid:'.$val['featureid'].chr(125) : chr(123).chr(125) ?> <?php if(defined('NEDU_MOYO')) { ?> <?php $opstring = nlogic('feeds.app.jsg')->topic_comment_ajax_options($options, $val) ?> <?php } ?> <?php $__rts=($reply_list_ajax_disable ? 0 : $val['replys']); ?> <a id="topic_list_reply_<?php echo $val['tid']; ?>_aid" href="javascript:;" 
<?php if(MEMBER_ID <1 ) { ?>
onclick="ShowLoginDialog();" 
<?php } ?>
onclick="replyTopic(<?php echo $val['tid']; ?>,'<?php echo $talkanswerid; ?>reply_area_<?php echo $val['tid']; ?>','<?php echo $__rts; ?>',<?php echo $not_allow_forward; ?>,<?php echo $allow_attach; ?>,<?php echo $allow_face; ?>,<?php echo $allow_pic; ?>,1,<?php echo $opstring; ?>);return false;">评论
<?php if($val['replys']) { ?>
(<?php echo $val['replys']; ?>)
<?php } ?> </a> </span> <?php } else { ?> <span title="设置了特殊的权限，不允许评论">评论</span> <?php } ?> </li> <li class="o_line_l">|</li> <?php if($topic_view && ($topic_info['ismanager'] || 'admin'==MEMBER_ROLE_TYPE) && in_array($topic_info['channel_type'],array('ask','idea'))) { ?> <li><a href="javascript:void(0);" onclick="settopicfeature(<?php echo $topic_info['tid']; ?>,<?php echo $val['tid']; ?>,1);">管理</a></li><li class="o_line_l">|</li> <?php } ?> <li id="<?php echo $talkanswerid; ?>topic_lists_<?php echo $val['tid']; ?>_a" class="mobox"> <a href="javascript:;" class="moreti" ><span class="txt">更多</span><span class="more"></span></a> <div id="<?php echo $talkanswerid; ?>topic_lists_<?php echo $val['tid']; ?>_b" class="molist" style="display:none"> <span><a href="index.php?mod=topic&code=<?php echo $val['tid']; ?>" target="_blank"  title="去微博详细页面浏览">详情</a></span> <?php if(jallow($val['uid']) || $val['ismanager']) { ?> <?php if($this->Code > 0  ||  in_array($this->Code,array('list_reply','do_add'))) $eid = 'reply_list'; else $eid = 'topic_list'  ?> <a href="javascript:;" onclick="deleteTopic(<?php echo $val['tid']; ?>,'<?php echo $eid; ?>_<?php echo $val['tid']; ?>');return false;">删除</a> <?php $datetime = time(); $modify_time = $this->Config['topic_modify_time'] * 60 ?> <?php if($datetime - $val['addtime'] < $modify_time || 'admin'==MEMBER_ROLE_TYPE || $val['ismanager'] ) { ?> <?php if($val['replys'] <= 0 && $val['forwards'] <= 0 || 'admin'==MEMBER_ROLE_TYPE || $val['ismanager']) { ?> <a href="javascript:void(0);" onclick="modifyTopic(<?php echo $val['tid']; ?>,'modify_topic_<?php echo $val['tid']; ?>','<?php echo $eid; ?>',<?php echo $allow_attach; ?>);return false;" style="cursor:pointer;">编辑</a> <?php } ?> <?php } ?> <?php } ?> <?php if(true===jaccess('topic', 'do_recd') || $val['ismanager']) { ?> <a href="javascript:;" onclick="showTopicRecdDialog({'tid':'<?php echo $val['tid']; ?>','tag_id':'<?php echo $tag_id; ?>'});return false;">推荐</a> <?php } ?> <?php if('admin'==MEMBER_ROLE_TYPE) { ?> <a onclick="force_out(<?php echo $val['uid']; ?>);" href="javascript:void(0);">封杀</a> <a onclick="force_ip('<?php echo $val['postip']; ?>');" href="javascript:void(0);">封IP</a> <?php } ?> <span 
<?php if(MEMBER_ID <1 ) { ?>
onclick="ShowLoginDialog();" 
<?php } ?>
><a href="javascript:;" onclick="ReportBox('<?php echo $val['tid']; ?>')" title="举报不良信息"><font color="red">举报</font></a></span> </div> </li> <?php } else { ?><li id="topic_lists_<?php echo $val['id']; ?>_a" class="mobox"> <?php if(jallow($val['uid'])) { ?> <?php if($this->Code > 0  ||  in_array($this->Code,array('list_reply','do_add'))) $eid = 'reply_list'; else $eid = 'topic_list'  ?> <a href="javascript:;" onclick="deleteVerify(<?php echo $val['id']; ?>,'<?php echo $eid; ?>_<?php echo $val['id']; ?>');return false;">删除</a> <?php } ?> </li> <?php } ?> </ul> </div> <div class="mycome"> <?php if(!$no_from) { ?> <?php echo $val['from_html']; ?> <?php } ?> <?php if(!empty($GLOBALS['_J']['pluginhooks']['global_item_bottom'][$topictid])) echo $GLOBALS['_J']['pluginhooks']['global_item_bottom'][$topictid];?> </div> </div> <?php } ?> </div> </div> </div> <div id="<?php echo $talkanswerid; ?>reply_area_<?php echo $val['tid']; ?>"></div> <div id="modify_topic_<?php echo $val['tid']; ?>"></div> <div id="forward_menu_<?php echo $val['tid']; ?>"></div> </div> <div style="clear: both;"></div>