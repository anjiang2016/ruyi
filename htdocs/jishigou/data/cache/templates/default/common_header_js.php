<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?><script type="text/javascript">
var thisSiteURL = '<?php echo $GLOBALS['_J']['config']['site_url']; ?>/';
var thisTopicLength = '<?php echo $GLOBALS['_J']['config']['topic_input_length']; ?>';
var thisMod = '<?php echo $this->Module; ?>';
var thisCode = '<?php echo $this->Code; ?>';
var thisFace = '<?php echo $__my['face_small']; ?>';
var YXM_POP_Title = '<?php echo $this->yxm_title; ?>';
var YXM_CODE_COM = '<?php echo $this->Config['seccode_comment']; ?>';
var YXM_CODE_FOR = '<?php echo $this->Config['seccode_forward']; ?>';
var __N_WEIBO__ = '<?php echo $this->Config['changeword']['n_weibo']; ?>';
var __P_WEIBO__ = '<?php echo $this->Config['changeword']['p_weibo']; ?>';
var __WEIQUN__ = '<?php echo $this->Config['changeword']['weiqun']; ?>';
var publish_in_str=[<?php echo $this->Config['in_publish_notice_js']; ?>];
var __ALERT__='<?php echo $this->Config['verify_alert']; ?>';
<?php if($GLOBALS['_J']['config']['qun_setting']['qun_open']) { ?>
var isQunClosed = false;
<?php } else { ?>var isQunClosed = true;
<?php } ?>
function faceError(imgObj) {
var errorSrc = '<?php echo $GLOBALS['_J']['config']['site_url']; ?>/images/noavatar.gif';
imgObj.src = errorSrc;
}
</script>