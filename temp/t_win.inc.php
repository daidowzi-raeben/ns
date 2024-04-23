<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
	<!-- 팝업레이어 시작 { -->
	<script>
	var pop_url = "";

	function tmpWin()
	{
		var popupX = (document.body.offsetWidth / 2) - 300;
		
		var ret = window.open("/temp/" + pop_url, "popwin", "status=0, width=563, height=722, scrollbars=1, left=" + popupX);
	}
	</script>
	<!-- } 팝업레이어 끝 -->
<?php
	//echo G5_TIME_YMDHIS;
	$tmpStartTime = '2023-04-12 09:00:00';
	$tmpEndTime = '2023-05-12 17:59:59';
	// 공정거래 자율준수 서약문 >> 서약서팝업레이어 시작 { : 로그인 회원인 경우만 서약서 출력
	if(G5_TIME_YMDHIS > $tmpStartTime && G5_TIME_YMDHIS < $tmpEndTime)
	{
		$sql = " select count(pld_no) as cnt from sj_prs_pledge where mb_id = '{$member['mb_id']}' and pld_flag = '2' and pld_year = '2023' and pld_semi = 'A' ";
		$result = sql_fetch($sql);
		
		if(!$result['cnt']) 
		{
?>
			<script type='text/javascript'>tmpWin();</script> 
<?php
		}
	}
?>
