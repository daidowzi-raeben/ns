<?php
$sub_menu = "300100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '추가';
	
	$pc_image_y = 'checked';
	$pc_contents_y = 'checked';
	$pc_contentswin_y = 'checked';
	$pc_ctrbar_y = 'checked';
	$pc_play_time_h = 'checked';
	$pc_admit_time_h = 'checked';
}
else if ($w == 'u')
{
    $pc = get_process($pc_no, "ce");
	
    if (!$pc['pc_no'])
        alert('존재하지 않는 과정자료입니다.');

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $pc['pc_subject'] = get_text($pc['pc_subject']);
	$pc['pc_image_stat'] = get_text($pc['pc_image_stat']);
	$pc['pc_contents_stat'] = get_text($pc['pc_contents_stat']);
	$pc['pc_contentswin_stat'] = get_text($pc['pc_contentswin_stat']);
	$pc['pc_play_time_stat'] = get_text($pc['pc_play_time_stat']);
	$pc['pc_admit_time_stat'] = get_text($pc['pc_admit_time_stat']);
	$pc['pc_point'] = get_text($pc['pc_point']);
	$pc['pc_ctrbar'] = get_text($pc['pc_ctrbar']);
	$pc['pc_over_learn'] = get_text($pc['pc_over_learn']);
	$pc['pc_goal_learn'] = get_text($pc['pc_goal_learn']);
	
	$pc['pc_image_stat'] ? $pc_image_y = "checked" : $pc_image_n = "checked";
	$pc['pc_contents_stat'] ? $pc_contents_y = "checked" : $pc_contents_n = "checked";
	$pc['pc_contentswin_stat'] ? $pc_contentswin_y = "checked" : $pc_contentswin_n = "checked";
	$pc['pc_play_time_stat'] ? $pc_play_time_h = "checked" : $pc_play_time_m = "checked";
	$pc['pc_admit_time_stat'] ? $pc_admit_time_h = "checked" : $pc_admit_time_m = "checked";
	$pc['pc_ctrbar'] ? $pc_ctrbar_y = "checked" : $pc_ctrbar_n = "checked";
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');



$g5['title'] = "e-윤리영상캠페인관리 생성";
include_once('./admin.head.php');

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
add_javascript('<script type="text/javascript" src="'.G5_JS_URL.'/jquery.bpopup.min.js"></script>', 0);
?>

<form name="fmember" id="fmember" action="./process_ce_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="pc_no" value="<?php echo $pc_no ?>">
<input type="hidden" name="token" value="">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="pc_name">과정명<?php echo $sound_only ?></label></th>
        <td>e-윤리영상캠페인</td>
        <th scope="row"><label for="pc_cate">분야(구분)<?php echo $sound_only ?></label></th>
        <td>
			<select name="pc_cate" id="pc_cate">
				<option value="윤리경영">윤리경영</option>
			</select>
		</td>
    </tr>
	<tr>
        <th scope="row"><label for="pc_subject">제목<?php echo $sound_only ?></label></th>
        <td colspan="3">
            <input type="text" name="pc_subject" value="<?php echo $pc['pc_subject'] ?>" id="pc_subject" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="30"  maxlength="30">
        </td>
		<!--<th scope="row"><label for="pc_code">과정코드</label></th>
        <td>
			<input type="text" name="pc_code" value="<?php echo $pc['pc_code'] ?>" id="pc_code" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="30"  maxlength="30">
		</td>-->
    </tr>
	<tr>
        <th scope="row"><label for="pc_date">학습기간<?php echo $sound_only ?></label></th>
        <td colspan="3">
            <input type="text" name="pc_startdate" value="<?php echo $pc['pc_startdate'] ?>" id="pc_startdate" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_password ?>" size="30"  maxlength="30"> ~ 
			<input type="text" name="pc_enddate" value="<?php echo $pc['pc_enddate'] ?>" id="pc_enddate" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_password ?>" size="30"  maxlength="30">
		</td>
    </tr>
	<tr>
		<th scope="row"><label for="pc_img">이미지 크기<?php echo $sound_only ?></label></th>
        <td colspan="2">
			<label for="pc_image">너비 : 1017 px X 높이 : 562 px</label><br />
			<label for="pc_image">* 이미지 크기는 사이버 교육 학습 메인 페이지 이미지 크기이며, 일반적으로 1017*562를 권장합니다.</label>
		</td>
        <td>
			<input type="radio" name="pc_image_stat" value="1" id="pc_image_stat" <?php echo $pc_image_y; ?>>
            <label for="pc_image_y">적용</label>
            <input type="radio" name="pc_image_stat" value="0" id="pc_image_stat" <?php echo $pc_image_n; ?>>
            <label for="pc_image_n">미적용</label>
        </td>
    </tr>
	<tr>
		<th scope="row"><label for="pc_contentswin">콘텐츠 학습창 크기<?php echo $sound_only ?></label></th>
        <td colspan="2">
			<label for="pc_contentswin">너비 : 1280 px X 높이 : 720 px</label><br />
			<label for="pc_contentswin">* 콘텐츠가 열리는 팝업창 크기이며, 일반적으로 1280*720를 권장합니다.</label>
		</td>
        <td>
			<input type="radio" name="pc_contentswin_stat" value="1" id="pc_contentswin_stat" <?php echo $pc_contentswin_y; ?>>
            <label for="pc_contentswin_y">적용</label>
            <input type="radio" name="pc_contentswin_stat" value="0" id="pc_contentswin_stat" <?php echo $pc_contentswin_n; ?>>
            <label for="pc_contentswin_n">미적용</label>
        </td>
    </tr>
	<tr>
		<th scope="row"><label for="pc_contents">콘텐츠 크기<?php echo $sound_only ?></label></th>
        <td colspan="2">
			<label for="pc_contents">너비 : 1280 px X 높이 : 720 px</label><br />
			<label for="pc_contents">* 콘텐츠가 열리는 팝업창 크기이며, 일반적으로 1280*720를 권장합니다.</label>
		</td>
        <td>
			<input type="radio" name="pc_contents_stat" value="1" id="pc_contents_stat" <?php echo $pc_contents_y; ?>>
            <label for="pc_contents_y">적용</label>
            <input type="radio" name="pc_contents_stat" value="0" id="pc_contents_stat" <?php echo $pc_contents_n; ?>>
            <label for="pc_contents_n">미적용</label>
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="pc_contents_url">콘텐츠 주소(URL)<?php echo $sound_only ?></label></th>
        <td colspan="2">
            <input type="text" name="pc_contents_url" value="<?php echo $pc['pc_contents_url'] ?>" id="pc_contents_url" class="frm_input <?php echo $required_mb_password ?>" size="30" maxlength="20"> <br />
			<label for="cp_">* process/ethics 폴더 내</label>
        </td>
		<td>
			<a href="javascript:view_dir();" class="btn btn_02">찾아연결</a>
			<a href="javascript:view_priview();" class="btn btn_01">미리보기</a>
        </td>
    </tr>
	<tr>
		<th scope="row"><label for="pc_play_time">구동시간<?php echo $sound_only ?></label></th>
        <td>
			<input type="text" name="pc_play_time" value="<?php echo $pc['pc_play_time'] ?>" id="pc_play_time" class="frm_input <?php echo $required_mb_password ?>" size="30" maxlength="20">
			<input type="radio" name="pc_play_time_stat" value="1" id="pc_play_time_stat" <?php echo $pc_play_time_h; ?>>
            <label for="pc_play_time_h">시간</label>
            <input type="radio" name="pc_play_time_stat" value="0" id="pc_play_time_stat" <?php echo $pc_play_time_m; ?>>
            <label for="pc_play_time_m">분</label>
		</td>
        <th scope="row"><label for="pc_admit_time">인정시간<?php echo $sound_only ?></label></th>
        <td>
			<input type="text" name="pc_admit_time" value="<?php echo $pc['pc_admit_time'] ?>" id="pc_admit_time" class="frm_input <?php echo $required_mb_password ?>" size="30" maxlength="20">
			<input type="radio" name="pc_admit_time_stat" value="1" id="pc_admit_time_stat" <?php echo $pc_admit_time_h; ?>>
            <label for="pc_admit_time_h">시간</label>
            <input type="radio" name="pc_admit_time_stat" value="0" id="pc_admit_time_stat" <?php echo $pc_admit_time_m; ?>>
            <label for="pc_admit_time_m">분</label>
        </td>
    </tr>
	<tr>
		<th scope="row"><label for="pc_ctrbar">콘트롤바 활성<?php echo $sound_only ?></label></th>
        <td>
			<input type="radio" name="pc_ctrbar" value="1" id="pc_ctrbar" <?php echo $pc_ctrbar_y; ?>>
            <label for="pc_ctrbar_y">활성</label>
            <input type="radio" name="pc_ctrbar" value="0" id="pc_ctrbar" <?php echo $pc_ctrbar_n; ?>>
            <label for="pc_ctrbar_n">비활성</label>
		</td>
        <th scope="row"><label for="pc_point">마일리지<?php echo $sound_only ?></label></th>
        <td>
			<input type="text" name="pc_point" value="<?php echo $pc['pc_point'] ?>" id="pc_point" class="frm_input <?php echo $required_mb_password ?>" size="30" maxlength="20"> 점
        </td>
    </tr>
	<tr>
		<th scope="row"><label for="pc_over_learn">학습개요<?php echo $sound_only ?></label></th>
        <td colspan="3">
			<textarea name="pc_over_learn" id="pc_over_learn"><?php echo $config['pc_over_learn'] ?></textarea>
		</td>
    </tr>
	<tr>
		<th scope="row"><label for="pc_goal_learn">학습목표<?php echo $sound_only ?></label></th>
        <td colspan="3">
			<textarea name="pc_goal_learn" id="pc_goal_learn"><?php echo $config['pc_goal_learn'] ?></textarea>
		</td>
    </tr>

    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./process_ce_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="저장" class="btn btn_03" accesskey='s'>
</div>

<div id="popup_win" class="pop-layer bPopup">  
	<div class="popup_container" id="popup_container">
		test
	</div>
</div>
</form>

<script>
$( function() {
	$( "#pc_startdate, #pc_enddate" ).datepicker();
	$( "#popup_win" ).hide();
} );

function fmember_submit(f)
{
    if (!f.mb_icon.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_icon.value) {
        alert('아이콘은 이미지 파일만 가능합니다.');
        return false;
    }

    if (!f.mb_img.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img.value) {
        alert('회원이미지는 이미지 파일만 가능합니다.');
        return false;
    }

    return true;
}

function view_dir(dir) {
	var datas = "";
	if( dir != undefined ) {
		datas = "dir=" + dir;
		alert(dir);
	}
	$("#popup_win").bPopup();
	//$( "#popup_win" ).show( "blind");
	
	$.ajax({
		type: "POST",
		url: "./ajax.process_ce_dir.php",
		data :  datas,
		success: function(res){
			$("#popup_container").html("");
			var res_info = $.parseJSON( res );
			if( res_info.result == true ){	
				for(i=0;i<=res_info.directory.length-1;i++){
						var new_directory = '<div rel_code="'+res_info.directory[i]+'" style="padding:10px;cursor:pointer;width:100px;display: inline-block;"><span onclick="view_dir(\''+res_info.directory[i]+'\')">'+res_info.directory[i]+'</span><input type="button" value="선택" class="btn btn_03" onclick="select_dir(\''+res_info.directory[i]+'\')"/></div>';
						$("#popup_container").append(new_directory);
				}
				
				
			} else {
				//alert( $("#pannel_dept2 div").length );
			}
		},
		error: function(err){ alert("호출 실패하였습니다.") ;}
	});
}

function select_dir(url) {
	$("#pc_contents_url").val(url);
	$("#popup_win").bPopup().close();
}

function view_priview() {
	var v_dir = $("#pc_contents_url").val();
	//var size_w = $("#size_w").val();
	//var size_h = $("#size_h").val();
	var size_w = 1280;
	var size_h = 720;
	
	if( v_dir.length > 0 ) {	
			window.open("<?php echo G5_URL ?>/process/ethics/"+ v_dir +"/01/01.htm","content_preview","width="+size_w+"px,height="+size_h+"px");
	} else {
			alert("URL 입력후 미리보기가 가능합니다.")
	}
}
</script>

<?php
include_once('./admin.tail.php');
?>
