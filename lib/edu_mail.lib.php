<?php
if (!defined('_GNUBOARD_'))
    exit;

/**
 * Replace placeholders in email content
 */
function replace_edu_placeholders($content, $mb_id, $lssn_no)
{
    global $g5;

    // Get Member Info
    $mb = get_member($mb_id);
    if (!$mb)
        return $content;

    // Get Lesson Info
    if ($lssn_no == 0) {
        $lssn = array('lssn_title' => 'CP 독려');
    } else {
        $sql_lssn = "SELECT * FROM {$g5['lesson_table']} WHERE lssn_no = '{$lssn_no}'";
        $lssn = sql_fetch($sql_lssn);
        if (!$lssn)
            $lssn = array('lssn_title' => '알 수 없는 과정');
    }

    // Get Learning Status
    $sql_app = "SELECT * FROM {$g5['less_apply_table']} WHERE app_lssn_no = '{$lssn_no}' AND app_uid = '{$mb_id}'";
    $app = sql_fetch($sql_app);
    $rate = isset($app['app_study_rate']) ? $app['app_study_rate'] : 0;

    $placeholders = array(
        '{이름}' => $mb['mb_name'],
        '{닉네임}' => $mb['mb_nick'],
        '{회원아이디}' => $mb['mb_id'],
        '{이메일}' => $mb['mb_email'],
        '{과정명}' => $lssn['lssn_title'],
        '{진도율}' => $rate . '%',
        '{발송안내}' => '본 메일은 발신전용입니다.'
    );

    foreach ($placeholders as $key => $val) {
        $content = str_replace($key, $val, $content);
    }

    return $content;
}

/**
 * Get target members for email sending
 */
function get_edu_mail_targets($lssn_no, $target_type, $target_ids = '')
{
    global $g5;

    $targets = array();

    // Join with unsubscribe table to exclude those who opted out
    $sql_unsub = "SELECT mb_id FROM sj_edu_mail_unsubscribe";
    $unsubs = array();
    $res_unsub = sql_query($sql_unsub);
    while ($row = sql_fetch_array($res_unsub)) {
        $unsubs[] = $row['mb_id'];
    }

    // Base target: members with mb_level = 1
    $sql_common = " FROM {$g5['member_table']} m 
                    LEFT JOIN {$g5['less_apply_table']} a 
                    ON m.mb_id = a.app_uid AND a.app_lssn_no = '{$lssn_no}' 
                    WHERE m.mb_level = '1' AND m.mb_leave_date = '' AND m.mb_intercept_date = '' ";

    if ($target_type == 'non-complete') {
        // If no application record (null), they haven't started (0%), so they are non-complete
        $sql_common .= " AND (a.app_study_rate IS NULL OR a.app_study_rate < 100) ";
    }
    else if ($target_type == 'under50') {
        $sql_common .= " AND (a.app_study_rate IS NULL OR a.app_study_rate < 50) ";
    }
    else if (($target_type == 'manual' || $target_type == 'cp') && $target_ids) {
        $ids = explode(',', $target_ids);
        $clean_ids = array();
        foreach($ids as $id) {
            $clean_ids[] = sql_real_escape_string(trim($id));
        }
        $sql_common .= " AND m.mb_id IN ('" . implode("','", $clean_ids) . "') ";
    }
    else if (($target_type == 'manual' || $target_type == 'cp') && !$target_ids) {
        return array(); // No targets if no IDs provided
    }

    $sql = " SELECT m.mb_id, m.mb_name, m.mb_email, MAX(IFNULL(a.app_study_rate, 0)) as rate " . $sql_common . " GROUP BY m.mb_id ";
    $result = sql_query($sql);

    // Fetch lesson title if lssn_no is set
    $lssn_title = "";
    if ($lssn_no) {
        $lssn = sql_fetch(" SELECT lssn_title FROM {$g5['lesson_table']} WHERE lssn_no = '{$lssn_no}' ");
        $lssn_title = $lssn['lssn_title'];
    }

    while ($row = sql_fetch_array($result)) {
        if (in_array($row['mb_id'], $unsubs))
            continue;
        if (!$row['mb_email'])
            continue;

        $row['mb_name'] = get_text($row['mb_name']);
        $row['lssn_name'] = $lssn_title;
        $row['study_rate'] = $row['rate'] . "%";

        $targets[] = $row;
    }

    return $targets;
}

/**
 * Add unsubscribe link to email content
 */
function add_unsubscribe_link($content, $mb_id)
{
    $hash = md5($mb_id . 'edu_secret'); // Simple hash for security
    $unsub_url = G5_URL . "/edu_unsubscribe.php?mb_id=" . urlencode($mb_id) . "&h=" . $hash;
    $link_html = "<br><br><div style='font-size:12px; color:#888;'>이메일 수신을 원치 않으시면 [<a href='{$unsub_url}'>수신거부</a>]를 클릭해 주세요.</div>";

    // Check if </body> exists, if so append before it
    if (strpos($content, '</body>') !== false) {
        $content = str_replace('</body>', $link_html . '</body>', $content);
    }
    else {
        $content .= $link_html;
    }

    return $content;
}
?>