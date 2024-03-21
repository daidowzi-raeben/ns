<?php
$sub_menu = "600510";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();

//업로드 파일 확인
if (isset($_FILES['mb_excel']) && is_uploaded_file($_FILES['mb_excel']['tmp_name'])) {
	$file = $_FILES['mb_excel']['tmp_name'];
	
	$mb_email = '';
	$mb_nick = '';
	$mb_certify = '';
    $mb_adult = 0;
	$mb_hp = '';
	

    include_once(G5_LIB_PATH.'/Excel/reader.php');

    $data = new Spreadsheet_Excel_Reader();

    // Set output Encoding.
    $data->setOutputEncoding('UTF-8');
	
	$data->read($file);
	
	error_reporting(E_ALL ^ E_NOTICE);

    $dup_it_id = array();
    $fail_it_id = array();
    $dup_count = 0;
    $total_count = 0;
    $fail_count = 0;
    $succ_count = 0;

    for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
        $total_count++;

		$mb_id				= addslashes($data->sheets[0]['cells'][$i][4]);
		//$mb_id = substr($mb_id, strpos($mb_id, "(")+3, 5);
		$app_rdate			= "2021-04-27";
		$app_edate			= "2021-05-12";
		$app_study_rate		= addslashes($data->sheets[0]['cells'][$i][8]);
		$app_study_rate = $app_study_rate * 100;
		$app_score			= addslashes($data->sheets[0]['cells'][$i][9]);
		$app_eval			= addslashes($data->sheets[0]['cells'][$i][10]);
		
        if(!$mb_id) {
            $fail_count++;
            continue;
        }
		
		// mb_id 중복체크
		$sql2 = " select count(*) as cnt from {$g5['less_apply_table']} where app_uid = '$mb_id' and app_lssn_no = '8'";
        $row2 = sql_fetch($sql2);
        if($row2['cnt']) {
            $fail_mb_id[] = $mb_id;
            $fail_count++;
            continue;
        }
		
		$sql_common = " app_lssn_no = '8',
						app_uid = '{$mb_id}',
						app_rdate = '{$app_rdate}',
						app_edate = '{$app_edate}',
						app_study_rate = '{$app_study_rate}',
						app_score = '{$app_score}',
						app_evaluation = '{$app_eval}'";

        $sql = " insert into {$g5['less_apply_table']}
					set {$sql_common}
				";
				
		//echo $sql;
		//echo "</br>";
        sql_query($sql);
		
		
		//마일리지 적용
		if($app_eval == "Y") {
			$num = "1";
			$strVal = "윤리성품에 기반한 윤리경영 화상특강";
			$point = "30";
			$conf = "cyber6";
			insert_point_ns($mb_id, $point, $strVal, $conf, $mb_id, "@".$num, $num);
		}

        $succ_count++;
    }
}

alert('등록을 완료했습니다.\\n총회원수 : '.number_format($total_count).'\\n등록건수 : '.number_format($succ_count).'\\n실패건수 : '.number_format($fail_count), './cyber_list.php?'.$qstr.'&amp;');
//goto_url('./member_list.php?'.$qstr.'&amp;', false);
?>