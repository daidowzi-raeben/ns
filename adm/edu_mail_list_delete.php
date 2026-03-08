<?php
$sub_menu = '600800';
include_once('./_common.php');

auth_check($auth[$sub_menu], 'd');

$count = count($_POST['chk']);
if (!$count) {
    alert('항목을 하나 이상 선택하세요.');
}

for ($i = 0; $i < $count; $i++) {
    $emq_id = (int)$_POST['chk'][$i];

    // Delete logs first
    sql_query(" delete from sj_edu_mail_log where emq_id = '$emq_id' ");
    // Delete queue
    sql_query(" delete from sj_edu_mail_queue where emq_id = '$emq_id' ");
}

goto_url('./edu_mail_list.php');
?>