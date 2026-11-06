<?php
include_once('../_Inc/subHead.php');

if (!$is_member) {
	alert(NS_LOGIN_MSG);
}
?>

<link type="text/css" rel="stylesheet" href="../_Css/intro.css" />

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
					<li id="lm01" class='lm_l2 over'><a href="../Intro/intro01.php" class='lm_a2'><span
								class='isTxt'>CEO 메시지</span></a></li>
					<li id="lm02" class='lm_l2'><a href="../Intro/intro02.php" class='lm_a2'><span class='isTxt'>자율준수관리자
								메시지</span></a></li>
				</ul>
			</div>
		</div>
		<?php include_once('../_Inc/helpInc.php'); ?>
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

							NS홈쇼핑은 <b>윤리와 준법</b>을<br />
							최우선 행동기준으로 삼고 철저히 지켜나가며,<br />
							<b>기업의 사회적 책임</b>을 성실히 이행하는<br />
							명문기업으로 자리매김 하고자 합니다

						</div>
						<div class="des-box">
							NS 임직원 여러분!<br />
							<br />
							급변하는 경영 환경 속에서 우리는 “No.1 Food & Life 쇼핑 플랫폼”으로 도약하기 위해<br />
							끊임없이 도전과 혁신을 이어가고 있습니다.<br />
							<br />
							그러나 치열한 경쟁 속에서도 NS의 본질인 신뢰와 원칙은 결코 흔들려서는 안 됩니다.<br />
							<br />
							NS가 고객과 사회로부터 신뢰받는 기업으로 성장하기 위해, 우리 스스로 원칙을 지키는<br />
							정직함으로 준법경영을 실천하는 것이 무엇보다 중요합니다.<br />
							<br />
							로버트 콜리어는 “성공은 매일 반복되는 작은 노력의 합이다”라고 말했습니다.<br />
							<br />
							하림그룹의 일일 관리 행동인 HBH처럼, 매일의 업무를 빈틈없이 점검하고 잠재된 위험을<br />
							조기에 발견하여 선제적으로 해결하는 실행 습관이 바로 준법경영의 단단한 출발점입니다.<br />
							<br />
							여러분이 공정거래에 대한 준법의식을 가지고 법과 원칙을 지켜나가는 이러한 노력이 곧<br />
							우리 회사의 지속적인 성과와 성장을 만들어낼 것입니다.<br />
							<br />
							우리 회사가 투명하고 공정한 기업으로 온전히 정착할 수 있도록,<br />
							임직원 여러분 한 사람 한 사람이 준법을 기업 경쟁력의 핵심으로 생각하며<br />
							공정거래 자율준수 프로그램(CP)을 철저하게 준수하여 주시기 바랍니다.<br />
							<br />
							감사합니다.
							<div class="bottom-wrap">
								<span class="bold">(주)엔에스쇼핑 대표이사 사장 조 항 목</span>
								<span class="bold">2026.11.05</span>
							</div>
						</div>

					</div>

					<div class="img-box">
						<img src="../_Img/Sub/intro/ceo.png" alt="이미지" style="height: 889px;">
					</div>

				</div>

			</div>

		</article>

		<div class="confirm">
			<a href="javascript:confirmProc()">확인</a><span>페이지 다 읽으신 후 <strong>확인버튼</strong>을 클릭해 주시면 나의 마일리지에
				반영됩니다.</span>
		</div>
		<!-- page-end //-->
	</div>
</div>
<script>
	function confirmProc(val) {

		$.ajax({
			type: "POST",
			url: g5_bbs_url + "/ajax.conf_point.php",
			data: {
				"conf": "ceo"
			},
			success: function (data) {
				alert(data);
			},
			error: function (err) { alert("호출 실패하였습니다."); }
		});
	}
</script>
<?php include_once('../_Inc/subTail.php'); ?>