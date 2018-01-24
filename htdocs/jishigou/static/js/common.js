/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 * 
 * This is NOT a freeware, use is subject to license terms
 * 
 * @Filename common.js $
 * 
 * @Author http://www.jishigou.net $
 * 
 * @version $Id$
 */

var userAgent=navigator.userAgent.toLowerCase();
var is_opera=userAgent.indexOf('opera')!=-1&&opera.version();
var is_moz=(navigator.product=='Gecko')&&userAgent.substr(userAgent.indexOf('firefox')+8,3);
var is_ie=(userAgent.indexOf('msie')!=-1&&!is_opera)&&userAgent.substr(userAgent.indexOf('msie')+5,3);
var is_safari=(userAgent.indexOf('webkit')!=-1||userAgent.indexOf('safari')!=-1);
// if(top.location!=location){top.location.href=location.href;}
var maxl=thisTopicLength;
var last_recommend_tid = 0;
var JSLOADED = [];
var evalscripts = [];

// ����ajax���ش���js���õ����
function evalscript(s)
{
	if(s.indexOf('<script') == -1) return s;
	var p = /<script[^\>]*?>([^\x00]*?)<\/script>/ig;
	var arr = [];
	while(arr = p.exec(s)) {
		var p1 = /<script[^\>]*?src=\"([^\>]*?)\"[^\>]*?(reload=\"1\")?(?:charset=\"([\w\-]+?)\")?><\/script>/i;
		var arr1 = [];
		arr1 = p1.exec(arr[0]);
		if(arr1) {
			appendscript(arr1[1], '', arr1[2], arr1[3]);
			// ��ֹjqueryȥ����js�ļ�
			s = s.replace(arr1[0], '');
		} else {
			p1 = /<script(.*?)>([^\x00]+?)<\/script>/i;
			arr1 = p1.exec(arr[0]);
			appendscript('', arr1[2], arr1[1].indexOf('reload=') != -1);
		}
	}
	return s;
}

function appendscript(src, text, reload, charset) {
	var id = hash(src + text);
	if(!reload && in_array(id, evalscripts)) return;
	if(reload && document.getElementById(id)) {
		document.getElementById(id).parentNode.removeChild($(id));
	}

	evalscripts.push(id);
	var scriptNode = document.createElement("script");
	scriptNode.type = "text/javascript";
	scriptNode.id = id;
	scriptNode.charset = charset ? charset : (is_moz ? document.characterSet : document.charset);
	try {
		if(src) {
			scriptNode.src = src;
			scriptNode.onloadDone = false;
			scriptNode.onload = function () {
				scriptNode.onloadDone = true;
				JSLOADED[src] = 1;
			};
			scriptNode.onreadystatechange = function () {
				if((scriptNode.readyState == 'loaded' || scriptNode.readyState == 'complete') && !scriptNode.onloadDone) {
					scriptNode.onloadDone = true;
					JSLOADED[src] = 1;
				}
			};
		} else if(text){
			scriptNode.text = text;
		}
		document.getElementsByTagName('head')[0].appendChild(scriptNode);
	} catch(e) {}
}

function hash(string, length) {
	var length = length ? length : 32;
	var start = 0;
	var i = 0;
	var result = '';
	filllen = length - string.length % length;
	for(i = 0; i < filllen; i++){
		string += "0";
	}
	while(start < string.length) {
		result = stringxor(result, string.substr(start, length));
		start += length;
	}
	return result;
}

function stringxor(s1, s2) {
	var s = '';
	var hash = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	var max = Math.max(s1.length, s2.length);
	for(var i=0; i<max; i++) {
		var k = s1.charCodeAt(i) ^ s2.charCodeAt(i);
		s += hash.charAt(k % 52);
	}
	return s;
}

function checkAll(e,itemName)
{
	var aa=document.getElementsByName(itemName);
	for(var i=0;i<aa.length;i++) {
		aa[i].checked=e.checked;
	}
}

function checkItem(e,allName)
{var all=document.getElementsByName(allName)[0];
	if(!e.checked) {
		all.checked=false;
	} else {
		var aa=document.getElementsByName(e.name);
		for(var i=0;i<aa.length;i++) {
			if(!aa[i].checked)
				return;
		}
		all.checked=true;
	}
}

function addEvents(eventHandler)
{
	var tags=document.getElementsByTagName('input');
	for(var i=0;i<tags.length;i++){
		if(tags[i].getAttribute('url')=='true') {
			if(tags[i].addEventListener) {
				tags[i].addEventListener('keyup',eventHandler,true);
			} else {
				tags[i].attachEvent('onkeyup',eventHandler);
			}
		}
	}
}

function addInput(e)
{
	var obj=e.target?e.target:e.srcElement;
	var tags=document.getElementsByTagName('input');
	for(var i=0;i<tags.length;i++) {
		if(tags[i].getAttribute('url')=='true'&&tags[i]!=obj) {
			tags[i].value=obj.value;
		}
	}
}

window.onload=function(){
	addEvents(addInput);
};

function drop_mouseover(pos)
{
	try{
		window.clearTimeout(timer);
	}catch(e){}
}

function drop_mouseout(pos)
{
	var posSel=document.getElementById(pos+"Sel").style.display;
	if(posSel=="block"){
		timer=setTimeout("drop_hide('"+pos+"')",1000);
	}
}

function drop_hide(pos){
	document.getElementById(pos+"Sel").style.display="none";
};

function search_show(pos,searchType,href)
{
	document.getElementById(pos+"SearchType").value=searchType;
	document.getElementById(pos+"Sel").style.display="none";
	document.getElementById(pos+"Slected").innerHTML=href.innerHTML;
	document.getElementById(pos+'q').focus();
	try{
		window.clearTimeout(timer);
	}catch(e){}
	return false;
}

function pmTopic(i,eid,act)
{
	var i = 'undefined' == typeof(i) ? 0 : i;
	var eid = 'undefined' == typeof(eid) ? 'Pmreply_area_'+i : eid;
	var act = 'undefined' == typeof(act) ? '' : act;
	var handle_key = eid;
	var p = {
		url:"ajax.php?mod=pm&code=view_comment",
		post:{pmid:i,cod:act}
	};
	
	// �޸�˽�Ŷ�ȡ״̬
	$("#pm_type_img_"+i).attr("src","./static/image/read.gif");
	$("#pm_type_txt_"+i).removeClass('pm_type_txt');
	
	showDialog(handle_key, 'ajax', '��������', p, 430);
	/*
	 * if('' == eidVal){ var
	 * myAjax=$.post("ajax.php?mod=pm&code=view_comment",{pmid:i,cod:act},function(d){if(''!=d){$("#"+eid).html(d);}}); }
	 * else { $("#"+eid).html(''); }
	 */
}

// �ղ�
function favoriteTopic(i,act)
{
	var i = 'undefined'==typeof(i) ? 0 : i;
	var act = 'undefined' == typeof(act) ? '' : act; 
	var eid = 'favorite_'+i;
	var myAjax = $.post("ajax.php?mod=topic&code=favor",
						{tid:i,act:act},
						function(d){
							if(''!=d){
								$("#"+eid).html(d);
							}
						}
				);
}

// ���������֪�����������
function setMenuPosition(showid,offset)
{
	var showobj=$jishigou_Obj(showid);
	var menuobj=$jishigou_Obj(showid+'_menu');
	if(isUndefined(offset)) {
		offset=0;
	}
	if(showobj){
		showobj.pos=fetchOffset(showobj);
		showobj.X=showobj.pos['left'];
		showobj.Y=showobj.pos['top'];
		showobj.w=showobj.offsetWidth;
		showobj.h=showobj.offsetHeight;
		menuobj.w=menuobj.offsetWidth;
		menuobj.h=menuobj.offsetHeight;
		if(offset!=-1){
			menuobj.style.left=(showobj.X+menuobj.w>document.body.clientWidth)&&(showobj.X+showobj.w-menuobj.w>=0)?showobj.X+showobj.w-menuobj.w+'px':showobj.X+'px';
			menuobj.style.top=offset==1?showobj.Y+'px':(offset==2||((showobj.Y+showobj.h+menuobj.h>document.documentElement.scrollTop+document.documentElement.clientHeight)&&(showobj.Y-menuobj.h>=0))?(showobj.Y-menuobj.h)+'px':showobj.Y+showobj.h+'px');
		} else if(offset==-1){ 
			menuobj.style.left=(document.body.clientWidth-menuobj.w)/2+'px';
			var divtop=document.documentElement.scrollTop+(document.documentElement.clientHeight-menuobj.h)/2;
			if(divtop>100) {
				divtop=divtop-100;
			}
			menuobj.style.top=divtop+'px';
		}
		if(menuobj.style.clip&&!is_opera){
			menuobj.style.clip='rect(auto, auto, auto, auto)';
		}
	}
}

function fetchOffset(obj)
{
	var left_offset=obj.offsetLeft;
	var top_offset=obj.offsetTop;
	while((obj=obj.offsetParent)!=null){
		left_offset+=obj.offsetLeft;
		top_offset+=obj.offsetTop;
	}
	return{'left':left_offset,'top':top_offset};
}

function $jishigou_Obj(id)
{
	return document.getElementById(id);
}

function isUndefined(variable)
{
	return typeof variable=='undefined'?true:false;
}

function strlen(str)
{
	var ie;
	return(ie&&str.indexOf('\n')!=-1)?str.replace(/\r?\n/g,'_').length:str.length;
}

function insertContent(target,text)
{
	var obj=$jishigou_Obj(target);
	selection=document.selection;
	if(!obj.hasfocus){ 
		obj.focus();
	}
	if(!isUndefined(obj.selectionStart)){
		var opn=obj.selectionStart+0;
		obj.value=obj.value.substr(0,obj.selectionStart)+text+obj.value.substr(obj.selectionEnd);
	}else if(selection&&selection.createRange){
		var sel=selection.createRange();
		sel.text=text;
		sel.moveStart('character',-strlen(text));
	}else{
		obj.value+=text;
	}
}

var note_step=0;
var note_oldtitle=document.title;
var note_timer;

function $jishigou(id){return document.getElementById(id);}

// ���ƴ���
function copyText(_sTxt)
{
	if(is_ie)
	{
		clipboardData.setData('Text',_sTxt);
		alert("��ַ��"+_sTxt+"��\n�Ѿ����Ƶ����ļ�������\n������ʹ��Ctrl+V��ݼ�ճ������Ҫ�ĵط�");
	} else{
		alert("����������֧�ֽű����ƻ���ܾ����������ȫȷ�ϣ��볢�԰�[Ctrl+C]�ֶ�����");
		document.getElementById('invite_url').select();
	}
}

function setCopy(_sTxt)
{
	if(is_ie){
		clipboardData.setData('Text',_sTxt);
		alert("��ַ��"+_sTxt+"��\n�Ѿ����Ƶ����ļ�������\n������ʹ��Ctrl+V��ݼ�ճ������Ҫ�ĵط�");
	}else{
		prompt("�븴����վ��ַ:",_sTxt);
	}
}

function trim(str)
{
	var re=/\s*(\S[^\0]*\S)\s*/;
	re.exec(str);
	return RegExp.$1;
}

function stopMusic(preID,playerID)
{
	var musicFlash=preID.toString()+'_'+playerID.toString();
	if($jishigou(musicFlash)){
		$jishigou(musicFlash).SetVariable('closePlayer',1);
	}
}

function showFlash(host,flashvar,obj,shareid,url,pageright)
{	
	var pageright = ('undefined'==typeof(pageright) ? 0 : pageright);

	var flashAddr={
		'youku.com':'http://player.youku.com/player.php/sid/FLASHVAR=/v.swf',
		'ku6.com':'http://player.ku6.com/refer/FLASHVAR/v.swf',
		'youtube.com':'http://www.youtube.com/v/FLASHVAR',
		'5show.com':'http://www.5show.com/swf/5show_player.swf?flv_id=FLASHVAR',
		'sina.com.cn':'http://vhead.blog.sina.com.cn/player/outer_player.swf?vid=FLASHVAR',
		'sohu.com':'http://v.blog.sohu.com/fo/v4/FLASHVAR',
		'tv.sohu.com':'http://share.vrs.sohu.com/FLASHVAR/v.swf',
		'mofile.com':'http://tv.mofile.com/cn/xplayer.swf?v=FLASHVAR',
		'tudou.com':'http://www.tudou.com/v/FLASHVAR',
		'v.aiao.cn':'http://tv.aiao.cn/PlayerS.swf?FlvID=FLASHVAR',
		'music':'FLASHVAR',
		'flash':'FLASHVAR'
	};
	
	var flash='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="480" height="400">'
+'<param name="movie" value="FLASHADDR" />'
+'<param name="quality" value="high" />'
+'<param name="bgcolor" value="#FFFFFF" />'
+'<embed width="480" height="400" menu="false" quality="high" src="FLASHADDR" type="application/x-shockwave-flash" />'
+'<span>flashAddr</span>'
+'</object>';

	var vH = 450;
	if( 'v.aiao.cn' == host ) {vH = 303;}
	var videoFlash='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="480" height="' + vH + '">'
+'<param value="transparent" name="wmode"/>'
+'<param value="FLASHADDR" name="movie" />'
+'<embed src="FLASHADDR" wmode="transparent" allowfullscreen="true" type="application/x-shockwave-flash" width="480" height="' + vH + '"></embed>'
+'</object>';
	if(pageright)
	{
		var videoFlash='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="250" height="200">'
+'<param value="transparent" name="wmode"/>'
+'<param value="FLASHADDR" name="movie" />'
+'<embed src="FLASHADDR" wmode="transparent" allowfullscreen="true" type="application/x-shockwave-flash" width="250" height="200"></embed>'
+'</object>';
	}

	var musicFlash='<object id="audioplayer_SHAREID" height="24" width="290" data="images/player.swf" type="application/x-shockwave-flash">'
+'<param value="images/player.swf" name="movie"/>'
+'<param value="autostart=yes&bg=0xCDDFF3&leftbg=0x357DCE&lefticon=0xF2F2F2&rightbg=0xF06A51&rightbghover=0xAF2910&righticon=0xF2F2F2&righticonhover=0xFFFFFF&text=0x357DCE&slider=0x357DCE&track=0xFFFFFF&border=0xFFFFFF&loader=0xAF2910&soundFile=FLASHADDR" name="FlashVars"/>'
+'<param value="high" name="quality"/>'
+'<param value="false" name="menu"/>'
+'<param value="#FFFFFF" name="bgcolor"/>'
+'</object>';

	var musicMedia='<object height="64" width="290" data="FLASHADDR" type="audio/x-ms-wma">'
+'<param value="FLASHADDR" name="src"/>'
+'<param value="1" name="autostart"/>'
+'<param value="true" name="controller"/>'
+'</object>';

	var flashHtml=videoFlash;
	var videoMp3=true;
	if(''==flashvar){
		alert('���ӵ�ַ���󣬲���Ϊ��');
		return false;
	}
	
	if('music'==host){
		var mp3Reg=new RegExp('.mp3$','ig');
		var flashReg=new RegExp('.swf$','ig');
		flashHtml=musicMedia;
		videoMp3=false;
		if(mp3Reg.test(flashvar)){
			videoMp3=true;
			flashHtml=musicFlash;
		}else if(flashReg.test(flashvar)){
			videoMp3=true;
			flashHtml=flash;
		}
	}
	flashvar=encodeURI(flashvar);
	
	if(flashAddr[host]){
		var flash=flashAddr[host].replace('FLASHVAR',flashvar);
		flashHtml=flashHtml.replace(/FLASHADDR/g,flash);
		flashHtml=flashHtml.replace(/SHAREID/g,shareid);
	}
	
	if(!obj){
		$jishigou('flash_div_'+shareid).innerHTML=flashHtml;
		return true;
	}
	
	if($jishigou('flash_div_'+shareid)){
		$jishigou('flash_hide_'+shareid).style.display='';
		$jishigou('flash_div_'+shareid).style.display='';
		obj.style.display='none';
		return true;
	}
	if(flashAddr[host]){
		var hideObj=document.createElement('div');
		hideObj.id='flash_hide_'+shareid;

		if(pageright)
		{
			;
		}
		else
		{
			var nodetxt=document.createTextNode("����");
			hideObj.appendChild(nodetxt);
		}		
		
		
		var flashObj=document.createElement('div');
		flashObj.id='flash_div_'+shareid;
		obj.parentNode.insertBefore(flashObj,obj);
		flashObj.innerHTML=flashHtml;
		obj.style.display='none';
		$jishigou('play_'+shareid).style.display='none';


		obj.parentNode.insertBefore(hideObj,obj);
		hideObj.style.cursor='pointer';
		hideObj.onclick=function(){
			if(true==videoMp3){
				stopMusic('audioplayer',shareid);
				flashObj.parentNode.removeChild(flashObj);
				hideObj.parentNode.removeChild(hideObj);
			}else{
				flashObj.style.display='none';
				hideObj.style.display='none';
			}
			obj.style.display='';
			$jishigou('play_'+shareid).style.display='block';
		};
	}
}

function setbuttonstatus(a,b,c){if(!!a && !!b){if(c){$('#'+a).attr({'disabled':true,'class':b+' disabled'});}else{$('#'+a).attr({'disabled':false,'class':b});}}}
// -------------------------------------------------------------------------------------

var lastPublishSubmitContent = '';
var videoid = 0;
var __IMAGE_IDS__ = {};
var __ATTACH_IDS__ = {};
var __LONGTEXT_ID__ = 0;
var __APPITEM__ = '';
var __APPITEM_ID__ = 0;
var __PUBLISH_SUCESS_CALLBACK__ = '';
var plugindata = {};//�����չ

