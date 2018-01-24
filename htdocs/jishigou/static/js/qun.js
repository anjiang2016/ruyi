/**
 * ΢Ⱥjs��
 * 
 * @category   Qun
 * @author     ~ZZ~
 * @version $Id$
 */

//��������
function get_catselect(obj)
{
	cat_id = obj.options[obj.selectedIndex].value;
	$.get(
		'ajax.php?mod=qun&code=second_cat&cat_id='+cat_id,
		{},
		function(r) {
			$("#sub_cat").empty();
			$(r).appendTo("#sub_cat");
		}
	);	
}

/**
 * ����Ⱥ
 */
function joinQun(qid)
{
	$.post(
		'ajax.php?mod=qun&code=join',
		{'qid':qid},
		function(r) {
			if (!is_json(r)) {
				var handle_key = 'join_qun_success_dialog';
				showDialog(handle_key, 'local', '����ɹ�', {html:r}, 500);
				
				//���ñ������رհ�ť����
				setDialogOnCloseListener(handle_key, function(){
					location.reload();
				});
				
				getUserFriends(1, {'qid':qid});
				$(document).ready(function(){
					$('#topic_simple_close_btn').click(
						function() {
							closeDialog(handle_key);
							location.reload();
						}
					);
					$('#topic_simple_share_btn').click(
						function() {
							var response = function() {
								MessageBox('notice', '�Ƽ��ɹ�');
								location.reload();
							}
							if (publishSimpleTopic($('#topic_simple_content').val(), '', 0, {response:response})) {
								closeDialog(handle_key);
							}
						}
					);
				});
			} else {
				var json = eval('('+r.toString()+')');
				MessageBox('warning', json.msg);
			}
		}
	);		
}

/**
 * �������Ⱥ
 */
function applyQun(qid, msg)
{
	$.post(
		'ajax.php?mod=qun&code=join',
		{'qid':qid, 'message':msg},
		function(r) {
			if (r.done) {
				closeDialog('apply_qun_dialog');
				MessageBox('notice', r.msg);
				location.reload();
			} else {
				MessageBox('warning', r.msg);
			}
		},
		'json'
	);		
}

/**
 * �˳�Ⱥ
 */
function quitQun(qid)
{
	var param = {
		'onClickYes':function(){
			$.post(
				'ajax.php?mod=qun&code=quit',
				{'qid':qid},
				function(r) {
					if (r.done) {
						var options = {
							onclick:function() {
								location.reload();
							},
							close_first:true
						};
						MessageBox('notice', r.msg, '��ʾ', options);
						
						//���ñ������رհ�ť����
						setDialogOnCloseListener('notice_dialog', function(){
							location.reload();
						});
					} else {
						MessageBox('warning', r.msg);
					}
				},
				'json'
			);
		}
	}
	MessageBox('confirm', "��ȷ���˳���", '��ʾ', param);
}

//������id��ȡ�Ƽ�����
function recommendQun(cat_id)
{
	var lis = $("#cat_nav div");
	var len = lis.length;
	var cur_id = 'nav_inner_'+cat_id;
	for (i=0;i<len;i++) {
		if (lis[i].id == cur_id) {
			lis[i].className = 'tagcurrent';
		} else {
			lis[i].className = 'tagn';
		}
	}
	
	$.get(
		'ajax.php?mod=qun&code=recdqun&random='+Math.random(),
		{'cat_id':cat_id},
		function(r) {
			if(is_json(r)){
				r = eval('('+r.toString()+')');
				$('#recdqun_wp').html(r.msg);
			} else {
				$('#recdqun_wp').html(r);
			}
		}
	);
}

//����ʡ��ID��ȡͬ��Ⱥ
function tcQun(province){
	getCityList(province);
	tcQunSearch(province);
}

function tcQunSearch(province){
	$.get(
			'ajax.php?mod=qun&code=tcqun',
			{'province':province},
			function(r) {
				if(is_json(r)){
					r = eval('('+r.toString()+')');
					$('#tc_wq').html(r.msg);
				} else {
					$('#tc_wq').html(r);
				}
			}
		);
}

