<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?><success></success> <?php if($total_record > 0) { ?> <div class="newTig" onclick="ajax_reminded('<?php echo $uid; ?>',1,'<?php echo $fcode; ?>'); return false;"><a href="#">��<b><?php echo $total_record; ?></b>���µ����ݸ��£���˲鿴</a></div> <?php } ?> <?php if($__my['comment_new']>0 || $__my['fans_new']>0 || $__my['at_new']>0 || $__my['newpm']>0 || $__my['favoritemy_new']>0 || $__my['vote_new']>0 || $__my['qun_new']>0 || $__my['event_new']>0 || $__my['event_post_new']>0 || $__my['fenlei_post_new']>0 || $__my['topic_new']>0 || $__my['dig_new']>0 || $__my['channel_new']>0 || $__my['company_new']>0) { ?> <script language="javascript">
var tagBoxContentHTML = '';
<?php if($__my['newpm']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=pm&code=list"><?php echo $__my['newpm']; ?>����˽�ţ��鿴</a></li>';
<?php } ?> <?php if($__my['comment_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=comment&code=inbox"><?php echo $__my['comment_new']; ?>�������ۣ��鿴</a></li>';
<?php } ?> <?php if($__my['fans_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=fans&uid=<?php echo $__my['uid']; ?>"><?php echo $__my['fans_new']; ?>�˹�ע���ң��鿴</a></li>';
<?php } ?> <?php if($__my['at_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=at"><?php echo $__my['at_new']; ?>��@�ᵽ�ң��鿴</a></li>';
<?php } ?> <?php if($__my['favoritemy_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=topic_favorite&code=me"><?php echo $__my['favoritemy_new']; ?>���ղ��ҵ����ݣ��鿴</a></li>';
<?php } ?> <?php if($__my['dig_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=<?php echo $__my['username']; ?>&type=mydig">��<?php echo $__my['dig_new']; ?>��<?php echo $this->Config['changeword']['dig']; ?>���㣬�鿴</a></li>';
<?php } ?> <?php if($__my['channel_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=topic&code=channel&orderby=post">Ƶ������<?php echo $__my['channel_new']; ?>�����ݣ��鿴</a></li>';
<?php } ?> <?php if($__my['company_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=company">��λ����<?php echo $__my['company_new']; ?>�����ݣ��鿴</a></li>';
<?php } ?> <?php if($__my['vote_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=vote&view=me&filter=new_update&uid=<?php echo $__my['uid']; ?>">ͶƱ����<?php echo $__my['vote_new']; ?>�˲��룬�鿴</a></li>';
<?php } ?> <?php if($__my['qun_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=topic&code=qun">'+__WEIQUN__+'����<?php echo $__my['qun_new']; ?>�����ݣ��鿴</a></li>';
<?php } ?> <?php if($__my['event_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=event&code=myevent&type=new">�����<?php echo $__my['event_new']; ?>�˱������鿴</a></li>';
<?php } ?> <?php if($__my['topic_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=topic_tag">����<?php echo $__my['topic_new']; ?>���������ݣ��鿴</a></li>';
<?php } ?> <?php if($__my['event_post_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=topic&code=other&view=event">����<?php echo $__my['event_post_new']; ?>����ע�Ļ���鿴</a></li>';
<?php } ?> <?php if($__my['fenlei_post_new']>0) { ?>
tagBoxContentHTML += '<li><a href="index.php?mod=topic&code=other&view=fenlei">����<?php echo $__my['fenlei_post_new']; ?>��������Ϣ���鿴</a></li>';
<?php } ?>
if(''!=tagBoxContentHTML)
{
tagBoxContentHTML = '<ul>' + tagBoxContentHTML + '</ul>';
$('#tagBoxContent_<?php echo $uid; ?>').html(tagBoxContentHTML);
$('#tagBox_<?php echo $uid; ?>').css({
display: 'block',
visibility: 'visible'
});
}
</script> <?php } ?>