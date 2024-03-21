<?php
$sub_menu = "300210";
include_once('./_common.php');

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();


$lno = isset($_POST['lno']) ? trim($_POST['lno']) : '';
$lssn_kind = "LS01";
$lssn_title = isset($_POST['lssn_title']) ? trim(strip_tags($_POST['lssn_title'])) : '';
$lssn_sdate = isset($_POST['lssn_sdate']) ? trim(strip_tags($_POST['lssn_sdate'])) : '';
$lssn_edate = isset($_POST['lssn_edate']) ? trim(strip_tags($_POST['lssn_edate'])) : '';
$lssn_time = isset($_POST['lssn_time']) ? trim(strip_tags($_POST['lssn_time'])) : '';
$lssn_cond = isset($_POST['lssn_cond']) ? trim(strip_tags($_POST['lssn_cond'])) : '';
$lssn_point = isset($_POST['lssn_point']) ? trim(strip_tags($_POST['lssn_point'])) : '';
$lssn_regdate = isset($_POST['lssn_regdate']) ? trim(strip_tags($_POST['lssn_regdate'])) : '';
$lssn_link = isset($_POST['lssn_link']) ? trim(strip_tags($_POST['lssn_link'])) : '';
$lssn_img_link = isset($_POST['lssn_img_link']) ? trim(strip_tags($_POST['lssn_img_link'])) : '';
$lssn_view = isset($_POST['lssn_view']) ? trim(strip_tags($_POST['lssn_view'])) : '';

$sql_common =	"	lssn_kind = '{$lssn_kind}',
					lssn_title = '{$lssn_title}',
					lssn_sdate = '{$lssn_sdate}',
					lssn_edate = '{$lssn_edate}',
					lssn_time = '{$lssn_time}',
					lssn_cond = '{$lssn_cond}',
					lssn_point = '{$lssn_point}',
					lssn_rdate = '{$lssn_regdate}',
					lssn_url = '{$lssn_link}',
					lssn_rimg = '{$lssn_img_link}',
					lssn_view = '{$lssn_view}'
				";

if ($w == '') 
{
	//echo "insert into {$g5['lesson_table']} set {$sql_common} ";
	//exit();
	sql_query(" insert into {$g5['lesson_table']} set {$sql_common} ");
}
else if ($w == 'u')
{
	sql_query(" update {$g5['lesson_table']} set {$sql_common} where lssn_no = {$lno} ");
}

goto_url('./prc_list.php?'.$qstr.'&amp;w=u&amp;', false);