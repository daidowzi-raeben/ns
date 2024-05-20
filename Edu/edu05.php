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


if( !get_lessonApply2($member['mb_id'], 19) ) {
	$sql = "insert into {$g5['less_apply_table']} set
			app_lssn_no = '19',
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

$sql_m = "SELECT *  FROM sj_lesson_apply where app_uid = '{$member['mb_id']}' and app_lssn_no = '19' limit 0, 1 ";
$result_m = sql_fetch($sql_m);


if (!$sst) {
    $sst = "ls.lssn_no";
    $sod = "asc";
}

$page = 1;
if(!isset($_GET['page'])) {
	$page = 1;
} else {
	$page = $_GET['page'];
}

$rows = $page - 1;
$limit = 1;

$sql_where = " where lssn_kind = 'LS00' ";
$sql_order = " order by {$sst} {$sod} ";

$sql = "select * from  {$g5['lesson_table']} as ls {$sql_where} {$sql_order} limit {$rows}, {$limit}";
// echo $sql;
$result = sql_query($sql);
?>

    <div id="svisual-wrap">
		<div class="vistxt">
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

			<div class="course2-pagenation" >
				<!-- <button type="button" class="btn done">1</button> -->
				<!-- <button type="button" class="btn active">2</button> -->
						<?php for($j=1; $j<=12; $j++) {
				$p = $j-1;
				$is = '';
				$sql_cnt = "select ls.lssn_no from sj_lms_lesson as ls
				LEFT JOIN cd_lms_lesson_result AS b ON ls.lssn_no = b.lssn_no
				 where lssn_kind = 'LS00' 
				 AND b.mb_id = '".$member['mb_id']."'
				 order by ls.lssn_no ASC LIMIT ".$p." ,1  ";
				//  echo $sql_cnt;
				$result_cnt = sql_fetch($sql_cnt);
				if(isset($result_cnt['lssn_no'])) {
					$is = 'done';
				}
#				$is = '';
#				echo $result_cnt['idx'];
				
				
				
				
				?>
					<button type="button" style="" onclick="location.href='?page=<?php echo $j?>';" class="btn <?php if($j == $page) echo 'active' ?> <?php if($j != $page) {echo $is; } else {echo $is; } ?>"><?php echo $j?></button>
				<?php } ?>
			</div>

<div  >
       			<?php 
			for ($i=0; $row=sql_fetch_array($result); $i++) {
			?>



			<div class="course2 flex" style="margin-top:50px; display:flex;">
					<div class="chasi"><?php echo ($rows * $limit ) + $i + 1 ?>회차</div>
					<p class="c_img2"><img src="/_Img/lssn_img/<?php echo $row['lssn_rimg']?>" width="264"></p>
					<ul class="edu_gap10">
				    <li><span class="title">주&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;제</span><?php echo $row['lssn_title']?></li>
					<li><span class="title">학습시간</span><?php echo $row['lssn_time']?></li>
                    <li><span class="title">학습기간</span><?php echo $row['lssn_sdate']?> ~ <?php echo $row['lssn_edate']?></li>
                    <li><span class="title">마일리지</span><?php echo $row['lssn_point']?>점</li>
				</ul>
			</div>
			<p class="btn">
			<?php
				$tempSday = $row['lssn_sdate'];
				$tempEday = $row['lssn_edate'];
				if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
				{
			?>
				<a href="#n" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
				} else {
			?>
				<a href="#" class="class-enter"><span class="enterClass3" lno="<?php echo $row['lssn_no']?>">학습하기</span></a>
			<?php
				}
			?>
				<!--<a href="#n" class="class-end"><span>학습완료</span></a>-->
			</p>
			<div class="sgap"></div>			
			<?php 
			}
			?>
</div>


        <!-- page-end //-->

		<div class="course2" style="margin-top:15px">
					<p class="c_img2" style="margin-top:7px"><img src="/static/image/thum_01.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2024 상반기 전사 CP교육(1)] 대규모유통업법 실무 가이드라인</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2024.05.20(월) ~ 2024.05.24(금)</li>
							<li><span class="title">마일리지</span>없음</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2024-05-20 09:00";
					$tempEday = "2024-05-24 18:00";
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


		 <!-- [2023 하반기 CP전사교육] 지식재산권의 이해와 사례  { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:7px"><img src="../_Img/Sub/edu/cyber_img26.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2023 하반기 CP전사교육] 지식재산권의 이해와 사례</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2023.11.22(수) ~ 2023.11.30(금)</li>
							<li><span class="title">마일리지</span>30</li>
							<li><span class="title">학습시간</span>1시간 30분</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2023-11-20 09:00";
					$tempEday = "2023-11-29 18:00";
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



          <!-- [2023 전사 윤리경영 사이버 교육] { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:7px"><img src="../_Img/Sub/edu/cyber_img25.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2023 윤리경영 사이버 교육] 윤리경영 얼마나 알고있니?</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2023.10.16(월) ~ 2023.11.10(금)</li>
							<li><span class="title">마일리지</span>없음</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2023-10-16 09:00";
					$tempEday = "2023-11-10 18:00";
					if(!($tempSday <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($tempEday."+1 day")))
					{
			?>
					<a href="#//" class="day-end"><span>학습기간이 아닙니다. </span></a>
			<?php
					}
					else
					{
			?>
							
							    
					<a href="/Edu/class19.php?ls=19" class="class-enter" style="<?php if (	$result_m['app_study_rate'] == 100) { echo "background: #5a5ae7;"; }?>"><span>
					<?php if (	$result_m['app_study_rate'] == 100) {
						echo '학습완료';
					} else  {
						echo '학습하기';
					}
					?>
					</span></a>
			<?php
					}
			?>

			</p>


          <!-- [2023 상반기 CP특별교육] 전자상거래 가이드  { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:7px"><img src="../_Img/Sub/edu/cyber_img24.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2023 상반기 CP특별교육] 전자상거래 가이드</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행</li>
							<li><span class="title">학습기간</span>2023.06.19(월) ~ 2023.06.30(금)</li>
							<li><span class="title">마일리지</span>없음</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2023-06-19 09:00";
					$tempEday = "2023-06-30 18:00";
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


			<!-- [2023 상반기 전사 CP교육] 유통업분야 공정거래교육  { -->
			<div class="course2" style="margin-top:75px">
					<p class="c_img2" style="margin-top:7px"><img src="../_Img/Sub/edu/cyber_img23.png" width="264"></p>
					<ul class="edu_gap10">
							<li><span class="title2">과정명</span><span class="sub">[2023 상반기 전사 CP교육] 유통업분야 공정거래교육</span></li>
							<li><span class="title">수료조건</span>학습 100% 진행, 최종평가 60점 이상</li>
							<li><span class="title">학습기간</span>2023.04.17(월) ~ 2023.04.28(금)</li>
							<li><span class="title">마일리지</span>30</li>
							<li><span class="title">학습시간</span>2시간</li>
					</ul>
			</div>
			<p class="btn">
			<?php
					$tempSday = "2023-04-17 08:00";
					$tempEday = "2023-04-28 18:00";
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



        <!-- page-end //-->
		</div>
    </div>

	<script src="/_Js/jquery.bpopup.min.js"></script>
		<script src="/_Js/lms.js"></script>
		<style>
			.popup_container{position:absolute;left: 0;top: 0;width: 100%;height: 100%;z-index: 500;background:#fff;}
			.new__pop-close{position:absolute;right: 1em;top: 1em;z-index: 600;background:url('/_Img/Sub/close-x.png') no-repeat center;width: 45px;height: 45px;border: none;}
		</style>
		

    <?php include_once ('../_Inc/subTail.php');?>

	<!--s: layer-movie(학습 영상) -->
		<div id="popup_win" class="layer-wrap movie" style="left:50%; top:50%;">
			<div class="is-top" style="padding: 0;">
				<h2>학습평가</h2>
				<a href="#n" class="close b-close"><span class="blind">닫기기</span></a>
			</div>
			<div class="is-con">
				<div class="movie">
					<div class="popup_container movie" id="popup_container">
				
					</div>
				</div>
			</div>
		</div>
