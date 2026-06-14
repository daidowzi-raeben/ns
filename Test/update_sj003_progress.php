<?php
$conn = mysqli_connect('175.126.82.119', 'root', 'Rlxk5273', 'test_g');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "\n");
}
mysqli_set_charset($conn, 'utf8');

echo "=== Updating sj003 Progress to 5th chapter, 8th study ===\n";

// 1. Update sj_lms_chapter_attend
$sql1 = "UPDATE sj_lms_chapter_attend 
         SET att_study_page = 8, att_study_rate = 80 
         WHERE att_uid = 'sj003' AND att_lssn_no = 35 AND att_chapter_no = 77";
if (mysqli_query($conn, $sql1)) {
    echo "Successfully updated sj_lms_chapter_attend: set page=8, rate=80 for chapter 77\n";
} else {
    echo "Error updating sj_lms_chapter_attend: " . mysqli_error($conn) . "\n";
}

// 2. Delete logs in sj_lms_chapter_attend_log for pages > 8
$sql2 = "DELETE FROM sj_lms_chapter_attend_log 
         WHERE al_uid = 'sj003' AND att_lssn_no = 35 AND att_chapter_no = 77 AND att_study_page > 8";
if (mysqli_query($conn, $sql2)) {
    echo "Successfully deleted sj_lms_chapter_attend_log for pages > 8\n";
} else {
    echo "Error deleting logs: " . mysqli_error($conn) . "\n";
}

// 3. Update sj_lesson_apply overall rate to 96%
// Overall rate = (100% * 4 + 80%) / 5 = 96%
$sql3 = "UPDATE sj_lesson_apply 
         SET app_study_rate = 96 
         WHERE app_uid = 'sj003' AND app_lssn_no = 35";
if (mysqli_query($conn, $sql3)) {
    echo "Successfully updated sj_lesson_apply: set rate=96\n";
}
 else {
    echo "Error updating sj_lesson_apply: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
