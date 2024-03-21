<?php
$sub_menu = "600700";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} as m ";
$sql_common .= " left join {$g5['belong_table']} as b ";
$sql_common .= " on m.bl_no = b.bl_no ";

$sql_search = " where (1) and m.mb_level = '1' ";

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
#echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$startNum = 1 + (($page-1) * $config['cf_page_rows']);


$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '윤리/준법/정보보호서약관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
#echo $sql;
$result = sql_query($sql);

$colspan = 16;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/es6-promise/4.1.1/es6-promise.auto.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<!--<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총회원수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">차단 </span><span class="ov_num"><?php echo number_format($intercept_count) ?>명</span></a>
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">탈퇴  </span><span class="ov_num"><?php echo number_format($leave_count) ?>명</span></a>
</div>-->

<div class="tbl_frm02 tbl_wrap" style="text-align:center;">
    <?php include_once('./admin.fsearch2.php'); ?>
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
		<a href="./pldexcel_down2.php?pld_year=<?php echo $bl_year ?>&amp;pld_semi=<?php echo $bl_cate ?>&amp;sfl=<?php echo $sfl ?>&amp;str=1" target="_blank" id="member_add" class="btn btn_04">EXCEL</a>
		<?php } ?>
	</div>
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_no">No</th>
		<th scope="col" id="mb_list_id">이름</th>
		<th scope="col" id="mb_list_id">아이디</th>
		<th scope="col" id="mb_list_id">부서명</th>
		<th scope="col" id="mb_list_name">서약서 작성날짜</th>
		<th scope="col" id="mb_list_id">서약서 작성여부</th>
		<th scope="col" id="mb_list_id">서약서</th>
    </tr>
    </thead>
    <tbody>
    <?php
	#년도, 분기값 설정
	#$bl_year = "2021";
	#$bl_cate = "A";
	
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $mb_id = $row['mb_id'];
		
		$sql2 = " select * from sj_prs_pledge where mb_id = '{$row['mb_id']}' and pld_flag = '0' and pld_year='$bl_year' and pld_semi='$bl_cate' limit 0, 1 ";
		$row2 = sql_fetch($sql2);
		
		$strWrite 	= $row2['pld_no'] ? "작성" : "미작성";
		$strBtn 	= $row2['pld_no'] ? "<input type='button' value='출력' class='btn btn_01' pid='{$row['mb_id']}' p_year='{$bl_year}' p_semi='{$bl_cate}' />" : "";
    ?>

    <tr class="<?php echo $bg; ?>">
		<td headers="mb_list_"><?php echo $startNum ?></td>
		<td headers="mb_list_name" class="td_mbname2"><?php echo get_text($row['mb_name']); ?></td>
		<td headers="mb_list_id" class="td_name2">
            <?php echo $mb_id ?>
        </td>  
		<td headers="mb_list_"><?php echo get_text($row['mb_4']); ?></td>
		<td headers="mb_list_"><?php echo substr($row2['pld_regdate'], 0, 10) ?></td>
		<td headers="mb_list_"><?php echo $strWrite?></td>
		<td headers="mb_list_"><?php echo $strBtn?></td>
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
$(function(){
  	$(".btn_01").on("click",function(){
		var pid = $(this).attr("pid");
		var p_year = $(this).attr("p_year");
		var p_semi = $(this).attr("p_semi");
		//alert($(this).attr("pid"));
		window.open('/temp/test_print.php?pid=' + pid + '&p_year=' + p_year + '&p_semi=' + p_semi , 'pdf print', 'width=680, height=700');
  	});
});
</script>

<?php
include_once ('./admin.tail.php');
?>
