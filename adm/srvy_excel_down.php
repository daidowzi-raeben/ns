<?php
include_once("./_common.php");
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if($type == "A") {
    $sub_menu = "600610";
    $str_title = "윤리CP인식도";
    $cntQ = 15;
} else {
    $sub_menu = "600600";
    $str_title = "CP교육만족도";
    $cntQ = 9;
}

$sub_title = ($str == "1") ? " 진도관리" : " 설문데이터";

if (!function_exists('utf2euc')) {
    function utf2euc($str) { return iconv("UTF-8","cp949//IGNORE", $str); }
}
if (!function_exists('is_ie')) {
    function is_ie() {
        return isset($_SERVER['HTTP_USER_AGENT']) &&
            (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false ||
             strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false);
    }
}

auth_check($auth[$sub_menu], "r");

$sql_common = " from {$g5['member_table']} as m ";
$sql_common .= " left join {$g5['survey_data_table']} as sd ";
$sql_common .= " on m.mb_id = sd.srvd_uid and sd.srvy_type = '{$type}' and sd.srvy_year='$bl_year' and sd.srvy_semi = '$bl_cate' ";

$sql_search = " where (1) and m.mb_level = '1' ";

if ($mb_3) $sql_search .= " and m.mb_3 like '{$mb_3}%' ";
if ($mb_id) $sql_search .= " and m.mb_id like '{$mb_id}%' ";
if ($mb_name) $sql_search .= " and m.mb_name like '{$mb_name}%' ";

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) { $sst = "mb_datetime"; $sod = "desc"; }

$sql_order = " order by {$sst} {$sod} ";
// echo "select * {$sql_common} {$sql_search} {$sql_order}";
// exit;
$qry = sql_query("select * {$sql_common} {$sql_search} {$sql_order}");

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

/* HEADER */
if($str == "1") {
    $cols = [
        "mb_name" => "이름",
        "mb_id" => "아이디",
        "mb_3" => "부서명",
        "srvd_rdate" => "설문조사 작성일",
        "srvy_name" => "회차",
        "srvy_point" => "적용마일리지"
    ];
} else {
    if($type == "A") {
        $cols = [
            "mb_name"=>"이름","mb_id"=>"아이디","mb_3"=>"부서명","srvd_rdate"=>"설문조사 작성일","srvy_name"=>"회차",
            "Q1","Q1_1","Q2","Q2_1","Q3","Q3_1","Q4","Q4_1","Q5","Q5_1",
            "Q6","Q6_1","Q7","Q7_1","Q8","Q8_1","Q9","Q10","Q11","Q12",
            "Q13","Q14","Q15"
        ];
    } else {
        $cols = [
            "mb_name"=>"이름","mb_id"=>"아이디","mb_3"=>"부서명","srvd_rdate"=>"설문조사 작성일","srvy_name"=>"회차",
            "Q1","Q2","Q3","Q4","Q5","Q6","Q7","Q8","Q9"
        ];
    }
}

$colIndex = 1;
foreach($cols as $k => $v){
    $sheet->setCellValueByColumnAndRow($colIndex, 1, $v);
    $colIndex++;
}

/* BODY */
$rowIndex = 2;

while($res = sql_fetch_array($qry)) {
    $colIndex = 1;

    $sheet->setCellValueByColumnAndRow($colIndex++, $rowIndex, $res['mb_name']);
    $sheet->setCellValueByColumnAndRow($colIndex++, $rowIndex, $res['mb_id']);
    $sheet->setCellValueByColumnAndRow($colIndex++, $rowIndex, $res['mb_3']);
    $sheet->setCellValueByColumnAndRow($colIndex++, $rowIndex, $res['srvd_rdate']);
    $sheet->setCellValueByColumnAndRow($colIndex++, $rowIndex, $res['srvy_name']);

    if($str != "1") {
        $ex  = explode('#', $res['srvd_ex']);
        $sub = explode('#', $res['srvd_sub']);
        $txt = explode('#', $res['srvd_text']);

        $idx = 0;
        for($i=5; $i<count($cols); $i++) {
            $val = $ex[$idx] ?? '';

            if(isset($sub[$idx]) && $sub[$idx] == '3') {
                $val = $txt[$idx] ?? '';
            } else if(isset($sub[$idx]) && $sub[$idx] != '_') {
                $val = $sub[$idx];
            }

            $sheet->setCellValueByColumnAndRow($colIndex++, $rowIndex, $val);
            $idx++;
        }
    }

    $rowIndex++;
}

/* OUTPUT */
$filename = $str_title.$sub_title.date("ymd").".xlsx";
if(is_ie()) $filename = utf2euc($filename);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=\"{$filename}\"");
header("Cache-Control: max-age=0");

$writer = new Xlsx($spreadsheet);
$writer->save("php://output");
exit;
?>