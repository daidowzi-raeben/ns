<?php
$sub_menu = "300110";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['compliance_table']} ";

$sql_search = " where (1) ";
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
    $sst = "pc_no";
    $sod = "asc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$startNum = 1 + (($page-1) * 15);


$g5['title'] = 'e_준법퀴즈캠페인관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>

<div class="tbl_frm02 tbl_wrap">
    <!--<p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>-->
	<form id="fsearch" name="fsearch" class="local_sch01 local_sch11" method="get">
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
        <th scope="row"><label for="mb_year">카테고리</label></th>
        <td>
            <select>
				<option value="">사이버 및 집합교육</option>
			</select>
        </td>
        <th scope="row"><label for="">분야(구분)</label></th>
        <td>
			<select>
				<option value="">준법경영</option>
			</select>
		</td>
    </tr>
	<tr>
		<th scope="row"><label for="mb_stat">과정명</label></th>
		<td colspan="3">
			<select>
				<option value="">e_준법교육 캠페인</option>
			</select>
		</td>
	</tr>
	</tbody>
	</table>
	<div class="sch_div">
		<input type="submit" class="btn btn_02" value="검색">
	</div>
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
		<a href="./process_cp_form.php" id="member_add" class="btn btn_03">등록</a>
		<?php } ?>
	</div>
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="cp_list_no">No</a></th>
		<th scope="col" id="cp_list_id">분야</th>
		<th scope="col" id="cp_list_id">제목</th>
		<th scope="col" id="cp_list_id">학습기간</th>
		<th scope="col" id="cp_list_id">활성유무</th>
        <th scope="col" id="cp_list_mng">수정</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        
        if ($is_admin == 'group') {
            $s_mod = '';
        } else {
            $s_mod = '<a href="./process_cp_form.php?'.$qstr.'&amp;w=u&amp;pc_no='.$row['pc_no'].'" class="btn btn_03">수정</a>';
        }
        
        $p_subject = $row['pc_subject'];
		$p_startdate = $row['pc_startdate'];
		$p_enddate = $row['pc_enddate'];
		$p_ctrbar = $row['pc_ctrbar'];
		$p_url = $row['pc_contents_url'];
		
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="cp_list_" rowspan="2" ><?php echo $startNum; ?></td>
		<td headers="cp_list_">준법경영</td>
		<td headers="cp_list_"><?php echo $p_subject; ?></td>
		<td headers="cp_list_"><?php echo $p_startdate; ?> ~ <?php echo $p_enddate; ?></td>
		<td headers="cp_list_"><?php echo $p_ctrbar?"활성":"비활성"; ?></td>
		<td headers="cp_list_" class="td_mng td_mng_s" rowspan="2"><?php echo $s_mod; ?></td>
    </tr>
	<tr class="<?php echo $bg; ?>">
		<td headers="cp_list_">파일위치</td>
		<td headers="cp_list_" colspan="2">process/compliance/<?php echo $p_url?></td>
		<td headers="cp_list_"><a href="javascript:view_priview('<?php echo $p_url?>');" class="btn btn_01">미리보기</a></td>
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


function view_priview(v_dir) {
	
	var size_w = 1280;
	var size_h = 720;
	
	if( v_dir.length > 0 ) {	
			window.open("<?php echo G5_URL ?>/process/compliance/"+v_dir+"/01/01.htm","content_preview","width="+size_w+"px,height="+size_h+"px");
	} else {
			alert("URL 입력후 미리보기가 가능합니다.")
	}
}
</script>

<?php
include_once ('./admin.tail.php');
?>
