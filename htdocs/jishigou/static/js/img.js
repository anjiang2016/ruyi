function get_album(aid,page){
	$.post('ajax.php?mod=uploadify&code=album',{aid:aid,page:page},function(d){$('#album_list').html(d);});
}
function selectCreateTab(flag){
	if(flag==0){
		var html = "<input type='text' maxlength='15' name='newalbum' id='newalbum' size='15' value='�������������' onfocus=\"if(this.value == '�������������') {this.value = '';}\" onblur=\"if(this.value == '') {this.value = '�������������';}\">&nbsp;<button type='button' class='u-btn' onclick='createNewAlbum(0);'><span>���������</span></button>&nbsp;<button type='button' class='u-btn u-btn-cancel' onclick='selectCreateTab(1);'><span>ȡ��</span></button>";
		$('#albumlist').hide();$('#creatalbum').html(html);$('#creatalbum').show();
	}else{
		$('#uploadalbum').val(0);$('#albumlist').show();$('#creatalbum').html('');$('#creatalbum').hide();
	}
}
function createNewAlbum(type){
	var name = $('#newalbum').val();
	if(name && name != '�������������'){
		$.post('ajax.php?mod=uploadify&code=addalbum',{name:name},function(d){if(d>0){if(type){$('#albumlists').prepend('<li class="new" id="album_'+d+'"><img src="images/noavatar.gif" width="130" height="130"><br><a href="index.php?mod=album&aid='+d+'">'+name+'</a><br>ͼƬ��0��<br><a class="usermod" href="javascript:;" onclick=\'albumimagedone("album","mod",'+d+');\'>�༭</a><a class="usermod" href="javascript:;" onclick=\'albumimagedone("album","del",'+d+');\'>ɾ��</a></li>');$('#addalbumhtml').html('<input type="button" value="������" class="u-btn" onclick="Createalbum(0);">');show_message('�����ӳɹ�!');}else{$('#uploadalbum').append('<option value="'+d+'" selected>'+name+'</option>');$('#albumlist').show();$('#creatalbum').html('');$('#creatalbum').hide();}}else{show_message('������Ѿ����ڣ����ʧ�ܣ�',2,'��ʾ','msgBox','msg_alert');}});
	}
}
function selectAllUpImg(state){
	if(state){$("input[name='ids[]']").attr("checked",true);}else{$("input[name='ids[]']").attr("checked",false);}
}
function upimgback(app,handle_key){
	$("input[name='idas[]']:checked").each(function(){__IMAGE_IDS__[$(this).val()] = $(this).val();});
	$('#formalbum').attr({action:"index.php?mod=album&code=updateimg&reload=1&app="+app+"&hkey="+handle_key,target:"frameupimg",method:"post"});
	$('#formalbum').submit();
}
function albumimagedone(type,done,id){
	if('mod'==done){
		var ajax_url = "ajax.php?mod=uploadify&code=albumedit&type="+type+"&id="+id;
		var handle_key = type+'_win_'+id+'_'+Date.parse(new Date());
		showDialog(handle_key, 'ajax', "�༭", {"url":ajax_url});
	}else if('del'==done){
		var mstr = ('album'==type) ? '���' : 'ͼƬ';
		options = {'onClickYes':function(){
			$.post('ajax.php?mod=uploadify&code=delalbumimage',{type:type,id:id},function(d){if(d>0){show_message('ɾ���ɹ�');$('#'+type+'_'+id).remove();}else{show_message('��'+mstr+'������ɾ����ɾ��ʧ�ܣ�',2,'��ʾ','msgBox','msg_alert');}});
		}}
		MessageBox('confirm','��ȷ��Ҫɾ����'+mstr+'��','��ʾ', options);
	}
}
function Createalbum(flag){
	if(flag==0){
		var html = "<input type='text' maxlength='15' name='newalbum' id='newalbum' size='30' value='�������������' onfocus=\"if(this.value == '�������������') {this.value = '';}\" onblur=\"if(this.value == '') {this.value = '�������������';}\">&nbsp;<button type='button' class='u-btn' onclick='createNewAlbum(1);'><span>���������</span></button>&nbsp;<button type='button' class='u-btn u-btn-cancel' onclick='Createalbum(1);'><span>ȡ��</span></button>";
	}else{
		var html = '<input type="button" value="������" class="u-btn" onclick="Createalbum(0);">';
	}
	$('#addalbumhtml').html(html);
}
function editalbum(handle_key,type,id){
	if('image' == type){if($('#namea').val() != $('#oldnamea').val()){$('#'+type+'_'+id).remove();}else if($('#description').val() != $('#olddescription').val()){$('#'+type+'_'+id+'_name').html($('#description').val());}}else if($('#namea').val() != $('#oldnamea').val()){$('#'+type+'_'+id+'_name').html($('#namea').val());}
	$('#editalbumform').attr({action:"index.php?mod=album&code=updatealbum&type="+type+"&id="+id+"&hkey="+handle_key,target:"frameeditalbum",method:"post"});
	$('#editalbumform').submit();
}