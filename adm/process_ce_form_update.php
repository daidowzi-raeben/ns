<?php
$sub_menu = "300100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$pc_name = 'e_윤리경영캠페인';
$pc_cate = trim($_POST['pc_cate']);
$pc_subject = trim($_POST['pc_subject']);
$pc_code = isset($_POST['pc_code']) ? trim(strip_tags($_POST['pc_code'])) : '';
$pc_startdate = trim($_POST['pc_startdate']);
$pc_enddate = trim($_POST['pc_enddate']);
$pc_image_w = isset($_POST['pc_image_w']) ? trim(strip_tags($_POST['pc_image_w'])) : '1017';
$pc_image_h = isset($_POST['pc_image_h']) ? trim(strip_tags($_POST['pc_image_h'])) : '562';
$pc_image_stat = trim($_POST['pc_image_stat']);
$pc_contentswin_w = isset($_POST['pc_contentswin_w']) ? trim(strip_tags($_POST['pc_contentswin_w'])) : '1280';
$pc_contentswin_h = isset($_POST['pc_contentswin_h']) ? trim(strip_tags($_POST['pc_contentswin_h'])) : '720';
$pc_contentswin_stat = trim($_POST['pc_contentswin_stat']);
$pc_contents_w = isset($_POST['pc_contents_w']) ? trim(strip_tags($_POST['pc_contents_w'])) : '1280';
$pc_contents_h = isset($_POST['pc_contents_h']) ? trim(strip_tags($_POST['pc_contents_h'])) : '720';
$pc_contents_stat = trim($_POST['pc_contents_stat']);
$pc_contents_url = trim($_POST['pc_contents_url']);
$pc_play_time = trim($_POST['pc_play_time']);
$pc_play_time_stat = trim($_POST['pc_play_time_stat']);
$pc_admit_time = trim($_POST['pc_admit_time']);
$pc_admit_time_stat = trim($_POST['pc_admit_time_stat']);
$pc_ctrbar = trim($_POST['pc_ctrbar']);
$pc_point = trim($_POST['pc_point']);
$pc_over_learn = isset($_POST['pc_over_learn']) ? trim(strip_tags($_POST['pc_over_learn'])) : '';
$pc_goal_learn = isset($_POST['pc_goal_learn']) ? trim(strip_tags($_POST['pc_goal_learn'])) : '';

$sql_common = "  
				pc_name = '{$pc_name}',
				pc_cate = '{$pc_cate}',
				pc_subject = '{$pc_subject}',
				pc_code = '{$pc_code}',
                pc_startdate = '{$pc_startdate}',
				pc_enddate = '{$pc_enddate}',
				pc_image_w = '{$pc_image_w}',
				pc_image_h = '{$pc_image_h}',
				pc_image_stat = '{$pc_image_stat}',
				pc_contentswin_w = '{$pc_contentswin_w}',
				pc_contentswin_h = '{$pc_contentswin_h}',
				pc_contentswin_stat = '{$pc_contentswin_stat}',
				pc_contents_w = '{$pc_contents_w}',
				pc_contents_h = '{$pc_contents_h}',
				pc_contents_stat = '{$pc_contents_stat}',
				pc_contents_url = '{$pc_contents_url}',
				pc_play_time = '{$pc_play_time}',
				pc_play_time_stat = '{$pc_play_time_stat}',
				pc_admit_time = '{$pc_admit_time}',
				pc_admit_time_stat = '{$pc_admit_time_stat}',
				pc_ctrbar = '{$pc_ctrbar}',
				pc_point = '{$pc_point}',
				pc_over_learn = '{$pc_over_learn}',
				pc_goal_learn = '{$pc_goal_learn}'";


if ($w == '')
{
    sql_query(" insert into {$g5['ethics_table']} set pc_register_id = '{$member['mb_id']}', pc_register_day = '".G5_TIME_YMDHIS."', pc_register_ip = '{$_SERVER['REMOTE_ADDR']}', {$sql_common} ");
}
else if ($w == 'u')
{
    $pc = get_process($pc_no, "pc");
	
    if (!$pc['pc_no'])
        alert('존재하지 않는 과정자료입니다.');

    $sql = " update {$g5['ethics_table']}
                set {$sql_common}
                where pc_no = '{$pc_no}' ";
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


goto_url('./process_ce_list.php?'.$qstr.'&amp;', false);
?>