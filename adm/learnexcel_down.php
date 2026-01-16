<?php
$sub_menu = "600100";
include_once("./_common.php");

if($str == "A")
	$str_title = "통합학습관리";
else if($str == "B")
	$str_title = "개인진도관리";
else if($str == "C")
	$str_title = "부서진도관리";

if ( ! function_exists('utf2euc')) {
    function utf2euc($str) {
        return iconv("UTF-8","cp949//IGNORE", $str);
    }
}
if ( ! function_exists('is_ie')) {
    function is_ie() {
        return isset($_SERVER['HTTP_USER_AGENT']) &&
        (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false ||
         strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false);
    }
}

auth_check($auth[$sub_menu], "r");

/* ===== 회원 조회 ===== */
$qry = sql_query("select * from sj_member as m where (1) and m.mb_level = '1'");

/*================================================================================
php_writeexcel
=================================================================================*/
include_once(G5_LIB_PATH.'/Excel/php_writeexcel/class.writeexcel_workbook.inc.php');
include_once(G5_LIB_PATH.'/Excel/php_writeexcel/class.writeexcel_worksheet.inc.php');

$fname = tempnam(G5_DATA_PATH, "tmp.xls");
$workbook = new writeexcel_workbook($fname);
$worksheet = $workbook->addworksheet();

/* ===== 엑셀 헤더 (마일리지 항목 전부) ===== */
$data = array(
    "mb_name"=>"이름",
    "mb_id"=>"아이디",
    "mb_3"=>"부서명",

    "ceo"=>"CEO 메시지",
    "cmp"=>"자율준수관리자 메시지",
    "self1"=>"윤리실천 자가진단",
    "self2"=>"준법실천 자가진단",
    "p_comp"=>"e-준법교육 캠페인",
    "e_campaign"=>"윤리캠페인",
    "e_story"=>"윤리이야기",
    "cyber"=>"CP교육",
    "cyber3"=>"윤리교육",
    "ns_co"=>"윤리 톡톡",
    "guide03"=>"공정거래 가이드라인",
    "guide05"=>"대규모유통업법 가이드라인",
    "guide04"=>"청탁금지법 가이드라인",
    "srvy01"=>"CP교육 만족도 조사",
    "srvy02"=>"윤리/CP 인식도 조사",
    "guide"=>"사내 준법 가이드라인",
    "info"=>"법령정보",
    "cns"=>"준법상담",

    "sum_point"=>"마일리지 합계"
);

$data = array_map('iconv_euckr', $data);

/* ===== 헤더 출력 ===== */
$col = 0;
foreach($data as $cell) {
    $worksheet->write(0, $col++, $cell);
}

/* ===== 데이터 출력 ===== */
for($i=1; $res=sql_fetch_array($qry); $i++)
{
    $sum_point = 0;
    $mb_id = $res['mb_id'];

    // mileage01.php 와 동일한 코드들
    $codes = [
        'ceo','cmp','self1','self2','p_comp','e_campaign','e_story',
        'cyber','cyber3','ns_co','guide04','srvy01','srvy02','guide','info','cns'
    ];

    foreach ($codes as $code) {
        $mile = get_mileage($mb_id, $code);
        $res[$code] = $mile;
        $sum_point += $mile;
    }

    // guide03_1 ~ guide03_4
    $res['guide03'] = 0;
    for ($k = 1; $k <= 4; $k++) {
        $mile = get_mileage($mb_id, 'guide03_' . $k);
        $res['guide03'] += $mile;
        $sum_point += $mile;
    }

    // guide05_1 ~ guide05_2
    $res['guide05'] = 0;
    for ($k = 1; $k <= 2; $k++) {
        $mile = get_mileage($mb_id, 'guide05_' . $k);
        $res['guide05'] += $mile;
        $sum_point += $mile;
    }

    $res['sum_point'] = $sum_point;

    $res = array_map('iconv_euckr', $res);

    $col = 0;
    foreach($data as $key => $cell) {
        $worksheet->write($i, $col++, $res[$key]);
    }
}

$workbook->close();

/* ===== 파일 다운로드 ===== */
$filename = $str_title.date("ymd", time()).".xls";
if( is_ie() ) $filename = utf2euc($filename);

header("Content-Type: application/x-msexcel; name=".$filename);
header("Content-Disposition: inline; filename=".$filename);
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>