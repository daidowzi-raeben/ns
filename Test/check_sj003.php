<?php
$conn = mysqli_connect('175.126.82.119', 'root', 'Rlxk5273', 'test_g');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "\n");
}
mysqli_set_charset($conn, 'utf8');

echo "=== Chapters for Lesson 35 ===\n";
$res = mysqli_query($conn, "SELECT cpt_no, cpt_lssn_no, cpt_name, cpt_order FROM sj_lms_chapter WHERE cpt_lssn_no = 35 ORDER BY cpt_order ASC");
while ($row = mysqli_fetch_assoc($res)) {
    echo "cpt_no: {$row['cpt_no']} | cpt_order: {$row['cpt_order']} | name: {$row['cpt_name']}\n";
}

echo "\n=== sj003 Progress in sj_lms_chapter_attend ===\n";
$res2 = mysqli_query($conn, "SELECT * FROM sj_lms_chapter_attend WHERE att_uid = 'sj003' AND att_lssn_no = 35 ORDER BY att_chapter_no ASC");
while ($row2 = mysqli_fetch_assoc($res2)) {
    echo "att_no: {$row2['att_no']} | att_chapter_no: {$row2['att_chapter_no']} | page: {$row2['att_study_page']} | rate: {$row2['att_study_rate']} | done: {$row2['att_done']} | date: {$row2['att_done_date']}\n";
}
mysqli_close($conn);
?>
