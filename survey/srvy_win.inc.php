<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$sql = " select * from {$g5['survey_table']}
          where '".G5_TIME_YMDHIS."' between date_format(srvy_sdate, '%Y-%m-%d 05:59:59') and date_format(srvy_edate, '%Y-%m-%d 18:00:00')
			and srvy_type = 'A' and srvy_status = 'Y'
          order by srvy_code asc limit 1";
//echo $sql;
$result = sql_fetch($sql, false);

if($result['srvy_code'])
{
?>

	<!-- 팝업레이어 시작 { -->
	<script>
	var pop_url = "<?php echo $result['srvy_link']?>";

	function srvyWin()
	{
		var popupX = '<?php echo $result['srvy_coord_x']?>';
		var popupY = '<?php echo $result['srvy_coord_y']?>';
		var ret = window.open("/survey/form/" + pop_url, "popwin2", "status=0, width=810, height=870, left=" + popupX);
	}
	</script>
	<!-- } 팝업레이어 끝 -->
	<?php
	$sql = " select count(srvd_no) as cnt from {$g5['survey_data_table']} where srvy_code = {$result['srvy_code']} and srvd_uid = '{$member['mb_id']}' and srvy_year = '{$result['srvy_year']}' ";
	$res = sql_fetch($sql);

	if(!$res['cnt']) 
	{	
	?>
	<script>srvyWin();</script> 
	<?php
	}
}
?>
