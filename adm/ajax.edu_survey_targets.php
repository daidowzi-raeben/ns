<?php
$sub_menu = "600800";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

header('Content-Type: application/json');

$type = isset($_GET['type']) ? trim($_GET['type']) : '';
$year = isset($_GET['year']) ? trim($_GET['year']) : '';
$semi = isset($_GET['semi']) ? trim($_GET['semi']) : '';

if (!$type || !$year || !$semi) {
    echo json_encode(array('error' => '필수 파라미터가 누락되었습니다.'));
    exit;
}

$bl_year = sql_real_escape_string($year);
$bl_semi = sql_real_escape_string($semi);

$list = array();
$target_ids = array();

if ($type === 'cp_satisfaction') {
    $sql = " SELECT m.mb_id, m.mb_name, m.mb_email 
             FROM {$g5['member_table']} m
             LEFT JOIN {$g5['survey_data_table']} sd
               ON m.mb_id = sd.srvd_uid 
               AND sd.srvy_type = 'B' 
               AND sd.srvy_year = '{$bl_year}' 
               AND sd.srvy_semi = '{$bl_semi}'
             WHERE m.mb_level = '1' 
               AND m.mb_leave_date = '' 
               AND m.mb_intercept_date = ''
               AND sd.srvd_uid IS NULL
             ORDER BY m.mb_id ASC ";
    $status_str = '미수료';
} else if ($type === 'cp_ethics') {
    $sql = " SELECT m.mb_id, m.mb_name, m.mb_email 
             FROM {$g5['member_table']} m
             LEFT JOIN {$g5['survey_data_table']} sd
               ON m.mb_id = sd.srvd_uid 
               AND sd.srvy_type = 'A' 
               AND sd.srvy_year = '{$bl_year}' 
               AND sd.srvy_semi = '{$bl_semi}'
             WHERE m.mb_level = '1' 
               AND m.mb_leave_date = '' 
               AND m.mb_intercept_date = ''
               AND sd.srvd_uid IS NULL
             ORDER BY m.mb_id ASC ";
    $status_str = '미수료';
} else if ($type === 'cp_pledge') {
    $sql = " SELECT m.mb_id, m.mb_name, m.mb_email 
             FROM {$g5['member_table']} m
             LEFT JOIN sj_prs_pledge pledge
               ON m.mb_id = pledge.mb_id
               AND pledge.pld_flag = '2' 
               AND pledge.pld_year = '{$bl_year}' 
               AND pledge.pld_semi = '{$bl_semi}'
             WHERE m.mb_level = '1' 
               AND m.mb_leave_date = '' 
               AND m.mb_intercept_date = ''
               AND pledge.pld_no IS NULL
             ORDER BY m.mb_id ASC ";
    $status_str = '미수료';
} else {
    echo json_encode(array('error' => '잘못된 독려 유형입니다.'));
    exit;
}

$res = sql_query($sql);
while ($row = sql_fetch_array($res)) {
    $list[] = array(
        'mb_id' => $row['mb_id'],
        'mb_name' => get_text($row['mb_name']),
        'mb_email' => $row['mb_email'],
        'status' => $status_str
    );
    $target_ids[] = $row['mb_id'];
}

echo json_encode(array(
    'success' => true,
    'list' => $list,
    'target_ids' => implode(',', $target_ids)
));
?>
