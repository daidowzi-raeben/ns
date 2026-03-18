<?php
$sub_menu = '600810';
include_once('./_common.php');
auth_check($auth[$sub_menu], 'r');

$lssn_no = (int)$_GET['lssn_no'];
$target_type = $_GET['target_type'];

$sql_search = " WHERE m.mb_level = '1' AND m.mb_leave_date = '' AND m.mb_intercept_date = '' ";

if ($target_type == 'non-complete') {
    $sql_search .= " AND (a.app_study_rate IS NULL OR a.app_study_rate < 100) ";
}
else if ($target_type == 'under50') {
    $sql_search .= " AND (a.app_study_rate IS NULL OR a.app_study_rate < 50) ";
}

$sql_common = " FROM {$g5['member_table']} m 
                LEFT JOIN {$g5['less_apply_table']} a ON m.mb_id = a.app_uid AND a.app_lssn_no = '{$lssn_no}' ";

$sql = " SELECT a.*, m.mb_id, m.mb_name, m.mb_email, IFNULL(a.app_study_rate, 0) as rate_display {$sql_common} {$sql_search} ORDER BY m.mb_id ASC ";
$result = sql_query($sql);

$selected_lssn_title = "-";
if ($lssn_no) {
    $sl = sql_fetch(" SELECT lssn_title FROM {$g5['lesson_table']} WHERE lssn_no = '{$lssn_no}' ");
    $selected_lssn_title = $sl['lssn_title'];
}

header("Content-type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=학습자메일발송리스트_" . date("Ymd") . ".xls");
header("Content-Description: PHP4 Generated Data");

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
echo '<style>td { border: 1px solid #ccc; text-align: center; } th { border: 1px solid #ccc; background:#eee; }</style>';
echo '<table border="1">';
echo '<tr>';
echo '<th>번호</th>';
echo '<th>이름(아이디)</th>';
echo '<th>이메일</th>';
echo '<th>과정명</th>';
echo '<th>진도율</th>';
echo '<th>최근발송일(가장최근 보낸메일)</th>';
echo '<th>발송회차</th>';
echo '</tr>';

$total_count = mysqli_num_rows($result);

for ($i = 0; $row = sql_fetch_array($result); $i++) {
    $lssn_cond = $lssn_no ? " AND q.emq_target_lesson = '{$lssn_no}' " : "";
    $log_sql = " SELECT MAX(l.eml_send_time) as recent_send_time, COUNT(l.eml_id) as send_count
                 FROM sj_edu_mail_log l
                 JOIN sj_edu_mail_queue q ON l.emq_id = q.emq_id
                 WHERE l.mb_id = '{$row['mb_id']}' {$lssn_cond} ";
    $log_row = sql_fetch($log_sql);
    $recent_send_time = $log_row['recent_send_time'] ? substr($log_row['recent_send_time'], 0, 16) : '-';
    $send_count = $log_row['send_count'] ? $log_row['send_count'] . '회' : '-';

    echo '<tr>';
    echo '<td>' . ($total_count - $i) . '</td>';
    echo '<td>' . get_text($row['mb_name']) . ' (' . $row['mb_id'] . ')</td>';
    echo '<td>' . get_text($row['mb_email']) . '</td>';
    echo '<td>' . get_text($selected_lssn_title) . '</td>';
    echo '<td>' . $row['rate_display'] . '%</td>';
    echo '<td style="mso-number-format:\'@\';">' . $recent_send_time . '</td>';
    echo '<td>' . $send_count . '</td>';
    echo '</tr>';
}
echo '</table>';
?>
