/**
 * ��ϵ����js����
 *
 * @author     ��~ZZ~<505171269@qq.com>����
 * @version $Id$
 */

/**
 * �Ƴ���˿�Ի���
 */
function DelMyFansAddDialog(uid)
{	
	var handle_key = 'del_my_fans';
	showDialog('del_my_fans', 'ajax', '�Ƴ���˿', {"url":"ajax.php?mod=topic&code=del_myfans&uid="+uid}, 300);	
}

/**
 * �Ƴ���˿
 */
function DoDelMyFans()
{	
	//�Ƿ����������
	var is_black = 0;
	
	//�Ƴ���˿ ID
	var touid = $("#touid").val();
	
	if($("#is_black").attr("checked"))
    {
		is_black = '1';
	}

	var myAjax=$.post(
    	"ajax.php?mod=topic&code=do_delmyfans",
    	{
    		touid:touid,
    		is_black:is_black
    	},
    	function(d)
    	{
    		if(''!=d)
            {
	        	$("#fans_user_"+touid).remove();
	        	//�ر� �Ƴ���˿�Ի���   `
				closeDialog('alert_follower_menu_'+touid);  
    		}
    	}
     );
}

