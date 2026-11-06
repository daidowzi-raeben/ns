<?php
include_once('../_Inc/subHead.php');

if (!$is_member) {
  alert(NS_LOGIN_MSG);
}
?>
<link type="text/css" rel="stylesheet" href="../_Css/intro.css" />
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
          <li id="lm01" class='lm_l2'><a href="../Intro/intro01.php" class='lm_a2'><span class='isTxt'>CEO
                메시지</span></a></li>
          <li id="lm02" class='lm_l2 over'><a href="../Intro/intro02.php" class='lm_a2'><span class='isTxt'>자율준수관리자
                메시지</span></a></li>
        </ul>
      </div>
    </div>
    <?php include_once('../_Inc/helpInc.php'); ?>
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

          NS는 원칙을 기반으로 한 컴플라이언스 준수 문화 확립과 임직원의 준법의식 제고를 위해<br />
          사회적 책임을 다하고 있습니다.

        </div>

        <div class="intro-con-box">

          <div class="img-box">
            <img src="../_Img/Sub/intro/content.png" alt="이미지">
          </div>

          <div class="txt-box">
            <div class="des-box">
              NS 임직원 여러분께<br />
              <br />
              공정거래 자율준수는 우리 NS의 지속적인 성장과 사회적 신뢰 확보를 위한<br />
              가장 기본적이고 중요한 원칙입니다.<br />
              <br />
              NS는 임직원 여러분들에게 보다 실질적 도움이 될 수 있도록 지속적으로 CP교육을<br />
              운영하고 반드시 숙지해야 할 준법 가이드라인을 제공하고 있습니다.<br />
              <br />
              앞으로도 준법을 실천할 수 있는 환경을 만들어 나갈 수 있도록<br />
              적극적으로 지원할 예정이오니 임직원 여러분들은 문의사항이 있거나<br />
              준법경영을 위해 더 좋은 개선 방안이 있는 경우 언제든지 자율준수관리자 또는<br />
              자율준수전담부서(준법지원팀)에 연락주시기 바랍니다.<br />
              <br />
              여러분의 성실한 참여와 실천으로 우리 NS에 자율준수 문화가 정착할 수 있도록<br />
              다시 한번 각자의 자리에서 준법 정신을 일상화해주시길 당부드립니다.<br />
              <br />
              감사합니다.<br />
              <div class="bottom-wrap">
                <span class="bold">자율준수관리자 상무 이 상 근</span>
                <span class="bold">2026.11.05</span>
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
      url: g5_bbs_url + "/ajax.conf_point.php",
      data: {
        "conf": "cmp"
      },
      success: function (data) {
        alert(data);
      },
      error: function (err) { alert("호출 실패하였습니다."); }
    });
  }
</script>
<?php include_once('../_Inc/subTail.php'); ?>