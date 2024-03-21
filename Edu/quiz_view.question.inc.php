<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

## 새로운 답안지 생성( 랜덤하게 퀴즈 번호 가져옴 )
$info = $_POST;
$info["qa_uid"] = $member['mb_id'];
$info["qa_uname"] = $member['mb_name'];
$info["qa_lesson"] = $result['lssn_no'];
$info["qa_lesson_apply"] = $result['app_no'];

# 채점되지 않은 답안지가 있다면 그것을 선택해서 진행
$sql = "select qa_no from {$g5['quiz_answer_table']} where qa_end='N' and qa_uid='{$info['qa_uid']}' and qa_quiz_code='{$quiz_code}' order by qa_no desc limit 1";
$result = sql_fetch($sql);
$qa_no = $result['qa_no'];

if( $qa_no ) {
	//echo "기존답안지선택";
} else {	
	## 해당 시험지의 분류를 얻음.
	$sql = " select distinct(qq_kind) kindcode from ( select tq.*, tqq.qq_kind from {$g5['qq_table']} as tq left join {$g5['question_table']} tqq on tqq.qq_no=tq.qq_question ) as q
				where qq_quiz_code='{$quiz_code}' order by qq_kind";
	$result = sql_query($sql);
	
	##분류가 있다면
	if(sql_num_rows($result)) {
		for ($i=0; $row=sql_fetch_array($result); $i++) {
			$kinds[] = $row['kindcode'];
		}
		$kind_count = floor( 10 / count($kinds) );
		for($i=0;$i<=count($kinds)-1;$i++) {
			$sql = "select qq_no from ( select tq.*, tqq.qq_kind from {$g5['qq_table']} as tq left join {$g5['question_table']} tqq on tqq.qq_no=tq.qq_question ) as q where qq_quiz_code='{$quiz_code}' and qq_kind='".$kinds[$i]."' order by rand() limit ".$kind_count;
			$result = sql_query($sql);
			
			if( sql_num_rows($result) ) {
				for ($j=0; $row=sql_fetch_array($result); $j++) {
					$rtn[] = $row['qq_no'];
				}
			} 
		}
	} else {
				
		$sql = "select qq_no from {$g5['qq_table']} where qq_quiz_code='{$quiz_code}' order by rand() limit 10";
		$result = sql_query($sql);
		
		if( sql_num_rows($result) ) {
			for ($i=0; $row=sql_fetch_array($result); $i++) {
				$rtn[] = $row['qq_no'];
			}
		} 

	}
	
	## 분류별로 되어 있으므로 순서를 섞어줌.
	shuffle($rtn);
	
	## 랜덤으로 번호를 만들어냄..
	$info["qa_questions"] = implode("#",$rtn);
	$sql = " insert into {$g5['quiz_answer_table']} set 
				qa_uid = '".$info["qa_uid"]."', 
				qa_lesson  = '".$info["l_no"]."', 
				qa_lesson_apply  = '".$info["qa_lesson_apply"]."', 
				qa_quiz_code = '".$quiz_code."', 
				qa_questions = '".$info["qa_questions"]."', 
				qa_rdate = '" . G5_TIME_YMDHIS . "'";
	sql_query($sql);
	$qa_no = sql_insert_id();
}

