<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/thumbnail.lib.php'); 

widget_css();

if( $widget_config['forum1'] ) $bo_table = $widget_config['forum1'];
else $bo_table = bo_table(1);

if( $widget_config['no'] ) $limit = $widget_config['no'];
else $limit = 6;

$list = g::posts( array(
			"bo_table" 	=>	$bo_table,
			"limit"		=>	$limit,
			"select"	=>	"idx,domain,bo_table,wr_id,wr_parent,wr_is_comment,wr_comment,ca_name,wr_datetime,wr_hit,wr_good,wr_nogood,wr_name,mb_id,wr_subject,wr_content"
				)
		);	

if ( $list ) {?>
<div class='bottom_latest'>
<?
	$count_bottom_posts = 0;
	foreach ( $list as $li ) {
		$thumb = get_list_thumbnail($bo_table, $li['wr_id'], 112, 112);
		
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
	<div style='clear:both'></div>
</div>
<?
}
?>