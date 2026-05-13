<?php
$sub_menu = "600800";
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], 'w');

$w = $_GET['w'];
$emq_id = (int)$_GET['emq_id'];

$html_title = '교육 메일 발송 예약';

if ($w == 'u') {
    $html_title .= ' 수정';
    $sql = " select * from sj_edu_mail_queue where emq_id = '{$emq_id}' ";
    $emq = sql_fetch($sql);
    if (!$emq['emq_id'])
        alert('등록된 자료가 없습니다.');
}
else {
    $html_title .= ' 추가';
    $emq = array(
        'emq_reserve_time' => G5_TIME_YMDHIS,
        'emq_use_unsubscribe' => 1,
        'emq_target_type' => 'non-complete'
    );
}

$g5['title'] = $html_title;
include_once('./admin.head.php');
include_once(G5_PLUGIN_PATH . '/jquery-ui/datepicker.php');

// Get Lessons for select box
$sql_lssn = " SELECT lssn_no, lssn_title, lssn_status FROM {$g5['lesson_table']} ORDER BY lssn_no DESC ";
$res_lssn = sql_query($sql_lssn);

// If new, find first ongoing lesson to select by default
$ongoing_lssn_no = 0;
if ($w != 'u') {
    $res_ongoing = sql_query($sql_lssn); // Re-run or reset pointer
    while ($temp = sql_fetch_array($res_ongoing)) {
        if ($temp['lssn_status'] == 'D') {
            $ongoing_lssn_no = $temp['lssn_no'];
            break;
        }
    }
}
?>

<div class="local_desc">
    <p>
        학습자별 주요 정보 자동 치환: <strong>{이름}, {닉네임}, {회원아이디}, {이메일}, {과정명}, {진도율}</strong>
    </p>
</div>

<form name="feduform" id="feduform" action="./edu_mail_update.php" onsubmit="return feduform_check(this);"
    method="post">
    <input type="hidden" name="w" value="<?php echo $w?>">
    <input type="hidden" name="emq_id" value="<?php echo $emq_id?>">

    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption>
                <?php echo $g5['title']; ?>
            </caption>
            <colgroup>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
                <tr>
                    <th scope="row"><label for="emq_target_lesson">대상 교육 과정</label></th>
                    <td>
                        <select name="emq_target_lesson" id="emq_target_lesson" required>
                            <option value="">과정을 선택하세요</option>
                            <?php
while ($l = sql_fetch_array($res_lssn)) {
    $selected = "";
    if ($w == "u") {
        if ($emq["emq_target_lesson"] == $l["lssn_no"])
            $selected = "selected";
    }
    else {
        if ($ongoing_lssn_no == $l["lssn_no"])
            $selected = "selected";
    }
?>
                            <option value="<?php echo $l['lssn_no']?>" <?php echo $selected?>>
                                <?php echo $l['lssn_title']?>
                            </option>
                            <?php
}?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">발송 대상 (타겟팅)</th>
                    <td>
                        <input type="radio" name="emq_target_type" value="non-complete" id="type_nc" <?php echo
                            $emq['emq_target_type']=='non-complete' ? 'checked' : ''?>> <label for="type_nc">미수료자 (진도율
                            100% 미만)</label> &nbsp;
                        <input type="radio" name="emq_target_type" value="under50" id="type_50" <?php echo
                            $emq['emq_target_type']=='under50' ? 'checked' : ''?>> <label for="type_50">진도율 50%
                            미만</label> &nbsp;
                        <input type="radio" name="emq_target_type" value="all" id="type_all" <?php echo
                            $emq['emq_target_type']=='all' ? 'checked' : ''?>> <label for="type_all">전체 학습자</label> &nbsp;
                        <input type="radio" name="emq_target_type" value="manual" id="type_manual" <?php echo
                            $emq['emq_target_type']=='manual' ? 'checked' : ''?>> <label for="type_manual">개별 발송</label>
                    </td>
                </tr>
                <tr id="manual_target_section" style="display:none;">
                    <th scope="row">발송 대상 선택</th>
                    <td>
                        <div id="learner_list_wrap" style="max-height:400px; overflow-y:auto; border:1px solid #ddd; padding:10px; background:#f9f9f9;">
                            <table class="tbl_head01">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <label for="all_chk" class="sound_only">전체선택</label>
                                            <input type="checkbox" id="all_chk">
                                        </th>
                                        <th scope="col">이름(아이디)</th>
                                        <th scope="col">이메일</th>
                                        <th scope="col">진도율</th>
                                    </tr>
                                </thead>
                                <tbody id="learner_list_body">
                                    <tr>
                                        <td colspan="4" class="empty_table">과정을 선택해 주세요.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="emq_target_ids" id="emq_target_ids" value="<?php echo $emq['emq_target_ids']; ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="emq_reserve_time">예약 발송 일시</label></th>
                    <td>
                        <input type="text" name="emq_reserve_time" value="<?php echo $emq['emq_reserve_time']?>"
                            id="emq_reserve_time" required class="frm_input required" size="20">
                        <span class="frm_info">YYYY-MM-DD HH:MM:SS 형식으로 입력하세요.</span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">수신거부 링크 포함</th>
                    <td>
                        <input type="checkbox" name="emq_use_unsubscribe" value="1" id="use_unsub" <?php echo
                            $emq['emq_use_unsubscribe'] ? 'checked' : ''?>>
                        <label for="use_unsub">메일 하단에 수신거부 링크를 포함합니다.</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="emq_subject">메일 제목</label></th>
                    <td><input type="text" name="emq_subject" value="<?php echo get_text($emq['emq_subject'])?>"
                            id="emq_subject" required class="required frm_input" size="100"></td>
                </tr>
                <tr>
                    <th scope="row">메일 내용</th>
                    <td>
                        <?php echo editor_html("emq_content", get_text($emq['emq_content'], 0)); ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top">
        <a href="./edu_mail_list.php" class="btn btn_02">목록</a>
        <input type="submit" name="act_button" value="발송 예약 저장" class="btn btn_submit" accesskey="s">
        <input type="submit" name="act_button" value="즉시 발송" class="btn btn_01" style="background:#ff5722; color:#fff;"
            onclick="return confirm('저장 후 즉시 발송하시겠습니까?');">
    </div>

