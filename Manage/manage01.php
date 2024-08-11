<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
<link type="text/css" rel="stylesheet" href="../_Css/intro.css"/>
    <div id="svisual-wrap">
      <div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
        <p class="btxt"><span>지속가능경영</span></p>
        <div class="content-top--right">
          <span><img src="../_Img/Icon/home.png" width="25" height="24"></span>
          <span>소개</span>
          <span>지속가능경영</span>
        </div>
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
              <li id="lm01" class='lm_l2 over'><a href="../Manage/manage01.php"  class='lm_a2'><span class='isTxt'>지속가능경영 </span></a></li>
              <li id="lm02" class='lm_l2'><a href="../Manage/manage02.php"  class='lm_a2'><span class='isTxt'>윤리경영</span></a></li>
              <li id="lm02" class='lm_l2'><a href="../Manage/manage03.php"  class='lm_a2'><span class='isTxt'>준법경영</span></a></li>
            </ul>
          </div>
        </div>
        <?php include_once ('../_Inc/helpInc.php');?>
      </div>
      <div id="contents">
        <div class="cont-top">
          <h2 class="tit">지속가능경영</h2>
          <ul class="path">
            <li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
            <li>지속가능경영</li>
            <li>지속가능경영</li>
          </ul>
        </div>
        <!-- page-start // -->
        <article class="intro">

          <div class="intro-wrap">
                
            <div class="intro-tit-box">

              NS홈쇼핑은 지속 가능한 성장을 위해<br />
              기업의 신뢰성과 투명성을 제고하며, <b>경제적·법적·윤리적·자선적 책임</b>의<br />
              4대 사회적 책임을 구체적으로 실행하고 있습니다.

            </div>

            <div class="intro-con-box type2">

              <div class="img-box">
                <img src="../_Img/Sub/manage/info.png" alt="이미지">
              </div>

              <div class="txt-box">
                <div class="des-box pl-310">
                  지속가능경영이란, 기업이 경영에 영향을 미치는 경제적, 환경적, 사회적 이슈들을 종합적으로 균형 있게 고려하면서 기업의 지속가능성을 추구하는 경영활동을 말합니다.<br/>
                  <br/>
                  NS홈쇼핑은 지속 가능한 성장을 위해 기업의 신뢰성과 투명성을 제고하며, 경제적·법적·윤리적·자선적 책임의 4대 사회적 책임을 구체적으로 실행하고 있습니다.<br/>
                  <br/>
                  업계 최초 UNGC(UN Global Compact, 유엔글로벌콤팩트) 가입, 중소기업의 품질관리 능력 배양과 해외판로 개척 지원 등 협력사와 상생을 통한
                  건전한 기업 생태계의 구축, 환경생태축제 손바닥 농장 팜팜 개최와 친환경 아이스팩 사용을 통한 환경 친화적 경영 등, NS홈쇼핑은 끝없는 도전을
                  멈추지 않았습니다.<br/>
                  <br/>
                  이러한 노력의 결과로 2017년에 이어 2018년에도 「한국의 경영대상 지속가능경영부문 종합대상」을 수상하며, 지속가능경영 선도 기업으로서의 입지를 확고히 했습니다.
                  NS홈쇼핑은 여기서 그치지 않고 NS윤리준법시스템을 통해 지속가능경영의 핵심이라 할 수 있는 윤리경영과 준법경영을 통합관리하고자 합니다.<br/>
                  <br/>
                </div>

              </div>

            </div>

          </div>

        </article>
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
            "conf": "cmp"
        },
		success: function(data){
			alert(data);
		},
		error: function(err){ alert("호출 실패하였습니다.") ;}
	});
}
</script>
    <?php include_once ('../_Inc/subTail.php');?>