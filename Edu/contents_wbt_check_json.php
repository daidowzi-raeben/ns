<?php
include_once('./_common.php');

if( !$member['mb_id'] ){
		$rtn["res"] = false;
		$rtn["msg"] = "로그인후에 이용해주세요.";
		echo json_encode($rtn);
		exit;
}

$LESSON = get_lesson($lesson);
if( !$LESSON ){
		$rtn["res"] = false;
		$rtn["msg"] = "과정정보가 존재하지 않습니다.";
		echo json_encode($rtn);
		exit;
}

$CHAPTER = get_chapter($chapter);
if( !$CHAPTER ){
		$rtn["res"] = false;
		$rtn["msg"] = "차시정보가 존재하지 않습니다.";
		echo json_encode($rtn);
		exit;
}

# 이 컨텐츠 구매내역 찾기
#$contents

if( !$contents ){
		$rtn["res"] = false;
		$rtn["msg"] = "컨텐츠가 존재하지 않습니다.";
		echo json_encode($rtn);
		exit;
}

$CONTENTS = get_contents($contents);
if( !$CONTENTS ) {
		$rtn["res"] = false;
		$rtn["msg"] = "컨텐츠가 존재하지 않습니다.";
		echo json_encode($rtn);
		exit;
}

if( !$CONTENTS['c_page'] ){
		$rtn["res"] = false;
		$rtn["msg"] = "컨텐츠가 페이지가 설정되지 않았습니다.";
		echo json_encode($rtn);
		exit;
}


## 총 길이
//$total_time = $_POST[f_time];
## 총페이지 
$total_page = $CONTENTS['c_page'];

## 재생 길이
//$played_time = $_POST[p_time];

if( $page == "end" ) {
	$page = $total_page; // 인트로 1 페이지가 있어서..
	$studied_page = $total_page;
} else {
	$studied_page = $page;
	//$studied_page = $page - 1;
}

## 총페이지에 따른 진행율
if( $total_page  ) {
	$study_rate = floor( ( $studied_page / $total_page ) * 100 );
}
		
##


if( $study_rate <= 0 ) $study_rate = 0;
if( $study_rate >= 100 ) $study_rate = 100;

$arr_info = $_POST;
$arr_info["uid"] = $member['mb_id'];
$arr_info["study_time"] = $played_time;
$arr_info["total_time"] = $total_time;
$arr_info["study_rate"] = $study_rate;

$arr_info["study_chapter"] = $study_chapter;

$arr_info["total_page"] = $total_page;
$arr_info["study_page"] = $studied_page;

$attend_info = chapter_attend_exist($arr_info);
				
//$rtn["mmssgg"] = "$played_time / $total_time";

