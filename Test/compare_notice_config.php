<?php
$dbs = ['test_g', 'test_g2'];
foreach ($dbs as $db) {
    $conn = mysqli_connect('175.126.82.119', 'root', 'Rlxk5273', $db);
    if (!$conn) {
        echo "=== DB: $db - Connection failed ===\n";
        continue;
    }
    mysqli_set_charset($conn, 'utf8');
    echo "=== DB: $db ===\n";

    $res = mysqli_query($conn, "SELECT * FROM sj_board WHERE bo_table = 'notice'");
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        foreach ($row as $k => $v) {
            echo "$k: $v\n";
        }
    } else {
        echo "No board config found for bo_table = 'notice'\n";
    }
    mysqli_close($conn);
    echo "\n";
}
?>
