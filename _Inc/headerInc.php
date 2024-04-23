<div class="quick">
  <ul>
    <li><img src="/_Img/quick_1.jpg" width="78" height="45" /></li>
    <li><a href="/bbs/board.php?bo_table=data"><img src="/_Img/quick_7.jpg" width="78" height="71" /></a></li>
    <li><a href="/Guide/guide02.php"><img src="/_Img/quick_3.jpg" width="78" height="71" /></a></li>
    <li><a href="/Guide/guide04.php"><img src="/_Img/quick_4.jpg" width="78" height="71" /></a></li>
    <li><a href="/Test/test01.php"><img src="/_Img/quick_5.jpg" width="78" height="70" /></a></li>
    <li><a href="/bbs/board.php?bo_table=schedule"><img src="/_Img/quick_6.jpg" width="78" height="69" /></a></li>
  </ul>
</div>
<header id="header-wrap">
<div id="header" class="header div-cont">
	<div id="logo"><a href="/index.php"><span class="blind">NS홈쇼핑</span></a></div>
	<?php
	if(!$is_member) {
	?>
	<form name="flogin" action="/bbs/login_check.php" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="">
	<div class="util_logout">
		<ul>
			<li>
				<input type="text" name="mb_id" id="login_id" required class="frm_input required" value="아이디" autocomplete="off" onFocus="clearText(this)"  onblur="defaultText(this)"/>
			</li>
			<li>
				<input type="password" name="mb_password" id="login_pw" required class="frm_input required" value="비밀번호"  class="passValue" autocomplete="off" onFocus="clearText(this)"  onblur="defaultText(this)"/>
			</li>
			<li><button type="submit" class="login-btn"><span>로그인</span></button></li>
			<li><a href="/index.php" class="line">HOME</a></li>
			<li><a href="/Intro/sitemap.php" class="line">SITEMAP</a></li>
		</ul>
	</div>
	</form>
	<?php 
	} else {
	?>
	<div class="util_login">
      <ul>
        <li>
          <span class="name"><?php echo $member['mb_name']?></span>님 환영합니다!
        </li>
        <li><button class="login-btn" onclick="location.href='<?php echo G5_BBS_URL?>/logout.php'"><span>로그아웃</span></button></li>
        <li><a href="/index.php" class="line">HOME</a></li>
        </a>
        <li><a href="/Intro/sitemap.php" class="line">SITEMAP</a></li>
      </ul>
    </div>
	<?php
	}
	?>
  <div id="mainNavi-wrap" >
    <h2 class="blind">주메뉴</h2>
    <div id="mainNavi">
      <ul class="topmenu" id="topmenu">
        <li id="tm01" class="mn_l1 mn_type"> <a href="/Intro/intro01.php" class="mn_a1"><span class="mn_s1">소개</span></a>
          <div class="depth2-wrap subg">
            <ul class='depth2'>
              <li id="tm0101" class="mn_l2 over"><a href="/Intro/intro01.php" class="mn_a2" target="_self"><span class="txt">CEO메시지 </span></a></li>
              <li id="tm0102" class="mn_l2"><a href="/Intro/intro02.php" class="mn_a2" target="_self"><span class="txt">자율준수관리자
                메시지 </span></a></li>
            </ul>
          </div>
        </li>
        <li id="tm02" class="mn_l1 mn_type "> <a href="/Manage/manage01.php" class="mn_a1"><span class="mn_s1">지속가능경영</span></a>
          <div class="depth2-wrap subg">
            <ul class='depth2'>
              <li id="tm0201" class="mn_l2"><a href="/Manage/manage01.php" class="mn_a2" target="_self"><span class="txt">지속가능경영</span></a></li>
              <li id="tm0202" class="mn_l2"><a href="/Manage/manage02.php" class="mn_a2" target="_self"><span class="txt">윤리경영 </span></a></li>
              <li id="tm0203" class="mn_l2"><a href="/Manage/manage03.php" class="mn_a2" target="_self"><span class="txt">준법경영 </span></a></li>
            </ul>
          </div>
        </li>
        <li id="tm03" class="mn_l1 mn_type "> <a href="/Test/test01.php" class="mn_a1"><span class="mn_s1">자가진단</span></a>
          <div class="depth2-wrap subg">
            <ul class='depth2'>
              <li id="tm0301" class="mn_l2"><a href="/Test/test01.php" class="mn_a2" target="_self"><span class="txt">윤리실천 자가진단 </span></a></li>
              <li id="tm0302" class="mn_l2"><a href="/Test/test02.php" class="mn_a2" target="_self"><span class="txt">준법실천 자가진단 </span></a></li>
            </ul>
          </div>
        </li>
        <li id="tm04" class="mn_l1 mn_type "> <a href="/Edu/edu01.php" class="mn_a1"><span class="mn_s1">사이버&집체교육</span></a>
          <div class="depth2-wrap subg">
            <ul class='depth2'>
              <li id="tm0401" class="mn_l2"><a href="/Edu/edu01.php" class="mn_a2" target="_self"><span class="txt">e-준법교육 캠페인</span></a></li>
              <!--<li id="tm0402" class="mn_l2"><a href="/Edu/edu02.php" class="mn_a2" target="_self"><span class="txt">e-윤리영상 캠페인</span></a></li>-->
              <li id="tm0403" class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=e_campaign" class="mn_a2" target="_self"><span class="txt">윤리캠페인</span></a></li>
              <li id="tm0404" class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=e_story" class="mn_a2" target="_self"><span class="txt">윤리이야기</span></a></li>
              <li id="tm0405" class="mn_l2"><a href="/Edu/edu05.php" class="mn_a2" target="_self"><span class="txt">사이버교육</span></a></li>
              <li id="tm0406" class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=schedule" class="mn_a2" target="_self"><span class="txt">교육일정</span></a></li>
            </ul>
          </div>
        </li>
        <li id="tm05" class="mn_l1 mn_type "> <a href="/Guide/guide01.php" class="mn_a1"><span class="mn_s1">가이드라인</span></a>
          <div class="depth2-wrap subg">
            <ul class='depth2'>
              <li id="tm0501" class="mn_l2"><a href="/Guide/guide01.php" class="mn_a2" target="_self"><span class="txt">지속가능경영 관련 사규</span></a></li>
              <li id="tm0502" class="mn_l2"><a href="/Guide/guide02.php" class="mn_a2" target="_self"><span class="txt">자율준수편람</span></a></li>
              <li id="tm0503" class="mn_l2"><a href="/Guide/guide03.php" class="mn_a2" target="_self"><span class="txt">공정거래 가이드라인</span></a></li>
			  <li id="tm0503" class="mn_l2"><a href="/Guide/guide05.php" class="mn_a2" target="_self"><span class="txt">대규모유통업법 가이드라인</span></a></li>
              <li id="tm0504" class="mn_l2"><a href="/Guide/guide04.php" class="mn_a2" target="_self"><span class="txt">청탁금지법 가이드라인</span></a></li>
            </ul>
          </div>
        </li>
        <li id="tm06" class="mn_l1 mn_type "> <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=notice" class="mn_a1"><span class="mn_s1">커뮤니티</span></a>
          <div class="depth2-wrap subg">
            <ul class='depth2'>
              <li id="tm0601" class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=notice" class="mn_a2" target="_self"><span class="txt">공지사항</span></a></li>
              <li id="tm0602" class="mn_l2"><a href="/Community/community02.php" class="mn_a2" target="_self"><span class="txt">헬프라인</span></a></li>
              <li id="tm0603" class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=data" class="mn_a2" target="_self"><span class="txt">자료실</span></a></li>
			  <li id="tm0603" class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=cns" class="mn_a2" target="_self"><span class="txt">준법상담</span></a></li>
            </ul>
          </div>
        </li>
        <li id="tm07" class="mn_l1 mn_type "> <a href="/Mileage/mileage01.php" class="mn_a1"><span class="mn_s1">마일리지</span></a>
          <div class="depth2-wrap subg">
            <ul class='depth2'>
              <li id="tm0701" class="mn_l2"><a href="/Mileage/mileage01.php" class="mn_a2" target="_self"><span class="txt">나의 마일리지</span></a></li>
            </ul>
          </div>
        </li>
      </ul>
      <script type='text/javascript'>initNavigation(0,0)</script> 
    </div>
  </div>
