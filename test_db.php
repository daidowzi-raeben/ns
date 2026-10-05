<?php
include_once('./_common.php');
$res = sql_query("SELECT att_uid, att_study_rate FROM sj_lms_chapter_att WHERE att_lssn_no = 36 ORDER BY att_no DESC LIMIT 5");
while($row = sql_fetch_array($res)) {
    echo "UID: {$row['att_uid']}, Rate: {$row['att_study_rate']}%\n";
}
