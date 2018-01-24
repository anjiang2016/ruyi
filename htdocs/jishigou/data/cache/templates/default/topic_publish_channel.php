<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?><div id="tochannel" style="display:none;"> <script type="text/javascript">
$(document).ready(function(){
$("#p_channel,#t_pb").bind('mouseover', function(){$('#p_channel').show();$('#t_pb').addClass('hover');});
$("#p_channel,#t_pb").bind('mouseout', function(){$('#p_channel').hide();$('#t_pb').removeClass('hover');});
});
function c_hide(){$('#p_channel').hide();$('#t_pb').removeClass('hover');}
function c_cut(){$('#t_channel').html('');$('#mapp_item<?php echo $h_key; ?>').val('<?php echo $this->item; ?>');$('#mapp_item_id<?php echo $h_key; ?>').val('<?php echo $this->item_id; ?>');$('#cverify').val('<?php echo $this->Config['verify']; ?>');}
<?php $channel_must = $this->Channel_enable && $this->Config['channel_enable'] && $this->Config['channel_must'] ? 1 : 0; ?>
function c_int(n,s,c){	$('#p_channel').hide();	$('#t_pb').removeClass('hover');	$('#t_channel').html(s+'<em onclick="c_cut();">×</em>');	$('#mapp_item<?php echo $h_key; ?>').val('channel');	$('#mapp_item_id<?php echo $h_key; ?>').val(n);	$('#cverify').val(c);}
function c_no(){show_message('您没有权限发'+__N_WEIBO__+'到该频道',2,'提示','msgBox','msg_alert');return false;}
</script> <div class="box_4_channel" 
<?php if($_GET['type']=='nedu') { ?>
style="display:none;"
<?php } ?>
> <span class="select" id="t_pb">选择频道</span> <span class="channel" id="t_channel" style=" display:inline;font-weight:500; float:none;"><?php echo $post_channel_name; ?></span> <div class="channels" id="p_channel" style="*margin:0 0 0 -91px;"> <?php if($this->Channels) { ?> <?php if(is_array($this->Channels)) { foreach($this->Channels as $val) { ?> <dl> <dt> <?php if($val['ok']) { ?> <a onclick="c_int(<?php echo $val['ch_id']; ?>,'<?php echo $val['ch_name']; ?>',<?php echo $val['ck']; ?>);"><?php echo $val['ch_name']; ?></a> <?php } else { ?><a onclick="c_no();" class="hui" title="您所在的用户组没有权限发<?php echo $this->Config['changeword']['n_weibo']; ?>到该频道"><?php echo $val['ch_name']; ?></a> <?php } ?> </dt> <dd> <?php if($val['child']) { ?> <?php if(is_array($val['child'])) { foreach($val['child'] as $v) { ?> <?php if($v['ok']) { ?> <a onclick="c_int(<?php echo $v['ch_id']; ?>,'<?php echo $v['ch_name']; ?>',<?php echo $v['ck']; ?>);"><?php echo $v['ch_name']; ?></a> <?php } else { ?><a onclick="c_no();" class="hui" title="您所在的用户组没有权限发<?php echo $this->Config['changeword']['n_weibo']; ?>到该频道"><?php echo $v['ch_name']; ?></a> <?php } ?> <?php } } ?> <?php } else { ?>&nbsp;
<?php } ?> </dd> </dl> <?php } } ?> <?php } else { ?><p>没有频道可供发布</p> <?php } ?> </div> </div> </div>