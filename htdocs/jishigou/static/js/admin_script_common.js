

var userAgent = navigator.userAgent.toLowerCase();
var is_opera = userAgent.indexOf('opera') != -1 && opera.version();
var is_moz = (navigator.product == 'Gecko') && userAgent.substr(userAgent.indexOf('firefox') + 8, 3);
var is_ie = (userAgent.indexOf('msie') != -1 && !is_opera) && userAgent.substr(userAgent.indexOf('msie') + 5, 3);
var is_safari = (userAgent.indexOf('webkit') != -1 || userAgent.indexOf('safari') != -1);
var note_step = 0;
var note_oldtitle = document.title;
var note_timer;

//iframe����

function $jishigou(id) {
	return document.getElementById(id);
}

function addSort(obj) {
	if (obj.value == 'addoption') {
 	var newOptDiv = document.createElement('div')
 	newOptDiv.id = obj.id+'_menu';
 	newOptDiv.innerHTML = '<h1>����</h1><a href="javascript:;" onclick="addOption(\'newsort\', \''+obj.id+'\')" class="float_del">ɾ��</a><div class="popupmenu_inner" style="text-align: center;">���ƣ�<input type="text" name="newsort" size="10" id="newsort" class="t_input" /><input type="button" name="addSubmit" value="����" onclick="addOption(\'newsort\', \''+obj.id+'\')" class="button" /></div>';
 	newOptDiv.className = 'popupmenu_centerbox';
 	newOptDiv.style.cssText = 'position: absolute; left: 50%; top: 200px; width: 400px; margin-left: -200px;';
 	document.body.appendChild(newOptDiv);
 	$jishigou('newsort').focus();
 	}
}
	
function addOption(sid, aid) {
	var obj = $jishigou(aid);
	var newOption = $jishigou(sid).value;
	$jishigou(sid).value = "";
	if (newOption!=null && newOption!='') {
		var newOptionTag=document.createElement('option');
		newOptionTag.text=newOption;
		newOptionTag.value="new:" + newOption;
		try {
			obj.add(newOptionTag, obj.options[0]); // doesn't work in IE
		} catch(ex) {
			obj.add(newOptionTag, obj.selecedIndex); // IE only
		}
		obj.value="new:" + newOption;
	} else {
		obj.value=obj.options[0].value;
	}
	// Remove newOptDiv
	var newOptDiv = document.getElementById(aid+'_menu');
	var parent = newOptDiv.parentNode;
	var removedChild = parent.removeChild(newOptDiv);
}

function checkAll(form, name) {
	for(var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if(e.name.match(name)) {
			e.checked = form.elements['chkall'].checked;
		}
	}
}

function cnCode(str) {
	return is_ie && document.charset == 'utf-8' ? encodeURIComponent(str) : str;
}

function isUndefined(variable) {
	return typeof variable == 'undefined' ? true : false;
}

function in_array(needle, haystack) {
	if(typeof needle == 'string' || typeof needle == 'number') {
		for(var i in haystack) {
			if(haystack[i] == needle) {
					return true;
			}
		}
	}
	return false;
}

function strlen(str) {
	return (is_ie && str.indexOf('\n') != -1) ? str.replace(/\r?\n/g, '_').length : str.length;
}

function getExt(path) {
	return path.lastIndexOf('.') == -1 ? '' : path.substr(path.lastIndexOf('.') + 1, path.length).toLowerCase();
}

function doane(event) {
	e = event ? event : window.event;
	if(is_ie) {
		e.returnValue = false;
		e.cancelBubble = true;
	} else if(e) {
		e.stopPropagation();
		e.preventDefault();
	}
}

//��֤��
function seccode() {
	var img = 'do.php?ac=seccode&rand='+Math.random();
	document.writeln('<img id="img_seccode" src="'+img+'" align="absmiddle">');
}
function updateseccode() {
	var img = 'do.php?ac=seccode&rand='+Math.random();
	if($jishigou('img_seccode')) {
		$jishigou('img_seccode').src = img;
	}
}

