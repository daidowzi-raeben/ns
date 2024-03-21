<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>

	<link type="text/css" rel="stylesheet" href="../_Css/intro.css"/>


    <div id="svisual-wrap">
      <div class="vistxt">
        <p class="btxt"><span>소개</span></p>
        <p class="stxt">고객, 사회, 협력사와의 동반성장을 추구합니다.</p>
      </div>
      <div class="visimg vis01"></div>
    </div>
    <div class="content-ov">
      <div id="subNavi-wrap">
        <div id="subNavi">
          <div class="lm-tit">
            <div class="tit">
              <p class="btxt">introduction</p>
              <p class="stxt">소개</p>
            </div>
          </div>
          <div class="leftmenu" id="leftmenu">
            <ul class="depth2">
              <li id="lm01" class='lm_l2 over'><a href="../Intro/intro01.php"  class='lm_a2'><span class='isTxt'>CEO 메시지</span></a></li>
              <li id="lm02" class='lm_l2'><a href="../Intro/intro02.php"  class='lm_a2'><span class='isTxt'>자율준수관리자 메시지</span></a></li>
            </ul>
          </div>
        </div>
        <?php include_once ('../_Inc/helpInc.php');?>
      </div>
      <div id="contents">
        <div class="cont-top">
          <h2 class="tit">CEO 메시지</h2>
          <ul class="path">
            <li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
            <li>소개</li>
            <li>CEO 메시지</li>
          </ul>
        </div>
        <!-- page-start // -->
		  <article class="intro">

			  <div class="intro-wrap">

				  <div class="intro-tit-box">

					  NS홈쇼핑은 <b>윤리와 준법</b>을 최우선 행동기준으로 삼고 철저히 지켜나가며,<br/>
					  <b>기업의 사회적 책임</b>을 성실히 이행하는 명문기업으로 자리매김 하고자 합니다


				  </div>

				  <div class="intro-con-box">

					  <div class="txt-box">

						  <div class="tit-box">
							  친애하는 NS홈쇼핑 임직원 여러분!
						  </div>
						  <div class="des-box">
							  우리 NS홈쇼핑은 임직원 여러분의 윤리의식과 준법정신을 바탕으로 윤리적이고 투명한 기업 경영과 청렴하고 공정한 기업 문화를 조성하였습니다.<br/><br/>

							  NS홈쇼핑은 이러한 준법경영을 뒷받침하기 위해 2004년 도입한 공정거래 자율준수 프로그램(CP)을 지속적으로 발전시켜, 2018년 CP등급평가에서 공정위로부터 AA등급이라는 업계 최고수준의 결과를 얻었으며 현재에 이르기까지 체계적으로 CP활동을 이어나가고 있습니다.<br/><br/>

							  NS홈쇼핑은 앞으로도 지속적인 최고 경영자의 자율준수의지 천명, 정기적인 CP교육 실시, CP 기준 및 절차의 엄격한 준수를 통해 더욱 굳건하고 철저하게 준법경영을 실천할 것을 약속합니다.<br/><br/>

							  임직원 여러분도 다양한 CP활동에 적극적으로 임하고 준법의식을 내재화하여 우리 NS홈쇼핑을 윤리와 준법을 최고가치로 두고 행동하는 CP 선도 기업으로 만들어갑시다.<br/><br/>

							  감사합니다.
								<br>
								<br>
								<div class="bottom-wrap">
									<span>2021. 07. 01.</span>
									<span>NS홈쇼핑 대표이사<b> 조 항 목</b></span>
								</div>
						  </div>

					  </div>

					  <div class="img-box">
						  <img src="../_Img/Sub/intro/ceo.jpg" alt="이미지">
					  </div>

				  </div>

			  </div>

		  </article>

		  <div class="confirm">
			<a href="javascript:confirmProc()"><img src="../_Img/Sub/btn_confirm.jpg" width="97" height="42"></a><span>※ 페이지 다 읽으신 후 [확인] 버튼을 클릭해 주시면 나의 마일리지에 반영됩니다. </span>
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
            "conf": "ceo"
        },
		success: function(data){
			alert(data);
		},
		error: function(err){ alert("호출 실패하였습니다.") ;}
	});
}
</script>
    <?php include_once ('../_Inc/subTail.php');?>
