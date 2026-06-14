<?php
$conn = mysqli_connect('175.126.82.119', 'root', 'Rlxk5273', 'test_g');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "\n");
}
mysqli_set_charset($conn, 'utf8');

echo "=== Initializing All Users' Progress for Lesson 35 ===\n";

// 1. Delete all attend records for lesson 35
$sql1 = "DELETE FROM sj_lms_chapter_attend WHERE att_lssn_no = 35";
if (mysqli_query($conn, $sql1)) {
    echo "Deleted all attend records in sj_lms_chapter_attend for lesson 35 (Affected rows: " . mysqli_affected_rows($conn) . ")\n";
} else {
    echo "Error deleting attend records: " . mysqli_error($conn) . "\n";
}

// 2. Delete all logs in sj_lms_chapter_attend_log for lesson 35
$sql2 = "DELETE FROM sj_lms_chapter_attend_log WHERE att_lssn_no = 35";
if (mysqli_query($conn, $sql2)) {
    echo "Deleted all logs in sj_lms_chapter_attend_log for lesson 35 (Affected rows: " . mysqli_affected_rows($conn) . ")\n";
} else {
    echo "Error deleting logs: " . mysqli_error($conn) . "\n";
}

// 3. Reset apply table progress rate, chapter, and page to 0 for lesson 35
$sql3 = "UPDATE sj_lesson_apply 
         SET app_study_rate = 0, app_study_chapter = 0, app_study_page = 0 
         WHERE app_lssn_no = 35";
if (mysqli_query($conn, $sql3)) {
    echo "Reset overall progress rate, chapter, and page to 0 in sj_lesson_apply (Affected rows: " . mysqli_affected_rows($conn) . ")\n";
} else {
    echo "Error updating overall rate: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