// �Ƿ�����΢��ͬ����sina,qq��
var __ALLOW_WEIBO_SYN__ = true;
function publishSubmit(b_name,b_class,ci, i, r, topictype, roottid, is_huifu, item, item_id, xiami_id, touid, channel_must, channel_check) {
	// ��֤��¼״̬ �� check_PublishBox_uid ҳ���е������� ��ŵ�¼���uid
	var check_uid = $('#check_PublishBox_uid').val();
	var uid ='undefined'==typeof(check_uid)?'0':check_uid;
	var touid ='undefined'==typeof(touid)?'0':touid;
	var channel_check ='undefined'==typeof(channel_check) ? 0 : channel_check;
	var channel_must ='undefined'==typeof(channel_must) ? 0 : channel_must;
	if(uid < 1){
		ShowLoginDialog();
		return false;
	}
	//������ر����еĵ������߿�
	$(".sendInsert>.mleft>.menu>div>div").hide();//Modify By Ma
	$(".insertAttachDiv,.insertImgDiv,.topic_face").hide();

	var c = $('#'+ci).val();
	var c = ('undefined' == typeof(c) ? '' : c);
	var civaldefault = ('undefined' == typeof(__I_ALREADY_VALUE__) ? '' : __I_ALREADY_VALUE__);
	
	if( '' == c || '#�����Զ��廰��#' == c)
	{
		show_message('����������',1,'��ʾ','msgBox','msg_alert');
		return false;
	}
	if(c.length < 2)
	{
		show_message('��������2����',1,'��ʾ','msgBox','msg_alert');
		return false;
	}

	if($('#t_'+ci).length>0 && !(trim($('#t_'+ci).val())=='������������ֽ���Ϊ���⣨�������գ�' || trim($('#t_'+ci).val())=='')){
		c = trim($('#t_'+ci).val())+"\r\n"+c;
	}

	if(channel_must && item_id < 1)
	{
		show_message('������Ҫѡ��һ��Ƶ�����ܷ���',2,'��ʾ','msgBox','msg_alert');
		return false;
	}
	if(lastPublishSubmitContent==c)
	{
		 show_message('��Ҫ̰��Ŷ��ͬ�������ݷ�һ�ξ͹�����',1,'��ʾ','msgBox','msg_alert');
		 return false;
	}
	//������������ʾ��ʾ��
	$('#tochannel').hide();
	$('#send_follow').show();
	$('#t_pb').removeClass('select_shake');
	setbuttonstatus(b_name,b_class,1);
	
	// ֻ�п���ͬ����ʱ�������ͬ�� By ~ZZ~
	if (__ALLOW_WEIBO_SYN__) {
		var ss = $('#syn_to_sina').attr('data-setting');
		var ss = (('undefined' == typeof(ss) || 1 == ss) ? 0 : 1);
	
		var qs = $('#syn_to_qqwb').attr('data-setting');
		var qs = (('undefined' == typeof(qs) || 1 == qs) ? 0 : 1);

		var ks = $('#syn_to_kaixin').attr('data-setting');
		var ks = (('undefined' == typeof(ks) || 1 == ks) ? 0 : 1);
	
		var rs = $('#syn_to_renren').attr('data-setting');
		var rs = (('undefined' == typeof(rs) || 1 == rs) ? 0 : 1);
	} else {
		var ss = 0;
		var qs = 0;
		var ks = 0;
		var rs = 0;
	}

	// ת�� ���
	var topictypev = $('#'+topictype).val();
	var topictypev = ('undefined' == typeof(topictypev) ? '' : topictypev);

	//����΢����΢������
	var relateid = $('#f'+topictype).val();
	var relateid = ('undefined' == typeof(relateid) ? 0 : relateid);
	var featureid = $('#f'+topictype+'featureid').val();
	var featureid = ('undefined' == typeof(featureid) ? 0 : featureid);

	// ת�� ���
	var anonymous = $('#anonymous'+topictype).val();
	var anonymous = ('undefined' == typeof(anonymous) ? 0 : anonymous);

	var totidv = $('#'+i).val();
	var totidv = ('undefined' == typeof(totidv) ? '' : totidv);

	var is_huifuv = '';
	if ('undefined' != typeof(is_huifu) && is_huifu) {
		var is_huifuv = $('#'+is_huifu).val();
		var is_huifuv = ('undefined' == typeof(is_huifuv) ? '' : is_huifuv);
	}

	var r = ('undefined' == typeof(r) ? '' : r);
	var roottid = ('undefined' == typeof(roottid) ? 0 : roottid);
	if('design' == r || 'btn_wyfx' == r){topictype = 'first';}// ����ֱ�����̸����Ƽ������
	// ����ǰ����ʾ��Ϣ
	var loadingEid = '';
	var loadingTips = "<div><center><span class='loading'>�������ڷ����У����Ժ򡭡�</span></center></div>";
	if( 'vc'==r )
	{
		loadingEid = "topic_view_comment_msg_area_" + roottid;
	} 
	else if( -1!=r.indexOf('rl') ) 
	{
		loadingEid = "replyListMsgArea";
	}
	else if( 'myblog'==r || 'myhome'==r || 'tagview'==r || 'new'==r  || 'qun'==r || 'event'==r || 'reward'==r || 'fenlei' ==r || 'vote'==r || 'live'==r || 'talk'==r || 'ask'==r || 'answer'==r || 'channel'==r || 'index'==r || 'privately'==r || 'viewimg'==r || 'goodsinfo'==r)		// �����˶�΢Ⱥ��΢���Ĵ���
	{
		loadingEid = "listTopicMsgArea";
	}    
	if(loadingEid)
	{
		$("#" + loadingEid).html(loadingTips);
	}
	
	var appitem = __APPITEM__;
	// Ӧ��from
	var from = appitem;
	var appitem_id = __APPITEM_ID__;
	
	// ΢ȺӦ�����
	if ((('undefined' != typeof(item))) && (('undefined' != typeof(item_id)))) {
		appitem = item;
		appitem_id = item_id;
		from = appitem;
	}
	
	// ��ͼ
	var imageids = '';
	$.each(__IMAGE_IDS__, function(k, v) {
		if(v > 0) {
			imageids = imageids + ( imageids ? ',' + v : v );
		}
	});
	// �฽��
	var attachids = '';
	$.each(__ATTACH_IDS__, function(k, v){
		if(v > 0)
		{
			attachids = attachids + ( attachids ? ',' + v : v );
		}
	});
	
	var publish_success = 0;
	var longtextid = __LONGTEXT_ID__;
	//��������΢��Ƶ���Զ�ʶ��
	var verify = channel_check;
	// ��֤��
	var YinXiangMa_challenge = $("#YinXiangMa_challenge").val();
	var YXM_level = $("#YXM_level").val();
	var YXM_input_result = $("#YXM_input_result").val();
	//�н�ת��
	var is_reward = ('undefined' == typeof(__IS_REWARD__) ? 0 : __IS_REWARD__);
	//�����ύ
	var myAjax = $.post(
		"ajax.php?mod=topic&code=do_add&act=reply",
		{
			totid:totidv,
			syn_to_sina:ss,
			syn_to_qqwb:qs,
			syn_to_kaixin:ks,
			syn_to_renren:rs,
			imageid:imageids,
			attachid:attachids,
			videoid:videoid,
			longtextid:longtextid,
			content:c,
			topictype:topictypev,
			r:r,
			roottid:roottid,
			is_huifu:is_huifuv,
			item:appitem,
			item_id:appitem_id,
			from:from,
			xiami_id:xiami_id,
			touid:touid,
			relateid:relateid,
			featureid:featureid,
			verify:verify,
			anonymous:anonymous,
            is_reward:is_reward,
			YinXiangMa_challenge:YinXiangMa_challenge,
			YXM_level:YXM_level,
			YXM_input_result:YXM_input_result,
			plugindata:plugindata
		},
		function (d) {
			__PUBLISH_SUCESS_CALLBACK__ && __PUBLISH_SUCESS_CALLBACK__();

			$('#xiami_id').val('');
			if(verify == 1){
				if(loadingEid) {$("#" + loadingEid).html('');}
				setbuttonstatus(b_name,b_class,0);
				if(''==d || 'vc' == r){
					publish_success = 1;
					show_message_2("�����ɹ����ȴ�����Ա���");
				}else{
					show_message_2(d);
				}
			}else if( ''!=d && ''==r ) {
				if(loadingEid) {$("#" + loadingEid).html('');}
				
				$('#'+ci).val(c);
				show_message_2(d);
				$('#'+ci).focus();
				setbuttonstatus(b_name,b_class,0);
				return false;
				
			}else if('vc'==r) {
				if(relateid>0){
					location.reload();
				}else{
					$("#topic_view_comment_area_"+roottid).html(d);	
					if( -1 == d.indexOf('<success></success>')) {
						if(loadingEid) {$("#" + loadingEid).html('');}
						$('#'+ci).val(c);
						$('#'+ci).focus();
						setbuttonstatus(b_name,b_class,0);
						return false;
					} else {
						publish_success = 1;
					}
				}
			} else if(-1!=r.indexOf('rl')) {
				if(relateid > 0){
					location.reload();//ˢ��������ϸҳ
				}else{
					$("#replyListArea").html(d);				
					if( -1 == d.indexOf('<success></success>')) {
						if(loadingEid) {$("#" + loadingEid).html('');}					
						$('#'+ci).val(c);
						$('#'+ci).focus();
						setbuttonstatus(b_name,b_class,0);
						return false;
					} else {
						publish_success = 1;
					}
				}
			} else if(-1!=r.indexOf('tohome')) {
				window.location.href= thisSiteURL + 'index.php?mod=topic&code=myhome';
			} else {
				if(''!=d) {
					if(d.indexOf("�����ɹ�") > 0){
						if(loadingEid) {$("#" + loadingEid).html('');} 
						$('#'+ci).val('');
						if(__ALERT__){
							show_message(d);
						}
						setbuttonstatus(b_name,b_class,0);
						return false;
					}
					if(loadingEid) {$("#" + loadingEid).html('');} 
					
					$('#'+ci).val(c);
					show_message(d);
					$('#'+ci).focus();
					setbuttonstatus(b_name,b_class,0);
					return false;
				} else {
					publish_success = 1;
					// ���ⷢ���ɹ������ͼƬ����������Ƶ�����ֵ�IDֵ
					videoid = 0;
					if( 'myblog'==r || 'myhome'==r || 'topicnew'==r || 'tagview'==r || 'new'==r || 'qun'==r || 'event'==r || 'fenlei'==r  || 'vote'==r || 'live'==r || 'talk'==r || 'ask'==r || 'answer'==r || 'reward'==r || 'channel'==r || 'index'==r || 'privately'==r || 'viewimg'==r || 'goodsinfo'==r) {                        
						listAreaPrependTopic(r);
						if('answer'==r){$("#answer_" + totidv).remove();}
					} else if( 'mycomment'==r ) {
						window.location.href= thisSiteURL + 'index.php?mod=topic&code=myhome';
					} else {
						publishSuccess();						
					}
				}
			}
			
			if( publish_success && c != lastPublishSubmitContent ) {
				lastPublishSubmitContent = c;
			}
			setbuttonstatus(b_name,b_class,0);
		}
	);	
	
	
	// select_qmd('images/qmd2.jpg');
	// show_message('��ʾ��Ϣ����','��ʾ�������ʧ','��ʾ����','��ʽ--Ĭ��');
	// show_message('�����ɹ�',1);
	
	if('' != imageids)
	{
		__IMAGE_IDS__ = {};
		$('.tempimglist').empty();
		$('.insertImgDiv').css('display', 'block');		
		// ���ͼ�������������
		$('.viewImgDiv').empty();
		$('.viewImgDiv').css('display', 'none');
	}
	if('' != attachids)
	{
		__ATTACH_IDS__ = {};
		$('.insertImgDiv').css('display', 'block');		
		// ���ͼ�������������
		$('.viewImgDiv').empty();
		$('.viewImgDiv').css('display', 'none');
	}
	
	if(longtextid > 0)
	{
		__LONGTEXT_ID__ = 0;
	}
	
	if('' != videoid)
	{	
		videoid = 0;		
		$('#add_video').css('display', 'block');
		$('#upload_video_list').css('display', 'none');
		$('#upload_ajax_video').css('display', 'none');
	}
	$('.publish_menu_exetra_show').show();$('.publish_menu_exetra_hide').hide();$('.publish_menu_exetra_empty').empty();$('.publish_menu_input_empty').val('');//��������չ����
	closeDialog("hk_main_pb_dialog");$('.publish_menu_input_empty').removeAttr("checked");$("input[name='idas[]']:checked").removeAttr("checked");
	closeDialog("item_main_pb_dialog");//��ȷ�ύ��ش�������ʱ���ش���ע����topic_publish_ajax.html����Զ��ش����������⣬�뼰ʱ����
	closeDialog("reply_menu_"+roottid);//��������ʱ�ش�
	if(ci.indexOf("reply_content")==0){$('#'+ci).height(24);$('#'+ci).val('');}else{$('#'+ci).height(60);$('#'+ci).val(civaldefault);if($('#t_'+ci).length>0){$('#t_'+ci).val('������������ֽ���Ϊ���⣨�������գ�')}}//���ݷ����󣬻ָ������ĸ߶�Ϊ��ʻ״̬	
	return true;
}

// ������ʾ
function publishTips()
{
	 $("#listTopicMsgArea").html("<div><center><span class='loading'>�������ڼ����У����Ժ򡭡�</span></center></div>");
	
}

// ��ȡ��ǰ������΢��
function listAreaPrependTopic(r)
{   
	var r = ('undefined' == typeof(r) ? '' : r);
	publishTips();
	var myAjax = $.post
	(
		"ajax.php?mod=topic",
		{
			code:'mylastpublish',
			ref_mod:thisMod,
			ref_code:thisCode,
			r:r
		},
		function (d) 
		{
			$("#listTopicMsgArea").html('');
			// document.write(d);
			$('#listTopicArea').prepend(d);
			// $('#listTopicArea').html('debug');
			
			if ($('#empty_list_tips').length > 0) {
				$('#empty_list_tips').hide();
			}
		}
	);    
}

// �����ɹ��Ĵ���
function publishSuccess()
{
	var myAjax = $.get(
		"ajax.php?mod=topic",
		{
			code:'publishsuccess'
		},
		function (d) {
			$('#show_message_area').html(d);
		}
	);  
}

function deleteTopic(i,eid,view)
{
	var i = 'undefined' == typeof(i) ? 0 : i;
	var view = 'undefined' == typeof(view) ? '' : view;

	options = {
		'onClickYes':function(){
			var myAjax = $.post (
				"ajax.php?mod=topic&code=delete",
				{tid:i},
				function (d){
					$("#"+eid).remove();
					$("#ajax_output_area").html(d);
					if('' != view) {
						window.location.href=thisSiteURL+"index.php?mod=topic&code=myhome";
					}
				}
			);
		}
	};
	
	MessageBox('confirm', "ȷ��ɾ����", '��ʾ', options);
}

function deleteVerify(i,eid,view)
{
	var i = 'undefined' == typeof(i) ? 0 : i;
	var view = 'undefined' == typeof(view) ? '' : view;

	options = {
		'onClickYes':function(){
			var myAjax = $.post (
				"ajax.php?mod=topic&code=delverify",
				{tid:i},
				function (d){
					$("#"+eid).remove();
					$("#ajax_output_area").html(d);
					if('' != view) {
						window.location.href=thisSiteURL+"index.php?mod=topic&code=myhome";
					}
				}
			);
		}
	};
	
	MessageBox('confirm', "ȷ��ɾ����", '��ʾ', options);
}

// ��ע �� ȡ����ע
function follow(fid,eid,events,follow_button,refresh)
{
    if ('undefined' == typeof(refresh)) {
        var refresh = 0;
    }
	var events = ('undefined' == typeof(events) ? '' : events);
	
	// follow_button = ��ע��ȡ���û���ť��ͼ��1 ��ͼ��2��
	var follow_button = ('undefined' == typeof(follow_button) ? '' : follow_button);
	// alert(follow_button);return false;
	
	//$('.'+eid).html('');
	var myAjax=$.post(
		"ajax.php?mod=follow&code=add",
		{
			uid:fid,
			follow_button:follow_button
		},
		function(d)
		{
			if(''!=d)
			{
				if('channel' == follow_button){
					$('.'+eid).html(d);var fnum=parseInt($('.follow_num_'+fid).html());
					if('add' == events){$('.follow_num_'+fid).html(fnum+1);}else{$('.follow_num_'+fid).html(fnum-1);}
				}else{
					var s= d.split('<success></success>');
					$('.'+eid).html(s[0]);
					Cache.save(s[1],null);
					if( -1 != d.indexOf('<success></success>'))
					{
						if('add' == events)
						{
							// ����ѡ������
							parent.document.getElementById('button_'+fid).onclick();
                            //����Ǹ���Ȥ���˵Ļ���ˢ��һ��
                            if(refresh){
                                refreshOne(fid);
                            }
						}
						else
						{
							$("#user_grouplist_"+fid).remove();
						}
					}
				}
			}else{
				show_message('�����ڵ��û��鲻���Թ�ע��Ƶ��',1,'��ʾ','msgBox','msg_alert');
			}
		}
	 );
}

function refreshOne(fid){
    if('undefined' == typeof(fid)){
        return false;
    }
    $.get(
        'ajax.php?mod=user&code=refreshOne',
        function (d) {
            $("#follow_user_"+fid).remove();
           if(d){
               $("#interestUid_ul").append(d); 
            }
        }
    );
}

// ���ƴ���
function talkvisit(_sTxt)
{
	if(is_ie)
	{
		clipboardData.setData('Text',_sTxt);
		MessageBox('notice', "������ͨ��MSN��QQ��E-mail�������ѣ�<br><textarea style='width:200px;height:50px;overflow:hidden;'>"+_sTxt+"</textarea><br>", '�������ӣ�������Ѳμӷ�̸');
	} else{
		MessageBox('notice',"����������֧�ִ˲�����", '��ʾ');
	}
}

// �ٱ�
function ReportSub(tid,report_content,report_reason,eid)
{
	var totid = $('#'+tid).val();
	var content = $('#'+report_content).val();
	var reasons = $('#'+report_reason).val();

	if(trim(content) == ''){
		show_message("��˵���ٱ����ɡ�",1);
		return false;
	}
	if('0'==reasons) {
		show_message("��ѡ��ٱ�����");
		return false;
	}

	var myAjax=$.post(
	"ajax.php?mod=report&code=topic",
	{
		totid:totid,
		report_content:content,
		report_reason:reasons
	},
		function (d) {
			closeDialog("hk_report_dialog");
			show_message(d,1);
		}
 );

}


// �༭΢��
function modifyTopic(i,eid,types,attach)
{
	var i = 'undefined' == typeof(i) ? 0 : i;
	var eid = 'undefined' == typeof(eid) ? 'modify_topic_list_'+i : eid;
	var attach = 'undefined' == typeof(attach) ? 0 : attach;
	var handle_key = eid;
	var ajax_url = "ajax.php?mod=topic&code=modifytopic";
	var post = {
		tid:i,
		types:types,
		handle_key:handle_key,
		attach:attach
	};
	
	showDialog(handle_key, 'ajax', "�༭", {"url":ajax_url, "post":post}, 540);
	/*
	 * var eidVal=$("#"+eid).html(); if(''==eidVal){ var myAjax=$.post(
	 * "ajax.php?mod=topic&code=modifytopic", { tid:i, types:types },
	 * function(d) { if(''!=d){ $("#"+eid).html(d); } }); } else{
	 * $("#"+eid).html(''); }
	 */
}

// �޸�΢���ɹ���Ĳ���
function modifyTopicSuccess(tid, type)
{
	if (isUndefined(type)) {
		var type = '';
	}
	
	var refmod = thisMod;
	var refcode = thisCode;
	if (type == 'reply_list_ajax') {
		refcode = 'reply_list_ajax';
	} else {
		refmod = thisMod;
		refcode = thisCode;
	}
	
	var myAjax=$.post(
		"ajax.php?mod=topic&code=updatecurrent",
		{
			tid:tid,
			refmod:refmod,
			refcode:refcode
		},
		function(r) {
			if (type == 'reply_list_ajax') {
				$('#view_comment_'+tid).html(r);
			} else {
				$('#topic_list_'+tid).html(r);
			}
		}
	);
}

function do_modifyTopic(i, content, types, handle_key)
{
	// ��ͼ
	//var imageids = $('#' + imageids).val();
	var imageids = ''
	$.each(__IMAGE_IDS__, function(k, v){
		if(v > 0)
		{
			imageids = imageids + ( imageids ? ',' + v : v );
		}
	});
	// �฽��
	//var attachids = $('#' + attachids).val();
	var attachids = '';
	$.each(__ATTACH_IDS__, function(k, v){
		if(v > 0)
		{
			attachids = attachids + ( attachids ? ',' + v : v );
		}
	});
	
	var i='undefined'==typeof(i)?0:i;

	var content = $('#'+content).val();
	var content = 'undefined' == typeof(content) ? '' : content;
	var itemid = $('#item_id').val();
	var itemid = 'undefined' == typeof(itemid) ? 0 : itemid;
	var featureid = $('#featureid').val();
	var featureid = 'undefined' == typeof(featureid) ? 0 : featureid;
	
	var myAjax=$.post(
	"ajax.php?mod=topic&code=do_modifytopic",
	{
		tid:i,
		imageid:imageids,
		attachid:attachids,
		itemid:itemid,
		featureid:featureid,
		content:content,
		types:types
	},
	function (d) 
	{
		if(''==d){
		closeDialog(handle_key);
		
		if('' != imageids) {
			__IMAGE_IDS__ = {};
		}
		if('' != attachids) {
			__ATTACH_IDS__ = {};
		}

		if('topic_list' == types || 'reply_list_ajax' == types)
		{
			modifyTopicSuccess(i, types);
			closeDialog('modify_topic_list_'+i);
		}
		else if('rloadtrue' == types)
		{
			location.reload();//ˢ��������ϸҳ
		}
		else
		{
			replyList();
		}

		show_message('�༭�ɹ�',1);
		// parent.document.getElementById("modify_topic_"+tid).style.display="none";
		}else{
			show_message(d,1,'��ʾ','msgBox','msg_alert');
		}
	}
 );

}

// ������λ
function _cumulpos(a)
{
	var b=0,c=0,a=0;
	do{
			b+=a.offsetTop||0;
			c+=a.offsetLeft||0;
			a=a.offsetParent;
	}while(a);
	return [c,b];
}

// ��ӷ���
function GroupSubmit(ci,i,act,touid) {

	var c = $('#'+ci).val();
	var c = 'undefined' == typeof(c) ? '' : c;

	if(''==c) {
		show_message("�������������");
		return false;
	}

	var i = 'undefined' == typeof(i) ? 0 : i;
	var r = 'undefined' == typeof(r) ? '' : r;
	var act = 'undefined' == typeof(act) ? '' : act;
	var touid = 'undefined' == typeof(touid) ? 0 : touid;

	// alert(i); return false;
	var myAjax = $.post(
		"ajax.php?mod=topic&code=do_group",
		{
			group_name:c,
			gid:i,
			act:act,
			touid:touid
		},
		function (d) {
			if( ''!=d) {
				  if('modify' != act) {
						if ( act == 'menu_add') {
							// add_group_menu_27
							$("#add_group_menu_"+touid).html( $("#add_group_menu_"+touid).html()+d);
						} else {
							$("#show_message_area").html($("#show_message_area").html()+d);
							$("#add_group_fllow").html( $("#add_group_fllow").html()+d);
							$("#add_group_view").html( $("#add_group_view").html()+d);
							$("#add_group_menu_"+touid).html( $("#add_group_menu_"+touid).html()+d);
						}
					} else{
						$("#up_grouplist_"+i).html(d);
						$("#up_grouplist_view_"+i).html(d);
						parent.document.getElementById('modify_group_'+i).value=c;
					}
			}
		}
	);

$('#'+ci).val('');

	return true;
}

// ɾ������
function del_group(group_id,touid)
{
	var group_id = 'undefined' == typeof(group_id) ? 0 : group_id;
	var myAjax = $.post(
		"ajax.php?mod=topic&code=del_group",
		{
			group_id:group_id
		},

		function (d) {
			if(''!=d) {
				$("#del_group_ajax_"+group_id).remove();
				$("#del_group_follow_top_"+group_id).remove();
			}
		}
	);
}


// ���鵯����
function get_group_choose(userid){
	
	
	var handle_key = "global_select_"+userid;
	var title = "��������...";
	var ajax_url = "ajax.php?mod=topic&code=group_menu&to_user="+userid;
	showDialog(handle_key, 'ajax', title, {"url":ajax_url});
/*
 * var eidVal = $("#"+"global_select_"+userid).html();
 * 
 * if(''==eidVal){ var myAjax=$.post( "ajax.php?mod=topic&code=group_menu", {
 * to_user:userid }, function(d) { if(''!=d) {
 * document.getElementById("global_select_"+userid).style.display="block";
 * $("#"+"global_select_"+userid).html(d); } }); } else{
 * $("#"+"global_select_"+userid).html(''); }
 */
}

function groupState(gid,touid,eid) {
	
	var myAjax = $.post(
		"ajax.php?mod=topic&code=group_fields",
		{
			gid:gid,
			touid:touid
		},
		function (d) {
			if(''!=d) {
				$('#'+eid).html(d);
			}
			/*
			 * if(eid.checked){ eid.checked=false; //show_message('����ȡ���ɹ�',1);
			 * }else{ eid.checked=true; //show_message('�������óɹ�',1); }
			
			var myAjax = $.post(
					"ajax.php?mod=topic&code=group_list",
					{
						touid:touid
					},
					function (d) {
						$('#'+"group_list2_"+touid).html(d);
						parent.document.getElementById('group_list2_'+touid).style.display='block';

					}
				);
			 */
		}
	);
}

// ��ӱ�ע �� ������
function get_remark(uid)
{
   // var eidVal=$("#"+"get_remark_"+uid).html();
   var handle_key = "get_remark_"+uid;
   var ajax_url = "ajax.php?mod=remark&code=buddy_remark&uid="+uid;
   showDialog(handle_key, 'ajax', '���ñ�ע��', {"url":ajax_url}, 300);
   /*
	 * if(''==eidVal){ //���ñ�ע��; var myAjax=$.post(
	 * "ajax.php?mod=remark&code=buddy_remark", { uid:uid }, function(d) { if(''!=d) {
	 * document.getElementById("get_remark_"+uid).style.display="block";
	 * $("#"+"get_remark_"+uid).html(d); } }); } else{
	 * $("#"+"get_remark_"+uid).html(''); }
	 */
}



// ��ӱ�ע
function publishSubmit_remark(ci,buddyid)
{
	var c = $('#'+ci).val();
	var c = 'undefined' == typeof(c) ? '' : c;
	
	var buddyid = 'undefined' == typeof(buddyid) ? 0 : buddyid;

	var myAjax = $.post
	(
		"ajax.php?mod=remark&code=add_buddy_remark",
		{
			remark:c,
			buddyid:buddyid
		},
		function (d) 
		{	
			if(d) 
			{	
				// ����ҳ���� ����Ĵ�����ʾ��Ϣ
				show_message(d,2);return false;
				$('#'+"remarklist_"+buddyid).html(d);     
			}
			else
			{
				if(c)
				{
					$('#'+"remarklist_"+buddyid).html('(' + c + ')');
				}
				else
				{
					$('#'+"remarklist_"+buddyid).html('');
				}
				
				show_message('��ע���óɹ�',2);
			}
			
			var handle_key = "get_remark_"+buddyid;
			closeDialog(handle_key);
   
		}
	);
	
	return true;
}

// ��ӹ�ע����
function favoriteTag(i,act)
{
	var i='undefined'==typeof(i) ? '' : i;
	// alert(act); return false;
	if(act == 'input_add'){
	 var i = $('#'+i).val();
	}
	
	var act='undefined'==typeof(act)?'':act;
	
	var eid='favorite_tag_id';

	var myAjax=$.post
	(
			"ajax.php?mod=topic&code=favor_tag",
			{
				tag:i,
				act:act
			},
			function(d)
			{
				if(''!=d)
				{	// alert(d);
					if(act != 'input_add')
					{
						$("#"+eid).html(d);
					}
					else if('delete' != act)
					{
						if(-1 != d.indexOf('</script>')){
							show_message(d);return false;
						}
					    $("#add_ajax_favorite_tags").html(d);
					    parent.document.getElementById('tag_name').value="";
					    show_message('�����ע�ɹ�');return false;
					}
				}
				
				if('delete' == act){
					 // alert(i);
					 $("#favorite_"+i).remove();
				}
				$("#favorite_tag_id").fadeOut(1000);//ȡ����ע�����ذ�ť
				show_message(d);
			}
	);
}

