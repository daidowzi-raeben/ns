<div class="quick">
  <!-- <ul>
    <li><img src="/_Img/quick_1.jpg" width="78" height="45" /></li>
    <li><a href="/bbs/board.php?bo_table=data"><img src="/_Img/quick_7.jpg" width="78" height="71" /></a></li>
    <li><a href="/Guide/guide02.php"><img src="/_Img/quick_3.jpg" width="78" height="71" /></a></li>
    <li><a href="/Guide/guide04.php"><img src="/_Img/quick_4.jpg" width="78" height="71" /></a></li>
    <li><a href="/Test/test01.php"><img src="/_Img/quick_5.jpg" width="78" height="70" /></a></li>
    <li><a href="/bbs/board.php?bo_table=schedule"><img src="/_Img/quick_6.jpg" width="78" height="69" /></a></li>
  </ul> -->
  <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=notice" class="quick-menu">
    <div class="icon icon-1"></div>
    공지사항
  </a>
  <a href="/Edu/edu05.php" class="quick-menu">
    <div class="icon icon-2"></div>
    CP교육
  </a>
  <a href="/Manage/manage03.php" class="quick-menu">
    <div class="icon icon-3"></div>
    CP편람
  </a>
  <a href="/Guide/guide04.php" class="quick-menu">
    <div class="icon icon-4"></div>
    청탁금지법
  </a>
  <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=guide" class="quick-menu">
    <div class="icon icon-5"></div>
    사내준법<br />가이드라인
  </a>
  <button type="button" class="top-btn" onclick="$('html, body').animate({scrollTop : 0}, 800);">
    <img src="../_Img/Icon/top_btn.png" />
  </button>
