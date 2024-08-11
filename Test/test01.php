<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
<div id="svisual-wrap">
	<div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
		<p class="btxt"><span>윤리실천 자가진단</span></p>
    <div class="content-top--right">
      <span><img src="../_Img/Icon/home.png" width="25" height="24"></span>
      <span>나의참여</span>
      <span>윤리실천 자가진단</span>
    </div>
	</div>
	<div class="visimg vis03"></div>
</div>
<div class="content-ov">
	<div id="subNavi-wrap">
		<div id="subNavi">
			<div class="lm-tit">
				<div class="tit">
					<p class="btxt">self-diagnosis</p>
					<p class="stxt">자가진단</p>
				</div>
			</div>		
			<div class="leftmenu" id="leftmenu">
				<ul class="depth2">
					<li id="lm01" class='lm_l2 over'><a href="test01.php"  class='lm_a2'><span class='isTxt'>윤리실천 자가진단</span></a></li>
                    <li id="lm01" class='lm_l2'><a href="test02.php"  class='lm_a2'><span class='isTxt'>준법실천 자가진단</span></a></li>
				</ul>
			</div>
		</div>
		<? include_once ('../_Inc/helpInc.php');?>
	</div>
	<div id="contents">
		<div class="cont-top">
			<h2 class="tit">윤리실천 자가진단</h2>
			<ul class="path">
				<li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
				<li>자가진단</li>
				<li>윤리실천 자가진단</li>
			</ul>
		</div>
		<!-- page-start // -->
        <p style="padding-bottom:60px;"><img src="../_Img/Sub/test/test_top2.png" /></p>
        <table class="tbl-type01 p-15">
        <colgroup>
                <col width="10%"/>
				<col width="*"/>
				<col width="8%"/>
				<col width="8%"/>
 </colgroup>
<thead>
  <tr>
    <th>구분</th>
    <th>질문항목</th>
    <th>YES</th>
    <th>NO</th>
  </tr>
</thead>
  <tr>
    <td>1</td>
    <td class="title">나는 업무 수행 시 회사의 윤리규범 및 실천지침을 준수하고 있다.</td>
    <td><input type="radio" name="q1" id="radio" value="1" /></td>
    <td><input type="radio" name="q1" id="radio" value="0" /></td>
  </tr>
  <tr>
    <td>2</td>
    <td class="title">나는 공정한 경쟁을 저해하는 등의 부당한 행위 및 불공정 거래 행위를
하지않는다.</td>
    <td><input type="radio" name="q2" id="radio" value="1" /></td>
    <td><input type="radio" name="q2" id="radio" value="0" /></td>
  </tr>
  <tr>
    <td>3</td>
    <td class="title">잘못처리된 일이 있다면 문제가 더 커지기전에 바로 직속상사에게 정직하게 보고하고, 시정한다.</td>
    <td><input type="radio" name="q3" id="radio" value="1" /></td>
    <td><input type="radio" name="q3" id="radio" value="0" /></td>
  </tr>
  <tr>
    <td>4</td>
    <td class="title">부정확하거나, 불완전한 정보를 상사에게 보고하지 않으며, 