// ת���ύjs
function Forward(content,forward_tid,tid,check,options)
{
	if (isUndefined(options)) {
		options = {};
	}
	
	var cid = content;
	
	var content = trim($('#'+cid).val());
	var check = $('#'+check).val();
	
	if(''==content || content.length < 2) {
		show_message("��������2���֡�");
		$('#'+cid).focus();
		return false;
	}
	var b_name='rcbtna_'+forward_tid;
	var b_class='u-btn';
	setbuttonstatus(b_name,b_class,1);
	
	// $("#topic_forward_content_area_" + tid).html('');
	$("#topic_forward_content_area_" + tid).append('<br />�������ڷ����У����Ժ򡭡�');
	
	// Ӧ��
	var appitem = '';
	var appitem_id = 0;
	if (options.appitem && options.appitem_id) {
		appitem = options.appitem;
		appitem_id = options.appitem_id;
	}
	
	var is_reward = 0;
	if(options.is_reward){
		is_reward = options.is_reward;
	}

	// ͼƬ
	var imageids = '';
	$.each(__IMAGE_IDS__, function(k, v){
		if(v > 0)
		{
			imageids = imageids + ( imageids ? ',' + v : v );
		}
	});
	// ����
	var attachids = '';
	$.each(__ATTACH_IDS__, function(k, v){
		if(v > 0)
		{
			attachids = attachids + ( attachids ? ',' + v : v );
		}
	});
	var YinXiangMa_challenge = $("#YinXiangMa_challenge").val();
	var YXM_level = $("#YXM_level").val();
	var YXM_input_result = $("#YXM_input_result").val();
	var verify = $('#verify').val();
	var myAjax=$.post
	(
		"ajax.php?mod=topic&code=forward",
		{
			forward_tid:forward_tid,
			tid:tid,
			content:content,
			topictype:check,
			item:appitem,
			item_id:appitem_id,
			imageid:imageids,
			attachid:attachids,
			is_reward:is_reward,
			YinXiangMa_challenge:YinXiangMa_challenge,
			YXM_level:YXM_level,
			YXM_input_result:YXM_input_result
		},
		function (d) 
		{
			if(d)
			{
				if( -1 != d.indexOf('<success></success>') )
				{
					if(verify == 1){
						show_message("�����ɹ����ȴ�����Ա���",2);
					}else{
						listAreaPrependTopic();
						show_message('ת���ɹ�',2); 
					}
					closeDialog("forward_menu_"+tid);
					setbuttonstatus(b_name,b_class,0);
					return true;
				}
				else if( -1 != d.indexOf('[ת���ɹ�]') ){
					if(__ALERT__){
						show_message(d,2);
					}
					closeDialog("forward_menu_"+tid);
					setbuttonstatus(b_name,b_class,0);
					return true;
				}
				else
				{
					show_message(d,1,'��ʾ','msgBox','msg_alert');
				}
			}	 
			else
			{
				show_message('ת��ʧ��',1,'��ʾ','msgBox','msg_alert');
			}
			
			$('#' + cid).val(content);
			$('#' + cid).focus();
			setbuttonstatus(b_name,b_class,0);
			return false;   
	   }
	);
	
	$('#' + cid).val('');
	

	if('' != imageids)
	{
		$('.insertImgDiv').css('display', 'block');
		
		// ��ոò������������
		$('.viewImgDiv').empty();
		$('.viewImgDiv').css('display', 'none');
	}
	
	return true;
}

// ���ⵯ����
function get_tag_choose(uid,tc_type,ajax){
	var uid = 'undefined' == typeof(uid) ? 0 : uid;
	var tc_type = 'undefined' == typeof(tc_type) ? '' : tc_type;
	var ajax = 'undefined' == typeof(ajax) ? '' : ajax;
	var _cache_id = tc_type + '_' + uid;
	
	if(undefined==Cache.get(_cache_id))
	{
		var _jsgcid = 'JSGCACHE_get_tag_choose_'+_cache_id;
		if(undefined!=Cache.get(_jsgcid))
		{
			return false;
		}
		Cache.save(_jsgcid,_jsgcid);

		var myAjax = $.post(
			"ajax.php?mod=topic&code=tag_menu",
			{
				uid:uid,
				type:tc_type
			},
			function (d) {
				if(''!=d) {
					Cache.save(_cache_id,d);
					document.getElementById(ajax+"tag_"+uid).style.display="block";
					$("#"+ajax+"tag_"+uid).html(Cache.get(_cache_id));
				}
			}
		);
	}
	else
	{
		document.getElementById(ajax+"tag_"+uid).style.display="block";
		$("#"+ajax+"tag_"+uid).html(Cache.get(_cache_id));
	}
}

// ����������
function replyTopic(i,eid,tReplys,not_allow_forward,allow_attach,allow_face,allow_pic,seccode,options)
{
	var i = ( 'undefined'==typeof(i) ? 0 : i );
	var tReplys = ( 'undefined'==typeof(tReplys) ? 0 : tReplys );
	var eid = ( 'undefined'==typeof(eid) ? 'reply_area_'+i : eid );
	var allow_attach = ( 'undefined'==typeof(allow_attach) ? 0 : allow_attach );
    var allow_face = ( 'undefined'==typeof(allow_face) ? 0 : allow_face );
    var allow_pic = ( 'undefined'==typeof(allow_pic) ? 0 : allow_pic );
	var seccode = ( 'undefined'==typeof(seccode) ? 0 : seccode);
	
	// ������item,item_id���� Modify by ~ZZ~ 2011-06-30
	if (isUndefined(options)) {
		options = {};
	}
	
	var eidVal=$("#"+eid).html();
	if (isUndefined(not_allow_forward)) {
		not_allow_forward = false;
	}

	if(''==eidVal)
	{
		// Modify by ~ZZ~ 2011-06-30
		var tcHTML = topicCommentHTML(i,tReplys,not_allow_forward,allow_attach,allow_face,allow_pic,seccode,options);		
		$("#"+eid).html(tcHTML);
		$("#reply_content_"+i).focus();
	}
	else
	{
		$("#"+eid).html('');
	}
}
// ���۵�����(Ŀǰ�����ٲ�����ʹ��)
function DreplyTopic(tid,replys,allow_attach,allow_pic,allow_face,seccode)
{   
	var check_uid = $('#check_PublishBox_uid').val();
	var uid ='undefined'==typeof(check_uid)?'0':check_uid;
	if(uid < 1){
		ShowLoginDialog();
		return false;
	}
	var tid = 'undefined' == typeof(tid) ? 0 : tid;
	var replys = 'undefined' == typeof(replys) ? 0 : replys;
	if(tid < 1){
		show_message("��Ǹ����"+__N_WEIBO__+"�Ѿ���ɾ�����޷����ۡ�",3);
		return false;
	}
	var allow_attach = ( 'undefined'==typeof(allow_attach) ? 0 : allow_attach );
    var allow_face = ( 'undefined'==typeof(allow_face) ? 0 : allow_face );
    var allow_pic = ( 'undefined'==typeof(allow_pic) ? 0 : allow_pic );
	var seccode = ( 'undefined'==typeof(seccode) ? 0 : seccode);
	var type_html = '';var allow_attachHTML = '';var allow_picHTML = '';var allow_faceHTML = '';var psubmitHTML='';var yxm_popHTML='';
	type_html = '<input name="topicReplyType_' + tid + '" type="checkbox" id="topicReplyType_' + tid + '" value="reply" onclick="select_checked(\'topicReplyType_' + tid + '\');"/> <label for="topicReplyType_' + tid + '" style="cursor:pointer;">ͬʱת��</label>';
	var atuserHTML = '<div class="comment_p_b2 comment_p_b22 sendInsertfocus"><div class="menu_hp"><b class="menu_hpb_c" id="reply_atuser_'+tid+'" onclick="showatuserw(\'reply_content_'+tid+'\',\'reply\',\''+tid+'\');return false;">����</b><div class="menu_hpb rf_at_user" id="atuser_reply_'+tid+'"><span class="arrow-up"></span><span class="arrow-up-in"></span><div class="menu_tb showusr"><div id="showatuser_reply_'+tid+'" class="showatuser"></div><sub class="menu_hpb_c1"></sub></div></div></div></div>';
	if(allow_attach){
		allow_attachHTML = 'attachUploadifyHTML(' + tid + ', "reply_content_' + tid + '", "reply_attach_uploadify_' + tid + '",0,"",0);';
	}
	if(allow_pic){
        allow_picHTML = 'imageUploadifyHTML(' + tid + ', "reply_content_' + tid + '", "reply_image_uploadify_' + tid + '"); ';
    }
	if(allow_face){
		allow_faceHTML = '<div class="menuf_bq"><b class="menu_bqb_c"><a href="javascript:viod(0);" onclick="topic_face(\'forward_' + tid + '\',\'reply_content_' + tid + '\');return false;">����</a></b><div class="forward_f" id="forward_' + tid + '"></div></div>';
	}
	var handle_key = "reply_menu_"+tid;
	if(seccode && YXM_POP_Title){
		psubmitHTML = '<input type="hidden" id="YXM_R_'+tid+'" onclick="publishSubmit(\'rcbtna_'+tid+'\',\'u-btn\',\'reply_content_' + tid + '\',\'replytid_' + tid + '\',\'vc\',\'topicReplyType_' + tid + '\',' + tid + ',\'is_huifu_' + tid + '\',\'\',\'\');"/><input id="rcbtna_' + tid + '" onclick="YXM_pubtopic(\'reply_content_' + tid + '\',\'_reply_' + tid + '\',\'topicReplyType_' + tid + '\',\'YXM_R_'+tid+'\');return false;" type="button" value="�� ��" class="u-btn" title="��Ctrl+Enterֱ�ӷ���" style="margin:0 0 0 5px"/>';
		yxm_popHTML = '<tr><td colspan="2"><span id="yxm_pub_button_reply_'+tid+'" onclick="YXM_popBox(this,\'reply,'+tid+'\',\''+YXM_POP_Title+'\');" style="margin-left:40px;height:1px;">&nbsp;</span></td></tr>';
	}else{
		psubmitHTML = '<input id="rcbtna_' + tid + '" onclick="publishSubmit(\'rcbtna_'+tid+'\',\'u-btn\',\'reply_content_' + tid + '\',\'replytid_' + tid + '\',\'vc\',\'topicReplyType_' + tid + '\',' + tid + ',\'is_huifu_' + tid + '\',\'\',\'\');" type="button" value="�� ��" title="��Ctrl+Enterֱ�ӷ���" class="u-btn" style="margin:0 0 0 5px"/>';
	}
	var fcHTML = '<div id="reply_list" class="dialog_inner" style="_overflow:hidden;"><div class="mWarp"><table><tr><td colspan="2"><div class="alt_3"> <div class="sendTitle" style="float:right;margin-right:0"><style>ul.txtNum li{ width:65px;}</style> <ul class="txtNum" style="color:#999;"> <li>����������</li> <li id="wordc"><span id="wordcNum_' + tid + '" style="color:#ff0000;">' + thisTopicLength + '</span></li> <li style="width:14px;">��</li> </ul> </div>����&nbsp;'+replys+'&nbsp;�����ۡ�<a href="index.php?mod=topic&code='+tid+'" target="_blank">�鿴��ϸ>></a></div> <div class="alt_3"> <textarea id="reply_content_' + tid + '" name="content" onkeyup="javascr' + 'ipt:checkWord(' + thisTopicLength + ',event,\'wordcNum_' + tid + '\')" class="textarea" style="width:490px;margin-bottom:5px;"></textarea></div></td> </tr> <tr> <td class="modify_tool_left">'+allow_faceHTML+'<div id="reply_image_uploadify_'  + tid + '" class="comment_p_b2 comment_p_b22"></div><div id="reply_attach_uploadify_'  + tid + '" class="comment_p_b2 comment_p_b22"></div>'+atuserHTML+'</td> <td class="modify_tool_right"><div class="rb_a1">'+type_html+psubmitHTML+'<input type="hidden" id="replytid_' + tid + '" name="replytid_' + tid + '" value="' + tid + '"/> <input type="hidden" id="is_huifu_' + tid + '" name="is_huifu_' + tid + '" value=""/></td></tr>'+yxm_popHTML+'</table></div></div><sc' + 'ript type="text/jav' + 'ascri' + 'pt"> $(document).ready(function(){'+ allow_picHTML + allow_attachHTML + '$(".menu_bqb_c").click(function(){$("#forward_' + tid + '").show();});$("#reply_atuser_'+tid+'").click(function(){$("#atuser_reply_'+tid+'").show();$(".forward_f2").hide();$(".forward_f").hide();$(".insertAttachDiv").hide();$(".modify_face").hide();$(".insertImgDiv").hide();});$(".menu_hpb_c1").click(function(){$("#atuser_reply_'+tid+'").hide();});$(".close_1").click(function(){$("#forward_' + tid + '").hide();}); initAiInput("forward_content_' + tid + '");}); $("#reply_content_' + tid + '").setCaret();$("#reply_content_' + tid + '").bind("keydown",function(event){ event = event || window.event; if(event.keyCode == 13 && event.ctrlKey){$("#rcbtna_' + tid + '").click();}});</scri' + 'pt>';
	var fcFrameHtml = '<div class="zfbox"><div class="zfTitle" id="zfTitle_'+tid+'"><ul class="zfti"><li id="zf_m1" class="zfhover">'+__N_WEIBO__+'����</li><sub class="menu_zf_c1" onclick="closeDialog(\''+handle_key+'\');"></sub></ul></div><div id="zfcon_zf_m_1" class="zfcon">'+fcHTML+'</div></div>';
	var h = showDialog(handle_key, 'local', '��'+__N_WEIBO__+'��������', {"html":fcFrameHtml, "noTitleBar":true}, 540);
	// �������϶���
	draggable(h.dom.wrapper, $('#zfTitle_'+tid));
}

// foxis 2011.08.25
function imageUploadifyHTML(tid, content_textarea_id, toeid, iuConfirm)
{
	var tid = ( 'undefined' == typeof(tid) ? 0 : tid );
	var content_textarea_id = ( 'undefined' == typeof(content_textarea_id) ? '' : content_textarea_id );
	var toeid = ( 'undefined' == typeof(toeid) ? '' : toeid );
	var iuConfirm = ( 'undefined' == typeof(iuConfirm) ? '' : iuConfirm );
	$('.forward_f2').hide();
	$('.forward_f').hide();
	$('.insertAttachDiv').hide();
	$('.modify_face').hide();
	$('.rf_at_user').hide();
	if(iuConfirm)
	{		
		if(toeid)
		{
			$('#' + toeid).html('<span class="loading" title="Loading..">Loading..</span>');
		}		
		var confirmHTML2 = '<div class="menuf_tq" onclick="imageUploadifyHTML(\'' + tid + '\', \'' + content_textarea_id + '\', \'' + toeid + '\', \'' + iuConfirm + '\');"><b class="menu_tqb_c">ͼƬ</b></div>';
		$.post
		(
			'ajax.php?mod=uploadify&code=html',
			{
				'tid' : tid,
				'new' : 1,
				'only_js' : 0,
				'content_textarea_id' : content_textarea_id
			},
			function (iuHTML) 
			{
				if( -1 != iuHTML.indexOf('<success></success>'))
				{
					if(toeid)
					{
						$('#' + toeid).html(confirmHTML2+iuHTML);
					}
					else
					{
						return iuHTML;
					}
				}
			}
		);
	}
	else
	{
		iuConfirm = 1;
		
		var confirmHTML = '<div class="menuf_tq" onclick="imageUploadifyHTML(\'' + tid + '\', \'' + content_textarea_id + '\', \'' + toeid + '\', \'' + iuConfirm + '\');"><b class="menu_tqb_c">ͼƬ</b></div>';
		
		if(toeid)
		{
			$('#' + toeid).html(confirmHTML);
		}
		else
		{
			return confirmHTML;
		}
	}
}
function attachUploadifyHTML(tid, topic_textarea_id, toeid, iuConfirm, item, itemid)
{
	var tid = ( 'undefined' == typeof(tid) ? 0 : tid );
	var topic_textarea_id = ( 'undefined' == typeof(topic_textarea_id) ? '' : topic_textarea_id );
	var toeid = ( 'undefined' == typeof(toeid) ? '' : toeid );
	var iuConfirm = ( 'undefined' == typeof(iuConfirm) ? '' : iuConfirm );
	var item = ( 'undefined' == typeof(item) ? '' : item );
	var itemid = ( 'undefined' == typeof(itemid) ? 0 : itemid );	
	$('.forward_f2').hide();
	$('.forward_f').hide();
	$('.insertImgDiv').hide();	
	$('.modify_face').hide();
	$('.rf_at_user').hide();
	if( -1 != toeid.indexOf('modify_')){
		var mustuid = 1;
	}else{
		var mustuid = 0;
	}

	if(iuConfirm)
	{
		if(toeid)
		{
			$('#' + toeid).html('<span class="loading" title="Loading..">Loading..</span>');
		}
		var confirmHTML3 = '<div class="menuf_fj menu_fj_reply_style" onclick="attachUploadifyHTML(\'' + tid + '\', \'' + topic_textarea_id + '\', \'' + toeid + '\', \'' + iuConfirm + '\', \'' + item + '\', \'' + itemid + '\');"><b class="menu_fjb_c">����</b></div>';
		$.post
		(
			'ajax.php?mod=uploadattach&code=html',
			{
				'tid' : tid,
				'new' : 1,
				'only_js' : 0,
				'topic_textarea_id' : topic_textarea_id,
				'item' : item,
				'itemid' : itemid,
				'topic_uid' : mustuid
			},
			function (iuHTML) 
			{
				if( -1 != iuHTML.indexOf('<success></success>'))
				{
					if(toeid)
					{
						$('#' + toeid).html(confirmHTML3+iuHTML);
					}
					else
					{
						return iuHTML;
					}
				}
			}
		);
	}
	else
	{
		iuConfirm = 1;		
		var confirmHTML = '<div class="menuf_fj menu_fj_reply_style s" onclick="attachUploadifyHTML(\'' + tid + '\', \'' + topic_textarea_id + '\', \'' + toeid + '\', \'' + iuConfirm + '\', \'' + item + '\', \'' + itemid + '\');"><b class="menu_fjb_c">����</b></div>';		
		if(toeid)
		{
			$('#' + toeid).html(confirmHTML);
		}
		else
		{
			return confirmHTML;
		}
	}
}
function downattach(aid)
{
	var check_uid = $('#check_PublishBox_uid').val();
	var uid ='undefined'==typeof(check_uid)?'0':check_uid;	
	if(uid < 1){
		ShowLoginDialog();
		return false;
	}
	var aid = ( 'undefined' == typeof(aid) ? 0 : aid );
	if (aid > 0)
	{
		var dnum = parseInt($('#attach_downnum_'+aid).html())+1;
		var durl = 'ajax.php?mod=uploadattach&code=down';
		var myAjax = $.post (
			durl,{aid:aid},
			function (d){
				if('' != d) {
					var s= d.split(',');var l = 'yes';var scstr = '';
					if(s[0] > 0){
						options = {'onClickYes':function(){if(s[2]==1){window.open(thisSiteURL + s[4])}else{window.location.href = thisSiteURL + s[4];}$('#attach_downnum_'+aid+',.attach_downnum_'+aid).html(dnum);}};
						if(s[2]==1){scstr += '�ⲿ��ַ��FTP�ռ��ļ����޷���֤���ݵİ�ȫ�ԡ�';}else if(s[2]==2){scstr += '���ݴ洢�ڰ����ƣ�������Ҫһ������ʱ�䣬�����ĵȴ���';}
						if(s[1] > 0){scstr += 'ȷ�����ؽ��۳�' + s[1] + '����';if(s[3]==1){scstr += '!';}else{scstr += '�����������������ߣ�';}}else if(s[1] == -1){scstr += '������ۻ������أ�������';}
						if(s[2]==0&&window.external&&window.external.twGetRunPath&&window.external.twGetRunPath().toLowerCase().indexOf("360se")>-1){
							MessageBox('notice','��Ǹ��ϵͳ��⵽����360�����<br>����������ܱ�֤���ݵ�������<br>�����������������������أ�','����');
						}else{
							if(scstr){
								MessageBox('confirm', scstr, '��ȷ��Ҫ���ظ��ļ���', options);
							}else{
								MessageBox('confirm', '��ȷ��Ҫ���ظ��ļ���','ϵͳ��ʾ', options);
							}
						}
					}else if(s[0] == 0){
						if(s[1]==1){
							MessageBox('notice', "���ص�ַ�����޷��������أ�", '��ʾ');
						}else{
							MessageBox('notice', "����Ȩ�޲������޷��������أ�", '��ʾ');
						}
					}else{
						MessageBox('notice', "���Ļ��ֲ������޷��������أ�", '��ʾ');
					}
				}
			}
		);
	}
	else
	{
		return false;
	}
}

function set_attach_score(i,id,obj)
{
	var id = ('undefined' == typeof(id) ? 0 : id);
	var score = ('undefined' == typeof(i) ? 0 : i);
	if(id > 0 && score.length > 0)
	{
		var myAjax = $.post('ajax.php?mod=uploadattach&code=score',{id:id,score:score},function(d){if(''!=d){obj.value=d;$('#attach_score_'+id).html(d);}});
	}
}

