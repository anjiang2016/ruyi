<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?><!doctype html> <html> <head> <?php $__my=$GLOBALS['_J']['member']; ?> <base href="<?php echo $this->Config['site_url']; ?>/" /> <title> <?php echo jhtmlspecialchars($this->Title); ?>
- <?php echo $this->Config['site_name']; ?>(<?php echo $this->Config['site_domain']; ?>)<?php echo $GLOBALS['_J']['config']['page_title']; ?></title> <?php $conf_charset=$this->Config['charset']; ?> <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $conf_charset; ?>" /> <meta http-equiv="X-UA-Compatible" content="Chrome=1,IE=edge" /> <?php if($this->Config['default_module']==$this->Module && $this->Code==$this->Config['default_code']) { ?> <meta name="Keywords" content="<?php echo $this->Config['index_meta_keywords']; ?>,
<?php echo jhtmlspecialchars($this->MetaKeywords); ?>
,<?php echo $GLOBALS['_J']['config']['site_name']; ?><?php echo $GLOBALS['_J']['config']['meta_keywords']; ?>" /> <meta name="Description" content="<?php echo $this->Config['index_meta_description']; ?>,
<?php echo jhtmlspecialchars($this->MetaDescription); ?>
,<?php echo $GLOBALS['_J']['config']['site_notice']; ?><?php echo $GLOBALS['_J']['config']['meta_description']; ?>" /> <?php } else { ?><meta name="Keywords" content="
<?php echo jhtmlspecialchars($this->MetaKeywords); ?>
,<?php echo $GLOBALS['_J']['config']['site_name']; ?><?php echo $GLOBALS['_J']['config']['meta_keywords']; ?>" /> <meta name="Description" content="
<?php echo jhtmlspecialchars($this->MetaDescription); ?>
,<?php echo $GLOBALS['_J']['config']['site_notice']; ?><?php echo $GLOBALS['_J']['config']['meta_description']; ?>" /> <?php } ?> <link rel="shortcut icon" href="favicon.ico" > <!-- <link href="<?php echo $GLOBALS['_J']['config']['site_url']; ?>/static/min/?g=css&c=<?php echo $GLOBALS['_J']['charset']; ?>&v=<?php echo SYS_BUILD; ?>" rel="stylesheet" type="text/css" /> --> <link href="static/style/main.css?build+20140922" rel="stylesheet" type="text/css" /> <link href="static/style/send.css?build+20140922" rel="stylesheet" type="text/css" /> <link href="static/style/global.css?build+20140922" rel="stylesheet" type="text/css" /> <link href="static/style/sidebar.css?build+20140922" rel="stylesheet" type="text/css" /> <?php if($this->Config['qun_theme_id']) { ?> <link href="static/style/qun_theme/<?php echo $this->Config['qun_theme_id']; ?>.css?v=<?php echo SYS_BUILD; ?>" rel="stylesheet" type="text/css" /><?php } elseif($this->Config['theme_id']) { ?><link href="theme/<?php echo $this->Config['theme_id']; ?>/theme.css?v=<?php echo SYS_BUILD; ?>" rel="stylesheet" type="text/css" /> <?php } ?> <link href="static/style/hack.css?build+20140922" rel="stylesheet" type="text/css" /><style type="text/css"> <?php if($this->Config['theme_text_color']) { ?>
body{ color:<?php echo $this->Config['theme_text_color']; ?>; }
<?php } ?> <?php if($this->Config['theme_bg_color']) { ?>
body{ background-color:<?php echo $this->Config['theme_bg_color']; ?>; }
<?php } ?> <?php if($this->Config['theme_bg_image']) { ?>
body{ background-image:url(<?php echo $this->Config['theme_bg_image']; ?>); }
<?php } ?> <?php if($this->Config['theme_bg_position']) { ?>
body{ background-position:<?php echo $this->Config['theme_bg_position']; ?>; }
<?php } ?> <?php if($this->Config['theme_bg_repeat']) { ?>
body{ background-repeat:<?php echo $this->Config['theme_bg_repeat']; ?>; }
<?php } ?> <?php if($this->Config['theme_bg_fixed']) { ?>
body{ background-attachment:<?php echo $this->Config['theme_bg_fixed']; ?>; }
<?php } ?> <?php if($this->Config['theme_text_color']) { ?>
body{ color:<?php echo $this->Config['theme_text_color']; ?>; }
<?php } ?> <?php if($this->Config['theme_link_color']) { ?>
a:link{ color:<?php echo $this->Config['theme_link_color']; ?>; }
<?php } ?>
ul.imgList li .showcursor,a.artZoom{ cursor:url(<?php echo $GLOBALS['_J']['config']['site_url']; ?>/static/image/magnifier_b.cur), pointer; }
.artZoomBox a.maxImgLink { cursor:url(<?php echo $GLOBALS['_J']['config']['site_url']; ?>/static/image/magnifier_s.cur), pointer; }
a.artZoom2{ cursor:url(<?php echo $GLOBALS['_J']['config']['site_url']; ?>/static/image/magnifier_b.cur), pointer; }
a.artZoom3{ cursor:url(<?php echo $GLOBALS['_J']['config']['site_url']; ?>/static/image/magnifier_b.cur), pointer; }
.artZoomBox a.maxImgLink3 { cursor:url(<?php echo $GLOBALS['_J']['config']['site_url']; ?>/static/image/magnifier_s.cur), pointer; }
a.artZoomAll{ cursor:url(<?php echo $GLOBALS['_J']['config']['site_url']; ?>/static/image/magnifier_b.cur), pointer; }
.artZoomBox a.maxImgLinkAll { cursor:url(<?php echo $GLOBALS['_J']['config']['site_url']; ?>/static/image/magnifier_s.cur), pointer; }
</style><script type="text/javascript">
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
</script> <!-- <script type="text/javascript" src="<?php echo $GLOBALS['_J']['config']['site_url']; ?>/static/min/?g=js&c=<?php echo $GLOBALS['_J']['charset']; ?>&v=<?php echo SYS_BUILD; ?>"></script> --> <script type="text/javascript" src="static/js/cookies.js?build+20140922"></script> <script type="text/javascript" src="static/js/min.js?build+20140922"></script> <script type="text/javascript" src="static/js/common.js?build+20140922"></script> <script type="text/javascript" src="static/js/publishbox.js?build+20140922"></script> <script type="text/javascript" src="static/js/jsgst.js?build+20140922"></script> <?php if(in_array(jget('mod'), array("follow","fans"))) { ?> <script type="text/javascript" src="static/js/relation.js?build+20140922"></script> <?php } ?> <?php if($this->Get['mod']=="vote") { ?> <script type="text/javascript" src="static/js/vote.js?build+20140922"></script> <?php } ?> <?php if($this->Get['mod']=="qun") { ?> <script type="text/javascript" src="static/js/qun.js?build+20140922"></script> <?php } ?> </head> <?php echo $additional_str; ?> <body> <div class="j-wrap">