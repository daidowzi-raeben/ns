<?php
include_once('./_common.php');
$member['mb_id'] = 'admin'; // mock login

$lssn_no = 36;
$sql = "SELECT cpt_no, cpt_contents FROM sj_lms_chapter WHERE cpt_lesson = 36 AND cpt_seq = 1";
$row = sql_fetch($sql);
$cpt_no = $row['cpt_no'];
$cpt_contents = $row['cpt_contents'];

// Clear progress for admin
sql_query("DELETE FROM sj_lms_chapter_att WHERE att_lssn_no = 36 AND att_uid = 'admin'");
sql_query("UPDATE sj_lms_apply SET app_study_rate = 0 WHERE app_lssn_no = 36 AND app_uid = 'admin'");
echo "1. DB 초기화 완료\n";

echo "2. 영상 처음 켰을 때 (page=1) 진도율 테스트 중...\n";
$_POST = [
    'lesson' => 36,
    'chapter' => $cpt_no,
    'contents' => $cpt_contents,
    'page' => 1
];
ob_start();
// simulate the logic of contents_wbt_check_json.php without exit;
$lesson = 36;
$chapter = $cpt_no;
$contents = $cpt_contents;
$page = 1;
$played_time = 10;
$total_time = 100;
include('./Edu/contents_wbt_check_json.php');
$out1 = ob_get_clean();
echo "-> 결과 (JSON): $out1\n";

$att = sql_fetch("SELECT att_study_rate FROM sj_lms_chapter_att WHERE att_lssn_no = 36 AND att_uid = 'admin' AND att_chapter_no = '$cpt_no'");
echo "-> 현재 해당 차시(1차시) 진도율: " . ($att['att_study_rate'] ?? '없음') . "%\n\n";

echo "3. 학습 완료 (Next 버튼 클릭 시 page=end) 테스트 중...\n";
$_POST['page'] = 'end';
$page = 'end';
ob_start();
include('./Edu/contents_wbt_check_json.php');
$out2 = ob_get_clean();
echo "-> 결과 (JSON): $out2\n";

$att2 = sql_fetch("SELECT att_study_rate FROM sj_lms_chapter_att WHERE att_lssn_no = 36 AND att_uid = 'admin' AND att_chapter_no = '$cpt_no'");
echo "-> 현재 해당 차시(1차시) 진도율: " . ($att2['att_study_rate'] ?? '없음') . "%\n";

$app = sql_fetch("SELECT app_study_rate FROM sj_lms_apply WHERE app_lssn_no = 36 AND app_uid = 'admin'");
echo "-> 전체 과정(36번) 총 진도율 반영 결과: " . ($app['app_study_rate'] ?? '없음') . "%\n";