// Modify by ~ZZ~ 2011-06-30
function topicCommentHTML(tid,tReplys, not_allow_forward,allow_attach,allow_face,allow_pic,seccode,options)
{
	var type_html = '';
	var allow_attach = ( 'undefined'==typeof(allow_attach) ? 0 : allow_attach );
    var allow_face = ( 'undefined'==typeof(allow_face) ? 0 : allow_face );
    var allow_pic = ( 'undefined'==typeof(allow_pic) ? 0 : allow_pic );
	var seccode = ( 'undefined'==typeof(seccode) ? 0 : seccode);
	// ������item,item_id���� Modify by ~ZZ~ 2011-06-30
	if (isUndefined(options)) {
		options = {};
	}
	
	if (!isUndefined(not_allow_forward) && not_allow_forward) {
		type_html = '<input name="topicReplyType_' + tid + '" type="hidden" id="topicReplyType_' + tid + '" value="reply" onclick="select_checked(\'topicReplyType_' + tid + '\');"/> ';
	} else {
		type_html = '<input name="topicReplyType_' + tid + '" type="checkbox" id="topicReplyType_' + tid + '" value="reply" onclick="select_checked(\'topicReplyType_' + tid + '\');"/> <label for="topicReplyType_' + tid + '" style="cursor:pointer;">ת������˿</label>';
	}
	
	var appitem = '';
	var appitem_id = 0;
	if (options.appitem && options.appitem_id) {
		appitem = options.appitem;
		appitem_id = options.appitem_id;
	}
	var item = '';
	if (options.item) {
		item = options.item;
	}
	var relate = 0;
	if(options.relate){
		relate = options.relate;
	}
	var itemid = 0;
	if(options.itemid){
		itemid = options.itemid;
	}
	var featureid = 0;
	if(options.featureid){
		featureid = options.featureid;
	}
	var publishHtml = '';
	var relateHTML = '';
	var tcHTML = '';
	var allow_attachHTML = '';
    var allow_picHTML = '';
    var allow_faceHTML = '';
	var psubmitHTML = '';
	var yxm_popHTML = '';
	var atuserHTML = '<div class="comment_p_b2 comment_p_b22 sendInsertfocus"><div class="menu_hp"><b class="menu_hpb_c" id="reply_atuser_'+tid+'" onclick="showatuserw(\'reply_content_'+tid+'\',\'reply\',\''+tid+'\');return false;">����</b><div class="menu_hpb rf_at_user" id="atuser_reply_'+tid+'"><span class="arrow-up"></span><span class="arrow-up-in"></span><div class="menu_tb showusr"><div id="showatuser_reply_'+tid+'" class="showatuser"></div><sub class="menu_hpb_c1"></sub></div></div></div></div>';
	if(allow_attach){
		allow_attachHTML = 'attachUploadifyHTML(' + tid + ', "reply_content_' + tid + '", "reply_attach_uploadify_' + tid + '",0,"' + appitem + '",' + appitem_id + ');';
	}
    if(allow_face){
        allow_faceHTML = '<div class="menuf_bq"><b id="reply_ajax_menu_bqb_c_' + tid + '" class="reply_ajax_menu_bqb_c"><a href="javascript:viod(0);" onclick="topic_face(\'reply_face_' + tid + '\',\'reply_content_' + tid + '\');return false;">����</a></b> <div class="forward_f2" style="margin-top:0px;" id="reply_face_' + tid + '" style="border:1px solid #BFBFBF;display:none;"></div> </div>';
    }
	if(relate){
		relateHTML = '<div class="comment_p_s"><input type="checkbox" name="ftopicReplyType_'+tid+'" id="ftopicReplyType_'+tid+'" value="0" onclick="set_relate('+tid+',\'ftopicReplyType_'+tid+'\');"><label for="ftopicReplyType_'+tid+'">ͬʱ�Ѹ�������Ϊ���ۻ�𸴣�������ԭ΢��״̬Ϊ��</label><select name="ftopicReplyType_'+tid+'featureid" id="ftopicReplyType_'+tid+'featureid"></select></div>';
	}
    if(allow_pic){
        allow_picHTML = 'imageUploadifyHTML(' + tid + ', "reply_content_' + tid + '", "reply_image_uploadify_' + tid + '"); ';
    }
	if(seccode&&YXM_POP_Title){
		psubmitHTML = '<input type="hidden" id="YXM_R_'+tid+'" onclick="publishSubmit(\'rcbtn_'+tid+'\',\'u-btn\',\'reply_content_' + tid + '\',\'replytid_' + tid + '\',\'vc\',\'topicReplyType_' + tid + '\',' + tid + ',\'is_huifu_' + tid + '\',\'' + appitem + '\',\'' + appitem_id + '\');$(\'#wordCheckNum_' + tid + '\').html('+thisTopicLength+');"/><input id="rcbtn_' + tid + '" onclick="YXM_pubtopic(\'reply_content_' + tid + '\',\'_reply_' + tid +'\',\'topicReplyType_' + tid + '\',\'YXM_R_'+tid+'\');return false;" type="button" value="�� ��" class="u-btn" title="��Ctrl+Enterֱ�ӷ���"/>';
		yxm_popHTML = '<p id="yxm_pub_button_reply_'+tid+'" onclick="YXM_popBox(this,\'reply,'+tid+'\',\''+YXM_POP_Title+'\');" style="margin-left:100px;height:1px;">&nbsp;</p>';
	}else{
		psubmitHTML = '<input id="rcbtn_' + tid + '" onclick="publishSubmit(\'rcbtn_'+tid+'\',\'u-btn\',\'reply_content_' + tid + '\',\'replytid_' + tid + '\',\'vc\',\'topicReplyType_' + tid + '\',' + tid + ',\'is_huifu_' + tid + '\',\'' + appitem + '\',\'' + appitem_id + '\');$(\'#wordCheckNum_' + tid + '\').html('+thisTopicLength+');" type="button" class="u-btn" value="�� ��" title="��Ctrl+Enterֱ�ӷ���"/>';
	}
	if(item){
		publishHtml = '<scr' + 'ipt language="Javasc' + 'ript">var tReplys = ' + tReplys + ';if(tReplys > 0){topic_view_comment_list(' + tid + ',\'' + item + '\');}</scr' + 'ipt>';
		tcHTML = '<div class="relayTxt topicReply">  <div class="mid">'+publishHtml+'<div id="topic_view_comment_area_' + tid + '"></div></div></div>';
	}else{
		publishHtml = '<div class="comment_p_t"><textarea id="reply_content_' + tid + '" name="textarea" class="replybb" onkeyup="javas' + 'cript:checkWord(' + thisTopicLength + ',event,\'wordCheckNum_' + tid + '\')" ></textarea> <input type="hidden" id="replytid_' + tid + '" name="replytid_' + tid + '" value="' + tid + '"/> <input type="hidden" id="is_huifu_' + tid + '" name="is_huifu_' + tid + '" value=""/> '+psubmitHTML+' </div> <div class="comment_p_b"> <div class="comment_p_t2">'+allow_faceHTML+'<div id="reply_image_uploadify_'  + tid + '" class="comment_p_b2 comment_p_b22"></div><div id="reply_attach_uploadify_'  + tid + '" class="comment_p_b2 comment_p_b22"></div>' + atuserHTML + '</div> <div class="comment_p_t3"> '+type_html+'</div> </div>  <scr' + 'ipt language="Javasc' + 'ript">$(document).ready(function(){' + allow_picHTML + allow_attachHTML + ' $("#reply_ajax_menu_bqb_c_' + tid + '").click(function(){$("#reply_face_' + tid + '").show();});$("#reply_atuser_'+tid+'").click(function(){$("#atuser_reply_'+tid+'").show();$(".forward_f2").hide();$(".forward_f").hide();$(".insertAttachDiv").hide();$(".modify_face").hide();$(".insertImgDiv").hide();});$(".menu_hpb_c1").click(function(){$("#atuser_reply_'+tid+'").hide();}); $(".close_1").click(function(){$("#reply_face_' + tid + '").hide();});$("#reply_content_' + tid + '").setCaret();$("#reply_content_' + tid + '").bind("focus",function(){$(this).addClass("focus");});$("#reply_content_' + tid + '").bind("blur",function(){$(this).removeClass("focus");});$("#reply_content_' + tid + '").autoTextarea(); }); $("#reply_content_' + tid + '").bind("keydown",function(event){ event = event || window.event; if(event.keyCode == 13 && event.ctrlKey) { $("#rcbtn_' + tid + '").click(); } }); var tReplys = ' + tReplys + ';if(tReplys > 0){topic_view_comment_list(' + tid + ',\'comment\');}initAiInput("reply_content_' + tid + '");var relate = '+relate+';if(relate){ajax_list_feature(\'ftopicReplyType_'+tid+'featureid\','+itemid+','+featureid+');}</scr' + 'ipt>';
		tcHTML = '<div class="relayTxt topicReply">  <div class="mid"><div id="to_reply_user_' + tid + '"></div>'+publishHtml+yxm_popHTML+relateHTML+'<div class="comment_p"><div id="topic_view_comment_area_' + tid + '"><div id="topic_view_comment_msg_area_' + tid + '"></div></div></div></div> </div>';
	}
		
	return tcHTML;
}
function ajax_list_feature(divid,channelid,featureid){
	$.post("ajax.php?mod=feature&code=ajaxgetfeature",{channelid:channelid,featureid:featureid},function(d){$("#"+divid).html(d);});
}

function topic_view_comment_list(tid, item, eid, tid2, meid)
{
	var eid = ('undefined' == typeof(eid) ? "topic_view_comment_area_" + tid : eid);
	var meid = ('undefined' == typeof(meid) ? eid : meid);//��ʾ��Ϣ�����ID
	var tid2 = ('undefined' == typeof(tid2) ? 0 : tid2);//���ڵ�����¥΢��
	
	$("#" + meid).html("<div><center><span class='loading'>�������ڼ����У����Ժ򡭡�</span></center></div>");
	
	var myAjax=$.post("ajax.php?mod=topic&code=view_"+item,{tid:tid, tid2:tid2, eid:eid},function(d){$("#" + eid).html(d);});
}

// ��ת������¼�
function onForwardSelectedListener(tid, options)
{
	if (isUndefined(options)) {
		options = {};
	}
	
	if($('#topicForwardType_'+tid).attr("checked")) {
		$('#rcbtna_'+tid).attr("onclick", '');
		$("#rcbtna_" + tid).click(function(){
			Forward('forward_content_' + tid, tid , tid , 'topicForwardType_' + tid);
		});
	} else {
		$('#rcbtna_'+tid).attr("onclick", '');
		$("#rcbtna_" + tid).click(function(){
			Forward('forward_content_' + tid, tid , tid , 'topicForwardType_' + tid, options);
		});
	}
}

// ת��Tab js
function zfTab(name,cursel,n,key)
{
	var tid = key;
	for(i=1;i<=n;i++){
		var zfmenu=document.getElementById(name+i);
		var zfcon=document.getElementById("zfcon_"+name+"_"+i);
		zfmenu.className=i==cursel?"zfhover":"";
		// $("#rcbtna_"+key).attr('disabled', false);
		if (cursel == 2 && i==cursel) {
			// ���°󶨰�ť�¼�
			$('#toqunwp_'+key).show();
			zfQun('qun_select_wp_'+key, key);
			$('#rcbtna_'+tid).attr("onclick", '');
			$('#rcbtna_' + tid).unbind("click");
			$("#rcbtna_" + tid).click(function(){
				Forward('forward_content_' + tid, tid , tid , 'topicForwardType_' + tid, {appitem:'qun', appitem_id:ComboBoxManager.get('qun_select_'+key).val()});
			});
		} else if (cursel == 1 && i==cursel){
			//$('#rcbtna_'+tid).attr("onclick", '');
			$('#rcbtna_' + tid).unbind("click");
			$("#rcbtna_" + tid).click(function(){
				Forward('forward_content_' + tid, tid , tid , 'topicForwardType_' + tid);
			});
			$('#toqunwp_'+key).hide();
		}
	}
}

// ת����ȡ�ҵ�Ⱥ
function zfQun(wp ,key)
{
	var html = $("#"+wp).html();
	if (html == '') {
		$("#"+wp).html('���ڼ���...');	
	} else {
		return false;
	}
	$.get(
		'ajax.php?mod=qun&code=widgets&op=my_qun&type=1&key='+key+'&random='+Math.random(),
		{},
		function (d) {
			$("#"+wp).html(d);
			var cb = ComboBoxManager.create('qun_select_'+key);
			cb.setComboBoxWidth(200);
		}
	);
}

// ת��������
function get_forward_choose(tid,allow_attach,allow_pic,allow_face,options)
{
	var check_uid = $('#check_PublishBox_uid').val();
	var uid ='undefined'==typeof(check_uid)?'0':check_uid;
	if(uid < 1){
		ShowLoginDialog();
		return false;
	}
	
	if (isUndefined(options)) {
		options = {};	
	}
	var tid = 'undefined' == typeof(tid) ? 0 : tid;
	if(tid < 1){
		show_message("��Ǹ����"+__N_WEIBO__+"�Ѿ���ɾ�����޷�ת����",3);
		return false;
	}
	var allow_attach = 'undefined' == typeof(allow_attach) ? 0 : allow_attach;
	var allow_pic = 'undefined' == typeof(allow_pic) ? 0 : allow_pic;
	var allow_face = 'undefined' == typeof(allow_face) ? 0 : allow_face;
	
	var strOptions = "{}";
	var item = '';
	var itemid = 0;
	if ((options.appitem && options.appitem_id) || options.is_reward) {
		if('undefined' == typeof(options.is_reward)){
			options.is_reward = 0;
		}
		strOptions = "{appitem:'"+options.appitem+"',appitem_id:'"+options.appitem_id+"',is_reward:'"+options.is_reward+"'}";
		item = options.appitem;
		itemid = options.appitem_id;
	}

	// ��������ת�������۸�ѡ�� Modify by ~ZZ~ 2011-06-30
	var strForwarAndReply = '';
	if (!options.noReply) {
		strForwarAndReply = '<input name="topicForwardType_' + tid + '" type="checkbox" id="topicForwardType_' + tid + '" value="forward" onclick="select_checked(\'topicForwardType_' + tid + '\',\'forward\');"/> <label for="topicForwardType_' + tid + '" style="cursor:pointer;">ͬʱ��Ϊ���۷���</label>';
	} else {
		strForwarAndReply = '<input name="topicForwardType_' + tid + '" type="checkbox" id="topicForwardType_' + tid + '" value="forward" onclick="onForwardSelectedListener(' + tid + ',' + strOptions + ');"/> <label for="topicForwardType_' + tid + '" style="cursor:pointer;">ת������˿</label>';
	}
	
	var i_content = 'ת��';
	if(options.i_content){
		i_content = options.i_content;
	}
	
	var handle_key = "forward_menu_"+tid;
	var allow_attachHTML = '';
	var allow_picHTML = '';
	var allow_faceHTML = '';
	var psubmitHTML = '';
	var yxm_popHTML = '';
	var atuserHTML = '<div class="comment_p_b2 comment_p_b22 sendInsertfocus"><div class="menu_hp"><b class="menu_hpb_c" id="forward_atuser_'+tid+'" onclick="showatuserw(\'forward_content_'+tid+'\',\'forward\',\''+tid+'\');return false;">����</b><div class="menu_hpb rf_at_user" id="atuser_forward_'+tid+'"><span class="arrow-up"></span><span class="arrow-up-in"></span><div class="menu_tb showusr"><div id="showatuser_forward_'+tid+'" class="showatuser"></div><sub class="menu_hpb_c1"></sub></div></div></div></div>';
	if(allow_attach){
		allow_attachHTML = 'attachUploadifyHTML(' + tid + ', "forward_content_' + tid + '", "forward_attach_uploadify_' + tid + '",0,"' + item + '",' + itemid + ');';
	}
	if(allow_face){
		allow_faceHTML = '<div class="menuf_bq"><b class="menu_bqb_c"><a href="javascript:viod(0);" onclick="topic_face(\'forward_' + tid + '\',\'forward_content_' + tid + '\');return false;">����</a></b><div class="forward_f" id="forward_' + tid + '"></div></div>';
	}
	if(allow_pic){
		allow_picHTML = 'imageUploadifyHTML(' + tid + ', "forward_content_' + tid + '", "forward_image_uploadify_' + tid + '");';
	}
	if(YXM_POP_Title){
		psubmitHTML = '<input type="hidden" id="YXM_F_'+tid+'" onclick="Forward(\'forward_content_' + tid + '\',' + tid + ',' + tid + ',\'topicForwardType_' + tid + '\','+strOptions+');return false;"/><input id="rcbtna_' + tid + '" onclick="YXM_pubtopic(\'forward_content_' + tid + '\',\'_forward_' + tid + '\',\'topicForwardType_' + tid + '\',\'YXM_F_'+tid+'\');return false;" type="button" value="ת ��" class="sBtn_2t u-btn" style="margin:0 0 0 5px"/>';
		yxm_popHTML = '<tr><td colspan="2"><span id="yxm_pub_button_forward_'+tid+'" onclick="YXM_popBox(this,\'forward,'+tid+'\',\''+YXM_POP_Title+'\');" style="margin-left:40px;height:1px;">&nbsp;</span></td></tr>';
	}else{
		psubmitHTML = '<input id="rcbtna_' + tid + '" onclick="Forward(\'forward_content_' + tid + '\',' + tid + ',' + tid + ',\'topicForwardType_' + tid + '\','+strOptions+');return false;" type="button" value="ת ��" class="u-btn" style="margin:0 0 0 5px"/>';
	}
	
	var fcHTML = '<div id="forward_list" class="dialog_inner" style="width:500px;_overflow:hidden;"><div class="mWarp"> <form action="ajax.php?mod=topic&code=forward" method="POST" target="Forwardframe_' + tid + '"><table width="502"><tr><td colspan="2"><div id="toqunwp_' + tid + '" style="display:none;"><div style="float:left">ѡ��'+__WEIQUN__+'��</div><div style="float:left" id="qun_select_wp_' + tid + '"></div></div></td></tr><tr> <td colspan="2"><span id="user_new"></span></td> </tr> <tr> <td colspan="2"><span id="topic_forward_content_area_' + tid + '">ԭ�����ڼ����С���</span></td> </tr> <tr> <td colspan="2"><div class="alt_3"> <div class="sendTitle" style="margin:0 0 0 310px"><style>ul.txtNum li{ width:65px;}</style> <ul class="txtNum" style="color:#999;"> <li>����������</li> <li id="wordc"><span id="wordcNum_' + tid + '" style="color:#ff0000;">' + thisTopicLength + '</span></li> <li style="width:14px;">��</li> </ul> </div>  </div> <div class="alt_3"> <textarea id="forward_content_' + tid + '" name="content" onkeyup="javascr' + 'ipt:checkWord(' + thisTopicLength + ',event,\'wordcNum_' + tid + '\')" class="textarea" onblur="if(this.value == \'\'){this.value = \'ת��\'; }" onfocus="if(this.value == \'ת��\'){this.value =\'\'; }" style="width:490px;margin-bottom:5px;">'+i_content+'</textarea> </div></td> </tr> <tr> <td class="modify_tool_left">'+allow_faceHTML+'<div id="forward_image_uploadify_'  + tid + '" class="comment_p_b2 comment_p_b22"></div><div id="forward_attach_uploadify_'  + tid + '" class="comment_p_b2 comment_p_b22"></div>'+atuserHTML+'</td> <td class="modify_tool_right"><div class="rb_a1">'+strForwarAndReply+psubmitHTML+' <input name="forward_tid" type="hidden" id="forward_tid" value="' + tid + '" /></div> </td> </tr>'+yxm_popHTML+' </table> </form> </div></div> <sc' + 'ript type="text/jav' + 'ascri' + 'pt"> $(document).ready(function(){'+ allow_picHTML + allow_attachHTML + '$(".menu_bqb_c").click(function(){$("#forward_' + tid + '").show();});$("#forward_atuser_'+tid+'").click(function(){$("#atuser_forward_'+tid+'").show();$(".forward_f2").hide();$(".forward_f").hide();$(".insertAttachDiv").hide();$(".modify_face").hide();$(".insertImgDiv").hide();});$(".menu_hpb_c1").click(function(){$("#atuser_forward_'+tid+'").hide();});$(".close_1").click(function(){$("#forward_' + tid + '").hide();}); initAiInput("forward_content_' + tid + '");}); $("#forward_content_' + tid + '").bind("keydown",function(event){ event = event || window.event; if(event.keyCode == 13 && event.ctrlKey) { $("#rcbtna_' + tid + '").click(); } });$("#forward_content_' + tid + '").setCaret(); $("#topic_forward_content_area_' + tid + '").html("<span class=\'loading\'>�������ڼ����У����Ժ򡭡�</span>");var myAjax=$.post("ajax.php?mod=topic&code=forward_menu",{tid:' + tid + '},function(d){if(is_json(d)){var d_json=eval("("+d.toString()+")");show_message(d_json.msg,3);closeDialog("forward_menu_'+tid+'");}else{$("#topic_forward_content_area_' + tid + '").html(d);}});</scri' + 'pt>';
	
	var fcFrameHtml = '';
	if (!isQunClosed) {
		fcFrameHtml = '<div class="zfbox"><div class="zfTitle" id="zfTitle_'+tid+'"><ul class="zfti"><li id="zf_m1" class="zfhover" onclick="zfTab(\'zf_m\',1,2,' + tid + ')">ת������˿</li><li id="zf_m2" onclick="zfTab(\'zf_m\',2,2,' + tid + ')">ת����'+__WEIQUN__+'</li><sub class="menu_zf_c1" onclick="closeDialog(\''+handle_key+'\');"></sub></ul></div><div id="zfcon_zf_m_1" class="zfcon">'+fcHTML+'</div><div id="zfcon_zf_m_2" class="zfcon" style="display:none">ת����'+__WEIQUN__+'</div></div>';
	} else {
		fcFrameHtml = '<div class="zfbox"><div class="zfTitle" id="zfTitle_'+tid+'"><ul class="zfti"><li id="zf_m1" class="zfhover">ת������˿</li><sub class="menu_zf_c1" onclick="closeDialog(\''+handle_key+'\');"></sub></ul></div><div id="zfcon_zf_m_1" class="zfcon">'+fcHTML+'</div></div>';
	}

	// $("#"+"forward_menu_"+tid).css('display','block');
	// $("#"+"forward_menu_"+tid).html(fcHTML);
	var h = showDialog(handle_key, 'local', 'ת�����ҵķ�˿', {"html":fcFrameHtml, "noTitleBar":true}, 540);
	// �������϶���
	draggable(h.dom.wrapper, $('#zfTitle_'+tid));
}

var authort;
// ����ͷ����ʾ�û�
function get_user_choose(uid,types,tid)
{
	clear_user_choose();
	var div_id = tid ? tid : uid;
	var _cache_id = uid;

	authort = setTimeout(function () {
		if(Cache.get(_cache_id)){
			if(types == "media"){
				$("#"+"media_"+div_id).html(Cache.get(_cache_id));
				//setCardPosition("media_"+div_id,uid);
			}
			else{
				$("#"+"user_"+div_id+types).html(Cache.get(_cache_id));
				setCardPosition("user_"+div_id+types);
			}
		} else {
			var myAjax = $.post(
			    "ajax.php?mod=topic&code=usermenu",
			    {
			    	uid:uid
			    },
				function (d) {
					if(''!=d) {
						Cache.save(_cache_id,d);
						if(types == "media"){
							$("#"+"media_"+div_id).html(Cache.get(_cache_id));
							//setCardPosition("media_"+div_id,uid);
						}
						else{
							$("#"+"user_"+div_id+types).html(Cache.get(_cache_id));
							setCardPosition("user_"+div_id+types);
						}
					}
				}
			);
		}
	}, 500);
}

function setCardPosition(cardid){
	var offset = $("#"+cardid).offset();
	var MouseX = offset.left;
	var MouseY = offset.top;
	var popWidth=300;
	var popHeight=180;
	var popLeftAdjust=0;
	var popTopAdjust=0;
	
	if(MouseX+popWidth>$(window).width() + $(window).scrollLeft()) {
		popLeftAdjust="-250px";
	}
	if(MouseY+popHeight>$(window).height() + $(window).scrollTop()) {
		popTopAdjust="-130px";
	}
	if(popLeftAdjust || popTopAdjust){
		$(".media_user_list").css({margin:popTopAdjust + " 0 0 "+popLeftAdjust});
	}
}

function clear_user_choose()
{
	clearTimeout(authort);
	$(".delstyle").removeAttr("style");
	if (topic_user_face_is_loading)
	{
		var id = "topicuserface";
		$('#'+id).html('');
	}
}