//��СͼƬ����������
function resizeImg(id,size) {
	var theImages = $jishigou(id).getElementsByTagName('img');
	for (i=0; i<theImages.length; i++) {
		theImages[i].onload = function() {
			if (this.width > size) {
				this.style.width = size + 'px';
				if (this.parentNode.tagName.toLowerCase() != 'a') {
					var zoomDiv = document.createElement('div');
					this.parentNode.insertBefore(zoomDiv,this);
					zoomDiv.appendChild(this);
					zoomDiv.style.position = 'relative';
					zoomDiv.style.cursor = 'pointer';
					
					this.title = '���ͼƬ�����´�����ʾԭʼ�ߴ�';
					
					var zoom = document.createElement('img');
					zoom.src = 'image/zoom.gif';
					zoom.style.position = 'absolute';
					zoom.style.marginLeft = size -28 + 'px';
					zoom.style.marginTop = '5px';
					this.parentNode.insertBefore(zoom,this);
					
					zoomDiv.onmouseover = function() {
						zoom.src = 'image/zoom_h.gif';
					}
					zoomDiv.onmouseout = function() {
						zoom.src = 'image/zoom.gif';
					}
					zoomDiv.onclick = function() {
						window.open(this.childNodes[1].src);
					}
				}
			}
		}
	}
}

//Ctrl+Enter ����
function ctrlEnter(event, btnId, onlyEnter) {
	if(isUndefined(onlyEnter)) onlyEnter = 0;
	if((event.ctrlKey || onlyEnter) && event.keyCode == 13) {
		$jishigou(btnId).click();
		return false;
	}
	return true;
}
//����Textarea
function zoomTextarea(id, zoom) {
	zoomSize = zoom ? 10 : -10;
	obj = $jishigou(id);
	if(obj.rows + zoomSize > 0 && obj.cols + zoomSize * 3 > 0) {
		obj.rows += zoomSize;
		obj.cols += zoomSize * 3;
	}
}

//����URL��ַ
function setCopy(_sTxt){
	if(is_ie) {
		clipboardData.setData('Text',_sTxt);
		alert ("��ַ��"+_sTxt+"��\n�Ѿ����Ƶ����ļ�������\n������ʹ��Ctrl+V��ݼ�ճ������Ҫ�ĵط�");
	} else {
		prompt("�븴����վ��ַ:",_sTxt); 
	}
}

//��֤�Ƿ���ѡ���¼
function ischeck(id, prefix) {
	form = document.getElementById(id);
	for(var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if(e.name.match(prefix) && e.checked) {
			if(confirm("��ȷ��Ҫִ�б�������")) {
				return true;
			} else {
				return false;
			}
		}
	}
	alert('��ѡ��Ҫ�����Ķ���');
	return false;
}
function showPreview(val, id) {
	var showObj = $jishigou(id);
	if(typeof showObj == 'object') {
		showObj.innerHTML = val.replace(/\n/ig, "<br />");
	}
}

function getEvent() {
	if (document.all) return window.event;
	func = getEvent.caller;
	while (func != null) {
		var arg0 = func.arguments[0];
		if (arg0) {
			if((arg0.constructor==Event || arg0.constructor ==MouseEvent) || (typeof(arg0)=="object" && arg0.preventDefault && arg0.stopPropagation)) {
				return arg0;
			}
		}
		func=func.caller;
	}
	return null;
}
 
function copyRow(tbody) {
	var add = false;
	var newnode;
	if($jishigou(tbody).rows.length == 1 && $jishigou(tbody).rows[0].style.display == 'none') {
		$jishigou(tbody).rows[0].style.display = '';
		newnode = $jishigou(tbody).rows[0];
	} else {
		newnode = $jishigou(tbody).rows[0].cloneNode(true);
		add = true;
	}
	tags = newnode.getElementsByTagName('input');
	for(i in tags) {
		if(tags[i].name == 'pics[]') {
			tags[i].value = 'http://';
		}
	}
	if(add) {
		$jishigou(tbody).appendChild(newnode);
	}
}
	
