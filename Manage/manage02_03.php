<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
    <div id="svisual-wrap">
      <div class="vistxt">
        <p class="btxt"><span>지속가능경영</span></p>
        <p class="stxt">고객, 사회, 협력사와의 동반성장을 추구합니다.</p>
      </div>
      <div class="visimg vis02"></div>
    </div>
    <div class="content-ov">
      <div id="subNavi-wrap">
        <div id="subNavi">
          <div class="lm-tit">
            <div class="tit">
              <p class="btxt">Sustainability</p>
              <p class="stxt">지속가능경영</p>
            </div>
          </div>
          <div class="leftmenu" id="leftmenu">
            <ul class="depth2">
              <li id="lm01" class='lm_l2'><a href="../Manage/manage01.php"  class='lm_a2'><span class='isTxt'>지속가능경영 </span></a></li>
              <li id="lm02" class='lm_l2 over'><a href="../Manage/manage02.php"  class='lm_a2'><span class='isTxt'>윤리경영</span></a></li>
              <li id="lm02" class='lm_l2'><a href="../Manage/manage03.php"  class='lm_a2'><span class='isTxt'>준법경영</span></a></li>
            </ul>
          </div>
        </div>
        <?php include_once ('../_Inc/helpInc.php');?>
      </div>
      <div id="contents">
        <div class="cont-top">
          <h2 class="tit">윤리경영</h2>
          <ul class="path">
            <li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
            <li>지속가능경영</li>
            <li>윤리경영</li>
          </ul>
        </div>
        <!-- page-start // -->
        <div class="tab_menu">
          <ul>
            <li><a href="manage02.php">NS윤리철학</a></li>
            <li><a href="manage02_02.php">윤리경영 추진체계</a></li>
            <li class="on"><a href="manage02_03.php">윤리위원회</a></li>
          </ul>
        </div>
        <p class="txt_title2">도입목적</p>
        <div class="ethics4">
          <ul class="con1">
            <p class="stitle">대내외 신뢰 형성을 통한 지속가능경영 추구</p>
            <li>경영 투명성 강화를 위한 외부 공정거래, 법률, 소비자전문가를 통한 평가 및 자문</li>
            <li>홈쇼핑 관련 제반 법규 준수, 공정거래 활동 평가</li>
          </ul>
          <ul class="con2">
            <p class="stitle">윤리경영 정착을 통한 사회적 책임 실천</p>
            <li>건강한 윤리적 기업 문화 구축</li>
            <li>윤리적 Risk 사전 예방활동 및 제도 평가</li>
          </ul>
        </div>
        <div class="sgap"></div>
        <p class="txt_title2">역할</p>
        <div class="ethics5">
          <ul class="con1">
            <p class="stitle">회사에서 보고하는 분기별 윤리추진활동에 대한 평가 및 자문</p>
            <li>분기별 윤리추진제도 신설 및 변경, 활동에 대한 평가</li>
            <li>비윤리적 Risk 예방 활동 및 실적 점검</li>
          </ul>
          <ul class="con2">
            <p class="stitle">방송법, 공정거래법 등 홈쇼핑 관련 제반 법규 준수 활동에 대한 평가</p>
            <li>분기별 방송심의 제재 및 재발방지 활동 평가</li>
            <li>분기별 상품선정위원회 운영 투명성 점검</li>
          </ul>
          <ul class="con3">
            <p class="stitle">협력사 와의 동반성장,상생활동을 위한 제안</p>
            <li>분기별 상생 TFT 활동 및 불공정 거래 개선활동 평가</li>
            <li>협력사 상생활동에 대한 보완 및 제안</li>
          </ul>
        </div>
        <div class="sgap"></div>
        <p class="txt_title2">조직도</p>
        <p><img src="../_Img/Sub/manage/02_13.jpg" width="800" height="518"></p>
        <!-- page-end //--> 
      </div>
    </div>
    <?php include_once ('../_Inc/subTail.php');?>