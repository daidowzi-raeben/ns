<?php
include_once('./_common.php');

if($no)
	$qstn = get_question($no);
else
	alert_close('존재하지 않는 정보입니다.');

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
    <script type="text/javascript" src="/module/quiz/quiz_js/quiz_question.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="//code.jquery.com/jquery-latest.js"></script>

    <script language="JavaScript">
        var co_quiz = 20;
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

    <div class="layer-wrap question">
            <div class="is-top">
                <h2>학습평가</h2>
                <a href="#n" class="close" onclick="javascript:self.close();"><span>나가기</span></a>
            </div>
            <div class="is-con">
                <div class="fl">

                    <div id="question_tab_1" style="display: ;">
                        <div class="txt">
                            <h3>문제 <?php echo $no?></h3>
                            <p>
                                <?php echo $qstn['qq_title']?> 						
							</p>
                        </div>
                        <div class="article">
						<?php
							if( $qstn['qq_type'] == "A" )
								$ex = explode($_TAB, $qstn['qq_ex']);
						?>
                            <ul>
                                <li>
                                    <p class="radio-box">
                                        <input type="radio" id="qa_answer_1_1" name="qa_answer_1" rel_q="1" value="1" class="noborder qa_answer_19">
                                        <label for="qa_answer_1_1">1.<?php echo $ex[0]?> </label>
                                    </p>
                                </li>
								<li>
                                    <p class="radio-box">
                                        <input type="radio" id="qa_answer_1_2" name="qa_answer_1" rel_q="1" value="2" class="noborder qa_answer_19">
                                        <label for="qa_answer_1_2">2.<?php echo $ex[1]?> </label>
                                    </p>
                                </li>
								<li>
                                    <p class="radio-box">
                                        <input type="radio" id="qa_answer_1_3" name="qa_answer_1" rel_q="1" value="3" class="noborder qa_answer_19">
                                        <label for="qa_answer_1_3">3.<?php echo $ex[2]?> </label>
                                    </p>
                                </li>
								<li>
                                    <p class="radio-box">
                                        <input type="radio" id="qa_answer_1_4" name="qa_answer_1" rel_q="1" value="4" class="noborder qa_answer_19">
                                        <label for="qa_answer_1_4">4.<?php echo $ex[3]?> </label>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="ctrl"><a name="#qq_20">
                        </a><a href="#n" id="btn_prev" class="prev"><span>이전</span></a>
                        <a href="#n" id="btn_next" class="next"><span>다음</span></a>
                    </div>
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
                        <tr>
                            <td id="answer_tab_1">1</td>
                            <td id="answer_area_1"><a href="javascript:view_question(1)">1</a></td>
                        </tr>
                        <tr>
                            <td id="answer_tab_2">2</td>
                            <td id="answer_area_2"><a href="javascript:view_question(2)" class="line">미입력</a></td>
                        </tr>
                        <tr>
                            <td id="answer_tab_3">3</td>
                            <td id="answer_area_3"><a href="javascript:view_question(3)" class="line">미입력</a></td>
                        </tr>
                        <tr>
                            <td id="answer_tab_4">4</td>
                            <td id="answer_area_4"><a href="javascript:view_question(4)" class="line">미입력</a></td>
                        </tr>
                        <tr>
                            <td id="answer_tab_5">5</td>
                            <td id="answer_area_5"><a href="javascript:view_question(5)" class="line">미입력</a></td>
                        </tr>
                        <tr>
                            <td id="answer_tab_6">6</td>
                            <td id="answer_area_6"><a href="javascript:view_question(6)" class="line">미입력</a></td>
                        </tr>
                        <tr>
                            <td id="answer_tab_7">7</td>
                            <td id="answer_area_7"><a href="javascript:view_question(7)" class="line">미입력</a></td>
                        </tr>
                        <tr>
                            <td id="answer_tab_8">8</td>
                            <td id="answer_area_8"><a href="javascript:view_question(8)" class="line">미입력</a></td>
                        </tr>
                        <tr>
                            <td id="answer_tab_9">9</td>
                            <td id="answer_area_9"><a href="javascript:view_question(9)" class="line">미입력</a></td>
                        </tr>
                        <tr>
                            <td id="answer_tab_10">10</td>
                            <td id="answer_area_10"><a href="javascript:view_question(10)" class="line">미입력</a></td>
                        </tr>
                        <tr>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="btn-wrap c mg20t">
                <!--<a href="javascript:check_answer(document.answerform)" class="class-submit "><span>제 출</span></a>-->
                <a href="pop02.php" class="class-regist" onclick=""><span>제 출</span></a>
            </div>
        </div>


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
</div>

</body>
</html>