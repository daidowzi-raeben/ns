<?php
include_once ('../_Inc/subHead.php');
    // alert('마일리지 운영제도 개편중입니다.');
	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}

//     insert_point_ns(
//     'admin',
//     2,
//     '사내 준법 가이드라인 확인',
//     'guide',
//     '',              // 대상 ID 없음
//     'guide',     // ★ rel_action (고정)
//     1
// );

?>

<?php
	$sum_point = 0;
	/*
	for($i=1; $i<=21; $i++)
	{
		$sum_point += $member['point_' . $i];
	}
	*/
?>
<div id="svisual-wrap">
    <div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
        <p class="btxt"><span>마일리지</span></p>
        <div class="content-top--right">
            <span><img src="../_Img/Icon/home.png" width="25" height="24"></span>
            <span>나의참여</span>
            <span>마일리지</span>
        </div>
    </div>
    <div class="visimg vis03"></div>
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
                    <li id="lm01" class='lm_l2 over'><a href="mileage01.php" class='lm_a2'><span class='isTxt'>나의
                                마일리지</span></a></li>
                </ul>
            </div>
        </div>
        <?php include_once ('../_Inc/helpInc.php');?>
    </div>
    <div id="contents">
        <div class="cont-top">
            <h2 class="tit">나의 마일리지</h2>
            <ul class="path">
                <li><img src="../_Img/Sub/icon_home.png" width="13" height="16">
                <li>마일리지</li>
                <li>나의 마일리지</li>
            </ul>
        </div>
        <!-- page-start // -->
        <?php
		$varPer = round($member['mb_point']/338*100);
		
		if($varPer > 100)
			$varPer = 100;
		?>
        <!-- <div  class="m_graph total">
            <div class="tit">마일리지 총 합계</div>
            <div class="num" id="strMile">
            </div>
		</div> -->
        <div class="mileage-total">
            <img src="../_Img/Icon/trophy.png" />
            <div class="text">
                마일리지 총 합계
                <div class="num">
                    <span id="strMile"></span>
                </div>
            </div>
        </div>
        <p
            style="border:1px solid #ccc; color:#000; font-weight:600; background:#f1f1f1; padding:20px; margin-bottom:10px; border-radius:10px; font-size: 18px; line-height:30px;">
            [안내사항]
            <br>
            1. 마일리지는 열람 또는 수행 24시간 이후 재적립 가능합니다.<br>
            2. 당해년도 누적 마일리지 기준 고득점자에게 포상이 실시됩니다.<br>
            3. 다수의 동점자가 발생하는 경우 랜덤추첨으로 포상 대상자가 선정됩니다.

        </p>
        <table class="tbl-type01 mileage">
            <colgroup>
                <col width="*" />
                <col width="10%" />
                <!-- <col width="10%" /> -->
                <!-- <col width="10%" /> -->
                <col width="10%" />
                <col width="15%" />
                <col width="10%" />
                <col width="15%" />
            </colgroup>
            <thead>
                <tr>
                    <th>마일리지 항목</th>
                    <th>기준<br />배점</th>
                    <th>최대적립<br />가능점수</th>
                    <!-- <th>수행<br />가능<br />회차</th> -->
                    <th>나의 최근<br />수행일</th>
                    <th>나의 적립<br />마일리지</th>
                    <!-- <th>나의 획득<br />마일리지</th> -->
                    <th>설명</th>
                </tr>
            </thead>
            <tbody>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "ceo", 0); 
	$stMile = get_mileage($member['mb_id'], "ceo"); 
	$stCnt = get_mileage_count($member['mb_id'], "ceo");
	$sum_point += $stMile;
