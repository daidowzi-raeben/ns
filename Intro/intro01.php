<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>

	<link type="text/css" rel="stylesheet" href="../_Css/intro.css"/>

    <div id="svisual-wrap">
      <div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
        <p class="btxt"><span>CEO 메시지</span></p>
        <div class="content-top--right">
			<span><img src="../_Img/Icon/home.png" width="25" height="24"></span>
			<span>소개</span>
			<span>CEO 메시지</span>
		</div>
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

				<div class="intro-con-box">

					<div class="txt-box">
						
						<div class="intro-tit-box">

							NS홈쇼핑은 <b>윤리와 준법</b>을<br/>
							최우선 행동기준으로 삼고 철저히 지켜나가며,<br/>
							<b>기업의 사회적 책임</b>을 성실히 이행하는<br/>
							명문기업으로 자리매김 하고자 합니다

						</div>
						<div class="des-box">
							NS 임직원 여러분!<br/>
							우리는 홈쇼핑 업계의 불황과 장기적인 소비침체에도 불구하고 지난 2023년 임직원 모두의<br/>
							노력으로 성공적인 턴 어라운드의 해를 만들어냈습니다.<br/>
							<br/>
							이러한 성장의 기반에는 회사가 2004년부터 도입하고 발전시켜온<br/>
							공정거래 자율준수 프로그램 (Compliance Program, 이하 'CP')이 있습니다.<br/>
							<br/>
							공정거래 자율준수 문화를 정착시키기 위해서는 임직원 여러분들의 자발적이고 적극적인
							참여가 전제되어야 합니다.<br/>
							<br/>
							이를 위해 회사의 프로세스 및 규정을 숙지하여 각자의 역할을 수행하면서 관련 법규를 준수하고,<br/>
							업무 수행 시 발생할 수 있는 법 위반 사항들은 담당 부서와 사전 협의를 하시기 바랍니다. <br/>
							<br/>
							임직원 여러분들이 공정거래와 준법·윤리경영에 대한 관심과 노력을 기울임으로써<br/>
							컴플라이언스 실천에 적극 동참할 때에야 비로소 우리의 실적이 온전한 성과가 될 수 있을 것입니다.<br/>
							<br/>
							임직원 여러분!<br/>
							엔에스쇼핑이 모범적인 준법·윤리경영 기업으로 거듭날 수 있도록 전 임직원으로 하여금<br/>
							강력한 의지를 가지고 공정하고 투명한 기업문화를 만들어가는 데에 최선을 다해주시기 바랍니다.
							<div class="bottom-wrap">
								<span class="bold">NS 홈쇼핑 대표이사 조항목</span>
								<span>2024.07.06</span>
							</div>
						</div>

					</div>

					<div class="img-box">
						<img src="../_Img/Sub/intro/ceo.png" alt="이미지">
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