function getCityList(province){
	$.get(
			'ajax.php?mod=member&code=sel',
			{'province':province},
			function(r) {
				if(is_json(r)){
					r = eval('('+r.toString()+')');
					$('#tc_city').html(r.msg);
				} else {
					$('#tc_city').html(r);
				}
			}
		);
}

//���ճ���ID��ȡͬ��Ⱥ
function tcityQun(city){
	if(!city){
		var province = $('#tc_province').val();
		tcQunSearch(province);
	}else{
	$.get(
			'ajax.php?mod=qun&code=tcqun',
			{'city':city},
			function(r) {
				if(is_json(r)){
					r = eval('('+r.toString()+')');
					$('#tc_wq').html(r.msg);
				} else {
					$('#tc_wq').html(r);
				}
			}
		);
	}
}

//��ȡ����΢Ⱥ
/*
function get_hot_qun_list()
{
	$.get(
		'ajax.php?mod=qun&code=block&type=24hot&random='+Math.random(),
		{},
		function(r) {
			$('#hot_24_wp').html(r);
		}
	);
}*/

//��˽���õ�ѡǿ��
function privacy_radio_force(type)
{
	if (type == 1) {
		$('#join_ratify').attr({ checked: "checked"});
	} else if (type == 2) {
		$('#privacy_open').attr({ checked: "checked"});
	}
}

/**
 * ��ȡ�ҵĺ����б�
 */
function getUserFriends(page, values)
{
	if (!page) {
		page = 1;
	}
	var url = "ajax.php?mod=qun&code=userfriends&qid="+values['qid']+"&page="+page;
	$.get(
		url,
		{},
		function (r) {
			$('#recd_wp').html(r);
			if (CHECKED != null || CHECKED.length > 0) {
				for (var i in CHECKED) {
					var obj = $('#'+i);
					if (obj) {
						obj.attr({ checked: "checked"});
					}
				}
			}
		}
	)
}

function getUserFans(page, values)
{
	if (!page) {
		page = 1;
	}
	var url = "ajax.php?mod=qun&code=userfans&qid="+values['qid']+"&page="+page;
	$.get(
		url,
		{},
		function (r) {
			$('#userfans_wp').html(r);
			if (__USERS__ != null || __USERS__.length > 0) {
				for (var i in __USERS__) {
					var obj = $('#checked_'+i);
					if (obj) {
						obj.attr({ checked: "checked"});
					}
				}
			}
		}
	);
}

//ѡ��Ҫ�Ƽ��Ĺ�ע��
var __QUN_RECD_CONTENT__ = ''
function checkedFollower(obj)
{
	if (__QUN_RECD_CONTENT__.length == '') {
		__QUN_RECD_CONTENT__= $("#topic_simple_content").val();
	}
	var content = __QUN_RECD_CONTENT__;
	var at = '';
	if (obj.checked) {
		if (isUndefined(CHECKED[obj.id])) {
			CHECKED[obj.id] = $('#nickname_wp_'+obj.value).html();
			for (i in CHECKED) {
				at = at+'@'+CHECKED[i]+' ';
			}
			content = content+at;
			$("#topic_simple_content").val(content);
		}
	} else {
		var n = $('#nickname_wp_'+obj.value).html();
		CHECKED = remove_ele(CHECKED, n);
		for (i in CHECKED) {
			at = at+'@'+CHECKED[i]+' ';
		}
		$("#topic_simple_content").val(content+at);
	}
}

var __USERS__ = Array();
function checkedFans(obj)
{
	if (obj.checked) {
		if (isUndefined(__USERS__[obj.value])) {
			
			__USERS__[obj.value] = $('#userfans_nickname_'+obj.value).val();
		}
	} else {
		__USERS__ = remove_ele(__USERS__, $('#userfans_nickname_'+obj.value).val());
	}
}

/**
 * ����Ⱥ����
 */
function sendQunInvite(qid){
	if(publishSubmit('','','topic_simple_content')){
		setTimeout(function(){location.href = 'index.php?mod=qun&qid='+qid;},1000);
	}
}

