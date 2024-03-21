<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
	$required_bl_code = 'readonly';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '추가';
	
	$bl['bl_code'] = get_belong_code();
}
else if ($w == 'u')
{
    $bl = get_belong($bl_code);
	
    if (!$bl['bl_code'])
        alert('존재하지 않는 소속자료입니다.');

    if ($is_admin != 'super')
        alert('권한이 없습니다.');

    $required_mb_id = 'readonly';
	$required_bl_code = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $bl['bl_year'] = get_text($bl['bl_year']);
	$bl['bl_cate'] = get_text($bl['bl_cate']);
	$bl['bl_name'] = get_text($bl['bl_name']);
	$bl['bl_stat'] = get_text($bl['bl_stat']);
	
	switch($bl['bl_stat']) {
		case "0":
			$bl_stat_l = "checked";
			break;
		case "1":
			$bl_stat_n = "checked";
			break;
		case "2":
			$bl_stat_h = "checked";
			break;
	}
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


if ($mb['mb_intercept_date']) $g5['title'] = "차단된 ";
else $g5['title'] .= "";
$g5['title'] .= '소속 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<form name="fmember" id="fmember" action="./belong_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
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
        <th scope="row"><label for="bl_year">년도<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="bl_year" value="<?php echo $bl['bl_year'] ?>" id="bl_year" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_password ?>" size="30"  maxlength="20">
        </td>
        <th scope="row"><label for="bl_cate">분류<?php echo $sound_only ?></label></th>
        <td><input type="text" name="bl_cate" value="<?php echo $bl['bl_cate'] ?>" id="bl_cate" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_password ?>" size="30" maxlength="20"></td>
    </tr>
	<tr>
        <th scope="row"><label for="bl_name">소속<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="bl_name" value="<?php echo $bl['bl_name'] ?>" id="bl_name" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_password ?>" size="30"  maxlength="20">
        </td>
        <th scope="row"><label for="bl_code">소속코드<?php echo $sound_only ?></label></th>
        <td><input type="text" name="bl_code" id="bl_code" value="<?php echo $bl['bl_code'] ?>" class="frm_input <?php echo $required_mb_password ?>" size="30" maxlength="20" <?php echo $required_bl_code ?>></td>
    </tr>
    <tr>
        <th scope="row"><label for="bl_stat">상태<strong class="sound_only">필수</strong></label></th>
        <td colspan="3">
            <input type="radio" name="bl_stat" value="1" id="bl_stat" <?php echo $bl_stat_n; ?>>
            <label for="bl_stat_n">정상</label>
            <input type="radio" name="bl_stat" value="2" id="bl_stat" <?php echo $bl_stat_h; ?>>
            <label for="bl_stat_h">휴먼</label>
			<input type="radio" name="bl_stat" value="0" id="bl_stat" <?php echo $bl_stat_l; ?>>
            <label for="bl_stat_l">탈퇴</label>
        </td>
    </tr>

    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./belong_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="등록" class="btn btn_03" accesskey='s'>
</div>
</form>

<script>
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
</script>

<?php
include_once('./admin.tail.php');
?>
