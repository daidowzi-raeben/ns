<?php
include_once('./_common.php');



$sql = " SELECT * from cd_lms_lesson_result WHERE mb_id = '".$member['mb_id']."' and lssn_no = '".$_GET['idx']."' ";
$row = sql_fetch($sql);

if(!isset($row['mb_id']) && $_GET['mode'] == 'w') {
sql_query("INSERT INTO `cd_lms_lesson_result` (`lssn_no`, `mb_id`, `start_dt`, `end_dt`, `datetime`) VALUES ( '".$_GET['idx']."', '".$member['mb_id']."', now(), now(), now())");
}

if($_GET['mode'] == 'u') {
	sql_query("UPDATE cd_lms_lesson_result SET end_dt = NOW() WHERE mb_id = '".$member['mb_id']."' and lssn_no = '".$_GET['idx']."'");
}

?>