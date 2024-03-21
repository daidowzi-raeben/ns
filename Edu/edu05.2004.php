<?php
include_once ('../_Inc/subHead.php');

if(!$is_member) {
	alert(NS_LOGIN_MSG);
}

//print_r(!get_lessonApply($member['mb_id']));
if( !get_lessonApply($member['mb_id']) ) {
	$sql = "insert into {$g5['less_apply_table']} set
			app_lssn_no = '1', 
			app_uid = '{$member['mb_id']}', 
			app_rdate = now()";
	sql_query($sql);
}

if (!$sst) {
    $sst = "ls.lssn_rdate";
    $sod = "asc";
}

$sql_where = " where ap.app_uid = '{$member['mb_id']}' ";
$sql_order = " order by {$sst} {$sod} ";

$sql = "select ls.*, ap.* 
		from  {$g5['less_apply_table']} as ap 
		left join {$g5['lesson_table']} as ls on( ls.lssn_no = ap.app_lssn_no ) {$sql_where} {$sql_order}";
//echo $sql;
$result = sql_fetch($sql);
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
          <h2 class="tit">사이버교육
</h2>
          <ul class="path">
            <li><img src="../_Img/Sub/icon_home.png" width="13" height="16">
            <li>사이버 & 집체교육
</li>
            <li>사이버교육
</li>
          </ul>
        </div>
        <!-- page-start // -->
         <div class="course2">
          <p class="c_img2"><img src="../_Img/Sub/edu/cyber_img2.jpg" width="264"></p>
          <ul class="edu_gap20">
            <li><span class="title2">과정명</span>2019 하반기 CP 전사교육</li>
            <li><span class="title">수료조건</span>학습 100% 진행, 시험 60점 이상</li>
            <li>
				<span class="title">학습기간</span><?php echo str_replace("-", "." ,substr($result['lssn_sdate'],0,10))?> ~ <?php echo str_replace("-", ".", substr($result['lssn_edate'],0,10))?>
			</li>
            <li><span class="title">마일리지</span>30점</li>
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