<?php
include_once('./_common.php');

if (!$is_member) die("로그인이 필요합니다");

$conf = $_REQUEST['conf'];
$num = $_REQUEST['num'];

$wr_id = "";
$str = "";

if(isset($_REQUEST['wr_id'])) {
	$wr_id = $_REQUEST['wr_id'];
	$num = $wr_id;
}

if(isset($_REQUEST['str'])) {
	$str = $_REQUEST['str'];
}

switch($conf)
{
	case "ceo":
		$num = "1";
		$strVal = "CEO 메세지 완료";
		$point = "5";
		break;
	case "cmp":
		$num = "1";
		$strVal = "자율준수 관리자 메세지 완료";
		$point = "5";
		break;
	case "self1":
		$num = "1";
		$strVal = "윤리실천 자가진단 완료";
		$point = "5";
		break;
	case "self2":
		$num = "1";
		$strVal = "준법실천 자가진단 완료";
		$point = "5";
		break;
	case "guide02":
		$num = "1";
		$strVal = "자율준수 편람 완료"; // ???
		$point = "2";
		break;
	case "guide03":
		$strVal = "공정거래 가이드라인 완료";
		$point = "3";
		break;
	case "guide03_1":
		$strVal = "공정거래 가이드라인 완료";
		$point = "3";
		break;
	case "guide03_2":
		$strVal = "공정거래 가이드라인 완료";
		$point = "3";
		break;
	case "guide03_3":
		$strVal = "공정거래 가이드라인 완료";
		$point = "3";
		break;
	case "guide03_4":
		$strVal = "공정거래 가이드라인 완료";
		$point = "3";
		break;
	case "guide04":
		$num = "1";
		$strVal = "청탁금지법 가이드라인 완료";
		$point = "3";
		break;
	case "guide05_1":
		//$num = "1";
		$strVal = "대규모유통업법 가이드라인 완료";
		$point = "3";
		break;
	case "guide05_2":
		//$num = "1";
		$strVal = "대규모유통업법 가이드라인 완료";
		$point = "3";
		break;
	case "p_comp":
		$strVal = "e_준법교육 캠페인 완료";
		$point = "5";
		break;
	case "p_ethic":
		$strVal = "e_윤리교육 캠페인 완료"; //???
		$point = "1";
		break;
	case "srvy01":
		$strVal = "CP교육만족도 조사 완료";
		$point = "200";
		break;
	case "srvy02":
		$strVal = "윤리CP인식도 조사 완료";
		$point = "200";
		break;
	case "ns_co":
		$strVal = $str;
		$point = "2";
		break;
	case "guide":
		$strVal = $str;
		$point = "2";
		break;
	case "info":
		$strVal = $str;
		$point = "3";
		break;
	case "cns":
		$strVal = $str;
		$point = "3";
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
	case "3":
		echo "획득가능한 포인트가 최대 입니다.";
		break;
}	

?>