</div>
<script>
	function flogin_submit(f)
	{
		return true;
	}

	function pldWin()
	{
		var popupX = (document.body.offsetWidth / 2) - 300;
		
		// var ret = window.open("/pledge/", "popwin", "status=0, width=680, height=722, left=" + popupX);
		var ret = window.open("/pledge/", "popwin", "scrollbars=yes, status=0, width=680, height=722, left=" + popupX);
	}

	function testWin()
	{
		var popupX = (document.body.offsetWidth / 2) - 300;
		
		var ret = window.open("/temp/test.php", "popwin", "status=0, width=680, height=722, scrollbars=1, left=" + popupX);
	}
	
	// testWin();
</script>
<?php
	//
	//echo G5_TIME_YMDHIS;
	$tmpStartTime = '2024-04-23 00:00:00';
	$tmpEndTime = '2024-04-24 18:01:00';
	
	//로그인 체크
	if($is_member) {
		// 서약서팝업레이어 시작 { : 로그인 회원인 경우만 서약서 출력
		if(G5_TIME_YMDHIS > $tmpStartTime && G5_TIME_YMDHIS < $tmpEndTime)
		{
			$sql = " select count(pld_no) as cnt from sj_prs_pledge where mb_id = '{$member['mb_id']}' and pld_flag = '0' and pld_year = '2022' and pld_semi = 'B' ";
			$result = sql_fetch($sql);
			
			if(!$result['cnt']) 
			{
?>
				<script type='text/javascript'>pldWin();</script> 
<?php
			}
		}
		// } 서약서팝업레이어 끝
		
		include SJ_SURVEY_PATH.'/srvy_win.inc.php'; 	// 설문조사1 팝업
		include SJ_SURVEY_PATH.'/srvy_win2.inc.php'; 	// 설문조사2 팝업
		include G5_PATH.'/temp/t_win.inc.php'; 			// 내부 서약서 팝업
	
	}
?>
</header>