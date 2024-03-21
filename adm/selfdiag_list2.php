<?php
$sub_menu = "600210";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_point_table']} as mp ";
$sql_common .= " left join {$g5['member_table']} as m ";
$sql_common .= " on mp.mb_no = m.mb_no ";

$sql_search = " where (1) and m.mb_level = '1' and mp.mp_year = '$bl_year' and mp.mp_semi = '$bl_cate'";

if ($mb_4)
	$sql_search .= " and m.mb_4 like '{$mb_4}%' ";

if ($mb_id)
	$sql_search .= " and m.mb_id like '{$mb_id}%' ";

if ($mb_name)
	$sql_search .= " and m.mb_name like '{$mb_name}%' ";

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

$startNum = 1 + (($page-1) * 10);


$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '준법실천자가진단';
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

<div class="tbl_frm02 tbl_wrap" style="text-align:center;">
    <?php include_once('./admin.fsearch.php'); ?>
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
		
	</div>
	<div class="r_div">
		<?php if ($is_admin == 'super' || $is_admin == 'manager') { ?>
		<a href="./selfdiag2_excel_down.php?sfl=<?php echo $sfl ?>&amp;str=1&amp;bl_year=<?php echo $bl_year?>&amp;bl_cate=<?php echo $bl_cate?>" target="_blank" id="member_add" class="btn btn_04">EXCEL</a>
		<?php } ?>
	</div>
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_no" rowspan="2">No</th>
		<th scope="col" id="mb_list_id" rowspan="2">이름</th>
		<th scope="col" id="mb_list_id" rowspan="2">아이디</th>
		<th scope="col" id="mb_list_id" rowspan="2">부서명</th>
		<th scope="col" id="mb_list_id" rowspan="2">자가진단시작일</th>
		<th scope="col" id="mb_list_id" rowspan="2">자가진단종료일</th>
		<th scope="col" id="mb_list_name" colspan="2">회차</th>
		<th scope="col" id="mb_list_id" rowspan="2">적용마일리지</th>
		<th scope="col" id="mb_list_id" rowspan="2">획득마일리지</th>
		<th scope="col" id="mb_list_id" rowspan="2">마일리지 합계</th>
    </tr>
	<tr>
		<th scope="col" id="mb_list_name">1회</th>
		<th scope="col" id="mb_list_name">2회</th>
	</tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        // 접근가능한 그룹수
		$sql2 = " select * from {$g5['point_table']} where mb_id = '{$row['mb_id']}' and po_rel_table = 'self2' and po_year = '$bl_year' and po_semi = '$bl_cate' limit 0, 1 ";
		$row2 = sql_fetch($sql2);
		$sql2 = " select * from {$g5['point_table']} where mb_id = '{$row['mb_id']}' and po_rel_table = 'self2' and po_year = '$bl_year' and po_semi = '$bl_cate' limit 1, 1 ";
		$row3 = sql_fetch($sql3);
		
        $mb_id = $row['mb_id'];
    ?>

    <tr class="<?php echo $bg; ?>">
		<td headers="mb_list_"><?php echo $startNum ?></td>
		<td headers="mb_list_name" class="td_mbname2"><?php echo get_text($row['mb_name']); ?></td>
		<td headers="mb_list_id" class="td_name2">
            <?php echo $mb_id ?>
        </td>  
		<td headers="mb_list_"><?php echo get_text($row['mb_4']); ?></td>
		<td headers="mb_list_"><?php echo substr($row2['po_datetime'], 0, 10) ?></td>
		<td headers="mb_list_"><?php echo substr($row3['po_datetime'], 0, 10) ?></td>
		<td headers="mb_list_"><?php echo get_text($row2['po_point']); ?></td>
		<td headers="mb_list_"><?php echo get_text($row3['po_point']); ?></td>
		<td headers="mb_list_">10</td>
		<td headers="mb_list_"><?php echo get_text($row['mp_6']); ?></td>
		<td headers="mb_list_"><?php echo get_text($row['mp_point']); ?></td>
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

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.$NSqstr.'&amp;page='); ?>

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