## 이미 학습 정보가 있다면
if( $attend_info ) {

	## 100% 가 된 이후부터는 업데이트 안함.
	if( $attend_info['att_study_rate'] >= 100 ) {
		$rtn["res"] = true;
		$rtn["msg"] = "이미 학습이 완료되었습니다.";
		echo json_encode($rtn);
		exit;
	}
		
	if( $study_rate >= $attend_info['att_study_rate'] ) {
		
		$sql = "update {$g5['chapter_att_table']} set 
					att_study_page = '".$arr_info[study_page]."',
					att_total_page = '".$arr_info[total_page]."',
					att_study_time = '".$arr_info[study_time]."',
					att_total_time = '".$arr_info[total_time]."',
					att_study_question = '".$arr_info[study_question]."',
					att_total_question = '".$arr_info[total_question]."',							
					att_study_rate = '".$arr_info[study_rate]."',
					att_study_last = '".G5_TIME_YMDHIS."'
					where 
						att_uid = '".$arr_info[uid]."' and 						
						att_lssn_no = '".$arr_info[lesson]."' and 
						att_chapter_no = '".$arr_info[chapter]."' 
						and att_contents = '".$arr_info["contents"]."' ";
		sql_query($sql);
		
		//학습 로그
		$sql = " insert into {$g5['chapter_att_log_table']} set 
				al_uid = '".$arr_info["uid"]."',
				al_att_no = '".$arr_info["att_no"]."',
				att_lssn_no = '".$arr_info["lesson"]."',
				att_chapter_no = '".$arr_info["chapter"]."',
				att_contents = '".$arr_info["contents"]."',
				att_study_page = '".$arr_info["study_page"]."',
				al_ip = '{$_SERVER['REMOTE_ADDR']}',
				al_rdate = '".G5_TIME_YMDHIS."' ";
		sql_query($sql);
		
		if( $study_rate >= 100 ) {

			## 학습완료시 전체 챕터중 완료된것을 %로 하여 order_item  에 진행률 업데이트 해줌.
			$sql = " select * from {$g5['chapter_table']} where cpt_lesson='$lesson' order by cpt_seq asc ";
			$cpt_arr = sql_query($sql);
			$cnt_arr = sql_num_rows($cpt_arr);
			
			$count_complete = 0;
			if( $cpt_arr ) {
				for ($i=0; $row=sql_fetch_array($cpt_arr); $i++) {
					## 이차시의 진행률

					$sql =" select att_study_rate from {$g5['chapter_att_table']}
								where 
									att_uid = '".$member['mb_id']."' and 
									att_lssn_no = '".$lesson."' and 
									att_chapter_no = '".$row['cpt_no']."'";
					
					$res = sql_fetch($sql);
					if( $res['att_study_rate'] == 100 ) {
						$count_complete++;
					}
					
				}
				$lesson_stuey_rate = ceil( $count_complete / $cnt_arr * 100 );				
			} else {
				$lesson_stuey_rate = 0;
			}
			
			if($lesson_stuey_rate >= 100)
			{
				$sql_add = ", app_edate = '".G5_TIME_YMDHIS."' ";
				//진도율 100% => 마일리지 적립
				if($lesson == 17)
				{
					insert_point_ns($member['mb_id'], 30, "2022_청탁금지법 교육", "cyber3", $member['mb_id'], "@1", 1);
					
				}
			}
			else
			{
				$sql_add = "";
			}				
			
			$sql = "update {$g5['less_apply_table']} set 
						app_study_rate = '".$lesson_stuey_rate."', 
						app_study_chapter = '".$lesson_stuey_chapter."', 
						app_study_page = '".$current_page."' {$sql_add}
						where  app_lssn_no = '".$lesson."' and app_uid = '".$member['mb_id']."'";
			
			sql_query($sql);
		}

		$rtn["res"] = true;
		$rtn["msg"] = $arr_info[study_rate]."로 업데이트 완료";
		//$rtn["msg"] = $sql;
		//$rtn["cc"] = $count_complete;
		//$rtn["ca"] = count($cpt_arr);
		echo json_encode($rtn);
		exit;
	} else {
		#진도율이 이미 그 이상이면 업데이트 안함.
		$rtn["res"] = true;
		$rtn["msg"] = "이미 학습한 범위입니다.";
		echo json_encode($rtn);
		exit;		
	}
} else {
	//$CHAPTER->attend_add($arr_info);
	
	$sql = " insert into {$g5['chapter_att_table']} set 
				att_uid = '".$arr_info["uid"]."',					
				att_lssn_no = '".$arr_info["lesson"]."',
				att_chapter_no = '".$arr_info["chapter"]."',
				att_contents = '".$arr_info["contents"]."',
				att_study_page = '".$arr_info["study_page"]."',
				att_total_page = '".$arr_info["total_page"]."',
				att_study_time = '".$arr_info["study_time"]."',
				att_total_time = '".$arr_info["total_time"]."',
				att_study_question = '".$arr_info["study_question"]."',
				att_total_question = '".$arr_info["total_question"]."',					
				att_study_rate = '".$arr_info["study_rate"]."',
				att_study_last = '".G5_TIME_YMDHIS."',
				att_rdate = '".G5_TIME_YMDHIS."'
					";
	sql_query($sql);
	$arr_info['att_no'] = sql_insert_id();
	
	if($lesson == 17) 
	{
		if( $study_rate >= 100 ) {

			## 학습완료시 전체 챕터중 완료된것을 %로 하여 order_item  에 진행률 업데이트 해줌.
			$sql = " select * from {$g5['chapter_table']} where cpt_lesson='$lesson' order by cpt_seq asc ";
			$cpt_arr = sql_query($sql);
			$cnt_arr = sql_num_rows($cpt_arr);
			
			$count_complete = 0;
			if( $cpt_arr ) {
				for ($i=0; $row=sql_fetch_array($cpt_arr); $i++) {
					## 이차시의 진행률

					$sql =" select att_study_rate from {$g5['chapter_att_table']}
								where 
									att_uid = '".$member['mb_id']."' and 
									att_lssn_no = '".$lesson."' and 
									att_chapter_no = '".$row['cpt_no']."'";
					
					$res = sql_fetch($sql);
					if( $res['att_study_rate'] == 100 ) {
						$count_complete++;
					}
					
				}
				$lesson_stuey_rate = ceil( $count_complete / $cnt_arr * 100 );				
			} else {
				$lesson_stuey_rate = 0;
			}
			
			if($lesson_stuey_rate >= 100)
			{
				$sql_add = ", app_edate = '".G5_TIME_YMDHIS."' ";
				//진도율 100% => 마일리지 적립
				insert_point_ns($member['mb_id'], 30, "2022_청탁금지법 교육", "cyber3", $member['mb_id'], "@1", 1);
			}
			else
			{
				$sql_add = "";
			}				
			
			$sql = "update {$g5['less_apply_table']} set 
						app_study_rate = '".$lesson_stuey_rate."', 
						app_study_chapter = '".$lesson_stuey_chapter."', 
						app_study_page = '".$current_page."' {$sql_add}
						where  app_lssn_no = '".$lesson."' and app_uid = '".$member['mb_id']."'";
			
			sql_query($sql);
		}
	}
	
	//학습 로그
	$sql = " insert into {$g5['chapter_att_log_table']} set 
				al_uid = '".$arr_info["uid"]."',
				al_att_no = '".$arr_info["att_no"]."',
				att_lssn_no = '".$arr_info["lesson"]."',
				att_chapter_no = '".$arr_info["chapter"]."',
				att_contents = '".$arr_info["contents"]."',
				att_study_page = '".$arr_info["study_page"]."',
				al_ip = '{$_SERVER['REMOTE_ADDR']}',
				al_rdate = '".G5_TIME_YMDHIS."' ";
	sql_query($sql);
	
	$rtn["res"] = true;
	$rtn["msg"] = "처음학습 완료";
	echo json_encode($rtn);
	exit;	
}
?>