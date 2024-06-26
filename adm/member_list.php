<?php
$sub_menu = "100100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} as m ";
$sql_common .= " left join {$g5['belong_table']} as b ";
$sql_common .= " on m.bl_no = b.bl_no ";

$sql_search = " where (1) and m.mb_level = '1' ";
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
    $sst = "mb_datetime";
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

$startNum = 1 + (($page-1) * $rows);

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '회원관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
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
		<th scope="row"><label for="">소속</label></th>
        <td>
			<?php echo get_blName_select("bl_name") ?>
		</td>
        <!--<th scope="row"><label for="">분류</label></th>
        <td>
			<?php echo get_blCate_select("bl_cate") ?>
		</td>-->
    </tr>
	<tr>
        <th scope="row"><label for="mb_year">회원유형</label></th>
        <td colspan="3">
            <input type="radio" name="mb_1" value="" id="mb_1" <?php echo $mb_1_all; ?>>
            <label for="mb_1_all">전체</label>
			<input type="radio" name="mb_1" value="C" id="mb_1" <?php echo $mb_1_c; ?>>
            <label for="mb_1_c">기업</label>
            <input type="radio" name="mb_1" value="N" id="mb_1" <?php echo $mb_1_n; ?>>
            <label for="mb_1_n">일반</label>
        </td>
    </tr>
	<tr>
		<th scope="row"><label for="mb_stat">상태</label></th>
		<td colspan="3">
			<input type="radio" name="mb_stat" value="" id="mb_stat" <?php echo $mb_1_all; ?>>
            <label for="mb_stat_all">전체</label>
			<input type="radio" name="mb_stat" value="N" id="mb_stat" <?php echo $mb_1_c; ?>>
            <label for="mb_stat_n">정상</label>
            <input type="radio" name="mb_stat" value="S" id="mb_stat" <?php echo $mb_1_n; ?>>
            <label for="mb_stat_s">중지</label>
			<input type="radio" name="mb_stat" value="L" id="mb_stat" <?php echo $mb_1_n; ?>>
            <label for="mb_stat_l">탈퇴</label>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_year">검색</label></th>
		<td colspan="3">
			<label for="sfl" class="sound_only">검색대상</label>
			<select name="sfl" id="sfl">
				<option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
				<option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
				<option value="mb_2"<?php echo get_selected($_GET['sfl'], "mb_2"); ?>>부서1</option>
				<option value="mb_3"<?php echo get_selected($_GET['sfl'], "mb_3"); ?>>부서2</option>
				<option value="mb_4"<?php echo get_selected($_GET['sfl'], "mb_4"); ?>>부서3</option>
				<!--<option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
				<option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
				<option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
				<option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
				<option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
				<option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
				<option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
				<option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
				<option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>-->
			</select>
			<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
			<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
			<input type="submit" class="btn_submit" value="검색">
		</td>
	</tr>
	</tbody>
	</table>
	</form>
