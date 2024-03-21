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
            <li><a href="manage03.php">CP개요</a></li>
            <li class="on"><a href="manage03_02.php">CP전략</a></li>
            <li><a href="manage03_03.php">CP연혁</a></li>
            <li><a href="manage03_04.php">CP조직</a></li>
            <li><a href="manage03_05.php">CP운영현황</a></li>
          </ul>
        </div>
        <div>
        <p style="padding-top:40px;"><img src="../_Img/Sub/manage/03_12.jpg" width="800" height="145"></p>
         <p style="padding-top:30px;"><img src="../_Img/Sub/manage/03_08.jpg" width="801" height="790"></p>
        
        <!-- page-end //--> 
      </div>
    </div>
    <?php include_once ('../_Inc/subTail.php');?>