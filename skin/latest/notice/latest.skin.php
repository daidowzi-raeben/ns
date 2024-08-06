<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<div class="msec-notice">
	<h3>공지사항</h3>
	<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" class="more"><span class="blind">더보기</span></a>
	<ul>
	<?php 
		for ($i=0; $i<count($list); $i++) {  
	?>
		<li>
			<a href="<?php echo $list[$i]['href']?>">
				<span class="tit">
				<?php
					echo $list[$i]['subject'];
				?>
				</span>
				<span class="date">[<?php echo substr($list[$i]['wr_datetime'],0,10); ?>]</span>
			</a>
		</li>
	<?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
		<li>게시물이 없습니다.</li>
    <?php }  ?>
	</ul>
</div>
