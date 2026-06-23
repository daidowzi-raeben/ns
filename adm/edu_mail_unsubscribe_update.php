<?php
$sub_menu = '600800';
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택삭제") {
    $count = 0;
    for ($i=0; $i<count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $mb_id = sql_real_escape_string($_POST['mb_id'][$k]);
        
        if ($mb_id) {
            $sql = " delete from sj_edu_mail_unsubscribe where mb_id = '{$mb_id}' ";
            sql_query($sql);
            $count++;
        }
    }
    alert("선택한 {$count}개의 수신거부 항목을 삭제하였습니다.");
}

goto_url('./edu_mail_unsubscribe_list.php');
?>
