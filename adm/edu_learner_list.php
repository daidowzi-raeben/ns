<?php
$sub_menu = '600810'; // New sub menu id
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '학습자별 진도 현황 리스트';
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

$sql = " SELECT count(*) as cnt {$sql_common} {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = " SELECT a.*, m.mb_id, m.mb_name, m.mb_email, IFNULL(a.app_study_rate, 0) as rate_display {$sql_common} {$sql_search} ORDER BY m.mb_id ASC ";
$result = sql_query($sql);
?>

<div class="local_ov01 local_ov">
    <span class="btn_ov01"><span class="ov_txt">조회 대상자 </span><span class="ov_num">
            <?php echo number_format($total_count)?> 명
        </span></span>
</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
    <label for="lssn_no" class="sound_only">과정 선택</label>
    <select name="lssn_no" id="lssn_no">
        <option value="">전체 과정</option>
        <?php while ($l = sql_fetch_array($res_lssn)) { ?>
        <option value="<?php echo $l['lssn_no']?>" <?php echo $lssn_no == $l['lssn_no'] ? 'selected' : '' ?>>
            <?php echo get_text($l['lssn_title'])?>
        </option>
        <?php
}?>
    </select>

    <label for="target_type" class="sound_only">상태 필터</label>
    <select name="target_type" id="target_type">
        <option value="">전체 상태</option>
        <option value="non-complete" <?php echo $target_type == 'non-complete' ? 'selected' : '' ?>>미수료 (100% 미만)</option>
        <option value="under50" <?php echo $target_type == 'under50' ? 'selected' : '' ?>>진도율 50% 미만</option>
    </select>

    <input type="submit" value="검색" class="btn_submit">
</form>

<div class="tbl_head01 tbl_wrap">
    <table>
        <caption>
            <?php echo $g5['title']; ?>
        </caption>
        <thead>
            <tr>
                <th scope="col">번호</th>
                <th scope="col">이름(아이디)</th>
                <th scope="col">이메일</th>
                <th scope="col">과정명</th>
                <th scope="col">진도율</th>
                <th scope="col">시작일</th>
                <th scope="col">최근학습일</th>
            </tr>
        </thead>
        <tbody>
            <?php
for ($i = 0; $row = sql_fetch_array($result); $i++) {
    $rate_color = $row['rate_display'] >= 100 ? '#28a745' : ($row['rate_display'] >= 50 ? '#ffc107' : '#dc3545');
?>
            <tr>
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
                <td class="td_datetime">
                    <?php echo $row['app_sdate'] ? $row['app_sdate'] : '-'?>
                </td>
                <td class="td_datetime">
                    <?php echo $row['app_udate'] ? $row['app_udate'] : '-'?>
                </td>
            </tr>
            <?php
}
if ($i == 0)
    echo "<tr><td colspan='7' class='empty_table'>조회된 데이터가 없습니다.</td></tr>";
?>
        </tbody>
    </table>
</div>

<?php
include_once('./admin.tail.php');
?>
<?php
include_once('./admin.tail.php');
?>