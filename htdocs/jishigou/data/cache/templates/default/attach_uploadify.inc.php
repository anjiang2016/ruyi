<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?>
<?php $attach_uploadify_id=$topic_textarea_id.$attach_uploadify_type.($attach_uploadify_topic['tid']>0?"_".$attach_uploadify_topic['tid']:""); ?> <?php $attach_img_siz=$attach_img_siz?$attach_img_siz:32; ?> <?php $attach_fz_siz=min(max(1,(int)$this->Config['attach_size_limit']),51200)*1024; ?> <?php $topic_textarea_id=$topic_textarea_id?$topic_textarea_id:'i_already'.$h_key; ?> <?php $topic_textarea_empty_val=isset($topic_textarea_empty_val)?$topic_textarea_empty_val:'�����ļ�'; ?> <?php $attach_uploadify_queue_size_limit=min(max(1,(int)$this->Config['attach_files_limit']),50); ?> <?php $attach_item=isset($this->item)?$this->item:''; ?> <?php $attach_itemid=isset($this->item_id)?$this->item_id:0; ?> <success></success> <script type="text/javascript">
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
//�޸�ѡ��ķ������
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
MessageBox('warning','��û���ϴ��ļ���Ȩ�ޣ��޷�����������');
}else{
MessageBox('warning', '�ϴ�ʧ�ܣ��ļ�����������ʽ����');
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
//ɾ��һ���ļ�
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
$('#uploadingAttach<?php echo $attach_uploadify_id; ?>').html("<p><img src='images/loading.gif'/>&nbsp;�ϴ��У����Ժ򡭡�</p>");
}
function attachUploadifyComplete<?php echo $attach_uploadify_id; ?>(idval, srcval, nameval)
{
var attachIdsCount = 0;
$.each( __ATTACH_IDS__, function( k, v ) { if( v > 0 ) { attachIdsCount += 1; } } );
if( attachIdsCount >= <?php echo $attach_uploadify_queue_size_limit; ?> )
{
MessageBox('warning', '�����ļ���������������');
return false;
}
var idval = ('undefined' == typeof(idval) ? 0 : idval);
var srcval = ('undefined' == typeof(srcval) ? 0 : srcval);
var nameval = ('undefined' == typeof(nameval) ? '' : nameval);
<?php if('topic_publish'==$attach_uploadify_from) { ?>
$('#viewAttachDiv<?php echo $attach_uploadify_id; ?>').prepend('<li id="uploadAttachSpan_' + idval + '" class="menu_ps vv_2"><img src="' + srcval + '" class="uploadAttachSpan_img_type"/> <p class="uploadAttachSpan_doc_type"><i>' + nameval + '</i></p><p>��<a title="ɾ���ļ�" onclick="attachUploadifyDelete<?php echo $attach_uploadify_id; ?>(' + idval + ');return false;" href="javascript:;">ɾ</a>����<input title="��д�û����ظø������蹱�׸���Ļ���" size="1" type="text" onblur="set_attach_score(this.value,' + idval + ',this);return false;">���� </p></li>');<?php } elseif('topic_longtext_info_ajax'==$attach_uploadify_from) { ?>$('#viewAttachDiv<?php echo $attach_uploadify_id; ?>').append('<span id="uploadAttachSpan_' + idval + '"><img src="' + srcval + '" width="<?php echo $attach_img_siz; ?>" alt="����ļ����뵽����" onclick="longtext_info_img_insert(\'' + srcval + '\');" />��<a href="javascript:void(0);" onclick="attachUploadifyDelete<?php echo $attach_uploadify_id; ?>(' + idval + '); return false;" title="ɾ���ļ�">ɾ</a>����<input title="��д�û����ظø������蹱�׸���Ļ���" size="1" type="text" onblur="set_attach_score(this.value,' + idval + ',this);return false;">����</span>');
<?php } else { ?>$('#viewAttachDiv<?php echo $attach_uploadify_id; ?>').append('<span id="uploadAttachSpan_' + idval + '"><img src="' + srcval + '" width="<?php echo $attach_img_siz; ?>" />��<a href="javascript:void(0);" onclick="attachUploadifyDelete<?php echo $attach_uploadify_id; ?>(' + idval + '); return false;" title="ɾ���ļ�">ɾ</a>����<input title="��д�û����ظø������蹱�׸���Ļ���" size="1" type="text" onblur="set_attach_score(this.value,' + idval + ',this);return false;">����</span>');
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
MessageBox('warning', '���ϴ���ȷ��ʽ�ĸ����ļ�');
return false;
}
else
{
if(!(/\.(<?php echo $this->Config['attach_file_type']; ?>)$/i.test(fileVal)))
{
MessageBox('warning', '��ѡ��һ����ȷ��ʽ�ĸ����ļ�');
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
$('#uploadDescModuleSpanAttach<?php echo $attach_uploadify_id; ?>').html('����');
$('#swfUploadDivAttach<?php echo $attach_uploadify_id; ?>').css('display', 'none');
$('#normalAttachUploadDiv<?php echo $attach_uploadify_id; ?>').css('display', 'block');
}
else
{
$('#uploadDescModuleSpanAttach<?php echo $attach_uploadify_id; ?>').html('��ͨ');
$('#normalAttachUploadDiv<?php echo $attach_uploadify_id; ?>').css('display', 'none');
$('#swfUploadDivAttach<?php echo $attach_uploadify_id; ?>').css('display', 'block');
}
}
function modify_attach(id){var id = ('undefined'==typeof(id) ? 0 : id);var handle_key = 'mod_attach_win';var ajax_url = "ajax.php?mod=uploadattach&code=modify";showDialog(handle_key, 'ajax', "�༭", {"url":ajax_url, "post":{id:id}}, 400);}
</script> <?php if(!$attach_uploadify_only_js) { ?> <div id="insertAttachDiv<?php echo $attach_uploadify_id; ?>" class="insertAttachDiv"> <span class="arrow-up"></span> <span class="arrow-up-in"></span> <i class="insertAttachDiv_up" onclick="$(this).parent().hide()"><img src="static/image/imgdel.gif" title="�ر�" /></i> <div id="swfUploadDivAttach<?php echo $attach_uploadify_id; ?>"><input type="file" id="publisher_file_attach<?php echo $attach_uploadify_id; ?>" name="publisher_file<?php echo $attach_uploadify_id; ?>" style="display:none;" /></div> <iframe id="attachUploadifyIframe<?php echo $attach_uploadify_id; ?>" name="attachUploadifyIframe<?php echo $attach_uploadify_id; ?>" width="0" height="0" marginwidth="0" frameborder="0" src="about:blank" style="display:none;"></iframe> <div id="normalAttachUploadDiv<?php echo $attach_uploadify_id; ?>" style="display:none;"> <form id="normalAttachUploadForm<?php echo $attach_uploadify_id; ?>" method="post"  action="ajax.php?mod=uploadattach&code=attach&type=normal&aitem=<?php echo $attach_item; ?>&aitemid=<?php echo $attach_itemid; ?>&topic_uid=<?php echo $attach_uploadify_topic_uid; ?>" enctype="multipart/form-data" target="attachUploadifyIframe<?php echo $attach_uploadify_id; ?>" onsubmit="return normalAttachUploadFormSubmit<?php echo $attach_uploadify_id; ?>()"> <input type="hidden" name="FORMHASH" value='<?php echo FORMHASH; ?>'/> <input type="hidden" name="attach_uploadify_id" value="<?php echo $attach_uploadify_id; ?>" /> <input type="file" id="normalAttachUploadFile<?php echo $attach_uploadify_id; ?>" name="topic" /> <input type="submit" value="�ϴ�" class="u-btn" /> </form> </div> <span id="uploadingAttach<?php echo $attach_uploadify_id; ?>"></span> <div id="uploadDescDivAttach<?php echo $attach_uploadify_id; ?>"> <span style="color:ff0000;">*</span> ����������ϴ��ļ�������<a href="javascript:;" onclick="attachUploadifyModuleSwitch<?php echo $attach_uploadify_id; ?>();">�������</a>����<span id="uploadDescModuleSpanAttach<?php echo $attach_uploadify_id; ?>">��ͨ</span>ģʽ�ϴ�
<?php if('topic_longtext_info_ajax'==$attach_uploadify_from) { ?> <br /><span class="fontRed">*</span> �ļ��ϴ��ɹ��󣬿��Ե���ļ����ļ����뵽����Ҫ��λ��
<?php } ?> </div> <div id="uploadifyQueueDivAttach<?php echo $attach_uploadify_id; ?>" style="display:none;"></div> <div id="viewAttachDiv<?php echo $attach_uploadify_id; ?>" class="viewAttachDiv"> <?php if((!$attach_uploadify_new || $attach_uploadify_modify) && $attach_uploadify_topic['attachid']) { ?> <?php if(is_array($attach_uploadify_topic['attach_list'])) { foreach($attach_uploadify_topic['attach_list'] as $ik => $iv) { ?> <script type="text/javascript"> __ATTACH_IDS__[<?php echo $ik; ?>] = <?php echo $ik; ?>; </script> <p id="uploadAttachSpan_<?php echo $ik; ?>" style="padding: 5px 0;"> <img src="<?php echo $iv['attach_img']; ?>" width="<?php echo $attach_img_siz; ?>" id="atta_<?php echo $ik; ?>" style="vertical-align: middle;"/>&nbsp;���ظ���������<input title="��д�û����ظø������蹱�׸���Ļ���" size="1" type="text" value="<?php echo $iv['attach_score']; ?>" onblur="set_attach_score(this.value,<?php echo $iv['id']; ?>,this);return false;">����&nbsp;&nbsp;<a href="javascript:void(0);" onclick="modify_attach(<?php echo $iv['id']; ?>);return false;">�༭</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="attachUploadifyDelete<?php echo $attach_uploadify_id; ?>('<?php echo $ik; ?>'); return false;" title="ɾ���ļ�">ɾ��</a> </p> <?php } } ?> <?php } ?> </div> </div> <?php } ?> <style type="text/css">
.vv_2{ width:190px; position:relative;}
.vv_2{ width:190px; position:relative;}
</style>