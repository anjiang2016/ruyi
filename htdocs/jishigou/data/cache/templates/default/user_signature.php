<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?><span class="un"> <?php if($val['anonymous']) { ?> <a title="<?php echo $val['nickname']; ?>" href="javascript:void(0)" class="photo_vip_t_name"><?php echo $val['nickname']; ?></a> <?php } else { ?><a title="查看<?php echo $val['nickname']; ?>的<?php echo $this->Config['changeword']['n_weibo']; ?>" href="index.php?mod=<?php echo $val['username']; ?>" class="photo_vip_t_name"  onmouseover="get_at_user_choose('<?php echo $val['nickname']; ?>',this)"><?php echo $val['nickname']; ?></a> <?php if($val['validate_html']) { ?> <?php echo $val['validate_html']; ?> <?php } else { ?> <?php if($this->Config['topic_level_radio']) { ?> <span class="wb_l_level"> <a class="ico_level wbL<?php echo $val['level']; ?>" title="等级：<?php echo $val['level']; ?>级" href="index.php?mod=settings&code=exp" target="_blank"><?php echo $val['level']; ?></a> </span> <?php } ?> <?php } ?> <?php if($this->Config['is_signature']) { ?> <?php if(!$_GET['mod_original'] && 'photo'!=$this->Code) { ?> <?php if($val['signature']) { ?> <span class="signature"> <?php if($val['uid'] == MEMBER_ID ||  'admin' == MEMBER_ROLE_TYPE) { ?> <a href="javascript:void(0);" onclick="follower_choose(<?php echo $val['uid']; ?>,'<?php echo $val['nickname']; ?>','topic_signature');" title="点击修改个人签名"> <em ectype="user_signature_ajax_<?php echo $val['uid']; ?>">（<?php echo $val['signature']; ?>）</em> </a> <?php } else { ?><em> (<?php echo $val['signature']; ?>)</em> <?php } ?> </span> <?php } ?> <?php } ?> <?php } ?> <?php } ?> </span>