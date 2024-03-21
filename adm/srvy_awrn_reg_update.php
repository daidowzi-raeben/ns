<?php
$sub_menu = "300510";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$srvy_name = trim($_POST['srvy_name']);
$srvy_sdate = trim($_POST['srvy_sdate']);
$srvy_edate = trim($_POST['srvy_edate']);
$srvy_coord_x = trim($_POST['srvy_coord_x']);
$srvy_coord_y = trim($_POST['srvy_coord_y']);
$srvy_rdate = trim($_POST['srvy_rdate']);
$srvy_point = trim($_POST['srvy_point']);
$srvy_link = trim($_POST['srvy_link']);
$srvy_keep = trim($_POST['srvy_keep']);
$srvy_status = trim($_POST['srvy_stat']);
$srvy_type = trim($_POST['srvy_type']);
$srvy_year = substr($srvy_rdate, 0, 4);
$srvy_code = trim($_POST['srvy_code']);


$sql_common = "  
				srvy_name 		= '{$srvy_name}',
				srvy_sdate 		= '{$srvy_sdate}',
				srvy_edate 		= '{$srvy_edate}',
				srvy_coord_x 	= '{$srvy_coord_x}',
				srvy_coord_y 	= '{$srvy_coord_y}',
				srvy_point 		= '{$srvy_point}',
				srvy_link 		= '{$srvy_link}',
				srvy_keep 		= '{$srvy_keep}',
				srvy_type 		= '{$srvy_type}',
				srvy_status 	= '{$srvy_status}',
				srvy_year 		= '{$srvy_year}'";


if ($w == '')
{
    sql_query(" insert into {$g5['survey_table']} set srvy_admin = '{$member['mb_id']}', srvy_rdate = '".G5_TIME_YMDHIS."', {$sql_common} ");
}
else if ($w == 'u')
{
    $srvy = get_survey($srvy_code);
	
    if (!$srvy['srvy_code'])
        alert('존재하지 않는 데이터입니다.');

    $sql = " update {$g5['survey_table']}
                set {$sql_common}
                where srvy_code = '{$srvy_code}' ";
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

if($srvy_type == "A")
	goto_url('./srvy_awrn_list.php?'.$qstr.'&amp;', false);
else
	goto_url('./srvy_ethc_list.php?'.$qstr.'&amp;', false);
?>