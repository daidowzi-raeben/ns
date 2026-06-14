<?php
$conn = mysqli_connect('175.126.82.119', 'root', 'Rlxk5273', 'test_g');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "\n");
}
mysqli_set_charset($conn, 'utf8');

echo "=== Resetting sj003 to 1st chapter, 7th study ===\n";

// 1. Update 1차시 (chapter 73)
$sql1 = "UPDATE sj_lms_chapter_attend 
         SET att_study_page = 7, att_study_rate = 70 
         WHERE att_uid = 'sj003' AND att_lssn_no = 35 AND att_chapter_no = 73";
if (mysqli_query($conn, $sql1)) {
    echo "Updated chapter 73 to page 7, rate 70\n";
} else {
    echo "Error updating chapter 73: " . mysqli_error($conn) . "\n";
}

// 2. Delete logs for chapter 73 where page > 7
$sql2 = "DELETE FROM sj_lms_chapter_attend_log 
         WHERE al_uid = 'sj003' AND att_lssn_no = 35 AND att_chapter_no = 73 AND att_study_page > 7";
if (mysqli_query($conn, $sql2)) {
    echo "Deleted logs for chapter 73 above page 7\n";
} else {
    echo "Error deleting logs for chapter 73: " . mysqli_error($conn) . "\n";
}

// 3. Delete progress records for chapters 74, 75, 76, 77
$sql3 = "DELETE FROM sj_lms_chapter_attend 
         WHERE att_uid = 'sj003' AND att_lssn_no = 35 AND att_chapter_no IN (74, 75, 76, 77)";
if (mysqli_query($conn, $sql3)) {
    echo "Deleted attend records for chapters 74, 75, 76, 77\n";
} else {
    echo "Error deleting attend records: " . mysqli_error($conn) . "\n";
}

// 4. Delete logs for chapters 74, 75, 76, 77
$sql4 = "DELETE FROM sj_lms_chapter_attend_log 
         WHERE al_uid = 'sj003' AND att_lssn_no = 35 AND att_chapter_no IN (74, 75, 76, 77)";
if (mysqli_query($conn, $sql4)) {
    echo "Deleted logs for chapters 74, 75, 76, 77\n";
} else {
    echo "Error deleting logs: " . mysqli_error($conn) . "\n";
}

// 5. Update sj_lesson_apply overall rate to 14% (7 pages out of 50 total pages)
$sql5 = "UPDATE sj_lesson_apply 
         SET app_study_rate = 14 
         WHERE app_uid = 'sj003' AND app_lssn_no = 35";
if (mysqli_query($conn, $sql5)) {
    echo "Updated sj_lesson_apply overall rate to 14%\n";
} else {
    echo "Error updating overall rate: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