function delRow(obj, tbody) {
	if($jishigou(tbody).rows.length == 1) {
		var trobj = obj.parentNode.parentNode;
		tags = trobj.getElementsByTagName('input');
		for(i in tags) {
			if(tags[i].name == 'pics[]') {
				tags[i].value = 'http://';
			}
		}
		trobj.style.display='none';
	} else {
		$jishigou(tbody).removeChild(obj.parentNode.parentNode);
	}
}

function insertWebImg(obj) {
	if(checkImage(obj.value)) {
		insertImage(obj.value);
		obj.value = 'http://';
	} else {
		alert('ͼƬ��ַ����ȷ');
	}
}

function checkFocus(target) {
	var obj = $jishigou(target);
	if(!obj.hasfocus) {
		obj.focus();
	}
}
function insertImage(text) {
	text = "\n[img]" + text + "[/img]\n";
	insertContent('message', text)
}

function insertContent(target, text) {
	var obj = $jishigou(target);
	selection = document.selection;
	checkFocus(target);
	if(!isUndefined(obj.selectionStart)) {
		var opn = obj.selectionStart + 0;
		obj.value = obj.value.substr(0, obj.selectionStart) + text + obj.value.substr(obj.selectionEnd);
	} else if(selection && selection.createRange) {
		var sel = selection.createRange();
		sel.text = text;
		sel.moveStart('character', -strlen(text));
	} else {
		obj.value += text;
	}
}

function checkImage(url) {
	var re = /^http\:\/\/.{5,200}\.(jpg|gif|png)$/i
	return url.match(re);
}

function quick_validate(obj) {
    if($jishigou('seccode')) {
		var code = $jishigou('seccode').value;
		var x = new Ajax();
		x.get('cp.php?ac=common&op=seccode&code=' + code, function(s){
			s = trim(s);
			if(s != 'succeed') {
				alert(s);
				$jishigou('seccode').focus();
           		return false;
			} else {
				obj.form.submit();
				return true;
			}
		});
    } else {
    	obj.form.submit();
    	return true;
    }
}

