<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
	$guideOver2 = ' over';
?>
<div id="svisual-wrap">
	<div class="vistxt">
		<p class="btxt"><span>자율준수편람</span></p>
        <div class="content-top--right">
          <span><img src="../_Img/Icon/home.png" width="25" height="24"></span>
          <span>가이드라인/법령</span>
          <span>자율준수편람</span>
        </div>
	</div>
	<div class="visimg vis05"></div>
</div>
<div class="content-ov">
	<div id="subNavi-wrap">
		<div id="subNavi">
			<div class="lm-tit">
				<div class="tit">
					<p class="btxt">GUIDELINE</p>
					<p class="stxt">가이드라인</p>
				</div>
			</div>		
			<?php include_once (G5_PATH.'/Guide/guide_left.php');?>
		</div>
		<? include_once ('../_Inc/helpInc.php');?>
	</div>
	<div id="contents">
		<div class="cont-top">
			<h2 class="tit">자율준수편람</h2>
			<ul class="path">
				<li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
				<li>가이드라인</li>
				<li>자율준수편람</li>
			</ul>
		</div>
		<!-- page-start // -->
		<div class="content-tit">자율준수편람</div>
		<div class="content-row">
			<div class="img-wrap content-left">
				<img src="../_Img/Sub/guide/content_1.png" />
			</div>
			<div class="txt-wrap">
				NS홈쇼핑의 공정거래자율준수편람은 임직원들에게 공정거래 자율준수에 대한 가이드를 제시하기 위해 발간되었습니다.<br />
				2004년 9월 초판 발행 이후 일곱 차례에 걸쳐 개정되면서 변화하는 법 현실을 반영해왔습니다.<br />
				<br />
				이에 2021년 12월 공정거래자율준수편람 제8판을 개정 발간합니다.<br />
				공정거래자율준수편람 제8판은 2018년 발간한 제7판을 보완 개정하여 임직원 여러분의 편람 가독성 및
				가용성을 높이고자 노력하였습니다. 2021년 최신 법령 제·개정내용 및 판례·심결례를 반영하였고,<br />
				웹툰을 추가 수록하여 관련 내용을 보다 쉽게 이해할 수 있도록 하였습니다.<br />
				<br />
				임직원 여러분께서는 공정거래자율준수 편람 및 개인별 배부된 소책자(업무가이드라인 및 체크리스트 수록)를 숙독하여 평소 업무 수행 시 위법사항이 발생하지 않도록 유의해주시기 바랍니다.<br />
				<br /><br />
				<a href="#" onclick="confirmProc()" class="btn-primary">자율준수편람 보기<img src="../_Img/Icon/download.png" /></a>
			</div>
		</div>
		
		
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
            "conf": "guide02"
        },
		success: function(data){
			//alert(data);
			//window.open("http://nsenc.sejongenc.kr/ebook/ecatalog5.html");
			window.open("http://nstest.sejong21.co.kr/ebook/ecatalog5.html");
			
		},
		error: function(err){ alert("호출 실패하였습니다.") ;}
	});
}
</script>
<? include_once ('../_Inc/subTail.php');?>