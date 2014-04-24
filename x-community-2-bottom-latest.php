<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/thumbnail.lib.php'); 

widget_css();

if( $widget_config['forum1'] ) $_bo_table = $widget_config['forum1'];
else $_bo_table = $widget_config['default_forum_id'];

if( $widget_config['no'] ) $limit = $widget_config['no'];
else $limit = 6;

$list = g::posts( array(
			"bo_table" 	=>	$_bo_table,
			"limit"		=>	$limit,
			"select"	=>	"idx,domain,bo_table,wr_id,wr_parent,wr_is_comment,wr_comment,ca_name,wr_datetime,wr_hit,wr_good,wr_nogood,wr_name,mb_id,wr_subject,wr_content"
				)
		);	
?>
<div class='bottom_latest'>
<?
$count_bottom_posts = 0;
if ( $list ) {	
	foreach ( $list as $li ) {
		$thumb = get_list_thumbnail($_bo_table, $li['wr_id'], 112, 112);
		
		$url = $li['url'];		
		$subject = cut_str($li['wr_subject'], 10, "..." );
		$content = cut_str($li['wr_content'], 40, "..." );
		
		if ( $thumb['src'] ) $img_src = $thumb['src'];
		else $img_src = x::url()."/widget/".$widget_config['name']."/img/no-image.png";
		
		if( $count_bottom_posts == 0 || $count_bottom_posts % 6 == 0 ) $first_image = 'first-image';
		else $first_image = null;
		?>
			<div class='photo <?=$first_image?>'>				
				<img src='<?=$img_src?>' />				
				<a class='info' href='<?=$url?>'><?=$subject?><br><br><?=$content?></a>
			</div>
		<?
	$count_bottom_posts++;
	}?>	
<?
}
else{
for( $i = 1; $i <= 6; $i++ ){
	if( $i == 1 ) $first_image = 'first-image';
	else $first_image = null;
	$img_src = $widget_config['url']."/img/no-image.png";
?>	
	<div class='photo <?=$first_image?>'>		
		<img src='<?=$img_src?>' />				
		<a class='info' href='javascript:void(0)?>'>No Post Subject <?=$i?><br><br>No Post Content <?=$i?></a>		
	</div>	
<?
	}
}?>
<div style='clear:both'></div>
</div>