// ��궨λ ��ȡ����
function mousePosition(ev){ 
	
	if(ev.pageX || ev.pageY){ 
	return {x:ev.pageX, y:ev.pageY}; 
	} 
	return { 
	x:ev.clientX + document.body.scrollLeft - document.body.clientLeft, 
	y:ev.clientY + document.body.scrollTop - document.body.clientTop 
	}; 
} 

// user card loading flag
var topic_user_face_is_loading = null;
/*
 * ΢������ �������û��ǳ���ʾ��Ƭ��
 * nickname �û��ǳ�
 */
//modify 2012-07-09 16:58
//modify 2012-07-31 11:32 ��1.��Ӳ�ѯ�ֶ�����[uid|nickname] 2.���loadingЧ����
function get_at_user_choose(nickname,obj,queryType){
	var id = "topicuserface";
	if($('#'+id).length==0){
		$(document.body).append("<div id='"+id+"' />");
	}
	else
	{
		$('#'+id).html('');
	}
	var _cache_id = nickname;
	var position = $(obj).offset();
	$('#'+id).css({position:"absolute",'padding-top':'10px','z-index':99,left:position.left-10,top:position.top+20});
	if ($.browser.msie && $.browser.version<8){
		$('#'+id).css({left:position.left+40});
	}
	// timer to load
	authort = setTimeout(function () {
		// loading status pre display
		$('#'+id).html("<div class='arrow'></div><div id='topic_user_menu_x' class='media_user_list'><ul class='tipsBox'><li style='padding-left:21px;'><img src='"+thisSiteURL+"images/loading.gif' width='16' height='16' /></li></ul></div>");
		topic_user_face_is_loading = true;
		// card data dsp
		if(Cache.get(_cache_id)!=null){
			$('#'+id).html(Cache.get(_cache_id));
			topic_user_face_is_loading = false;
		}else{
			// nedu-query-type-redeclare
			var myPost = {};
			myPost['arrow'] = 'yes';
			if (queryType)
			{
				myPost[queryType] = nickname;
			}
			else
			{
				myPost['nickname'] = nickname;
			}
			// over
			var myAjax = $.post(
			"ajax.php?mod=topic&code=usermenu",myPost,
			function (d) {
				if(''==d){
					d = "<div id='topic_user_menu_x' class='media_user_list' onmouseout='$(this).hide();'><ul class='tipsBox'><li style='padding-left:21px;'>���û������ڣ�Ҫô��ɾ����Ҫô�Ѹ�����</li></ul></div>";
				}
				Cache.save(_cache_id,d);										 
				$('#'+id).html(Cache.get(_cache_id));
				topic_user_face_is_loading = false;
			}
			);
		}
	},200);
	obj.onmouseout=function(){ 
		clear_user_choose();
	};
}
//΢�����������û�����Ƭ��ʾ
function get_dig_user_choose(nickname,uid,tid){
	var id = "diguserface";
	$('#'+id).css({position:"absolute",'z-index':1199,left:8,top:104});
	if ($.browser.msie && $.browser.version<8){$('#'+id).css({left:52});}
	var _cache_id = nickname;
	if(Cache.get(_cache_id)!=null){
		$('#'+id).html(Cache.get(_cache_id));
	}else{
		var myAjax = $.post(
			"ajax.php?mod=topic&code=usermenu",{nickname:nickname},
			function (d) {
				if(''!=d) {
					Cache.save(_cache_id,d);										 
					$('#'+id).html(Cache.get(_cache_id));
				}
			}
		);
	}
}
/*
 * ΢������ �������û��ǳ���ʾ��Ƭ��
 * 
 * nickname �û��ǳ� uid �û�uid tid ΢��tid ev ��������û��ǳ� ���꣬ ��λ��Ƭ����ʾ
 * 
 * types ��Ƭ����ʾdiv ��ʶ
 */
/*��ǰ�ģ���Ϊ��BUG����ת����΢������ʾԭ΢�����@����ʱ��λ����ȷ��
function get_at_user_choose(nickname,types,tid,ev)
{   
	// ��궨λ ��ȡ����
	var mousePos = mousePosition(ev); 
	var mouseX = mousePos.x; 
	var mouseY = mousePos.y; 
	
	
	clear_user_choose();
	var div_id =  tid;
	var _cache_id = tid;
		authort = setTimeout(function () {
		var myAjax = $.post(
			"ajax.php?mod=topic&code=usermenu",{
				nickname:nickname
			},
			function (d) {
				if(''!=d) {
					Cache.save(_cache_id,d);
					
					 document.getElementById("at_"+div_id+types).style.scrollTop 	=  mouseY+'px';
					 document.getElementById("at_"+div_id+types).style.left =  mouseX+'px';
					 
					 document.getElementById("at_"+div_id+types).style.display = "block";
					 
					 $("#"+"at_"+div_id+types).html(Cache.get(_cache_id));
			}
			}
		);
			$("#"+"at_"+div_id+types).html(Cache.get(_cache_id));
		
	}, 500);
}
*/

// ɾ�����ϴ�����Ƶ
function DelVideo(videoid,types)
{   
	
	var videoid = $('#'+videoid).val();
	var videoid = 'undefined' == typeof(videoid) ? 0 : videoid;
	// alert(videoid);return false;
	if(videoid > 0) {
		$.post(
			'ajax.php?mod=topic&code=delete_video',
			{
				id:videoid
			},
			function (d) {				
				if(''!=d) {
					;		
				} else {
					// ͨ��ajax�ϴ���Ƶ�� ɾ����Ƶ���������ڵ����ݺ�����ͼ
					if(types == 'video_ajax')
					{	
						parent.document.getElementById('upload_video_list').style.display='none';
						parent.document.getElementById('add_video').style.display='block';
						parent.document.getElementById('i_already').value='';
					}
				}
			}
		);
		videoid = 0;
	}
	listTopic(0,0);
}

/**
 * ͨ��JS��Ϣ��ʾ������ʾ�趨ʱ�������
 * @param show_message  ��ʾ����Ϣ���� �� "�����ɹ�"��Ĭ��Ϊ��
 * @param show_time     ��Ϣ��ʾ��ʱ�䣬��λΪ�룻Ĭ����ʾ "1" ��
 * @param msg_title     ��ʾ����Ϣ���⣬Ĭ��Ϊ"��ʾ"
 * @param msgBox        ��Ϣ��ʾ����ʹ�õ���ʽ��Ĭ��Ϊ"msgBox"
 */
 
function show_message(show_message,show_time,msg_title,msgBox,msg_mark)
{
	var show_message = (undefined==show_message ? '' : show_message);

	if(show_message)
	{
		var show_time = (undefined==show_time ? 1 : show_time);
		var msg_title = (undefined==msg_title ? '��ʾ' : msg_title);
		var msgBox = (undefined==msgBox ? 'msgBox' : msgBox);
		var msg_mark = (undefined==msg_mark ? '' : ' '+msg_mark);

		var smaHTML = '<div id="msgBox" class="' + msgBox + '"><div class="msg_title">' + msg_title + '</div><div class="msg_content '+msg_mark+'"><sub>' + show_message + '</sub></div></div>';

		$('#show_message_area').html(smaHTML);
		var msgBoxObj = document.getElementById("msgBox");
		msgBoxObj.style.visibility = "visible";
		var i=0;
		setTimeout(function() {
			i += 1;
			msgBoxObj.style.visibility= "hidden";
		},(show_time * 1500));
	}
}

//����ȷ����
function show_message_2(show_message,show_title,tigBoxClass,msg_error)
{
	var show_message = (undefined==show_message ? '' : show_message);

	if(show_message)
	{
		var msg_title = (undefined==msg_title ? '��ʾ' : msg_title);
		var msgBox = (undefined==msgBox ? 'msgBox' : msgBox);

//		var smaHTML = '<div id="msgBox" class="' + msgBox + '">'+
//						'<div class="msg_title">' + msg_title + '</div><div class="msg_content msg_right">' + show_message + '</div>'+
//						'<div id="qr" class="u-btn">ȷ ��</div></div>';
		var msg_error = (undefined==msg_error ? '' : ' msg_error');
		var smaHTML = '<div id="msgBox" class="' + msgBox + '"><div class="msg_title">' + msg_title + '</div><div class="msg_content '+msg_error+'"><sub>' + show_message + '</sub>'+'<br><div id="qr" class="u-btn" style="float:left;margin:5px 0 0 0;">ȷ ��</div></div></div>';				
						
		$('#show_message_area').html(smaHTML);

		var msgBoxObj = document.getElementById("msgBox");

		msgBoxObj.style.visibility = "visible";
		$('#qr').click(function(){msgBoxObj.style.visibility= "hidden";});

//		var i=0;
//	    setTimeout(function() {
//		    i += 1;
//	        tigBoxObj.style.visibility= "hidden";
//		},(show_time * 5000));
	}
}

// �Ի������ڵ���������
function follower_choose(uid,nickname,types,template)
{
	var uid = 'undefined' == typeof(uid) ? 0 : uid;
	var template = 'undefined' == typeof(template) ? '' : template;
	var handle_key = "alert_follower_menu_"+uid;
	var ajax_url = 'ajax.php?mod=topic&code=follower_choose';
	var post = {
					uid:uid,
					nickname:nickname,
					types:types,
					template:template
					
				};
	var title = "��������..."; 
	if (types == 'lahei') {
		showDialog(handle_key, 'ajax', title, {"url":ajax_url, "post":post}, 400);
	} else if (types == 'del') {
		title = "ȡ�����ڣ�";
		showDialog(handle_key, 'ajax', title, {"url":ajax_url, "post":post}, 400);
	} else if (types == 'at') {
		showDialog(handle_key, 'ajax', title, {"url":ajax_url, "post":post}, 400);
	} else if (types == 'buddys') {
		showDialog(handle_key, 'ajax', title, {"url":ajax_url, "post":post}, 400);
	} else if (types == 'topic_signature') {
		
		// ΢��ҳ���޸ĸ���ǩ��
		showDialog(handle_key, 'ajax', title, {"url":ajax_url, "post":post}, 400);	
	} else if (types == 'editarea') {
		title = "�༭ע���ַ";
		showDialog(handle_key, 'ajax', title, {"url":ajax_url, "post":post}, 400);
	} else if (types == 'del_fans') {
		title = "�Ƴ���˿";
		showDialog(handle_key, 'ajax', title, {"url":ajax_url, "post":post}, 400);
	} else {

		var myAjax=$.post(
		"ajax.php?mod=topic&code=follower_choose",
			{
				uid:uid,
				nickname:nickname,
				types:types,
				template:template,
				return_type:return_type
			},
			function(d)
			{
				if(''!=d){
					document.getElementById("alert_follower_menu_"+uid).style.display="block";
					$("#"+"alert_follower_menu_"+uid).html(d);
					if('user_face' == template){
						document.getElementById("topic_user_menu_"+uid).style.display="none";
					}
				}
				
			}
			
		);
	}
		
}



/*
 * uid = ��ǰ������UID touid = ��������UID tyoes = ȡ������ ���� ���������
 * 
 * template = ajax ֵ ����ģ��
 */
function do_blacklist(uid,touid,types,template)
{ 
	var uid = 'undefined' == typeof(uid) ? 0 : uid;
	var touid = 'undefined' == typeof(touid) ? 0 : touid;
	var types = 'undefined' == typeof(types) ? '' : types;

	
	// alert(template); return false;
	
	var myAjax = $.post(
		"ajax.php?mod=topic&code=doblacklist",
		{
			uid:uid,
			touid:touid,
			types:types,
			template:template
		},
		function (d) {
			if(''!=d) {				
				closeDialog("alert_follower_menu_"+touid);
				
				if('add'==types){
					$('#topic_index_blacklist_'+touid).html(d);
				}
				else {
					$('#topic_index_blacklist_'+touid).html(d);
				}

				$("#follow_user_"+touid).remove();
				// listTopic(0,0);
				// document.getElementById("alert_follower_menu_"+touid).style.display="none";
			}
		}
	);
}

// ���ø��Ա�ǩ
function user_tag(tagid,tag_name,types)
{

	var tagid = 'undefined' == typeof(tagid) ? 0 : tagid;

  if('add' == types)
  {
		var tag_name = $('#'+tag_name).val();
		var tag_name = 'undefined' == typeof(tag_name) ? '' : tag_name;
	}

	var myAjax = $.post(
		"ajax.php?mod=topic&code=user_tag",
		{
			tagid:tagid,
			tag_name:tag_name,
			types:types
		},
		function (d) {
			if(''!=d) {
				// show_message('��ǩ���óɹ�',1);
				document.getElementById("tags_name").value="";
				$("#user_tag_list").html( $("#user_tag_list").html()+d);
			}
			$("#del_tag_"+tagid).remove();
		}
	);
}
// ɾ�����Ա�ǩ
function del_tag(tag_id)
{
	var tag_id = 'undefined' == typeof(tag_id) ? 0 : tag_id;

	var myAjax = $.post(
		"ajax.php?mod=topic&code=del_tag",
		{
			tag_id:tag_id
		},
		function (d) {
			if(''!=d) {
				$("#del_id_"+tag_id).remove();
			}
		}
	);
}
//���뻰��
function tag_insert(tagName){
	var document_id = document.getElementById('i_alreadyajax') ? 'i_alreadyajax' : 'i_already';
	var con = tagName ? tagName : "�����Զ��廰��";	
	$('#'+document_id).insertAtCaret('#'+con+'#',1);
	if (isUndefined(tagName)){
		$(".menu_m_c1").click();
	}
}

// �ж�ͬʱ΢�� ͬʱ���� ѡ��״̬
function select_checked(topicTypeId,topicTypeVal) {
	var topicTypeId = ('undefined'==typeof(topicTypeId) ? 'topictype' : topicTypeId);
	if($("#" + topicTypeId).attr("checked")) {
		$("#" + topicTypeId).val('both');
	} else {
		var topicTypeVal = ('undefined'==typeof(topicTypeVal) ? 'reply' : topicTypeVal);
		if('reply' != topicTypeVal) {
			topicTypeVal = 'forward';
		}
		$("#" + topicTypeId).val(topicTypeVal);
	}
}
//����΢��
function set_relate(relateid,relatedivid){
	var relateid = ('undefined'==typeof(relateid) ? 0 : relateid);
	var relatedivid = ('undefined'==typeof(relatedivid) ? 'ftopictype' : relatedivid);
	if($('#'+relatedivid).attr("checked")) {
		$('#'+relatedivid).val(relateid);
	}else{
		$('#'+relatedivid).val('0');
	}
}

// �ر��û�������
function close_media_menu(uid){
	document.getElementById("media_user_list_"+uid).style.display="none";
	document.getElementById("media_"+uid).style.display="none";
}

// �رյ�����
function close_menu(div_id,close_div){
	$("#"+close_div+"_"+div_id).html("");
	document.getElementById(close_div+"_"+div_id).style.display="none";
}

// ��ʱˢ��
function ajax_recommend(uid)
{
	var uid = 'undefined' == typeof(uid) ? 0 : uid;
	if(uid > 0) {
		var myAjax = $.post(
			"ajax.php?mod=reminded&code=recommend",
			{
				uid:uid,tid:last_recommend_tid
			},
			function (d) 
			{
				if(''!=d){
					var s=d.split('<jishigou>');
					if(s[0] != last_recommend_tid){
						if($('#topic_list_'+s[0]).length>0){
							if(last_recommend_tid>0){
								$('#topic_list_'+s[0]).html($('#topic_list_'+last_recommend_tid).html());								
								$('#topic_list_'+s[0]).show();
							}else{
								$('#topic_list_'+s[0]).html('');
								$('#topic_list_'+s[0]).hide();
							}
						}
						last_recommend_tid = s[0];
						$("#ajax_recommend").html(s[1]);
					}
				}
			}
		);
	}
}
function ajax_recd_colse()
{
	var myAjax = $.post("ajax.php?mod=reminded&code=modacttime",{},function(){});
	$("#ajax_recommend").html('');
}
function ajax_reminded(r_uid,is_uptime,fcode)
{
	var ajax_remindedHTML = $("#ajax_reminded").html();
	ajax_remindedHTML = ('undefined' == typeof(ajax_remindedHTML) ? '' : ajax_remindedHTML);

	/*
	 * �Ѿ���������������ʱ�Ͳ������󣿿���������ܣ���ֹ��ˢ�£�
	 */
	if(''!=ajax_remindedHTML)
	{
// return false;
	}

	var r_uid = 'undefined' == typeof(r_uid) ? 0 : r_uid;
	var is_uptime = 'undefined' == typeof(is_uptime) ? 0 : is_uptime;
	var fcode = 'undefined' == typeof(fcode) ? '' : fcode;

	var myAjax = $.post(
		"ajax.php?mod=reminded&code=show&uninitmember=1",
		{
			uid:r_uid,
			is_uptime:is_uptime,
			fcode:fcode
		},
		function (d) 
		{
			if( '' != d && -1 != d.indexOf('<success></success>') ) 
			{
				d = d.trim();
				if (d != '<success></success>') {
					$("#ajax_reminded").html(d);
				}
			}
		}
	);
}

// ����һ��UNIXʱ�������PHPһ����
function time()
{
	var _dateObj=new Date();
	var _time=_dateObj.getTime().toString();
	return parseInt(_time.substring(0,_time.length-3));
}
// JS�����࣬���ڻ���AJAX���ؽ���ǳ�����
function CacheHandler()
{
	this.data={};
	this.lifeTime=3600;// Ĭ�ϻ���һСʱ
	this.setLifeTime=function(lifeTime)
	{
		this.lifeTime=lifeTime;
	};
	this.save=function (name,value,lifeTime)
	{
		this.data[name]={expire:time()+(parseInt(lifeTime) || this.lifeTime),value:value};
		return this.data[name]['value'];
	};
	this.get=function (name)
	{
		if(this.data[name]==undefined || this.data[name]['expire']<time())return undefined;
		return this.data[name]['value'];
	};
	this.getOrSave=function(name,value,lifeTime)
	{
		return this.get(name)==undefined && this.save(name,value,lifeTime);
	};
	this.clear=function (name)
	{
		name?delete this.data[name]:this.data={};
	};
}
var Cache=new CacheHandler();// ʵ������ȫ�ֻ������

//
function headDoSearch()
{
	var searchValue=$('#headq').val();
	var searchType=$('#headSearchType').val();
	var redirectURL='';
	if(''==searchValue||'undefined'==searchValue||'������ؼ���'==searchValue)
	{
		alert("������ؼ���");
	}
	else
	{
		searchValue = encodeURIComponent(searchValue);
		
		if('userSearch'==searchType){
			redirectURL='index.php?mod=search&code=user&nickname='+searchValue;
		}else if('tagSearch'==searchType){
			redirectURL='index.php?mod=search&code=tag&tag='+searchValue;
		}else if('topicSearch'==searchType){
			redirectURL='index.php?mod=search&code=topic&topic='+searchValue;
		}else if('voteSearch'==searchType){
			// �����ͶƱ��search By ~ZZ~ 2010-04-22
			redirectURL='index.php?mod=search&code=vote&q='+searchValue;
		}else if('qunSearch'==searchType){
			// �����΢Ⱥ��search By ~ZZ~ 2010-08-23
			redirectURL='index.php?mod=search&code=qun&q='+searchValue;
		}else{
			alert("δ����Ĳ���");
		}

		if(''!=redirectURL)
		{
			window.location.href=thisSiteURL+redirectURL;
		}
	}
	return false;
}

function ProfileSearch()
{
	var searchValue=$('#keywarod').val();
	var searchType=$('#ProfileSearchType').val();
	var searchGetType=$('#type').val();
	
	/* �ҹ�ע�� �ҵķ�˿ ����ʱ�õ� */
	var userNameValue=$('#userName').val();

	var redirectURL='';
	if(''==searchValue||'undefined'==searchValue||'������ؼ���'==searchValue)
	{
		alert("������ؼ���");
	}
	else
	{
		if('user'==searchType){
			redirectURL='index.php?mod=search&code=user&nickname='+searchValue;
		}else if('usertag'==searchType){
			redirectURL='index.php?mod=search&code=usertag&usertag='+searchValue;
		}else if('topic'==searchType){
			redirectURL='index.php?mod=search&code=topic&topic='+searchValue;
		}else if('tag'==searchType){
			redirectURL='index.php?mod=search&code=tag&tag='+searchValue;
		}else if('vote'==searchType){
			// �����ͶƱ��search By ~ZZ~ 2010-04-22
			redirectURL='index.php?mod=search&code=vote&q='+searchValue;
		}else if('fansSearch' == searchType){
			/* ��˿���� zx */
			redirectURL='index.php?mod=fans&nickname='+searchValue;
		}else if('followSearch' == searchType){
			/* ��ע���� zx */
			redirectURL='index.php?mod=follow&nickname='+searchValue;
		}else if('qun'==searchType){
			redirectURL='index.php?mod=search&code=qun&q='+searchValue;
		}else{
			alert("δ����Ĳ���");
		}

		if(''!=redirectURL)
		{
			window.location.href=thisSiteURL+redirectURL;
		}
	}
	return false;
}

