<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/*
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
*/

include_once(G5_THEME_PATH.'/head.main.php');
?>
	<div id="contents" class="div-cont">
	<!-- page star // -->
      <div id="mVisual">
        <div class="inner">
          <ul class="gallery">
            <li style="background:url(_Img/Main/img1.jpg) no-repeat">1</li>
            <li style="background:url(_Img/Main/img2.jpg) no-repeat">2</li>
            <li style="background:url(_Img/Main/img3.jpg) no-repeat">3</li>
          </ul>
        </div>
        <script type="text/javascript">
	$(window).bind("load", function(){
		loopGallery("mVisual", 7000);
	});
</script>
        <div class="msec-cont">
			<div class="msec-02">
				<?php echo latest('notice', 'notice', 4, 50); ?>
				<div class="msec-quick"> <a href="Community/community02.php" alt="내부제보" ><img src="_Img/Main/b_info.jpg" width="412" height="201" /></a> </div>
			</div>
        </div>
      </div>
      <!-- page end // -->
	</div>

<?php
include_once(G5_THEME_PATH.'/tail.main.php');
?>