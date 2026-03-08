<?php
include_once('./common.php');
include_once(G5_LIB_PATH . '/edu_mail.lib.php');

echo "--- Testing Edu Mail Logic ---\n";

// 1. Check Lesson
$lssn = sql_fetch(" SELECT lssn_no, lssn_name FROM {$g5['lesson_table']} LIMIT 1 ");
if (!$lssn) {
    echo "No lessons found in {$g5['lesson_table']}\n";
}
else {
    echo "Using Lesson: [{$lssn['lssn_no']}] {$lssn['lssn_name']}\n";
    $lssn_no = $lssn['lssn_no'];

    // 2. Check Targets
    echo "Checking Targets (all)...\n";
    $targets = get_edu_mail_targets($lssn_no, 'all');
    echo "Total targets found: " . count($targets) . "\n";
    if (count($targets) > 0) {
        $test_mb = $targets[0];
        echo "Sample target: {$test_mb['mb_id']} ({$test_mb['mb_name']}) <{$test_mb['mb_email']}>\n";

        // 3. Test Template Replacement
        $sample_content = "안녕하세요 {이름}님, [{과정명}]의 현재 진도율은 {진도율}입니다.";
        $replaced = replace_edu_placeholders($sample_content, $test_mb['mb_id'], $lssn_no);
        echo "Template replacement result: {$replaced}\n";

        // 4. Test Unsubscribe Inclusion
        $with_unsub = add_unsubscribe_link($replaced, $test_mb['mb_id']);
        echo "Unsubscribe link added (length check): " . strlen($with_unsub) . " bytes\n";
    }
}

// 5. Test Unsubscribe Filter
echo "Testing Unsubscribe Filter...\n";
if (isset($test_mb)) {
    sql_query(" INSERT INTO sj_edu_mail_unsubscribe SET mb_id = '{$test_mb['mb_id']}', unsub_date = '" . G5_TIME_YMDHIS . "' ON DUPLICATE KEY UPDATE unsub_date = VALUES(unsub_date) ");
    $targets_after = get_edu_mail_targets($lssn_no, 'all');
    echo "Targets after unsubsidizing {$test_mb['mb_id']}: " . count($targets_after) . "\n";

    // Cleanup
    sql_query(" DELETE FROM sj_edu_mail_unsubscribe WHERE mb_id = '{$test_mb['mb_id']}' ");
    echo "Cleanup done.\n";
}

echo "--- Test Complete ---\n";
?>