<?php
$sub_menu = "600500";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} as m ";
//$sql_common .= " left join {$g5['less_apply_table']} as la ";
//$sql_common .= " on m.mb_id = la.app_uid ";

$sql_search = " where (1) and m.mb_level = '1' ";

if ($mb_4)
	$sql_search .= " and m.mb_4 like '{$mb_4}%' ";

if ($mb_id)
	$sql_search .= " and m.mb_id like '{$mb_id}%' ";

if ($mb_name)
	$sql_search .= " and m.mb_name like '{$mb_name}%' ";

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

//사이버 교육 과목 분류에 따른 설정
if (!$app_lssn_no) {
	$app_lssn_no = "19";
}

if($app_lssn_no == "1" || $app_lssn_no == "3")
	$strLesson = "NS윤리준법 시스템 사이버 교육";
else if($app_lssn_no == "2" || $app_lssn_no == "4")
	$strLesson = "대규모유통업법의 이해";
else if($app_lssn_no == "5")
	$strLesson = "한 눈에 보는 NS 준법교육";
else if($app_lssn_no == "6")
	$strLesson = "윤리경영 및 청탁금지법";
else if($app_lssn_no == "7")
	$strLesson = "전자상거래법 해설, 사례 소개";
else if($app_lssn_no == "10")
	$strLesson = "2021 내부 회계교육";
else if($app_lssn_no == "11")
	$strLesson = "2021 하반기 전사 CP교육(2)";
else if($app_lssn_no == "19")
	$strLesson = "윤리경영 얼마나 알고있니?";
else if($app_lssn_no == "13")
	$strLesson = "준법교육(상반기2)";
else if($app_lssn_no == "15")
	$strLesson = "지식재산권(하반기)";
else if($app_lssn_no == "16")
	$strLesson = "미디어팀교육";
else if($app_lssn_no == "17")
	$strLesson = "청탁금지법 교육(하반기)";
else if($app_lssn_no == "18")
	$strLesson = "윤리경영 사이버교육(하반기)";
$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$startNum = 1 + (($page-1) * 15);


$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '사이버교육 진도관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>

<!--<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총회원수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">차단 </span><span class="ov_num"><?php echo number_format($intercept_count) ?>명</span></a>
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">탈퇴  </span><span class="ov_num"><?php echo number_format($leave_count) ?>명</span></a>
</div>-->

<div class="tbl_frm02 tbl_wrap" style="text-align:center;">
    <!--<p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>-->
	<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
	<table>
    <caption><?php echo $g5['title']; ?> 검색</caption>
    <colgroup>
        <col class="grid_4">
        <col>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="mb_year">년도</label></th>
        <td>
            <?php echo get_blYear_select("bl_year") ?>
        </td>
        <th scope="row"><label for="">분류</label></th>
        <td>
			<select name="app_lssn_no" class="mb_form">
				<?=option_selected("11", $app_lssn_no, "준법교육(상반기1)");?>
				<?=option_selected("13", $app_lssn_no, "준법교육(상반기2)");?>
				<?=option_selected("2", $app_lssn_no, "유통법이해(상반기)");?>
				<?=option_selected("3", $app_lssn_no, "준법교육(하반기)");?>
				<?=option_selected("4", $app_lssn_no, "유통법이해(하반기)");?>
				<?=option_selected("5", $app_lssn_no, "NS준법교육(하반기)");?>
				<?=option_selected("6", $app_lssn_no, "윤리경영 및 청탁금지법(하반기)");?>
				<?=option_selected("7", $app_lssn_no, "전자상거래법(하반기)");?>
				<?=option_selected("14", $app_lssn_no, "내부회계관리제도");?>
				<?#=option_selected("15", $app_lssn_no, "지식재산권(하반기)");?>
				<?=option_selected("16", $app_lssn_no, "미디어팀교육");?>
				<?=option_selected("17", $app_lssn_no, "청탁금지법 교육(하반기)");?>
				<?=option_selected("19", $app_lssn_no, "윤리경영 사이버교육(하반기)");?>
			</select>
		</td>
    </tr>
	<tr>
        <th scope="row"><label for="">소속</label></th>
        <td>
			<?php echo get_blName_select("bl_name") ?>
		</td>
		<th scope="row"><label for="mb_4">부서3</label></th>
        <td>
            <input type="text" name="mb_4" id="mb_4" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20" value="<?php echo $mb_4; ?>" />
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="mb_id">사번</label></th>
        <td>
			<input type="text" name="mb_id" id="mb_id" value="<?php echo $mb_id ?>" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20" />
		</td>
		<th scope="row"><label for="mb_name">이름</label></th>
        <td>
            <input type="text" name="mb_name" id="mb_name" value="<?php echo $mb_name ?>" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20" />
        </td>
    </tr>
	</tbody>
	</table>
	<br/>
	<input type="submit" name="act_button" value="검색" class="btn btn_02">
	</form>