?>
                <tr>
                    <td>CEO 메시지</td>
                    <td>5</td>
                    <!-- <td>제한없음</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>100</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>열람시 가산</td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "cmp", 0); 
	$stMile = get_mileage($member['mb_id'], "cmp"); 
	$stCnt = get_mileage_count($member['mb_id'], "cmp"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>자율준수관리자 메시지</td>
                    <td>5</td>
                    <!-- <td>제한없음</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>100</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>열람시 가산</td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "self1", 0); 
	$stMile = get_mileage($member['mb_id'], "self1"); 
	$stCnt = get_mileage_count($member['mb_id'], "self1"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>윤리실천 자가진단</td>
                    <td>5</td>
                    <!-- <td>제한없음</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>60</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>수행시 가산</td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "self2", 0); 
	$stMile = get_mileage($member['mb_id'], "self2"); 
	$stCnt = get_mileage_count($member['mb_id'], "self2"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>준법실천 자가진단</td>
                    <td>5</td>
                    <!-- <td>제한없음</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>60</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>수행시 가산</td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "p_comp", 0); 
	$stMile = get_mileage($member['mb_id'], "p_comp"); 
	$stCnt = get_mileage_count($member['mb_id'], "p_comp"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>e-준법교육 캠페인</td>
                    <td>5</td>
                    <!-- <td>52</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>125</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>수행시 가산</td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "e_story", 0); 
	$stMile = get_mileage($member['mb_id'], "e_story"); 
	$stCnt = get_mileage_count($member['mb_id'], "e_story"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>윤리캠페인</td>
                    <td>2</td>
                    <!-- <td>62</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>60</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>수행시 가산</td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "e_story", 0); 
	$stMile = get_mileage($member['mb_id'], "e_story"); 
	$stCnt = get_mileage_count($member['mb_id'], "e_story"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>윤리이야기</td>
                    <td>2</td>
                    <!-- <td>41</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>40</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>수행시 가산</td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "cyber", 0); 
	$stMile = get_mileage($member['mb_id'], "cyber"); 
	$stCnt = get_mileage_count($member['mb_id'], "cyber"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>CP교육</td>
                    <td>250</td>
                    <!-- <td>학습기간 내 1회</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>-</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>수료시 가산</td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "cyber3", 0); 
	$stMile = get_mileage($member['mb_id'], "cyber3"); 
	$stCnt = get_mileage_count($member['mb_id'], "cyber3"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>윤리교육</td>
                    <td>250</td>
                    <!-- <td>학습기간 내 1회</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>-</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>수료시 가산</td>
                </tr>

                <?php 
	$strVal = get_mileage_date($member['mb_id'], "ns_co", 0); 
	$stMile = get_mileage($member['mb_id'], "ns_co"); 
	$stCnt = get_mileage_count($member['mb_id'], "ns_co"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>윤리 톡톡</td>
                    <td>2</td>
                    <!-- <td>제한없음</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>32</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>수행시 가산</td>
                </tr>
                <?php 
$strVal = "";
$stMile = 0;
$stCnt = 0;

for ($i = 1; $i <= 4; $i++) {
    $code = "guide03_" . $i;

    // 최근 수행일 (가장 최신 날짜)
    $tmpDate = get_mileage_date($member['mb_id'], $code, 0);
    if ($tmpDate && (!$strVal || $tmpDate > $strVal)) {
        $strVal = $tmpDate;
    }

    // 마일리지 합산
    $stMile += get_mileage($member['mb_id'], $code);

    // 수행 횟수 합산 (현재 표에는 안 쓰지만 계산은 해둠)
    $stCnt += get_mileage_count($member['mb_id'], $code);
}

$sum_point += $stMile;
?>
                <tr>
                    <td>공정거래 가이드라인</td>
                    <td>3</td>
                    <!-- <td>제한없음</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>144</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>열람시 가산</td>
                </tr>
                <?php 
                $strVal = "";
$stMile = 0;
$stCnt = 0;
for ($i = 1; $i <= 2; $i++) {
    $code = "guide05_" . $i;

    // 최근 수행일 (가장 최신 날짜)
    $tmpDate = get_mileage_date($member['mb_id'], $code, 0);
    if ($tmpDate && (!$strVal || $tmpDate > $strVal)) {
        $strVal = $tmpDate;
    }

    // 마일리지 합산
    $stMile += get_mileage($member['mb_id'], $code);

    // 수행 횟수 합산 (현재 표에는 안 쓰지만 계산은 해둠)
    $stCnt += get_mileage_count($member['mb_id'], $code);
}

$sum_point += $stMile;
?>
                <tr>
                    <td>대규모유통업법 가이드라인</td>
                    <td>3</td>
                    <!-- <td>제한없음</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>72</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>열람시 가산</td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "guide04", 0); 
	$stMile = get_mileage($member['mb_id'], "guide04"); 
	$stCnt = get_mileage_count($member['mb_id'], "guide04"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>청탁금지법 가이드라인</td>
                    <td>3</td>
                    <!-- <td>제한없음</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>36</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>열람시 가산</td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "srvy01", 0); 
	$stMile = get_mileage($member['mb_id'], "srvy01"); 
	$stCnt = get_mileage_count($member['mb_id'], "srvy01"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>CP교육 만족도 조사</td>
                    <td>200</td>
                    <!-- <td>2</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>-</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>수행시 가산<br /><span style="font-size:16px;">(상•하반기 각 1회, 연간 총 2회)</span></td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "srvy02", 0); 
	$stMile = get_mileage($member['mb_id'], "srvy02"); 
	$stCnt = get_mileage_count($member['mb_id'], "srvy02"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>윤리/CP 인식도 조사</td>
                    <td>200</td>
                    <!-- <td>2</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>-</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>수행시 가산<br /><span style="font-size:16px;">(상•하반기 각 1회, 연간 총 2회)</span></td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "guide", 0); 
	$stMile = get_mileage($member['mb_id'], "guide"); 
	$stCnt = get_mileage_count($member['mb_id'], "guide"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>사내 준법 가이드라인</td>
                    <td>2</td>
                    <!-- <td>2</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>18</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>열람시 가산</td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "info", 0); 
	$stMile = get_mileage($member['mb_id'], "info"); 
	$stCnt = get_mileage_count($member['mb_id'], "info"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>법령정보</td>
                    <td>3</td>
                    <!-- <td>2</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>75</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>열람시 가산</td>
                </tr>
                <?php 
	$strVal = get_mileage_date($member['mb_id'], "cns", 0); 
	$stMile = get_mileage($member['mb_id'], "cns"); 
	$stCnt = get_mileage_count($member['mb_id'], "cns"); 
	$sum_point += $stMile;
?>
                <tr>
                    <td>준법상담</td>
                    <td>3</td>
                    <!-- <td>2</td> -->
                    <!-- <td><?php echo $stCnt ?></td> -->
                    <td>75</td>
                    <td><?php echo $strVal? substr($strVal, 0, 10) : "";?></td>
                    <td><?php if($stMile > 0 ) echo $stMile; ?></td>
                    <td>열람시 가산</td>
                </tr>
                <tr>
                    <td colspan="4"><span class="txt pr-0">총 점</span></td>
                    <td><span class="num"><?php echo $sum_point ?></span></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <p class="exmark-txt">마일리지 적용기간 : 2026년01월20일 ~ 2026년12월15일</p>

        <!-- page-end //-->



    </div>
</div>
<script>
$(document).ready(function() {
    $('#strMile').html("<?php echo $sum_point ?>");
});
</script>
<?php include_once ('../_Inc/subTail.php');?>