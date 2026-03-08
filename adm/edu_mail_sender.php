<?php
include_once('./_common.php');
include_once(G5_LIB_PATH . '/mailer.lib.php');
include_once(G5_LIB_PATH . '/edu_mail.lib.php');

// Prevent timeout
@set_time_limit(0);

// Admin only if run via web, but allow command line (cron) or secret key for testing
$is_test = (isset($_GET['key']) && $_GET['key'] == 'test1234');
if (!isset($is_admin) || $is_admin != 'super') {
    if (php_sapi_name() != 'cli' && !$is_test) {
        die('Admin only');
    }
}

$now = G5_TIME_YMDHIS;

// 1. Find WAIT jobs that are due
$sql = " SELECT * FROM sj_edu_mail_queue 
         WHERE emq_status = 'WAIT' 
         AND emq_reserve_time <= '{$now}' 
         ORDER BY emq_reserve_time ASC LIMIT 1 ";
$queue = sql_fetch($sql);

if (!$queue) {
    echo "No pending mail jobs.\n";
    exit;
}

$emq_id = $queue['emq_id'];

// 2. Mark as SENDING to prevent duplicate runs
sql_query(" UPDATE sj_edu_mail_queue SET emq_status = 'SENDING' WHERE emq_id = '{$emq_id}' ");

// 3. Get Targets
$targets = get_edu_mail_targets($queue['emq_target_lesson'], $queue['emq_target_type']);
$total = count($targets);
$success = 0;
$fail = 0;

echo "Processing Job ID {$emq_id}: {$queue['emq_subject']} ($total targets)\n";

foreach ($targets as $target) {
    $mb_id = $target['mb_id'];
    $to_email = $target['mb_email'];

    // Replace placeholders
    $subject = replace_edu_placeholders($queue['emq_subject'], $mb_id, $queue['emq_target_lesson']);
    $content = replace_edu_placeholders($queue['emq_content'], $mb_id, $queue['emq_target_lesson']);

    // Add Unsubscribe Link if enabled
    if ($queue['emq_use_unsubscribe']) {
        $content = add_unsubscribe_link($content, $mb_id);
    }

    // Sender Setup
    $domain = parse_url(G5_URL, PHP_URL_HOST);
    if ($domain == 'localhost')
        $domain = 'yourdomain.com'; // Fallback for local testing
    $sender_email = 'cs@' . $domain;
    $sender_name = $config['cf_admin_email_name'] . '(발신전용)';

    // Append sending-only notice to content
    $content .= "<br><br><div style='font-size:12px; color:#888; border-top:1px solid #eee; padding-top:10px;'>본 메일은 발신전용으로 회신이 되지 않습니다. 관련 문의사항은 고객센터를 이용해 주시기 바랍니다.</div>";

    // Send Mail
    // mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="")
    $res = mailer($sender_name, $sender_email, $to_email, $subject, $content, 1);

    if ($res) {
        $success++;
        $status = 1;
    }
    else {
        $fail++;
        $status = 0;
    }

    // Log
    sql_query(" INSERT INTO sj_edu_mail_log SET 
                emq_id = '{$emq_id}',
                mb_id = '{$mb_id}',
                eml_email = '{$to_email}',
                eml_status = '{$status}',
                eml_send_time = '{$now}' ");
}

// 4. Mark as DONE
sql_query(" UPDATE sj_edu_mail_queue SET emq_status = 'DONE' WHERE emq_id = '{$emq_id}' ");

echo "Job Finished. Success: $success, Fail: $fail\n";
?>