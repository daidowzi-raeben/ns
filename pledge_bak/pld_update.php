<?php
include_once('./_common.php');

$pld_month  = trim($_POST['month']);
$pld_day   	= trim($_POST['day']);
$pld_enb    = trim($_POST['e_number']);
$mb_name 	= trim($_POST['mb_name']);

if (!$pld_enb || !$mb_name)
    alert('회원이름이나 사번이 공백이면 안됩니다.');


$mb_id = $member['mb_id'];

$sql = " select count(pld_no) as cnt from sj_prs_pledge where mb_id = '{$mb_id}' and pld_flag = '2' and pld_year = '2022' and pld_semi = 'A' ";
$result = sql_fetch($sql);

if($result['cnt'])
	alert("이미 서약서를 작성했습니다.");

$sql = " insert into sj_prs_pledge
                set mb_id = '{$mb_id}',
					pld_month = '{$pld_month}',
					pld_day = '{$pld_day}',
					pld_enb = '{$pld_enb}',
					pld_name = '{$mb_name}',
					pld_flag = '2',
					pld_year = '2022',
					pld_semi = 'A',
					pld_regdate = '".G5_TIME_YMDHIS."'";
sql_query($sql);
?>
<script>
	alert("서약이 완료되었습니다.");
	window.close();
</script>
