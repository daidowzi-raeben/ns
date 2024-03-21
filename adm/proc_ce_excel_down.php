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

$sql = " select count(*) as cnt from {$g5['ethics_table']} ";
$row = sql_fetch($sql);
$proc_count = $row['cnt'];

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
"mb_4"=>"부서명"
);

for($i=1; $i<=$proc_count; $i++)
{
	array_push($data, $i."회");
}

array_push($data, "적용마일리지(회당)", "획득마일리지", "마일리지 합계");

$data = array_map('iconv_euckr', $data);

$col = 0;
foreach($data as $cell) {
    $worksheet->write(0, $col++, $cell);
}

for($i=1; $res=sql_fetch_array($qry); $i++)
{
    $res = array_map('iconv_euckr', $res);
	
	$worksheet->write($i, 0, $res['mb_name']);
	$worksheet->write($i, 1, $res['mb_id']);
	$worksheet->write($i, 2, $res['mb_4']);
	
	$cnt = 3;
	for($j=1; $j<=$proc_count; $j++) {
		$chkView = check_point_NS($row['mb_id'], 'p_ethic', '@'.$j, $bl_year, $bl_cate);
		$chkView = array_map('iconv_euckr', $chkView);
		$worksheet->write($i, 2+$j, $chkView['po_point'] ? $chkView['po_point'] : 0);
		$cnt++;
	}
	
	$worksheet->write($i, $cnt, "10");
	$worksheet->write($i, $cnt+1, $res['mp_8']);
	$worksheet->write($i, $cnt+2, $res['mp_point']);
	//foreach($data as $key=>$cell) {
	//	$worksheet->write($i, $col++, $res[$key]);
	//}
}

$workbook->close();

$filename = "e-윤리영상캠페인".date("ymd", time()).".xls";
if( is_ie() ) $filename = utf2euc($filename);

header("Content-Type: application/x-msexcel; name=".$filename);
header("Content-Disposition: inline; filename=".$filename);
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>