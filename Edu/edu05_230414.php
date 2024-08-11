<?php
include_once ('../_Inc/subHead.php');

if(!$is_member) {
	alert(NS_LOGIN_MSG);
}

//print_r(!get_lessonApply($member['mb_id']));

//2022 상반기 전사 CP교육(1)] 공정거래법에 대한 이해 / 첫 학습자 로그 insert
if( !get_lessonApply2($member['mb_id'], 12) ) {
	$sql = "insert into {$g5['less_apply_table']} set
			app_lssn_no = '12',
			app_uid = '{$member['mb_id']}',
			app_rdate = now()";
	sql_query($sql);
}

//2022 상반기 전사 CP교육(1)] 대규모유통업법에 대한 이해 / 첫 학습자 로그 insert
if( !get_lessonApply2($member['mb_id'], 13) ) {
	$sql = "insert into {$g5['less_apply_table']} set
			app_lssn_no = '13',
			app_uid = '{$member['mb_id']}',
			app_rdate = now()";
	sql_query($sql);
}

//2022년 내부회계교육 첫 학습자 로그 insert
if( !get_lessonApply2($member['mb_id'], 14) ) {
	$sql = "insert into {$g5['less_apply_table']} set
			app_lssn_no = '14',
			app_uid = '{$member['mb_id']}',
			app_rdate = now()";
	sql_query($sql);
}

//2022년 사례로 보는 지식재산권 첫 학습자 로그 insert
if( !get_lessonApply2($member['mb_id'], 15) ) {
	$sql = "insert into {$g5['less_apply_table']} set
			app_lssn_no = '15',
			app_uid = '{$member['mb_id']}',
			app_rdate = now()";
	sql_query($sql);
}

//2022 - 나외 조직을 지키는 윤리경영 가이드라인 >> 첫 학습자 로그 insert
if( !get_lessonApply2($member['mb_id'], 16) ) {
	$sql = "insert into {$g5['less_apply_table']} set
			app_lssn_no = '16',
			app_uid = '{$member['mb_id']}',
			app_rdate = now()";
	sql_query($sql);
}

//2022 - 청탁금지법 교육 >> 첫 학습자 로그 insert
if( !get_lessonApply2($member['mb_id'], 17) ) {
	$sql = "insert into {$g5['less_apply_table']} set
			app_lssn_no = '17',
			app_uid = '{$member['mb_id']}',
			app_rdate = now()";
	sql_query($sql);
}

//2022 - 윤리경영 교육 >> 첫 학습자 로그 insert
if( !get_lessonApply2($member['mb_id'], 18) ) {
	$sql = "insert into {$g5['less_apply_table']} set
			app_lssn_no = '18',
			app_uid = '{$member['mb_id']}',
			app_rdate = now()";
	sql_query($sql);
}

if (!$sst) {
    $sst = "ls.lssn_rdate";
    $sod = "asc";
}

$sql_where = " where ap.app_uid = '{$member['mb_id']}' and ls.lssn_no = 1 ";
$sql_order = " order by {$sst} {$sod} ";

$sql = "select ls.*, ap.*
		from  {$g5['less_apply_table']} as ap
		left join {$g5['lesson_table']} as ls on( ls.lssn_no = ap.app_lssn_no ) {$sql_where} {$sql_order}";
