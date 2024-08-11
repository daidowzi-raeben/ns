<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if($bo_table == "notice") {
	$strTitle = "공지사항";
	$over1 = " over";
} elseif($bo_table == "data") {
	$strTitle = "자료실";
	$over2 = " over";
} elseif($bo_table == "cns") {
	$strTitle = "준법상담";
	$over3 = " over";
}
?>

<div id="svisual-wrap">
	<div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
		<p class="btxt"><span><?php echo $strTitle?>
</span></p>
        <div class="content-top--right">
          <span><img src="../_Img/Icon/home.png" width="25" height="24"></span>
          <span>커뮤니티</span>
          <span><?php echo $strTitle?></span>
        </div>
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
					<li id="lm01" class='lm_l2<?php echo $over1?>'><a href="<?php echo G5_URL?>/bbs/board.php?bo_table=notice"  class='lm_a2'><span class='isTxt'>공지사항</span></a></li>
					<li id="lm02" class='lm_l2'><a href="<?php echo G5_URL?>/Community/community02.php"  class='lm_a2'><span class='isTxt'>헬프라인</span></a></li>
					<li id="lm03" class='lm_l2<?php echo $over2?>'><a href="<?php echo G5_URL?>/bbs/board.php?bo_table=data"  class='lm_a2'><span class='isTxt'>자료실</span></a></li>
					<li id="lm04" class='lm_l2<?php echo $over3?>'><a href="<?php echo G5_URL?>/bbs/board.php?bo_table=cns"  class='lm_a2'><span class='isTxt'>준법상담</span></a></li>
				</ul>
			</div>
		</div>
		<? include_once (G5_PATH.'/_Inc/helpInc.php');?>
	</div>
	<div id="contents">
		<div class="cont-top">
			<h2 class="tit"><?php echo $strTitle?></h2>
			<ul class="path">
				<li><img src="../_Img/Sub/icon_home.png" width="13" height="16">
				<li>커뮤니티</li>
				<li><?php echo $strTitle?></li>
			</ul>
		</div>
		<!-- page-start // -->
		
		<div class="board-view-wrap">
			<span class="bd-line"></span>
			<table>
				  <caption><span class="blind">매일 '신선한 아침'을 만드는 방법들의 상세 글 입니다.</span></caption>
				  <thead>
					  <tr>
						  <th>
							<p class="btxt"><?php echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력?></p>
							<span><strong>작성자</strong> : <?php echo $view['name'] ?></span>
							<span><strong>작성일자</strong> : <?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></span>
							<span><strong>조회수</strong> : <?php echo number_format($view['wr_hit']) ?></span>
						  </th>
					  </tr>
				  </thead>
				  <tbody>
					<?php
					$cnt = 0;
					if ($view['file']['count']) {
						for ($i=0; $i<count($view['file']); $i++) {
							if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'])
								$cnt++;
						}
					}
					 ?>
					<?php if($cnt) { ?>
					<!-- 첨부파일 시작 { -->
					<?php
					// 가변 파일
					for ($i=0; $i<count($view['file']); $i++) {
						if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']) {
					 ?>
					  <tr>
						  <td>
							 <strong class="file-btxt">첨부파일 :</strong>
							 <a href="<?php echo $view['file'][$i]['href'];  ?>" class="file-add"><span><?php echo $view['file'][$i]['source'] ?></span></a>
						  </td>
					  </tr>
					<?php
							}
						}
					?>
					<!-- } 첨부파일 끝 -->
					<?php } ?>
					  <tr>
						  <td colspan="2" class="editor-data-box">
							<?php echo get_view_thumbnail($view['content']); ?>
						  </td>
					  </tr>

				  </tbody>
			</table>
			<div class="ssgap"></div>
			<div class="r">
				<a href="<?php echo $list_href ?>" class="bw-btn"><span>목록</span></a>
			</div>
			<div class="ssgap"></div>
			<?php if ($prev_href || $next_href) { ?>
			<ul class="np-page">
				<?php if ($prev_href) { ?>
				<li>
					<a href="#" class="first">이전글&nbsp;<span class="f9">▲</span></a>
					<a href="<?php echo $prev_href ?>" class="ellipsis">
						<span><?php echo $prev_wr_subject;?></span>
					</a>
				</li>
				<?php } ?>
				<?php if ($next_href) { ?>
				<li>
					<a href="#" class="first">다음글&nbsp;<span class="f9">▼</span></a>
					<a href="<?php echo $next_href ?>" class="ellipsis">
						<span><?php echo $next_wr_subject;?></span>
					</a>
				</li>
				<?php } ?>
			<ul>
			<?php } ?>


		</div>

		<div class="gap"></div>
		<div class="gap"></div>
		
		<!-- page-end //-->
		</div>
</div>
<!-- 게시물 읽기 시작 { -->


<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();

    //sns공유
    $(".btn_share").click(function(){
        $("#bo_v_sns").fadeIn();
   
    });

    $(document).mouseup(function (e) {
        var container = $("#bo_v_sns");
        if (!container.is(e.target) && container.has(e.target).length === 0){
        container.css("display","none");
        }	
    });
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->