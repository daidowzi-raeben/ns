<?php
$conn = mysqli_connect('175.126.82.119', 'root', 'Rlxk5273', 'test_g');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "\n");
}
mysqli_set_charset($conn, 'utf8');

echo "=== Logs for sj003 Chapter 77 ===\n";
$res = mysqli_query($conn, "SELECT * FROM sj_lms_chapter_attend_log WHERE al_uid = 'sj003' AND att_chapter_no = 77 ORDER BY al_no ASC");
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        foreach ($row as $k => $v) {
            echo "$k: $v | ";
        }
        echo "\n";
    }
} else {
    echo "No logs found or error: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
