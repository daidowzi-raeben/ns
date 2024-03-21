<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
    <div id="svisual-wrap">
      <div class="vistxt">
        <p class="btxt"><span>지속가능경영</span></p>
        <p class="stxt">고객, 사회, 협력사와의 동반성장을 추구합니다.</p>
      </div>
      <div class="visimg vis02"></div>
    </div>
    <div class="content-ov">
      <div id="subNavi-wrap">
        <div id="subNavi">
          <div class="lm-tit">
            <div class="tit">
              <p class="btxt">Sustainability</p>
              <p class="stxt">지속가능경영</p>
            </div>
          </div>
          <div class="leftmenu" id="leftmenu">
            <ul class="depth2">
              <li id="lm01" class='lm_l2'><a href="../Manage/manage01.php"  class='lm_a2'><span class='isTxt'>지속가능경영 </span></a></li>
              <li id="lm02" class='lm_l2'><a href="../Manage/manage02.php"  class='lm_a2'><span class='isTxt'>윤리경영</span></a></li>
              <li id="lm02" class='lm_l2 over'><a href="../Manage/manage03.php"  class='lm_a2'><span class='isTxt'>준법경영</span></a></li>
            </ul>
          </div>
        </div>
        <?php include_once ('../_Inc/helpInc.php');?>
      </div>
      <div id="contents">
        <div class="cont-top">
          <h2 class="tit">준법경영</h2>
          <ul class="path">
            <li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
            <li>지속가능경영</li>
            <li>준법경영</li>
          </ul>
        </div>
        <!-- page-start // -->
        <div class="tab_menu2">
          <ul>
            <li class="on"><a href="manage03.php">CP개요</a></li>
            <li><a href="manage03_02.php">CP전략</a></li>
            <li><a href="manage03_03.php">CP연혁</a></li>
            <li><a href="manage03_04.php">CP조직</a></li>
            <li><a href="manage03_05.php">CP운영현황</a></li>
          </ul>
        </div>
        <p style="padding-top:40px;"><img src="../_Img/Sub/manage/03_11.jpg" width="800" height="145"></p>
        <p><img src="../_Img/Sub/manage/03_01.jpg" width="801" height="724"></p>
         <div class="sgap"></div>
        <p class="txt_title2">CP 도입 및 운영의 필요성</p>
        <div class="ethics2">
          <p><img src="../_Img/Sub/manage/03_02.jpg" width="800" height="212"></p>
          <ul class="line_bg">
            <li>CP 도입 후 평가신청을 통해 A등급 이상 획득 시 공정위로부터 각종 인센티브를 받을 수 있습니다.</li>
            <li><img src="../_Img/Sub/manage/03_05.jpg" width="120" height="30" style="padding:3px 10px 2px 0;">위반행위에 대한 직권조사 면제(1~2년)</li>
            <li><img src="../_Img/Sub/manage/03_06.jpg" width="120" height="30" style="padding-right:10px;">시정명령 받은 사실의 공표크기 및 매체수 1단계 하향조정, 공표기간 추가 단축</li>
          </ul>
          <p><img src="../_Img/Sub/manage/02_08.jpg" width="800" height="24"></p>
        </div>
        <div class="sgap"></div>
        <div class="ethics2">
          <p><img src="../_Img/Sub/manage/03_03.jpg" width="800" height="212"></p>
          <ul class="line_bg">
            <li> 미국, 유럽, 일본 등 선진국들은 이미 CP를 도입/운영하고 있으며, 기업의 법 위반에 대한 심결 및 판결의 양형 기준에<br> 
포함시키기도 하는 등 CP는 이미 글로벌 스탠다드로 작동하고 있습니다. 이를 통해 사업의 글로벌화와 지속가능 경영도<br>
가능해 집니다.</li>
          </ul>
          <p><img src="../_Img/Sub/manage/02_08.jpg" width="800" height="24"></p>
        </div>
        <div class="sgap"></div>
        <div class="ethics2">
          <p><img src="../_Img/Sub/manage/03_04.jpg" width="800" height="212"></p>
          <ul class="line_bg">
            <li> 고객에게 준법기업으로서 긍정적인 이미지와 신뢰를 심어줌으로써, 장기적 관점에서 회사의 매출 확대 등 이익 창출에<br> 
기여합니다.</li>
          </ul>
          <p><img src="../_Img/Sub/manage/02_08.jpg" width="800" height="24"></p>
        </div>
        <div class="sgap"></div>
        <p class="txt_title2">CP의 운영절차</p>
        <p><img src="../_Img/Sub/manage/03_07.jpg" width="800" height="103"></p>
        
        <!-- page-end //--> 
      </div>
    </div>
    <?php include_once ('../_Inc/subTail.php');?>