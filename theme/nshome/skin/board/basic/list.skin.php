<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

?>

<div id="svisual-wrap">
	<div class="vistxt">
		<p class="btxt"><span>커뮤니티
</span></p>
		<p class="stxt">고객, 사회, 협력사와의 동반성장을 추구합니다.</p>
	</div>
	<div class="visimg vis06"></div>
</div>
<div class="content-ov">
	<div id="subNavi-wrap">
		<div id="subNavi">
			<div class="lm-tit">
				<div class="tit">
					<p class="btxt">community</p>
					<p class="stxt">커뮤니티
</p>
				</div>
			</div>		
			<div class="leftmenu" id="leftmenu">
				<ul class="depth2">
					<li id="lm01" class='lm_l2 over'><a href="community01.php"  class='lm_a2'><span class='isTxt'>공지사항</span></a></li>
					<li id="lm02" class='lm_l2'><a href="community02.php"  class='lm_a2'><span class='isTxt'>헬프라인</span></a></li>
					<li id="lm03" class='lm_l2'><a href="community03.php"  class='lm_a2'><span class='isTxt'>자료실</span></a></li>
				</ul>
			</div>
		</div>
		<?php include_once ('../_Inc/helpInc.php');?>
	</div>
	<div id="contents">
		<div class="cont-top">
			<h2 class="tit">공지사항</h2>
			<ul class="path">
				<li><img src="../_Img/Sub/icon_home.png" width="13" height="16">
				<li>커뮤니티
</li>
				<li>공지사항</li>
			</ul>
		</div>
		<!-- page-start // -->
		<div class="board-search">
			<div class="total"><span>Total : <strong>1523건</strong></span></div>
			<div class="search">
				<select title="검색내용을 선택해주세요">
					<option>전체</option>
					<option>등록자</option>
					<option>제목</option>
				</select>
				<input type="text" title="검색 내용을 입력해주세요">
				<button type='submit'><span>검색</span></button>
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
					  <tr>
						  <td>11</td>
						  <td class="l"><a href="community05.php" class="f14">[카테고리] 테스트입니다.</a><img src="../_Img/Sub/new-ico.png" alt="새글"/> </td>
						  <td>운영자</td>
						  <td>2017-05-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>10</td>
						  <td class="l"><a href="community05.php" class="f14">[카테고리] 테스트입니다.</a><span class="reply">[11]</span></td>
						  <td>운영자</td>
						  <td>2017-05-16</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>9</td>
						  <td class="l"><a href="community05.php" class="f14">[카테고리] 테스트입니다.</a><span class="reply">[11]</span></td>
						  <td>운영자</td>
						  <td>2017-04-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>8</td>
						  <td class="l"><a href="community05.php" class="f14">[카테고리] 테스트입니다.</a><span class="reply">[11]</span></td>
						  <td>운영자</td>
						  <td>2017-03-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>7</td>
						  <td class="l"><a href="community05.php" class="f14">[카테고리] 테스트입니다.</a> </td>
						  <td>운영자</td>
						  <td>2017-02-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>6</td>
						  <td class="l"><a href="community05.php" class="f14">[카테고리] 테스트입니다.</a> </td>
						  <td>운영자</td>
						  <td>2017-02-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>5</td>
						  <td class="l"><a href="community05.php" class="f14">[카테고리] 테스트입니다.</a> </td>
						  <td>운영자</td>
						  <td>2017-02-26</td>
						  <td>14</td>
					  </tr>
                       <tr>
						  <td>4</td>
						  <td class="l"><a href="community05.php" class="f14">[카테고리] 테스트입니다.</a><span class="reply">[11]</span></td>
						  <td>운영자</td>
						  <td>2017-03-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>3</td>
						  <td class="l"><a href="community05.php" class="f14">[카테고리] 테스트입니다.</a> </td>
						  <td>운영자</td>
						  <td>2017-02-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>2</td>
						  <td class="l"><a href="community05.php" class="f14">[카테고리] 테스트입니다.</a> </td>
						  <td>운영자</td>
						  <td>2017-02-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>1</td>
						  <td class="l"><a href="community05.php" class="f14">[카테고리] 테스트입니다.</a> </td>
						  <td>운영자</td>
						  <td>2017-02-26</td>
						  <td>14</td>
					  </tr>
				  </tbody>
			</table>
		</div>
		<div class="sgap"></div>
		<div class="paging-wrap">
			<a href="#" class="first ctrl"><span class="blind">첫페이지로</span></a>
			<a href="#" class="prev ctrl"><span class="blind">이전 페이지로</span></a>
			<ul>
				<li><a href="#">1</a></li>
				<li><a href="#" class="active">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
			</ul>
			<a href="#" class="next ctrl"><span class="blind">다음페이지로</span></a>
			<a href="#" class="last ctrl"><span class="blind">끝페이지로</span></a>	
		</div>

		

	
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
