/**
 * ͶƱ����js��
 * 
 * @category   Vote
 * @author     ~ZZ~
 * @version $Id$
 */
 
/**
 * ��ʾ�޸Ľ�ֹʱ��Ի���
 */
function showModifyVoteExpirationDialog(vid)
{
	var handle_key = 'vote_modify_expiration';
	
	//������
	var checkerror = function(data) {
		if (is_json(data)) {
			var json = eval('('+data.toString()+')');
			closeDialog(handle_key);
			var clickEvent = function() {
				location.href = "index.php?mod=login";
			};
			MessageBox('warning', json.msg, '��ʾ', {onclick:clickEvent});
			return false;
		}
		return true;
	}
	showDialog(handle_key, 'ajax', '�޸Ľ�ֹʱ��', {url:'ajax.php?mod=vote&code=manage&op=modify_date&vid='+vid,checkerror:checkerror}, 420);
}

/**
 * �ر��޸Ľ�ֹʱ��Ի���
 */
function closeModifyVoteExpirationDialog()
{
	closeDialog('vote_modify_expiration');
}

/**
 * �޸Ľ�ֹʱ��
 */
function modifyVoteExpiration(vid)
{
	var expiration = $("#expiration").val();
	var old = expiration;
	expiration += ' '+$("#hour").val()+":"+$("#min").val();
	$("#expiration").val(expiration);
	var post_data = $('#me_form').serialize();
	$("#expiration").val(old);
	$.post(
		$('#me_form').attr("action"),
		post_data,
		function (r) {
			if (r.done) {
				closeDialog('vote_modify_expiration');
				location.reload();
				/*
				options = {
					onclick:function() {
						location.reload();
					},
					close_first:true
				};
				MessageBox('notice', r.msg, '��ʾ', options);
				*/
			} else {
				if (r.msg) {
					MessageBox('warning', r.msg);
				}
			}
		},
		'json'
	)
}

/**
 * ��ʾ����ѡ��Ի���
 */
function showEditVoteDialog(vid)
{
	var handle_key = 'vote_edit_option';
	
	//������
	var checkerror = function(data) {
		if (is_json(data)) {
			var json = eval('('+data.toString()+')');
			closeDialog(handle_key);
			var clickEvent = function() {
				location.href = "index.php?mod=login";
			};
			MessageBox('warning', json.msg, '��ʾ', {onclick:clickEvent});
			return false;
		}
		return true;
	}
	showDialog(handle_key, 'ajax', '�༭ͶƱ', {url:'ajax.php?mod=vote&code=manage&op=edit&vid='+vid,checkerror:checkerror}, 420);
}

/**
 * �ر��޸Ľ�ֹʱ��Ի���
 */
function closeEditVoteOptionDialog()
{
	closeDialog('vote_edit_option');
}

/**
 * ɾ����ǰͶƱ
 */
function deleteVote(vid)
{
	options = {
		'onClickYes':function(){
			$.post(
				'ajax.php?mod=vote&code=del',
				{"vid":vid},
				function (r){
					if (r.done) {
						//���ʡ����ɾ���ɹ�����ʾ
						location.href="index.php?mod=vote";
					} else {
						MessageBox('warning', r.msg);
					}
				},
				'json'
			)
		}
	}
	MessageBox('confirm', "��ȷ��ɾ�����ͶƱ��", '��ʾ', options);
}

/**
 * ͶƱ
 */
function vote()
{
	var check_uid = $('#check_PublishBox_uid').val();
	var uid ='undefined'==typeof(check_uid)?'0':check_uid;	
	if(uid < 1){
		ShowLoginDialog();
		return false;
	}
	var post_data = $('#vote_form').serialize();
	var action = $('#vote_form').attr("action");
	if (action) {
		$.post(
			action, 
			post_data, 
			function(r){
				if (!is_json(r)) {
						/*
						$("#vote_tips").html(r.msg);
						$('#item').val('vote');
						$('#item_id').val(r.retval.vid);
						$('#topic_simple_content').html(r.retval.content);
						*/
						var handle_key = 'vote_success_share';
						showDialog(handle_key, 'local', '����һ��', {html:r}, 500);
						$('#topic_simple_close_btn').click(
							function() {
								closeDialog(handle_key);
								location.reload();
							}
						);
						$('#topic_simple_share_btn').click(
							function () {
								var response = function() {
									location.reload();
								}
								publishSimpleTopic($('#topic_simple_content').val(), 'vote', $("#topic_simple_item_id").val(), {response:response,topic_type:$('#topic_simple_type').val()});
								//publishSimpleTopic($('#topic_simple_content').val(), '', 0, {response:response});
							}
						);
				} else {
					var json = eval('('+r.toString()+')');
					if (json.done) {
						location.reload();
					} else {
						MessageBox('warning', json.msg);
					}
				}
			}
		);
	}
}

/**
 * ����ͶƱ
 */
function commentVote(vid)
{
	var content = $('#app_content').val();
	var options = {
		response:function(){
			//listTopic(0,0);
			listAreaPrependTopic();
		},
		topic_type:$('#app_topic_type').val()
	};
	publishSimpleTopic(content, 'vote', vid, options);
	$('#viewImgDiv').html('');
	$('#app_content').val('');
}

/**
 * ��ȡͶƱ�����б�
 */
function getVoteRight(id)
{
	$.post(
		'ajax.php?mod=vote',
		{code:id},
		function (r){
			$('#'+id).html(r);
		}
	);
}

/**
 * ����΢���Ի���
 */
function showRecommendVoteDialog(vid, options)
{
	var handle_key = 'hk_vote_recommend_dialog';
	$myAjax = $.get(
		'ajax.php?mod=vote&code=toweibo&handle_key='+handle_key,
		{},
		function (r){
			if (is_json(r)) {
				var json = eval('('+r.toString()+')');
				var clickEvent = function() {
					location.href = "index.php?mod=login";
				};
				MessageBox('warning', json.msg, '��ʾ', {onclick:clickEvent});
				return false;
			}
			showDialog(handle_key, 'local', '����', {html:r}, 500);
			var strVoteName = $('#'+options.subject_wp).html();
			//��������
			var msg = "����:ͶƱ��"+strVoteName+"��������Ӵ�   "+thisSiteURL+"index.php?mod=vote&code=view&vid=" + vid ;
			$("#topic_simple_content_"+handle_key).html(msg);
			$('#topic_simple_close_btn_'+handle_key).click(
				function() {
					closeDialog(handle_key);
					//location.reload();
				}
			);
			$('#topic_simple_share_btn_'+handle_key).click(
				function () {
					var response = function() {
						closeDialog(handle_key);
					}
					publishSimpleTopic($('#topic_simple_content_'+handle_key).val(), 'web', vid, {response:response})
				}
			);
		}
	);
}

