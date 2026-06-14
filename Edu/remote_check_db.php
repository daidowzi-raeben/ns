<?php
if (!isset($_GET['token']) || $_GET['token'] !== 'secret_raeben_2026') {
    die('Unauthorized');
}
header('Content-Type: text/plain; charset=utf-8');

echo "=== GLMS dbconfig.php ===\n";
echo file_get_contents('../data/dbconfig.php') . "\n\n";

echo "=== GLMS2 dbconfig.php ===\n";
echo file_get_contents('../../gLms2/data/dbconfig.php') . "\n\n";

// Check notice table counts
include_once('../data/dbconfig.php');
$conn = mysqli_connect(G5_MYSQL_HOST, G5_MYSQL_USER, G5_MYSQL_PASSWORD, G5_MYSQL_DB);
if ($conn) {
    echo "Connected to GLMS DB: " . G5_MYSQL_DB . "\n";
    $res = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM sj_write_notice");
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        echo "sj_write_notice count: " . $row['cnt'] . "\n";
    } else {
        echo "Failed to query sj_write_notice: " . mysqli_error($conn) . "\n";
    }
    mysqli_close($conn);
} else {
    echo "Failed to connect to GLMS DB\n";
}
?>
