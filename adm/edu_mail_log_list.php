<?php
$sub_menu = '600800';
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$emq_id = (int)$_GET['emq_id'];

$sql_search = " WHERE 1 ";
if ($emq_id) {
    $sql_search .= " AND l.emq_id = '{$emq_id}' ";
}

$sql_common = " FROM sj_edu_mail_log l 
                LEFT JOIN sj_edu_mail_queue q ON l.emq_id = q.emq_id 
                LEFT JOIN {$g5['member_table']} m ON l.mb_id = m.mb_id ";

$sql = " SELECT count(*) as cnt {$sql_common} {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = " SELECT l.*, q.emq_subject, m.mb_name {$sql_common} {$sql_search} ORDER BY l.eml_id DESC ";
$result = sql_query($sql);

$g5['title'] = '교육 메일 발송 로그';
include_once('./admin.head.php');
?>

<div class="local_ov01 local_ov">
    <span class="btn_ov01"><span class="ov_txt">전체 로그 </span><span class="ov_num">
            <?php echo number_format($total_count)?> 건
        </span></span>
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
        <caption>
            <?php echo $g5['title']; ?>
        </caption>
        <thead>
            <tr>
                <th scope="col">번호</th>
                <th scope="col">캠페인명</th>
                <th scope="col">수신인(아이디)</th>
                <th scope="col">이메일</th>
                <th scope="col">상태</th>
                <th scope="col">발송일시</th>
                <th scope="col">수신확인일시</th>
                <th scope="col">조회수</th>
            </tr>
        </thead>
        <tbody>
            <?php
for ($i = 0; $row = sql_fetch_array($result); $i++) {
    $status_text = $row['eml_status'] == 1 ? '<span style="color:#28a745;">성공</span>' : '<span style="color:#dc3545;">실패</span>';
    $read_text = $row['eml_read_time'] ? $row['eml_read_time'] : '-';

    $num = $total_count - $i;
?>
            <tr>
                <td class="td_num_c">
                    <?php echo $num?>
                </td>
                <td class="td_left">
                    <?php echo get_text($row['emq_subject'])?>
                </td>
                <td class="td_mbname">
                    <?php echo get_text($row['mb_name'])?> (
                    <?php echo $row['mb_id']?>)
                </td>
                <td class="td_email">
                    <?php echo get_text($row['eml_email'])?>
                </td>
                <td class="td_num_c">
                    <?php echo $status_text?>
                </td>
                <td class="td_datetime">
                    <?php echo $row['eml_send_time']?>
                </td>
                <td class="td_datetime">
                    <?php echo $read_text?>
                </td>
                <td class="td_num_c">
                    <?php echo $row['eml_open_count']?>
                </td>
            </tr>
            <?php
}
if ($i == 0)
    echo "<tr><td colspan='8' class='empty_table'>자료가 없습니다.</td></tr>";
?>
        </tbody>
    </table>
</div>

<?php
include_once('./admin.tail.php');
?>