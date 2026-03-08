<?php
$sub_menu = '600800'; // Sync with admin.menu600.php
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '교육 미수료자 메일 발송 관리';
include_once('./admin.head.php');

$sql_common = " from sj_edu_mail_queue ";
$sql = " select count(*) as cnt {$sql_common} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = " select * {$sql_common} order by emq_id desc ";
$result = sql_query($sql);
?>

<div class="local_ov01 local_ov">
    <span class="btn_ov01"><span class="ov_txt">전체 </span><span class="ov_num">
            <?php echo number_format($total_count)?> 건
        </span></span>
</div>

<div class="btn_fixed_top">
    <a href="./edu_mail_form.php" class="btn btn_01">신규 메일 발송 예약</a>
    <a href="./edu_mail_unsubscribe_list.php" class="btn btn_02">수신거부 명단</a>
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
        <caption>
            <?php echo $g5['title']; ?> 목록
        </caption>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">제목</th>
                <th scope="col">대상 교육</th>
                <th scope="col">발송 조건</th>
                <th scope="col">예약 일시</th>
                <th scope="col">상태</th>
                <th scope="col">등록일</th>
                <th scope="col">관리</th>
            </tr>
        </thead>
        <tbody>
            <?php
for ($i = 0; $row = sql_fetch_array($result); $i++) {
    // Get Lesson Name
    $lssn = sql_fetch(" SELECT lssn_title FROM {$g5['lesson_table']} WHERE lssn_no = '{$row['emq_target_lesson']}' ");

    $target_type_str_arr = array(
        'non-complete' => '미수료자',
        'under50' => '진도율 50% 미만',
        'all' => '전체 대상자'
    );
    $target_type_str = $target_type_str_arr[$row['emq_target_type']];

    $status_color_arr = array(
        'WAIT' => '#007bff',
        'SENDING' => '#ffc107',
        'DONE' => '#28a745',
        'FAIL' => '#dc3545'
    );
    $status_color = $status_color_arr[$row['emq_status']];
?>
            <tr>
                <td class="td_num_c">
                    <?php echo $row['emq_id']?>
                </td>
                <td class="td_left">
                    <?php echo get_text($row['emq_subject'])?>
                </td>
                <td class="td_left">
                    <?php echo $lssn['lssn_title']?>
                </td>
                <td class="td_mng">
                    <?php echo $target_type_str?>
                </td>
                <td class="td_datetime">
                    <?php echo $row['emq_reserve_time']?>
                </td>
                <td class="td_mng" style="color:<?php echo $status_color?>; font-weight:bold;">
                    <?php echo $row['emq_status']?>
                </td>
                <td class="td_datetime">
                    <?php echo $row['emq_reg_date']?>
                </td>
                <td class="td_mng">
                    <a href="./edu_mail_form.php?w=u&amp;emq_id=<?php echo $row['emq_id']?>" class="btn btn_03">수정</a>
                    <a href="./edu_mail_log_list.php?emq_id=<?php echo $row['emq_id']?>" class="btn btn_02">로그</a>
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