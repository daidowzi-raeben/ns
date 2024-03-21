<?php
#include $CFG[class_dir]."/member.class.php";
//echo "총출제문제 : $count_question ";
for( $i=1; $i<=$count_question; $i++ ) {
	switch( ${"qq_type_".$i} ) {
		case  "A" : 
			$qa_answerA .= ${"qa_answer_".$i} ? ${"qa_answer_".$i} : "_";
			$qa_answerB[] = $i."=".addslashes(${"qa_answer_".$i."_etc"});					
			break;
		case  "B" : 
			$qa_answerA .= ${"qq_type_".$i} ? ${"qq_type_".$i} : "_";
			$qa_answerB[] = $i."=".addslashes(${"qa_answer_".$i});
			break;
		case  "C" : 
			$qa_answerA .= ${"qq_type_".$i} ? ${"qq_type_".$i} : "_";
			$qa_answerB[] = $i."=".addslashes(${"qa_answer_".$i});
			break;
		case  "D" : 
		case  "E" : 	
			$qa_answerA .= ${"qa_answer_".$i} ? ${"qa_answer_".$i} : "_";
			/*$qa_answerD[] = $i."=".addslashes(${"qa_answer_".$i});
			if( ${"qa_answer_".$i."_add"} ) $qa_answerD_add[] = $i."=".@implode($_TAB2,${"qa_answer_".$i."_add"});	
			*/		
			break;	
		case  "H" : 	
			$qa_answerA .= ${"qq_type_".$i} ? ${"qq_type_".$i} : "_";
			$qa_answerB[] = $i."=".addslashes(${"qa_answer_".$i});					
			//$qa_answerD[] = $i."=".addslashes(${"qa_answer_".$i});
			//if( ${"qa_answer_".$i."_add"} ) $qa_answerD_add[] = $i."=".@implode($_TAB2,${"qa_answer_".$i."_add"});			
			break;						
		default :
			$answerA .= ${"qq_type_".$i} ? ${"qq_type_".$i} : "_";
			$qa_answerB[] = $i."=".addslashes(${"qa_answer_".$i});	
			break;
	}
	
	## 별도의답저장
	if( ${"qa_answer_".$i."_add"} ) {
			
			if( is_array(${"qa_answer_".$i."_add"}) ) {
					$qa_answer_add[] = $i."=".implode($_TAB2,${"qa_answer_".$i."_add"});
					//echo "추가 배열 있음 : ".$i."=".implode($_TAB2,${"qa_answer_".$i."_add"});
			} else {
					$qa_answer_add[] = $i."=".${"qa_answer_".$i."_add"};
					//echo "추가 배열 없음 : ".$i."=".${"qa_answer_".$i."_add"};;
			}
	}

	//echo $i.":".${"qq_type_".$i}.":".${"qa_answer_".$i}.":".@implode($_TAB2,${"qa_answer_".$i."_add"}).":".${"qa_answer_".$i."_etc"}."<br>";
}
$info = $_POST;

$info["pointA"] = "0";
$info["pointB"] = "0";
$info["pointC"] = "0";

$info["qa_answerA"] = $qa_answerA;
if( $qa_answerB ) $info["qa_answerB"] = implode($_TAB,$qa_answerB);
if( $qa_answerD ) $info["qa_answerD"] = implode($_TAB,$qa_answerD);
if( $qa_answer_add ) $info["qa_answer_add"] = implode($_TAB,$qa_answer_add);

$info["qa_uid"] = $member['mb_id'];
$info["qa_uname"] = $member['mb_name'];
$info["qa_lesson"] = $result['lssn_no'];
$info["qa_lesson_apply"] = $result['app_no'];

##$qa_no = $quiz->add_answer( $info );
##사용자 답안 저장
$sql = " update {$g5['quiz_answer_table']} set  qa_answerA = '".$info['qa_answerA']."'
			where qa_quiz_code='".$quiz_code."' and qa_uid='".$member['mb_id']."' and qa_no='".$qa_no."'";
sql_query($sql);


