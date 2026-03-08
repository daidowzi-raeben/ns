<?php
include_once('./_common.php');

// Add mb_id column to sj_edu_mail_queue
$sql = " ALTER TABLE sj_edu_mail_queue ADD mb_id VARCHAR(20) NOT NULL AFTER emq_id ";
$result = sql_query($sql);

if ($result) {
    echo "Successfully added mb_id column to sj_edu_mail_queue.";
}
else {
    echo "Failed to add column or it already exists.";
}
?>