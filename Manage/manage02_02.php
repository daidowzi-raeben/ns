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
            <li class="on"><a href="manage02_02.php">윤리경영 추진체계</a></li>
            <li ><a href="manage02_03.php">윤리위원회</a></li>
          </ul>
        </div>
        <p class="txt_title2">추진 체계도</p>
        <p><img src="../_Img/Sub/manage/02_09.jpg" width="800" height="533"></p>
        <div class="sgap"></div>
        <p class="txt_title2">추진 채널</p>
        <div class="ethics3">
          <ul class="con1">
            <li class="stitle">Speak up 제도</li>
            <li>직원들의 고충 및 건의사항을 CEO 직접건의<br>
              각 층 계단에 설치<br>
              익명 및 보안 절대 유지원칙</li>
          </ul>
          <ul class="con2">
            <li class="stitle">협력사 지원센타</li>
            <li>협력사 상생만족도 조사 연 2회 실시<br>
              협력사 상생펀드 기금조성<br>
              협력사 상생 대출 지원</li>
          </ul>
          <ul class="con3">
            <li class="stitle">Help-Line (레드휘슬 위탁운영)</li>
            <li>임직원 : 비리, 공정경재 저해 등의 부정과 관련된<br>
              우려사항 제보<br>
              협력회사 : 금품, 접대 요구 등의<br>
              불공정 거래 행위를 제보</li>
          </ul>
          <ul class="con4">
            <li class="stitle">제보자 보호 제도</li>
            <li>제보한 내용의 비밀을 보장하고<br>
              제보자의 신분을 보호<br>
              비밀보장, 신분보장, 책임감면</li>
          </ul>
          <ul class="con5">
            <li>협력사에 불공정 거래 계약 행위</li>
            <li>NS임직원으로부터 부당한 대우를 받았을경우</li>
            <li>윤리정책에 위배되는 요구를 받았을 경우(금품,선물,접대 등)</li>
            <li>협력사 업무 프로세스 불편사항</li>
            <li>신고메일주소 : <span style="color:#e83f2e">cleanns@nsmall.com</span></li>
            <li style="color:#e83f2e">HOT LINE : 02-6336-1212</li>
            <li><span style="color:#e83f2e">Help-line</span> : 회사 PR페이지, NS헬프라인 어플, QR코드</li>
          </ul>
        </div>
        
        <!-- page-end //--> 
      </div>
    </div>
    <?php include_once ('../_Inc/subTail.php');?>