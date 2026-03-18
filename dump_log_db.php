<?php
define('_GNUBOARD_', true);
include_once('./common.php');
$result = sql_query("SHOW COLUMNS FROM sj_edu_mail_log");
while ($row = sql_fetch_array($result)) {
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
?>