</div>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="local_ov02">
	<div class="l_div">
		<span class="btn_ov01"><span class="ov_txt">Total </span><span class="ov_num"> <?php echo number_format($total_count) ?> 건 </span></span>
	</div>
	<div class="r_div">
		<?php if ($is_admin == 'super') { ?>
		<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
		<a href="./memberexcel_down.php?sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>&amp;year=<?php echo get_text($bl_year); ?>" onclick="return excel_down(f);" target="_blank" id="member_add" class="btn btn_04">전체EXCEL</a>
		<a href="./member_excel_form.php" id="member_add" class="btn btn_01">회원일괄등록</a>
		<a href="./member_form.php" id="member_add" class="btn btn_03">회원추가</a>
		<?php } ?>
	</div>
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_chk">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" id="mb_list_no">No</a></th>
		<th scope="col" id="mb_list_id"><?php echo subject_sort_link('bl_year') ?>년도</a></th>
		<th scope="col" id="mb_list_id">분류</a></th>
		<th scope="col" id="mb_list_id">소속</a></th>
		<th scope="col" id="mb_list_name"><?php echo subject_sort_link('mb_name') ?>이름</a></th>
		<th scope="col" id="mb_list_id"><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
		<th scope="col" id="mb_list_id"><?php echo subject_sort_link('mb_2') ?>부서1</a></th>
		<th scope="col" id="mb_list_id"><?php echo subject_sort_link('mb_3') ?>부서2</a></th>
		<th scope="col" id="mb_list_id"><?php echo subject_sort_link('mb_4') ?>부서3</a></th>
		<th scope="col" id="mb_list_join"><?php echo subject_sort_link('mb_datetime', '', 'desc') ?>가입일</a></th>
		<th scope="col" id="mb_list_lastcall"><?php echo subject_sort_link('mb_today_login', '', 'desc') ?>최종접속</a></th>
		<th scope="col" id="mb_list_id">학습기간</a></th>
		<th scope="col" id="mb_list_point"><?php echo subject_sort_link('mb_point', '', 'desc') ?> 마일리지</a></th>
		<th scope="col" id="mb_list_id"><?php echo subject_sort_link('mb_id') ?>수료유무</a></th>
		<th scope="col" id="mb_list_id"><?php echo subject_sort_link('mb_id') ?>상태</a></th>
        <th scope="col" id="mb_list_mng">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        // 접근가능한 그룹수
        $sql2 = " select count(*) as cnt from {$g5['group_member_table']} where mb_id = '{$row['mb_id']}' ";
        $row2 = sql_fetch($sql2);
        $group = '';
        if ($row2['cnt'])
            $group = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">'.$row2['cnt'].'</a>';

        if ($is_admin == 'group') {
            $s_mod = '';
        } else {
            $s_mod = '<a href="./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'" class="btn btn_03">수정</a>';
        }
        $s_grp = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'" class="btn btn_02">그룹</a>';

        $leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
        $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);

        $mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);

        $mb_id = $row['mb_id'];
        $leave_msg = '';
        $intercept_msg = '';
        $intercept_title = '';
        if ($row['mb_leave_date']) {
            $mb_id = $mb_id;
            $leave_msg = '<span class="mb_leave_msg">탈퇴함</span>';
        }
        else if ($row['mb_intercept_date']) {
            $mb_id = $mb_id;
            $intercept_msg = '<span class="mb_intercept_msg">차단됨</span>';
            $intercept_title = '차단해제';
        }
        if ($intercept_title == '')
            $intercept_title = '차단하기';

        $address = $row['mb_zip1'] ? print_address($row['mb_addr1'], $row['mb_addr2'], $row['mb_addr3'], $row['mb_addr_jibeon']) : '';

        $bg = 'bg'.($i%2);

        switch($row['mb_certify']) {
            case 'hp':
                $mb_certify_case = '휴대폰';
                $mb_certify_val = 'hp';
                break;
            case 'ipin':
                $mb_certify_case = '아이핀';
                $mb_certify_val = '';
                break;
            case 'admin':
                $mb_certify_case = '관리자';
                $mb_certify_val = 'admin';
                break;
            default:
                $mb_certify_case = '&nbsp;';
                $mb_certify_val = 'admin';
                break;
        }
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="mb_list_chk" class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
		<td headers="mb_list_"><?php echo $startNum ?></td>
		<td headers="mb_list_"><?php echo get_text($bl_year); ?></td>
		<td headers="mb_list_"><?php echo get_text($row['bl_cate']); ?></td>
		<td headers="mb_list_"><?php echo get_text($row['bl_name']); ?></td>
        <td headers="mb_list_name" class="td_mbname2"><?php echo get_text($row['mb_name']); ?></td>
		<td headers="mb_list_id" class="td_name2">
            <?php echo $mb_id ?>
        </td>
		<td headers="mb_list_"><?php echo get_text($row['mb_2']); ?></td>
		<td headers="mb_list_"><?php echo get_text($row['mb_3']); ?></td>
		<td headers="mb_list_"><?php echo get_text($row['mb_4']); ?></td>
		<td headers="mb_list_join" class="td_date"><?php echo substr($row['mb_datetime'],2,8); ?></td>
		<td headers="mb_list_lastcall" class="td_date"><?php echo substr($row['mb_today_login'],2,8); ?></td>
		<td headers="mb_list_"><?php echo date("y-m-d", strtotime($row['mb_8'])); ?> ~ <?php echo date("y-m-d", strtotime($row['mb_9'])); ?></td>
		<td headers="mb_list_point" class="td_num"><a href="point_list.php?sfl=mb_id&amp;stx=<?php echo $row['mb_id'] ?>"><?php echo number_format($row['mb_point']) ?></a></td>
		<td headers="mb_list_"></td>
		<td headers="mb_list_"></td>
		<td headers="mb_list_mng" class="td_mng td_mng_s"><?php echo $s_mod ?></td>
    </tr>
    <?php
		$startNum++;
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
