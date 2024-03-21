<?php
$sub_menu = "300410";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

//check_admin_token();

$info = $_POST;
$info[qq_ex] = $info[qq_ex1].$_TAB.$info[qq_ex2].$_TAB.$info[qq_ex3].$_TAB.$info[qq_ex4].$_TAB.$info[qq_ex5].$_TAB.$info[qq_ex6].$_TAB.$info[qq_ex7].$_TAB.$info[qq_ex8];

//답안
# C 타입의 경우 정답
if( $qq_type == "A" ) {
		$info[qq_answerA] = $qq_answerA?implode("#",$qq_answerA):"";
		$info[qq_answerB] = "";
		$info[qq_answerC] = "";								
} elseif( $qq_type == "B" ) {
		$info[qq_answerA] = "";		
		$info[qq_answerB] = $qq_answerB;
		$info[qq_answerC] = "";		
} elseif( $qq_type == "C" ) {
		$info[qq_answerA] = "";	
		$info[qq_answerB] = "";
		$info[qq_answerC] = $qq_answerA?implode("#",$qq_answerA):"";
}

//문항구분
if( $qq_pkind ) $info[qq_pkind] = "#".implode("#",$qq_pkind)."#";
else $info[qq_pkind] = "";

//print_r($info);
$sql_common = "	qq_kind='".$info["qq_kind"]."', 
				qq_type='".$info["qq_type"]."', 
				qq_title='".$info["qq_title"]."', 
				qq_file='".$info["qq_file"]."',				
				qq_header='".$info["qq_header"]."', 	
				qq_guide='".$info["qq_guide"]."', 
				qq_count_ex='".$info["qq_count_ex"]."', 
				qq_ex='".$info["qq_ex"]."',
				qq_ex_files='".$info["qq_ex_files"]."',				
				qq_use_etc='".$info["qq_use_etc"]."',														 
				qq_std_answerA='".$info["qq_answerA"]."', 
				qq_std_answerB='".$info["qq_answerB"]."', 
				qq_std_answerC='".$info["qq_answerC"]."', 
				qq_time='".$info["qq_time"]."',
				qq_point='".$info["qq_point"]."'";

//문항 추가
if ($w == '')
{
	sql_query(" insert into {$g5['question_table']} set {$sql_common} ");
}
else if ($w == 'u')
{
	$sql = " update {$g5['question_table']}
                set {$sql_common}
                where qq_no = {$qq_no} ";
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

//문항 추가 페이지로 이동
alert('등록했습니다. 계속 문항을 추가합니다.', './tst_reg.php?'.$qstr.'&amp;');
?>