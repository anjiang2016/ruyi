<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?><link href="static/style/imgupload.css?build+20140922" rel="stylesheet" type="text/css" /> <script type="text/javascript" src="static/js/imgupload.js?build+20140922"></script> <script type="text/javascript">
var __IMAGE_IDS__ = {};$(function(){$(".nav_title<?php echo $h_key; ?>").click(function(){$(".currtitle<?php echo $h_key; ?> .curr").removeClass("curr");$(this).addClass("curr");$(".upload_frame<?php echo $h_key; ?>").hide();var id = $(this).attr("currid");if(id){$("#"+id).show();if('upload_frame_2<?php echo $h_key; ?>'==id && ''==$("#album_list<?php echo $h_key; ?>").html()){get_album('<?php echo $h_key; ?>',0,1);}}});$('#publisher_file<?php echo $h_key; ?>').uploadify({'uploader':'<?php echo $GLOBALS['_J']['config']['site_url']; ?>/images/uploadify/uploadify.swf?id=&random='+Math.random(),'script':'<?php echo urlencode($GLOBALS['_J']['config']['site_url']."/ajax.php?mod=uploadify&code=image&uninitmember=1&type=flash&iitem=$img_item&iitemid=$img_itemid"); ?>','cancelImg':'<?php echo $GLOBALS['_J']['config']['site_url']; ?>/images/uploadify/cancel.png','buttonImg':'<?php echo $GLOBALS['_J']['config']['site_url']; ?>/images/uploadify/upload.gif','width':52,'height':52,'multi':true,'auto':true,'sizeLimit':'<?php echo $GLOBALS['_J']['config']['image_size_limit']; ?>','fileExt':'*.jpg;*.png;*.gif;*.jpeg','fileDesc':'请选择图片文件(*.jpg;*.png;*.gif;*.jpeg)','queueID':'uploadifyQueueDiv','wmode':'transparent','fileDataName':'topic','queueSizeLimit':<?php echo $GLOBALS['_J']['config']['image_uploadify_queue_size_limit']; ?>,'simUploadLimit':1,'scriptData':{'cookie_auth':'<?php echo urlencode(jsg_getcookie("auth")); ?>'},'onSelect':function(event,ID,fileObj){},'onSelectOnce':function(event,data){imageUploadifySelectOnce('<?php echo $h_key; ?>');},'onProgress':function(event,ID,fileObj,data){return false;},'onComplete':function(event,ID,fileObj,response,data){eval('var r ='+response+';');if(r.done){var rv=r.retval;if(rv.id>0&&rv.src.length>0) {imageUploadifyComplete('<?php echo $h_key; ?>',rv.id, rv.src, fileObj.name);}}},'onError':function (event,ID,fileObj,errorObj){alert(errorObj.type+'Error:'+errorObj.info);},'onAllComplete':function(event,data){imageUploadifyAllComplete('<?php echo $h_key; ?>');},'onSWFReadyFall':function(){$('#publisher_file<?php echo $h_key; ?>').after("<img src='images/uploadify/upload.gif'><div style='position: absolute; left: 10px; top: 87px; display: block; overflow: hidden; background-color: rgb(0, 0, 0); opacity: 0; width: 52px; height: 52px;'><iframe id='imageUploadifyIframe<?php echo $h_key; ?>' name='imageUploadifyIframe<?php echo $h_key; ?>' width='0' height='0' marginwidth='0' frameborder='0' src='about:blank' style='display:none;'></iframe><fo"+"rm id='normalUploadForm<?php echo $h_key; ?>' method='post' action='ajax.php?mod=uploadify&code=image&type=normalnew&iitem=<?php echo $img_item; ?>&iitemid=<?php echo $img_itemid; ?>&divid=<?php echo $h_key; ?>' enctype='multipart/form-data' target='imageUploadifyIframe<?php echo $h_key; ?>' style='margin:0;padding:0;'><input type='file' accept='image/*' style='width:52px; height: 52px;cursor:pointer;' id='normalUploadFile<?php echo $h_key; ?>' name='topic' onchange=\"document.getElementById('normalUploadForm<?php echo $h_key; ?>').submit();imageUploadifySelectOnce('<?php echo $h_key; ?>')\"/></form></div>");}});});
</script> <div class="imgupload"> <p class="navtab currtitle<?php echo $h_key; ?>"> <b class="curr nav_title<?php echo $h_key; ?>" currid="upload_frame_1<?php echo $h_key; ?>">上传图片</b> <b class="nav_title<?php echo $h_key; ?>" currid="upload_frame_2<?php echo $h_key; ?>">相册图片</b> <b class="nav_title<?php echo $h_key; ?>" currid="upload_frame_3<?php echo $h_key; ?>">网络图片</b> <b class="nav_title<?php echo $h_key; ?>" currid="upload_frame_4<?php echo $h_key; ?>">图片搜索</b> </p> <div class="upload_frame_area"> <iframe id="frameupimg<?php echo $h_key; ?>" name="frameupimg<?php echo $h_key; ?>" width="0" height="0" marginwidth="0" frameborder="0" src="about:blank" style="display:none;"></iframe> <form id="formalbum<?php echo $h_key; ?>"> <div class="upload_frame<?php echo $h_key; ?>" id="upload_frame_1<?php echo $h_key; ?>"> <div id="swfUploadDiv<?php echo $h_key; ?>" class="upload_area"> <span id="albumlist<?php echo $h_key; ?>" style="display:block; margin-bottom:10px;text-align: right;"> <label style="float:left;"><input type="checkbox" name="selectallimg" value="1" onchange="selectAllUpImg(this.checked);" onpropertychange="selectAllUpImg(this.checked);">全选</label>将选中的图片同时保存到相册：<select name="uploadalbum" id="uploadalbum<?php echo $h_key; ?>" onchange="if(this.value == '-1'){selectCreateTab('<?php echo $h_key; ?>',0);}"><option value="0">默认相册</option> <?php if($albums) { ?> <?php if(is_array($albums)) { foreach($albums as $val) { ?> <option value="<?php echo $val['albumid']; ?>"><?php echo $val['albumname']; ?></option> <?php } } ?> <?php } ?> <option value="-1" style="color:red;">+创建新相册</option></select> <input type="button" value="保 存" class="u-btn u-btn-cancel" onclick="saveimgcallback('<?php echo $h_key; ?>','<?php echo $handle_key; ?>');"> </span> <span id="creatalbum<?php echo $h_key; ?>"></span> <input type="file" id="publisher_file<?php echo $h_key; ?>" name="publisher_file" style="display:none;"> </div> <p class="upload_notice">1.最多可上传<?php echo $GLOBALS['_J']['config']['image_uploadify_queue_size_limit']; ?>张图片，单张图片大小不超过
<?php echo(round($this->Config['image_size']/1024, 2)); ?>
M。<br>2.点击图片可插入内容区，您可为图片位置进行排版。</p> <span id="uploading<?php echo $h_key; ?>"></span> <table id="viewImgDiv<?php echo $h_key; ?>" class="tempimglist"> <?php if($uploadimages) { ?> <?php if(is_array($uploadimages)) { foreach($uploadimages as $ik => $iv) { ?> <script type="text/javascript"> __IMAGE_IDS__[<?php echo $ik; ?>] = <?php echo $ik; ?>; </script> <tr id="upimg_<?php echo $ik; ?>"><td valign='top'><input type='checkbox' name='ids[]' value="<?php echo $ik; ?>" title='保存到相册'></td><td valign='middle'><a href="javascript:;" id="insert_image_<?php echo $ik; ?>" onclick="insertIntoContent('image',<?php echo $ik; ?>,'i_already<?php echo $h_key; ?>');" title="点击插入"><img src="<?php echo $iv['img']; ?>" width='50' height='50'></a></td><td valign='middle'><textarea name='title[<?php echo $ik; ?>]' maxlength='140' onfocus="if(this.value == '图片简介') {this.value = '';}" onblur="if(this.value == '') {this.value = '图片简介';}"><?php echo $iv['description']; ?></textarea></td><td valign='middle'><a title="删除图片" onclick="imageUploadifyDelete(<?php echo $ik; ?>,'<?php echo $tid; ?>');return false;" href="javascript:void(0);" class="u-del">X</a></td></tr> <?php } } ?> <?php } ?> </table> <p class="submitbottom"></p> </div> <div class="upload_frame<?php echo $h_key; ?>" id="upload_frame_2<?php echo $h_key; ?>" style="display:none;"> <p class="add">从我的相册中选择图片: <select onchange="get_album('<?php echo $h_key; ?>',this.value,1);"><option value="0">默认相册</option> <?php if(is_array($albums)) { foreach($albums as $val) { ?> <option value="<?php echo $val['albumid']; ?>"><?php echo $val['albumname']; ?></option> <?php } } ?> </select></p> <table id="album_list<?php echo $h_key; ?>"></table> <p class="submitbottom"><input type="button" value="保 存" class="u-btn u-btn-cancel" onclick="saveimgcallback('<?php echo $h_key; ?>','<?php echo $handle_key; ?>');"></p> </div> <div class="upload_frame<?php echo $h_key; ?>" id="upload_frame_3<?php echo $h_key; ?>" style="display:none;"> <p class="add"><input type="text" id="img_url<?php echo $h_key; ?>"  value="请输入图片url地址" onclick="if(this.value=='请输入图片url地址'){this.value = '';}"/><a href="javascript:void(0);" onclick="getUrlImage('<?php echo $h_key; ?>',img_url<?php echo $h_key; ?>);" class="u-btn" style="color:#fff;">上传图片</a></p> <span id="uploading_img<?php echo $h_key; ?>" style="display:none"><img src='images/loading.gif'/>&nbsp;上传中，请稍候……</span> <table id="viewUrlImgDiv<?php echo $h_key; ?>"></table> <p class="submitbottom"><input type="button" value="保 存" class="u-btn u-btn-cancel" onclick="saveimgcallback('<?php echo $h_key; ?>','<?php echo $handle_key; ?>');"></p> </div> <div class="upload_frame<?php echo $h_key; ?>" id="upload_frame_4<?php echo $h_key; ?>" style="display:none;"> <p class="add"><input type="text" id="word<?php echo $h_key; ?>" name="word" value="请输入关键字，如：世界末日" onclick="if(this.value=='请输入关键字，如：世界末日'){this.value = '';}"/><a href="javascript:void(0);" onclick="searchBaiDuImg('<?php echo $h_key; ?>');" class="u-btn"  style="color:#fff;">搜索图片</a></p> <div id="baidu_image<?php echo $h_key; ?>" class="baiduimgdiv"></div> </div> </div> </form> </div>