#echo $sql;
$result = sql_fetch($sql);
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
				<?php
				$eduOver5 = ' over';
				include_once 'edu_left.php';
				?>
			</div>
        <?php include_once ('../_Inc/helpInc.php');?>
		</div>
		<div id="contents">
			<div class="cont-top">
				<h2 class="tit">사이버교육</h2>
				<ul class="path">
					<li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
					<li>사이버 & 집체교육</li>
					<li>사이버교육</li>
				</ul>
			</div>


           <!-- page-start // -->
			<!-- [2022 하반기 윤리경영 사이버 교육]윤리경영 사이버 교육 및 갑질 개선교육{ -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:7px"> <img src="../_Img/Sub/edu/cyber_img22.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">윤리경영 사이버 교육 및 갑질 개선교육
							</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2022.12.13(화) ~ 2022.12.27(화)</li>
							<li><span class="title">마일리지</span>없음</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2022-12-13 08:00";
					$tempEday = "2022-12-27 18:00";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="./class00.php?ls=18" class="class-enter"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>


            <!-- page-start // -->
			<!-- [2022 하반기 전사 CP교육] 손수호 변호사의 청탁금지법{ -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:7px"> <img src="../_Img/Sub/edu/cyber_img21.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2022 하반기 전사 CP교육] 손수호 변호사의 청탁금지법
							</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2022.11.14(월) ~ 2022.11.23(수)</li>
							<li><span class="title">마일리지</span>30점</li>
							<li><span class="title">학습시간</span>1시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2022-11-14 08:00";
					$tempEday = "2022-11-23 18:00";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="./class00.php?ls=17" class="class-enter"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>



           <!-- page-start // -->
			<!-- [2022 하반기 전사 CP교육(2)] 꼭 알아야하는 지식재산권 핵심포인트  { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:7px"><img src="../_Img/Sub/edu/cyber_img4.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2022 하반기 CP특별교육] 지식재산권 핵심포인트</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2022.09.19 ~ 2022.09.23</li>
							<li><span class="title">마일리지</span>미반영</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2022-09-19";
					$tempEday = "2022-09-23";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="https://edu.kfcf.or.kr/Open/KFCFLOGINAUTH?userid=ns<?=$member['mb_id']?>" class="class-enter" target="_blank"><span>학습하기</span></a>
			<?php
					}
			?>

			</p>


           <!-- page-start // -->
			<!-- [윤리적 조직문화를 위한 존중 확산 워크샵{ -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:7px"><img src="../_Img/Sub/edu/cyber_img19.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">윤리적 조직문화를 위한 존중 확산 워크샵</span></li>
							<li><span class="title">수료조건</span>참석수업 100% 완료</li>
							<li><span class="title">학습기간</span>2022.08.22 ~ 2021.09.30(월,수,금)</li>
							<li><span class="title">마일리지</span>30점</li>
							<li><span class="title">학습시간</span>3시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2022-08-22 07:00";
					$tempEday = "2022-09-30 18:00";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>참석기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="https://us02web.zoom.us/j/5057006234?pwd=SUYzV3NQYVMzVlJDR1EvNno1ais3UT09" class="class-enter"><span>참석하기</span></a>
			<?php
					}
			?>
			</p>


            <!-- page-start // -->
			<!-- [2022 하반기 전사 CP교육(2)]나외 조직을 지키는 윤리경영 가이드라인{ -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:7px"> <img src="../_Img/Sub/edu/cyber_img20.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub"> 나외 조직을 지키는 윤리경영 가이드라인
							</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2022.09.20(화) ~ 2022.09.30(금)</li>
							<li><span class="title">마일리지</span>없음</li>
							<li><span class="title">학습시간</span>3시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2022-09-19 00:00";
					$tempEday = "2022-09-30 18:00";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="./class00.php?ls=16" class="class-enter"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>


          
            <!-- page-start // -->
			<!-- [2022 전사 내부회계 교육] 내부회계관리제도 K-SOX 이해하기  { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:16px"> <img src="../_Img/Sub/edu/cyber_img18.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2022 전사 내부회계 교육] 내부회계관리제도 K-SOX 이해하기
							</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2022.07.18(월) ~ 2022.07.22(금)</li>
							<li><span class="title">마일리지</span>없음</li>
							<li><span class="title">학습시간</span>1시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2022-07-25 07:00"; 
					$tempEday = "2022-07-29 18:00";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="./class14.php#" class="class-enter"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>


            <!-- page-start // -->
			<!-- [2022 상반기 전사 CP교육(2)] 대규모유통업법에 대한 이해  { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:16px"> <img src="../_Img/Sub/edu/cyber_img17.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2022 상반기 전사 CP교육(2)] 대규모유통업법에 대한 이해
							</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행, 시험 60점 이상</li>
							<li><span class="title">학습기간</span>2022.06.02(목) ~ 2022.06.10(금)</li>
							<li><span class="title">마일리지</span>30</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2022-05-31 07:00";
					$tempEday = "2022-06-10 17:00";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="./class13.php#" class="class-enter"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>


            <!-- page-start // -->
			<!-- [2022 상반기 전사 CP교육(1)] 공정거래법에 대한 이해  { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:16px"> <img src="../_Img/Sub/edu/cyber_img16.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2022 상반기 전사 CP교육(1)] 공정거래법에 대한 이해
							</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행, 시험 60점 이상</li>
							<li><span class="title">학습기간</span>2022.04.25(월) ~ 2022.04.29(금)</li>
							<li><span class="title">마일리지</span>30</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2022-04-02 07:00";
					$tempEday = "2022-05-06 17:00";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="./class08.php#" class="class-enter"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>


            <!-- page-start // -->
			<!-- [2021 하반기 전사 CP교육(2)] 사례로 보는 지식재산권  { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:4px"> <img src="../_Img/Sub/edu/cyber_img15.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2021 하반기 전사 CP교육(2)] 사례로 보는 지식재산권
							</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2021.11.01(월) ~ 2021.11.05(금)</li>
							<li><span class="title">마일리지</span>없음</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2021-11-01 00:00";
					$tempEday = "2021-11-05 18:00";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="./class07.php#" class="class-enter"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>


            <!-- page-start // -->
			<!-- [2021 하반기 전사 CP교육] 유통업분야 공정거래교육  { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:16px"> <img src="../_Img/Sub/edu/cyber_img14.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2021 하반기 전사 CP교육] 유통업분야 공정거래교육
							</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2021.08.23(월) ~ 2021.08.27(금)</li>
							<li><span class="title">마일리지</span>없음</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2021-08-23 09:00";
					$tempEday = "2021-08-27";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="https://edu.kfcf.or.kr/Open/KFCFLOGINAUTH?userid=<?=$member['mb_id']?>" class="class-enter" target="_blank"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>


            <!-- page-start // -->
			<!-- [윤리적 조직문화를 위한 신뢰 강화 워크샵{ -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:7px"><img src="../_Img/Sub/edu/cyber_img13.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">윤리적 조직문화를 위한 신뢰 강화 워크샵</span></li>
							<li><span class="title">수료조건</span>참석수업 100% 완료</li>
							<li><span class="title">학습기간</span>2021.07.13 ~ 2021.08.11(화,수,목)</li>
							<li><span class="title">마일리지</span>30점</li>
							<li><span class="title">학습시간</span>3시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2021-07-13 00:00";
					$tempEday = "2021-08-11 18:00";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>참석기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="https://us02web.zoom.us/j/5057006234?pwd=N1U2c0J6OVk0bmlSakxiL3Q4WDZuZz09" class="class-enter"><span>참석하기</span></a>
			<?php
					}
			?>
			</p>

            <!-- page-start // -->
			<!-- [2021 전사 내부회계 교육] 내부회계관리제도 K-SOX 이해하기  { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:16px"> <img src="../_Img/Sub/edu/cyber_img12.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2021 전사 내부회계 교육] 내부회계관리제도 K-SOX 이해하기
							</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2021.07.05(월) ~ 2021.07.13(화)</li>
							<li><span class="title">마일리지</span>없음</li>
							<li><span class="title">학습시간</span>1시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2021-07-05 09:00";
					$tempEday = "2021-07-30 18:00";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="./class06.php#" class="class-enter"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>

            <!-- page-start // -->
			<!-- [2021 상반기 CP특별교육]소비자 관련 법률 (표시·광고제도 및 전자상거래법)  { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:16px"> <img src="../_Img/Sub/edu/cyber_img11.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2021 상반기 CP특별교육] 표시·광고제도 및 전자상거래법
							</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2021.05.24(월) ~ 2021.05.30(일)</li>
							<li><span class="title">마일리지</span>없음</li>
							<li><span class="title">학습시간</span>1시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2021-05-24 09:00";
					$tempEday = "2021-05-30";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="https://edu.kfcf.or.kr/Open/KFCFLOGINAUTH?userid=ns<?=$member['mb_id']?>" class="class-enter" target="_blank"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>

			<!-- page-start // -->
			<!-- [윤리성품에 기반한 윤리경영 화상 특강 { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:7px"><img src="../_Img/Sub/edu/cyber_img10_1.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">윤리성품에 기반한 윤리경영 화상특강</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2021.04.27 ~ 2021.05.12</li>
							<li><span class="title">마일리지</span>30점</li>
							<li><span class="title">학습시간</span>1시간30분</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2021-04-27 09:00";
					$tempEday = "2021-07-30";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="./class05.php#" class="class-enter"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>

			<!-- page-start // -->
			<!-- [2021 상반기 전사 CP교육]투명한 사회로 가는 길, 청탁금지법 { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:16px"> <img src="../_Img/Sub/edu/cyber_img9.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2021 상반기 전사 CP교육]투명한 사회로 가는 길, 청탁금지법</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행, 시험 60점 이상</li>
							<li><span class="title">학습기간</span>2021.04.12 ~ 2021.04.18</li>
							<li><span class="title">마일리지</span>30점</li>
							<li><span class="title">학습시간</span>1시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2021-04-11 19:00";
					$tempEday = "2021-04-18";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="https://edu.kfcf.or.kr/Open/KFCFLOGINAUTH?userid=ns<?=$member['mb_id']?>" class="class-enter" target="_blank"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>

			<!-- page-start // -->
			<!-- [2020 하반기 전사CP교육(2차)] 전자상거래법 해설, 사례 소개 { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2"><img src="../_Img/Sub/edu/cyber_img8.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2020 하반기 CP특별교육] 표시/광고제도의 이해</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2020.12.16 ~ 2020.12.23</li>
							<li><span class="title">마일리지</span>미반영</li>
							<li><span class="title">학습시간</span>1시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2020-12-13";
					$tempEday = "2020-12-23";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="https://edu.kfcf.or.kr/Open/KFCFLOGINAUTH?userid=NS<?=$member['mb_id']?>" class="class-enter" target="_blank"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>
			<!-- } End [2020 하반기 전사CP교육(2차)] 전자상거래법 해설, 사례 소개  -->
			<!-- [2020 하반기 전사CP교육(2차)] 전자상거래법 해설, 사례 소개 { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2"><img src="../_Img/Sub/edu/cyber_img7.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2020 하반기 전사CP교육(2차)] 전자상거래법 해설, 사례 소개</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2020.11.16 ~ 2020.11.27</li>
							<li><span class="title">마일리지</span>30점</li>
							<li><span class="title">학습시간</span>4.5시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2020-11-09";
					$tempEday = "2020-11-27";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="https://edu.kfcf.or.kr/Open/KFCFLOGINAUTH?userid=NS<?=$member['mb_id']?>" class="class-enter" target="_blank"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>
			<!-- } End [2020 하반기 전사CP교육(2차)] 전자상거래법 해설, 사례 소개  -->
			<!-- 2020년 윤리경영 및 청탁금지법 교육 { -->
			<?php
				$tempSday = "2020-11-05";
				$tempEday = "2021-12-30";
			?>
			<div class="course2" style="margin-top:75px">
					<p class="c_img2"><img src="../_Img/Sub/edu/cyber_img6.PNG" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">아름다운 동행을 위한 윤리경영과 청탁금지법 이해와 실천</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2020.11.09 ~ 2020.11.20</li>
							<li><span class="title">마일리지</span>30점</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="./class04.php" class="class-enter"><span>학습하기</span></a>
			<?php
					}
			?>
			</p>
			<!-- } End 2020년 윤리경영 및 청탁금지법 교육  -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2"><img src="../_Img/Sub/edu/cyber_img5.gif" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">한 눈에 보는 NS준법교육(1,2차시)</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2020.08.31 ~ 2020.09.11</li>
							<li><span class="title">마일리지</span>30점</li>
							<li><span class="title">학습시간</span>1시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2020-08-24";
					$tempEday = "2020-09-24";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="./class03.php#" class="class-enter"><span>학습하기</span></a>
			<?php
					}
			?>

			</p>

			<div class="course2" style="margin-top:75px">
					<p class="c_img2"><img src="../_Img/Sub/edu/cyber_img4.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2020 상반기 CP특별교육] 꼭 알아야하는 지식재산권 핵심포인트</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행, 시험 60점 이상</li>
							<li><span class="title">학습기간</span>2020.06.17 ~ 2020.07.03</li>
							<li><span class="title">마일리지</span>미반영</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2020-06-16";
					$tempEday = "2020-07-30";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="https://edu.kfcf.or.kr/Open/KFCFLOGINAUTH?userid=ns<?=$member['mb_id']?>" class="class-enter" target="_blank"><span>학습하기</span></a>
			<?php
					}
			?>

			</p>


			<div class="course2" style="margin-top:75px">
				<p class="c_img2"><img src="../_Img/Sub/edu/cyber_img3.jpg" width="264"></p>
				<ul class="edu_gap10">
					<li><span class="title2">과정명</span>[2020 상반기 전사 CP교육] 대규모유통업법의 이해</li>
					<li><span class="title">수료조건</span>학습 100% 진행, 시험 60점 이상</li>
					<li><span class="title">학습기간</span>2020.04.20 ~ 2020.05.10</li>
					<li><span class="title">마일리지</span>30점</li>
					<li><span class="title">학습시간</span>3시간</li>
				</ul>
			</div>
			<p class="btn">
			<?php
				$tempSday = "2020-04-20";
				$tempEday = "2020-05-30";
				if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
				{
			?>
				<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
				}
				else
				{
			?>
				<a href="https://edu.kfcf.or.kr/Open/KFCFLOGINAUTH?userid=<?=$member['mb_id']?>" class="class-enter" target="_blank"><span>학습하기</span></a>
			<?php
				}
			?>
				<!--<a href="#//" class="class-end"><span>학습완료</span></a>-->

			</p>
			<div class="course2" style="margin-top:75px" >
					<p class="c_img2"><img src="../_Img/Sub/edu/cyber_img2.jpg" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span>2019 하반기 CP 전사교육</li>
							<li><span class="title">수료조건</span>학습 100% 진행, 시험 60점 이상</li>
							<li>
									<span class="title">학습기간</span><?php echo str_replace("-", "." ,substr($result['lssn_sdate'],0,10))?> ~ <?php echo str_replace("-", ".", substr($result['lssn_edate'],0,10))?>
							</li>
							<li><span class="title">마일리지</span>30점</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = str_replace("-", "" ,substr($result['lssn_sdate'],0,10));
					if(!($result['lssn_sdate'] <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($result['lssn_edate']."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
					<a href="./class02.php#" class="class-enter"><span>학습하기</span></a>
			<?php
					}
			?>
					<!--<a href="#//" class="class-end"><span>학습완료</span></a>-->

			</p>

        <!-- page-end //-->
		</div>
    </div>
    <?php include_once ('../_Inc/subTail.php');?>
