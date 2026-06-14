<?php
if (!isset($_GET['token']) || $_GET['token'] !== 'secret_raeben_2026') {
    die('Unauthorized');
}
header('Content-Type: text/plain; charset=utf-8');

echo "=== GLMS dbconfig.php ===\n";
echo file_get_contents('../data/dbconfig.php') . "\n\n";

echo "=== GLMS2 dbconfig.php ===\n";
echo file_get_contents('../../gLms2/data/dbconfig.php') . "\n\n";

define('_GNUBOARD_', true);
include_once('../data/dbconfig.php');

$dbs = ['test_g', 'test_g2'];
foreach ($dbs as $db) {
    echo "=== DB: $db ===\n";
    try {
        $conn = mysqli_connect('localhost', 'g_user', 'g_sj5273!', $db);
        if (!$conn) {
            echo "Failed to connect: " . mysqli_connect_error() . "\n\n";
            continue;
        }
        mysqli_set_charset($conn, 'utf8');

        // 1. check sj_board for notice
        $res_board = mysqli_query($conn, "SELECT bo_table, bo_subject, bo_device, bo_use_cert FROM sj_board WHERE bo_table = 'notice'");
        if ($res_board && mysqli_num_rows($res_board) > 0) {
            $row = mysqli_fetch_assoc($res_board);
            echo "sj_board notice: bo_table={$row['bo_table']}, bo_subject={$row['bo_subject']}, bo_device={$row['bo_device']}, bo_use_cert='{$row['bo_use_cert']}'\n";
        } else {
            echo "sj_board notice: NOT FOUND\n";
        }

        // 2. check sj_write_notice count and latest
        $res_table = mysqli_query($conn, "SHOW TABLES LIKE 'sj_write_notice'");
        if ($res_table && mysqli_num_rows($res_table) > 0) {
            $res_cnt = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM sj_write_notice");
            $cnt = $res_cnt ? mysqli_fetch_assoc($res_cnt)['cnt'] : 0;
            echo "sj_write_notice row count: $cnt\n";
            if ($cnt > 0) {
                $res_latest = mysqli_query($conn, "SELECT wr_id, wr_subject, wr_datetime, wr_option FROM sj_write_notice ORDER BY wr_id DESC LIMIT 4");
                while ($row = mysqli_fetch_assoc($res_latest)) {
                    echo " - wr_id={$row['wr_id']}: {$row['wr_subject']} ({$row['wr_datetime']}) opt='{$row['wr_option']}'\n";
                }
            }
        } else {
            echo "Table sj_write_notice does not exist!\n";
        }
        mysqli_close($conn);
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage() . "\n";
    }
    echo "\n";
}
?>
