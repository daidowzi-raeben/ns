<?
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
    <div id="svisual-wrap">
      <div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
        <p class="btxt"><span>자가진단</span></p>
        <p class="stxt">고객, 사회, 협력사와의 동반성장을 추구합니다.</p>
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
        <p style="padding-bottom:30px;"><img src="../_Img/Sub/test/title_ethics.jpg" width="800" height="232"></p>
        <div class="result">
          <p class="score">‘<span style="font-weight:bold">YES</span>’&nbsp;총 <span style="font-weight:bold; color:#e83f2e"><?php echo $chk?></span>개입니다.</p>
          <p class="txt1">자가진단 결과 입니다.</p>
          <ul>            
            <li><img src="../_Img/Sub/community/red_dot.gif" width="5" height="5" style=""><span class="bold"> YES 14개이상 :</span> 윤리경영 실천을 잘 준수하고 있습니다.</li>
            <li><img src="../_Img/Sub/community/red_dot.gif" width="5" height="5" style=""><span class="bold"> YES 12개이상 :</span> 윤리경영 실천을 준수하고 있으나,<br><span class="gap_t">'아니오' 라고 대답한 항목은 변화해야 합니다.</span></li>
            <li><img src="../_Img/Sub/community/red_dot.gif" width="5" height="5" style=""><span class="bold"> YES 10개이상 :</span> 윤리경영 실천이 미흡합니다. 윤리경영의 <br><span class="gap_t">중요성을 상기하며 업무를 수행해야 합니다.</span></li>
            <li><img src="../_Img/Sub/community/red_dot.gif" width="5" height="5" style=""><span class="bold"> YES 10개미만 :</span> 매우 위험한 업무태도입니다. 즉각 업무 방식과<br><span class="gap_t"> 태도를 변화해야 합니다.</span></li>
          </ul>
        </div>
        <!-- page-end //--> 
      </div>
    </div>
    
    <? include_once ('../_Inc/subTail.php');?>