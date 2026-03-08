<?php
include_once('./common.php');

$eml_id = (int)$_GET['eml_id'];

if ($eml_id) {
    $now = G5_TIME_YMDHIS;
    $ip = $_SERVER['REMOTE_ADDR'];

    // Update read status
    $sql = " UPDATE sj_edu_mail_log SET 
                eml_read_time = IFNULL(eml_read_time, '{$now}'),
                eml_read_ip = '{$ip}',
                eml_open_count = eml_open_count + 1 
             WHERE eml_id = '{$eml_id}' ";
    sql_query($sql);
}

// Return 1x1 transparent GIF
header('Content-Type: image/gif');
echo base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
?>