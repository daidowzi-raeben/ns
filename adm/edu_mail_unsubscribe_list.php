<?php
$sub_menu = '600800';
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '교육 메일 수신거부 명단';
include_once('./admin.head.php');

$sql_common = " from sj_edu_mail_unsubscribe u left join {$g5['member_table']} m on u.mb_id = m.mb_id ";
$sql = " select count(*) as cnt {$sql_common} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = " select u.*, m.mb_name, m.mb_email {$sql_common} order by u.unsub_date desc ";
$result = sql_query($sql);
?>

<div class="local_ov01 local_ov">
    <span class="btn_ov01"><span class="ov_txt">전체 수신거부자 </span><span class="ov_num">
            <?php echo number_format($total_count)?> 명
        </span></span>
</div>

<div class="btn_fixed_top">
    <a href="./edu_mail_list.php" class="btn btn_02">발송 관리 목록</a>
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
        <caption>
            <?php echo $g5['title']; ?> 목록
        </caption>
        <thead>
            <tr>
                <th scope="col">아이디</th>
                <th scope="col">이름</th>
                <th scope="col">이메일</th>
                <th scope="col">거부 일시</th>
            </tr>
        </thead>
        <tbody>
            <?php
for ($i = 0; $row = sql_fetch_array($result); $i++) {
?>
            <tr>
                <td class="td_num_c">
                    <?php echo $row['mb_id']?>
                </td>
                <td class="td_name2">
                    <?php echo get_text($row['mb_name'])?>
                </td>
                <td class="td_email">
                    <?php echo get_text($row['mb_email'])?>
                </td>
                <td class="td_datetime">
                    <?php echo $row['unsub_date']?>
                </td>
            </tr>
            <?php
}
if ($i == 0)
    echo "<tr><td colspan='4' class='empty_table'>자료가 없습니다.</td></tr>";
?>
        </tbody>
    </table>
</div>

<?php
include_once('./admin.tail.php');
?>