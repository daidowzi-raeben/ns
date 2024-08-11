<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 4;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;


if($bo_table == "e_campaign") {
	$strTitle = "윤리캠페인";
	$eduOver3 = " over";
} elseif($bo_table == "e_story") {
	$strTitle = "윤리경영";
	$eduOver4 = " over";
}

?>

<div id="svisual-wrap">
	<div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
		<p class="btxt"><span><?php echo $strTitle?></span></p>
        <div class="content-top--right">
          <span><img src="../_Img/Icon/home.png" width="25" height="24"></span>
          <span>교육/컨텐츠</span>
          <span><?php echo $strTitle?></span>
        </div>
	</div>
	<div class="visimg vis04"></div>
</div>
<div class="content-ov">
	<div id="subNavi-wrap">
		<div id="subNavi">
			<div class="lm-tit">
				<div class="tit">
					<p class="btxt">EDUCATION section</p>
					<p class="stxt">사이버&집체교육 </p>
				</div>
			</div>		
			<?php include_once (G5_PATH.'/Edu/edu_left.php');?>
		</div>
		<? include_once (G5_PATH.'/_Inc/helpInc.php');?>
	</div>
	
	<div id="contents">
		<div class="cont-top">
			<h2 class="tit"><?php echo $strTitle?></h2>
			<ul class="path">
				<li><img src="<?php echo G5_URL; ?>/_Img/Sub/icon_home.png" width="13" height="16">
				<li>사이버 & 집체교육</li>
				<li><?php echo $strTitle?></li>
			</ul>
		</div>
		<!-- page-start // -->
		<table class="tbl-type01">
		<colgroup>
			<col width="10%"/>
			<col width="*"/>
			<col width="15%"/>
			<col width="20%"/>
		</colgroup>
		<thead>
			<tr>
				<th>회차</th>
				<th>내용</th>
				<th>완료일시</th>
				<th>수강</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$startNum = count($list);
		for ($i=0; $i<count($list); $i++) {
			$chkView = check_point($member['mb_id'], $bo_table, $list[$i]['wr_id']);
		?>
			<tr>
				<td><?php echo $startNum ?>회</td>
				<td class="title"><?php echo $list[$i]['subject'] ?></td>
				<td><?php echo substr($chkView['po_datetime'], 0, 10) ?></td>
				<td>
					<a href="<?php echo $list[$i]['href'].'&num='.$startNum ?>" class="class-enter btn">열람하기</a>
				</td>
			</tr>
		<?php 
			$startNum--;
		} 
		?>
		<?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
		</tbody>
		</table>
		<!-- page-end //-->
	</div>
	
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>



<!-- 페이지 -->
<?php echo $write_pages;  ?>


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
