<?php
include_once('./_common.php');

//echo "TEST";
if(!$is_member) {
	alert(NS_LOGIN_MSG);
}

if (!$sst) {
    $sst = "ls.lssn_rdate";
    $sod = "asc";
}

if(!$l_no) $l_no = "19";

$sql_where = " where ap.app_uid = '{$member['mb_id']}' and ls.lssn_no = '{$l_no}' ";
$sql_order = " order by {$sst} {$sod} ";

$sql = "select ls.*, ap.* 
			from  {$g5['less_apply_table']} as ap 
			left join {$g5['lesson_table']} as ls on( ls.lssn_no = ap.app_lssn_no ) {$sql_where} {$sql_order}";
#echo $sql;
$result = sql_fetch($sql);

if( !$result ) {
	alert_close("학습내역이 없습니다. 학습 후 이용하실 수 있습니다.");
}

//합격 여부 체크
if( $result['app_evaluation'] == "Y") {
	alert_close("이미 합격하셨습니다.");
}

$quiz_code = $result['lssn_quiz'];
#echo $quiz_code;


if( !$quiz_code ){
	alert_close("잘못된 접근입니다.");
}

//재응시는 1번만
$sql = "select count(qa_no) as cnt from {$g5['quiz_answer_table']} where qa_uid ='{$member['mb_id']}' and qa_end = 'Y' and qa_quiz_code = '{$quiz_code}'";
$row = sql_fetch($sql);
$testCnt = $row['cnt'];
#echo $sql;

if($step != "question" && $step != "answer")
	$checkCnt = 1;
else
	$checkCnt = 2;

$checkCnt = 100;

if( $testCnt > $checkCnt)
		alert_close("재응시는 1번만 가능합니다");
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../_Css/common.css">
    <link rel="stylesheet" href="../_Css/styleDefault.css">
    <link rel="stylesheet" href="../_Css/content.css">
	<script src="/js/campaign.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="/js/quiz_question.js"></script>
	<script>
	$(function() {
		$('.class-close, .close').click(function(){
			opener.location.reload();
			self.close();
		});						
	});
	</script>
</head>
<body id="pop">
<div>
    <?php
		if( !$step ) $step = "intro";
		include "quiz_view.".$step.".inc.php";
	?>	
</div>
</body>
</html>