function trim(str) { 
	var re = /\s*(\S[^\0]*\S)\s*/; 
	re.exec(str); 
	return RegExp.$1; 
}
// ֹͣ����flash
function stopMusic(preID, playerID) {
	var musicFlash = preID.toString() + '_' + playerID.toString();
	if($jishigou(musicFlash)) {
		$jishigou(musicFlash).SetVariable('closePlayer', 1);
	}
}
// ��ʾӰ�ӡ�����flash
function showFlash(host, flashvar, obj, shareid) {
	var flashAddr = {
		'youku.com' : 'http://player.youku.com/player.php/sid/FLASHVAR=/v.swf',
		'ku6.com' : 'http://player.ku6.com/refer/FLASHVAR/v.swf',
		'youtube.com' : 'http://www.youtube.com/v/FLASHVAR',
		'5show.com' : 'http://www.5show.com/swf/5show_player.swf?flv_id=FLASHVAR',
		'sina.com.cn' : 'http://vhead.blog.sina.com.cn/player/outer_player.swf?vid=FLASHVAR',
		'sohu.com' : 'http://v.blog.sohu.com/fo/v4/FLASHVAR',
		'mofile.com' : 'http://tv.mofile.com/cn/xplayer.swf?v=FLASHVAR',
		'tudou.com' : 'http://www.tudou.com/v/FLASHVAR',
		'music' : 'FLASHVAR',
		'flash' : 'FLASHVAR'
	};
	var flash = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="480" height="400">'
	    + '<param name="movie" value="FLASHADDR" />'
	    + '<param name="quality" value="high" />'
	    + '<param name="bgcolor" value="#FFFFFF" />'
	    + '<embed width="440" height="360" menu="false" quality="high" src="FLASHADDR" type="application/x-shockwave-flash" />'
	    + '</object>';
	var videoFlash = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="440" height="400">'
        + '<param value="transparent" name="wmode"/>'
		+ '<param value="FLASHADDR" name="movie" />'
		+ '<embed src="FLASHADDR" wmode="transparent" allowfullscreen="true" type="application/x-shockwave-flash" width="480" height="450"></embed>'
		+ '</object>';
	var musicFlash = '<object id="audioplayer_SHAREID" height="24" width="290" data="images/player.swf" type="application/x-shockwave-flash">'
		+ '<param value="images/player.swf" name="movie"/>'
		+ '<param value="autostart=yes&bg=0xCDDFF3&leftbg=0x357DCE&lefticon=0xF2F2F2&rightbg=0xF06A51&rightbghover=0xAF2910&righticon=0xF2F2F2&righticonhover=0xFFFFFF&text=0x357DCE&slider=0x357DCE&track=0xFFFFFF&border=0xFFFFFF&loader=0xAF2910&soundFile=FLASHADDR" name="FlashVars"/>'
		+ '<param value="high" name="quality"/>'
		+ '<param value="false" name="menu"/>'
		+ '<param value="#FFFFFF" name="bgcolor"/>'
	  + '</object>';
	var musicMedia = '<object height="64" width="290" data="FLASHADDR" type="audio/x-ms-wma">'
	    + '<param value="FLASHADDR" name="src"/>'
	    + '<param value="1" name="autostart"/>'
	    + '<param value="true" name="controller"/>'
	    + '</object>';
	var flashHtml = videoFlash;
	var videoMp3 = true;
	if('' == flashvar) {
		alert('���ӵ�ַ���󣬲���Ϊ��');
		return false;
	}
	if('music' == host) {
		var mp3Reg = new RegExp('.mp3$', 'ig');
		var flashReg = new RegExp('.swf$', 'ig');
		flashHtml = musicMedia;
		videoMp3 = false
		if(mp3Reg.test(flashvar)) {
			videoMp3 = true;
			flashHtml = musicFlash;
		} else if(flashReg.test(flashvar)) {
			videoMp3 = true;
			flashHtml = flash;
		}
	}
	flashvar = encodeURI(flashvar);
	if(flashAddr[host]) {
		var flash = flashAddr[host].replace('FLASHVAR', flashvar);
		flashHtml = flashHtml.replace(/FLASHADDR/g, flash);
		flashHtml = flashHtml.replace(/SHAREID/g, shareid);

	}
	
	if(!obj) {
		$jishigou('flash_div_' + shareid).innerHTML = flashHtml;
		return true;
	}
	if($jishigou('flash_div_' + shareid)) {
		$jishigou('flash_div_' + shareid).style.display = '';
		$jishigou('flash_hide_' + shareid).style.display = '';
		obj.style.display = 'none';
		
		return true;
	}
	if(flashAddr[host]) {
		var flashObj = document.createElement('div');
		flashObj.id = 'flash_div_' + shareid;
		obj.parentNode.insertBefore(flashObj, obj);
		flashObj.innerHTML = flashHtml;
		
		obj.style.display = 'none';
		//���ز���ͼ��
		$jishigou('play_' + shareid).style.display = 'none';
		
		var hideObj = document.createElement('div');
		hideObj.id = 'flash_hide_' + shareid;
		var nodetxt = document.createTextNode("����");
		
		hideObj.appendChild(nodetxt);
		obj.parentNode.insertBefore(hideObj, obj);
		hideObj.style.cursor = 'pointer';
		
		
		hideObj.onclick = function() {
			if(true == videoMp3) {
				stopMusic('audioplayer', shareid);
				flashObj.parentNode.removeChild(flashObj);
				hideObj.parentNode.removeChild(hideObj);
				
			 
			} else {
				flashObj.style.display = 'none';
				hideObj.style.display = 'none';
				
			}
			obj.style.display = '';
			//��ʾ����ͼ��
			$jishigou('play_' + shareid).style.display = 'block';
			  

		}
	}
}


