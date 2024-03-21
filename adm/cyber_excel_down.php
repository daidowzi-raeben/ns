<?php
$sub_menu = "600300";
include_once("./_common.php");

if ( ! function_exists('utf2euc')) {
    function utf2euc($str) {
        return iconv("UTF-8","cp949//IGNORE", $str);
    }
}
if ( ! function_exists('is_ie')) {
    function is_ie() {
        return isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false);
    }
}

auth_check($auth[$sub_menu], "r");

$sql_common = " from {$g5['member_table']} as m ";
#$sql_common .= " left join {$g5['less_apply_table']} as la ";
#$sql_common .= " on m.mb_id = la.app_uid ";

$sql_search = " where (1) and m.mb_level = '1' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//if (!$total_count) alert_just('데이터가 없습니다.');

//$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//$result = sql_query($sql);

$qry = sql_query("select * {$sql_common} {$sql_search} {$sql_order}");

/*================================================================================
php_writeexcel http://www.bettina-attack.de/jonny/view.php/projects/php_writeexcel/
=================================================================================*/

include_once(G5_LIB_PATH.'/Excel/php_writeexcel/class.writeexcel_workbook.inc.php');
include_once(G5_LIB_PATH.'/Excel/php_writeexcel/class.writeexcel_worksheet.inc.php');

$fname = tempnam(G5_DATA_PATH, "tmp.xls");
$workbook = new writeexcel_workbook($fname);
$worksheet = $workbook->addworksheet();

$num2_format =& $workbook->addformat(array(num_format => '\0#'));

$app_lssn_no = $lssn;
//사이버 교육 과목 분류에 따른 설정
if (!$app_lssn_no) {
	$app_lssn_no = "3";
}

// Put Excel data
$data = array(
"과정명",
"mb_name"=>"이름",
"mb_id"=>"아이디",
"mb_4"=>"부서명",
"app_rdate"=>"학습 시작일",
"app_edate"=>"학습 종료일",
"학습 진도율",
"시험점수",
"수료여부",
);

$data = array_map('iconv_euckr', $data);

$col = 0;
foreach($data as $cell) {
    $worksheet->write(0, $col++, $cell);
}

for($i=1; $res=sql_fetch_array($qry); $i++)
{
	$mb_id = $res['mb_id'];
	
	if($app_lssn_no == "1")
	{
		$sql = " select * from {$g5['quiz_answer_table']} where qa_uid = '{$mb_id}' and qa_end = 'Y' and qa_success = 'Y' order by qa_no desc limit 0, 1 ";
		$res2 = sql_fetch($sql);
		$testScore = $res2['qa_pointTotal'];
	}
	else if($app_lssn_no == "12")
	{
		//준법교육 시험 점수 가져오기
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
	$sql = " select * from {$g5['less_apply_table']} where app_uid = '{$mb_id}' and app_lssn_no = '{$app_lssn_no}' limit 0, 1 ";
	$res2 = sql_fetch($sql);
	
	if($res2['app_study_rate'])
		$aRate = $res2['app_study_rate'] . " %";
	else
		$aRate = "";
	
	if($app_lssn_no == "12" || $app_lssn_no == "13")
	{
		if($res2['app_evaluation'] == "Y" && $testScore >= 60)
			$strEval = "수료";
		else
			$strEval = "미수료";
	}
	else
	{
		if($res2['app_study_rate'] == 100)
			$strEval = "수료";
		else
			$strEval = "미수료";
	}
	
    $res = array_map('iconv_euckr', $res);
	$res2 = array_map('iconv_euckr', $res2);
	
	if($app_lssn_no == "1" || $app_lssn_no == "3")
		$strWrite = "NS윤리준법 시스템 사이버 교육";
	else if($app_lssn_no == "2" || $app_lssn_no == "4")
		$strWrite = "대규모유통업법의 이해";
	else if($app_lssn_no == "5")
		$strWrite = "한 눈에 보는 NS 준법교육";
	else if($app_lssn_no == "6")
		$strWrite = "윤리경영 및 청탁금지법";
	else if($app_lssn_no == "10")
		$strWrite = "2021 내부 회계교육";
	else if($app_lssn_no == "11")
		$strWrite = "2021 하반기 전사 CP교육(2)";
	else if($app_lssn_no == "12")
		$strLesson = "준법교육(상반기1)";
	else if($app_lssn_no == "13")
		$strLesson = "준법교육(상반기2)";
	else if($app_lssn_no == "14")
		$strLesson = "내부회계관리제도";
	else if($app_lssn_no == "15")
		$strLesson = "2022 지식재산권(하반기)";
	else if($app_lssn_no == "16")
		$strLesson = "미디어팀교육";
	else if($app_lssn_no == "17")
		$strLesson = "청탁금지법 교육(하반기)";
	else if($app_lssn_no == "18")
		$strLesson = "윤리경영 사이버교육(하반기)";
	
	$strWrite = iconv_euckr($strWrite);
	$strEval = iconv_euckr($strEval);
	
	$worksheet->write($i, 0, $strWrite);
	$worksheet->write($i, 1, $res['mb_name']);
	$worksheet->write($i, 2, $res['mb_id']);
	$worksheet->write($i, 3, $res['mb_4']);
	$worksheet->write($i, 4, substr($res2['app_rdate'], 0, 10));
	$worksheet->write($i, 5, substr($res2['app_edate'], 0, 10));
	$worksheet->write($i, 6, $aRate);
	$worksheet->write($i, 7, $testScore);
	$worksheet->write($i, 8, $strEval);
	//foreach($data as $key=>$cell) {
	//	$worksheet->write($i, $col++, $res[$key]);
	//}
}

$workbook->close();

$filename = "사이버교육진도관리".date("ymd", time()).".xls";
if( is_ie() ) $filename = utf2euc($filename);

header("Content-Type: application/x-msexcel; name=".$filename);
header("Content-Disposition: inline; filename=".$filename);
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>