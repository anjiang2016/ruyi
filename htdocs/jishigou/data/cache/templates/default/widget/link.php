<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?>
<?php if($link_config=ConfigHandler::get('link')) { ?> <div class="foot-line"> <p>�������ӣ�</p> <?php if(is_array($link_config)) { foreach($link_config as $link) { ?> <?php if(!empty($link['logo'])) { ?> <a href="<?php echo $link['url']; ?>" target="_blank"><img src="<?php echo $link['logo']; ?>" width="88" height="31" border="0" alt="<?php echo $link['name']; ?>"></a> <?php } else { ?><a href="<?php echo $link['url']; ?>" target="_blank"><?php echo $link['name']; ?></a> <?php } ?> <?php } } ?> </div> <?php } ?>