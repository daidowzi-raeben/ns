<?php
$sub_menu = '600800'; // Sync with admin.menu600.php
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '학습 미수료 메일 관리';
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

<form name="fedu_maillist" id="fedu_maillist" method="post" action="./edu_mail_list_delete.php"
    onsubmit="return fedu_maillist_submit(this);">
    <div class="tbl_head01 tbl_wrap">
        <table>
            <caption>
                <?php echo $g5['title']; ?> 목록
            </caption>
            <thead>
                <tr>
                    <th scope="col">
                        <label for="chkall" class="sound_only">전체선택</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>
                    <th scope="col">ID</th>
                    <th scope="col">이메일 제목</th>
                    <th scope="col">교육 과정명</th>
                    <th scope="col">발송조건</th>
                    <th scope="col">예약일시</th>
                    <th scope="col">상태</th>
                    <th scope="col">발송횟수</th>
                    <th scope="col">등록일</th>
                    <th scope="col">수정</th>
                    <th scope="col">발송현황</th>
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
        'all' => '전체 대상자',
        'manual' => '개별 발송',
        'cp' => 'CP 독려(엑셀)'
    );
    $target_type_str = $target_type_str_arr[$row['emq_target_type']];

    $status_color_arr = array(
        'WAIT' => '#007bff',
        'SENDING' => '#ffc107',
        'DONE' => '#28a745',
        'FAIL' => '#dc3545'
    );
    $status_color = $status_color_arr[$row['emq_status']];
    $status_text_arr = array(
        'WAIT' => '대기',
        'SENDING' => '진행중',
        'DONE' => '완료',
        'FAIL' => '실패'
    );
?>
                <tr>
                    <td class="td_chk">
                        <label for="chk_<?php echo $i; ?>" class="sound_only">
                            <?php echo get_text($row['emq_subject'])?> 선택
                        </label>
                        <input type="checkbox" name="chk[]" value="<?php echo $row['emq_id']?>"
                            id="chk_<?php echo $i; ?>">
                    </td>
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
                        <?php echo $status_text_arr[$row['emq_status']]?>
                    </td>
                    <td class="td_num_c">
                        <?php echo (int)$row['emq_send_count']; ?>회
                    </td>
                    <td class="td_datetime">
                        <?php echo $row['emq_reg_date']?>
                    </td>
                    <td class="td_mng">
                        <a href="./edu_mail_form.php?w=u&amp;emq_id=<?php echo $row['emq_id']?>"
                            class="btn btn_03">수정</a>
                    </td>
                    <td class="td_mng">
                        <a href="./edu_mail_log_list.php?emq_id=<?php echo $row['emq_id']?>" class="btn btn_01">확인</a>
                        <?php if (in_array($row['emq_status'], array('WAIT', 'FAIL'))) { ?>
                        <a href="./edu_mail_send_now.php?emq_id=<?php echo $row['emq_id']?>" class="btn btn_02"
                            onclick="return confirm('지금 바로 발송하시겠습니까?');">즉시발송</a>
                        <?php
    }?>
                    </td>
                </tr>
                <?php
}
if ($i == 0)
    echo "<tr><td colspan='11' class='empty_table'>자료가 없습니다.</td></tr>";
?>
            </tbody>
        </table>
    </div>

    <div class="btn_list01 btn_list">
        <input type="submit" name="act_button" value="삭제" onclick="document.pressed=this.value" class="btn btn_01">
    </div>
</form>

<script>
    function fedu_maillist_submit(f) {
        if (!is_checked("chk[]")) {
            alert(document.pressed + " 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if (document.pressed == "삭제") {
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