// ����
function face_insert(facename,insert){
	if('ת��' == $('#'+insert).val()){$('#'+insert).val('');}
	$('#'+insert).insertAtCaret('['+facename+']',0);
	$('#'+insert).focus();

}
function topic_face(eid,insert,getname)
{  
    $('.insertImgDiv').hide();	
	$('.insertAttachDiv').hide();
	$('.rf_at_user').hide();
	$("#"+eid).show();
	// insert = ���������ķ�����ID getname = ���õı����ļ�
	var getname = 'undefined' == typeof(getname) ? 'topic_face' : getname;
	if(getname == 'tusiji_face')
	{
		if($("#"+eid).hasClass("topic_face")){
			$("#"+eid).removeClass("topic_face");
		}
		$("#"+eid).addClass("tusiji_face");
	}else if(getname == 'topic_face'){		
		if($("#"+eid).hasClass("tusiji_face")){
			$("#"+eid).removeClass("tusiji_face");
		}
		$("#"+eid).addClass("topic_face");
	}

	var tfHTML = topicFaceHTML(eid, insert, getname);
	
	$("#" + eid).html(tfHTML);
}
// �齨�����HTML���루���ٴ�AJAXҳ���ȡ�� 2011��6��21�� by foxis
function topicFaceHTML(eid, insert, getname)
{
	var __TOPIC_FACE_CONFIG__ = 
	{
		'topic_face' : ['΢Ц','Ʋ��','ɫ','����','����','����','����','����','˯','���','����','��ŭ','��Ƥ','����','����','�ѹ�','��','�亹','ץ��','��','͵Ц','�ɰ�','����','����','����','��','����','����','��Ц','���','�ܶ�','����','����','��','��','��ĥ','˥','����','�ô�','�ټ�','����','�ٱ�','����','�ܴ���','��Ц','��ߺ�','�Һߺ�','��Ƿ','����','ί��','�����','����','����','��','����','�˵�','����','ơ��','����','ƹ��','����','��','��ͷ','õ��','��л','ʾ��','����','����','����','����','ը��','��','����','ư��','���','����','̫��','����','ӵ��','ǿ','��','����','ʤ��','��ȭ','����','ȭͷ','�','����','NO','OK','�ɱ�','����','����','����','���','תȦ','��ͷ','��ͷ','����','����','����','����','����','��̫��','��̫��'],
		'tusiji_face' : ['����','����','Ү','ŭ��','Ť��','��','����','�ݰ�','�Ӻ�','����','³��','��ש','����','����','̯��','ϴϴ˯','̱��','��','������','��ת','����','����','����','ץǽ','ײǽ','��ͷ','����','Ʈ��','����','��','��ˬ','������','�ҵ���','שͷ','��ƿ','����','ҡ��','����','����','��']
	};
	if($(__TOPIC_FACE_CONFIG__[getname]).length < 1)
	{
		getname = 'topic_face';
	}
	var tfs = __TOPIC_FACE_CONFIG__[getname];
	var tfHTML = '<sc' + 'ript type="text/javascri' + 'pt">$(".close_1").bind({click:function(){$("#' + eid + '").hide();}}); </s' + 'cript><span class="arrow-up"></span><span class="arrow-up-in"></span> <div class="menu_bqb_cb"> <div style="float:left; width:200px;"> <a href="javascript:void(0);" class="bq_select_1" onclick="topic_face(\'' + eid + '\',\'' + insert + '\',\'topic_face\');return false;">QQ����</a> <a href="javascript:void(0);" class="bq_select_2" onclick="topic_face(\'' + eid + '\',\'' + insert + '\',\'tusiji_face\');return false;">��˹��</a> </div> <div class="close_1"></div> </div> <div class="faceBG">';	
		
	$(tfs).each(function (i) {
		r = tfs[i];
		tfHTML = tfHTML + '<span class="spanFs"><img src="' + thisSiteURL + '/static/image/face_bb.gif" class="showfaceBb" title="' + r + '" onclick="face_insert(\'' + r + '\',\'' + insert + '\'); return false;" /></span>';		
	});
	
	tfHTML = tfHTML + '</div>';
	
	return tfHTML;
}


// ���� �����¼
function pmListChat(msgfromid)
{
	var i='undefined'==typeof(msgfromid)?0:msgfromid;
	var eid='undefined'==typeof(eid)?'Pmreply_area_'+i:eid;

	var eidVal=$("#"+eid).html();

	if(''==eidVal)
	{
		var myAjax=$.post
		(
			"ajax.php?mod=pm&code=listchat",
			{
				msgfromid:i
			},
			function(d)
			{
				if(''!=d)
				{
					$("#chat_list_"+i).html(d);
				}
			}
		);
	}
	else
	{
		$("#chat_list_"+i).html('');
	}
}

// �����������ͳ��
function checkWord(len,evt,wordCheckNumID)
{
	var len = ('undefined'==typeof(len) ? 0 : len);
	if(len < 1) {
		return true;
	}
	
   if(evt==null) 
   evt = event || window.event; 
   if(typeof evt == 'string'){
	   var src = $('#'+evt).val();
	   var src = ('undefined' == typeof(src) ? '' : src);
	   var str = src.trim();
   }else{
	   var src = evt.srcElement? evt.srcElement : evt.target;
	   var str = src.value ? src.value.trim() : '';
   }

   myLen =0; i=0;
   for(;(i<str.length)&&(myLen<=len*2);i++){
	   if(str.charCodeAt(i)>0&&str.charCodeAt(i)<128){myLen++;}else{myLen+=2;}
   }
   
   if(myLen>len*2){
	   $('#'+wordCheckNumID).html('0');
   }else{
	   $('#'+wordCheckNumID).html(Math.floor((len*2-myLen)/2));
   }
}

String.prototype.trim = function() 
{ 
	return this.replace(/(^\s*)|(\s*$)/g, ""); 
};

/**
 * ��鷢�����ַ���
 */
function checkPublishText(len, txt_id, tips_id)
{ 
   var src = null;
   src = $('#'+txt_id);
   var str = src.val().trim();
   var myLen = 0;
   var i = 0;
   for(;(i<str.length)&&(myLen<=len*2);i++){
	   if(str.charCodeAt(i)>0&&str.charCodeAt(i)<128) {
			myLen++;
	   } else {
			myLen+=2;
	   }
   }
   
   if(myLen>len*2){
		src.val(str.substring(0,i-1));
   } else if (!isUndefined(tips_id)){ 
		$('#'+tips_id).html(Math.floor((len*2-myLen)/2));
   }
}

/**
 * ����ַ����Ƿ���json����
 */
function is_json(data)
{
	var reg = new RegExp(/^{.*}$/igm);
	if (data.search(reg) != -1) {
		return true;
	}
	return false;
}

/**
 * �Ի���
 * 
 * @param handle_key
 *            �Ի����Ψһ��ʶ��ȷ������Ψһ��
 * @param module
 *            �Ի����ģʽ�� module='ajax'
 *            :��Ҫ�趨options={url:'xxxx'},���������post������ʹ��post��ʽ���� module='local'
 *            :��Ҫ�趨options={html:'xxxx'},�Ի�����ֱ����ʾoptions.html��ֵ����ʹ��option.id�Ի����ڻ�ֱ����ʾid��html����
 *            module='message' :��Ҫ�趨options�е�type�� �澯�Ի���type='warning'
 *            :��Ҫ�趨options={type:'warning',button_name:'ȷ��',text:'��û��Ȩ�޽��е�ǰ����',onclick:''}
 *            ȷ�϶Ի���type='confirm'
 *            :��Ҫ�趨options={type:'warning',yes_button_name:'ȷ��',no_button_name:'ȡ��',
 *            text:'��ȷ��Ҫ�������������?'��onclick:''} module='loading'
 *            :��Ҫ�趨options={text:'���ڼ���'}
 * @param width
 *            �Ի����
 */
var __DialogHtml__ = new Array();
function showDialog(handle_key, module, title, options, width)
{
	if (!width) {
		width = 400;
	}
	Dialog.prototype.noTitleBar = !options.noTitleBar ? false : true;
	var handle = DialogManager.create(handle_key);
	if (!options.noTitleBar) {
		handle.setTitle(title);
	}
	if (module == 'local') {
		var html = '';
		if (isUndefined(__DialogHtml__[handle_key])) {
			if (options.html) {
				html = options.html;
			} else if (options.id) {
				html = $('#'+ options.id).html();
				$('#'+ options.id).html('');
			} else {
				html = '';
			}
			__DialogHtml__[handle_key] = html;
		} else {
			html = __DialogHtml__[handle_key];
		}
		handle.setContents(html);
	} else if (module == 'ajax') {
		// ��ʱ����д�������Ժ��else���治һ����
		// ����Ĭ�ϵĴ�����
		if (!options.checkerror) {
			options.checkerror = function (data) {
				if (is_json(data)) {
					var json = eval('('+data.toString()+')');
					closeDialog(handle_key);
					MessageBox('warning', json.msg);
					return false;
				}
				return true;
			};
		}
		handle.setContents(module, options);
	} else {
		handle.setContents(module, options);
	}    	
	handle.setWidth(width);
	handle.show('center');
	return handle;
}

/**
 * ��̬���öԻ���ı���
 */
function setDialogTitle(handle_key, title)
{
	DialogManager.setTitle(handle_key, title);
}

/**
 * �رնԻ���
 */
function closeDialog(handle_key)
{
	return DialogManager.close(handle_key);
}

/**
 * ���öԻ���ر��¼�������
 */
function setDialogOnCloseListener(handle_key, func, options)
{
	__DIALOG_WRAPPER__[handle_key].onClose = function() {
		if (options) {
			func(options);
		} else {
			func();
		}
		Dialog.prototype.onClose = function() {return true;};
		return true;
	};
}

/**
 * ��Ϣ��ʾ��
 */
function MessageBox(type, msg, title, options)
{
	if (isUndefined(options)) {
		options = {};
	}
	
	if (type == 'notice') {
		handle_key = 'notice_dialog';
		clickEvent = null;
		close_first = false;
		if (options.onclick) {
			clickEvent = options.onclick;
		}
		if (options.close_first) {
			close_first = options.close_first;
		}
		param = {type:'notice',button_name:'ȷ��',text:msg, onclick:clickEvent, close_first:close_first};
	} else if (type == 'warning') {
		handle_key = 'warning_dialog';
		clickEvent = null;
		close_first = false;
		if (options.onclick) {
			clickEvent = options.onclick;
		}
		if (options.close_first) {
			close_first = options.close_first;
		}
		param = {type:'warning',button_name:'ȷ��',text:msg, onclick:clickEvent, close_first:close_first};
	} else if (type == 'confirm') {
		handle_key = 'confirm_dialog';
		var onClickYes = null;
		var onClickNo = null;
		if (options.onClickYes) {
			onClickYes = options.onClickYes;
		}
		if (options.onClickNo) {
			onClickNo = options.onClickNo;
		}		
		param = {type:'confirm',yes_button_name:'ȷ��',no_button_name:'ȡ��',text:msg,onClickYes:onClickYes,onClickNo:onClickNo};
	}
	if (!title || title == '') {
		title = '��ʾ';
	}
	showDialog(handle_key, 'message', title, param, 300);
}

/**
 * ��ʾ�������Ի���
 */
function showMainPublishBox(type,item,itemid,totid,touid)
{	
	// check_PublishBox_uid = ��֤�û�ID��������
	var check_uid = $('#check_PublishBox_uid').val();
	var uid ='undefined'==typeof(check_uid)?'0':check_uid;	
	if(uid < 1){
		ShowLoginDialog();
		return false;
	}
	if (isUndefined(type)) {
		var type = '';
	}
	if (isUndefined(item)) {
		var item = '';
	}
	if (isUndefined(itemid)) {
		var itemid = 0;
	}
	if (isUndefined(totid)) {
		var totid = 0;
	}
	if (isUndefined(touid)) {
		var touid = 0;
	}
	if(type == 'btn_dzwc'){
		MessageBox('notice','���Ѿ������ˣ��벻Ҫ�ظ�������', '��ʾ');
	}else if(type == 'btn_wydz'){
		$.post("ajax.php?mod=item&code=sms",{uid:uid,item:item,itemid:itemid}, function(d){
			if(d == 1){
				if(item == 'live'){
					MessageBox('notice', "���Ƴɹ���ֱ��ǰ5���ӻ�֪ͨ����", '��ʾ');
					$("#btn_css").removeClass("btn_wydz");$("#btn_css").addClass("btn_dzwc");
				}else if(item == 'talk'){
					MessageBox('notice', "���Ƴɹ�����̸ǰ5���ӻ�֪ͨ����", '��ʾ');
					$("#makeNotice").html("���Ƴɹ�");
				}
			}else if(d == -1){
				MessageBox('notice','���Ѿ������ˣ��벻Ҫ�ظ�������', '��ʾ');
			}else{
				MessageBox('notice','����ʧ�ܣ�δ֪����', '��ʾ');
			}
		});
	}else if (type == 'btn_wyfx' || type == 'design' || type =='ask' || type == 'answer'){
		var handle_key = "item_main_pb_dialog";
		if(type == 'ask'){
			var htitle = '����';
		}else if(type == 'answer'){
			var htitle = '��';
		}else{
			var htitle = '�Ƽ�';
		}
		showDialog(handle_key, 'ajax', htitle, {url:"ajax.php?mod=item&code=publishbox&type="+type+"&item="+item+"&itemid="+itemid+"&totid="+totid+"&touid="+touid+"&random="+Math.random()}, 650);
	}else{
		// ���ҳ�������΢������������ʾ������
		if ($('#i_already').length > 0 && $('#wordCheck').length>0) {
			$("html,body").animate({scrollTop: $("#send").offset().top-80}, 1000, 'swing', function(){$('#i_already').focus();});
		} else {
			var handle_key = "hk_main_pb_dialog";
			showDialog(handle_key, 'ajax', '��ʱ�洦��'+__N_WEIBO__, {url:"ajax.php?mod=misc&code=publishbox&type="+type+"&item="+item+"&itemid="+itemid+"&random="+Math.random()}, 650);
		}
	}
}

/**
 * ��ʾ�ٱ��Ի���
 */
function ReportBox(tid)
{
	var handle_key = "hk_report_dialog";
	showDialog(handle_key, 'ajax', '�ٱ�������Ϣ', {url:"ajax.php?mod=misc&code=report&tid="+tid}, 400);
}

/**
 * Ӧ���е�΢������
 */
function publishSimpleTopic(content, appitem, appitem_id, options)
{
	if (!options) {
		options = {};
	}
	
	if (isUndefined(content) || content == '') {
		MessageBox('warning', '������'+__N_WEIBO__);
		return false;
	}
	
	if (lastPublishSubmitContent == content) {
		// MessageBox('warning', '��Ҫ̰��Ŷ����һ�ξ͹�����');
		// return false;
	} else {
		lastPublishSubmitContent = content;
	}
	
	var topictype = '';
	if (options.topic_type) {
		topictype = options.topic_type;
	} else {
		topictype = 'first';
	}
	
	var from = "web";
	if (options.from) {
		from = options.from;
	} else {
		from = appitem;
	}

	// ��ͼ
	var imageids = '';
	$.each(__IMAGE_IDS__, function(k, v){
		if(v > 0)
		{
			imageids = imageids + ( imageids ? ',' + v : v );
		}
	});
	// �฽��
	var attachids = '';
	$.each(__ATTACH_IDS__, function(k, v){
		if(v > 0)
		{
			attachids = attachids + ( attachids ? ',' + v : v );
		}
	});
	
	// ��ʼ����(��ǰ֧֮�ַ������֣��������Ժ��õ���ʱ�����)
	var myAjax = $.post(
		"ajax.php?mod=topic&code=do_add&act=reply",
		{
			topictype:topictype,
			imageid:imageids,
			attachid:attachids,
			from:from,
			content:content,
			item:appitem,
			item_id:appitem_id
		},
		function (d) {
			if (options.response) {
				options.response.call();
			} else {
				location.reload();
			}
		}
	);
	return true;
}

/**
 * ΢������ѡ��(Ӧ��)
 */
function selectAppTopicType(id, options)
{
	id = (isUndefined(id) ? 'topictype' : id);
	if (!options) {
		options = {};
	}
	
	var input = $("#" + id);
	if (options.toid) {
		out = $('#'+options.toid);
	} else {
		out = input;
	}
	
	// Ĭ�ϵ�΢��������
	var defTopicType = 'reply';
	if (options.defTopicType) {
		defTopicType = options.defTopicType;
	}
	
	if (input.attr("checked")) {
		out.val('first');
	} else {
		out.val(defTopicType);
	}
}

/**
 * ��ȡӦ�û
 */
var __AppActivityHandleKey__ = new Array();
function getAppActivity(appMod, appCode, appWpId, options)
{
	var cache = Cache.get(appWpId);
	if (!isUndefined(cache) && cache.length > 0) {
		$('#'+appWpId).html(cache);
		return ;
	}
	
	if (isUndefined(options)) {
		options = {};
	}
	if (!isUndefined(__AppActivityHandleKey__[appCode])) {
		return ;
	}
	__AppActivityHandleKey__[appCode] = true;
	var arf = '';	// apprequestfrom
	if (options.arf) {
		arf = '&arf='+options.arf;
	}
    var type = '';
    if(options.appType){
        type = '&tab=' + options.appType;
    }
	appUrl = 'ajax.php?mod='+appMod+'&code='+appCode+arf+type;
	var retType = 'html';
	if (options.retType) {
		reType = options.retType;
	}
	$.get(
		appUrl,
		{},
		function(r) {
			if (options.response) {
				options.response.call();
			} else if (appWpId) {
				if (is_json(r)) {
					var json = eval('('+r+')');
					$('#'+appWpId).html(json.msg);
				} else {
					r = evalscript(r);
					$('#'+appWpId).html(r);
					Cache.save(appWpId, r);
				}
			}
		},
		retType
	);
}

/**
 * ��������ɾ��һ��ָ��ֵԪ��(һά����)
 */
function remove_ele(ary, val)
{
	var ary2 = Array();
	for (var i in ary) {
		if (ary[i] != val) {
			ary2[i] = ary[i];
		}
	}
	return ary2;
}

/**
 * ָ��ֵ�Ƿ����������
 */
function in_array(needle, haystack)
{
	if(typeof needle == 'string' || typeof needle == 'number') {
		for(var i in haystack) {
			if(haystack[i] == needle) {
					return true;
			}
		}
	}
	return false;
}

/**
 * �Ƴ��������Ի���
 */
function DelBlackListDialog(uid)
{	
	var handle_key = 'del_my_blacklist';
	showDialog('del_my_blacklist', 'ajax', '�Ƴ�������', {"url":"ajax.php?mod=topic&code=follower_choose&uid="+uid}, 300);	
}

/**
 * ������ҳ�� (�Ƴ�������������
 * 
 * �Ƴ��ҵĺ�����
 */
function DoDelMyBlackList()
{	
	// �Ƿ��ע���û�
	var is_follow = 0;
	
	// �Ƴ������� �û� ID
	var touid = $("#touid").val();
	
	// �ҵ� ID
	var uid = $("#uid").val();
	
	// ��ѡ ��ע���û� ���ӹ�ע
	if($("#is_follow").attr("checked")){	
		// ������עjs
		follow(touid,'','add');
	}
	var myAjax=$.post(
		"ajax.php?mod=topic&code=do_delmyblacklist",
		{
			touid:touid
		},
		function(d){
			if(''!=d){
				$("#follow_user_"+touid).remove();
				// �ر� �Ƴ��ҵĺ������Ի���
				closeDialog('del_my_blacklist');    
			}
		}
	 );
}



/**
 * �޸�����, ���·���������֤�Ի���
 */
function CheckEmailModifyDialog(uid)
{	
	var handle_key = 'del_my_fans';
	showDialog('del_my_fans', 'ajax', '�Ƴ���˿', {"url":"ajax.php?mod=topic&code=del_myfans&uid="+uid}, 300);	
}

// ��΢������ foxis 2011��6��28��
function show_longtext_info_dialog(idval, is_modify, content_id, button_id)
{
	var content_id = 'undefined' == typeof(content_id) ? 'i_already' : content_id;
	var button_id = 'undefined' == typeof(button_id) ? 'publishSubmit' : button_id;
	var titleval = '����������';
	var urlval = 'ajax.php?mod=longtext';
	if(content_id)
	{
		urlval = urlval + '&content_id=' + content_id;
	}
	if(button_id)
	{
		urlval = urlval + '&button_id=' + button_id;
	}
		
	var idval = 'undefined' == typeof(idval) ? 0 : idval;
	var is_modify = 'undefined' == typeof(idval) ? 0 : is_modify;
	
	if(is_modify)
	{
		if(idval < 1)
		{
			MessageBox('warning', '��ָ��һ����ȷ��ID');
			
			return false;
		}
		
		titleval = '�༭������';
		urlval = urlval + '&code=modify&id=' + idval;
	}
	else
	{
		urlval = urlval + '&code=add';
		if(idval)
		{
			urlval = urlval + '&longtext=' + encodeURIComponent(idval);
		}
	}
	
	showDialog('longtext_info_dialog', 'ajax', titleval, {url:urlval}, 600);
}
function close_longtext_info_dialog()
{
	closeDialog('longtext_info_dialog');
}
function view_longtext(idval, tidval, aobj, TPT_id, ptidv)
{

	
	var TPT_id = ('undefined' == typeof(TPT_id) ? '' : TPT_id);
	var ptidv = ('undefined' == typeof(ptidv) ? 0 : ptidv);
	
	var full_id = 'topic_content_' + TPT_id + tidval + '_full';
	var short_id = 'topic_content_' + TPT_id + tidval + '_short';

	if('' != TPT_id) {
		var hash_id = 'topic_list_' + ptidv;
	} else {
		var hash_id = 'topic_list_' + tidval;
	}
	
	var full_html = $.trim(($('#' + full_id).html()));
    var longtext_display = $("#"+full_id).css('display');

	if('block' == longtext_display)
	{
		//$('#' + full_id).empty();
		$('#' + full_id).css('display', 'none');

		//$('#' + hash_id + ' ul.imgList').show();
		$('#' + short_id).css('display', 'block');
		if('undefined' != typeof(aobj))
		{
			if(!isNaN(aobj)){$("#longText_"+aobj).html('�鿴ȫ��');}else{$(aobj).html('��ʾȫ��');}
		}
		window.location.hash = '#' + hash_id;
	}
	else
	{
        if('' != full_html){
            $('#' + short_id).css('display', 'none');
            $('#' + full_id).css('display', 'block');
			
           
				
            if('undefined' != typeof(aobj))
            {   
                if(!isNaN(aobj)){$("#longText_"+aobj).html('����ȫ��');}else{$(aobj).html('���ز���');}
            }
        }else {
            $.post
            (
                'ajax.php?mod=longtext&code=view',
                {
                    'id' : idval,
                    'tid' : tidval,
                    'TPT_id' : TPT_id,
                    'ptidv':ptidv
                },
                function(d)
                {
                    $('#' + short_id).css('display', 'none');
          
                    $('#' + full_id).html(d);
		
					$('#' + full_id + ' img').each(function(){						
						var img_w = $(this).width();
						var img_h = $(this).height();					
						if(img_w>500){
							var new_h = (500*img_h)/img_w; 
							$(this).css({'width':500,'height':new_h});						
						} 

                    });

			
                    $('#' + full_id).css({'display':'block','clear':'both','overflow':'hidden'});
					

					

                    
                    if('undefined' != typeof(aobj))
                    {
                        if(!isNaN(aobj)){$("#longText_"+aobj).html('����ȫ��');}else{$(aobj).html('���ز���');}
                    }
                }
            );
        }
	}
}

/**
 * 
 * @param idval
 *            tid
 * @param sidv
 *            source tid
 */
function view_topic_content(idval, sidv, TPT_id)
{
	var idval = ('undefined'==typeof(idval) ? 0 : idval);
	var sidv = ('undefined'==typeof(sidv) ? 0 : sidv);
	var TPT_id = ('undefined' == typeof(TPT_id) ? '' : TPT_id);

	var sidval = 0;
	if(sidv < 1)
	{
		sidv = idval;
	}
	else
	{
		if( TPT_id.length < 1 )
		{
			TPT_id = 'TPT_';
		}
		
		if(sidv != idval)
		{
			sidval = sidv;
		}
	}
	var topic_view = 'undefined'==typeof(__TOPIC_VIEW__) ? 0 : __TOPIC_VIEW__;
	var short_id = 'topic_content_area_' + TPT_id + idval + '_short';
	var full_id = 'topic_content_area_' + TPT_id + idval + '_full';
	var reply_aid = 'topic_list_reply_' + sidv + '_aid';
	var reply_area_id = 'reply_area_' + sidv;
	var hash_id = 'topic_list_' + sidv;
	
	var full_html = $.trim(($('#' + full_id).html()));
	if('' != full_html)
	{
		hash_id = short_id;
		
		$('#' + full_id).empty();
		$('#' + full_id).css('display', 'none');

		$('#' + short_id).css('display', 'block');
		
		if(($.trim(($('#' + reply_area_id).html()))).length < 1)
		{
			$('#' + reply_aid).click();
		}
	}
	else
	{
		hash_id = full_id;
		
		$.post
		(
			'ajax.php?mod=view&code=topic_content',
			{
				'id' : idval,
				'sid' : sidval,
				'TPT_' : TPT_id,
				'topic_view' : topic_view
			},
			function(d)
			{
				// $('#' + short_id).empty();
				$('#' + short_id).css('display', 'none');
				
				$('#' + full_id).html(d);
				$('#' + full_id).css('display', 'block');
				
				if(($.trim(($('#' + reply_area_id).html()))).length < 1)
				{
					$('#' + reply_aid).click();
				}
			}
		);
	}
	
	window.location.hash = '#' + hash_id;
}


