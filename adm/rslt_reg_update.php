<?php
$sub_menu = "300420";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

//check_admin_token();

$info = $_POST;

//print_r($info);
$sql_common = "	quiz_kind='".$info["quiz_kind"]."', 
				quiz_name='".$info["quiz_name"]."', 
				quiz_qcount='".$info["quiz_qcount"]."',  
				quiz_point='".$info["quiz_point"]."',  
				quiz_admin='".$member['mb_id']."', 
				quiz_rdate=now()";

//시험지 추가
if ($w == '')
{
	sql_query(" insert into {$g5['quiz_table']} set {$sql_common} ");
}
else if ($w == 'u')
{
	$sql = " update {$g5['quiz_table']}
                set {$sql_common}
                where qq_no = {$qq_no} ";
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

//문항 추가 페이지로 이동
alert('시험지를 등록했습니다.', './rslt_list.php?'.$qstr.'&amp;');
?>