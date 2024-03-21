<?php
$sub_menu = "100100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

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

		$mb_id				= addslashes($data->sheets[0]['cells'][$i][3]);
		$mb_2				= addslashes($data->sheets[0]['cells'][$i][4]);
		$mb_3				= addslashes($data->sheets[0]['cells'][$i][5]);
		$mb_4				= addslashes($data->sheets[0]['cells'][$i][6]);
		$mb_5				= addslashes($data->sheets[0]['cells'][$i][7]);
		$mb_6				= addslashes($data->sheets[0]['cells'][$i][8]);
				
        if(!$mb_id) {
            $fail_count++;
            continue;
        }
		
		$sql_common = " mb_2 = '{$mb_2}',
						mb_3 = '{$mb_3}',
						mb_4 = '{$mb_4}',
						mb_5 = '{$mb_5}',
						mb_6 = '{$mb_6}' ";

		/*
		mb_datetime = '".G5_TIME_YMDHIS."',
		*/

        $sql = " update {$g5['member_table']}
					set {$sql_common}
                where mb_id = '{$mb_id}' ";
        sql_query($sql);
		//echo $sql;
		//echo "</br>";

        $succ_count++;
    }
}

alert('부서변경을 완료했습니다.\\n총회원수 : '.number_format($total_count).'\\n등록건수 : '.number_format($succ_count).'\\n실패건수 : '.number_format($fail_count), './member_list.php?'.$qstr.'&amp;');
//goto_url('./member_list.php?'.$qstr.'&amp;', false);
?>