// ��ʾӰ�ӡ�����flash
function showMusic(host, flashvar, obj, shareid) {
	var flashAddr = {
		'youku.com' : 'http://player.youku.com/player.php/sid/FLASHVAR=/v.swf',
		'ku6.com' : 'http://player.ku6.com/refer/FLASHVAR/v.swf',
		'youtube.com' : 'http://www.youtube.com/v/FLASHVAR',
		'5show.com' : 'http://www.5show.com/swf/5show_player.swf?flv_id=FLASHVAR',
		'sina.com.cn' : 'http://vhead.blog.sina.com.cn/player/outer_player.swf?vid=FLASHVAR',
		'sohu.com' : 'http://v.blog.sohu.com/fo/v4/FLASHVAR',
		'mofile.com' : 'http://tv.mofile.com/cn/xplayer.swf?v=FLASHVAR',
		'tudou.com' : 'http://www.tudou.com/v/FLASHVAR',
		'music' : 'FLASHVAR',
		'flash' : 'FLASHVAR'
	};
	var flash = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="480" height="400">'
	    + '<param name="movie" value="FLASHADDR" />'
	    + '<param name="quality" value="high" />'
	    + '<param name="bgcolor" value="#FFFFFF" />'
	    + '<embed width="440" height="360" menu="false" quality="high" src="FLASHADDR" type="application/x-shockwave-flash" />'
	    + '</object>';
	var videoFlash = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="440" height="400">'
        + '<param value="transparent" name="wmode"/>'
		+ '<param value="FLASHADDR" name="movie" />'
		+ '<embed src="FLASHADDR" wmode="transparent" allowfullscreen="true" type="application/x-shockwave-flash" width="480" height="450"></embed>'
		+ '</object>';
	var musicFlash = '<object id="audioplayer_SHAREID" height="24" width="290" data="images/player.swf" type="application/x-shockwave-flash">'
		+ '<param value="images/player.swf" name="movie"/>'
		+ '<param value="autostart=yes&bg=0xCDDFF3&leftbg=0x357DCE&lefticon=0xF2F2F2&rightbg=0xF06A51&rightbghover=0xAF2910&righticon=0xF2F2F2&righticonhover=0xFFFFFF&text=0x357DCE&slider=0x357DCE&track=0xFFFFFF&border=0xFFFFFF&loader=0xAF2910&soundFile=FLASHADDR" name="FlashVars"/>'
		+ '<param value="high" name="quality"/>'
		+ '<param value="false" name="menu"/>'
		+ '<param value="#FFFFFF" name="bgcolor"/>'
	  + '</object>';
	var musicMedia = '<object height="64" width="290" data="FLASHADDR" type="audio/x-ms-wma">'
	    + '<param value="FLASHADDR" name="src"/>'
	    + '<param value="1" name="autostart"/>'
	    + '<param value="true" name="controller"/>'
	    + '</object>';
	var flashHtml = videoFlash;
	var videoMp3 = true;
	if('' == flashvar) {
		alert('���ӵ�ַ���󣬲���Ϊ��');
		return false;
	}
	if('music' == host) {
		var mp3Reg = new RegExp('.mp3$', 'ig');
		var flashReg = new RegExp('.swf$', 'ig');
		flashHtml = musicMedia;
		videoMp3 = false
		if(mp3Reg.test(flashvar)) {
			videoMp3 = true;
			flashHtml = musicFlash;
		} else if(flashReg.test(flashvar)) {
			videoMp3 = true;
			flashHtml = flash;
		}
	}
	flashvar = encodeURI(flashvar);
	if(flashAddr[host]) {
		var flash = flashAddr[host].replace('FLASHVAR', flashvar);
		flashHtml = flashHtml.replace(/FLASHADDR/g, flash);
		flashHtml = flashHtml.replace(/SHAREID/g, shareid);

	}
	
	if(!obj) {
		$jishigou('flash_div_' + shareid).innerHTML = flashHtml;
		return true;
	}
	if($jishigou('flash_div_' + shareid)) {
		$jishigou('flash_div_' + shareid).style.display = '';
		$jishigou('flash_hide_' + shareid).style.display = '';
		obj.style.display = 'none';
		
		return true;
	}
	if(flashAddr[host]) {
		var flashObj = document.createElement('div');
		flashObj.id = 'flash_div_' + shareid;
		obj.parentNode.insertBefore(flashObj, obj);
		flashObj.innerHTML = flashHtml;
		
		obj.style.display = 'none';
		//���ز���ͼ��
		$jishigou('play_' + shareid).style.display = 'none';
		
		var hideObj = document.createElement('div');
		hideObj.id = 'flash_hide_' + shareid;
		var nodetxt = document.createTextNode("����");
		
		hideObj.appendChild(nodetxt);
		obj.parentNode.insertBefore(hideObj, obj);
		hideObj.style.cursor = 'pointer';
		
		
		hideObj.onclick = function() {
			if(true == videoMp3) {
				stopMusic('audioplayer', shareid);
				flashObj.parentNode.removeChild(flashObj);
				hideObj.parentNode.removeChild(hideObj);
				
			 
			} else {
				flashObj.style.display = 'none';
				hideObj.style.display = 'none';
				
			}
			obj.style.display = '';
			//��ʾ����ͼ��
			$jishigou('play_' + shareid).style.display = 'block';
			  

		}
	}
}





