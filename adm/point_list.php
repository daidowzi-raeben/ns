<?php
$sub_menu = "700100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['point_table']} ";

$sql_search = " where (1) and bl_stat = 1 ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "bl_no";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

//List -> No
$strNo = $total_count;

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '마일리지관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$colspan = 16;
?>

<!--<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총회원수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">차단 </span><span class="ov_num"><?php echo number_format($intercept_count) ?>명</span></a>
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">탈퇴  </span><span class="ov_num"><?php echo number_format($leave_count) ?>명</span></a>
</div>-->

<div class="tbl_frm02 tbl_wrap">
    <!--<p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>-->
	<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
	<table>
    <caption><?php echo $g5['title']; ?> 검색</caption>
    <colgroup>
        <col class="grid_4">
        <col>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="mb_year">년도</label></th>
        <td>
            <?php echo get_blYear_select("bl_year") ?>
        </td>
        <th scope="row"><label for="">분류</label></th>
        <td>
			<?php echo get_blCate_select("bl_cate") ?>
		</td>
    </tr>
	<tr>
        <th scope="row"><label for="">소속</label></th>
        <td>
			<?php echo get_blName_select("bl_name") ?>
		</td>
        <th scope="row"><label for="">소속코드</label></th>
        <td>
			<input type="text" name="" id="" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" value="D004" size="15" maxlength="20" />
		</td>
    </tr>
	</tbody>
	</table>
	</form>
</div>

<form name="fmemberlist" id="fmemberlist" action="./belong_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="local_ov02">
	<div class="l_div">
	</div>
	<div class="r_div">
		<?php if ($is_admin == 'super') { ?>
		<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
		<a href="./point_form.php" id="member_add" class="btn btn_03">등록</a>
		<?php } ?>
	</div>
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_chk">
            <label for="chkall" class="sound_only">전체 선택</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" id="mb_list_no">No</a></th>
		<th scope="col" id="mb_list_id">과정항목</a></th>
		<th scope="col" id="mb_list_id">기준</a></th>
		<th scope="col" id="mb_list_id">횟수</a></th>
		<th scope="col" id="mb_list_name">회,건,편 배점</a></th>
		<th scope="col" id="mb_list_id">최대 배점</a></th>
        <th scope="col" id="mb_list_mng">관리</th>
    </tr>
    </thead>
    <tbody>
	
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        
        switch($row['bl_stat']) {
            case 0:
                $bl_stat_val = "탈퇴";
                break;
            case 1:
                $bl_stat_val = "정상";
                break;
            case 2:
                $bl_stat_val = "휴먼";
                break;
            default:
                $bl_stat_val = "";
                break;
        }
		
		$s_mod = '<a href="./belong_form.php?'.$qstr.'&amp;w=u&amp;bl_code='.$row['bl_code'].'" class="btn btn_03">수정</a>';
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="mb_list_chk" class="td_chk">
            <input type="hidden" name="bl_code[<?php echo $i ?>]" value="<?php echo $row['bl_code'] ?>" id="bl_code_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
		<td headers="mb_list_"><?php echo $strNo ?></td>
		<td headers="mb_list_"><?php echo $row['bl_name'] ?></td>
		<td headers="mb_list_"><?php echo $row['bl_year'] ?></td>
		<td headers="mb_list_"><?php echo $row['bl_cate'] ?></td>
		<td headers="mb_list_"><?php echo $row['bl_code'] ?></td>
		<td headers="mb_list_"><?php echo $bl_stat_val ?></td>
		<td headers="mb_list_mng" class="td_mng td_mng_s"><?php echo $s_mod ?></td>
    </tr>
    
    <?php
		$strNo--;
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

// 회원 엑셀 다운로드 추가
function excel_down(f){ 

	f.action = "./memberexcel_down.php";

	f.submit();

	f.action = "";

}
</script>

<?php
include_once ('./admin.tail.php');
?>