</div>
<header id="header-wrap">
<div id="header" class="header div-cont">
	<?php
	if(!$is_member) {
	?>
	<!-- <form name="flogin" action="/bbs/login_check.php" onsubmit="return flogin_submit(this);" method="post">
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
	</form> -->
	<?php 
	} else {
	?>
	<!-- <div class="util_login">
      <ul>
        <li>
          <span class="name"><?php echo $member['mb_name']?></span>님 환영합니다!
        </li>
        <li><button class="login-btn" onclick="location.href='<?php echo G5_BBS_URL?>/logout.php'"><span>로그아웃</span></button></li>
        <li><a href="/index.php" class="line">HOME</a></li>
        </a>
        <li><a href="/Intro/sitemap.php" class="line">SITEMAP</a></li>
      </ul>
    </div> -->
	<?php
	}
	?>
  <div class="left">
	  <div id="logo"><a href="/index.php"><span class="blind">NS홈쇼핑</span></a></div>
    <div id="mainNavi-wrap" >
      <h2 class="blind">주메뉴</h2>
      <div id="mainNavi">
        <ul class="topmenu" id="topmenu">
          <li id="tm01" class="mn_l1 mn_type"> <a href="/Intro/intro01.php" class="mn_a1"><span class="mn_s1">소개</span></a>
            <div class="depth2-wrap subg">
              <div class='depth2'>
                <div>
                  <div id="tm0101" class="mn_l2 over"><a href="/Intro/intro01.php" class="mn_a2" target="_self"><span class="txt">CEO메시지 </span></a></div>
                  <div id="tm0102" class="mn_l2"><a href="/Intro/intro02.php" class="mn_a2" target="_self"><span class="txt">자율준수관리자
                    메시지 </span></a></div>
                </div>
                <div>
                  <div id="tm0201" class="mn_l2"><a href="/Manage/manage01.php" class="mn_a2" target="_self"><span class="txt">지속가능경영</span></a></div>
                  <div id="tm0203" class="mn_l2"><a href="/Manage/manage03.php" class="mn_a2" target="_self"><span class="txt">준법경영 </span></a></div>
                  <div id="tm0202" class="mn_l2"><a href="/Manage/manage02.php" class="mn_a2" target="_self"><span class="txt">윤리경영 </span></a></div>
                </div>
              </div>
            </div>
          </li>
          <!-- <li id="tm02" class="mn_l1 mn_type "> <a href="/Manage/manage01.php" class="mn_a1"><span class="mn_s1">지속가능경영</span></a>
            <div class="depth2-wrap subg">
              <ul class='depth2'>
                <li id="tm0201" class="mn_l2"><a href="/Manage/manage01.php" class="mn_a2" target="_self"><span class="txt">지속가능경영</span></a></li>
                <li id="tm0202" class="mn_l2"><a href="/Manage/manage02.php" class="mn_a2" target="_self"><span class="txt">윤리경영 </span></a></li>
                <li id="tm0203" class="mn_l2"><a href="/Manage/manage03.php" class="mn_a2" target="_self"><span class="txt">준법경영 </span></a></li>
              </ul>
            </div>
          </li> -->
          <!-- <li id="tm03" class="mn_l1 mn_type "> <a href="/Test/test01.php" class="mn_a1"><span class="mn_s1">자가진단</span></a>
            <div class="depth2-wrap subg">
              <ul class='depth2'>
                <li id="tm0301" class="mn_l2"><a href="/Test/test01.php" class="mn_a2" target="_self"><span class="txt">윤리실천 자가진단 </span></a></li>
                <li id="tm0302" class="mn_l2"><a href="/Test/test02.php" class="mn_a2" target="_self"><span class="txt">준법실천 자가진단 </span></a></li>
              </ul>
            </div>
          </li> -->
          <li id="tm04" class="mn_l1 mn_type "> <a href="/Edu/edu05.php" class="mn_a1"><span class="mn_s1">교육 / 컨텐츠</span></a>
            <div class="depth2-wrap subg">
              <div class='depth2'>
                <div>
                  <div id="tm0405" class="mn_l2"><a href="/Edu/edu05.php" class="mn_a2" target="_self"><span class="txt">CP교육</span></a></div>
                  <div id="tm0405" class="mn_l2"><a href="/Edu/edu07.php" class="mn_a2" target="_self"><span class="txt">윤리교육</span></a></div>
                  <div id="tm0405" class="mn_l2"><a href="/Edu/edu08.php" class="mn_a2" target="_self"><span class="txt">기타교육</span></a></div>
                </div>
                <div>
                  <div id="tm0401" class="mn_l2"><a href="/Edu/edu01.php" class="mn_a2" target="_self"><span class="txt">e-준법교육 캠페인</span></a></div>
                  <div id="tm0403" class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=e_campaign" class="mn_a2" target="_self"><span class="txt">윤리캠페인</span></a></div>
                  <div id="tm0404" class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=e_story" class="mn_a2" target="_self"><span class="txt">윤리경영</span></a></div>
                </div>
                <!--<li id="tm0402" class="mn_l2"><a href="/Edu/edu02.php" class="mn_a2" target="_self"><span class="txt">e-윤리영상 캠페인</span></a></li>-->
                <!-- <li id="tm0406" class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=schedule" class="mn_a2" target="_self"><span class="txt">교육일정</span></a></li> -->
              </div>
            </div>
          </li>
          <li id="tm05" class="mn_l1 mn_type "> <a href="/Guide/guide01.php" class="mn_a1"><span class="mn_s1">가이드라인 / 법령</span></a>
            <div class="depth2-wrap subg">
              <div class='depth2'>
                <div>
                  <div id="tm0501" class="mn_l2"><a href="/Guide/guide01.php" class="mn_a2" target="_self"><span class="txt">지속가능경영 관련 사규</span></a></div>
                  <div id="tm0502" class="mn_l2"><a href="/Guide/guide02.php" class="mn_a2" target="_self"><span class="txt">자율준수편람</span></a></div>
                  <div id="tm0503" class="mn_l2"><a href="/Guide/guide03.php" class="mn_a2" target="_self"><span class="txt">공정거래 가이드라인</span></a></div>
                  <div id="tm0503" class="mn_l2"><a href="/Guide/guide05.php" class="mn_a2" target="_self"><span class="txt">대규모유통업법 가이드라인</span></a></div>
                  <div id="tm0504" class="mn_l2"><a href="/Guide/guide04.php" class="mn_a2" target="_self"><span class="txt">청탁금지법 가이드라인</span></a></div>
                </div>
                <div>
                  <div class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=info" class="mn_a2" target="_self"><span class="txt">법령정보</span></a></div>
                  <div class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=guide" class="mn_a2" target="_self"><span class="txt">사내 준법 가이드라인</span></a></div>
                  <div class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=cns" class="mn_a2" target="_self"><span class="txt">준법상담</span></a></div>
                </div>
              </div>
            </div>
          </li>
          <li id="tm06" class="mn_l1 mn_type "> <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=notice" class="mn_a1"><span class="mn_s1">알림 / 질의</span></a>
            <div class="depth2-wrap subg">
              <div class='depth2'>
                <div>
                  <div id="tm0601" class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=notice" class="mn_a2" target="_self"><span class="txt">공지사항</span></a></div>
                  <div id="tm0603" class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=data" class="mn_a2" target="_self"><span class="txt">자료실</span></a></div>
                </div>
                <div>
                  <div id="tm0602" class="mn_l2"><a href="/Community/community02.php" class="mn_a2" target="_self"><span class="txt">헬프라인</span></a></div>
                </div>
                <!-- <li id="tm0603" class="mn_l2"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=cns" class="mn_a2" target="_self"><span class="txt">준법상담</span></a></li> -->
              </div>
            </div>
          </li>
          <li id="tm07" class="mn_l1 mn_type "> <a href="/Mileage/mileage01.php" class="mn_a1"><span class="mn_s1">나의 참여</span></a>
            <div class="depth2-wrap subg">
              <div class='depth2'>
                <div>
                  <div id="tm0302" class="mn_l2"><a href="/Test/test02.php" class="mn_a2" target="_self"><span class="txt">준법실천 자가진단 </span></a></div>
                  <div id="tm0301" class="mn_l2"><a href="/Test/test01.php" class="mn_a2" target="_self"><span class="txt">윤리실천 자가진단 </span></a></div>
                </div>
                <div>
                  <div id="tm0701" class="mn_l2"><a href="/Mileage/mileage01.php" class="mn_a2" target="_self"><span class="txt">마일리지</span></a></div>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <script type='text/javascript'>initNavigation(0,0)</script> 
      </div>
    </div>
  </div>
  <div class="right">
    <a href="/Mileage/mileage01.php" class="header-btn">MY MILEAGE</a>
    <?php
    if(!$is_member) {
    ?>
    <a href="/login_user.php" class="header-btn type2">LOGIN</a>
    <?php 
    } else {
    ?>
    <a href="<?php echo G5_BBS_URL?>/logout.php" class="header-btn type2">LOGOUT</a>
    <?php
    }
    ?>
    <button type="button" class="btn menu" onclick="$('.site-map').addClass('active');"></button>
  </div>