//��ʾȫ��Ӧ��
function userapp_open() {
	var x = new Ajax();
	x.get('cp.php?ac=common&op=getuserapp', function(s){
		$jishigou('my_userapp').innerHTML = s;
		$jishigou('a_app_more').className = 'on';
		$jishigou('a_app_more').innerHTML = '����';
		$jishigou('a_app_more').onclick = function() {
			userapp_close();
		}
	});
}

//�ر�ȫ��Ӧ��
function userapp_close() {
	var x = new Ajax();
	x.get('cp.php?ac=common&op=getuserapp&subop=off', function(s){
		$jishigou('my_userapp').innerHTML = s;
		$jishigou('a_app_more').className = 'off';
		$jishigou('a_app_more').innerHTML = 'չ��';
		$jishigou('a_app_more').onclick = function() {
			userapp_open();
		}
	});
}

//����
function startMarquee(h, speed, delay, sid) {
	var t = null;
	var p = false;
	var o = $jishigou(sid);
	o.innerHTML += o.innerHTML;
	o.onmouseover = function() {p = true}
	o.onmouseout = function() {p = false}
	o.scrollTop = 0;
	function start() {
	    t = setInterval(scrolling, speed);
	    if(!p) {
			o.scrollTop += 2;
		}
	}
	function scrolling() {
	    if(p) return;
		if(o.scrollTop % h != 0) {
	        o.scrollTop += 2;
	        if(o.scrollTop >= o.scrollHeight/2) o.scrollTop = 0;
	    } else {
	        clearInterval(t);
	        setTimeout(start, delay);
	    }
	}
	setTimeout(start, delay);
}

function readfeed(obj, id) {
	if(Cookie.get("read_feed_ids")) {
		var fcookie = Cookie.get("read_feed_ids");
		fcookie = id + ',' + fcookie;
	} else {
		var fcookie = id;
	}
	Cookie.set("read_feed_ids", fcookie, 48);
	obj.className = 'feedread';
}

function showreward() {
	if(Cookie.get('reward_notice_disable')) {
		return false;
	}
	var x = new Ajax();
	x.get('do.php?ac=ajax&op=getreward', function(s){
		if(s) {
			msgwin(s, 2000);
		}
	});
}

function msgwin(s, t) {
	
	var msgWinObj = $jishigou('msgwin');
	if(!msgWinObj) {
		var msgWinObj = document.createElement("div");
		msgWinObj.id = 'msgwin';
		msgWinObj.style.display = 'none';
		msgWinObj.style.position = 'absolute';
		msgWinObj.style.zIndex = '100000';
		$jishigou('append_parent').appendChild(msgWinObj);
	}
	msgWinObj.innerHTML = s;
	msgWinObj.style.display = '';
	msgWinObj.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=0)';
	msgWinObj.style.opacity = 0;
	var sTop = document.documentElement && document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop;
	pbegin = sTop + (document.documentElement.clientHeight / 2);
	pend = sTop + (document.documentElement.clientHeight / 5);
	setTimeout(function () {showmsgwin(pbegin, pend, 0, t)}, 10);
	msgWinObj.style.left = ((document.documentElement.clientWidth - msgWinObj.clientWidth) / 2) + 'px';
	msgWinObj.style.top = pbegin + 'px';
}

