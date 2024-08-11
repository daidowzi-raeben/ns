<?php
include_once ('../_Inc/subHead.php');

if(!$is_member) {
    alert(NS_LOGIN_MSG);
}

if(!$ls) {
    alert("잘못된 과정입니다");
}

if (!$sst) {
    $sst = "ls.lssn_rdate";
    $sod = "asc";
}

$lssn_no = $ls;

$sql_where = " where ap.app_uid = '{$member['mb_id']}' and ap.app_lssn_no = '{$lssn_no}' ";
$sql_order = " order by {$sst} {$sod} ";

$sql = "select ls.*, ap.* 
			from  {$g5['less_apply_table']} as ap 
			left join {$g5['lesson_table']} as ls on( ls.lssn_no = ap.app_lssn_no ) {$sql_where} {$sql_order}";
#echo $sql;
$result = sql_fetch($sql);

?>
<script src="/js/jquery.bpopup.min.js"></script>
<script src="/js/lms.js"></script>
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
			<?php
			$userLessonData = get_lessonApply2($member['mb_id'], $lssn_no);
			?>
			<h3 class="u-tit01">나의 학습 진도율</h3>
			<div class="progress-wrap">
				<div class="progress-info">
					<p class="fl"><span>진도율</span> <?php echo get_int2num($userLessonData['app_study_rate'])?> %</p>
					<p class="fr"><span>학습평가</span> 없음 </p>
				</div>
			</div>

                <div class="gap"></div>
                <h3 class="u-tit01">강의목차</h3>
                <table class="tbl-type01">
                    <colgroup>
                        <col width="7%">
                        <col width="*">
                        <col width="14%">
                        <col width="14%">
                        <!--<col width="14%">-->
                        <col width="14%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>차시</th>
                        <th>과정제목</th>
                        <th>학습시작</th>
                        <th>학습종료</th>
                        <!--<th>진도율</th>-->
                        <th>학습</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php
					$sql = "select * from {$g5['chapter_table']} where cpt_lesson='{$lssn_no}' order by cpt_seq asc";
					$cpt_data = sql_query($sql);
					
					for ($i=1; $row=sql_fetch_array($cpt_data); $i++) {
						$sql = "select * from {$g5['chapter_att_table']} where 
									att_uid = '{$member['mb_id']}' and 
									att_lssn_no = '{$lssn_no}' and 
									att_chapter_no = '{$row['cpt_no']}' and 
									att_contents = '{$row['cpt_contents']}'";
						$att_info = sql_fetch($sql);
						
						if( $att_info ) {
							$att_rate = $att_info['att_study_rate'];
							$att_rate_text = $att_rate."%";
						} else {
							$att_info = "";
							$att_rate ="";
							$att_rate_text = "미진행";
						}
						
						$cpt_study_rate[$i] = $att_info['att_study_rate'];
					?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td style="text-align:left;"><?php echo get_chapterName($row['cpt_contents'])?>  </td>
                        <td><?=substr($result['lssn_sdate'],0,10)?></td>
                        <td><?=substr($result['lssn_edate'],0,10)?></td>
                        <!--<td><?php echo $att_rate_text?></td>-->
                        <td>
						<?php
						if( $cpt_study_rate[$i] >= 100 || $userLessonData['app_study_rate'] == 100 ) { 
						?>
							<a href="#" onclick="$('.new__pop').show();" class="cg-btn"><span class="enterClass2" lno="<?php echo $lssn_no ?>" cno="<?php echo $row['cpt_no']?>">학습완료</span></a>
						<?php
						} elseif( $cpt_study_rate[$i-1] >= 100 || $i == 1 ) {
						?>
							<a href="#" class="cg-btn active"><span class="enterClass2" lno="<?php echo $lssn_no ?>" cno="<?php echo $row['cpt_no']?>">학습하기</span></a>
						<?php
						} ?>
                        </td>
                    </tr>
					<?php
					}
					?>
                    

                    </tbody>
                </table>
                <div class="sssgap"></div>
                <div class="btn-wrap r">
                    <!--응시 없음-->
                </div>
            </div>



            <!-- page-end //-->
        </div>

<style>
    .new__pop{position:fixed;left: 0;top: 0;width: 100%;height: 100%;z-index: 9999;display: none;}
    .new__pop-close{position:absolute;right: 1em;top: 1em;z-index: 600;background:url('/_Img/Sub/close-x.png') no-repeat center;width: 45px;height: 45px;border: none;}
    .popup_container2{position:absolute;left: 0;top: 0;width: 100%;height: 100%;z-index: 500;background:#fff;}
</style>
<!-- 팝업 -->
<div id="popup_win" class="layer-wrap movie">
	<div class="is-top" style="padding: 0;">
		<h2>학습평가</h2>
		<a href="#n" class="new__pop-close b-close"></a>
	</div>
	<div class="is-con">
		<div class="popup_container movie" id="popup_container">
		
		</div>
	</div>
</div>

<?php include_once ('../_Inc/subTail.php');?>



