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

    $res = mysqli_query($conn, "SELECT cf_theme FROM sj_config");
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        echo "cf_theme: '{$row['cf_theme']}'\n";
    } else {
        echo "No config row found!\n";
    }
    mysqli_close($conn);
    echo "\n";
}
?>