// ѡ��ǩ����Ƥ��
function select_qmd(ci)
{	
	// ѡ��Ƥ����·��
	var c = 'undefined' == typeof(ci) ? '' : ci;

	var myAjax = $.post
	(
		"ajax.php?mod=qmd&code=select",
		{	
			// ǩ��������ͼƬ·��
			qmd_bg_path:c
		},
		function (d) 
		{
			if(d) 
			{
				// $("#skin_images").remove();
				// $('#'+"qmd_list").html('<img src="' + d + '" />');
				;
			}
			if(c != '')
			{
				location.reload();   
			}
		}
	);
	
	return true;
}

// ����ǩ����
function insert_qmd()
{
	
	var myAjax = $.post
	(
		"ajax.php?mod=qmd&code=update",
		{	
			// ǩ��������ͼƬ·��
			qmd_bg_path:'images/qmd.jpg'
		},
		function (d) 
		{
			if(d) 
			{	
				document.write(d);
				 return false;
			}
			
		}
	);
	
	return true;
	
}


/*
 * ע�� �� - ��ע�û�ѡ��
 * 
 */
function reg_follow_user(follow_type,list_limit)
{	
	// ѡ���ע����� ��: �����Ƽ� ��һ��Ӱ��� �ȡ���
	var follow_type = 'undefined' == typeof(follow_type) ? '' : follow_type;

	// �鿴���� ��ʾ����
	var list_limit = 'undefined' == typeof(list_limit) ? '' : list_limit;
	
	$("#left_nav li").each(function(){
		if ($(this).attr('id') == 'nav_'+follow_type) {
			$(this).addClass('on');
		} else {
			$(this).removeClass('on');
		}
	});
	// alert(follow_type); return false;

	var myAjax = $.post
	(
		"ajax.php?mod=topic&code=reg_follow_user",
		{
			followType:follow_type,
			list_limit:list_limit
		},
		function (d) 
		{ // alert(d); return false;
			if(d) 
			{
				$('#'+"reg_follow_user").html(d);     
			}
			// location.reload();
		}
	);
	
	return true;
}

/**
 * �޸� ����ǩ�� by zx cid = input �����ID ��ȡ�������Ϣ
 */

function modify_user_signature(uid,cid,return_type)
{	
	// ��ȡ����� ����ǩ������
	var signature = $("#"+cid).val();
	var signature = 'undefined' == typeof(signature) ? '' : signature;

	var myAjax = $.post
	(
		"ajax.php?mod=topic&code=modify_user_signature",
		{	
			uid:uid,
			signature:signature
			
		},
		function (d) 
		{
			if(d.done) {
				 $('*.[ectype=\"user_signature_ajax_' + uid + '\"]').html("(" + d.msg + ")"); 
				 $('*.[ectype=\"user_signature_ajax_left_' + uid + '\"]').html("(" + d.msg + ")"); 
				 show_message('����ǩ���޸ĳɹ�',1);  
			}
			else{
				 show_message(d.msg,2);  
			}      
		},'json'
	);
	
	return true;
	
	alert(signature);return false;
}

/**
 * �޸� ���� ����ѡ��״̬
 * 
 * uid �޸������������л����û�UID web_style ��(��ǰ��¼���û�) ѡ��ķ���״̬��ʽ get_code ��ǰҳ�� URL��ַ�� code
 * ��ajax��ʾҳ�� ���ж���ʾģ������ ajax_list ��ʾ�����Ǹ�ajaxģ������Ϊ��ʾ����ģ�� list_uid �����û���Ϣʱ ��ʾ��UID
 * 
 */


function web_list_type(uid,web_style,get_code,ajax_list,list_uid)
{      
	  var style_three_tol = 'right' == ajax_list ? 1 : 0;
	  
	  // loading box
	  showDialog('loading', 'local', '��ʾ', {'html':'<p class="loading" style="padding:15px 20px 15px 30px; font-size:14px;background-color:#fff;text-indent:30px;">�����л��У����Ժ�...</p>'},300);
	  // ִ���޸�
	  modify_user_stely_mod(uid,style_three_tol,get_code,ajax_list,list_uid,function(rpsdata){
	  // ��ǰ״̬����
	  if(style_three_tol == 1)
		 {	
		  var type_html = '<a href="javascript:void(0);" onclick="web_list_type(\'' + uid + '\',\'0\',\'' + get_code + '\',\'left\',\'' + list_uid + '\'); return false;">����</a> ';            		
			 $("#web_list_type_"+uid).html(type_html);
			 $('#web_style').val('0');
		 }
		 
	  // ��ǰ״̬����
		 if(style_three_tol == 0)
		 {	 
			 var type_html = '<a href="javascript:void(0);" onclick="web_list_type(\'' + uid + '\',\'1\',\'' + get_code + '\',\'right\',\'' + list_uid + '\'); return false;">����</a> ';           		
			 $("#web_list_type_"+uid).html(type_html);
			 $('#web_style').val('1');
		 }
		 location.reload();//ִ�к�ˢ�µ�ǰҳ
	  });
}


function modify_user_stely_mod(uid,style_three_tol,get_code,ajax_list,list_uid,callback)
{
	if(uid == ''){	
		ShowLoginDialog();
	}
	// style_three_tol = ���� ���� ���� ״̬
	var type = $('#hid_type').val();
	var myAjax = $.post
	(
		"ajax.php?mod=user&code=modify_user_three_tol",
		{uid:uid,
			style_three_tol:style_three_tol,
			get_code:get_code,
			ajax_list:ajax_list,
			list_uid:list_uid,
			type:type
		},
		function (d) 
		{ 
			callback(d);
		}
	);
	
	return true;
	
}


/**
 * δ��¼��������¼�Ի���
 */
function ShowLoginDialog(ref)
{
	var handle_key = 'del_show_login';
	var ref = ('undefined' == typeof(ref) ? window.location.href : ref);
	var isreg = (ref==1) ? 1 : 0;
	showDialog(handle_key, 'ajax', '', {"url":"ajax.php?mod=topic&code=showlogin&referer=" + encodeURIComponent(ref) + "&isreg=" + isreg}, 650);	
}

/**
 * �ұ��� ajax ��ʾ�û��������
 * 
 * @param uid
 * @param showCode
 *            ajax�� code��ʾ��ģ��
 * @return
 */
function right_show_ajax(uid,showCode,ajax_list,ajax_mod)
{	
	var ajax_mod = 'undefined' == typeof(ajax_mod) ? '' : ajax_mod;
	
	var ajax_url = '';
	if (showCode == 'my_qun') {
		ajax_url = "ajax.php?mod=qun&code=widgets&op=my_qun&type=2";
	} 
	else if(showCode == 'recommend')
	{
		ajax_url = "ajax.php?mod=dig&code=ajax";
		ajax_mod = showCode;
	}
	else if(showCode == 'recommend20')
	{
		ajax_url = "ajax.php?mod=dig&code=ajax";
		ajax_mod = showCode;
	}
	else if(ajax_mod == 'validate')
	{
		ajax_url = "ajax.php?mod=validate&code="+showCode;
	}
	else {
		ajax_url = "ajax.php?mod=user&code="+showCode;
	}
	var post = {
		uid:uid,
		type:ajax_mod
	};
	
	var myAjax=$.post(
	ajax_url,
	post,
	function(d){
		if(d){
			$('#'+uid+"_"+ajax_list).html(evalscript(d));
		}
	});
	return false;
}

function channel_right_show_ajax(type,id,uid,num)
{	
	var id = 'undefined' == typeof(id) ? 0 : id;var uid = 'undefined' == typeof(uid) ? 0 : uid;var num = 'undefined' == typeof(num) ? 10 : num;
	if('undefined' != typeof(type)){var myAjax=$.post("ajax.php?mod=dig&code=ajax",{type:type,id:id,uid:uid,num:num},function(d){if(d){$('#'+type).html(evalscript(d));}});}
	return false;
}


/**
 * ��ʾ��֤��
 */
function seccode(options)
{
	if (typeof options == 'undefined' || options == null || options == '') {
		options = {};
	}
	var updateFunc = "updateSeccode";
	var id = null;
	if (options.updateFunc) {
		updateFunc = options.updateFunc;
	} else {
		if (options.id) {
			id = options.id;
		}
	}
	var img_id = "img_seccode";
	if (options.img_id) {
		img_id = options.img_id;
	}
	var img = 'index.php?mod=other&code=seccode&random='+Math.random();
	var html = '<img id="'+img_id+'" src="'+img+'" align="absmiddle" onclick="'+updateFunc+'(\''+id+'\',\''+img_id+'\');">';
	if (options.wp) {
		$('#'+options.wp).html(html);
	} else {
		document.writeln(html);
	}
}

/**
 * ������֤��
 */
function updateSeccode(id, img_id)
{
	if (isUndefined(img_id)) {
		var img_id = "img_seccode";
	}
	var img = 'index.php?mod=other&code=seccode&random='+Math.random();
	$('#'+img_id).attr("src", img);
	if (typeof id != 'undefined' && id != null && id != '') {
		$('#'+id).val('');
	}
}

/**
 * ��ʾ��֤��У��Ի���
 */
function showSeccodeDialog()
{
	var handle_key = 'handle_key_seccode_dialog';
	showDialog(handle_key, 'ajax', '�벹������ĵ�¼��Ϣ', {url:"ajax.php?mod=misc&code=seccode&random="+Math.random()}, 300);
}

/**
 * У����֤�� Ӧ����һ�������У��ģ�飬��ʱ�������ˡ�
 */
function checkSeccode(seccode, options)
{
	if (isUndefined(options)) {
		options = {};
	}
	
	var tips_id = "check_seccode_tips";
	if (options.tips_id) {
		tips_id = options.tips_id;
	}
	
	$.post(
		'ajax.php?mod=member&code=check_seccode',
		{"check_value":seccode},
		function(r) {
			if (false == r.done) {
				$("#"+tips_id).html('<img src="static/image/regwrong.png" >');
				$("#"+tips_id).show();
			} else {
				$("#"+tips_id).html('<img src="static/image/accept.png" >');
				$("#"+tips_id).show();
				if (options.success) {
					options.success.call();
				}
			}
		},'json'
	);
}

/**
 * ��ʾ������ע����Ի���
 */
function showFollowGroupAddDialog()
{
	var handle_key = 'hk_follow_group_add_dialog';
	showDialog(handle_key, 'ajax', '��������', {url:"ajax.php?mod=topic&code=create_group"}, 300);
	
	// ���ùر��¼�����
	/*
	 * setDialogOnCloseListener(handle_key, function(){ if
	 * (__AddFansGroupSuccess__ == true) { location.reload();
	 * __AddFansGroupSuccess__ = false; } });
	 */
}

/**
 * ��ȡӦ������widgets
 */
function getAppDescriptionWidgets(type, options)
{
	if (isUndefined(type)) {
		return false;
	}
	
	if (isUndefined(options)) {
		options = {};
	}
	
	var get = {};
	var ajax_url = "";
	
	if (type == 'qun') {
		ajax_url = "ajax.php?mod=qun&code=widgets&op=simple_desc";
		if (options.item_id) {
			get = {"qid":options.item_id};
		} else {
			return false;
		}
	} else {
		return false;
	}
	var myAjax = $.get(
		ajax_url,
		get,
		function(d) {
			if (d) {
				if (options.success) {
					options.success.call(d);
				} else {
					// Ĭ�����app_description_wp
					$("#app_description_wp").html(d);
				}
			}
		}
	);
	return true;
}

// ��ȡͶƱ����
function getVoteDetailWidgets(tid, vid)
{
	var imgDetail = $("#vote_detail_"+tid);
	var area = $("#vote_area_"+tid);
	var content = $("#vote_content_"+tid);
	imgDetail.hide();
	content.html('<div style="text-align:center; margin-top:10px;"><img src="./images/loading.gif" /></div>');
	area.show();
	var myAjax = $.post(
		'ajax.php?mod=vote&code=detail',
		{vid:vid,tid:tid},
		function(r) {
			content.html(r);
			$('#close_vote_detail_'+tid).click(function(){
				closeVoteDetailWidgets(tid);
			});
		}
	);
	return false;
}

//��ע��ȡ��ͶƱ����
function mod_follow_vote(follow,uid,vid){
	var follow = follow ? 1 : 0;var myAjax = $.post("ajax.php?mod=vote&code=follow_vote",{uid:uid,vid:vid,follow:follow},function(){}); 
}

//��ȡ�н�ת������
function getRewardDetailWidgets(tid,rid,thisId){
	if(thisId!=undefined){
		thisId = "_"+thisId;
	}else{
		thisId = "";
	}
	var imgDetail = $("#reward_detail_"+tid+thisId);
	var area = $("#reward_area_"+tid+thisId);
	
	var content = $("#reward_content_"+tid+thisId);
	imgDetail.hide();
	content.html('<div style="text-align:center; margin-top:10px;"><img src="./images/loading.gif" /></div>');
	area.show();
	var myAjax = $.post(
		'ajax.php?mod=reward&code=detail',
		{rid:rid,tid:tid},
		function(r) {
			content.html(r);
			$('#close_reward_detail_'+tid).click(function(){
				closeRewardDetailWidgets(tid,thisId);
			});
		}
	);
	return false;
}

function closeRewardDetailWidgets(tid,thisId){
	
	var imgDetail = $("#reward_detail_"+tid+thisId);
	var area = $("#reward_area_"+tid+thisId);
	imgDetail.show();
	area.hide();
}

// �ر�ͶƱ����
function closeVoteDetailWidgets(tid)
{
	var imgDetail = $("#vote_detail_"+tid);
	var area = $("#vote_area_"+tid);
	imgDetail.show();
	area.hide();
}

// ����ͶƱ
function doVote(form, options)
{
	//alert('#vote_form_'+options.tid);
	
	if (isUndefined(options)) {
		var options = {};
	}
	
	var form_name = form;
	var post_data = $('#'+form_name).serialize();
	var action = $('#'+form_name).attr("action");
	if (action) {
		$.post(
			action, 
			post_data, 
			function(r){
				if (!is_json(r)) {
					if (options.type == 'topic') {
						if (r != '') {
							$('#vote_main_'+options.tid).html("ͶƱ�ɹ���˳��������");
							var handle_key = "hk_toweibo";
							showDialog(handle_key, 'local', '����һ��', {'html':r}, 500);
							$('#topic_simple_close_btn'+options.tid).click(
								function() {
									closeDialog(handle_key);
								}
							);
							$('#topic_simple_share_btn'+options.tid).click(
								function () {
									var response = function() {
										// location.reload();
										closeDialog(handle_key);
										listAreaPrependTopic();
									};
									publishSimpleTopic($('#topic_simple_content'+options.tid).val(), 'vote', $("#topic_simple_item_id"+options.tid).val(), {response:response,topic_type:$('#topic_simple_type'+options.tid).val()});
									// publishSimpleTopic($('#topic_simple_content'+options.tid).val(),
									// '', 0, {response:response});
								}
							);
						}
					}
				} else {
					var json = eval('('+r.toString()+')');
					if (json.done == true) {
						if (options.type == 'topic') {
							$("#vote_publish_tips_"+options.tid).html(json.msg);
							$("#vote_publish_tips_"+options.tid).show();
							$('#vote_main_'+options.tid).hide();
						} else {
							MessageBox('notice', json.msg);
						}
					} else {
						if (options.type == 'topic') {
							$("#vote_publish_tips_"+options.tid).html(json.msg);
							$("#vote_publish_tips_"+options.tid).show();
						} else {
							MessageBox('warning', json.msg);
						}
					}
				}
			}
		);
	}
}

/**
 * ��̬����js
 */
function loadJs(file)
{
	var head = $('head');
	$("<scri"+"pt>"+"</scr"+"ipt>").attr({src:file,type:'text/javascript',id:'load'}).appendTo(head);
}
/*
 * ����
 */
function post_class(){
	showDialog('pclass', 'ajax', '����������Ϣ', {"url":"ajax.php?mod=class&code=classpost"}, 800);	
}

// ΢���Ƽ��Ի���
function showTopicRecdDialog(options)
{
	if (isUndefined(options)) {
		var options = {};
	}
	
	// ������
	var checkerror = function(data) {
		if (is_json(data)) {
			var json = eval('('+data.toString()+')');
			closeDialog(handle_key);
			MessageBox('warning', json.msg, '��ʾ');
			return false;
		}
		return true;
	};
	//var handle_key = options.tid ? "hk_tr_dialog_"+options.tid : "hk_tr_dialog";
	var handle_key = "tj_"+Date.parse(new Date());
	var ajax_url = "ajax.php?mod=topic&code=recd&tid="+options.tid;
	if (options.tag_id) {
		ajax_url += "&tag_id="+options.tag_id;
	}
	showDialog(handle_key, "ajax", "�Ƽ�", {'url':ajax_url, checkerror:checkerror}, 350);
}

// �Ƽ�΢��
function recdTopic(handle_key, form, tid, uid)
{
	var post_data = $('#'+form).serialize();
	$.post(
		"ajax.php?mod=topic&code=do_recd", 
		post_data, 
		function(r){
			if (r.done) {
				closeDialog(handle_key);
				var s = r.msg;var str= s.split('|||');
				MessageBox('notice', str[1], '��ʾ');
				if(str[0] == 0){
					if($('#ajax_recommend').children('#topic_list_'+tid).length > 0){ajax_recd_colse();}
					$('.recd_img_'+tid+',.recd_r_img_'+tid).html('');
				}else if(str[0] == 1){
					$('.recd_img_'+tid).html('<a href="index.php?mod=topic&code=recd"><img onmouseover="javascript:showrcduser();" class="showrcduser" value="'+tid+'" src="images/recommend.gif"></a>');
					$('.recd_r_img_'+tid).html('<img src="images/recommend.gif">');
				}
				ajax_recommend(uid);
			} else {
				MessageBox('warning', r.msg, '��ʾ');
			}
		},
		'json'
	);
}

// �����Զ����
function Autocompleter(handle_key, url, options)
{
  if (typeof options == 'undefined') {
	options = {};
  }
  var autocompleter = new JSGST_Autocompleter();
  autocompleter.handle_key = handle_key;
  autocompleter.url = url;
  if (options.item_list_tips) {
	autocompleter.item_list_tips = options.item_list_tips;
  }
  if (options.formatItemCallback) {
	autocompleter.formatItemCallback = options.formatItemCallback;
  }
  if (options.resultCallback) {
	autocompleter.resultCallback = options.resultCallback;
  }
  return autocompleter;
}



// ɾ������
function deleteFollowGroup(gid)
{
	options = {
		'onClickYes':function(){
			location.href = "index.php?mod=other&code=groupdelete&gid="+gid;
		}
	};
	MessageBox('confirm', "��ȷ��ɾ�����������", '��ʾ', options);
}

/**
 * ��ʾ�޸ķ������ƶԻ���
 */
function showFollowGroupModifyDialog(options)
{
	if (isUndefined(options)) {
		options = {};
	}
	var handle_key = "hk_follow_group_modify_dialog";
	showDialog(handle_key, 'local', '�޸ķ�������', {"id":"modify_group"}, 300);
}

// ctrl+enter����
function ctrlEnter(event, btnId, onlyEnter)
{
	if(isUndefined(onlyEnter)) onlyEnter = 0;
	if((event.ctrlKey || onlyEnter) && event.keyCode == 13) {
		$('#'+btnId).click();
		// $('#'+btnId).triggerHandler("click");
		return false;
	}
	return true;
}

// ֻ�����������֣�������������
function allowNumeric(obj)
{
	obj.value = obj.value.replace(/[^0-9]/g,'');
}


// ���÷����ύ
function setGroupSubmit(uid)
{
	var r = $('#qremark_name_'+uid);
	var remark = r.val();
	
	var myAjax = $.post(
		"ajax.php?mod=remark&code=add_buddy_remark",
		{
			remark:remark,
			buddyid:uid
		},
		function (d) {
			if(d) {
				$('#'+"remarklist_"+uid).html(d);
			} else {
				if(remark) {
					$('#'+"remarklist_"+uid).html('(' + remark + ')');
				} else {
					$('#'+"remarklist_"+uid).html('');
				}
			}                
		}
	);
	var handle_key = "global_select_"+uid;
	closeDialog(handle_key);
}

/**
 * ��ȡ�ҵĺ����б�
 */
function getMyFollowUser(page, options)
{
	if (isUndefined(options)) {
		options = {};
	}	
	var myAjax = $.post(
			"ajax.php?mod=pm&code=pm_follow_user",
			{
				page:page
				
			},
		function(d) {
				alert(d);
		}
	);
}

function onFoucsReplyInput(tid)
{
	var input = $("#reply_content_"+tid);
	var h = $("#topic_lists_"+tid);
	if (h.length > 0) {
		$("html,body").animate({scrollTop: h.offset().top-40}, 1000, 'swing', function(){input.focus();});
	} else {
		input.focus();
	}
}





// ��ѡ��ť , ������ �� ��ѡ�� ѡ��״̬
/*
 * ʹ�÷�����
 * 
 * <input id="input_id" value="1" checked="checked" type="radio" /> <input
 * id="input_id" value="0" checked="checked" type="radio" /> <script
 * language='JavaScript'
 * type="text/javascript">autoSelected(document.formInfo.input_id, '$val');</script>
 * 
 * ���� @ formInfo = form��ID @ input_id = ��ѡ��ť �� ��ѡ�� �� ������ id @ $val = �ѱ���ĸ�ѡ���ֵ
 * �磺 0 , 1 �� $vla = 1 ѡ��ֵΪ 1 ��״̬ zx
 */
function autoSelected(obj, defVal)
{
	if(!obj) return;
	
	if((typeof defVal).toLowerCase() != 'object')
	{
		var tmp = defVal;
		
		defVal = new Array();
		defVal[0] = tmp;
	}
	
	if(obj.tagName)
	{
		switch(obj.tagName.toLowerCase())
		{
			case 'select':
					for(var i = 0; i < obj.length; i++)
					{
						if(in_array(obj.options[i].value, defVal))
						{
							obj.options[i].selected = true;
						}
					}
			case 'input':
					if(obj.type.toLowerCase() == 'checkbox' || obj.type.toLowerCase() == 'radio')
					{
						if(in_array(obj.value, defVal))
						{
							obj.checked = true;
						}
					}
					break;
		}
	}
	else
	{
		for(var i = 0; i < obj.length; i++)
		{
			if(obj[i].tagName.toLowerCase() == 'select')
			{
				for(var j = 0; j < obj[i].length; j++)
				{
					if(in_array(obj[i].options[j].value, defVal))
					{
						obj[i].options[j].selected = true;
					}
				}
			}
			else if(obj[i].tagName.toLowerCase() == 'input')
			{
				if(in_array(obj[i].value, defVal))
				{
					obj[i].checked = true;
				}
			}
		}
	}
}


