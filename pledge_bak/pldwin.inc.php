<link href='https://cdn.rawgit.com/openhiun/hangul/14c0f6faa2941116bb53001d6a7dcd5e82300c3f/nanumbarungothic.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/nanummyeongjo.css">
<link rel="stylesheet" href="./pledge/css/style.css">
<!-- 서약서팝업레이어 시작 { -->
<div id="hd_pop">
    <h2>팝업레이어 알림</h2>

    <div id="hd_pops_11" class="hd_pops" style="top:0px;left:400px">
        <div class="hd_pops_con" style="width:850px;height:660px">
            <div class="contract-pop">
				<div class="logo"><img src="./pledge/images/logo.png" alt=""></div>
				<h1 class="mj">공정거래 자율준수 서약문</h1>
				<p class="">
					나는 (주)엔에스쇼핑의 임직원으로서 자율적으로 공정거래 법규를<br/>
					준수하고 고객과 협력사를 보호함으로써, 공정하고 건전한 방송∙유통산업<br/>
					거래질서의 확립에 기여할 것을 다짐하며 다음과 같이 서약합니다.
				</p>
				<ul>
					<li>
						<span>하나. </span>
						협력사와 체결한 계약내용과 다르게 상품대금을 감액하지 않습니다.
					</li>
					<li>
						<span>하나. </span>
						협력사로부터 납품 받은 상품의 전부 또는 일부를 정당한 사유 없이
						반품하지 않습니다.
					</li>
					<li>
						<span>하나. </span>
						판매촉진행사를 실시하기 전에 협력사와 법적 기준을 준수하여
						비용 부담 등 상세사항을 서면으로 정합니다.
					</li>
					<li>
						<span>하나. </span>
						협력사에게 정당한 사유 없이 경제적 이익 제공을 요구하거나,
						불이익을 제공하지 않습니다.
					</li>
					<li>
						<span>하나. </span>
						협력사에 대하여 방송편성을 조건으로 방송의 일자, 시각, 분량 및
						제작비용을 불공정하게 결정하거나 취소 또는 변경하지 않습니다.
					</li>
					<li>
						<span>하나. </span>
						계열회사 및 특수관계인을 부당하게 지원하거나 지원을 받지 않습니다.
					</li>
					<li>
						<span>하나. </span>
						고객에게 상품정보 및 거래기준을 명확히 고지하고, 고객의 동의를
						받지 않은 고객정보는 이용하거나 제3자에게 제공하지 않습니다.
					</li>
				</ul>

				<form action="">
					<div class="form">
						<div class="date">
							<span id="year"></span>년
							<input type="text" id="month"> 월
							<input type="text" id="date"> 일
						</div>
						<div class="name">
							사번: <input type="text" style="width:150px;">
							<span></span>
							이름: <input type="text">
						</div>
						<div class="btnbox">
							<button type="button">제출</button>
						</div>
					</div>

				</form>
				<script>
					var Date = new Date();
					var year = Date.getFullYear();
					var month = Date.getMonth() + 1;
					var date = Date.getDate();
					window.onload = function(){
						document.getElementById('year').innerText = year;
						document.getElementById('month').value = month;
						document.getElementById('date').value = date;
					}
				</script>
			</div>
        </div>
        <div class="hd_pops_footer">
            <button class="hd_pops_reject hd_pops_11 24"><strong>24</strong>시간 동안 다시 열람하지 않습니다.</button>
            <button class="hd_pops_close hd_pops_11">닫기</button>
        </div>
    </div>
</div>

<script>
$(function() {
    $(".hd_pops_reject").click(function() {
        var id = $(this).attr('class').split(' ');
        var ck_name = id[1];
        var exp_time = parseInt(id[2]);
        $("#"+id[1]).css("display", "none");
        set_cookie(ck_name, 1, exp_time, g5_cookie_domain);
    });
    $('.hd_pops_close').click(function() {
        var idb = $(this).attr('class').split(' ');
        $('#'+idb[1]).css('display','none');
    });
    $("#hd").css("z-index", 1000);
});
</script>
<!-- } 서약서팝업레이어 끝 -->