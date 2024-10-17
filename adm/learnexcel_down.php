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
        return isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false);
    }
}

auth_check($auth[$sub_menu], "r");

$sql_common = " from {$g5['member_point_table']} as mp ";
$sql_common .= " left join {$g5['member_table']} as m ";
$sql_common .= " on mp.mb_no = m.mb_no ";

$sql_search = " where (1) and m.mb_level = '1' and mp.mp_year = '$bl_year' and mp.mp_semi = '$bl_cate'";

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

// Put Excel data
$data = array(
"mb_name"=>"이름",
"mb_id"=>"아이디",
"mb_4"=>"부서명",
"point_3"=>"CEO메세지",
"point_4"=>"자율준수메세지",
"point_5"=>"윤리자가진단",
"point_6"=>"준법자가진단",
"point_7"=>"준법캠페인",
//"mp_8"=>"윤리영상캠페인",
"point_1"=>"윤리캠페인",
"point_2"=>"윤리경영",
"point_12"=>"사이버교육1",
//"mp_15"=>"사이버교육2",
"point_16"=>"사이버교육3",
//"mp_17"=>"사이버교육4",
//"mp_18"=>"사이버교육5",
//"mp_20"=>"사이버교육6",
//"point_21"=>"사이버교육7",
//"mp_9"=>"자율준수편람",
"point_10"=>"공정거래가이드라인",
"point_11"=>"청탁금지법가이드라인",
"point_19"=>"대규모유통법가이드라인",
"point_13"=>"CP교육만족도조사",
"point_14"=>"윤리CP인식도조사",
"sum_point"=>"마일리지 합계"
);

$data = array_map('iconv_euckr', $data);

$col = 0;
foreach($data as $cell) {
    $worksheet->write(0, $col++, $cell);
}

for($i=1; $res=sql_fetch_array($qry); $i++)
{
	$sum_point = 0;
	for($j=1; $j<=21; $j++)
	{
		$sum_point += $res['point_' . $j];
	}
	$sum_point -= $res['point_9'];
	$sum_point -= $res['point_8'];
	$sum_point -= $res['point_15'];
	$sum_point -= $res['point_17'];
	$sum_point -= $res['point_18'];
	$sum_point -= $res['point_20'];
	$sum_point -= $res['point_21'];
	$res['sum_point'] = $sum_point;
    $res = array_map('iconv_euckr', $res);

	$col = 0;
	foreach($data as $key=>$cell) {
		$worksheet->write($i, $col++, $res[$key]);
	}
}

$workbook->close();

$filename = $str_title.date("ymd", time()).".xls";
if( is_ie() ) $filename = utf2euc($filename);

header("Content-Type: application/x-msexcel; name=".$filename);
header("Content-Disposition: inline; filename=".$filename);
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>