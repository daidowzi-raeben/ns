<?php
include_once('./_common.php');

if (!$is_member) die("로그인이 필요합니다");

$conf = $_REQUEST['conf'];
$num = $_REQUEST['num'];

switch($conf)
{
	case "ceo":
		$num = "1";
		$strVal = "CEO 메세지 완료";
		$point = "2";
		break;
	case "cmp":
		$num = "1";
		$strVal = "자율준수 관리자 메세지 완료";
		$point = "2";
		break;
	case "self1":
		$num = "1";
		$strVal = "윤리실천 자가진단 완료";
		$point = "10";
		break;
	case "self2":
		$num = "1";
		$strVal = "준법실천 자가진단 완료";
		$point = "10";
		break;
	case "guide02":
		$num = "1";
		$strVal = "자율준수 편람 완료";
		$point = "2";
		break;
	case "guide03":
		$strVal = "공정거래 가이드라인 완료";
		$point = "8";
		break;
	case "guide04":
		$num = "1";
		$strVal = "청탁금지법 가이드라인 완료";
		$point = "8";
		break;
	case "guide05":
		//$num = "1";
		$strVal = "대규모유통업법 가이드라인 완료";
		$point = "8";
		break;
	case "p_comp":
		$strVal = "e_준법교육 캠페인 완료";
		$point = "1";
		break;
	case "p_ethic":
		$strVal = "e_윤리교육 캠페인 완료";
		$point = "1";
		break;
	case "srvy01":
		$strVal = "CP교육만족도 조사 완료";
		$point = "10";
		break;
	case "srvy02":
		$strVal = "윤리CP인식도 조사 완료";
		$point = "10";
		break;
}


$res = insert_point_ns($member['mb_id'], $point, $strVal, $conf, $member['mb_id'], "@".$num, $num);

switch($res)
{
	case "1":
		echo "완료되었습니다.";
		break;
	case "0":
		echo "이미 확인되었습니다.\n24시간 이후 다시 확인해주세요.";
		break;
	case "2":
		echo "다음 페이지 읽어주세요.";
		break;
}	

?>