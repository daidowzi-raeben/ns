<?php
$sub_menu = '600810'; // New sub menu id
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '학습자 메일 발송 리스트';
include_once('./admin.head.php');

// Filter
$lssn_no = (int)$_GET['lssn_no'];
$target_type = $_GET['target_type'];

// Get Lessons for filter
$sql_lssn = " SELECT lssn_no, lssn_title FROM {$g5['lesson_table']} ORDER BY lssn_no DESC ";
$res_lssn = sql_query($sql_lssn);

// Get Selected Lesson Title
$selected_lssn_title = "-";
if ($lssn_no) {
    $sl = sql_fetch(" SELECT lssn_title FROM {$g5['lesson_table']} WHERE lssn_no = '{$lssn_no}' ");
    $selected_lssn_title = $sl['lssn_title'];
}

// Search Query
$sql_search = " WHERE m.mb_level = '1' AND m.mb_leave_date = '' AND m.mb_intercept_date = '' ";

if ($target_type == 'non-complete') {
    $sql_search .= " AND (a.app_study_rate IS NULL OR a.app_study_rate < 100) ";
}
else if ($target_type == 'under50') {
    $sql_search .= " AND (a.app_study_rate IS NULL OR a.app_study_rate < 50) ";
}

$sql_common = " FROM {$g5['member_table']} m 
                LEFT JOIN {$g5['less_apply_table']} a ON m.mb_id = a.app_uid AND a.app_lssn_no = '{$lssn_no}' ";

$sql = " SELECT count(DISTINCT m.mb_id) as cnt {$sql_common} {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = " SELECT a.*, m.mb_id, m.mb_name, m.mb_email, IFNULL(a.app_study_rate, 0) as rate_display {$sql_common} {$sql_search} GROUP BY m.mb_id ORDER BY m.mb_id ASC ";
$result = sql_query($sql);
?>

<div class="local_ov01 local_ov">
    <span class="btn_ov01"><span class="ov_txt">조회 대상자 </span><span class="ov_num">
            <?php echo number_format($total_count)?> 명
        </span></span>
</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
    <label for="lssn_no" class="sound_only">과정 선택</label>
    <select name="lssn_no" id="lssn_no" onchange="this.form.submit();">
        <option value="">전체 과정</option>
        <?php while ($l = sql_fetch_array($res_lssn)) { ?>
        <option value="<?php echo $l['lssn_no']?>" <?php echo $lssn_no == $l['lssn_no'] ? 'selected' : '' ?>>
            <?php echo get_text($l['lssn_title'])?>
        </option>
        <?php
}?>
    </select>

    <label for="target_type" class="sound_only">상태 필터</label>
    <select name="target_type" id="target_type" onchange="this.form.submit();">
        <option value="">전체 상태</option>
        <option value="non-complete" <?php echo $target_type == 'non-complete' ? 'selected' : '' ?>>미수료 (100% 미만)</option>
        <option value="under50" <?php echo $target_type == 'under50' ? 'selected' : '' ?>>진도율 50% 미만</option>
    </select>

</form>

<form name="flearnerlist" id="flearnerlist" method="post" action="./edu_learner_list_delete.php"
    onsubmit="return flearnerlist_submit(this);">
    <input type="hidden" name="lssn_no" value="<?php echo $lssn_no; ?>">
    <input type="hidden" name="target_type" value="<?php echo $target_type; ?>">

    <div style="text-align:right; margin-bottom:10px;">
        <!-- <input type="submit" name="act_button" value="삭제" class="btn btn_01" onclick="document.pressed=this.value"
            style="background:#4a5568; border-color:#4a5568; margin-right:5px;"> -->
        <a href="./edu_learner_list_excel.php?lssn_no=<?php echo $lssn_no; ?>&target_type=<?php echo $target_type; ?>"
            class="btn btn_02" style="background:#2b6cb0; border-color:#2b6cb0; color:white;">EXCEL</a>
    </div>

    <div class="tbl_head01 tbl_wrap">
        <table>
            <caption>
                <?php echo $g5['title']; ?>
            </caption>
            <colgroup>
                <!-- <col width="40px"> -->
                <col width="50px">
                <col width="100px">
                <col width="200px">
                <col width="200px">
                <col width="80px">
                <col width="150px">
                <col width="80px">
            </colgroup>
            <thead>
                <tr>
                    <!-- <th scope="col">
                        <label for="chkall" class="sound_only">전체선택</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th> -->
                    <th scope="col">번호</th>
                    <th scope="col">이름(아이디)</th>
                    <th scope="col">이메일</th>
                    <th scope="col">과정명</th>
                    <th scope="col">진도율</th>
                    <th scope="col">최근발송일(가장최근 보낸메일)</th>
                    <th scope="col">발송회차</th>
                </tr>
            </thead>
            <tbody>
                <?php
for ($i = 0; $row = sql_fetch_array($result); $i++) {
    $rate_color = $row['rate_display'] >= 100 ? '#28a745' : ($row['rate_display'] >= 50 ? '#ffc107' : '#dc3545');
?>
                <tr>
                    <!-- <td class="td_chk">
                        <label for="chk_<?php echo $i; ?>" class="sound_only">
                            <?php echo get_text($row['mb_name'])?>
                        </label>
                        <input type="checkbox" name="chk[]" value="<?php echo $row['mb_id']?>"
                            id="chk_<?php echo $i; ?>">
                    </td> -->
                    <td class="td_num_c">
                        <?php echo number_format($total_count - $i)?>
                    </td>
                    <td class="td_left">
                        <?php echo get_text($row['mb_name'])?> (
                        <?php echo $row['mb_id']?>)
                    </td>
                    <td class="td_email">
                        <?php echo get_text($row['mb_email'])?>
                    </td>
                    <td class="td_left">
                        <?php echo get_text($selected_lssn_title)?>
                    </td>
                    <td class="td_num_c" style="color:<?php echo $rate_color?>; font-weight:bold;">
                        <?php echo $row['rate_display']?>%
                    </td>
                    <?php
    // Fetch recent email send date and count for this member and (optional) lesson
    $lssn_cond = $lssn_no ? " AND q.emq_target_lesson = '{$lssn_no}' " : "";
    $log_sql = " SELECT MAX(l.eml_send_time) as recent_send_time, COUNT(l.eml_id) as send_count
                             FROM sj_edu_mail_log l
                             JOIN sj_edu_mail_queue q ON l.emq_id = q.emq_id
                             WHERE l.mb_id = '{$row['mb_id']}' {$lssn_cond} ";
    $log_row = sql_fetch($log_sql);
    $recent_send_time = $log_row['recent_send_time'] ? substr($log_row['recent_send_time'], 0, 16) : '-';
    $send_count = $log_row['send_count'] ? $log_row['send_count'] . '회' : '-';
?>
                    <td class="td_datetime">
                        <?php echo $recent_send_time; ?>
                    </td>
                    <td class="td_num_c">
                        <?php echo $send_count; ?>
                    </td>
                </tr>
                <?php
}
if ($i == 0)
    echo "<tr><td colspan='8' class='empty_table'>조회된 데이터가 없습니다.</td></tr>";
?>
            </tbody>
        </table>
    </div>
</form>

<script>
    function flearnerlist_submit(f) {
        if (!is_checked("chk[]")) {
            alert(document.pressed + " 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if (document.pressed == "삭제") {
            if (!confirm("선택한 회원을 정말 삭제하시겠습니까?")) {
                return false;
            }
        }

        return true;
    }
</script>

<?php
include_once('./admin.tail.php');
?>
<?php
include_once('./admin.tail.php');
?>