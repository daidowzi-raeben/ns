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
      <div id="contents">
        <p style="padding-bottom:60px;"><img src="../_Img/Sub/test/test_top2.png" /></p>

        <div class="test-result">
          <div class="tit">자가진단 결과</div>
          <div class="box"><img src="../_Img/Icon/list.png" /><strong>YES</strong> 총 <strong><?php echo $chk?></strong>개 입니다.</div>

          <div class="bottom">
            <div class="col">
              <div class="label">YES 14개 이상</div>
              <div class="text">윤리경영 실천을 잘 준수하고 있습니다.</div>
              
              <div class="label">YES 10개 이상</div>
              <div class="text">윤리경영 실천을 준수하고 있으나, '아니오' 라고 대답한 항목은 변화해야 합니다.</div>
            </div>
            <div class="col">
              <div class="label">YES 12개 이상</div>
              <div class="text">윤리경영 실천을 잘 준수하고 있습니다.</div>
              
              <div class="label">YES 10개 미만</div>
              <div class="text">매우 위험한 업무태도입니다. 즉각 업무 방식과 태도를 변화해야 합니다.</div>
            </div>
          </div>
        </div>

      </div>
    </div>
    
    <?php include_once ('../_Inc/subTail.php');?>