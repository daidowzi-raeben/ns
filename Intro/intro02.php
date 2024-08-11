<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
<link type="text/css" rel="stylesheet" href="../_Css/intro.css"/>
    <div id="svisual-wrap">
      <div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
        <p class="btxt"><span>자율준수관리자 메시지</span></p>
        <div class="content-top--right">
          <span><img src="../_Img/Icon/home.png" width="25" height="24"></span>
          <span>소개</span>
          <span>자율준수관리자 메시지</span>
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
        <article class="intro">

          <div class="intro-wrap">
                
            <div class="intro-tit-box">

              NS는 원칙을 기반으로 한 컴플라이언스 준수 문화 확립과 임직원의 준법의식<br />
              제고를 위해 사회적 책임을 다하고 있습니다.

            </div>

            <div class="intro-con-box">

              <div class="img-box">
                <img src="../_Img/Sub/intro/content.png" alt="이미지">
              </div>

              <div class="txt-box">
                <div class="des-box">
                  NS는 공정거래법뿐만 아니라 대규모유통업법, 하도급법 등의 법령을 준수하기 위하여<br/>
                  정기적인 교육 및 CP점검, 자율준수편람 배포 등의 다양한 컴플라이언스 활동을<br/>
                  실시하고 있습니다.<br/>
                  <br/>
                  또한, 회사의 규정 및 자율준수를 성실히 실천한 사람에게는 포상을 실시하고,<br/>
                  법위반 사항에 대해서는 제재를 가함으로써 임직원의 적극적인 준법실천을 독려하고 있습니다.<br/>
                  <br/>
                  더 나아가 '적극적인 CP운영으로, 회사에 자율준수 문화를 정착시키고 협력사와 상생한다'는<br/>
                  우리의 CP MISSION에 걸맞게 협력사의 준법경영을 지원하여 진정한 동반성장을<br/>
                  실현하고자 노력 하겠습니다.<br/>
                  <br/>
                  NS는 앞으로도 회사의 지속적인 성장과 발전에 필요한 컴플라이언스 프로그램을<br/>
                  적극적으로 운영할 예정이오니, 임직원 여러분들의 많은 관심과 협조를 당부드립니다.<br/>
                  <br/>
                  감사합니다.<br/>
                  <div class="bottom-wrap">
                    <span>NS 자율준수관리자</span>
                    <span>2024.07.06</span>
                  </div>
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