function showmsgwin(b, e, a, t) {
	step = (b - e) / 10;
	var msgWinObj = $jishigou('msgwin');
	newp = (parseInt(msgWinObj.style.top) - step);
	if(newp > e) {
		msgWinObj.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + a + ')';
		msgWinObj.style.opacity = a / 100;
		msgWinObj.style.top = newp + 'px';
		setTimeout(function () {showmsgwin(b, e, a += 10, t)}, 10);
	} else {
		msgWinObj.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=100)';
		msgWinObj.style.opacity = 1;
		setTimeout('displayOpacity(\'msgwin\', 100)', t);
	}
}

function displayOpacity(id, n) {
	if(!$jishigou(id)) {
		return;
	}
	if(n >= 0) {
		n -= 10;
		$jishigou(id).style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + n + ')';
		$jishigou(id).style.opacity = n / 100;
		setTimeout('displayOpacity(\'' + id + '\',' + n + ')', 50);
	} else {
		$jishigou(id).style.display = 'none';
		$jishigou(id).style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=100)';
		$jishigou(id).style.opacity = 1;
	}
}

function display(id) {
	var obj = $jishigou(id);
	obj.style.display = obj.style.display == '' ? 'none' : '';
}

function urlto(url) {
	window.location.href = url;
}

function explode(sep, string) {
	return string.split(sep);
}

function selector(pattern, context) {
	var re = new RegExp('([a-z]*)([\.#:]*)(.*|$)', 'ig');
	var match = re.exec(pattern);
	var conditions = [];	
	if (match[2] == '#')	conditions.push(['id', match[3]]);
	else if(match[2] == '.')	conditions.push(['className', match[3]]);
	else if(match[2] == ':')	conditions.push(['type', match[3]]);	
	var s = match[3].replace(/\[(.*)\]/g,'$1').split('@');
	for(var i=0; i<s.length; i++) {
		var cc = null;
		if (cc = /([\w]+)([=^%!$~]+)(.*)$/.exec(s[i])){
			conditions.push([cc[1], cc[2], cc[3]]);
		}
	}
	var list = (context || document).getElementsByTagName(match[1] || "*");	
	if(conditions) {
		var elements = [];
		var attrMapping = {'for': 'htmlFor', 'class': 'className'};
		for(var i=0; i<list.length; i++) {
			var pass = true;
			for(var j=0; j<conditions.length; j++) {
				var attr = attrMapping[conditions[j][0]] || conditions[j][0];
				var val = list[i][attr] || (list[i].getAttribute ? list[i].getAttribute(attr) : '');
				var pattern = null;
				if(conditions[j][1] == '=') {
					pattern = new RegExp('^'+conditions[j][2]+'$', 'i');
				} else if(conditions[j][1] == '^=') {
					pattern = new RegExp('^' + conditions[j][2], 'i');
				} else if(conditions[j][1] == '$=') {
					pattern = new RegExp(conditions[j][2] + '$', 'i');
				} else if(conditions[j][1] == '%=') {
					pattern = new RegExp(conditions[j][2], 'i');
				} else if(conditions[j][1] == '~=') {
					pattern = new RegExp('(^|[ ])' + conditions[j][2] + '([ ]|$)', 'i');
				}
				if(pattern && !pattern.test(val)) {
					pass = false;
					break;
				}
			}
			if(pass) elements.push(list[i]);
		}
		return elements;
	} else {
		return list;
	}
}

//������
function add_tbody(mode,tbody)
{
	var m = document.getElementById(mode).childNodes;
	if (m) {
		var i = 0;
		while(m[i].nodeType != 1 && i <= m.length){
			i++;
		} 
		//var s = document.getElementById(mode).firstChild.cloneNode(true);
		var s = m[i].cloneNode(true);
		document.getElementById(tbody).appendChild(s);
	}
}

//ɾ����
function del_tbody(obj)
{
	var o = obj.parentNode.parentNode;
	if (o.parentNode.childNodes.length >= 1) {
		o.parentNode.removeChild(o);
	}
}

//���˿ո�
function ignoreSpaces(s){var t='';sp=s.split(' ');for(i=0;i<sp.length;i++)t+=sp[i];return t;}