if( $qa_no ) {
	$sql = "select * from {$g5['quiz_answer_table']} as qa
		 where qa.qa_no='$qa_no'";
	//$result = sql_query($sql);

	if( $row = sql_fetch($sql) ) {
		//$row = sql_fetch($result);
		$tmp_answerA = $row['qa_answerA'];
		
		//echo $key ."[$qa_no] => ". $value."<BR>";

		for($i=0;$i<=strlen($tmp_answerA)-1;$i++ ) {
			$row['qa_answer'][$i+1] = $tmp_answerA[$i];
			//echo ($i+1) . " => " . $tmp_answerA[$i] . "<BR>";
		}
		
		$tmp_answerB = @explode($_TAB,$row['qa_answerB']);
		if( $tmp_answerB ) {
			foreach($tmp_answerB as $k => $v ) {
				$key = substr($v,0,strpos($v,"="));
				//echo $key ."[$qa_no] => ". $value."<BR>";
				$value = substr($v,strpos($v,"=")+1,strlen($v)-(strpos($v,"=")+1));

				$tmp_qa = explode("=",trim($v));
				if( $tmp_qa[1] ) {
					## 사지선다형 기타라면 해당 숫자(9)도 가져옴.
					if( $row['qa_answer'][$i+1] == 9 ) $row['qa_answer'][$tmp_qa[0]] = $row['qa_answer'][$tmp_qa[0]].$_TAB2.$tmp_qa[1];
					else $row['qa_answer'][$tmp_qa[0]] = $tmp_qa[1];
				}
			}
		}
		
		$tmp_answer_add = @explode($_TAB,$row['qa_answer_add']);
		if( $tmp_answer_add ) {
			foreach($tmp_answer_add as $k => $v ) {
				$key = substr($v,0,strpos($v,"="));
				$value = substr($v,strpos($v,"=")+1,strlen($v)-(strpos($v,"=")+1));
				//echo $key ."[$qa_no][$v] => ". $value."<BR>";

				$tmp_qa = explode("=",trim($v));
				$row['qa_answer_addition'][$tmp_qa[0]] = $tmp_qa[1];
			}
		}
	}

	$answer = $row;
	//print_r($answer);
	//exit;
	
	## 퀴즈번호 배열
	$qq_no = explode("#",$answer['qa_questions']);
	$count_question = count($qq_no);

	## 만약 만점이라면 포인트지급....
	// 포인트 지급할지 확인

	$get_point_pass = true; // 기본은 성공
	for( $seq=1; $seq<=$count_question; $seq++ ) {
		//$question_info = $quiz->get_question($seq);

		## 문제은행 정보조인
		$sql = "select * from {$g5['qq_table']} where qq_quiz_code='{$quiz_code}' and qq_no='{$qq_no[$seq-1]}'";
		//echo $sql;
		//$result = sql_query($sql);
		$quiz_question_info = sql_fetch($sql);
		
		$sql = "select * from {$g5['question_table']} where qq_no='{$quiz_question_info['qq_question']}'";
		//$result = sql_query($sql);
		$question_info = sql_fetch($sql);
		
		$ex = explode($_TAB, $question_info['qq_ex']);
		if( $question_info ) {
			foreach( $question_info as $k=> $v ){
				$aa .= " $k=> $v /n";
			}
		}
		
		## seq 정보만 추가함.
		$question_info['qq_seq'] = $quiz_question_info['qq_seq'];
		
		if( $question_info['qq_type'] == "A" )  {

			if( $question_info['qq_std_answerA'] == $answer['qa_answer'][$seq] ) {
				$info["qa_check"] = $info["qa_check"]."O";
				$info["pointA"] = $info["pointA"] + $question_info['qq_point'];
			} else {
				$info["qa_check"] = $info["qa_check"]."X";

			}
		} elseif( $question_info['qq_type'] == "B" || $question_info['qq_type'] == "C" ) {
			if( $question_info['qq_std_answerA'] == $answer['qa_answer'][$seq] ) {
				$info["qa_check"] = $info["qa_check"]."O";
				$info["pointB"] = $info["pointB"] + $question_info['qq_point'];
			} else {
				$info["qa_check"] = $info["qa_check"]."X";
			}
		} else {
			$info["qa_check"] = $info["qa_check"]."X";
		}
	}

	## 답안저장
	$sql = " update {$g5['quiz_answer_table']} set 
				qa_check = '".$info["qa_check"]."',
				qa_pointA =  ".$info["pointA"].",
				qa_pointB =  ".$info["pointB"].",
				qa_pointC = ".$info["pointC"].",
				qa_pointTotal = (qa_pointA + qa_pointB + qa_pointC),
				qa_end = 'Y',
				qa_edate = now()
			where qa_quiz_code='$quiz_code' and qa_no='$qa_no'";
	sql_query($sql);

	## 패스여부
	$total_point = $info["pointA"] + $info["pointB"] + $info["pointC"];

?>

<?php
	//print "total_point{$total_point}\n";
	//print "total_point{$LESSON->lssn_quiz_point}\n";
	//exit;
	## 합격점수 이상이면..... 
	//과정에서 세팅한 점수로 변경하였음.. if( $total_point >= $quiz->quiz_point ) {
	if( $total_point >= $result['lssn_quiz_point'] ) {
		$sql = "update {$g5['quiz_answer_table']} set qa_success='Y' where qa_quiz_code='$quiz_code' and qa_no='$qa_no'";
		sql_query($sql);

		## apply 에 평가 합격
		$sql = " update {$g5['less_apply_table']} set 
					app_evaluation = 'Y', app_evaluation_rdate=now()
					where app_no = '{$result['app_no']}'";
		sql_query($sql);
		
		#마일리지 적립
		$res = insert_point_ns($member['mb_id'], "30", "사이버교육 완료", "cyber", $member['mb_id'], "@1", "1");
?>
	<!--s: layer-csend(합격) -->
	<div class="layer-wrap guide pop03">
        <div class="is-top">
            <h2>학습평가</h2>
            <p class="ex">“나가기” 버튼을 누르면 학습 이력이 저장되지 않습니다. </p>
            <a href="#n" class="close" onclick="javascript:self.close();"><span>나가기</span></a>
        </div>
        <div class="is-con">
            <h1>
                <span>[<?php echo $total_point?> 점] 합격</span> 하였습니다.<br/>
                수고 하셨습니다.
            </h1>
            <div class="center i-imgbox">
                <img src="/_Img/Content/gudie-img.png" alt="" >
            </div>

            <div class="btn-wrap c">
                <a href="#n" class="class-close"><span>닫기</span></a>
            </div>
        </div>
    </div>
	<!--e: layer-csend(합격) -->
<?php
	} else {
		$sql = "update {$g5['quiz_answer_table']} set qa_success='N' where qa_quiz_code='$quiz_code' and qa_no='$qa_no'";
		sql_query($sql);
?>
	<!--s: layer-csend(불합격) -->
	<div class="layer-wrap guide pop02">
        <img src="/_Img/Content/gudie-img.png" alt="" class="i-img">
        <div class="is-top">
            <h2>학습평가</h2>
            <p class="ex">“나가기” 버튼을 누르면 학습 이력이 저장되지 않습니다. </p>
            <a href="#n" class="close"><span>나가기</span></a>
        </div>
        <div class="is-con">
            <h2><span class="red">[<?php echo $total_point?> 점] 불합격</span> 하였습니다.</h2>
            <div class="txt t-center">
                ※ 점수 미달시 재응시 하셔야 합니다.<br/>
                ※ 재 응시는 1회만 부여합니다.
            </div>
            <div class="btn-wrap c">
                <a href="?l_no=<?=$l_no?>" class="class-regist"><span>재응시</span></a>
                <a href="#n" onclick="window.close()" class="class-close"><span>닫기</span></a>
            </div>
        </div>
    </div>
	<!--e: layer-csend(불합격) -->
<?php
	}
} else {
	alert("관리자에게 문의해 주세요.");
}
?>
