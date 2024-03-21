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
              <li id="lm02" class='lm_l2 over'><a href="../Manage/manage02.php"  class='lm_a2'><span class='isTxt'>윤리경영</span></a></li>
              <li id="lm02" class='lm_l2'><a href="../Manage/manage03.php"  class='lm_a2'><span class='isTxt'>준법경영</span></a></li>
            </ul>
          </div>
        </div>
        <?php include_once ('../_Inc/helpInc.php');?>
      </div>
      <div id="contents">
        <div class="cont-top">
          <h2 class="tit">윤리경영</h2>
          <ul class="path">
            <li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
            <li>지속가능경영</li>
            <li>윤리경영</li>
          </ul>
        </div>
        <!-- page-start // -->
        <div class="tab_menu">
          <ul>
            <li class="on"><a href="manage02.php">NS윤리철학</a></li>
            <li><a href="manage02_02.php">윤리경영 추진체계</a></li>
            <li><a href="manage02_03.php">윤리위원회</a></li>
          </ul>
        </div>
        <p class="txt_title2">윤리강령</p>
        <div class="ethics">
        <!--
          <ul>
            <li>우리는 고객만족을 모든 판단과 행동의 최우선 기준으로 삼아 항상 고객의 눈으로 바라보고 생각하고<br>
              행동하며 미래에 도전한다.</li>
            <li class="num2">우리는 투명경영과 내실경영을 통해 장기적이고 안정적인 이익을 실현함으로써 주주가치 극대화에 최선을 다한다.</li>
            <li class="num3">우리는 협력회사와 공정하고 투명한 거래를 통해 상호신뢰와 협력관계를 구축함으로써 장기적 관점에서의<br>
              공동발전을 도모한다.</li>
            <li class="num4">우리는 관련법규를 준수하며 경쟁사와 공정한 방법으로 경쟁하고, 경쟁력 강화를 위한 끊임없는 노력을 통해 <br>
              경쟁우위를 확보한다.</li>
            <li class="num5">우리는 개개인의 인격체로서 다양성을 인정하고 존중하며, 끝없는 도전과 개선으로 변화하는 생동감 있는 <br>
              조직을 창조한다.</li>
            <li class="num6">우리는 자신의 직무에 원칙을 지키고 혼을 담아 일하며, 청렴결백을 바탕으로 건전한 기업문화를 <br>
              조성하기 위하여 항상 노력한다.</li>
            <li class="num7">우리는 국가와 지역사회의 가치관을 존중하고 제반법규를 준수하며 건전한 기업활동과 사회공헌활동을 통해 <br>
              국가경제와 사회발전에 기여할 수 있도록 노력한다.</li>
            <li class="num8">우리는 품질경영을 통해 서비스와 상품의 명품화를 이룩하고, 고객, 주주, 임직원, 협력회사, 국가에 대한 <br>
              책임을 충실히 이행함으로써 명문기업으로 도약한다.</li>
          </ul>-->
        </div>
        <div class="sgap"></div>
        <p class="txt_title2">핵심가치</p>
        <p style="padding-left:150px;"><img src="../_Img/Sub/manage/02_02.jpg" alt="핵심가치" width="504" height="458"></p>
        <div class="sgap"></div>
        <p class="txt_title2">실천지침</p>
        <div class="ethics2">
          <p><img src="../_Img/Sub/manage/02_03.jpg" width="800" height="212"></p>
          <ul class="line_bg">
            <li>1) 최고품질의 상품과 서비스를 합리적인 가격으로 제공한다.</li>
            <li>2) 고객만족을 모든 판단 및 행동의 최우선 기준으로 삼는다.</li>
            <li>3) 고객이 알아야 하거나 마땅히 알려야 하는 사실은 충분히 이해할 수 있도록 성실히 알린다.</li>
            <li>4) 고객에 대한 정보는 매뉴얼에 의거 철저히 보안한다.</li>
          </ul>
          <p><img src="../_Img/Sub/manage/02_08.jpg" width="800" height="24"></p>
        </div>
        <div class="sgap"></div>
        <div class="ethics2">
          <p><img src="../_Img/Sub/manage/02_04.jpg" width="800" height="212"></p>
          <ul class="line_bg">
            <li>1) 회사의 자산은 사업목적을 영위하는 데에만 사용한다.</li>
            <li>2) 지속적인 경영혁신과 건전한 재무구조 유지를 통해 경영의 건전성을 확보한다.</li>
            <li>3) 회사 전반적인 업무와 관련된 모든 정보는 정직하고 정확하게 기록하고 보고한다.</li>
          </ul>
          <p><img src="../_Img/Sub/manage/02_08.jpg" width="800" height="24"></p>
        </div>
        <div class="sgap"></div>
        <div class="ethics2">
          <p><img src="../_Img/Sub/manage/02_05.jpg" width="800" height="212"></p>
          <ul class="line_bg">
            <li>1) 사회의 윤리적 가치관 및 시장질서를 존중하여 사회적 기업으로서의 책임을 다한다.</li>
            <li>2) 우리는 사회공헌활동에 적극 참여하고 건전한 사회발전에 이바지한다.</li>
            <li>3) 공정한 경쟁을 통하여 소비자 주권 확립, 중소기업 상생협력, 경제력 집중 억제 등 경제 민주화에 이바지 한다.</li>
          </ul>
          <p><img src="../_Img/Sub/manage/02_08.jpg" width="800" height="24"></p>
        </div>
        <div class="sgap"></div>
        <div class="ethics2">
          <p><img src="../_Img/Sub/manage/02_06.jpg" width="800" height="212"></p>
          <ul class="line_bg">
            <li>1) 상품입점은 공정한 평가기준에 의해 선정하며, 상품입점 선정절차에 관한 제반규정과 제도를 운영한다.</li>
            <li>2) 신규협력사 입점은 해당상품이나 서비스의 적합성, 가격, 납기 및 품질을 기준으로 결정한다.</li>
            <li>3) 모든 협력사에 대하여 공정하고 예의 바른 언행과 태도로 응대하며, 거래상 대등한 지위를 보장한다.</li>
            <li>4) 협력사와 거래 시 사은품 제공을 강요하거나 또는 그 납품업체를 지정하여 권유하는 행위 등 우월적 지위남용 <br>&nbsp;&nbsp;&nbsp;행위를 
              하지 않는다.</li>
            <li>5) 회사는 자금, 기술 등을 지원함으로써 협력사의 경쟁력 향상을 돕고, 상호협력 증진을 통한 공동발전을 위해 노력한다.</li>
            <li>6) 협력회사에 대한 불공정행위로 인하여 피해가 발생한 경우 피해보상협의회의 의결을 거쳐 피해를 보상한다.</li>
            <li>7) 협력사의 모든 상품 샘플은 시연 후 반환을 원칙으로 하고 반환이 어려운 경우 상품대금을 협력사에 지불한다. 
              <br>&nbsp;&nbsp;&nbsp;또한 구매한 샘플은 사적으로 사용하지 않는다.</li>
            <li style="color:#e83f2e">8) 직무관련성과 관계없이 NS홈쇼핑과 거래하는 모든 협력사가 제공하는 식사, 다과는 금액과 관계없이 <br>&nbsp;&nbsp;&nbsp;일체 받지 않는다. (모바일 기프티콘 포함)</li>
            <li style="color:#e83f2e">9) 경조사(부조금,축의금,화환 등)의 경우 5만원 이내로 허용한다.<br>&nbsp;&nbsp;&nbsp;(축의금,조의금5만원, 화환 ·조화(10만원) / 축의금+화환 
              포함_10만원 가능 / 부조금 5만원 이내)</li>
            <li style="color:#e83f2e">10) 직무관련성 있는 이해관계자로 부터 명절, 승진 등 선물을 안주고 안받는다.</li>
            <li style="color:#e83f2e">11) 외부강연 시 사례금으로 1시간당 100만원 이내는 허용한다. 단, 외부강의 전 NS청탁방지담당관에게 신고한다.</li>
          </ul>
          <p><img src="../_Img/Sub/manage/02_08.jpg" width="800" height="24"></p>
        </div>
        <div class="sgap"></div>
        <div class="ethics2">
          <p><img src="../_Img/Sub/manage/02_07.jpg" width="800" height="212"></p>
          <ul class="line_bg">
            <li>1) 동료 및 부서간 적극적인 협조와 긍정적 사고를 통하여 긍정적 조직문화를 형성한다.</li>
