<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
<div id="svisual-wrap">
	<div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
		<p class="btxt"><span>준법실천 자가진단</span></p>
        <div class="content-top--right">
          <span><img src="../_Img/Icon/home.png" width="25" height="24"></span>
          <span>나의참여</span>
          <span>준법실천 자가진단</span>
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
					<li id="lm01" class='lm_l2'><a href="test01.php"  class='lm_a2'><span class='isTxt'>윤리실천 자가진단</span></a></li>
                    <li id="lm01" class='lm_l2 over'><a href="test02.php"  class='lm_a2'><span class='isTxt'>준법실천 자가진단</span></a></li>
				</ul>
			</div>
		</div>
		<? include_once ('../_Inc/helpInc.php');?>
	</div>
	<div id="contents">
		<div class="cont-top">
			<h2 class="tit">준법실천 자가진단</h2>
			<ul class="path">
				<li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
				<li>자가진단</li>
				<li>준법실천 자가진단</li>
			</ul>
		</div>
		<!-- page-start // -->
        <p style="padding-bottom:60px;"><img src="../_Img/Sub/test/test_top1.png" /></p>
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
    <td class="title">나는 업무 수행 시 대규모유통업법, 공정거래법 등 공정거래 관련 법규를 철저히 준수한다.</td>
    <td><input type="radio" name="q1" id="radio" value="1" /></td>
    <td><input type="radio" name="q1" id="radio" value="1" /></td>
  </tr>
  <tr>
    <td>2</td>
    <td class="title">나는 업무 수행 시 수시로 공정거래 자율준수 체크리스트를 확인하고, 체크리스트에 없는 사항은 자율준수전담부서(준법지원팀)에 문의함으로써 위법 요소를 제거한다.</td>
    <td><input type="radio" name="q2" id="radio" value="1" /></td>
    <td><input type="radio" name="q2" id="radio" value="1" /></td>
  </tr>
  <tr>
    <td>3</td>
    <td class="title">나는 업무 수행 시 위법 요소를 발견한 경우, 즉시 자율준수관리자(또는 자율준수전담부서)에게 보고한다.</td>
    <td><input type="radio" name="q3" id="radio" value="1" /></td>
    <td><input type="radio" name="q3" id="radio" value="1" /></td>
  </tr>
  <tr>
    <td>4</td>
    <td class="title">나는 우리 회사의 CP 관련 제도(포상·제재, 사전업무협의제도, 자율준수관리자 면담제도, 법률지원센터, 자율준수책임자·담당자제도 등)를 잘 알고 있으며, 업무 수행 시 적극적으로 활용하고자 노력하고 있다.</td>
    <td><input type="radio" name="q4" id="radio" value="1" /></td>
    <td><input type="radio" name="q4" id="radio" value="1" /></td>
  </tr>
  <tr>
    <td>5</td>
    <td class="title">나는 우리 회사의 CP 비전(영속하는 세계일류 준법기업) 달성을 위해 자율준수관리자가 주도하는 CP활동(교육, 점검 등)에 적극적으로 참여하고 있다.</td>
    <td><input type="radio" name="q5" id="radio" value="1" /></td>
    <td><input type="radio" name="q5" id="radio" value="1" /></td>
  </tr>
</table>
<p class="exmark-txt">해당 질문 항목에 체크해 주세요.</p>
<div style="text-align:center;margin-top:45px;">
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
	} else {
		$.ajax({
		type: "POST",
		url: g5_bbs_url+"/ajax.conf_point.php",
		data : {
            "conf": "self2"
        },
		success: function(data){
				alert(data);
				location.reload();
		},
		error: function(err){ alert("호출 실패하였습니다.") ;}
		});
	}
	
}
</script>
<? include_once ('../_Inc/subTail.php');?>