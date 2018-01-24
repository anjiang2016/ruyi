<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?><style type="text/css"> <?php if($this->Config['theme_text_color']) { ?>
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
</style>