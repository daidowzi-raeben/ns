<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="./'.$board['bo_skin'].'/style.css">', 0);

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
?>

<section id="bo_w">
    
    <header>
        <h2 id="bo_v_title">
            <span class="bo_v_tit">
            <?php
            echo cut_str(get_text($board['bo_subject']), 70); // 글제목 출력
            ?></span>
        </h2>
    </header>

    <h2 class="sound_only"><?php echo $g5['title'] ?></h2>

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">

	
	<div class="tbl_frm01 tbl_wrap">
        <table>
        <tbody>
        <?php if ($is_name) { ?>
        <tr>
            <th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_password) { ?>
        <tr>
            <th scope="row"><label for="wr_password">패스워드<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_email) { ?>
        <tr>
            <th scope="row"><label for="wr_email">이메일</label></th>
            <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email" size="50" maxlength="100"></td>
        </tr>
        <?php } ?>

        <?php if ($is_homepage) { ?>
        <tr>
            <th scope="row"><label for="wr_homepage">홈페이지</label></th>
            <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" size="50"></td>
        </tr>
        <?php } ?>

        <?php if ($option) { ?>
        <tr>
            <th scope="row">옵션</th>
            <td><?php echo $option ?></td>
        </tr>
        <?php } ?>

        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
            <td>
                <select name="ca_name" id="ca_name" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>
            </td>
        </tr>
        <?php } ?>

        <tr>
            <th scope="row"><label for="wr_subject">집합교육명<strong class="sound_only">필수</strong></label></th>
            <td colspan="3">
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" size="50" maxlength="255">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_content">집합교육내용<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content" colspan="3">
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
                <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?>
            </td>
        </tr>
		
		<tr>
			<th scope="row"><label for="wr_1">교육일자<strong class="sound_only">필수</strong></label></th>
			<td>
				<input type="text" name="wr_1" value="<?php echo $write['wr_1']; ?>" readonly id="wr_1" required class="frm_input required" size="50" maxlength="8">
			</td>
			<th scope="row"><label for="wr_2">장소<strong class="sound_only">필수</strong></label></th>
			<td>
				<input type="text" name="wr_2" value="<?php echo $write['wr_2']; ?>" required class="frm_input required" size="50" maxlength="30">
			</td>
		</tr>
		
		<tr>
			<th scope="row" rowspan="2"><label for="wr_3">교육시간<strong class="sound_only">필수</strong></label></th>
			<td rowspan="2">
				<select name="wr_3" style="width:75px;">
				<?php
					for($i=0; $i<25; $i++) {
						if($write['wr_3'] == $i)
							$strSel = " selected";
						else 
							$strSel = "";
				?>
					<option value="<?php echo $i;?>"<?php echo $strSel ?>><?php printf("%02d", $i);?>시</option>
				<?php 
					}
				?>
				</select>
				
				<select name="wr_4" style="width:75px;">
				<?php
					for($i=0; $i<61; $i=$i+5) {
						$strSel = $write['wr_4'] == $i ? " selected" : "";
				?>
					<option value="<?php echo $i;?>"<?php echo $strSel ?>><?php printf("%02d", $i);?>분</option>
				<?php 
					}
				?>
				</select>
				~
				<select name="wr_5" style="width:75px;">
				<?php
					for($i=0; $i<25; $i++) {
						$strSel = $write['wr_5'] == $i ? " selected" : "";
				?>
					<option value="<?php echo $i;?>"<?php echo $strSel ?>><?php printf("%02d", $i);?>시</option>
				<?php 
					}
				?>
				</select>
				
				<select name="wr_6" style="width:75px;">
				<?php
					for($i=0; $i<61; $i=$i+5) {
						$strSel = $write['wr_6'] == $i ? " selected" : "";
				?>
					<option value="<?php echo $i;?>"<?php echo $strSel ?>><?php printf("%02d", $i);?>분</option>
				<?php 
					}
				?>
				</select>
			</td>
			<th scope="row"><label for="wr_10">대상<strong class="sound_only">필수</strong></label></th>
			<td>
				<input type="text" name="wr_10" value="<?php echo $write['wr_10']; ?>" required class="frm_input required" size="50" maxlength="30">
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="wr_7">회차<strong class="sound_only">필수</strong></label></th>
			<td>
				<select name="wr_7" style="width:322px;">
				<?php
					for($i=1; $i<21; $i++) {
				?>
					<option value="<?php echo $i;?>"><?php echo $i;?>회</option>
				<?php 
					}
				?>
				</select>
			</td>
		</tr>
		
		
		<tr>
			<th scope="row"><label for="wr_8">주관부서<strong class="sound_only">필수</strong></label></th>
			<td>
				<input type="text" name="wr_8" value="<?php echo $write['wr_8']; ?>" required class="frm_input required" size="50" maxlength="30">
			</td>
			<th scope="row"><label for="wr_9">담당<strong class="sound_only">필수</strong></label></th>
			<td>
				<input type="text" name="wr_9" value="<?php echo $write['wr_9']; ?>" required class="frm_input required" size="50" maxlength="30">
			</td>
		</tr>


        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
	</div>

    <?php if ($is_category) { ?>
    <div class="bo_w_select write_div">
        <label for="ca_name"  class="sound_only">분류<strong>필수</strong></label>
        <select name="ca_name" id="ca_name" required>
            <option value="">분류를 선택하세요</option>
            <?php echo $category_option ?>
        </select>
    </div>
    <?php } ?>


    <?php if ($is_use_captcha) { //자동등록방지  ?>
    <div class="write_div">
        <?php echo $captcha_html ?>
    </div>
    <?php } ?>

    <div class="btn_fixed_top">

        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn btn_02">취소</a>
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit btn">

    </div>

    </form>
	
    <script>
	$(function(){ // 날짜 입력
		$("#wr_1, #wr_2").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yymmdd", showButtonPanel: true }); 
	});
	
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->