/*
function sendQunInvite()
{
	if (__USERS__.length < 1) {
		MessageBox('warning', '�㻹û��ѡ��Ҫ��������ķ�˿��');
		return false;
	}
	
	var message = $('#invite_message').val();
	if ('' == message) {
		MessageBox('warning', '����Ҫ˵��ʲô��');
		return false;
	}
	
	var to_user = __USERS__.toString();
	
	var qid = $('#hid_qid').val();

	var post_data = {
		'message':message,
		'to_user':to_user
	}
	$.post(
		"ajax.php?mod=pm&code=do_add",
		post_data,
		function (d) {
			if ('' != d) {
				MessageBox('warning', d);
				return false;
			} else {
				show_message('��������ɹ�');
				goQun(qid);
			}
		}
	);
}
*/

function goQun(qid){
	if(qid < 1){
		show_message('��ȷ����Ҫ�����'+__WEIQUN__);
		return false;
	}
	location.href = thisSiteURL + "index.php?mod=qun&qid="+qid;
}

//����Ⱥ��
function create_qun()
{
}

/**
 * ��ʾ�Ƽ�Ⱥ�Ի���
 */
function showRecommendQunDialog(qid)
{
	var handle_key = 'recommend_qun_dialog';
	showDialog(handle_key, 'ajax', '�Ƽ�', {url:'ajax.php?mod=qun&code=recd2w&qid='+qid}, 500);
}

/**
 * ��ʾ�������Ⱥ�Ի���
 */
function showApplyQunDialog(qid)
{
	var handle_key = 'apply_qun_dialog';
	var title = '����'+__WEIQUN__;
	showDialog(handle_key, 'local', title , {id:'apply_qun_wp'}, 500);
	
	//ȡ����ť
	$('#cancel_btn').click(
		function(){
			closeDialog(handle_key);
		}
	);
	
	//���밴ť
	$('#apply_qun_btn').click(
		function(){
			var message = $('#apply_msg').val();
			if (message.length < 1) {
				MessageBox('warning', '����Ӧ��д��ʲô��');
				return false;
			}
			applyQun(qid, message);
		}
	);
}

/**
 * ��ɢȺ
 */
function dismissQun(qid)
{
	var param = {
		'onClickYes':function(){
			location.href="index.php?mod=qun&code=domanage&op=dismiss&qid="+qid;
		}
	}
	MessageBox('confirm', "��ȷ��Ҫ��ɢ��ǰ"+__WEIQUN__+"��", '��ʾ', param);
}

function quntheme(obj) {
	var ele= obj.split(",");

    $("#color-background").val(ele[0]);
    $("#color-background").css("background-color",ele[0]);
    $("#color-text").val(ele[1]);
    $("#color-text").css("background-color",ele[1]);
    $("#color-links").val(ele[2]);
    $("#color-links").css("background-color",ele[2]);

    $("body").css("backgroundColor",ele[0]);
    $("body").css("color",ele[1]);
    $("a").css("color",ele[2]);

    $("#setbgyes").css("backgroundImage","url("+thisSiteURL+"static/image/quntheme/"+ele[3]+"/themebg_preview.jpg)");
    $("#user-background-"+ele[4]).attr("checked",true);
    if (ele[4]=="repeat") {
        $("body").css("background",ele[0]+" url("+thisSiteURL+"static/image/quntheme/"+ele[3]+"/themebg.jpg) repeat scroll left top");
    } else if (ele[4]=="center"){
        $("body").css("background",ele[0]+" url("+thisSiteURL+"static/image/quntheme/"+ele[3]+"/themebg.jpg) no-repeat scroll center top");
    } else if (ele[4]=="left"){
        $("body").css("background",ele[0]+" url("+thisSiteURL+"static/image/quntheme/"+ele[3]+"/themebg.jpg) no-repeat scroll left top");
    }
	
    $("#qun_theme_id").val(ele[3]);
    document.getElementById(ele[3]).checked = "checked";
}