</div>

<div class="site-map">
  <div class="site-map--wrap">
    <div class="site-map--tit">사이트맵</div>
    <button type="button" class="btn btn-close" onclick="$('.site-map').removeClass('active');"></button>
    <ul class="site-map--menu">
      <li class="item">
        <div class="tit">소개</div>
        <div class="line">
          <a href="/Intro/intro01.php" class="btn-menu">CEO메시지</a>
          <a href="/Intro/intro02.php" class="btn-menu">자율준수관리자 메시지</a>
        </div>
        <div class="line">
          <a href="/Manage/manage01.php" class="btn-menu">지속가능경영</a>
          <a href="/Manage/manage03.php" class="btn-menu">준법경영</a>
          <a href="/Manage/manage02.php" class="btn-menu">윤리경영</a>
        </div>
      </li>
      <li class="item">
        <div class="tit">교육 / 컨텐츠</div>
        <div class="line">
          <a href="/Edu/edu05.php" class="btn-menu">CP교육</a>
          <a href="/Edu/edu07.php" class="btn-menu">윤리교육</a>
          <a href="/Edu/edu08.php" class="btn-menu">기타교육</a>
        </div>
        <div class="line">
          <a href="/Edu/edu01.php" class="btn-menu">e-준법교육 캠페인</a>
          <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=e_campaign" class="btn-menu">윤리캠페인</a>
          <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=e_story" class="btn-menu">윤리경영</a>
        </div>
      </li>
      <li class="item">
        <div class="tit">가이드라인 / 법령</div>
        <div class="line">
          <a href="/Guide/guide01.php" class="btn-menu">지속가능경영 관련 사규</a>
          <a href="/Guide/guide02.php" class="btn-menu">자율준수편람</a>
          <a href="/Guide/guide03.php" class="btn-menu">공정거래 가이드라인</a>
          <a href="/Guide/guide05.php" class="btn-menu">대규모유통업법 가이드라인</a>
          <a href="/Guide/guide04.php" class="btn-menu">청탁금지법 가이드라인</a>
        </div>
        <div class="line">
          <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=info" class="btn-menu">법령정보</a>
          <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=guide" class="btn-menu">사내 준법 가이드라인</a>
          <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=cns" class="btn-menu">준법상담</a>
        </div>
      </li>
      <li class="item">
        <div class="tit">알림 / 질의</div>
        <div class="line">
          <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=notice" class="btn-menu">공지사항</a>
          <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=data" class="btn-menu">자료실</a>
        </div>
        <div class="line">
          <a href="/Community/community02.php" class="btn-menu">헬프라인</a>
        </div>
      </li>
      <li class="item">
        <div class="tit">나의 참여</div>
        <div class="line">
          <a href="/Test/test02.php" class="btn-menu">준법실천 자가진단</a>
          <a href="/Test/test01.php" class="btn-menu">윤리실천 자가진단</a>
        </div>
        <div class="line">
          <a href="/Mileage/mileage01.php" class="btn-menu">마일리지</a>
        </div>
      </li>
    </ul>
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
		
		var ret = window.open("/temp/index.html", "popwin", "status=0, width=680, height=722, scrollbars=1, left=" + popupX);
	}
	
	// testWin();
</script>
<?php
	//
	//echo G5_TIME_YMDHIS;
	$tmpStartTime = '2024-04-25 00:00:00';
	$tmpEndTime = '2024-05-17 18:01:00';

  if($member['mb_id'] === 'admin') {
    $tmpStartTime = '2024-04-22 00:00:00';
  }


	
	//로그인 체크
	if($is_member) {
		// 서약서팝업레이어 시작 { : 로그인 회원인 경우만 서약서 출력
		if(G5_TIME_YMDHIS > $tmpStartTime && G5_TIME_YMDHIS < $tmpEndTime)
		{
			$sql = " select count(pld_no) as cnt from sj_prs_pledge where mb_id = '{$member['mb_id']}' and pld_year = '2024' and pld_semi = 'A' ";
			$result = sql_fetch($sql);
			
			if(!$result['cnt']) 
			{
?>
				<script type='text/javascript'>testWin();</script> 
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