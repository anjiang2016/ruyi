<?php /* 2017-03-31 in jishigou invalid request template */ if(!defined("IN_JISHIGOU")) exit("invalid request"); hookscriptoutput(); ?>
<?php if(!empty($topic_list)) { ?> <div id="weibo_list_wp"> <?php if(is_array($topic_list)) { foreach($topic_list as $key => $topic) { ?> <article> <div id="weibo_itmes_<?php echo $topic['tid']; ?>" class="weibo" data-tid="<?php echo $topic['tid']; ?>" 
<?php if(MEMBER_ID < 1) { ?>
data-login="0"
<?php } else { ?>data-login="1"
<?php } ?>
data-uid="<?php echo $topic['uid']; ?>" data-huifu=""> <header class="tit-wb clearfix"> <img class="avatar-wb" src="<?php echo $topic['face']; ?>" onclick="goToUserInfo(<?php echo $topic['uid']; ?>);"/> <span class="nikename-wb"><?php echo $topic['nickname']; ?><?php echo $topic['validate_string']; ?></span> <span class="origin-wb"> <time class="time-wb" onclick="goToMBlogDetail(<?php echo $topic['tid']; ?>);"><?php echo $topic['dateline']; ?></time> <?php echo $topic['from_string']; ?> </span> <?php if($topic['image_list']) { ?> <img src="./images/pic.png"/ style="position: absolute;right: 10px;top: 10px;"> <?php } ?> </header> <section class="content-wb"> <p> <?php echo $topic['content']; ?> <?php if($topic['longtextid']) { ?>
[<a href='javascript:void()' onclick='goToMBlogDetail(<?php echo $topic['tid']; ?>);'>查看全文</a>]
<?php } ?> </p> <?php if($topic['image_list']) { ?> <div class="img-wb"> <?php if(is_array($topic['image_list'])) { foreach($topic['image_list'] as $image) { ?> <img class="author" src="<?php echo $image['image_small']; ?>" style="width:100px; height:100px;" /> <?php } } ?> </div> <?php } ?> <?php if($topic['roottid'] > 0) { ?> <?php $parent=$parent_list[$topic['roottid']]; ?> <div class="tips_ico"></div> <div class="wbf"> <?php if(!empty($parent)) { ?> <div><a href=""><?php echo $parent['nickname']; ?></a> : <?php echo $parent['content']; ?></div> <?php if($parent['image_list']) { ?> <div class="share"> <?php if(is_array($parent['image_list'])) { foreach($parent['image_list'] as $image) { ?> <img class="author" src="<?php echo $image['image_small']; ?>" style="width:100px; height:100px;" /> <?php } } ?> </div> <?php } ?> <?php } else { ?>                         原始微博已删除
<?php } ?> </div> <?php } ?> </section> <footer class="action-wb"> <a href="javascript:;" class="rt-action-wb L-item-tab " onclick="goToForwardEditView('<?php echo $topic['tid']; ?>')"><p><i>&nbsp;</i><span data-num="0"> <?php if($topic['forwards'] > 0) { ?>
转发（<?php echo $topic['forwards']; ?>）
<?php } else { ?>转发
<?php } ?> </span></p></a> <a href="javascript:;" class="cmt-action-wb L-item-tab" onclick="goToCommentList('<?php echo $topic['tid']; ?>');"><p><i>&nbsp;</i><span data-num="0"> <?php if($topic['replys'] > 0) { ?>
评论（<?php echo $topic['replys']; ?>）
<?php } else { ?>评论
<?php } ?> </span></p></a> </footer> </article> <?php } } ?> </div> <?php if($list_count == Mobile::config('perpage_mblog')) { ?> <?php if($this->Module == 'topic') { ?> <?php if($this->Code=='tag') { ?> <div class="wb_more" onclick='getMoreMBlogList({"max_tid":<?php echo $max_tid; ?>, "next_page":<?php echo $next_page; ?>, "code":"tag", "tag_key":"<?php echo $tag_key; ?>"});return false;' id="btn_more">更多...</div> <?php } else { ?><div class="wb_more" onclick='getMoreMBlogList({"max_tid":<?php echo $max_tid; ?>, "next_page":<?php echo $next_page; ?>, "code":"<?php echo $this->Code; ?>", "uid":"<?php echo $param_uid; ?>"});return false;' id="btn_more">更多...</div> <?php } ?> <?php } elseif($this->Module == 'search') { ?> <div class="wb_more" onclick='getMoreMBlogList({"max_tid":<?php echo $max_tid; ?>, "next_page":<?php echo $next_page; ?>, mod:"search", "code":"<?php echo $this->Code; ?>", q:"<?php echo $keyword; ?>"});return false;' id="btn_more">更多...</div> <?php } ?> <?php } ?> <div style="margin-bottom:80px;"></div> <script language="javascript">
$(document).ready(function(){
setMBlogListEvent();
});
</script> <?php } ?>