<?php
$sub_menu = "600210";
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
"po_datetime"=>"자가진단시작일",
"point_4"=>"자가진단종료일",
"1회",
"2회",
"적용마일리지",
"획득마일리지",
"mb_point"=>"마일리지 합계"
);

$data = array_map('iconv_euckr', $data);

$col = 0;
foreach($data as $cell) {
    $worksheet->write(0, $col++, $cell);
}

for($i=1; $res=sql_fetch_array($qry); $i++)
{
    $res = array_map('iconv_euckr', $res);
	
	$sql2 = " select * from {$g5['point_table']} where mb_id = '{$res['mb_id']}' and po_rel_table = 'self2' and po_year = '$bl_year' and po_semi = '$bl_cate' limit 0, 1 ";
	$row2 = sql_fetch($sql2);
	$sql2 = " select * from {$g5['point_table']} where mb_id = '{$res['mb_id']}' and po_rel_table = 'self2' and po_year = '$bl_year' and po_semi = '$bl_cate' limit 1, 1 ";
	$row3 = sql_fetch($sql3);
	
	$row2 = array_map('iconv_euckr', $row2);
	$row3 = array_map('iconv_euckr', $row3);

	$worksheet->write($i, 0, $res['mb_name']);
	$worksheet->write($i, 1, $res['mb_id']);
	$worksheet->write($i, 2, $res['mb_4']);
	$worksheet->write($i, 3, substr($row2['po_datetime'], 0, 10));
	$worksheet->write($i, 4, substr($row3['po_datetime'], 0, 10));
	$worksheet->write($i, 5, $row2['po_point']);
	$worksheet->write($i, 6, $row3['po_point']);
	$worksheet->write($i, 7, "10");
	$worksheet->write($i, 8, $res['mp_5']);
	$worksheet->write($i, 9, $res['mp_point']);
	
	//foreach($data as $key=>$cell) {
	//	$worksheet->write($i, $col++, $res[$key]);
	//}
}

$workbook->close();

$filename = "준법실천자가진단".date("ymd", time()).".xls";
if( is_ie() ) $filename = utf2euc($filename);

header("Content-Type: application/x-msexcel; name=".$filename);
header("Content-Disposition: inline; filename=".$filename);
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>