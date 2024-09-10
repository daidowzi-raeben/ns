<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
    <div id="svisual-wrap">
      <div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
        <p class="btxt"><span>헬프라인</span></p>
        <div class="content-top--right">
          <span><img src="../_Img/Icon/home.png" width="25" height="24"></span>
          <span>알림/질의</span>
          <span>헬프라인</span>
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
              <p class="stxt">커뮤니티 </p>
            </div>
          </div>
          <div class="leftmenu" id="leftmenu">
            <ul class="depth2">
				<li id="lm01" class='lm_l2'><a href="<?php echo G5_BBS_URL?>/board.php?bo_table=notice"  class='lm_a2'><span class='isTxt'>공지사항</span></a></li>
				<li id="lm02" class='lm_l2 over'><a href="community02.php"  class='lm_a2'><span class='isTxt'>헬프라인</span></a></li>
				<li id="lm03" class='lm_l2'><a href="<?php echo G5_BBS_URL?>/board.php?bo_table=data"  class='lm_a2'><span class='isTxt'>자료실</span></a></li>
				<li id="lm04" class='lm_l2'><a href="<?php echo G5_BBS_URL?>/board.php?bo_table=cns"  class='lm_a2'><span class='isTxt'>준법상담</span></a></li>
            </ul>
          </div>
        </div>
        <?php include_once ('../_Inc/helpInc.php');?>
      </div>
      <div id="contents">
        <div class="cont-top">
          <h2 class="tit">헬프라인</h2>
          <ul class="path">
            <li><img src="../_Img/Sub/icon_home.png" width="13" height="16">
            <li>커뮤니티 </li>
            <li>헬프라인</li>
          </ul>
        </div>
        <!-- page-start // -->
        <div class="help-top"><img src="../_Img/Sub/community/help_img.png" alt="헬프라인 이미지"></div>
        <p class="help-text">헬프라인의 모든 신고 및 접수 절차는 케이휘슬이 독립적으로 담당하며, 신고자 익명성 보장을 위해 IP추적 차단 기술이 적용된
        시스템입니다.<br /> NS임직원 뿐만 아니라 협력사 임직원도 누구나 이용할 수 있으며, 윤리경영 위배나 공정거래 저해 및 불공정한
        관행을 적극적으로 신고하여 주시기 바랍니다.<br>
        상품,서비스 관련 고객민원은 서비스 전담부서인 <span style="color:#ff0000">02-6336-1719</span>로 연락주시기 바랍니다. </p>
        <div class="help-box">
          <div class="box">
            <img src="../_Img/Icon/help_icon1.png" />
            <div class="text">
              <div class="tit">신고대상행위</div>
              · 직무관련 금품, 향응 수수 행위&nbsp;&nbsp;&nbsp; · 불공정한 거래 계약 행위<br />
              · 기타 업무상 부조리 행위
            </div>
          </div>
          <div class="box">
            <img src="../_Img/Icon/help_icon2.png" />
            <div class="text">
              <div class="tit">윤리경영 질의</div>
              직무 이해상충 / 윤리강령의 적용과 해석 / 윤리적 고민
            </div>
          </div>
        </div>
        <p style="text-align:center;"><span style="padding-right:5px"><a href="https://www.kbei.org/whistle/center/?code=harimholdings" target="_blank" class="help-btn">헬프라인 신고하기</a></span><span><a href="https://www.kbei.org/whistle/center/?code=harimholdings" target="_blank" class="help-btn blue">윤리경영 질의하기</a></span></p>
        <p class="help-bottom">· 신고 및 질의 후 <span>고유번호</span>와 <span>비밀번호</span>를 꼭 메모해 주시기 바랍니다. (분실 시 찾을 수 없습니다.)<br> 
        · 처리결과는 <span>케이휘슬 홈페이지(<strong>https://www.kbei.org/whistle</strong> 접속 → 메인화면 → 처리결과확인)</span> 에서 확인하실 수 있습니다.
</p>
        
        <!-- page-end //--> 
      </div>
    </div>
    <?php include_once ('../_Inc/subTail.php');?>