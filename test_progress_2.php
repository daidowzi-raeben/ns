<?php
include_once('./_common.php');
$member['mb_id'] = 'admin'; // mock login
$lssn_no = 36;
$sql = "SELECT cpt_no, cpt_contents FROM sj_lms_chapter WHERE cpt_lesson = 36 AND cpt_seq = 1";
$row = sql_fetch($sql);
$cpt_no = $row['cpt_no'];

$att = sql_fetch("SELECT att_study_rate FROM sj_lms_chapter_att WHERE att_lssn_no = 36 AND att_uid = 'admin' AND att_chapter_no = '$cpt_no'");
echo "-> 현재 해당 차시(1차시) 진도율: " . ($att['att_study_rate'] ?? '없음') . "%\n\n";