</div>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="local_ov02">
	<div class="l_div">
		
	</div>
	<div class="r_div">
		<?php if ($is_admin == 'super' || $is_admin == 'manager') { ?>
		<a href="./cyber_excel_down.php?lssn=<?php echo $app_lssn_no?>&amp;sfl=<?php echo $sfl ?>&amp;str=1" target="_blank" id="member_add" class="btn btn_04">EXCEL</a>
		<?php } ?>
	</div>
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_no">No</th>
		<th scope="col" id="mb_list_id">과정명</th>
		<th scope="col" id="mb_list_id">이름</th>
		<th scope="col" id="mb_list_id">아이디</th>
		<th scope="col" id="mb_list_id">부서명</th>
		<th scope="col" id="mb_list_name">학습 시작일</th>
		<th scope="col" id="mb_list_id">학습 종료일</th>
		<th scope="col" id="mb_list_id">학습 진도율</th>
		<th scope="col" id="mb_list_id">시험점수</th>
		<th scope="col" id="mb_list_id">수료여부</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $mb_id = $row['mb_id'];
		$mb_name = $row['mb_name'];
		
		if($app_lssn_no == "1")
		{
			//준법교육 시험 점수 가져오기
			$sql = " select * from {$g5['quiz_answer_table']} where qa_uid = '{$mb_id}' and qa_quiz_code = 1 and qa_end = 'Y' and qa_success = 'Y' order by qa_no desc limit 0, 1 ";
			$row2 = sql_fetch($sql);
			$testScore = $row2['qa_pointTotal'];
		}
		else if($app_lssn_no == "19")
		{
			//2022_공정거래법 시험 점수 가져오기
			$sql = " select * from {$g5['quiz_answer_table']} where qa_uid = '{$mb_id}' and qa_quiz_code = 3 and qa_end = 'Y' and qa_success = 'Y' order by qa_no desc limit 0, 1 ";
			$row2 = sql_fetch($sql);
			$testScore = $row2['qa_pointTotal'];
		}
		else if($app_lssn_no == "13")
		{
			//2022_대규모유통업법 시험 점수 가져오기
			$sql = " select * from {$g5['quiz_answer_table']} where qa_uid = '{$mb_id}' and qa_quiz_code = 4 and qa_end = 'Y' order by qa_no desc limit 0, 1 ";
			$row2 = sql_fetch($sql);
			$testScore = $row2['qa_pointTotal'];
		}
		
		//학습 진도 가져오기
		$sql = " select * from {$g5['less_apply_table']} where app_uid = '{$mb_id}' and app_lssn_no = '{$app_lssn_no}' and DATE_FORMAT(app_rdate,'%y') = DATE_FORMAT(NOW(),'%y') limit 0, 1 ";
		$row2 = sql_fetch($sql);
		
		if($app_lssn_no == "2")
			$testScore = $row2['app_score'];
		
		if($row2['app_study_rate'])
			$aRate = $row2['app_study_rate'] . " %";
		else
			$aRate = "";
		
		if($app_lssn_no == "12" || $app_lssn_no == "13")
		{
			if($row2['app_evaluation'] == "Y" && $testScore >= 60)
				$strEval = "수료";
			else
				$strEval = "미수료";
		}
		else
		{
			if($row2['app_study_rate'] == 100)
				$strEval = "수료";
			else
				$strEval = "미수료";
		}
		
    ?>

    <tr class="<?php echo $bg; ?>">
		<td headers="cb_list"><?php echo $startNum ?></td>
		<td headers="cb_list"><?php echo $strLesson ?></td>
		<td headers="cb_list_name" class="td_name2">
            <?php echo $mb_name ?>
        </td>  
		<td headers="cb_list_"><?php echo $mb_id ?></td>
		<td headers="cb_list_"><?php echo get_text($row['mb_4']); ?></td>
		<td headers="cb_list_"><?php echo $row2['app_rdate'] ?></td>
		<td headers="cb_list_"><?php echo $row2['app_edate'] ?></td>
		<td headers="cb_list_"><?php echo $aRate ?></td>
		<td headers="cb_list_"><?php echo $testScore ?></td>
		<td headers="cb_list_"><?php echo $strEval ?></td>
    </tr>
    <?php
		$startNum++;
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;app_lssn_no='.$app_lssn_no.'&amp;page='); ?>

<script>
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

// 회원 엑셀 다운로드 추가
function excel_down(f){ 

	f.action = "./learnexcel_down.php?str=1";

	f.submit();

	f.action = "";

}
</script>

<?php
include_once ('./admin.tail.php');
?>
