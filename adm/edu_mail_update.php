<?php
$sub_menu = "600800";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$w = isset($_POST['w']) ? trim($_POST['w']) : '';
$emq_id = isset($_POST['emq_id']) ? (int)$_POST['emq_id'] : 0;

$emq_subject = trim($_POST['emq_subject']);
$emq_content = trim($_POST['emq_content']);
$emq_target_lesson = (int)$_POST['emq_target_lesson'];
$emq_target_type = $_POST['emq_target_type'];
$emq_reserve_time = $_POST['emq_reserve_time'];
$emq_use_unsubscribe = (int)$_POST['emq_use_unsubscribe'];
$emq_target_ids = trim($_POST['emq_target_ids']);

$lesson_check = in_array($emq_target_type, array('cp', 'cp_satisfaction', 'cp_ethics', 'cp_pledge')) ? true : ($emq_target_lesson > 0);

if (!$emq_subject || !$emq_content || !$lesson_check || !$emq_reserve_time) {
    alert('모든 필수 항목을 입력해 주세요.');
}

$sql_common = " emq_subject = '{$emq_subject}',
                emq_content = '{$emq_content}',
                emq_target_lesson = '{$emq_target_lesson}',
                emq_target_type = '{$emq_target_type}',
                emq_target_ids = '{$emq_target_ids}',
                emq_reserve_time = '{$emq_reserve_time}',
                emq_use_unsubscribe = '{$emq_use_unsubscribe}',
                mb_id = '{$member['mb_id']}' ";

if ($w == 'u') {
    $sql = " update sj_edu_mail_queue set {$sql_common}, emq_status = 'WAIT' where emq_id = '{$emq_id}' ";
    sql_query($sql);
}
else {
    $sql = " insert into sj_edu_mail_queue set 
                {$sql_common},
                emq_status = 'WAIT',
                emq_reg_date = '" . G5_TIME_YMDHIS . "' ";
    sql_query($sql);
    $emq_id = sql_insert_id();
}

// Debugging log
$log_msg = "[" . date('Y-m-d H:i:s') . "] w: " . $w . ", emq_id_post: " . (isset($_POST['emq_id']) ? $_POST['emq_id'] : 'NOT_SET') . ", emq_id_final: " . $emq_id . ", act_button: " . (isset($_POST['act_button']) ? $_POST['act_button'] : 'NOT_SET') . "\n";
@file_put_contents(G5_DATA_PATH . '/edu_mail_debug.log', $log_msg, FILE_APPEND);

if (trim($_POST['act_button']) == '즉시 발송') {
    goto_url('./edu_mail_send_now.php?emq_id=' . (int)$emq_id);
}
else {
    goto_url('./edu_mail_list.php');
}
?>