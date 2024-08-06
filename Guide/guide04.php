<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
	$guideOver5 = ' over';
?>
    <div id="svisual-wrap">
      <div class="vistxt">
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
          <?php include_once (G5_PATH.'/Guide/guide_left.php');?>
        </div>
        <? include_once ('../_Inc/helpInc.php');?>
      </div>
      <div id="contents">
        <div class="cont-top">
          <h2 class="tit">청탁금지법 가이드라인</h2>
          <ul class="path">
            <li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
            <li>가이드라인</li>
            <li>청탁금지법 가이드라인</li>
          </ul>
        </div>
        <!-- page-start // -->
        <div class="tab_menu2">
          <ul>
            <li class="on"><a href="guide04.php">청탁금지법 안내</a></li>
            <li><a href="<?php echo G5_BBS_URL?>/board.php?bo_table=qa">청탁금지법 FAQ</a></li>
          </ul>
        </div>
        <img src="../_Img/Sub/guide/content_8.png" />
        <div class="confirm">
          <a href="javascript:confirmProc()">확인</a><span>페이지 다 읽으신 후 <strong>확인버튼</strong>을 클릭해 주시면 나의 마일리지에 반영됩니다.</span>
        </div>
        <!-- page-end //--> 
      </div>
    </div>
<script>
function confirmProc(val) {
		
	$.ajax({
		type: "POST",
		url: g5_bbs_url+"/ajax.conf_point.php",
		data : {
            "conf": "guide04"
        },
		success: function(data){
			alert(data);
			location.reload();
		},
		error: function(err){ alert("호출 실패하였습니다.") ;}
	});
}
</script>
    <? include_once ('../_Inc/subTail.php');?>