<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

?>

<div id="svisual-wrap">
	<div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
        <p class="btxt"><span>청탁금지법 가이드라인</span></p>
        <div class="content-top--right">
          <span><img src="../_Img/Icon/home.png" width="25" height="24"></span>
          <span>가이드라인/법령</span>
          <span>청탁금지법 가이드라인</span>
        </div>
	</div>
	<div class="visimg vis05"></div>
</div>
<div class="content-ov">
	<div id="subNavi-wrap">
		<div id="subNavi">
			<div class="lm-tit">
				<div class="tit">
					<p class="btxt">GUIDELINE</p>
					<p class="stxt">가이드라인</p>
				</div>
			</div>		
			<div class="leftmenu" id="leftmenu">
				<ul class="depth2">
					<li id="lm01" class='lm_l2'><a href="<?php echo G5_URL?>/Guide/guide01.php"  class='lm_a2'><span class='isTxt'>지속가능경영 관련 사규</span></a></li>
					<li id="lm02" class='lm_l2'><a href="<?php echo G5_URL?>/Guide/guide02.php"  class='lm_a2'><span class='isTxt'>자율준수 편람</span></a></li>
                    <li id="lm02" class='lm_l2'><a href="<?php echo G5_URL?>/Guide/guide03.php"  class='lm_a2'><span class='isTxt'>공정거래 가이드 라인</span></a></li>
                    <li id="lm02" class='lm_l2 over'><a href="<?php echo G5_URL?>/Guide/guide04.php"  class='lm_a2'><span class='isTxt'>청탁금지법 가이드라인</span></a></li>
				</ul>
			</div>
		</div>
		<? include_once (G5_PATH.'/_Inc/helpInc.php');?>
	</div>
	
	<div id="contents">
		<div class="cont-top">
			<h2 class="tit">청탁금지법 가이드라인</h2>
			<ul class="path">
				<li><img src="<?php echo G5_URL; ?>/_Img/Sub/icon_home.png" width="13" height="16">
				<li>가이드라인</li>
				<li>청탁금지법 가이드라인</li>
			</ul>
		</div>
		<!-- page-start // -->
		<div class="tab_menu2">
          <ul>
            <li><a href="<?php echo G5_URL?>/Guide/guide04.php">청탁금지법 안내</a></li>
            <li class="on"><a href="#">청탁금지법 FAQ</a></li>
          </ul>
        </div>
		<div class="gap20"></div>
		<div class="board-search">
			<div class="total"><span>Total : <strong><?php echo number_format($total_count) ?>건</strong></span></div>
			
			<form name="fsearch" method="get">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sop" value="and">
			<div class="search">
				<select name="sfl" id="sfl">
					<option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
					<option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
					<option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>작성자</option>
				</select>
				<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" placeholder="검색어를 입력해주세요">
				<button type='submit'><img src="../../../_Img/Icon/search_icon.png" /></button>
			</div>
		</div>
		<div class="board-list-wrap">
			<p class="bd-line"></p>
			<table>
			<colgroup>
				<col scope="col" width="70">
				<col scope="col" width="*">
				<col scope="col" width="100">
				<col scope="col" width="100">
				<col scope="col" width="80">
			</colgroup>
			<thead>
				<tr>
					<th>No</th>
					<th>제목</th>
					<th>작성자</th>
					<th>등록일</th>
					<th>조회수</th>
				</tr>
			</thead>
			<tbody>
			<?php
			for ($i=0; $i<count($list); $i++) {
			?>
				<tr>
					<td><?php echo $list[$i]['num']; ?></td>
					<td class="l">
						<a href="<?php echo $list[$i]['href'] ?>">
							<?php echo $list[$i]['icon_reply'] ?>
							<?php
								if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']);
							 ?>
							<?php echo $list[$i]['subject'] ?>
						</a>
						<?php
						// if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }
						if (isset($list[$i]['icon_file'])) echo rtrim($list[$i]['icon_file']);
						if (isset($list[$i]['icon_link'])) echo rtrim($list[$i]['icon_link']);
						if (isset($list[$i]['icon_new'])) echo rtrim($list[$i]['icon_new']);
						if (isset($list[$i]['icon_hot'])) echo rtrim($list[$i]['icon_hot']);
						?>
					</td>
					<td><?php echo $list[$i]['name'] ?></td>
					<td><?php echo $list[$i]['datetime2'] ?></td>
					<td><?php echo $list[$i]['wr_hit'] ?></td>
				</tr>
			<?php } ?>
			<?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
			</tbody>
			</table>
		</div>
		<div class="sgap"></div>
		<!-- 페이지 -->
		<?php echo $write_pages;  ?>
	
		<!-- page-end //-->
	</div>
	
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>


<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
