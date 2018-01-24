<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename mall.mod.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 1896981208 6283 $
 */





if (!defined('IN_JISHIGOU')) {
    exit('invalid request');
}


class ModuleObject extends MasterObject {

    var $auto_run = true;

    public function ModuleObject($config) {
        $this->MasterObject($config);
    }

    
    public function convertible() {        
        MEMBER_ID == 0 &&  json_error('���Ƚ��е�¼');
        $config = jconf::get('mall');
        (int)$config['enable']  === 0 && json_error('û�п��������̳�ģ��');
        $gid     = jget("gid",'int');
        $address = trim(jget('address','txt'));
        $mobile  = jget('mobile','mobile');
        $qq      = trim(jget('qq'));
        $cid     = jget("cid",'int');
        $num     = 1;
		$company_enable = $GLOBALS['_J']['config']['company_enable'];
		if($company_enable){
			$cid === 0 && json_error('��ѡ��������λ');
			$company = jtable('company')->info($cid);
			$address = $company['name'];
			if($company['upid']){
				$upaddress = '';
				$upcids = explode(',',$company['upid']);
				foreach($upcids as $val){
					$upinfo = jtable('company')->info($val);
					$upaddress .= $upinfo['name'];
				}
				$address = $upaddress . $address;
			}
		}elseif(strlen($address)<16){
			return json_error('����д��Ч���ͻ���ַ');
		}
		$info    = jlogic('mall')->get_info($gid);
		$member  = jsg_member_info(MEMBER_ID);
		$config  = jconf::get('mall');
        if ( empty($mobile) ) {
            return json_error('����д��ȷ���ֻ�����');
        }
        if(TIMESTAMP > ($info['expire'])){
            return json_error('��Ʒ�ѹ��ڣ�');
        }
        if ($info['credit'] > $member['credits']) {
            return json_error('�����ܻ���û�дﵽ�һ�����Ʒ���ܻ���Ҫ��');
        }
        if ($info['price'] > $member[$config['credits']]) {
            return json_error('����'.$config['credits_name'].'����');
        }
        if($num > $info['total']){
            return json_error('�����Ʒ���㣡');
        }
        $data = array(
            'goods_id'      => $info['id'],
            'goods_name'    => $info['name'],
            'goods_num'     => $num,
            'goods_price'   => $info['price'],
            'goods_credit'  => $info['credit'],
            'pay_credit'    => $info['price'],
            'address'       => $address,
            'tel'           => $tel,
            'qq'            => $qq,
            'mobile'        => $mobile,
            'add_time'      => TIMESTAMP,
            'pay_time'      => TIMESTAMP,
            'status'        => 0,
        );
        $r = jlogic('mall_order')->add_order($data);
        return $r ? json_result('�һ���Ʒ�ɹ�') : json_error('�һ���Ʒʧ��') ;
    }

    
    function ordership(){
        if('admin' === MEMBER_ROLE_TYPE){
			$config = jconf::get('mall');
			$mall_enable = (int)$config['enable'];
			if ($mall_enable === 0 ) {
				return json_error('û�п��������̳�ģ��');
			}
			$order_id = jget('oid','int');
			if ($order_id === 0) {
				return json_error('û���ҵ���������');
			}
			$order = jtable("mall_order")->info($order_id);
			if (empty($order)) {
				return json_error('û���ҵ���������');
			}
			jtable("mall_order")->update(array('status' => 1), array('id'=>$order_id));
			jtable('mall_order_action')->insert(array('uid'=>$order['uid'],'order_id'=>$order['id'],'status'=>1,'msg'=>'','dateline'=>TIMESTAMP));
			return json_result('���������ɹ�') ;
		}
    }

    
    function ordercancle(){
		if('admin' === MEMBER_ROLE_TYPE){
			$config = jconf::get('mall');
			$mall_enable = (int)$config['enable'];
			if ($mall_enable === 0 ) {
				return json_error('û�п��������̳�ģ��');
			}
			$order_id = jget('oid','int');
			if ($order_id === 0) {
				return json_error('û���ҵ���������');
			}
			$order = jtable("mall_order")->info($order_id);
			if (empty($order)) {
				return json_error('û���ҵ���������');
			}
						jtable('mall_goods')->update_count(array('id' => $order['goods_id']), 'seal_count', '-'.$order['goods_num']);
			jtable('mall_goods')->update_count(array('id' => $order['goods_id']), 'total', '+'.$order['goods_num']);		
			jtable("mall_order")->update(array('status' => 2), array('id'=>$order_id));
						update_credits_by_action('unconvert',$order['uid'],1,$order['pay_credit']);
			return json_result('����ȡ���ɹ�') ;
		}
    }

		function listcompany(){
		$gid = jget('gid');
		$info = jlogic('mall')->get_info($gid);
		$member  = jsg_member_info(MEMBER_ID);
		$config  = jconf::get('mall');
		if(MEMBER_ID == 0){echo '<center><br><br><font color=red onclick="ShowLoginDialog(); return false;" style="font-weight:600;cursor: pointer;font-size:14px;">���ȵ�¼��</font><br><br><br><br></center>';}
		elseif (TIMESTAMP > ($info['expire'])){
            echo '<center><br><br><font color=red>��Ҫ�һ�����Ʒ�ѹ����¼ܣ��޷��һ���</font><br><br><br><br></center>';
        }elseif ($info['credit'] > $member['credits']) {
            echo '<center><br><br><font color=red>�����ܻ���û�дﵽ�һ�����Ʒ���ܻ���Ҫ��</font><br><br><br><br></center>';
        }elseif ($info['price'] > $member[$config['credits']]) {
            echo '<center><br><br><font color=red>����'.$config['credits_name'].'���㣬û�дﵽ�һ�����Ʒ����Ҫ��'.$config['credits_name'].'��</font><br><br><br><br></center>';
        }elseif($num > $info['total']){
            echo '<center><br><br><font color=red>��Ҫ�һ�����Ʒ��治�㣡</font><br><br><br><br></center>';
        }else{
			$company_enable = $GLOBALS['_J']['config']['company_enable'];
			if($company_enable && @is_file(ROOT_PATH . 'include/logic/cp.logic.php')){
				$companyid = $GLOBALS['_J']['member']['companyid'];
				$companyselect = jlogic('cp')->get_cp_html($companyid);
			}
			include template('mall_ajax_bak');
		}
	}

}