</form>

<script>
    $(function () {
        $("#emq_reserve_time").datepicker({
            dateFormat: "yy-mm-dd",
            onSelect: function (dateText, inst) {
                // If it's a date only, append current time pattern if needed
                var currentVal = $(this).val();
                if (currentVal.indexOf(' ') == -1) {
                    $(this).val(currentVal + " 10:00:00");
                }
            }
        });

        // Toggle manual target section
        $("input[name='emq_target_type']").on('change', function() {
            if ($(this).val() == 'manual') {
                $("#manual_target_section").show();
                load_learner_list();
            } else {
                $("#manual_target_section").hide();
            }
        });

        // Trigger change on load if manual is selected
        if ($("input[name='emq_target_type']:checked").val() == 'manual') {
            $("#manual_target_section").show();
            load_learner_list();
        }

        // Reload list when lesson changes
        $("#emq_target_lesson").on('change', function() {
            if ($("input[name='emq_target_type']:checked").val() == 'manual') {
                load_learner_list();
            }
        });

        // Select All toggle
        $(document).on('click', '#all_chk', function() {
            $(".learner_chk").prop('checked', $(this).is(':checked'));
        });

        function load_learner_list() {
            var lssn_no = $("#emq_target_lesson").val();
            var target_ids = $("#emq_target_ids").val();
            
            if (!lssn_no) {
                $("#learner_list_body").html("<tr><td colspan='4' class='empty_table'>과정을 먼저 선택하세요.</td></tr>");
                return;
            }

            $("#learner_list_body").html("<tr><td colspan='4' class='empty_table'>불러오는 중...</td></tr>");

            $.get("./ajax.edu_learner_list.php", { lssn_no: lssn_no }, function(data) {
                $("#learner_list_body").html(data);
                
                // Pre-check if editing
                if (target_ids) {
                    var ids = target_ids.split(',');
                    $(".learner_chk").each(function() {
                        if (ids.indexOf($(this).val()) !== -1) {
                            $(this).prop('checked', true);
                        }
                    });
                }
            });
        }
    });

    function feduform_check(f) { 
        <?php echo get_editor_js("emq_content"); ?>

        if ($("input[name='emq_target_type']:checked").val() == 'manual') {
            var selected_ids = [];
            $(".learner_chk:checked").each(function() {
                selected_ids.push($(this).val());
            });

            if (selected_ids.length == 0) {
                alert("개별 발송할 학습자를 선택해 주세요.");
                return false;
            }

            $("#emq_target_ids").val(selected_ids.join(','));
        }

        return true;
    }
</script>

<?php
include_once('./admin.tail.php');
?>