function force_out(uid){
	var handle_key = 'force_out';
	if(uid < 1){show_message('��ѡ��Ҫ��ɱ�Ķ���');return false;}
	showDialog(handle_key, 'ajax', '��ɱ�û�', {url:'ajax.php?mod=topic_manage&code=force_out&uid='+uid}, 400);
}

function sendemailtoleader(uid,tid,type){
	var handle_key = 'sendemail';
	if(tid < 1 || uid < 1){show_message('��ѡ��Ҫ�����Ķ���');return false;}
	showDialog(handle_key, 'ajax', '����', {url:'ajax.php?mod=topic_manage&code=sendemail&uid='+uid+'&tid='+tid+'&type='+type}, 400);
}

function setFilterRed(){
	document.getElementById('setfiledmsg').style.display = 'block';
	$.post(
		'ajax.php?mod=class&code=getfilter&type=verify_list',
		{},
		function(d){
			if(d.done == true){
				if(d.retval.length > 0){
					var i = 0;
					var str = $('#topic_verify_list').html();
					for(i=0;i<d.retval.length;i++){
						str = str.replace(new RegExp(d.retval[i], 'g'),"<font color=red>"+d.retval[i]+"</font>");
					}
					$('#topic_verify_list').html(str);
					document.getElementById('setfiledmsg').style.display = 'none';
				}
			}
		},'json'
	)
}

function force_ip(ip){
	if('undefined' == typeof(ip)){
		show_message('��ЧIP',3);
		return false;
	}
	if(!confirm('ȷ�Ϸ�ɱ��IP��')){
		return false;
	}
	$.post(
		'ajax.php?mod=topic_manage&code=force_ip',	
		{ip:ip},
		function(d){
			show_message(d.msg,3);
		},'json'
	)
}