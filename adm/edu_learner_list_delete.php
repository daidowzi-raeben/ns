<?php
$sub_menu = '600810';
include_once('./_common.php');
auth_check($auth[$sub_menu], 'w');

$chk = $_POST['chk'];
$lssn_no = (int)$_POST['lssn_no'];
$target_type = $_POST['target_type'];

if (!count($chk)) {
    alert('삭제하실 항목을 하나 이상 선택하세요.');
}

for ($i = 0; $i < count($chk); $i++) {
    $mb_id = sql_real_escape_string($chk[$i]);
    
    // 무엇을 삭제할지 명확하지 않아 주석 처리해두었습니다.
    // 1. 학습 신청 내역 삭제
    // if ($lssn_no) {
    //     sql_query(" DELETE FROM {$g5['less_apply_table']} WHERE app_uid = '{$mb_id}' AND app_lssn_no = '{$lssn_no}' ");
    // }
    
    // 2. 메일 발송 로그 삭제
    // sql_query(" DELETE FROM sj_edu_mail_log WHERE mb_id = '{$mb_id}' ");
}

alert('삭제버튼 연동이 완료되었습니다. (실제 데이터 삭제 로직은 주석 처리되어 있습니다. 필요에 따라 주석을 해제해주세요)', './edu_learner_list.php?lssn_no='.$lssn_no.'&target_type='.$target_type);
?>