/*
 * ajax ����ѫ����ϸ��Ϣ
 */ 

function check_medal_list(uid,member_id,medal_type)
{
	
	var uid = 'undefined' == typeof(uid) ? '0' : uid;
	var member_id = 'undefined' == typeof(member_id) ? '0' : member_id;
	var medal_type = 'undefined' == typeof(medal_type) ? '' : medal_type;
	
	var myAjax=$.post(
		"ajax.php?mod=topic&code=check_medal_list",
		{
			uid:uid,
			member_id:member_id,
			medal_type:medal_type
		},
		function(d){
			if(''!=d){
				
				// alert(d);
				if(medal_type != '')
				{
					$('#'+"user_medal_list_"+uid+"_"+medal_type).html(d);
				}
				else
				{
					$('#'+"user_medal_list_"+uid+"_"+member_id).html(d);
				}
				
			
				// closeDialog('del_my_blacklist');
			}
		}
	 );
}

// ajax��ʾͶƱ��Ϣ
function vote_ajax_menu(vid,uid)
{
	var uid = 'undefined' == typeof(uid) ? 0 : uid;
	var template = 'undefined' == typeof(template) ? '' : template;
	var handle_key = "alert_follower_menu_"+uid;
	var ajax_url = 'ajax.php?mod=validate&code=validate_vote';
	var post = {
					uid:uid,
					vid:vid

				};
	var title = "��������..."; 
	
	showDialog(handle_key, 'ajax', title, {"url":ajax_url, "post":post}, 620);
	
		
}

/**
 * ��ȡ��̸���ʼα��б�
 */
function askmenuajax(){
	var obj = '.askToDiffZone';var left = 0;var top = 0;
	if($(obj).length){
		$('.askToDiff').hover(function(){left = $(this).offset().left - 1 + 'px';top = $(this).offset().top + 22 +'px';$(obj).css('left',left);$(obj).css('top',top);$(obj).show();$(obj).hover(function(){$(obj).show();},function(){$(obj).hide();});},function(){$(obj).hide();});			
	}
}


/**
 * ͼƬ��̬����
 */
function loadphoto(uid)
{
	var loadmsg = '<div class="boutique_load"><span>���ڼ��أ����Ժ�...</span></div>';
	var uid = 'undefined' == typeof(uid) ? 0 : uid; 
	if(isLoading){
		$('#boutique_load').html(loadmsg);onloading = true;
		var myAjax = $.post('ajax.php?mod=topic&code=photo',{page:photopagenum,uid:uid},function (d){if('' != d){var s=d.split('<jishigou>');var n=s.length;if(n>4){n=4;}for(var i=0;i<n;i++){$('#phototopic_'+i).append(s[i]);}photopagenum++;if(n<4){isLoading = false;$('#boutique_load').html('');}else{$('#boutique_load').html(photoloadmsg);onloading = false;}}else{$('#boutique_load').html('');isLoading = false;}});
	}else{
		$('#boutique_load').html('');
	}
}

/**
 * ΢����̬����
 */
function loadtopic(key,order,kill)
{
	var loadmsg = '<div class="pageStyle"><div class="loading">���ڼ��أ����Ժ�...</div></div>';
	var key = 'undefined' == typeof(key) ? 0 : key;
	var order = 'undefined' == typeof(order) ? '' : order;
	var kill = 'undefined' == typeof(kill) ? 0 : kill;
	if(isLoading && key){
		$('#pageinfo').html(loadmsg);onloading = true;$("#pagehtml").hide();
		var myAjax = $.post('ajax.php?mod=topic&code=ajax',{key:key,order:order,kill:kill},function (d){if('' != d){$('#ajaxtopic').append(d);ajaxnum++;}else{isLoading = false;$("#pagehtml").show();}onloading = false;$('#pageinfo').html('');});
	}else{
		$('#pageinfo').html('');$("#pagehtml").show();
	}
}

/**
 * ΢����
 */
 function topicdig(tid,uid,dig,name,comt)
 {
	var check_uid = $('#check_PublishBox_uid').val();check_uid ='undefined'==typeof(check_uid)?'0':check_uid;var comt ='undefined'==typeof(comt)?1:0;
	if(check_uid < 1){ShowLoginDialog();return false;}
	var tid = 'undefined' == typeof(tid) ? 0 : tid;var uid = 'undefined' == typeof(uid) ? 0 : uid;var dig = 'undefined' == typeof(dig) ? 0 : dig;var name = 'undefined' == typeof(name) ? '��' : name;
	if(tid > 0 && uid > 0){
		var myAjax = $.post('ajax.php?mod=dig&code=dig',{tid:tid,uid:uid},function (d){if('' != d){var s= d.split(',');if('not'==s[0]){show_message('�����ܶ��Լ��ġ�'+__N_WEIBO__+'�����ۡ�Ͷ'+name,1,'��ʾ','msgBox','msg_alert');}else if('no'==s[0]){show_message('���Ѿ�'+name+'�����벻Ҫ�ظ�����',1,'��ʾ','msgBox','msg_alert');}else if('yes'==s[0]){dig=parseInt(dig)+1;show_message('лл����֧�֣�'+s[1]);$('.topicdig_'+tid).html(name+'ԭ��'+'('+dig+')');$('#topicdig_'+tid).html('&nbsp;('+dig+')');$('.topicdig_'+tid).attr("value",tid);$('.topicdig_'+tid).attr("rel",dig);Cache.save('dig_'+tid,null);}}if(comt && $.trim($('#reply_area_'+tid).html()).length<1){$('#topic_list_reply_'+tid+'_aid').click();}});
	}
 }

 /**
 * ΢��������ʾ�����û�
 */
function showdiguser(){
	var id = "topicdiguser";if($('#'+id).length==0){$(document.body).append("<div id='"+id+"' />");}
	if($('.digusers').length){
		$('.digusers').hover(function(){var tid = $(this).attr("value");var num = $(this).attr("rel");var _cache_id = 'dig_'+tid;var position = $(this).offset();if(num > 0){$('#'+id).css({position:"absolute",'z-index':199,left:position.left,top:position.top+16});}if(Cache.get(_cache_id)!=null){$('#'+id).html(Cache.get(_cache_id));$('.digusername').show();}else{var myAjax = $.post("ajax.php?mod=dig&code=user",{tid:tid,num:num},function (d){if(''!=d) {Cache.save(_cache_id,d);$('#'+id).html(Cache.get(_cache_id));$('.digusername').show();}});}},function(){$('.digusername').hide();});			
	}
}

 /**
 * ���Ƽ�΢��������ʾ�Ƽ��˼��Ƽ�ʱ��
 */
function showrcduser(){
	var id = "topicrcduser";if($('#'+id).length==0){$(document.body).append("<div id='"+id+"' />");}
	if($('.showrcduser').length){
		$('.showrcduser').hover(function(){var tid = $(this).attr("value");var _cache_id = 'rcduser_'+tid;var position = $(this).offset();$('#'+id).css({position:"absolute",'z-index':199,left:position.left-420,top:position.top-12});if(Cache.get(_cache_id)!=null){$('#'+id).html(Cache.get(_cache_id));$('.rcdusername').show();}else{var myAjax = $.post("ajax.php?mod=dig&code=rcduser",{tid:tid},function (d){if(''!=d) {Cache.save(_cache_id,d);$('#'+id).html(Cache.get(_cache_id));$('.rcdusername').show();}});}},function(){$('.rcdusername').hide();});			
	}
}

/**
 * topicManage.js
 */
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

//����վ����Ϣ����ݷ�����
function PmSend(touid,to_user,eid,pmid)
{
	if ($('#message').length > 0) {
		$("html,body").animate({scrollTop: $("#message").offset().top-40}, 1000, 'swing', function(){$('#message').focus();});
		return false;
	}
	var eid='undefined'==typeof(eid)?'Pmsend_to_user_area':eid;
	var to_user='undefined'==typeof(to_user)?'':to_user;
	var handle_key = eid;
	var ajax_url = "ajax.php?mod=pm&code=send";
	var title = "����"+to_user+"����˽��";
	var post = {"to_user":to_user,
				 touid : touid,
				 pmid : pmid};
	showDialog(handle_key, 'ajax', title, {"url":ajax_url, "post":post}, 590);
}

function PmSubmit(i,eid,to_user,topmid, options)
{
	var i='undefined'==typeof(i)?0:i;
	if (isUndefined(options)) {
		options = {};
	}
	var to_user = (''==$('#to_user').val() ? to_user : $('#to_user').val());
	
	var sysTip = false;
	if (options.sysTip) {
		sysTip = true;
	}
	
	var message=document.getElementById("message").value;
	var pmid = $('#pmid').val();

	if(''==message) {
		if (sysTip) {
			alert('������˽������');
		} else {
			show_message('������˽������',1);
		}
		return false;
	}
	//��ͼ
	var imageids = '';
	$.each(__IMAGE_IDS__, function(k, v) {
		if(v > 0) {
			imageids = imageids + ( imageids ? ',' + v : v );
		}
	});
	// �฽��
	var attachids = '';
	$.each(__ATTACH_IDS__, function(k, v){
		if(v > 0)
		{
			attachids = attachids + ( attachids ? ',' + v : v );
		}
	});

	// $("#"+eid).remove();
	if (!closeDialog(eid)) {
		$("#"+eid).remove();
	}
	var YinXiangMa_challenge = $("#YinXiangMa_challenge").val();
	var YXM_level = $("#YXM_level").val();
	var YXM_input_result = $("#YXM_input_result").val();
	var myAjax=$.post("ajax.php?mod=pm&code=do_add",
	{
		pmid:i,
		message:message,
		to_user:to_user,
		topmid:topmid,
		pmid:pmid,
		imageids:imageids,
		attachids:attachids,
		YinXiangMa_challenge:YinXiangMa_challenge,
		YXM_level:YXM_level,
		YXM_input_result:YXM_input_result
	},

		function(d){
			if(''!=d)
			{
				show_message(d);return false;
			}else{
				if(pmid){
					show_message('˽�ŷ��ͳɹ�',1);
					closeDialog('sendagain');
					$('#outbox_'+pmid).remove();
				}else if (sysTip) {
					alert('˽�ŷ��ͳɹ�');
				} else {
					show_message('˽�ŷ��ͳɹ�',1);
				}
				if (options.success) {
					options.success.call();
				}
				__IMAGE_IDS__ = {};
				__ATTACH_IDS__ = {};
				$('.menu_tqb').hide();
				$('.menu_fjb').hide();
			}
		}
	);
}

function sendMsg(to){
	var to_user = $('#to_user').val();
	if('' == to_user){
		show_message("û�з��Ͷ���Ŷ");return false;
	}
	var message = $('#message').val();
	if('' == message){
		show_message("û�з�������Ŷ");return false;
	}
	if($('#outbox').val()){
		var outbox = document.getElementById('outbox').checked ? 1 : 0;
	}
	
	$('#msg').val('˽�ŷ����У����Ե�...');
	
	//��ͼ
	var imageids = '';
	$.each(__IMAGE_IDS__, function(k, v) {
		if(v > 0) {
			imageids = imageids + ( imageids ? ',' + v : v );
		}
	});
	// �฽��
	var attachids = '';
	$.each(__ATTACH_IDS__, function(k, v){
		if(v > 0)
		{
			attachids = attachids + ( attachids ? ',' + v : v );
		}
	});
	var YinXiangMa_challenge = $("#YinXiangMa_challenge").val();
	var YXM_level = $("#YXM_level").val();
	var YXM_input_result = $("#YXM_input_result").val();
	
	$.post(
		'ajax.php?mod=pm&code=do_add',
		{
			to_user:to_user,
			message:message,
			save_to_outbox:outbox,
			imageids:imageids,
			attachids:attachids,
			to_admin: $('#to_admin').val(),
			to_admin_id: $('#to_admin_id').val(), 
			YinXiangMa_challenge:YinXiangMa_challenge,
			YXM_level:YXM_level,
			YXM_input_result:YXM_input_result
		 },
		function(d){
			if(''!=d)
			{
				show_message(d);return false;
			}else if (to) {
				if(outbox == 1){
					location.href="index.php?mod=pm&code=list&folder=outbox";
				}else {
					location.href="index.php?mod=pm&code=list";
				}
			}else{
				__IMAGE_IDS__ = {};
				__ATTACH_IDS__ = {};
				$('.menu_tqb').hide();
				$('.menu_fjb').hide();
				msgList();
			}
		}
	);
}

function checkUsername(username){
	if(!username || username == ''){
		$('#username_tip').html('�������ʺ�');
		$('#username_tip').show();
		$('#username_input').css({'background-color':'#FDEFEF'});
		$('#username_tip').addClass('username_tip_error');
		$('#username_tip').css({'width':'auto','margin-top':'-22px'});
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
				$('#username_input').css({'background-color':'#FDEFEF'});
				$('#username_tip').addClass('username_tip_error');
				$('#username_tip').css({'width':'auto','margin-top':'-22px'});
	    		$('.btn_login').attr('disabled',true);
				
	    	} else {
	    		$('#username_tip').show();
				$('#username_input').css({'background-color':'#fff','border-color':'#d2d2d2'});
				$('#username_tip').removeClass('username_tip_error');
				$('#username_tip').css({'width':'25px','right':'0','margin':'4px 4px 0 0','text-align':'right'});
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
		$('#username_tip').html('�������ʺ�');
		$('#username_tip').show();
		$('#username_input').css({'background-color':'#FDEFEF'});
		$('#username_tip').addClass('username_tip_error');
		$('#username_tip').css({'width':'auto'});
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
				$('#username_input').css({'background-color':'#FDEFEF'});
				$('#username_tip').addClass('username_tip_error');
				$('#username_tip').css({'width':'auto'});
	    		$('.btn_login').attr('disabled',true);
				
	    	} else {
	    		$('#username_tip').show();
				$('#username_input').css({'background-color':'#fff'});
				$('#username_tip').removeClass('username_tip_error');
				$('#username_tip').css({'width':'25px','display':'inline'});
	    		var html = "<img sr" + "c='" + d.msg+  "' onerror='javascript:faceError(this);' class='u-reg-login'/>";
	    		$('#username_tip').html(html);
	    		$('.btn_login').attr('disabled',false);
	    	}
	    },
	    'json'
	)
}






//ͶƱ ��ͼ��չ���رղ���ҳ�涨λ start

function intval(v){
	v = parseInt(v);
	return isNaN(v) ? 0 : v;
}

function getPos(e){
	var l = 0;
	var t  = 0;
	var w = intval(e.style.width);
	var h = intval(e.style.height);
	var wb = e.offsetWidth;
	var hb = e.offsetHeight;
	while (e.offsetParent){
		l += e.offsetLeft + (e.currentStyle?intval(e.currentStyle.borderLeftWidth):0);
		t += e.offsetTop  + (e.currentStyle?intval(e.currentStyle.borderTopWidth):0);
		e = e.offsetParent;
	}
	l += e.offsetLeft + (e.currentStyle?intval(e.currentStyle.borderLeftWidth):0);
	t  += e.offsetTop  + (e.currentStyle?intval(e.currentStyle.borderTopWidth):0);
	return {x:l, y:t, w:w, h:h, wb:wb, hb:hb};
}

function getScroll(){
	var t, l, w, h;
	if (document.documentElement && document.documentElement.scrollTop) {
		t = document.documentElement.scrollTop;
		l = document.documentElement.scrollLeft;
		w = document.documentElement.scrollWidth;
		h = document.documentElement.scrollHeight;
	} else if (document.body) {
		t = document.body.scrollTop;
		l = document.body.scrollLeft;
		w = document.body.scrollWidth;
		h = document.body.scrollHeight;
	}
	return {t: t, l: l, w: w, h: h};
}

function scroller(el, duration){
	if(typeof el != 'object') {el = document.getElementById(el);}
	if(!el) return;
	var z = this;
	z.el = el;
	z.p = getPos(el);
	z.s = getScroll();
	z.clear = function(){window.clearInterval(z.timer);z.timer=null};
	z.t=(new Date).getTime();
	z.step = function(){
		var t = (new Date).getTime();
		var p = (t - z.t) / duration;
		if (t >= duration + z.t) {
			z.clear();
			window.setTimeout(function(){z.scroll(z.p.y, z.p.x)},13);
		} else {
			st = ((-Math.cos(p*Math.PI)/2) + 0.5) * (z.p.y-z.s.t) + z.s.t;
			sl = ((-Math.cos(p*Math.PI)/2) + 0.5) * (z.p.x-z.s.l) + z.s.l;
			z.scroll(st, sl);
		}
	};
	z.scroll = function (t, l){window.scrollTo(l, t)};
	z.timer = window.setInterval(function(){z.step();},13);
}

//ͶƱ ��ͼ��չ���رղ���ҳ�涨λ end

/**
 * �Զ�չ������
 */
function TV_resizeImage(imgObj, width, imgID) {	
    var imageTimeID = window.setTimeout(function(){
        if(imgObj.width > width) {
            var p = width / imgObj.width;
            imgObj.height = p * imgObj.height;
            imgObj.width = width;
        };

        $('#TV_img_a_' + imgID).click();

        window.clearTimeout(imageTimeID);
    },100);
}

//�û���½
function guestLoginSubmit(sec)
{
	var sec = 'undefined'==typeof(sec) ? 0 : sec;
	if(sec){
		showSeccodeDialog();
	}else{
	var username = $("#username_input").val();
	var psw = $("#password_input").val();
	var seccode = $("#seccode_input").val();
	var YinXiangMa_challenge = $("#YinXiangMa_challenge").val();
	var YXM_level = $("#YXM_level").val();
	var YXM_input_result = $("#YXM_input_result").val();
	var sl = $("#savelogin").attr("checked");
	var sl = (('undefined' == typeof(sl) || false == sl) ? 0 : 1);
	var ref = $("#referer_input").val();
	var ref = (('undefined' == typeof(ref)) ? window.location.href : ref);
	$.post(
		'ajax.php?mod=member&code=login',
		{
			username:username,
			password:psw,
			savelogin:sl,
			seccode:seccode,
			referer:ref,
			YinXiangMa_challenge:YinXiangMa_challenge,
			YXM_level:YXM_level,
			YXM_input_result:YXM_input_result
		},
		function(d) {
			if(d.done == false){
				//show_message(d.msg);
				show_message(d.msg,5,'��ʾ','msgBox','msg_alert');
			} else {
				show_message(d.msg,3);
				location.href = d.retval;
			}
		},
		'json'
	);}
}

/**
 * �л��û�
 */
function changeUser(uid){
    if('undefined' == typeof(uid) || uid < 1){
        show_message('��Ч�û�',2);
    }
    
    $.get(
        'index.php?mod=login&code=changelogin&uid='+uid,
        function (d) {
            if(d.done){
                show_message(d.msg,3);
                window.location.reload();
            } else {
                show_message(d.msg,3);
                return false;
            }
        },'json'        
    );
}
/**
 * @�û�����
 */
function showatuserw(inputid,type,listid){
	var id = 'showatuser'+(''!=type ? '_'+type : '')+(''!=listid ? '_'+listid : '');
	$('#'+id).html('<li><img src="images/loading.gif">......</li>');
	var myAjax = $.post('ajax.php?mod=misc&code=atuserw',{key:inputid,type:type,id:listid},function(d){$('#'+id).html(d);
	});
}
function ajaxg_atuser(code,id,key,type,listid)
{
	var showid = 'atuserlist'+(''!=type ? '_'+type : '')+(''!=listid ? '_'+listid : '');
	$('#'+showid).html('<li><img src="images/loading.gif">......</li>');
	var myAjax = $.post(
		'ajax.php?mod=misc&code=atuser&from=web',{acode:code,type:type,id:id,key:key},
		function(d){
			if('' != d){
				$('#'+showid).html(d);
				$("li").bind("mouseover",function(){$(this).addClass("active");});
				$("li").bind("mouseout",function(){$(this).removeClass("active");});
			}else{
				$('#'+showid).html('');
			}
		}
	);
}
function ajaxw_nickname(value,key,type,listid)
{
	var showid = 'atuserlist'+(''!=type ? '_'+type : '')+(''!=listid ? '_'+listid : '');
	$(".flow-nav .curr").removeClass("curr");
	var myAjax = $.post(
		'ajax.php?mod=misc&code=atuser&from=web',{q:value,key:key,type:type},
		function(d){
			if('' != d){
				$('#'+showid).html(d);
				$("li").bind("mouseover",function(){$(this).addClass("active");});
				$("li").bind("mouseout",function(){$(this).removeClass("active");});
			}else{
				$('#'+showid).html('');
			}
		}
	);
}
function atcin_user(key,value,type)
{
	if('pm' == type){
		var text = (''==$('#'+key).val() ? '' : $('#'+key).val()+',');
		$('#'+key).val(text+value);
	}else{
		$('#'+key).insertAtCaret('@'+value+' ',0);$('#'+key).focus();
	}
}

function sinopec_right_show_ajax(code,id,num)
{	
	var id = 'undefined' == typeof(id) ? '' : id;var num = 'undefined' == typeof(num) ? 0 : num;
	if('undefined' != typeof(code)){var myAjax=$.post("ajax.php?mod=sinopec",{code:code,id:id,num:num},function(d){if(d){$('#sinopec_'+code).html(evalscript(d));}});}
	return false;
}

function uploadphoto(app,handle_key,obj){
	var aid = $(obj).attr("data-id");
	var ajax_url = "ajax.php?mod=uploadify&code=upimg&app="+app+"&aid="+aid;
	showDialog(handle_key, 'ajax', "", {"url":ajax_url,"noTitleBar":true}, 580);
}

function get_featurehtml(channelid,featureid,showid){
	var channelid = 'undefined' == typeof(channelid) ? 0 : channelid;var featureid = 'undefined' == typeof(featureid) ? 0 : featureid; var showid = 'undefined' == typeof(showid) ? 'featureidhtml' : showid;
	$.post('ajax.php?mod=feature&code=listfeature',{channelid:channelid,featureid:featureid},function(d){if('' != d){$('#'+showid).html(d);}else{$('#'+showid).html('');}});
}

function settopicfeature(tid,replyid,rloadtrue){
	var tid = 'undefined' == typeof(tid) ? 0 : tid;var replyid = 'undefined' == typeof(replyid) ? 0 : replyid;var handle_key = 'modfeature_'+tid+'_'+replyid;
	var rloadtrue = 'undefined' == typeof(rloadtrue) ? 0 : 1;
	if(tid < 1){return false;}
	var ajax_url = "ajax.php?mod=feature&code=modfeature&tid="+tid+"&replyid="+replyid+'&rloadtrue='+rloadtrue;
	showDialog(handle_key, 'ajax', "΢�����Թ���", {"url":ajax_url}, 250);
}