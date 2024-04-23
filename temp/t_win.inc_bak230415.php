<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
	<!-- 팝업레이어 시작 { -->
	<script>
	var pop_url = "test.php";

	function tmpWin()
	{
		var popupX = (document.body.offsetWidth / 2) - 300;
		
		var ret = window.open("/temp/" + pop_url, "popwin", "status=0, width=680, height=722, scrollbars=1, left=" + popupX);
	}
	</script>
	<!-- } 팝업레이어 끝 -->
<?php
	//echo G5_TIME_YMDHIS;
	$tmpStartTime = '2021-08-16 09:00:00';
	$tmpEndTime = '2021-08-31 23:59:59';
	// 서약서팝업레이어 시작 { : 로그인 회원인 경우만 서약서 출력
	if(G5_TIME_YMDHIS > $tmpStartTime && G5_TIME_YMDHIS < $tmpEndTime)
	{
		$sql = " select count(pld_no) as cnt from sj_prs_pledge where mb_id = '{$member['mb_id']}' and pld_flag = '0' and pld_year = '2021' and pld_semi = 'A' ";
		$result = sql_fetch($sql);
		
		if(!$result['cnt']) 
		{
?>
			<script type='text/javascript'>tmpWin();</script> 
<?php
		}
	}
?>
