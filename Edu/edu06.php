<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
    <div id="svisual-wrap">
      <div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
        <p class="btxt"><span>사이버 & 집체교육</span></p>
        <p class="stxt">고객, 사회, 협력사와의 동반성장을 추구합니다.</p>
      </div>
      <div class="visimg vis04"></div>
    </div>
    <div class="content-ov">
      <div id="subNavi-wrap">
        <div id="subNavi">
          <div class="lm-tit">
            <div class="tit">
              <p class="btxt">EDUCATION section</p>
              <p class="stxt">사이버&집체교육 </p>
            </div>
          </div>
          <div class="leftmenu" id="leftmenu">
            <ul class="depth2">
              <li id="lm01" class='lm_l2'><a href="edu01.php"  class='lm_a2'><span class='isTxt'>e_준법교육 캠페인</span></a></li>
              <li id="lm02" class='lm_l2'><a href="edu02.php"  class='lm_a2'><span class='isTxt'>e_윤리교육 캠페인</span></a></li>
              <li id="lm03" class='lm_l2'><a href="edu03.php"  class='lm_a2'><span class='isTxt'>윤리캠페인</span></a></li>
              <li id="lm04" class='lm_l2'><a href="edu04.php"  class='lm_a2'><span class='isTxt'>윤리이야기</span></a></li>
              <li id="lm03" class='lm_l2'><a href="edu05.php"  class='lm_a2'><span class='isTxt'>사이버교육</span></a></li>
              <li id="lm04" class='lm_l2 over'><a href="edu06.php"  class='lm_a2'><span class='isTxt'>교육일정</span></a></li>
            </ul>
          </div>
        </div>
        <?php include_once ('../_Inc/helpInc.php');?>
      </div>
      <div id="contents">
        <div class="cont-top">
          <h2 class="tit">교육일정 </h2>
          <ul class="path">
            <li><img src="../_Img/Sub/icon_home.png" width="13" height="16">
            <li>사이버 & 집체교육 </li>
            <li>교육일정 </li>
          </ul>
        </div>
        <!-- page-start // -->
        <p style="text-align:center; padding-bottom:15px; ">
        <a href="#" style="width:83px; height:30px"><img src="../_Img/Sub/edu/btn_left.gif" width="21" height="21">&nbsp;이전달</a>&nbsp;&nbsp;l&nbsp;
        <span style="color:#e83f2e; font-size:25px; font-weight:bold; display:inline-block; width:150px; height:30px;">2019년 3월</span>
        &nbsp;l&nbsp;&nbsp;<a href="#" style="width:83px; height:30px">다음달&nbsp;<img src="../_Img/Sub/edu/btn_right.gif" width="21" height="21"></a>   
        </p>
        <table class="tbl-type04">
          <colgroup>
          <col width="20%"/>
          <col width="20%"/>
          <col width="20%"/>
          <col width="20%"/>
          <col width="20%"/>
          </colgroup>
          <thead>
            <tr>
              <th>월요일</th>
              <th>화요일</th>
              <th>수요일</th>
              <th>목요일</th>
              <th>금요일</th>
            </tr>
          </thead>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
             <ul>
              <li class="day_red">1</li>
              <li class="plan"><a href="#" onClick="window.open('plan.html','_blank','left=1,top=1,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=540,height=330')" onfocus="this.blur()" alt="교육일정" >윤리경영 특강</a></li>
              <li class="plan">1층 대강당</li>
              <li class="plan">09:30 ~11:30(2시간)</li>
              <li class="plan">전직원</li>
             </ul>
            </td>
          </tr>
          <tr>
            <td class="day">4</td>
            <td class="day">5</td>
            <td class="day">6</td>
            <td class="day">7</td>
            <td class="day">8</td>
          </tr>
          <tr>
            <td><ul>
              <li class="day">11</li>
              <li class="plan"><a href="#" onClick="window.open('plan.html','_blank','left=1,top=1,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=540,height=330')" onfocus="this.blur()" alt="교육일정" >윤리경영 특강</a></li>
              <li class="plan">1층 대강당</li>
              <li class="plan">09:30 ~11:30(2시간)</li>
              <li class="plan">전직원</li>
             </ul></td>
            <td class="day">12</td>
            <td class="day">13</td>
            <td class="day">14</td>
            <td class="day">15</td>
          </tr>
          <tr>
            <td class="day">18</td>
            <td class="day">19</td>
            <td><ul>
              <li class="day">20</li>
              <li class="plan"><a href="#" onClick="window.open('plan.html','_blank','left=1,top=1,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=540,height=330')" onfocus="this.blur()" alt="교육일정" >윤리경영 특강</a></li>
              <li class="plan">1층 대강당</li>
              <li class="plan">09:30 ~11:30(2시간)</li>
              <li class="plan">전직원</li>
             </ul></td>
            <td class="day">21</td>
            <td class="day">22</td>
          </tr>
          <tr>
            <td class="day">25</td>
            <td class="day">26</td>
            <td class="day">27</td>
            <td class="day">28</td>
            <td class="day">29</td>
          </tr>
        </table>
        
        <!-- page-end //--> 
      </div>
    </div>
    <?php include_once ('../_Inc/subTail.php');?>