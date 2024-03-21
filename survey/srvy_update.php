<?php
include_once("./_common.php");

$srvy_code  = trim($_POST['srvy_code']);
$srvd_count  = trim($_POST['srvy_count']);

#설문지 정보 가져오기
$srvy = get_survey($srvy_code);

if(!$srvy['srvy_code'])
	alert('존재하지 않는 데이터입니다.');

for( $i=1; $i<=$srvd_count; $i++ ) 
{
	$arr_data[] = ${"survey_".$i} ? ${"survey_".$i} : "_";
	$arr_data_text[] = ${"survey_text_".$i} ? ${"survey_text_".$i} : "_";
}

$srvy_data = implode("#",$arr_data);
$srvy_data_text = implode("#",$arr_data_text);

//echo $srvy_data;
//exit;

$sql_common = "  
				srvy_code 		= '{$srvy_code}',
				srvy_name 		= '{$srvy['srvy_name']}',
				srvy_point 		= '{$srvy['srvy_point']}',
				srvy_type 		= '{$srvy['srvy_type']}',
				srvy_year 		= '{$srvy['srvy_year']}',
				srvy_semi 		= '{$srvy['srvy_semi']}',
				srvd_ex 		= '{$srvy_data}',
				srvd_text 		= '{$srvy_data_text}',
				srvd_count 		= '{$srvd_count}'";


sql_query(" insert into {$g5['survey_data_table']} set srvd_uid = '{$member['mb_id']}', srvd_rdate = '".G5_TIME_YMDHIS."', {$sql_common} ");
//echo (" insert into {$g5['survey_data_table']} set srvd_uid = '{$member['mb_id']}', srvd_rdate = '".G5_TIME_YMDHIS."', {$sql_common} ");
//exit;

$num = "1";
if($srvy['srvy_type'] == 'A')
{
	$strVal = "CP교육만족도 조사 완료";
	$point = "10";
	$conf = "srvy01";
}
else
{
	$strVal = "윤리CP인식도 조사 완료";
	$point = "10";
	$conf = "srvy02";
}
insert_point_ns($member['mb_id'], $point, $strVal, $conf, $member['mb_id'], "@".$num, $num);
?>
<script type="text/javascript">
	alert("설문 조사가 완료되었습니다");
	window.close();
</script>