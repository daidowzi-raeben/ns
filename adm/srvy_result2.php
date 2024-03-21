<?php
include_once('./_common.php');

if($type == "B")
{
	$sub_menu = "600610";
	$g5['title'] = '윤리CP인식도조사관리';
	$btnTitle = "윤리CP인식도조사";
	$cntQ = 15;
	//$bl_year = "2021";
	//$bl_cate = "A";
}
else
{
	$sub_menu = "600600";
	$g5['title'] = 'CP교육만족도조사관리';
	$btnTitle = "CP교육만족도조사";
	$cntQ = 9;
	#년도, 분기값 설정
	//$bl_year = "2021";
	//$bl_cate = "A";
}

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} as m ";
$sql_common .= " left join {$g5['survey_data_table']} as sd ";
$sql_common .= " on m.mb_id = sd.srvd_uid and sd.srvy_type = '{$type}' and sd.srvy_year='$bl_year' and sd.srvy_semi = '$bl_cate' ";

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
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$startNum = 1 + (($page-1) * 15);


$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';


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
    <?php include_once('./admin.fsearch2.php'); ?>
</div>

<div class="local_ov02">
	<div class="l_div">
		<a href="srvy_result.php?type=<?php echo $type . $NSqstr?>" class="btn btn_02"><?php echo $btnTitle ?> 진도관리</a>
		<a href="#" class="btn btn_03"><?php echo $btnTitle ?> 설문데이터</a>
	</div>
	<div class="r_div">
		<?php if ($is_admin == 'super' || $is_admin == 'manager') { ?>
		<a href="./srvy_excel_down.php?type=<?php echo $type . $NSqstr?>&amp;str=2" target="_blank" id="member_add" class="btn btn_04">EXCEL</a>
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
		<th scope="col" id="mb_list_id" rowspan="2">설문조사 작성일</th>
		<th scope="col" id="mb_list_name" colspan="<?php echo $cntQ?>">조사결과</th>
    </tr>
	<tr>
	<?php
	for($i=1; $i<=$cntQ;$i++) {
	?>
		<th scope="col" id="mb_list_name">Q<?php echo $i?></th>
	<?php
	}
	?>
	</tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $mb_id = $row['mb_id'];
		$mb_name = $row['mb_name'];
		
		$ar_data = explode('#', $row['srvd_ex']);
    ?>

    <tr class="<?php echo $bg; ?>">
		<td headers="cb_list"><?php echo $startNum ?></td>
		<td headers="cb_list_name" class="td_name2">
            <?php echo $mb_name ?>
        </td>  
		<td headers="cb_list_"><?php echo $mb_id ?></td>
		<td headers="cb_list_"><?php echo get_text($row['mb_4']); ?></td>
		<td headers="cb_list_"><?php echo substr($row['srvd_rdate'], 0, 10) ?></td>
		<?php
		for($i=0; $i<$cntQ;$i++) {
		?>
			<td headers="cb_list_"><?php echo $ar_data[$i] ?></td>
		<?php
		}
		?>
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

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.$NSqstr.'&amp;page='); ?>

<?php
include_once ('./admin.tail.php');
?>
