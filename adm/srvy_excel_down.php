<?php
include_once("./_common.php");

if($type == "B")
{
	$sub_menu = "600610";
	$str_title = "윤리CP인식도";
	$cntQ = 15;
	#년도, 분기값 설정
	//$bl_year = "2021";
	//$bl_cate = "A";
}
else
{
	$sub_menu = "600600";
	$str_title = "CP교육만족도";
	$cntQ = 9;
	#년도, 분기값 설정
	//$bl_year = "2021";
	//$bl_cate = "A";
}

if($str == "1")
{
	$sub_title = " 진도관리";
}
else
{
	$sub_title = " 설문데이터";
}	

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
$sql_common .= " left join {$g5['survey_data_table']} as sd ";
$sql_common .= " on m.mb_id = sd.srvd_uid and sd.srvy_type = '{$type}' and sd.srvy_year='$bl_year' and sd.srvy_semi = '$bl_cate' ";

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
if($str == "1")
{
	$data = array(
	"mb_name"=>"이름",
	"mb_id"=>"아이디",
	"mb_4"=>"부서명",
	"srvd_rdate"=>"설문조사 작성일",
	"srvy_name"=>"회차",
	"srvy_point"=>"적용마일리지"
	);
}
else
{
	if($type == "B")
	{
		$data = array(
		"mb_name"=>"이름",
		"mb_id"=>"아이디",
		"mb_4"=>"부서명",
		"srvd_rdate"=>"설문조사 작성일",
		"srvy_name"=>"회차",
		"Q1",
		"Q2",
		"Q3",
		"Q4",
		"Q5",
		"Q6",
		"Q7",
		"Q8",
		"Q9",
		"Q10",
		"Q11",
		"Q12",
		"Q13",
		"Q14",
		"Q15"
		);
	}
	else
	{
		$data = array(
		"mb_name"=>"이름",
		"mb_id"=>"아이디",
		"mb_4"=>"부서명",
		"srvd_rdate"=>"설문조사 작성일",
		"srvy_name"=>"회차",
		"Q1",
		"Q2",
		"Q3",
		"Q4",
		"Q5",
		"Q6",
		"Q7",
		"Q8",
		"Q9"
		);
	}
}

$data = array_map('iconv_euckr', $data);

$col = 0;
foreach($data as $cell) {
    $worksheet->write(0, $col++, $cell);
}

for($i=1; $res=sql_fetch_array($qry); $i++)
{
    $res = array_map('iconv_euckr', $res);

	$col = 0;
	
	if($str == 1)
	{
		foreach($data as $key=>$cell) {
			$worksheet->write($i, $col++, $res[$key]);
		}
	}
	else
	{
		$worksheet->write($i, 0, $res['mb_name']);
		$worksheet->write($i, 1, $res['mb_id']);
		$worksheet->write($i, 2, $res['mb_4']);
		$worksheet->write($i, 3, $res['srvd_rdate']);
		$worksheet->write($i, 4, $res['srvy_name']);
		
		$ar_data = explode('#', $res['srvd_ex']);
		$ar_data_text = explode('#', $res['srvd_text']);
		
		for($j=0; $j<$cntQ;$j++) 
		{
			if($ar_data_text[$j] != '_') {
				$worksheet->write($i, 5+$j, $ar_data[$j].'/'.$ar_data_text[$j]);
			} else {
				$worksheet->write($i, 5+$j, $ar_data[$j]);
			}
		}
	}
	
}

$workbook->close();

$filename = $str_title.$sub_title.date("ymd", time()).".xls";
if( is_ie() ) $filename = utf2euc($filename);

header("Content-Type: application/x-msexcel; name=".$filename);
header("Content-Disposition: inline; filename=".$filename);
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>