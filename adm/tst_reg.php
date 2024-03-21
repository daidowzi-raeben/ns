<?php
$sub_menu = "300410";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['question_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "qq_no";
    $sod = "asc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$startNum = 1 + (($page-1) * 15);


$g5['title'] = '시험관리 문항관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;

//tst_reg.php 사용 변수
if($w == "")
{
	$required_tst = 'required';
	$ex_count = 4;
	$qpoint = 10;
	$qtime = 10;
}
else if ($w == 'u')
{
	$required_tst = 'required';
	
	$qstn = get_question($no);
	if (!$qstn['qq_no'])
        alert('존재하지 않는 문항입니다.');
	
	//$qstn['mb_name'] = get_text($qstn['mb_name']);
	$qpoint = $qstn['qq_point'];
	$qstn['qq_title'] = get_text($qstn['qq_title']);
	$qstn['qq_guide'] = get_text($qstn['qq_guide']);
	
	$qq_no = $qstn['qq_no'];
}
?>

<div class="tbl_frm02 tbl_wrap">
    
    <form action="./tst_reg_update.php" enctype="multipart/form-data" method="post" name="qqform" id="qqform" onsubmit="return qcheck(this)">
		<input type="hidden" name="qq_no" value="<?=$qq_no?>" />
		<input type="hidden" name="w" value="<?=$w?>" />
		<!--  보기 수 -->
		<input type="hidden" name="qq_count_ex" id="qq_count_ex" value="<?=($ex_count)?$ex_count:"2";?>" />				
        <table>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_year">문항구분</label></th>
                <td>
                    <select name="qq_kind" id="qq_kind" <?php echo $required_tst ?>>
                        <option value="">문항구분선택</option>
                        <option value="Q001"<?if( $qstn['qq_kind'] == "Q001" ){?> selected<?}?>>1차시</option>
                        <option value="Q002"<?if( $qstn['qq_kind'] == "Q002" ){?> selected<?}?>>2차시</option>
                        <option value="Q003"<?if( $qstn['qq_kind'] == "Q003" ){?> selected<?}?>>3차시</option>
                        <option value="Q004"<?if( $qstn['qq_kind'] == "Q004" ){?> selected<?}?>>4차시</option>
                        <option value="Q005"<?if( $qstn['qq_kind'] == "Q005" ){?> selected<?}?>>5차시</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_year">문제형식</label></th>
                <td>
                    <label for="ck5">
                        <input type="radio" name="qq_type" id="ck5" value="A"<?if( $w == "" || $qstn['qq_type'] == "A" ){?> checked<?}?>> 객관식 단일형
                    </label>
                    <label for="ck6">
                        <input type="radio" name="qq_type" id="ck6" value="C" <?if( $qstn['qq_type'] == "C" ){?> checked<?}?>> 객관식 다중형
                    </label>
                    <label for="ck7">
                        <input type="radio" name="qq_type" id="ck7" value="B" onclick="change_answerType('B')" <?if( $qstn['qq_type'] =="B" ){?> checked<?}?>> 주관식 단답형
                    </label>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">점수</label></th>
                <td colspan="5">
                    <input type="text" class="new__input" name="qq_point" value="<?=$qpoint?>"> 점
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">질문</label></th>
                <td colspan="5">
                    <textarea name="qq_title" id="qq_title" cols="30" rows="5" maxlength="300" <?php echo $required_tst ?>><?=stripslashes($qstn['qq_title'])?></textarea>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="mb_stat">답안</label>
                    <div class="d-flex justify-content-center mt-2">
                        <button id="add__answer" class="btn btn_03 " type="button">추가</button>
                        <button id="remove__answer" class="btn btn_01 ml-1" type="button">제거</button>
                    </div>
                </th>
                <td colspan="5">
                    <ul class="answer_list" id="answer_list">
					<?php
					if( $qstn['qq_type'] == "A" )
						$ex = explode($_TAB, $qstn['qq_ex']);
					?>
                        <li class="answer_item" id="answer_item1">
                            <label for="c1">
                                <strong>보기 1</strong>
								<input type="checkbox" name="qq_answerA[]" id="qq_answerA_1" value="1"<?if( ($question_info->qq_type=="A" && $question_info->qq_std_answerA=="1") || ($question_info->qq_type=="C" && in_array("1",$question_info->qq_std_answerC_arr) == true)  ){?> checked<?}?>>
                            </label>
                            <input type="text" name="qq_ex1" id="qq_ex1" class="new__input" maxlength="200" value="<?=$ex[0]?>" />
                        </li>
                        <li class="answer_item" id="answer_item2">
                            <label for="c2">
                                <strong>보기 2</strong>
                                <input type="checkbox" name="qq_answerA[]" id="qq_answerA_2" value="2"<?if( ($question_info->qq_type=="A" && $question_info->qq_std_answerA=="2") || ($question_info->qq_type=="C" && in_array("2",$question_info->qq_std_answerC_arr) == true)  ){?> checked<?}?>>
                            </label>
							<input type="text" name="qq_ex2" id="qq_ex2" class="new__input" maxlength="200" value="<?=$ex[1]?>" />
                        </li>
                        <li class="answer_item" id="answer_item3">
                            <label for="c3">
                                <strong>보기 3</strong>
                                <input type="checkbox" name="qq_answerA[]" id="qq_answerA_3" value="3"<?if( ($question_info->qq_type=="A" && $question_info->qq_std_answerA=="3") || ($question_info->qq_type=="C" && in_array("3",$question_info->qq_std_answerC_arr) == true)  ){?> checked<?}?>>
                            </label>
							<input type="text" name="qq_ex3" id="qq_ex3" class="new__input" maxlength="200" value="<?=$ex[2]?>" />
                        </li>
                        <li class="answer_item" id="answer_item4">
                            <label for="c4">
                                <strong>보기 4</strong>
                                <input type="checkbox" name="qq_answerA[]" id="qq_answerA_4" value="4"<?if( ($question_info->qq_type=="A" && $question_info->qq_std_answerA=="4") || ($question_info->qq_type=="C" && in_array("4",$question_info->qq_std_answerC_arr) == true)  ){?> checked<?}?>>
                            </label>
							<input type="text" name="qq_ex4" id="qq_ex4" class="new__input" maxlength="200" value="<?=$ex[3]?>" />
                        </li>
                    </ul>

                    <script>
                        $(function(){
                            var answerNumber = 5;
                            $('#add__answer').on('click', function(){
                                $('#answer_list').append('<li class="answer_item" id="answer_item'+answerNumber+'"><label for="c'+answerNumber+'"><strong>보기 '+answerNumber+'</strong><input type="checkbox" id="c'+answerNumber+'"></label><input type="text" class="new__input" maxlength="200"></li>')
                                answerNumber++;
                            })
                            $('#remove__answer').on('click', function(){
                                answerNumber--;
                                $('#answer_item'+answerNumber).remove();
                            })
                        })
                    </script>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">설명</label></th>
                <td colspan="5">
                    <textarea name="qq_guide" id="qq_guide" cols="30" rows="10"><?=stripslashes($qstn['qq_guide'])?></textarea>
                </td>
            </tr>

            </tbody>
        </table>
        <div class="sch_div">
            <input type="submit" class="btn btn_03" value="확인">
            <a href="tst_list.php" class="btn btn_02">닫기</a>
        </div>
    </form>
</div>

<script>
    function qcheck(frm){
		var rtn = true;
		
		/*if( rtn == true && $("#qq_seq").val().length < 1 ) {
				alert('문제번호를 입력해주세요.');
				rtn = false;
		}*/
		
		
		if( rtn == true && $("#qq_title").val().length < 1 ) {
				alert('문제를 입력해주세요.');
				rtn = false;
		}
		if( rtn == true && frm.qq_type.value == 'A' ) {
			var co_answer = 0;
			$("input[id^='qq_answerA_']:checkbox").each(function(i) {
					co_answer = 1;
					
					
			});
				if( aa == false ) {
					alert('답을 선택해주세요.');
					rtn = false;
				}
		}
		if( rtn == true && frm.qq_type.value == 'B' ) {

				if( rtn = false && frm.qq_answerB.value.length <= 1 ) {
					alert('답을 입력해주세요.');
					rtn = false;
				}

		}
		return rtn;
	}
</script>

<?php
include_once ('./admin.tail.php');
?>
