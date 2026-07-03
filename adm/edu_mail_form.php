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

// CP / Survey Learner preloading for edit mode
$cp_list_html = '';
$survey_list_html = '';
if ($w == 'u' && $emq['emq_target_ids']) {
    if ($emq['emq_target_type'] == 'cp') {
        $ids = explode(',', $emq['emq_target_ids']);
        $clean_ids = array();
        foreach($ids as $id) {
            $clean_ids[] = sql_real_escape_string(trim($id));
        }
        $sql_cp = " SELECT mb_id, mb_name, mb_email FROM {$g5['member_table']} WHERE mb_id IN ('" . implode("','", $clean_ids) . "') ";
        $res_cp = sql_query($sql_cp);
        $idx = 1;
        while($row = sql_fetch_array($res_cp)) {
            $cp_list_html .= "<tr>";
            $cp_list_html .= "<td class='td_num_c'>{$idx}</td>";
            $cp_list_html .= "<td>ns{$row['mb_id']}</td>";
            $cp_list_html .= "<td>{$row['mb_id']}</td>";
            $cp_list_html .= "<td>" . get_text($row['mb_name']) . "</td>";
            $cp_list_html .= "<td>{$row['mb_email']}</td>";
            $cp_list_html .= "<td class='td_mng'>미수료</td>";
            $cp_list_html .= "<td class='td_mng' style='color:#28a745; font-weight:bold;'>매칭 성공</td>";
            $cp_list_html .= "</tr>";
            $idx++;
        }
    } else if (in_array($emq['emq_target_type'], array('cp_satisfaction', 'cp_ethics', 'cp_pledge'))) {
        include_once(G5_LIB_PATH . '/edu_mail.lib.php');
        $targets = get_edu_mail_targets(0, $emq['emq_target_type'], $emq['emq_target_ids']);
        $idx = 1;
        foreach($targets as $row) {
            $status_str = '미수료';
            $survey_list_html .= "<tr>";
            $survey_list_html .= "<td class='td_num_c'>{$idx}</td>";
            $survey_list_html .= "<td>{$row['mb_id']}</td>";
            $survey_list_html .= "<td>" . get_text($row['mb_name']) . "</td>";
            $survey_list_html .= "<td>" . ($row['mb_email'] ? $row['mb_email'] : '<span style="color:#dc3545;">이메일 없음</span>') . "</td>";
            $survey_list_html .= "<td>{$status_str}</td>";
            $survey_list_html .= "</tr>";
            $idx++;
        }
    }
}
if (empty($cp_list_html)) {
    $cp_list_html = "<tr id='cp_empty_row'><td colspan='7' class='empty_table'>엑셀 파일을 업로드해 주세요.</td></tr>";
}
if (empty($survey_list_html)) {
    $survey_list_html = "<tr id='survey_empty_row'><td colspan='5' class='empty_table'>대상자 조회를 해주세요.</td></tr>";
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
                            <?php if ($w == 'u' && $emq['emq_target_lesson'] == 0) { 
                                $fixed_title = 'CP 독려';
                                if ($emq['emq_target_type'] == 'cp_satisfaction') $fixed_title = 'CP교육만족도조사';
                                else if ($emq['emq_target_type'] == 'cp_ethics') $fixed_title = '윤리CP인식도조사';
                                else if ($emq['emq_target_type'] == 'cp_pledge') $fixed_title = '공정거래자율준수서약';
                            ?>
                                <option value="0" selected><?php echo $fixed_title; ?></option>
                            <?php } ?>
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
                        <input type="hidden" name="emq_target_lesson" id="emq_target_lesson_hidden" value="0" <?php echo ($w == 'u' && $emq['emq_target_lesson'] == 0) ? '' : 'disabled'; ?>>
                    </td>
                </tr>
                <tr>
                    <th scope="row">독려 유형</th>
                    <td>
                        <input type="radio" name="edu_type" value="cyber" id="edu_type_cyber" <?php echo ($w != 'u' || !in_array($emq['emq_target_type'], array('cp', 'cp_satisfaction', 'cp_ethics', 'cp_pledge'))) ? 'checked' : ''; ?>>
                        <label for="edu_type_cyber">사이버교육독려</label>
                        &nbsp;&nbsp;
                        <input type="radio" name="edu_type" value="cp" id="edu_type_cp" <?php echo ($w == 'u' && $emq['emq_target_type'] == 'cp') ? 'checked' : ''; ?>>
                        <label for="edu_type_cp">CP독려</label>
                        &nbsp;&nbsp;
                        <input type="radio" name="edu_type" value="cp_satisfaction" id="edu_type_cp_satisfaction" <?php echo ($w == 'u' && $emq['emq_target_type'] == 'cp_satisfaction') ? 'checked' : ''; ?>>
                        <label for="edu_type_cp_satisfaction">CP교육만족도조사</label>
                        &nbsp;&nbsp;
                        <input type="radio" name="edu_type" value="cp_ethics" id="edu_type_cp_ethics" <?php echo ($w == 'u' && $emq['emq_target_type'] == 'cp_ethics') ? 'checked' : ''; ?>>
                        <label for="edu_type_cp_ethics">윤리CP인식도조사</label>
                        &nbsp;&nbsp;
                        <input type="radio" name="edu_type" value="cp_pledge" id="edu_type_cp_pledge" <?php echo ($w == 'u' && $emq['emq_target_type'] == 'cp_pledge') ? 'checked' : ''; ?>>
                        <label for="edu_type_cp_pledge">공정거래자율준수서약</label>
                    </td>
                </tr>
                <tr id="cyber_target_section">
                    <th scope="row">발송 대상 (타겟팅)</th>
                    <td>
                        <input type="radio" name="emq_target_type" value="non-complete" id="type_nc" <?php echo
                            ($w != 'u' || $emq['emq_target_type']=='non-complete') ? 'checked' : ''?>> <label for="type_nc">미수료자 (진도율
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
                <input type="hidden" name="emq_target_type" id="emq_target_type_hidden" value="<?php echo in_array($emq['emq_target_type'], array('cp', 'cp_satisfaction', 'cp_ethics', 'cp_pledge')) ? $emq['emq_target_type'] : 'cp'; ?>" <?php echo ($w == 'u' && in_array($emq['emq_target_type'], array('cp', 'cp_satisfaction', 'cp_ethics', 'cp_pledge'))) ? '' : 'disabled'; ?>>
                <tr id="cp_excel_section" style="display:none;">
                    <th scope="row">엑셀 파일 업로드</th>
                    <td>
                        <input type="file" id="cp_excel_file" accept=".xlsx, .xls" class="frm_input">
                        <span class="frm_info">NS쇼핑 교육이수현황 엑셀 파일을 업로드해 주세요. (.xlsx, .xls)</span>
                    </td>
                </tr>
                <tr id="cp_target_section" style="display:none;">
                    <th scope="row">발송 대상 명단</th>
                    <td>
                        <div id="cp_list_wrap" style="max-height:400px; overflow-y:auto; border:1px solid #ddd; padding:10px; background:#f9f9f9;">
                            <table class="tbl_head01">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">엑셀 ID</th>
                                        <th scope="col">매칭 ID</th>
                                        <th scope="col">이름</th>
                                        <th scope="col">이메일</th>
                                        <th scope="col">이수 상태</th>
                                        <th scope="col">결과</th>
                                    </tr>
                                </thead>
                                <tbody id="cp_list_body">
                                    <?php echo $cp_list_html; ?>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr id="survey_select_section" style="display:none;">
                    <th scope="row">대상 조사/서약 구분</th>
                    <td>
                        <label for="survey_year">년도</label>
                        <?php 
                        $selected_year = '';
                        $selected_semi = 'A';
                        if ($w == 'u' && in_array($emq['emq_target_type'], array('cp_satisfaction', 'cp_ethics', 'cp_pledge')) && $emq['emq_target_ids']) {
                            list($selected_year, $selected_semi) = explode('|', $emq['emq_target_ids']);
                        }
                        echo get_blYear_select("survey_year", $selected_year);
                        ?>
                        &nbsp;&nbsp;
                        <label for="survey_semi">분류</label>
                        <?php echo get_blCate_select("survey_semi", $selected_semi); ?>
                        &nbsp;&nbsp;
                        <button type="button" id="btn_load_survey_targets" class="btn btn_03" style="vertical-align:middle;">대상자 조회</button>
                    </td>
                </tr>
                <tr id="survey_target_section" style="display:none;">
                    <th scope="row">발송 대상 명단</th>
                    <td>
                        <div id="survey_list_wrap" style="max-height:400px; overflow-y:auto; border:1px solid #ddd; padding:10px; background:#f9f9f9;">
                            <table class="tbl_head01">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">아이디</th>
                                        <th scope="col">이름</th>
                                        <th scope="col">이메일</th>
                                        <th scope="col">이수 상태</th>
                                    </tr>
                                </thead>
                                <tbody id="survey_list_body">
                                    <?php echo $survey_list_html; ?>
                                </tbody>
                            </table>
                        </div>
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

        // Toggle cyber/cp types
        function toggle_edu_type() {
            var type = $("input[name='edu_type']:checked").val();
            if (type == 'cyber') {
                $("#cyber_target_section").show();
                $("#cp_excel_section").hide();
                $("#cp_target_section").hide();
                $("#survey_select_section").hide();
                $("#survey_target_section").hide();
                
                $("input[name='emq_target_type']").prop('disabled', false);
                $("#emq_target_type_hidden").prop('disabled', true);
                
                // For lesson
                $("#emq_target_lesson").prop('disabled', false);
                $("#emq_target_lesson_hidden").prop('disabled', true);
                <?php if ($w != 'u' || $emq['emq_target_lesson'] != 0) { ?>
                    $("#emq_target_lesson option[value='0']").remove();
                <?php } ?>
                
                if ($("input[name='emq_target_type']:checked").val() == 'manual') {
                    $("#manual_target_section").show();
                } else {
                    $("#manual_target_section").hide();
                }
            } else if (type == 'cp') {
                $("#cyber_target_section").hide();
                $("#manual_target_section").hide();
                $("#cp_excel_section").show();
                $("#cp_target_section").show();
                $("#survey_select_section").hide();
                $("#survey_target_section").hide();
                
                $("input[name='emq_target_type']").prop('disabled', true);
                $("#emq_target_type_hidden").val('cp').prop('disabled', false);
                
                // For lesson
                $("#emq_target_lesson option[value='0']").remove();
                $("#emq_target_lesson").append('<option value="0" selected>CP 독려</option>');
                $("#emq_target_lesson").val('0').prop('disabled', true);
                $("#emq_target_lesson_hidden").val('0').prop('disabled', false);
            } else if (type == 'cp_satisfaction' || type == 'cp_ethics' || type == 'cp_pledge') {
                $("#cyber_target_section").hide();
                $("#manual_target_section").hide();
                $("#cp_excel_section").hide();
                $("#cp_target_section").hide();
                $("#survey_select_section").show();
                $("#survey_target_section").show();
                
                $("input[name='emq_target_type']").prop('disabled', true);
                $("#emq_target_type_hidden").val(type).prop('disabled', false);
                
                // For lesson
                var opt_title = 'CP 독려';
                if (type == 'cp_satisfaction') opt_title = 'CP교육만족도조사';
                else if (type == 'cp_ethics') opt_title = '윤리CP인식도조사';
                else if (type == 'cp_pledge') opt_title = '공정거래자율준수서약';
                
                $("#emq_target_lesson option[value='0']").remove();
                $("#emq_target_lesson").append('<option value="0" selected>' + opt_title + '</option>');
                $("#emq_target_lesson").val('0').prop('disabled', true);
                $("#emq_target_lesson_hidden").val('0').prop('disabled', false);
            }
        }

        $("input[name='edu_type']").on('change', toggle_edu_type);
        toggle_edu_type(); // Initialize on load

        // Reload list when lesson changes
        $("#emq_target_lesson").on('change', function() {
            if ($("input[name='edu_type']:checked").val() == 'cyber' && $("input[name='emq_target_type']:checked").val() == 'manual') {
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

        // Excel file upload & processing
        $("#cp_excel_file").on('change', function() {
            var file = this.files[0];
            if (!file) return;
            
            var formData = new FormData();
            formData.append('cp_excel_file', file);
            
            $("#cp_list_body").html("<tr><td colspan='7' class='empty_table'>엑셀 분석 중...</td></tr>");
            
            $.ajax({
                url: "./ajax.process_cp_excel.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(res) {
                    if (res.error) {
                        alert(res.error);
                        $("#cp_list_body").html("<tr><td colspan='7' class='empty_table' style='color:#dc3545;'>오류: " + res.error + "</td></tr>");
                        $("#emq_target_ids").val('');
                    } else {
                        var html = '';
                        if (res.list && res.list.length > 0) {
                            $.each(res.list, function(idx, item) {
                                html += '<tr>';
                                html += '<td class="td_num_c">' + (idx + 1) + '</td>';
                                html += '<td>' + item.excel_id + '</td>';
                                html += '<td>' + (item.db_id ? item.db_id : '-') + '</td>';
                                html += '<td>' + (item.db_name ? item.db_name : (item.excel_name ? item.excel_name : '-')) + '</td>';
                                html += '<td>' + (item.db_email ? item.db_email : '<span style="color:#dc3545;">이메일 없음</span>') + '</td>';
                                html += '<td class="td_mng">' + item.status + '</td>';
                                if (item.matched) {
                                    if (item.db_email) {
                                        html += '<td class="td_mng" style="color:#28a745; font-weight:bold;">매칭 성공</td>';
                                    } else {
                                        html += '<td class="td_mng" style="color:#ffc107; font-weight:bold;">매칭성공 (이메일누락)</td>';
                                    }
                                } else {
                                    html += '<td class="td_mng" style="color:#dc3545; font-weight:bold;">매칭 실패</td>';
                                }
                                html += '</tr>';
                            });
                            $("#emq_target_ids").val(res.target_ids);
                        } else {
                            html = "<tr><td colspan='7' class='empty_table'>미수료 대상 학습자가 없습니다.</td></tr>";
                            $("#emq_target_ids").val('');
                        }
                        $("#cp_list_body").html(html);
                    }
                },
                error: function(xhr, status, error) {
                    alert("서버 통신 오류가 발생했습니다.");
                    $("#cp_list_body").html("<tr><td colspan='7' class='empty_table' style='color:#dc3545;'>서버 오류</td></tr>");
                    $("#emq_target_ids").val('');
                }
            });
        });
    });

        $("#btn_load_survey_targets").on('click', load_survey_targets);
        $("#survey_year, #survey_semi").on('change', load_survey_targets);

        function load_survey_targets() {
            var type = $("input[name='edu_type']:checked").val();
            if (type !== 'cp_satisfaction' && type !== 'cp_ethics' && type !== 'cp_pledge') {
                return;
            }
            var year = $("#survey_year").val();
            var semi = $("#survey_semi").val();
            
            if (!year || !semi) {
                $("#survey_list_body").html("<tr><td colspan='5' class='empty_table'>년도와 분류를 선택하세요.</td></tr>");
                return;
            }

            $("#survey_list_body").html("<tr><td colspan='5' class='empty_table'>불러오는 중...</td></tr>");

            $.get("./ajax.edu_survey_targets.php", { type: type, year: year, semi: semi }, function(res) {
                if (res.error) {
                    alert(res.error);
                    $("#survey_list_body").html("<tr><td colspan='5' class='empty_table' style='color:#dc3545;'>오류: " + res.error + "</td></tr>");
                    $("#emq_target_ids").val('');
                } else {
                    var html = '';
                    if (res.list && res.list.length > 0) {
                        $.each(res.list, function(idx, item) {
                            html += '<tr>';
                            html += '<td class="td_num_c">' + (idx + 1) + '</td>';
                            html += '<td>' + item.mb_id + '</td>';
                            html += '<td>' + item.mb_name + '</td>';
                            html += '<td>' + (item.mb_email ? item.mb_email : '<span style="color:#dc3545;">이메일 없음</span>') + '</td>';
                            html += '<td>' + item.status + '</td>';
                            html += '</tr>';
                        });
                        $("#emq_target_ids").val(year + '|' + semi);
                    } else {
                        html = "<tr><td colspan='5' class='empty_table'>대상자가 없습니다.</td></tr>";
                        $("#emq_target_ids").val(year + '|' + semi);
                    }
                    $("#survey_list_body").html(html);
                }
            }, "json");
        }
    });

    function feduform_check(f) { 
        <?php echo get_editor_js("emq_content"); ?>

        var type = $("input[name='edu_type']:checked").val();
        if (type == 'cp') {
            var target_ids = $("#emq_target_ids").val();
            if (!target_ids) {
                alert("엑셀 파일을 업로드하여 발송 대상자를 지정해 주세요.");
                return false;
            }
        } else if (type == 'cp_satisfaction' || type == 'cp_ethics' || type == 'cp_pledge') {
            var target_ids = $("#emq_target_ids").val();
            if (!target_ids || target_ids.indexOf('|') === -1) {
                alert("대상자를 조회하여 발송 조건을 지정해 주세요.");
                return false;
            }
        } else {
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
        }

        return true;
    }
</script>

<?php
include_once('./admin.tail.php');
?>