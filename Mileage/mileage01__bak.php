<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
    
<?php
	$sum_point = 0;
	for($i=1; $i<=21; $i++)
	{
		$sum_point += $member['point_' . $i];
	}
?>
<div id="svisual-wrap">
	<div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
		<p class="btxt"><span>마일리지</span></p>
        <p class="stxt">고객, 사회, 협력사와의 동반성장을 추구합니다.</p>
	</div>
	<div class="visimg vis07"></div>
</div>
<div class="content-ov">
	<div id="subNavi-wrap">
		<div id="subNavi">
			<div class="lm-tit">
				<div class="tit">
					<p class="btxt">mileage section</p>
					<p class="stxt">마일리지</p>
				</div>
			</div>		
			<div class="leftmenu" id="leftmenu">
				<ul class="depth2">
					<li id="lm01" class='lm_l2 over'><a href="mileage01.php"  class='lm_a2'><span class='isTxt'>나의 마일리지</span></a></li>
				</ul>
			</div>
		</div>
		<?php include_once ('../_Inc/helpInc.php');?>
	</div>
	<div id="contents">
		<img src="../_Img/Content/mileage_ing.png" width="800" alt="" />
	</div>
		
</div>
<?php include_once ('../_Inc/subTail.php');?>
