<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
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
              <li id="lm01" class='lm_l2'><a href="../Intro/intro01.php"  class='lm_a2'><span class='isTxt'>CEO 메시지</span></a></li>
              <li id="lm02" class='lm_l2 over'><a href="../Intro/intro02.php"  class='lm_a2'><span class='isTxt'>자율준수관리자 메시지</span></a></li>
            </ul>
          </div>
        </div>
        <?php include_once ('../_Inc/helpInc.php');?>
      </div>
      <div id="contents">
        <div class="cont-top">
          <h2 class="tit">자율준수관리자 메시지</h2>
          <ul class="path">
            <li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
            <li>소개</li>
            <li>자율준수관리자 메시지</li>
          </ul>
        </div>
        <!-- page-start // -->
        <p style="background:url(../_Img/Sub/intro/intro_3.jpg) no-repeat left top; height:150px; padding:128px 0 0 27px;">NS가 CP를 도입한 지도 어느덧 15년이 흘렀습니다.<br>
          CP운영에 필요한 체계를 마련하고, <br>
          점차적으로 발전시켜온 NS는 금번 NS윤리준법시스템 오픈을 <br>
          CP발전의 새로운 도약점으로 삼고자 합니다.</p>
        <p style="padding-left:25px;">NS윤리준법시스템은 CP 뿐만 아니라 윤리·준법경영 전반을 담고 있습니다.<br>
          임직원 개개인의 윤리·준법 실천 수준을 확인할 수 있는 「자가진단」, e-준법교육캠페인과 e-윤리영상캠페인 등 윤리·준법
          지식을 학습할 수 있는 「사이버교육 및 집체교육」 지속가능경영 관련 사규, CP편람 등을 한 눈에 볼 수 있는 「가이드라인」 등
          윤리·준법경영과 관련된 모든 것을 NS윤리준법시스템에서 통합 관리하고자 합니다.<br>
          <br>
          특히, 마일리지 제도를 통해 고득점자에게는 포상을 실시하여 임직원들에게 윤리·준법경영 실천에 대한 유인을
          제공하겠습니다. NS는 앞으로도 윤리·준법경영 콘텐츠에 대한 접근성을 높이기 위해 최선의 노력을 다할 것입니다.<br>
          임직원 여러분의 많은 이용 바랍니다.<br>
          <br>
          감사합니다.</p>
          <p style="font-weight:bold;padding-left:25px;"><span style="padding-right:570px;">2019.7.1.</span><span style="font-size:16px;">NS 자율준수관리자</span></p>
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