<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?><div id="send"> <div class="sendBox"> <div class="sendTitle"> <div id="send_follow<?php echo $h_key; ?>" class="mleft"> <?php $defaust_value = $this->Get['mod']=='qun' ? '群内发的内容，只有群内成员才能看到哟！' : ($defaust_value ? $defaust_value : ''); ?> <?php if($this->Get['mod'] == 'member') { ?> <?php $content = '#新人报到# 我是'.$this->Config['site_name'].'新加入的成员@'.MEMBER_NICKNAME.' ，欢迎大家来关注我！'; ?>
所有关注我的人将看到我分享的信息
<?php } elseif($defaust_value) { ?> <?php echo $defaust_value; ?> <?php } else { ?> <?php echo $content_ostr; ?> <?php } ?> </div> <?php if($this->Channel_enable && $this->Config['channel_enable'] && !in_array($type,array('design','btn_wyfx','answer','ask','album')) && !in_array($this->Get['mod'],array('live','qun','talk','company','department','album','vote','event','mall'))) { ?> <div id="tochannel" style="display:none;"> <script type="text/javascript">
$(document).ready(function(){
$("#p_channel,#t_pb").bind('mouseover', function(){$('#p_channel').show();$('#t_pb').addClass('hover');});
$("#p_channel,#t_pb").bind('mouseout', function(){$('#p_channel').hide();$('#t_pb').removeClass('hover');});
});
function c_hide(){$('#p_channel').hide();$('#t_pb').removeClass('hover');}
function c_cut(){$('#t_channel').html('');$('#mapp_item<?php echo $h_key; ?>').val('<?php echo $this->item; ?>');$('#mapp_item_id<?php echo $h_key; ?>').val('<?php echo $this->item_id; ?>');$('#cverify').val('<?php echo $this->Config['verify']; ?>');}
<?php $channel_must = $this->Channel_enable && $this->Config['channel_enable'] && $this->Config['channel_must'] ? 1 : 0; ?>
function c_int(n,s,c){	$('#p_channel').hide();	$('#t_pb').removeClass('hover');	$('#t_channel').html(s+'<em onclick="c_cut();">×</em>');	$('#mapp_item<?php echo $h_key; ?>').val('channel');	$('#mapp_item_id<?php echo $h_key; ?>').val(n);	$('#cverify').val(c);}
function c_no(){show_message('您没有权限发'+__N_WEIBO__+'到该频道',2,'提示','msgBox','msg_alert');return false;}
</script> <div class="box_4_channel" 
<?php if($_GET['type']=='nedu') { ?>
style="display:none;"
<?php } ?>
> <span class="select" id="t_pb">选择频道</span> <span class="channel" id="t_channel" style=" display:inline;font-weight:500; float:none;"><?php echo $post_channel_name; ?></span> <div class="channels" id="p_channel" style="*margin:0 0 0 -91px;"> <?php if($this->Channels) { ?> <?php if(is_array($this->Channels)) { foreach($this->Channels as $val) { ?> <dl> <dt> <?php if($val['ok']) { ?> <a onclick="c_int(<?php echo $val['ch_id']; ?>,'<?php echo $val['ch_name']; ?>',<?php echo $val['ck']; ?>);"><?php echo $val['ch_name']; ?></a> <?php } else { ?><a onclick="c_no();" class="hui" title="您所在的用户组没有权限发<?php echo $this->Config['changeword']['n_weibo']; ?>到该频道"><?php echo $val['ch_name']; ?></a> <?php } ?> </dt> <dd> <?php if($val['child']) { ?> <?php if(is_array($val['child'])) { foreach($val['child'] as $v) { ?> <?php if($v['ok']) { ?> <a onclick="c_int(<?php echo $v['ch_id']; ?>,'<?php echo $v['ch_name']; ?>',<?php echo $v['ck']; ?>);"><?php echo $v['ch_name']; ?></a> <?php } else { ?><a onclick="c_no();" class="hui" title="您所在的用户组没有权限发<?php echo $this->Config['changeword']['n_weibo']; ?>到该频道"><?php echo $v['ch_name']; ?></a> <?php } ?> <?php } } ?> <?php } else { ?>&nbsp;
<?php } ?> </dd> </dl> <?php } } ?> <?php } else { ?><p>没有频道可供发布</p> <?php } ?> </div> </div> </div> <?php } ?> <?php if(!empty($GLOBALS['_J']['pluginhooks']['global_publish_title'])) echo $GLOBALS['_J']['pluginhooks']['global_publish_title'];?> <ul class="txtNum"> <?php if($this->Config['topic_input_length']>0) { ?> <li>还可以输入</li><li style="width:auto"><span id="wordCheck<?php echo $h_key; ?>" style='font-size:20px;'><?php echo $GLOBALS['_J']['config']['topic_input_length']; ?></span></li><li style="width:14px;">字</li> <?php } ?> </ul> </div> <div class="sendInput" style="display:block"> <?php $content = $content ? $content : $this->Config['today_topic'];$i_already_value = $content_dstr ? $content_dstr : $content;$this->totid = $this->totid ? $this->totid : 0; ?> <?php $channel_check = isset($post_channel_check) ? $post_channel_check : ($this->Config['verify'] ? 1 : 0); ?> <?php $p_item = isset($post_item_name) ? $post_item_name : $this->item; ?> <?php $p_item_id = isset($post_item_id) ? $post_item_id : $this->item_id; ?> <script type="text/javascript">
var __I_ALREADY_VALUE__ = '<?php echo $i_already_value; ?>';
var __ALERT__='<?php echo $this->Config['verify_alert']; ?>';
var __CONTENTID__ = 'i_already<?php echo $h_key; ?>';
</script> <div class="u-send"> <input type="text" id="t_i_already<?php echo $h_key; ?>" name="title" maxlength="25"  value="这里输入的文字将成为标题（可以留空）" onfocus="if(this.value=='这里输入的文字将成为标题（可以留空）'){this.value='';}" onblur="if(this.value==''){this.value='这里输入的文字将成为标题（可以留空）';}"> <textarea  name="content" id="i_already<?php echo $h_key; ?>"  onkeyup="javascript:checkWord('<?php echo $GLOBALS['_J']['config']['topic_input_length']; ?>','i_already<?php echo $h_key; ?>','wordCheck<?php echo $h_key; ?>')" onkeydown="ctrlEnter(event, 'publishSubmit<?php echo $h_key; ?>')"><?php echo $i_already_value; ?></textarea> </div> <?php $_get_type=str_safe($this->Get['type']); ?> <input name="topic_type" type="hidden" id="topic_type<?php echo $h_key; ?>" value="<?php echo $_get_type; ?>" /> <input name="totid" type="hidden" id="totid<?php echo $h_key; ?>" value="<?php echo $this->totid; ?>" /> <input name="touid" type="hidden" id="touid<?php echo $h_key; ?>" value="<?php echo $this->touid; ?>" /> <input name="item" type="hidden" id="mapp_item<?php echo $h_key; ?>" value="<?php echo $p_item; ?>" /> <input name="item_id" type="hidden" id="mapp_item_id<?php echo $h_key; ?>" value="<?php echo $p_item_id; ?>" /> <input name="xiami_id" type="hidden" id="xiami_id" value="" /> <input type="hidden" id="cverify" name="cverify" value="<?php echo $channel_check; ?>"> <?php if($this->MemberHandler->HasPermission('uploadattach','attach')!=false) $can_allow_attach = 1; else $can_allow_attach = 0  ?> </div> <div class="sendInsert"> <?php if(!($type == 'design' || $type == 'btn_wyfx')) { ?> <script type="text/javascript">
$(function(){
$(".menu_title").click(function(){
$(".menu_content,.menu_c_content").hide();
var id = $(this).attr("currid");
if(id){$("#"+id).show();
}});//一级菜单
$(".menu_c_title").click(function(){
$(".menu_c_content").hide();
var id = $(this).attr("currid");
if(id){//二级菜单
if(id=="showattachmenu<?php echo $h_key; ?>" && !<?php echo $can_allow_attach; ?>){MessageBox('warning', '您没有上传附件的操作权限！');
}else{
$("#"+id).show();
}                //附件权限判断
}});
$(".menu_close").click(function(){
var id = $(this).attr("currid");
if(id){$("#"+id).hide();
}});//关闭按钮
});
function setTab(name,cursel,n,t){
for(i=1;i<=n;i++){
var menu=document.getElementById(name+i);var con=document.getElementById("con_"+name+"_"+i);
menu.className=i==cursel?"vhover":"";con.style.display=i==cursel?"block":"none";
if(i!=cursel && t){$("#con_"+name+"_"+i+" div").remove();}
}
}
</script> <div class="mleft"> <?php if($this->Config['face_enable']) { ?> <div class="menu"> <div class="menu_bq" id="editface" ><b class="menu_bqb_c menu_title" currid="showface<?php echo $h_key; ?>"><a href="javascript:void(0);" title="点击插入表情，让内容更生动" onclick="topic_face('showface<?php echo $h_key; ?>','i_already<?php echo $h_key; ?>','topic_face');return false;" style="color:#666;">表情</a></b> <div id="showface<?php echo $h_key; ?>" class="showface menu_content"></div> </div> </div> <?php } ?> <?php if($this->Config['image_enable']) { ?> <?php $handle_key = 'showuploadimage'.$h_key; ?> <div class="menu"> <div class="menu_tq" ><b class="menu_tqb_c menu_title" currid="showuploadimage<?php echo $h_key; ?>" title="可实现图文混排">图片</b> <div class="menu_tqb menu_content" id="showuploadimage<?php echo $h_key; ?>"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <div class="menu_tqbox"> <i class="menu_tqb_c1 menu_close" currid="showuploadimage<?php echo $h_key; ?>"></i> <link href="static/style/imgupload.css?build+20140922" rel="stylesheet" type="text/css" /> <script type="text/javascript" src="static/js/imgupload.js?build+20140922"></script> <script type="text/javascript">
var __IMAGE_IDS__ = {};$(function(){$(".nav_title<?php echo $h_key; ?>").click(function(){$(".currtitle<?php echo $h_key; ?> .curr").removeClass("curr");$(this).addClass("curr");$(".upload_frame<?php echo $h_key; ?>").hide();var id = $(this).attr("currid");if(id){$("#"+id).show();if('upload_frame_2<?php echo $h_key; ?>'==id && ''==$("#album_list<?php echo $h_key; ?>").html()){get_album('<?php echo $h_key; ?>',0,1);}}});$('#publisher_file<?php echo $h_key; ?>').uploadify({'uploader':'<?php echo $GLOBALS['_J']['config']['site_url']; ?>/images/uploadify/uploadify.swf?id=&random='+Math.random(),'script':'<?php echo urlencode($GLOBALS['_J']['config']['site_url']."/ajax.php?mod=uploadify&code=image&uninitmember=1&type=flash&iitem=$img_item&iitemid=$img_itemid"); ?>','cancelImg':'<?php echo $GLOBALS['_J']['config']['site_url']; ?>/images/uploadify/cancel.png','buttonImg':'<?php echo $GLOBALS['_J']['config']['site_url']; ?>/images/uploadify/upload.gif','width':52,'height':52,'multi':true,'auto':true,'sizeLimit':'<?php echo $GLOBALS['_J']['config']['image_size_limit']; ?>','fileExt':'*.jpg;*.png;*.gif;*.jpeg','fileDesc':'请选择图片文件(*.jpg;*.png;*.gif;*.jpeg)','queueID':'uploadifyQueueDiv','wmode':'transparent','fileDataName':'topic','queueSizeLimit':<?php echo $GLOBALS['_J']['config']['image_uploadify_queue_size_limit']; ?>,'simUploadLimit':1,'scriptData':{'cookie_auth':'<?php echo urlencode(jsg_getcookie("auth")); ?>'},'onSelect':function(event,ID,fileObj){},'onSelectOnce':function(event,data){imageUploadifySelectOnce('<?php echo $h_key; ?>');},'onProgress':function(event,ID,fileObj,data){return false;},'onComplete':function(event,ID,fileObj,response,data){eval('var r ='+response+';');if(r.done){var rv=r.retval;if(rv.id>0&&rv.src.length>0) {imageUploadifyComplete('<?php echo $h_key; ?>',rv.id, rv.src, fileObj.name);}}},'onError':function (event,ID,fileObj,errorObj){alert(errorObj.type+'Error:'+errorObj.info);},'onAllComplete':function(event,data){imageUploadifyAllComplete('<?php echo $h_key; ?>');},'onSWFReadyFall':function(){$('#publisher_file<?php echo $h_key; ?>').after("<img src='images/uploadify/upload.gif'><div style='position: absolute; left: 10px; top: 87px; display: block; overflow: hidden; background-color: rgb(0, 0, 0); opacity: 0; width: 52px; height: 52px;'><iframe id='imageUploadifyIframe<?php echo $h_key; ?>' name='imageUploadifyIframe<?php echo $h_key; ?>' width='0' height='0' marginwidth='0' frameborder='0' src='about:blank' style='display:none;'></iframe><fo"+"rm id='normalUploadForm<?php echo $h_key; ?>' method='post' action='ajax.php?mod=uploadify&code=image&type=normalnew&iitem=<?php echo $img_item; ?>&iitemid=<?php echo $img_itemid; ?>&divid=<?php echo $h_key; ?>' enctype='multipart/form-data' target='imageUploadifyIframe<?php echo $h_key; ?>' style='margin:0;padding:0;'><input type='file' accept='image/*' style='width:52px; height: 52px;cursor:pointer;' id='normalUploadFile<?php echo $h_key; ?>' name='topic' onchange=\"document.getElementById('normalUploadForm<?php echo $h_key; ?>').submit();imageUploadifySelectOnce('<?php echo $h_key; ?>')\"/></form></div>");}});});
</script> <div class="imgupload"> <p class="navtab currtitle<?php echo $h_key; ?>"> <b class="curr nav_title<?php echo $h_key; ?>" currid="upload_frame_1<?php echo $h_key; ?>">上传图片</b> <b class="nav_title<?php echo $h_key; ?>" currid="upload_frame_2<?php echo $h_key; ?>">相册图片</b> <b class="nav_title<?php echo $h_key; ?>" currid="upload_frame_3<?php echo $h_key; ?>">网络图片</b> <b class="nav_title<?php echo $h_key; ?>" currid="upload_frame_4<?php echo $h_key; ?>">图片搜索</b> </p> <div class="upload_frame_area"> <iframe id="frameupimg<?php echo $h_key; ?>" name="frameupimg<?php echo $h_key; ?>" width="0" height="0" marginwidth="0" frameborder="0" src="about:blank" style="display:none;"></iframe> <form id="formalbum<?php echo $h_key; ?>"> <div class="upload_frame<?php echo $h_key; ?>" id="upload_frame_1<?php echo $h_key; ?>"> <div id="swfUploadDiv<?php echo $h_key; ?>" class="upload_area"> <span id="albumlist<?php echo $h_key; ?>" style="display:block; margin-bottom:10px;text-align: right;"> <label style="float:left;"><input type="checkbox" name="selectallimg" value="1" onchange="selectAllUpImg(this.checked);" onpropertychange="selectAllUpImg(this.checked);">全选</label>将选中的图片同时保存到相册：<select name="uploadalbum" id="uploadalbum<?php echo $h_key; ?>" onchange="if(this.value == '-1'){selectCreateTab('<?php echo $h_key; ?>',0);}"><option value="0">默认相册</option> <?php if($albums) { ?> <?php if(is_array($albums)) { foreach($albums as $val) { ?> <option value="<?php echo $val['albumid']; ?>"><?php echo $val['albumname']; ?></option> <?php } } ?> <?php } ?> <option value="-1" style="color:red;">+创建新相册</option></select> <input type="button" value="保 存" class="u-btn u-btn-cancel" onclick="saveimgcallback('<?php echo $h_key; ?>','<?php echo $handle_key; ?>');"> </span> <span id="creatalbum<?php echo $h_key; ?>"></span> <input type="file" id="publisher_file<?php echo $h_key; ?>" name="publisher_file" style="display:none;"> </div> <p class="upload_notice">1.最多可上传<?php echo $GLOBALS['_J']['config']['image_uploadify_queue_size_limit']; ?>张图片，单张图片大小不超过
<?php echo(round($this->Config['image_size']/1024, 2)); ?>
M。<br>2.点击图片可插入内容区，您可为图片位置进行排版。</p> <span id="uploading<?php echo $h_key; ?>"></span> <table id="viewImgDiv<?php echo $h_key; ?>" class="tempimglist"> <?php if($uploadimages) { ?> <?php if(is_array($uploadimages)) { foreach($uploadimages as $ik => $iv) { ?> <script type="text/javascript"> __IMAGE_IDS__[<?php echo $ik; ?>] = <?php echo $ik; ?>; </script> <tr id="upimg_<?php echo $ik; ?>"><td valign='top'><input type='checkbox' name='ids[]' value="<?php echo $ik; ?>" title='保存到相册'></td><td valign='middle'><a href="javascript:;" id="insert_image_<?php echo $ik; ?>" onclick="insertIntoContent('image',<?php echo $ik; ?>,'i_already<?php echo $h_key; ?>');" title="点击插入"><img src="<?php echo $iv['img']; ?>" width='50' height='50'></a></td><td valign='middle'><textarea name='title[<?php echo $ik; ?>]' maxlength='140' onfocus="if(this.value == '图片简介') {this.value = '';}" onblur="if(this.value == '') {this.value = '图片简介';}"><?php echo $iv['description']; ?></textarea></td><td valign='middle'><a title="删除图片" onclick="imageUploadifyDelete(<?php echo $ik; ?>,'<?php echo $tid; ?>');return false;" href="javascript:void(0);" class="u-del">X</a></td></tr> <?php } } ?> <?php } ?> </table> <p class="submitbottom"></p> </div> <div class="upload_frame<?php echo $h_key; ?>" id="upload_frame_2<?php echo $h_key; ?>" style="display:none;"> <p class="add">从我的相册中选择图片: <select onchange="get_album('<?php echo $h_key; ?>',this.value,1);"><option value="0">默认相册</option> <?php if(is_array($albums)) { foreach($albums as $val) { ?> <option value="<?php echo $val['albumid']; ?>"><?php echo $val['albumname']; ?></option> <?php } } ?> </select></p> <table id="album_list<?php echo $h_key; ?>"></table> <p class="submitbottom"><input type="button" value="保 存" class="u-btn u-btn-cancel" onclick="saveimgcallback('<?php echo $h_key; ?>','<?php echo $handle_key; ?>');"></p> </div> <div class="upload_frame<?php echo $h_key; ?>" id="upload_frame_3<?php echo $h_key; ?>" style="display:none;"> <p class="add"><input type="text" id="img_url<?php echo $h_key; ?>"  value="请输入图片url地址" onclick="if(this.value=='请输入图片url地址'){this.value = '';}"/><a href="javascript:void(0);" onclick="getUrlImage('<?php echo $h_key; ?>',img_url<?php echo $h_key; ?>);" class="u-btn" style="color:#fff;">上传图片</a></p> <span id="uploading_img<?php echo $h_key; ?>" style="display:none"><img src='images/loading.gif'/>&nbsp;上传中，请稍候……</span> <table id="viewUrlImgDiv<?php echo $h_key; ?>"></table> <p class="submitbottom"><input type="button" value="保 存" class="u-btn u-btn-cancel" onclick="saveimgcallback('<?php echo $h_key; ?>','<?php echo $handle_key; ?>');"></p> </div> <div class="upload_frame<?php echo $h_key; ?>" id="upload_frame_4<?php echo $h_key; ?>" style="display:none;"> <p class="add"><input type="text" id="word<?php echo $h_key; ?>" name="word" value="请输入关键字，如：世界末日" onclick="if(this.value=='请输入关键字，如：世界末日'){this.value = '';}"/><a href="javascript:void(0);" onclick="searchBaiDuImg('<?php echo $h_key; ?>');" class="u-btn"  style="color:#fff;">搜索图片</a></p> <div id="baidu_image<?php echo $h_key; ?>" class="baiduimgdiv"></div> </div> </div> </form> </div> </div> </div> </div> </div> <?php } ?> <?php $ath_key = $h_key ? '_'.$h_key : ''; ?> <div class="menu"> <div class="menu_hp"><b onclick="showatuserw('i_already<?php echo $h_key; ?>','<?php echo $h_key; ?>','');return false;" class="menu_hpb_c menu_title" currid="showatusermenu<?php echo $h_key; ?>" title="@朋友昵称提醒TA">朋友</b> <div class="menu_hpb menu_content" id="showatusermenu<?php echo $h_key; ?>"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <div class="menu_tb showusr"> <div id="showatuser<?php echo $ath_key; ?>" class="showatuser"></div> <sub class="menu_hpb_c1 menu_close" currid="showatusermenu<?php echo $h_key; ?>"></sub> </div> </div> </div> </div> <?php if($this->Config['word_type_enable']) { ?> <div class="menu"> <div class="menu_a"> <b class="menu_a_c menu_title" currid="showstylemenu<?php echo $h_key; ?>"><a href="javascript:void(0);" title="给文字加上特效" style="color:#666;">格式</a></b> <div class="pull menu_content" style="display:none;" id="showstylemenu<?php echo $h_key; ?>"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <sub class="menu_a_c1 menu_close" currid="showstylemenu<?php echo $h_key; ?>"></sub> <div class="menu_hb"> <span onclick="setFont('b');return false;" class="menu_hbb_c" title="先在输入框中选择要加粗的文字">粗体</span> </div> <div class="menu_underline"> <span onclick="setFont('u');return false;" class="menu_underline_c" title="先在输入框中选择要加下划线的文字">下划线</span> </div> <div class="menu_hc"> <span onclick="getColorMenu();return false;" class="menu_hcb_c menu_c_title" currid="color_menu" title="先在输入框中选择要加颜色的文字">颜色</span> <sub class="menu_color_c1 menu_close" currid="color_menu"></sub> <div class="menu_c_b menu_c_content" id="color_menu"></div> </div> <div class="menu_hy"> <span class="menu_hyb_c menu_c_title" currid="showquotemenu<?php echo $h_key; ?>" title="点击打开引用内容输入框">引用</span> <div class="menu_q_b menu_c_content" id="showquotemenu<?php echo $h_key; ?>"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <div class="menu_q_d"> <div class="menu_qd"> <span style="float:left; padding-left:5px; color:#666;">请输入要引用的内容：</span> <sub class="menu_quote_c1 menu_close" currid="showquotemenu<?php echo $h_key; ?>"></sub> </div> <span> <textarea id="quote"></textarea> </span> <span> <input class="u-btn" type="button" value="提交" onclick="insertQuote(quote,'quote');" /> </span> </div> </div> </div> <div class="menu_hm"> <span class="menu_hmb_c menu_c_title" currid="showcodemenu<?php echo $h_key; ?>" title="点击打开代码内容输入框">代码</span> <div class="menu_mc_b menu_c_content" id="showcodemenu<?php echo $h_key; ?>"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <div class="menu_mc_d"> <div class="menu_mc"> <span style="float:left; padding-left:5px;color:#666;">请输入要引用的代码：</span> <sub class="menu_code_c1 menu_close" currid="showcodemenu<?php echo $h_key; ?>"></sub> </div> <span> <textarea id="code"></textarea> </span> <span> <input class="u-btn" type="button" value="提交" onclick="insertQuote(code,'code');"/> </span> </div> </div> </div> <?php if(!empty($GLOBALS['_J']['pluginhooks']['global_publish_menu_style'])) echo $GLOBALS['_J']['pluginhooks']['global_publish_menu_style'];?> </div> </div> </div> <?php } ?> <div class="menu"> <div class="menu_m"> <b class="menu_m_c menu_title" currid="showmoremenu<?php echo $h_key; ?>"><a href="javascript:void(0);" style="color:#666;">更多</a></b> <div class="pull_down menu_content" id="showmoremenu<?php echo $h_key; ?>" style="display:none;"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <sub class="menu_m_c1 menu_close" currid="showmoremenu<?php echo $h_key; ?>"></sub> <?php if($this->Config['sign']['sign_enable']) { ?> <div class="menu_hq" id="sign_<?php echo MEMBER_ID; ?>"> <span onclick="getSignTag(<?php echo MEMBER_ID; ?>);return false;" class="menu_hqs_c menu_c_title" currid="showsigntag<?php echo $h_key; ?>" title="选择签到类别">签到</span> <div class="menu_hqs menu_c_content" id="showsigntag<?php echo $h_key; ?>"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <div class="menu_checkin"> <div id="sign_tag_<?php echo MEMBER_ID; ?>"></div> <sub class="menu_hqs_c1 menu_close" currid="showsigntag<?php echo $h_key; ?>"></sub> </div> </div> </div> <?php } ?> <?php if($this->Config['video_enable']) { ?> <div class="menu_sp"><b class="menu_spb_c menu_c_title" currid="upload_ajax_video" title="支持新浪、优酷、搜狐、酷6、土豆视频的站内播放">视频</b> <div class="menu_spb menu_c_content" id="upload_ajax_video"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <div class="menu_tb" style="width:300px;"> <span style="float:left; padding-left:10px; color:#666; width:270px;">支持如下视频的站内播放</span><div class="menu_spb_c1 menu_close" currid="upload_ajax_video"></div></div> <p class="menu_p"><a href="http://www.youku.com/" rel="nofollow" target="_blank">优酷</a>、<a href="http://v.blog.sohu.com/" rel="nofollow" target="_blank">搜狐</a>、<a href="http://www.ku6.com/" rel="nofollow" target="_blank">酷6</a>、<a href="http://www.tudou.com/" rel="nofollow" target="_blank">土豆</a> <?php if(is_array($GLOBALS['_J']['config']['video_parse_extract_list'])) { foreach($GLOBALS['_J']['config']['video_parse_extract_list'] as $vpe) { ?>
、<a href="<?php echo $vpe['url']; ?>" rel="nofollow" target="_blank"><?php echo $vpe['name']; ?></a> <?php } } ?> <br>请在浏览器中复制视频播放页的网址</p> <div id="upload_video_list" class="menu_p" style="display:none;"> <span id="return_ajax_video_title"></span> <span><img id="video_img" width="130" /></span> <p> <input id="videoid" type="hidden" name="video_id" /> <span><a href="" onclick="DelVideo('videoid','video_ajax'); return false;" title="删除视频">删除视频</a></span> </p> </div> <div id="add_video" class="menu_p" style=" margin-bottom:6px; padding-top:0"> <iframe id="upload_video_frame" name="upload_video_frame" width="0" height="0" marginwidth="0" frameborder="0" src="about:blank"></iframe> <form action="ajax.php?mod=topic&code=dovideo" method="post"  enctype="multipart/form-data" name="upload_video" id="upload_video" target="upload_video_frame"> <input type="hidden" name="FORMHASH" value='<?php echo FORMHASH; ?>'/> <input name="url" type="text" id="url" class="sc_r_t_a" style=" width:210px; display:inline; padding:2px;"/> <input type="submit" name="Submit" value="提 交" class="u-btn" /> </form> </div> </div> </div> <?php } ?> <?php if($this->Config['music_enable']) { ?> <div class="menu_x"> <b class="menu_xb_c menu_c_title" currid="showmusicmenu<?php echo $h_key; ?>" title="分享音乐，支持站内播放">音乐</b> <div class="menu_xb menu_c_content" id="showmusicmenu<?php echo $h_key; ?>"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <div class="menu_tb" style="width:290px;"> <span style="float:left; padding-left:10px; color:#666;">请在下面输入歌曲名或歌手名字搜索</span> <sub class="menu_music_c1 menu_close" currid="showmusicmenu<?php echo $h_key; ?>"></sub> </div> <div id="add_music" class="menu_m_s" style=" margin-bottom:6px; padding:15px 10px 0; float:left;"> <form action="javascript:void(0);" method="post"  enctype="multipart/form-data" name="upload_music" id="upload_music"> <input type="hidden" name="FORMHASH" value='<?php echo FORMHASH; ?>'/> <input name="url" type="text" id="music_name" class="sc_r_t_a" style=" width:210px; padding:2px;"> <input type="submit" name="Submit" value="搜 索" class="u-btn" onclick="music_serach();"> </form> </div> <p class="menu_p" style="padding:0 10px;color:#999">mp3等后缀的网址请直接粘贴到上面的发布框中</p> <div id="music_list" class="menu_m_l"></div> </div> </div> <?php } ?> <?php if(($this->Config['attach_enable'] && $this->Module!='qun') || ($this->Config['qun_attach_enable'] && $this->Module=='qun')) $allow_attach = 1; else $allow_attach = 0  ?> <?php if($allow_attach) { ?> <?php $attach_uploadify_topic = array(); ?> <?php $attach_uploadify_from = 'topic_publish'; ?> <?php $attach_uploadify_only_js = 1; ?> <?php $attach_num = min(max(1,(int)$this->Config['attach_files_limit']),50); ?> <?php $attach_size = min(max(1,(int)$this->Config['attach_size_limit']),51200); ?> <?php $attach_size = $attach_size >= 1024 ? round(($attach_size/1024),1).'M' : $attach_size.'KB'; ?> <?php $attach_uploadify_id=$topic_textarea_id.$attach_uploadify_type.($attach_uploadify_topic['tid']>0?"_".$attach_uploadify_topic['tid']:""); ?> <?php $attach_img_siz=$attach_img_siz?$attach_img_siz:32; ?> <?php $attach_fz_siz=min(max(1,(int)$this->Config['attach_size_limit']),51200)*1024; ?> <?php $topic_textarea_id=$topic_textarea_id?$topic_textarea_id:'i_already'.$h_key; ?> <?php $topic_textarea_empty_val=isset($topic_textarea_empty_val)?$topic_textarea_empty_val:'分享文件'; ?> <?php $attach_uploadify_queue_size_limit=min(max(1,(int)$this->Config['attach_files_limit']),50); ?> <?php $attach_item=isset($this->item)?$this->item:''; ?> <?php $attach_itemid=isset($this->item_id)?$this->item_id:0; ?> <success></success> <script type="text/javascript">
var __ATTACH_IDS__ = {};
$(document).ready(function(){			
var upfilename = '';
$('#publisher_file_attach<?php echo $attach_uploadify_id; ?>').uploadify({
'uploader'  : '<?php echo $GLOBALS['_J']['config']['site_url']; ?>/images/uploadify/uploadify.swf?id=<?php echo $attach_uploadify_id; ?>&random=' + Math.random(),
'script'    : '<?php echo urlencode($GLOBALS['_J']['config']['site_url'] . "/ajax.php?mod=uploadattach&code=attach&uninitmember=1&type=flash&aitem=$attach_item&aitemid=$attach_itemid"); ?>',
'cancelImg' : '<?php echo $GLOBALS['_J']['config']['site_url']; ?>/images/uploadify/cancel.png',
'buttonImg'	: '<?php echo $GLOBALS['_J']['config']['site_url']; ?>/images/uploadify/addatta.gif',
'width'		: 111,
'height'	: 17,
'multi'		: true,
'auto'      : true,
'sizeLimit' : <?php echo $attach_fz_siz; ?>,
'fileExt'	: '*.rar;*.zip;*.txt;*.doc;*.xls;*.pdf;*.ppt;*.docx;*.xlsx;*.pptx;*.mp4;*.3gp;*.flv;*.avi;*.rmvb;*.mpg;*.mov;*.vob;*.wmv;*.bmp;*.jpg;*.tiff;*.gif;*.pcx;*.tga;*.exif;*.fpx;*.svg;*.psd;*.cdr;*.pcd;*.dxf;*.ufo;*.eps;*.ai;*.raw',
'fileDesc'	: '*.rar;*.zip;*.txt;*.doc;*.xls;*.pdf;*.ppt;*.docx;*.xlsx;*.pptx;*.mp4;*.3gp;*.flv;*.avi;*.rmvb;*.mpg;*.mov;*.vob;*.wmv;*.bmp;*.jpg;*.tiff;*.gif;*.pcx;*.tga;*.exif;*.fpx;*.svg;*.psd;*.cdr;*.pcd;*.dxf;*.ufo;*.eps;*.ai;*.raw',
'queueID'	: 'uploadifyQueueDivAttach<?php echo $attach_uploadify_id; ?>',
'wmode'		: 'transparent',
'fileDataName'	 : 'topic',
'queueSizeLimit' : <?php echo $attach_uploadify_queue_size_limit; ?>,
'simUploadLimit' : 1,
'scriptData'	 : {
<?php if($attach_uploadify_topic_uid) { ?>
'topic_uid'  : '<?php echo $attach_uploadify_topic_uid; ?>',
<?php } ?>
'cookie_auth': '<?php echo urlencode(jsg_getcookie("auth")); ?>'
},
'onSelect'		 : function(event, ID, fileObj) {
//修改选择的分类参数
$('#publisher_file_attach<?php echo $attach_uploadify_id; ?>').uploadifySettings('scriptData', {attch_category:$("[name=attch_category]").val()});
},
'onSelectOnce'	 : function (event, data) {
attachUploadifySelectOnce<?php echo $attach_uploadify_id; ?>();			    	
},
'onProgress'     : function(event, ID, fileObj, data) {
return false;
},
'onComplete'	 : function(event, ID, fileObj, response, data) {
eval('var r = ' + response + ';');
if (r.done) {					
var rv = r.retval;
if ( rv.id > 0 && rv.src.length > 0 ) {
attachUploadifyComplete<?php echo $attach_uploadify_id; ?>(rv.id, rv.src, fileObj.name);
upfilename = fileObj.name;
}
}
else
{
if(r.msg)
{
if(r.msg=='forbidden'){
MessageBox('warning','您没有上传文件的权限，无法继续操作！');
}else{
MessageBox('warning', '上传失败，文件过大或过多或格式错误！');
}
}
}
},
'onError'        : function (event, ID, fileObj, errorObj) {
alert(errorObj.type + ' Error: ' + errorObj.info);
},
'onAllComplete'	 : function(event, data) {
attachUploadifyAllComplete<?php echo $attach_uploadify_id; ?>(upfilename);
}
});
$("#viewAttachDiv<?php echo $attach_uploadify_id; ?> img").each(function() {
if($(this).width() > $(this).parent().width()) {
$(this).width("100%");
}
});
});
//删除一个文件
function attachUploadifyDelete<?php echo $attach_uploadify_id; ?>(idval)
{
var idval = ('undefined'==typeof(idval) ? 0 : idval);
if(idval > 0) 
{
$.post
(
'ajax.php?mod=uploadattach&code=delete_attach',
{
'id' : idval
},
function (r) 
{				
if(r.done)
{
$('#uploadAttachSpan_' + idval).remove();
var contentTextBox = $('#'+__CONTENTID__);
var content = contentTextBox.val();
var r = "[attach]"+idval+"[/attach]";
var n = content.split(r).length - 1;
for (var i = 0; i < n ; i++) {
content = content.replace(r,"");
}
contentTextBox.val(content);
if( ($.trim(($('#viewAttachDiv<?php echo $attach_uploadify_id; ?>').html()))).length < 1 )
{
$('#viewAttachDiv<?php echo $attach_uploadify_id; ?>').css('display', 'none');
$('#insertAttachDiv<?php echo $attach_uploadify_id; ?>').css('display', 'block');
}
if( 'undefined' != typeof(__ATTACH_IDS__[idval]) )
{
__ATTACH_IDS__[idval] = 0;
}
}
else
{
if(r.msg)
{
MessageBox('warning', r.msg);
}
}
},
'json'
);
}
}
function attachUploadifySelectOnce<?php echo $attach_uploadify_id; ?>()
{   
$('#uploadingAttach<?php echo $attach_uploadify_id; ?>').html("<p><img src='images/loading.gif'/>&nbsp;上传中，请稍候……</p>");
}
function attachUploadifyComplete<?php echo $attach_uploadify_id; ?>(idval, srcval, nameval)
{
var attachIdsCount = 0;
$.each( __ATTACH_IDS__, function( k, v ) { if( v > 0 ) { attachIdsCount += 1; } } );
if( attachIdsCount >= <?php echo $attach_uploadify_queue_size_limit; ?> )
{
MessageBox('warning', '本次文件数量超过限制了');
return false;
}
var idval = ('undefined' == typeof(idval) ? 0 : idval);
var srcval = ('undefined' == typeof(srcval) ? 0 : srcval);
var nameval = ('undefined' == typeof(nameval) ? '' : nameval);
<?php if('topic_publish'==$attach_uploadify_from) { ?>
$('#viewAttachDiv<?php echo $attach_uploadify_id; ?>').prepend('<li id="uploadAttachSpan_' + idval + '" class="menu_ps vv_2"><img src="' + srcval + '" class="uploadAttachSpan_img_type"/> <p class="uploadAttachSpan_doc_type"><i>' + nameval + '</i></p><p>（<a title="删除文件" onclick="attachUploadifyDelete<?php echo $attach_uploadify_id; ?>(' + idval + ');return false;" href="javascript:;">删</a>）需<input title="填写用户下载该附件所需贡献给你的积分" size="1" type="text" onblur="set_attach_score(this.value,' + idval + ',this);return false;">积分 </p></li>');<?php } elseif('topic_longtext_info_ajax'==$attach_uploadify_from) { ?>$('#viewAttachDiv<?php echo $attach_uploadify_id; ?>').append('<span id="uploadAttachSpan_' + idval + '"><img src="' + srcval + '" width="<?php echo $attach_img_siz; ?>" alt="点击文件插入到文中" onclick="longtext_info_img_insert(\'' + srcval + '\');" />（<a href="javascript:void(0);" onclick="attachUploadifyDelete<?php echo $attach_uploadify_id; ?>(' + idval + '); return false;" title="删除文件">删</a>）需<input title="填写用户下载该附件所需贡献给你的积分" size="1" type="text" onblur="set_attach_score(this.value,' + idval + ',this);return false;">积分</span>');
<?php } else { ?>$('#viewAttachDiv<?php echo $attach_uploadify_id; ?>').append('<span id="uploadAttachSpan_' + idval + '"><img src="' + srcval + '" width="<?php echo $attach_img_siz; ?>" />（<a href="javascript:void(0);" onclick="attachUploadifyDelete<?php echo $attach_uploadify_id; ?>(' + idval + '); return false;" title="删除文件">删</a>）需<input title="填写用户下载该附件所需贡献给你的积分" size="1" type="text" onblur="set_attach_score(this.value,' + idval + ',this);return false;">积分</span>');
<?php } ?>
$('#normalAttachUploadFile<?php echo $attach_uploadify_id; ?>').val('');
__ATTACH_IDS__[idval] = idval;
}
function attachUploadifyAllComplete<?php echo $attach_uploadify_id; ?>(nameval)
{
var nameval = ('undefined' == typeof(nameval) ? '' : nameval);
$('#uploadingAttach<?php echo $attach_uploadify_id; ?>').html('');			    	
$('#viewAttachDiv<?php echo $attach_uploadify_id; ?>').css('display', 'block');
//$('#insertAttachDiv<?php echo $attach_uploadify_id; ?>').css('display', 'none');
if( $.trim(($('#<?php echo $topic_textarea_id; ?>').val())).length < 1 ) {
$('#<?php echo $topic_textarea_id; ?>').val('<?php echo $topic_textarea_empty_val; ?>' + ':' + nameval);	
}
$('#<?php echo $topic_textarea_id; ?>').focus();
}
function normalAttachUploadFormSubmit<?php echo $attach_uploadify_id; ?>()
{
var fileVal = $('#normalAttachUploadFile<?php echo $attach_uploadify_id; ?>').val();
if(($.trim(fileVal)).length < 1)
{
MessageBox('warning', '请上传正确格式的附件文件');
return false;
}
else
{
if(!(/\.(<?php echo $this->Config['attach_file_type']; ?>)$/i.test(fileVal)))
{
MessageBox('warning', '请选择一个正确格式的附件文件');
return false;
}
else
{
attachUploadifySelectOnce<?php echo $attach_uploadify_id; ?>();
return true;
}
}
}
function attachUploadifyModuleSwitch<?php echo $attach_uploadify_id; ?>()
{
if('none' == $('#normalAttachUploadDiv<?php echo $attach_uploadify_id; ?>').css('display'))
{
$('#uploadDescModuleSpanAttach<?php echo $attach_uploadify_id; ?>').html('快速');
$('#swfUploadDivAttach<?php echo $attach_uploadify_id; ?>').css('display', 'none');
$('#normalAttachUploadDiv<?php echo $attach_uploadify_id; ?>').css('display', 'block');
}
else
{
$('#uploadDescModuleSpanAttach<?php echo $attach_uploadify_id; ?>').html('普通');
$('#normalAttachUploadDiv<?php echo $attach_uploadify_id; ?>').css('display', 'none');
$('#swfUploadDivAttach<?php echo $attach_uploadify_id; ?>').css('display', 'block');
}
}
function modify_attach(id){var id = ('undefined'==typeof(id) ? 0 : id);var handle_key = 'mod_attach_win';var ajax_url = "ajax.php?mod=uploadattach&code=modify";showDialog(handle_key, 'ajax', "编辑", {"url":ajax_url, "post":{id:id}}, 400);}
</script> <?php if(!$attach_uploadify_only_js) { ?> <div id="insertAttachDiv<?php echo $attach_uploadify_id; ?>" class="insertAttachDiv"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <i class="insertAttachDiv_up" onclick="$(this).parent().hide()"><img src="static/image/imgdel.gif" title="关闭" /></i> <div id="swfUploadDivAttach<?php echo $attach_uploadify_id; ?>"><input type="file" id="publisher_file_attach<?php echo $attach_uploadify_id; ?>" name="publisher_file<?php echo $attach_uploadify_id; ?>" style="display:none;" /></div> <iframe id="attachUploadifyIframe<?php echo $attach_uploadify_id; ?>" name="attachUploadifyIframe<?php echo $attach_uploadify_id; ?>" width="0" height="0" marginwidth="0" frameborder="0" src="about:blank" style="display:none;"></iframe> <div id="normalAttachUploadDiv<?php echo $attach_uploadify_id; ?>" style="display:none;"> <form id="normalAttachUploadForm<?php echo $attach_uploadify_id; ?>" method="post"  action="ajax.php?mod=uploadattach&code=attach&type=normal&aitem=<?php echo $attach_item; ?>&aitemid=<?php echo $attach_itemid; ?>&topic_uid=<?php echo $attach_uploadify_topic_uid; ?>" enctype="multipart/form-data" target="attachUploadifyIframe<?php echo $attach_uploadify_id; ?>" onsubmit="return normalAttachUploadFormSubmit<?php echo $attach_uploadify_id; ?>()"> <input type="hidden" name="FORMHASH" value='<?php echo FORMHASH; ?>'/> <input type="hidden" name="attach_uploadify_id" value="<?php echo $attach_uploadify_id; ?>" /> <input type="file" id="normalAttachUploadFile<?php echo $attach_uploadify_id; ?>" name="topic" /> <input type="submit" value="上传" class="u-btn" /> </form> </div> <span id="uploadingAttach<?php echo $attach_uploadify_id; ?>"></span> <div id="uploadDescDivAttach<?php echo $attach_uploadify_id; ?>"> <span style="color:ff0000;">*</span> 如果您不能上传文件，可以<a href="javascript:;" onclick="attachUploadifyModuleSwitch<?php echo $attach_uploadify_id; ?>();">点击这里</a>尝试<span id="uploadDescModuleSpanAttach<?php echo $attach_uploadify_id; ?>">普通</span>模式上传
<?php if('topic_longtext_info_ajax'==$attach_uploadify_from) { ?> <br /><span class="fontRed">*</span> 文件上传成功后，可以点击文件将文件插入到您想要的位置
<?php } ?> </div> <div id="uploadifyQueueDivAttach<?php echo $attach_uploadify_id; ?>" style="display:none;"></div> <div id="viewAttachDiv<?php echo $attach_uploadify_id; ?>" class="viewAttachDiv"> <?php if((!$attach_uploadify_new || $attach_uploadify_modify) && $attach_uploadify_topic['attachid']) { ?> <?php if(is_array($attach_uploadify_topic['attach_list'])) { foreach($attach_uploadify_topic['attach_list'] as $ik => $iv) { ?> <script type="text/javascript"> __ATTACH_IDS__[<?php echo $ik; ?>] = <?php echo $ik; ?>; </script> <p id="uploadAttachSpan_<?php echo $ik; ?>" style="padding: 5px 0;"> <img src="<?php echo $iv['attach_img']; ?>" width="<?php echo $attach_img_siz; ?>" id="atta_<?php echo $ik; ?>" style="vertical-align: middle;"/>&nbsp;下载附件需消耗<input title="填写用户下载该附件所需贡献给你的积分" size="1" type="text" value="<?php echo $iv['attach_score']; ?>" onblur="set_attach_score(this.value,<?php echo $iv['id']; ?>,this);return false;">积分&nbsp;&nbsp;<a href="javascript:void(0);" onclick="modify_attach(<?php echo $iv['id']; ?>);return false;">编辑</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="attachUploadifyDelete<?php echo $attach_uploadify_id; ?>('<?php echo $ik; ?>'); return false;" title="删除文件">删除</a> </p> <?php } } ?> <?php } ?> </div> </div> <?php } ?> <style type="text/css">
.vv_2{ width:190px; position:relative;}
.vv_2{ width:190px; position:relative;}
</style> <div class="menu_fj" ><b class="menu_fjb_c menu_c_title" currid="showattachmenu<?php echo $h_key; ?>" title="上传本地附件">附件</b> <div class="menu_fjb menu_c_content insertImgDiv" id="showattachmenu<?php echo $h_key; ?>"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <div class="menu_fb"> <span style="float:left; padding-left:10px;">请选择上传的附件</span> </div> <div class="menu_pi" id="insertAttachDiv"> <div id="swfUploadDivAttach"> <input type="file" id="publisher_file_attach" name="publisher_file" style="display:none;" /> </div> <iframe id="attachUploadifyIframe" name="attachUploadifyIframe" width="0" height="0" marginwidth="0" frameborder="0" src="about:blank" style="display:none;"></iframe> <div id="normalAttachUploadDiv" style="display:none;"> <form id="normalAttachUploadForm" method="post"  action="ajax.php?mod=uploadattach&code=attach&type=normal&aitem=<?php echo $attach_item; ?>&aitemid=<?php echo $attach_itemid; ?>" enctype="multipart/form-data" target="attachUploadifyIframe" onsubmit="return normalAttachUploadFormSubmit()"> <input type="hidden" name="FORMHASH" value='<?php echo FORMHASH; ?>'/> <input type="file" id="normalAttachUploadFile" name="topic" /> <input type="submit" value="上传" class="u-btn" /> </form> </div> <i class="menu_fjb_c1 menu_close" currid="showattachmenu<?php echo $h_key; ?>"><img src="static/image/imgdel.gif" title="关闭" /></i> <em>
1、如不能上传文件，请<a href="javascript:;" onclick="attachUploadifyModuleSwitch();">点击这里</a>用<span id="uploadDescModuleSpanAttach">普通</span>模式上传.<br />
2、最多可上传<?php echo $attach_num; ?>个文件，单个文件大小不超过<?php echo $attach_size; ?>。
</em> <span id="uploadingAttach"></span> <div class="viewImgDiv" id="viewAttachDiv"></div> </div> <div id="uploadifyQueueDivAttach" style="display:none;"></div> </div> </div> <?php } ?> <?php if($this->Config['tag_enable']) { ?> <div class="menu_ht" id="button_<?php echo MEMBER_ID; ?>"> <span onclick="get_tag_choose(<?php echo MEMBER_ID; ?>,'my_tag','<?php echo $h_key; ?>');return false;"class="menu_htb_c menu_c_title" currid="showtagmenu<?php echo $h_key; ?>" title="点击添加话题，方便归类查看">话题</span> <div class="menu_htb menu_c_content" id="showtagmenu<?php echo $h_key; ?>"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <div id="<?php echo $h_key; ?>tag_<?php echo MEMBER_ID; ?>"></div> </div> </div> <?php } ?> <?php if($this->Config['vote_open']) { ?> <div class="menu_vs"><b class="menu_vsb_c menu_c_title" currid="showvotemenu<?php echo $h_key; ?>" title="发起或选择已有投票" onclick="getVoteAvtivityFromIndex('vote_publish', 'con_vote_content_1');">投票</b> <div class="menu_vsb menu_c_content" id="showvotemenu<?php echo $h_key; ?>"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <div class="menu_vsbox"> <p class="stitle"> <b id="vote_content1" class="vhover" onclick="setTab('vote_content',1,4,1);getVoteAvtivityFromIndex('vote_publish', 'con_vote_content_1');">创建文字投票</b> <b id="vote_content4" onclick="setTab('vote_content',4,4,1);getVoteAvtivityFromIndex('pic_vote_publish', 'con_vote_content_4','pic');">创建图片投票</b> <b id="vote_content2" onclick="setTab('vote_content',2,4,1);getMyVoteList(1);">我发起的</b> <b id="vote_content3" onclick="setTab('vote_content',3,4,1);getMyJoinList(1);">我参与的</b> <sub class="menu_vsb_c1 menu_close" currid="showvotemenu<?php echo $h_key; ?>"></sub> </p> <div class="vcontent" id="con_vote_content_1"> <p>正在加载...</p> </div> <div class="vcontent vote_conLi" id="con_vote_content_2" style="display:none;"> <p>正在加载...</p> </div> <div class="vcontent vote_conLi" id="con_vote_content_3" style="display:none;"> <p>正在加载...</p> </div> <div class="vcontent vote_conLi" id="con_vote_content_4" style="display:none;"> <p>正在加载...</p> </div> </div> </div> </div> <?php } ?> <?php if($this->Config['event_open']) { ?> <div class="menu_hd"> <b class="menu_hdb_c menu_c_title" currid="showeventmenu<?php echo $h_key; ?>" onclick="getEventPost();" title="发起或选择已有活动">活动</b> <div class="menu_hdb menu_c_content" id="showeventmenu<?php echo $h_key; ?>"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <div class="menu_hdbox"> <p class="stitle"> <b id="event_content1" class="vhover" onclick="setTab('event_content',1,3,0)">发起新活动</b> <b id="event_content2" onclick="setTab('event_content',2,3,0);getMyEventList(1);">我发起的</b> <b id="event_content3" onclick="setTab('event_content',3,3,0);getJoinEventList(1);">我参与的</b> <sub class="menu_hdb_c1 menu_close" currid="showeventmenu<?php echo $h_key; ?>"></sub> </p> <div class="vcontent" id="con_event_content_1"> <p>正在加载...</p> </div> <div class="vcontent vote_conLi" id="con_event_content_2" style="display:none;"> <p>正在加载...</p> </div> <div class="vcontent vote_conLi" id="con_event_content_3" style="display:none;"> <p>正在加载...</p> </div> </div> </div> </div> <?php } ?> <?php if($this->Config['qun_setting']['qun_open']) { ?> <div class="menu_wq"> <b class="menu_wqb_c menu_c_title" currid="showqunmenu<?php echo $h_key; ?>" title="将内容发布到我的微群" onclick="getMyQun();"><?php echo $this->Config['changeword']["weiqun"]; ?> </b> <div class="menu_wqb menu_c_content" id="showqunmenu<?php echo $h_key; ?>"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <div class="menu_wqbox" style="width:210px;"> <div class="menu_tb" style="width:210px;"> <span style="float:left; padding-left:10px;">选择你要发布到的<?php echo $this->Config['changeword']['weiqun']; ?></span> <sub class="menu_wqb_c1 menu_close" currid="showqunmenu<?php echo $h_key; ?>"></sub> </div> <div class="wcontent" id="wcontent_wp"></div> </div> </div> </div> <?php } ?> <?php if(!empty($GLOBALS['_J']['pluginhooks']['global_publish_menu_more'])) echo $GLOBALS['_J']['pluginhooks']['global_publish_menu_more'];?> </div> </div> </div> <?php if(!empty($GLOBALS['_J']['pluginhooks']['global_publish_menu'])) echo $GLOBALS['_J']['pluginhooks']['global_publish_menu'];?> <?php $topic_allow_syncd = true; ?> <?php if(defined('NEDU_MOYO')) { ?> <?php nlogic('feeds.app.jsg')->topic_publish_action_allowed('syncd', $topic_allow_syncd) ?> <?php } ?> <?php if(in_array($this->Get['mod'], array('qun','live','talk','event','vote','fenlei','reward','album','mall')) || $this->Get['type'] == 'ask' || !$topic_allow_syncd) { ?> <?php $topic_type_value = $this->Get['type'] == 'ask' ? $this->Get['item'] : $this->Get['mod']; ?> <?php $topic_allow_forward = true; ?> <?php if(defined('NEDU_MOYO')) { ?> <?php nlogic('feeds.app.jsg')->topic_publish_action_allowed('forward', $topic_allow_forward) ?> <?php } ?> <?php if($topic_allow_forward) { ?> <div class="send_share_box"> <b class="box_4_open_span menu_title" style="padding:0;"> <label><input id="chk_toweibo<?php echo $h_key; ?>" type="checkbox" checked="checked" onclick="selectAppTopicType(this.id, {toid:'topic_type<?php echo $h_key; ?>', defTopicType:'<?php echo $topic_type_value; ?>'})">转发给粉丝</label></b> </div> <?php } ?> <?php } else { ?> <?php if($this->Config['account_on_off'] && !in_array($type,array('design','btn_wyfx','answer','ask','album'))) { ?> <script type="text/javascript">
function modifySync(obj){
var urls='<?php echo $this->Config['site_url']; ?>/ajax.php?mod=misc&code=setsync';
$.getJSON(urls,{setting:$(obj).attr('data-setting'),type:$(obj).attr('data-type')},function(r){
var src = $(obj).attr('src');$(obj).attr('data-setting',r.retval);
if(r.retval){$(obj).attr('src',src.replace('icon_on.gif','icon_off.gif'));}else{$(obj).attr('src',src.replace('icon_off.gif','icon_on.gif'));}
});}
</script> <div class="send_share_box" id="weibo_syn_wp"> <?php if($this->Config['sina_enable'] || $this->Config['sina_enable'] || $this->Config['qqwb_enable'] || $this->Config['kaixin_enable'] || $this->Config['renren_enable']) { ?> <b class="box_4_open_span menu_title" title="将内容同步发到高亮按钮对应平台">同步到：</b> <?php } ?> <sub class="box_4_open_span_c1"></sub> <?php if($this->Config['sina_enable'] && sina_weibo_init()) { ?> <span> <?php echo sina_weibo_syn(); ?> </span> <?php } ?> <?php if($this->Config['qqwb_enable'] && qqwb_init()) { ?> <span> <?php echo qqwb_syn(); ?> </span> <?php } ?> <?php if($this->Config['kaixin_enable'] && kaixin_init()) { ?> <span> <?php echo kaixin_syn_html(); ?> </span> <?php } ?> <?php if($this->Config['renren_enable'] && renren_init()) { ?> <span> <?php echo renren_syn_html(); ?> </span> <?php } ?> </div> <?php } ?> <?php } ?> <?php } else { ?><div class="box_3ajax"> <?php } ?> </div> <?php $channel_must = $this->Channel_enable && $this->Config['channel_enable'] && $this->Config['channel_must'] ? 1 : 0; ?> <div class="sendBtn"> <?php if ($this->Get['mod'] == 'tag') $type = 'tagview' ;elseif ($this->Get['mod'] == 'member') $type = 'tohome';elseif ($this->Get['mod'] == 'vote') $type='vote';elseif ($this->Get['mod'] == 'live') $type='live';elseif ($this->Get['mod'] == 'talk') $type='talk';elseif ($this->Get['mod'] == 'fenlei') $type='fenlei';elseif ($this->Get['mod'] == 'event') $type='event';elseif ($this->Get['mod'] == 'reward') $type='reward'; else $type = $params['code']; ?> <?php $type = $type ? $type : $this->Code; ?> <?php if($this->Config['seccode_publish'] && $this->yxm_title) { ?> <input type="hidden" id="yxm_topicpub<?php echo $h_key; ?>" onclick="publishSubmit('publishSubmit<?php echo $h_key; ?>','u-btn','i_already<?php echo $h_key; ?>','totid<?php echo $h_key; ?>','<?php echo $type; ?>','topic_type<?php echo $h_key; ?>','','',$('#mapp_item<?php echo $h_key; ?>').val(),$('#mapp_item_id<?php echo $h_key; ?>').val(),$('#xiami_id').val(),$('#touid<?php echo $h_key; ?>').val(),<?php echo $channel_must; ?>,$('#cverify').val());return false;"> <?php } ?> <?php if(!($this->Code=='do_first_topic')) { ?> <?php if($this->Config['anonymous_enable']) { ?> <label><input type="checkbox" id="anonymoustopic_type<?php echo $h_key; ?>" value="" class="publish_menu_input_empty" onclick="set_relate(1,'anonymoustopic_type<?php echo $h_key; ?>');">匿名</label> <?php } ?> <input type="button" class="u-btn" id="publishSubmit<?php echo $h_key; ?>" title="按Ctrl+Enter快捷发布" value="发 布"/> <?php } ?> </div> </div> <?php if(!empty($GLOBALS['_J']['pluginhooks']['global_publish_bottom'])) echo $GLOBALS['_J']['pluginhooks']['global_publish_bottom'];?> <?php if($this->Config['seccode_publish'] && $this->yxm_title) { ?> <span id="yxm_pub_button<?php echo $h_key; ?>" onclick="YXM_popBox(this,'topic,<?php echo $h_key; ?>','<?php echo $this->yxm_title; ?>');" style="margin-left:150px;height:1px;">&nbsp;</span> <?php } ?> </div> </div> <script type="text/javascript">
var dfpstr = '<?php echo $content_dstr; ?>';
//如果是群、并且没有设置转发给粉丝的话、将topic_type<?php echo $h_key; ?> 设置成qun；chk_toweibo<?php echo $h_key; ?> 的checked设置成''；
<?php if($this->Get['mod'] == 'qun' && !$this->Config['qun_setting']['qun_topic_to_weibo']) { ?>
setQun();
<?php } ?>
function setQun(){
$("#chk_toweibo<?php echo $h_key; ?>").removeAttr('checked');
$("#topic_type<?php echo $h_key; ?>").val('qun');
}
$("#i_already<?php echo $h_key; ?>").bind('focus', function(){
if($('#tochannel').length>0){$('#send_follow<?php echo $h_key; ?>').hide();$('#tochannel').show();}
$('.sendInsert').addClass('sendInsertfocus');			
//$('.sendInsert a').css('color','#333');
var i=0;
// setTimeout(function(){i+=1; $('#sendTig').css('visibility', 'hidden'); },5000);
});
$(".sendInsert *").bind('click', function(){
$('.sendInsert').addClass('sendInsertfocus');del_instr(0);
//$('.sendInsert a').css('color','#333');
});
<?php if($this->Config['seccode_publish'] && $this->yxm_title) { ?>
$("#publishSubmit<?php echo $h_key; ?>").bind('click',function() {
YXM_pubtopic('i_already<?php echo $h_key; ?>','<?php echo $h_key; ?>','topic_type<?php echo $h_key; ?>','',$('#mapp_item_id<?php echo $h_key; ?>').val(),<?php echo $channel_must; ?>);return false;
});
<?php } else { ?>$("#publishSubmit<?php echo $h_key; ?>").bind('click',function() {
publishSubmit('publishSubmit<?php echo $h_key; ?>','u-btn','i_already<?php echo $h_key; ?>','totid<?php echo $h_key; ?>','<?php echo $type; ?>','topic_type<?php echo $h_key; ?>','','',$('#mapp_item<?php echo $h_key; ?>').val(),
$('#mapp_item_id<?php echo $h_key; ?>').val(),$('#xiami_id').val(),$('#touid<?php echo $h_key; ?>').val(),<?php echo $channel_must; ?>,$('#cverify').val());
return false;
});
<?php } ?>
$(document).ready(function(){
initAiInput('i_already<?php echo $h_key; ?>');$('#i_already<?php echo $h_key; ?>').setCaret();
checkWord('<?php echo $GLOBALS['_J']['config']['topic_input_length']; ?>','i_already<?php echo $h_key; ?>','wordCheck<?php echo $h_key; ?>');
$("#i_already<?php echo $h_key; ?>").autoTextarea({maxHeight:220});
get_publish_str("#i_already<?php echo $h_key; ?>",publish_in_str,'<?php echo $content_dstr; ?>','<?php echo $not_indestr; ?>');
});		
//发布到频道文字闪动效果
function shake(ele,cls,times){
var i = 0, t = false, o = ele.attr("class")+" ", c = "", times = times||2;
if(t) return;
t= setInterval(function(){
i++;
c = i%2 ? o+cls : o;
ele.attr("class",c);
if(i==2*times){
clearInterval(t);
ele.addClass(cls);
}
},200);
};
var pint = null;
function get_publish_str(obj,arr_str,str,aj){
var count_in = arr_str.length;
pint= setInterval(function(){if(count_in > 1 && str && !aj){var randnum_in = (1+Math.random()*(count_in-1)).toFixed(0)-1;dfpstr=arr_str[randnum_in];$(obj).val(dfpstr);}},10000);
}
function del_instr(c){
clearInterval(pint);if($("#i_already<?php echo $h_key; ?>").val()==dfpstr){if(c){$("#i_already<?php echo $h_key; ?>").val('<?php echo $content; ?>')}else{$("#i_already<?php echo $h_key; ?>").val('');}};
}
$("#i_already<?php echo $h_key; ?>").bind({
click:function(){
if($('#t_pb').length>0){shake($("#t_pb"),"select_shake",2);}del_instr(1);
return false;
}
});
</script>