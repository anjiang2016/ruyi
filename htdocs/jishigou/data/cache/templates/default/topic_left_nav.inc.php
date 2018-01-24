<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?><div class="Menu"> <div class="leftNav" id="leftNav"> <?php if($my_member || $member) { ?> <?php $_mymember = $my_member ? $my_member : $member ?> <?php } ?> <?php $top_nav_key=jget('top_nav');
if(empty($top_nav_key) || in_array($top_nav_key, array('mall', )) || empty($GLOBALS['_J']['config']['navigation'][$top_nav_key]['list']))
$top_nav_key='index';
$top_nav=$GLOBALS['_J']['config']['navigation'][$top_nav_key]; ?> <?php if(is_array($top_nav['list'])) { foreach($top_nav['list'] as $side_nav_key => $side_nav) { ?> <div class="blackBox"></div> <ul class="leftNav_main"> <?php if($side_nav['url']) { ?> <h3><a title="<?php echo $side_nav['name']; ?>" target="<?php echo $side_nav['target']; ?>" href="
<?php echo nav_url($side_nav['url'], $top_nav_key); ?>
"><?php echo $side_nav['name']; ?></a></h3> <?php } else { ?><h3><?php echo $side_nav['name']; ?></h3> <?php } ?> <?php if(is_array($side_nav['list'])) { foreach($side_nav['list'] as $nav_key => $nav) { ?> <?php if($nav['display_in_side']) { ?> <li class="left_nav_menu
<?php if(jget('side_nav')==$nav_key) { ?>
m_selected
<?php } ?>
" currname="<?php echo $nav_key; ?>"> <?php if($nav['icon']) { ?> <i class="ico_menu"><img src="<?php echo $nav['icon']; ?>" /></i> <?php } ?> <a href="
<?php echo nav_url($nav['url'], $top_nav_key, $nav_key); ?>
" 
hidefocus="true" title="<?php echo $nav['name']; ?>" target="<?php echo $nav['target']; ?>"> <var><?php echo $nav['name']; ?></var> <?php if($nav['num_field']) { ?> <span id="nav_num_<?php echo $nav_key; ?>"> <?php if($nav['num']) { ?> <em><?php echo $nav['num']; ?></em> <?php } ?> </span> <?php } ?> </a> </li> <?php } ?> <?php } } ?> <?php if($side_nav['more']) { ?> <li id="side_nav_more_<?php echo $side_nav_key; ?>"> <a href="javascript:void(0);" id="zk1">更多<i></i></a> <ul class="side_nav_more_box" id="side_nav_more_box_<?php echo $side_nav_key; ?>"> <?php if('channel'==$side_nav_key) { ?> <?php $channel_trees=jconf::get('channel','trees'); ?> <?php if(is_array($channel_trees)) { foreach($channel_trees as $top_ch) { ?> <div class="leftChannel"> <a name="<?php echo $top_ch['name']; ?>" href="index.php?mod=channel&id=<?php echo $top_ch['id']; ?>" class="lcb"><?php echo $top_ch['name']; ?></a> <div class="lca_box"> <?php if(is_array($top_ch['child'])) { foreach($top_ch['child'] as $ch_id => $ch_name) { ?> <a name="<?php echo $ch_name; ?>" href="index.php?mod=channel&id=<?php echo $ch_id; ?>" class="lca"><?php echo $ch_name; ?></a> <?php } } ?> </div> </div> <?php } } ?> <?php } else { ?> <?php if(is_array($side_nav['list'])) { foreach($side_nav['list'] as $nav_key => $nav) { ?> <?php if(!$nav['display_in_side']) { ?> <li class="left_nav_menu" currname="<?php echo $nav_key; ?>"> <a href="
<?php echo nav_url($nav['url'], $top_nav_key, $nav_key); ?>
" 
<?php if(jget('side_nav')==$nav_key) { ?>
class="m_selected" 
<?php } ?>
hidefocus="true" title="<?php echo $nav['name']; ?>" target="<?php echo $nav['target']; ?>"><?php echo $nav['name']; ?> <?php if($nav['num_field']) { ?> <span id="nav_num_<?php echo $nav_key; ?>"> <?php if($nav['num']) { ?> <em><?php echo $nav['num']; ?></em> <?php } ?> </span> <?php } ?> </a> </li> <?php } ?> <?php } } ?> <?php } ?> </ul> <script type="text/javascript">  
$(function(){       
$("#side_nav_more_<?php echo $side_nav_key; ?>").mouseover(function(){
$("#side_nav_more_<?php echo $side_nav_key; ?> #zk1 i").css("top","1px");
$("#side_nav_more_box_<?php echo $side_nav_key; ?>").show();
});
$("#side_nav_more_<?php echo $side_nav_key; ?>").mouseout(function(){
$("#side_nav_more_<?php echo $side_nav_key; ?> #zk1 i").css("top","2px");
$("#side_nav_more_box_<?php echo $side_nav_key; ?>").hide();
});
});
</script> </li> <?php } ?> </ul> <?php } } ?> </div> <script type="text/javascript" src="static/js/nav.js?build+20140922"></script> <script type="text/javascript">
$(document).ready(function(){get_new_topic_nums();});
function circle_nav_num(){get_new_topic_nums();setTimeout('circle_nav_num();',60000);}
setTimeout('circle_nav_num();',60000);
$(".left_nav_menu").bind('click',function(){var name=$(this).attr("currname");if(name){modify_new_topic_nums(name);}});
/*兼容小分辨率暂时解决办法*/
var screenH = window.screen.height;
if (screenH < 750 )
{   
$(".Menu").css("position","static");	
$("#leftNav").append('<p class="btn_group">折叠菜单</p>');
$(".btn_group").click(function(){
$(".leftNav_main > li").slideToggle();
});
}
</script> </div>