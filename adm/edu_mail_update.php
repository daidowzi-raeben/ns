<?php
$sub_menu = "600800";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$emq_subject = trim($_POST['emq_subject']);
$emq_content = trim($_POST['emq_content']);
$emq_target_lesson = (int)$_POST['emq_target_lesson'];
$emq_target_type = $_POST['emq_target_type'];
$emq_reserve_time = $_POST['emq_reserve_time'];
$emq_use_unsubscribe = (int)$_POST['emq_use_unsubscribe'];

if (!$emq_subject || !$emq_content || !$emq_target_lesson || !$emq_reserve_time) {
    alert('모든 필수 항목을 입력해 주세요.');
}

$sql_common = " emq_subject = '{$emq_subject}',
                emq_content = '{$emq_content}',
                emq_target_lesson = '{$emq_target_lesson}',
                emq_target_type = '{$emq_target_type}',
                emq_reserve_time = '{$emq_reserve_time}',
                emq_use_unsubscribe = '{$emq_use_unsubscribe}',
                mb_id = '{$member['mb_id']}' ";

if ($w == 'u') {
    $sql = " update sj_edu_mail_queue set {$sql_common} where emq_id = '{$emq_id}' ";
    sql_query($sql);
}
else {
    $sql = " insert into sj_edu_mail_queue set 
                {$sql_common},
                emq_status = 'WAIT',
                emq_reg_date = '" . G5_TIME_YMDHIS . "' ";
    sql_query($sql);
}

goto_url('./edu_mail_list.php');
?>