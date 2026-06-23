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

<form name="funsconfiglist" id="funsconfiglist" action="./edu_mail_unsubscribe_update.php" onsubmit="return funsconfiglist_submit(this);" method="post">
<input type="hidden" name="token" value="">

<div class="local_ov01 local_ov">
    <span class="btn_ov01"><span class="ov_txt">전체 수신거부자 </span><span class="ov_num">
            <?php echo number_format($total_count)?> 명
        </span></span>
</div>

<div class="btn_fixed_top">
    <a href="./edu_mail_list.php" class="btn btn_02">발송 관리 목록</a>
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_01">
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
        <caption>
            <?php echo $g5['title']; ?> 목록
        </caption>
        <thead>
            <tr>
                <th scope="col" style="width:50px;">
                    <label for="chkall" class="sound_only">전체선택</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th scope="col">아이디</th>
                <th scope="col">이름</th>
                <th scope="col">이메일</th>
                <th scope="col">거부 일시</th>
            </tr>
        </thead>
        <tbody>
            <?php
for ($i = 0; $row = sql_fetch_array($result); $i++) {
    $bg = 'bg'.($i%2);
?>
            <tr class="<?php echo $bg; ?>">
                <td class="td_chk">
                    <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
                    <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                </td>
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
    echo "<tr><td colspan='5' class='empty_table'>자료가 없습니다.</td></tr>";
?>
        </tbody>
    </table>
</div>

</form>

<script>
function funsconfiglist_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed + " 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if (document.pressed == "선택삭제") {
        if (!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>