## 렌덤으로 얻은 퀴즈 순서를 가져오기 위해.
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
$qq_no = explode("#",$answer['qa_questions']);
$count_question = count($qq_no);
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
</head>
<body id="pop">
<!-- s: #doc //-->
<div>
	<script type="text/javascript" src="/js/quiz_question.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="//code.jquery.com/jquery-latest.js"></script>

    <script language="JavaScript">
        var co_quiz = <?=$count_question?>;
        var current_quiz = 1;
    </script>
	<script type="text/javascript">
        var i = 0;
        var j = 0;
        var qtype = '';
        var qcode = '';
        var qanswer = '';
        var total_55 = 0;

        function check_answer_custom( frm ) {

            for( i = 1; i <= co_quiz; i++ ){
                qtype = $("#qq_type_"+i).val();
                qcode = $("#qq_code_"+i).val();
                /*객관식,순위선택,*/
                if( qtype == 'A' || qtype == 'D' || qtype == 'E')	{
                    if( $("#answerform input:radio[name=qa_answer_"+i+"]:checked").val() == undefined ) {
                        //alert(qcode + ' 항목에 답을 하지 않았습니다.');
                        alert('풀지 않은 문제가 있습니다.\n문제를 다 풀고, 제출하기를 눌러주세요.');
                        $("#answerform input:radio[id=qa_answer_"+i+"_1]").focus();
                        return false;
                    }
                }
            }

            return true;
        }
    </script>
	<script language="JavaScript">

        function check_answer(frm) {
            if( check_answer_custom(frm) == false ) {
                return false;
                //exit(0);
            }
            frm.submit();
        }


    </script>
	
	<form action="<?=$PHP_SELF?>" enctype="multipart/form-data" method="POST" id="answerform" name="answerform" onsubmit="return check_answer(this)">
	<input TYPE="hidden" name="count_question" value="<?=$count_question?>" />
	<input TYPE="hidden" name="quiz_code" value="<?=$quiz_code?>" />
	<input TYPE="hidden" name="l_no" value="<?=$l_no?>" />
	<input TYPE="hidden" name="qa_no" value="<?=$qa_no?>" />
	<input TYPE="hidden" name="step" value="answer" />
	<div class="layer-wrap question">
		<div class="is-top">
			<h2>학습평가</h2>
			<a href="#n" class="close" onclick="javascript:self.close();"><span>나가기</span></a>
		</div>
		<div class="is-con">
			<div class="fl">
			<?php
				if( $count_question ) {
					for( $seq=1; $seq<=$count_question; $seq++ ) {
						## 순서대로 하지 않고 랜덤으로 얻은 순서   $question_info = $quiz->get_question($seq);
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

						$question_info['qq_title'] = str_replace("__BLANK__","_____",$question_info['qq_title']);
						if( $seq%1 ) $thisbgcolor = "#E6E6E6";
						else $thisbgcolor = "#FFFFFF";
						
						$qt_code = substr($question_info['qq_title'],0,strpos($question_info['qq_title'],"."));
			?>
						<div id="question_tab_<?=$seq?>" style="display:none;">
							<a name="#qq_<?=$seq?>">
							<input type="hidden" id="qq_type_<?=$seq?>" name="qq_type_<?=$seq?>" value="<?=$question_info['qq_type']?>">
							<input type="hidden" id="qq_code_<?=$seq?>" name="qq_code_<?=$seq?>" value="<?=$qt_code?>">		
							<div class="txt">
								<h3>문제 <?php echo $seq?></h3>
								<p>
									<?php echo nl2br(stripslashes($question_info['qq_title']))?>
								</p>
							</div>
							<div class="article">
								<ul>
								<?php
								if( $question_info['qq_type'] == "A" ) {
									$ex = explode($_TAB, $question_info['qq_ex']);
									for($ei=0;$ei<=count($ex)-1;$ei++) {
										if( trim($ex[$ei]) ) {
								?>
									<li>
										<p class="radio-box">
											<input type="radio" id="qa_answer_<?php echo $seq ?>_<?php echo $ei+1 ?>" name="qa_answer_<?php echo $seq ?>" rel_q="<?php echo $seq ?>" value="<?php echo $ei+1 ?>" class="noborder qa_answer_19">
											<label for="qa_answer_<?php echo $seq ?>_<?php echo $ei+1 ?>"><?php echo $ei+1 ?>.<?php echo $ex[$ei]?> </label>
										</p>
									</li>
								<?php
										}
									}
								} 
								?>
								</ul>
							</div>
						</div>
			<?php
					}
			?>
				<div class="ctrl">
					<a href="#n" id="btn_prev" class="prev"><span>이전</span></a>
					<a href="#n" id="btn_next" class="next"><span>다음</span></a>
				</div>
			<?php
				}
			?>
				<script>
				view_question(1);
				</script>	
			</div>
			<div class="fr">
				<table class="tbl-type03">
					<colgroup>
						   <col width="30%">
                            <col width="70%">
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>답안</th>
						</tr>
					</thead>
					<tbody>
											
						<?php
						for( $seq=1; $seq<=$count_question; $seq++ ) {
						?>
						<tr>		
							<td id="answer_tab_<?=$seq?>"><?=$seq?></td>
							<td id="answer_area_<?=$seq?>"><a href="javascript:view_question(<?=$seq?>)" class="line">미입력</a></td>
						</tr>
						<?php
						}
						?>
						
					</tbody>
				</table>
			</div>
		</div>
		<div class="btn-wrap c mg20t">
			<!--<a href="javascript:check_answer(document.answerform)" class="class-submit "><span>제 출</span></a>-->
			<a href="#" class="class-regist" onclick="return check_answer(document.answerform);"><span>제 출</span></a>
		</div>
	</div>
	</form>
	<script>

		$(document).ready(function(){
			$("input[type='radio'][id^='qa_answer_']").on("click",function(){
				var q_no = $(this).attr("rel_q");
				var answer = $(this).val();
				$("#answer_area_"+q_no).html("<a href='javascript:view_question("+q_no+")'>" + answer + "</a>");
			});

			$("#btn_prev").on("click",function(){
				if( current_quiz > 1 ) {
					current_quiz = current_quiz - 1;
					view_question(current_quiz);
				} else {
					alert("처음입니다.");
				}
			});

			$("#btn_next").on("click",function(){
				if( current_quiz < co_quiz ) {
					current_quiz = current_quiz + 1;
					view_question(current_quiz);
				} else {
					alert("마지막입니다.");
				}

			});
		});
	</script>