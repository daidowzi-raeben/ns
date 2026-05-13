<?php
include_once('./_common.php');

$lssn_no = (int)$_GET['lssn_no'];
if (!$lssn_no) {
    echo "<tr><td colspan='4' class='empty_table'>과정을 먼저 선택하세요.</td></tr>";
    exit;
}

$sql_common = " FROM {$g5['member_table']} m 
                LEFT JOIN {$g5['less_apply_table']} a 
                ON m.mb_id = a.app_uid AND a.app_lssn_no = '{$lssn_no}' 
                WHERE m.mb_level = '1' AND m.mb_leave_date = '' AND m.mb_intercept_date = '' ";

$sql = " SELECT m.mb_id, m.mb_name, m.mb_email, IFNULL(a.app_study_rate, 0) as rate " . $sql_common . " GROUP BY m.mb_id ORDER BY m.mb_name ASC ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $bg = 'bg'.($i%2);
?>
<tr class="<?php echo $bg; ?>">
    <td class="td_chk">
        <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo $row['mb_name']; ?> 님</label>
        <input type="checkbox" name="chk[]" value="<?php echo $row['mb_id']; ?>" id="chk_<?php echo $i; ?>" class="learner_chk">
    </td>
    <td class="td_left"><?php echo get_text($row['mb_name']); ?> (<?php echo $row['mb_id']; ?>)</td>
    <td class="td_email"><?php echo $row['mb_email']; ?></td>
    <td class="td_num"><?php echo $row['rate']; ?>%</td>
</tr>
<?php
}

if ($i == 0) {
    echo "<tr><td colspan='4' class='empty_table'>학습자가 없습니다.</td></tr>";
}
?>
