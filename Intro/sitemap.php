<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
    <div id="svisual-wrap">
      <div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
        <p class="btxt"><span>사이트 맵</span></p>
        <p class="stxt">고객, 사회, 협력사와의 동반성장을 추구합니다.</p>
      </div>
      <div class="visimg vis01"></div>
    </div>
    <div class="content-ov">
      <div id="subNavi-wrap">
        <div id="subNavi">
          <div class="lm-tit">
            <div class="tit">
              <p class="btxt">SITEMAP</p>
              <p class="stxt">사이트 맵</p>
            </div>
          </div>
          <div class="leftmenu" id="leftmenu">
            <ul class="depth2">
              <li id="lm01" class='lm_l2 over'><a href="../Intro/intro01.php"  class='lm_a2'><span class='isTxt'>사이트 맵</span></a></li>
            </ul>
          </div>
        </div>
        <?php include_once ('../_Inc/helpInc.php');?>
      </div>
      <div id="contents">
        <div class="cont-top">
          <h2 class="tit">사이트 맵</h2>
          <ul class="path">
            <li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
            <li>사이트 맵</li>
          </ul>
        </div>
        <!-- page-start // -->
       <div class="sitemap">
          <h3>소개</h3>
          <ul>
            <li><a href="intro01.php">CEO메시지</a></li>
            <li><a href="intro02.php">자율준수관리자 메시지</a></li>
          </ul>
        </div>
        <div class="sitemap">
          <h3>지속가능경영</h3>
          <ul>
            <li><a href="../Manage/manage01.php">지속가능경영</a></li>
            <li>윤리경영</li>
            <li style="font-size:14px"><a href="../Manage/manage02.php">· NS윤리철학</a><br>
              <a href="../Manage/manage02_02.php">· 윤리경영 추진체계</a><br>
            <a href="../Manage/manage02_03.php">· 윤리위원회</a></li>
            <li>준법경영</li>
            <li style="font-size:14px"><a href="../Manage/manage03.php">· CP개요</a><br>
              <a href="../Manage/manage03_02.php">· CP전략</a><br>
              <a href="../Manage/manage03_03.php">· CP연혁</a><br>
              <a href="../Manage/manage03_04.php">· CP조직</a><br>
            <a href="../Manage/manage03_05.php">· CP운영현황</a></li>
          </ul>
        </div>
        <div class="sitemap">
          <h3>자가진단</h3>
          <ul>
            <li><a href="../Test/test01.php">윤리실천 자가진단</a></li>
            <li><a href="../Test/test02.php">준법실천 자가진단</a></li>
          </ul>
        </div>
        <div class="sitemap2">
          <h3>사이버&집체교육</h3>
          <ul>
            <li><a href="../Edu/edu01.php">e-준법교육 캠페인</a></li>
            <li><a href="../Edu/edu02.php">e-윤리영상 캠페인</a></li>
            <li><a href="../bbs/board.php?bo_table=e_campaign">윤리캠페인</a></li>
            <li><a href="../bbs/board.php?bo_table=e_story">윤리경영</a></li>
            <li><a href="../Edu/edu05.php">사이버교육</a></li>
            <li><a href="../bbs/board.php?bo_table=schedule">교육일정</a></li>
          </ul>
        </div>
        <div class="sitemap" style="height:600px;">
          <h3>가이드라인</h3>
          <ul>
            <li>지속가능경영 관련 사규</li>
            <li style="font-size:14px; letter-spacing:-0.9px;"> <a href="../Guide/guide01.php">· CP운영규정</a><br>
              <a href="../Guide/guide01_02.php">· CP모니터링 운영지침</a><br>
              <a href="../Guide/guide01_03.php">· CP포상지침</a><br>
              <a href="../Guide/guide01_04.php">· CP제재 운영지침</a><br>
              <a href="../Guide/guide01_05.php">· CP사전업무 협의제도운영지침</a><br>
              <a href="../Guide/guide01_06.php">· CP문서관리지침</a><br>
              <a href="../Guide/guide01_07.php">· 내부감사규정</a><br>
              <a href="../Guide/guide01_08.php">· 내부신고처리규정</a><br>
              <a href="../Guide/guide01_09.php">· 협력사 피해보상 규정</a><br>
              <a href="../Guide/guide01_10.php">· 계약채권 업무처리 지침</a> </li>
            <li><a href="../Guide/guide02.php">자율준수편람</a></li>
            <li>공정거래 가이드라인</li>
            <li style="font-size:14px"> <a href="../Guide/guide03.php">· 내부거래 가이드라인</a><br>
              <a href="../Guide/guide03_02.php">· 담합 가이드라인</a><br>
              <a href="../Guide/guide03_03.php">· 부당반품 가이드라인</a><br>
              <a href="../Guide/guide03_04.php">· 사내 하도급 가이드라인</a></li>
            <li>청탁금지법 가이드라인</li>
            <li style="font-size:15px">
              <a href="../Guide/guide04.php">· 청탁금지법 안내</a><br>
              <a href="../bbs/board.php?bo_table=qa">· 청탁금지법 FAQ</a></li>
          </ul>
        </div>
        <div class="sitemap">
          <h3>커뮤니티</h3>
          <ul>
            <li><a href="../bbs/board.php?bo_table=notice">공지사항</a></li>
            <li><a href="../Community/community02.php">헬프라인</a></li>
            <li><a href="../bbs/board.php?bo_table=data">자료실</a></li>
          </ul>
        </div>
        <div class="sitemap">
          <h3>마일리지</h3>
          <ul>
            <li><a href="../Mileage/mileage01.php">나의 마일리지</a></li>
          </ul>
        </div>
        <p class="sssgap"></p>
        <!-- page-end //--> 
      </div>
    </div>
    <?php include_once ('../_Inc/subTail.php');?>