<li>2) 자기계발을 통해 창의적이고, NS인재상에 부합되도록 끊임없이 노력한다.</li>
<li>3) 동료 또는 상하간에 직장생활에 필요한 기본예의를 지키고, 조직의 발전을 저해하는 언행을 하지 않는다.</li>
<li>4) 공사의 구분을 엄격히 하여 사적으로 회사의 물품, 비용, 샘플 등을 사용하지 않는다.</li>
<li>5) 성적 수치심을 유발시키는 성적 유혹이나 농담, 신체적 접촉행위를 하지 않는다.</li>
<li>6) 출신지역, 학벌, 전 직장 등에 따른 파벌조성이나 차별대우를 하지 않는다.</li>
<li>7) 고객개인정보일체, 직원정보, 협력사 상품 및 정보를 유출하여서는 안되며, 영업기밀 및 매뉴얼, 프로세스를 임의로 
  <br>&nbsp;&nbsp;유출하지 않는다.</li>
<li>8) 직원 상호간의 금전거래 행위(금전차용, 보증 등), 상습적인 도박행위는 하지 않는다.</li>
<li>9) 직원 상호간 공정한 경쟁을 저해하거나, 부정 및 비리와 관련된 사항을 인지하였을 때는 즉시 감사실에 알리거나 
 <br>&nbsp;&nbsp;헬프라인에 제보한다.</li>
<li>10) 임직원은 상사 리더십에 적극 기여해야 하며, 상사는 부하직원의 리더십 만족도에 적극 기여해야 한다.</li>
<li>11) 업무와 관련한 법규 및 윤리원칙을 준수하며, 직무와 관련한 부정청탁을 받지 않는다.</li>
<li>12) 임직원의 배우자도 청탁금지법 대상임을 명확히 알려주고 법규를 준수토록 한다.</li>
<li>13) 협력사 또는 임직원에게 부정청탁을 받았을 경우 거절의사를 명확히 전달한다.</li>
<li>14) 거절의사를 표현함에도 불구하고, 동일한 부정청탁을 다시 받을 경우 반드시 NS청탁방지담당관에게 신고한다.</li>
<li>15) 공정거래 법령을 자율적으로 준수하고 관련 사내규정을 숙지하여 준법경영 확립에 기여한다.</li>
          </ul>
          <p><img src="../_Img/Sub/manage/02_08.jpg" width="800" height="24"></p>
        </div>
        
        <!-- page-end //--> 
      </div>
    </div>
    <?php include_once ('../_Inc/subTail.php');?>