실적을 과대하게 포장하여<br> 상사로 하여금 오해를 유발시키는 행동을 하지
않는다.</td>
    <td><input type="radio" name="q4" id="radio" value="1" /></td>
    <td><input type="radio" name="q4" id="radio" value="0" /></td>
  </tr>
  <tr>
    <td>5</td>
    <td class="title">나의행동으로 인해 부당한 이익이나 손해를 보는 사람은 없다.</td>
    <td><input type="radio" name="q5" id="radio" value="1" /></td>
    <td><input type="radio" name="q5" id="radio" value="0" /></td>
  </tr>
  <tr>
            <td>6</td>
            <td class="title">직무나 직위, 회사의 이름을 이용하여 부당한 이익을 얻는 등 회사의 명성에 누를 끼치는 행위를 하지 않는다.</td>
            <td><input type="radio" name="q6" id="radio" value="1" /></td>
            <td><input type="radio" name="q6" id="radio" value="0" /></td>
          </tr>
          <tr>
            <td>7</td>
            <td class="title">직무 수행상 부득이한 경우에 한하여 제공되는 식사나 편의라 하더라도 3만원이상은 절대 받지 않는다.</td>
            <td><input type="radio" name="q7" id="radio" value="1" /></td>
            <td><input type="radio" name="q7" id="radio" value="0" /></td>
          </tr>
          <tr>
            <td>8</td>
            <td class="title">부적절한 내용의 선물, 금품 또는 접대를 제공하거나, 이를 시도하는 회사와는 거래를 하지 않는다.</td>
            <td><input type="radio" name="q8" id="radio" value="1" /></td>
            <td><input type="radio" name="q8" id="radio" value="0" /></td>
          </tr>
          <tr>
            <td>9</td>
            <td class="title">거절하기 힘든 선물을 받았을 경우 바로 직속 상사에게 보고한다.</td>
            <td><input type="radio" name="q9" id="radio" value="1" /></td>
            <td><input type="radio" name="q9" id="radio" value="0" /></td>
          </tr>
          <tr>
            <td>10</td>
            <td class="title">고객개인정보 관리규정을 준수하고 있으며, 고객 개인정보를 훼손하거나 외부에 누설하지 않는다.</td>
            <td><input type="radio" name="q10" id="radio" value="1" /></td>
            <td><input type="radio" name="q10" id="radio" value="0" /></td>
          </tr>
          <tr>
            <td>11</td>
            <td class="title">회사의 영업기밀을 외부에 반출하지 않으며, 외부에 정보 발송 시 직속상사의 승인을 받은 후 발송한다.</td>
            <td><input type="radio" name="q11" id="radio" value="1" /></td>
            <td><input type="radio" name="q11" id="radio" value="0" /></td>
          </tr>
          <tr>
            <td>12</td>
            <td class="title">지난 1년간 예산을 위법 또는 부당하게 집행한 적이 없다.</td>
            <td><input type="radio" name="q12" id="radio" value="1" /></td>
            <td><input type="radio" name="q12" id="radio" value="0" /></td>
          </tr>
          <tr>
            <td>13</td>
            <td class="title">지난 1년간 법인카드를 사적으로 사용 한 후 업무 경비로 처리한 적이 없다.</td>
            <td><input type="radio" name="q13" id="radio" value="1" /></td>
            <td><input type="radio" name="q13" id="radio" value="0" /></td>
          </tr>
          <tr>
            <td>14</td>
            <td class="title">공사의 구분을 엄격히 하여 사적으로 회사의 물품, 비용등을 사용하지 않는다.</td>
            <td><input type="radio" name="q14" id="radio" value="1" /></td>
            <td><input type="radio" name="q14" id="radio" value="0" /></td>
          </tr>
          <tr>
            <td>15</td>
            <td class="title">성적 수치심을 일으키는 성적 유혹이나, 농담, 신체적 접촉을 하지 않는다.</td>
            <td><input type="radio" name="q15" id="radio" value="1" /></td>
            <td><input type="radio" name="q15" id="radio" value="0" /></td>
          </tr>
        </table>
        <p class="exmark-txt">해당 질문 항목에 체크해 주세요.</p>
        <div style="text-align:center;margin-top:45px">
          <a href="javascript:confVal()" class="class-enter" >확인</a>
        </div>
		<!-- page-end //-->
	</div>
</div>
<script>
function confVal() {
	if(!$("input:radio[name='q1']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q2']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q3']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q4']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q5']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q6']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q7']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q8']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q9']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q10']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q11']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q12']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q13']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q14']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else if(!$("input:radio[name='q15']").is(":checked")) {
		alert("모든 질문 항목에 체크해주세요");
	} else {	
		
		var cnt = 0;
		
		for(i=1; i<=15;i++)
		{
			if($("input:radio[name=q" + i + "]:checked").val() == "1")
				cnt++;
		}
		
		
		$.ajax({
			type: "POST",
			url: g5_bbs_url+"/ajax.conf_point.php",
			data : {
				"conf": "self1"
			},
			success: function(data){
				alert(data);
				location.href="test01_02.php?chk=" + cnt;
			},
			error: function(err){ alert("호출 실패하였습니다.") ;}
		});
		
	}

}
</script>
<? include_once ('../_Inc/subTail.php');?>