//ɾ�������˼α���ý���λ�벿���쵼
function del_item(obj,oid,type)
{
	if(isUndefined(oid)) oid = 0;
	if(isUndefined(type)) type = '';
	var o = obj.parentNode.parentNode;
	//���������жϣ�������Chrome���Կհ���һ���ڵ㣬���BUG�е�С����
	if(o.childNodes[0].nodeType==3){
		var uid = ignoreSpaces(o.childNodes[1].childNodes[0].value);
	}else{
		var uid = ignoreSpaces(o.childNodes[0].childNodes[0].value);
	}
	for(var i=0;i<user.length;i++){
		if(user[i] == uid){user.splice(i,1);}
    }
	if(oid > 0){
		$.post("ajax.php?mod=item&code=del",{id:oid,type:type}, function(){});
	}
	o.parentNode.removeChild(o);
}

//�û��ǳ�������ʾ
function ajax_nickname(obj,value)
{
	$(obj).attr("autocomplete","off");
	var id = "ajaxnickname";
	if($('#'+id).length==0){
		$(document.body).append("<div id='"+id+"' />");
	}
	else
	{
		$('#'+id).html('');
	}
	var position = $(obj).offset();
	$('#'+id).css({position:"absolute",'padding-top':'10px','z-index':99,left:position.left,top:position.top+20});
	if ($.browser.msie){
		$('#'+id).css({top:position.top+15});
	}
	var myAjax = $.post(
		'ajax.php?mod=misc&code=atuser&from=admin',{q:value},
		function(d){
			if('' != d){
				$('#'+id).html('<div class="quicksearchbar"><ul class="stocks">'+d+'</ul></div>');
				$("li").bind("mouseover",function(){$(this).addClass("active");});
				$("li").bind("mouseout",function(){$(this).removeClass("active");});
				$("li").bind("click",function(){$(obj).val($(this).text());$('#'+id).html('');});
			}
		}
	);
}

//���������˼α���ý���λ�벿���쵼
function add_item(obj,item,itemid,type)
{
	if(isUndefined(itemid)) itemid = 0;
	var o = obj.parentNode.parentNode;
	//���������жϣ�������Chrome���Կհ���һ���ڵ㣬���BUG�е�С����
	if(o.childNodes[0].nodeType==3){
		var oi = o.childNodes[1].childNodes[0];
		var oj = o.childNodes[3].childNodes[0];
	}else{
		var oi = o.childNodes[0].childNodes[0];
		var oj = o.childNodes[1].childNodes[0];
	}
	var nickname = ignoreSpaces(oi.value);
	var userabout = ignoreSpaces(oj.value);
	if(nickname.length == 0){
		MessageBox('notice', "�ǳƲ���Ϊ�գ�", '��ʾ');
	}else if(in_array(nickname,user)){
		MessageBox('notice', "���û��Ѿ����ڣ�", '��ʾ');
	}else{
		$.post("ajax.php?mod=item&code=checkname",{nickname:nickname,item:item,itemid:itemid,type:type}, function(d){
		if(d == -1){
			MessageBox('notice', "���û��Ѿ����ڣ�", '��ʾ');
		}else if(d == -2){
			MessageBox('notice', "û���ҵ����û���", '��ʾ');
		}else if(d > 0){
			var t = o.parentNode;
			var n = t.rows.length-1;
			var r = t.insertRow(n);
			var c1 = r.insertCell(0);
			var c2 = r.insertCell(1);
			var c3 = r.insertCell(2);
			c1.innerHTML = '<input type="hidden" name="uid_'+type+'[]" value="'+d+'">'+nickname;
			c2.innerHTML = '<input type="hidden" name="userabout_'+type+'[]" value="'+userabout+'">'+userabout;
			c3.innerHTML = '<a href="javascript:;" onclick="del_item(this,0);return false;" class="icon-del">ɾ��</a>';
			user[ui] = d;oj.value = '';
			ui++;
		}else{
			MessageBox('notice', "δ֪����", '��ʾ');
		}
		});
	}
	oi.focus();oi.value = '';
}