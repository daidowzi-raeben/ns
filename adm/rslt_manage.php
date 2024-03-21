<?php
$sub_menu = "300420";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$quiz = get_quiz($no);

$sql_common = " from {$g5['qq_table']} as qq left join {$g5['question_table']} as q on (qq.qq_question = q.qq_no) ";

$sql_search = " where qq.qq_quiz_code = '{$no}' ";

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

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "qq.qq_no";
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


$g5['title'] = '시험지보기';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} ";
//echo $sql;
$result = sql_query($sql);

$colspan = 7;

//문항 추가
if( $step == "add" )
{
	## 기존 순서이후번호 얻기
	$new_seq = get_question_new_seq($no);
	
	for($i=0; $i<count($chk); $i++)
	{
		$question = get_question($chk[$i]);
		
		if($question)
		{
			$sql = "insert into {$g5['qq_table']} set 
						qq_quiz_code = '{$no}', 				
						qq_seq = '{$new_seq}', 
						qq_question = '{$chk[$i]}'";
			sql_query($sql);
			$new_seq++;
		}
	}
	
	$temp = sql_fetch("select count(*) as co from {$g5['qq_table']} where qq_quiz_code='{$no}'");
	$cnt = $temp['co'];
	
	$sql = "update {$g5['quiz_table']} set quiz_qcount='{$cnt}' where quiz_code='{$no}'";
	sql_query($sql);
	
	alert('문항을 등록했습니다.', './rslt_manage.php?no='.$no);
}
?>

<div class="tbl_frm02 tbl_wrap">
    <!--<p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>-->
    <form id="fsearch" name="fsearch" class="local_sch01 local_sch11" method="get">
        <table>
            <caption><?php echo $g5['title']; ?> 검색</caption>
            <colgroup>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_year">시험지명</label></th>
                <td>
                    <?php echo $quiz['quiz_name'];?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">시험 문항수</label></th>
                <td >
                    <?php echo $quiz['quiz_qcount'];?> 개
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

    <div class="local_ov02">
        <div class="l_div">
            <span class="btn_ov01"><span class="ov_txt">Total </span><span class="ov_num"> <?php echo $quiz['quiz_qcount'];?> 건 </span></span>
        </div>
        <div class="r_div">
            <?php if ($is_admin == 'super') { ?>
                <a href="#//" id="searchList" class="btn btn_03">문항검색</a>
            <?php } ?>
        </div>
    </div>

<style>
    .updownTable tbody tr:first-child .btn_03{display: none;}
    .updownTable tbody tr:last-child .btn_02{display: none;}
</style>

    <div class="tbl_head01 tbl_wrap updownTable">
        <table>
            <colgroup>
                <col width="100">
                <col>
                <col>
                <col>
                <col>
                <!--<col width="150">-->
                <col width="80">
            </colgroup>
            <thead>
            <tr>
                <th scope="col" id="cp_list_no">문제번호</th>
                <th scope="col" id="cp_list_no">문항형태</th>
                <th scope="col" id="cp_list_no">문항구분</th>
                <th scope="col" id="cp_list_no">문항내용</th>
                <th scope="col" id="cp_list_no">점수</th>
                <!--<th scope="col" id="cp_list_no"></th>-->
                <th scope="col" id="cp_list_no"></th>
            </tr>
            </thead>
            <tbody>
			<?php
			for ($i=0; $row=sql_fetch_array($result); $i++) {
			?>
            <tr data-id="row1">
                <td><?php echo $startNum?></td>
                <td><?php echo $ARR_QUESTION_TYPE[$row['qq_type']]?></td>
                <td><?php echo $ARR_QUESTION_AREA[$row['qq_kind']]?></td>
                <td style="text-align:left"><?php echo $row['qq_title'] ?></td>
                <td><?php echo $row['qq_point'] ?> 점</td>
                <!--<td>
                    <button type="button" class="btn btn_03 up">위로</button>
                    <button type="button" class="btn btn_02 down">아래로</button>
                </td>-->
                <td>
                    <button type="button" class="btn btn_01 closeId">삭제</button>
                </td>
            </tr>
			<?php
				$startNum++;
			}
			if ($i == 0)
				echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
			?>
            
            </tbody>
        </table>
    </div>
    <p>사용자는 랜덤으로 문제지가 생성 되므로 순서는 무관함</p>
	
	<!--문항검색 Div-->
	<div class="searchPop" id="searchPop-searchList" style="display: none;">
		<div class="searchPop__content">
		
			<div class="tbl_frm02 tbl_wrap">
				<form id="fsearch" name="fsearch" class="local_sch01 local_sch11" method="get">
					<table>
						<colgroup>
							<col class="grid_4">
							<col>
						</colgroup>
						<tbody>
						<tr>
							<th scope="row"><label for="mb_year">문항형태</label></th>
							<td>
								<select>
									<option value="">문항형태</option>
									<option value="">객관식단일형</option>
									<option value="">객관식다답형</option>
									<option value="">객관식 OX 형</option>
									<option value="">주관식단답형</option>
								</select>
								<select>
									<option value="">문항구분</option>
									<option value="">1차시</option>
									<option value="">2차시</option>
									<option value="">3차시</option>
									<option value="">4차시</option>
									<option value="">5차시</option>
								</select>
								<select>
									<option value="">사용여부</option>
									<option value="">사용중</option>
									<option value="">미사용</option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="mb_stat">질문</label></th>
							<td >
								<input type="text" class="new__input w100" style="">
							</td>
						</tr>
						</tbody>
					</table>
					<div class="sch_div">
						<input type="submit" class="btn btn_02" value="검색">
					</div>
				</form>
			</div>
			<?php
			$sql_common = " from {$g5['question_table']} ";
			$sql = " select count(qq_no) as cnt {$sql_common}";
			$row = sql_fetch($sql);
			$total_count = $row['cnt'];
			
			$sql = " select * {$sql_common} order by qq_no";
			#echo $sql;
			$qResult = sql_query($sql);
			?>
			<form name="flistform" id="flistform" action="<?=$PHP_SELF?>" onsubmit="return flistform_submit(this);" method="post">
			<input type="hidden" name="step" id="step" value="add" />
			<input type="hidden" name="no" id="no" value="<?php echo $no?>" />
				<div class="local_ov02">
					<div class="l_div">
						<span class="btn_ov01"><span class="ov_txt">Total </span><span class="ov_num"> <?php echo $total_count;?> 건 </span></span>
					</div>
				</div>

				<div class="tbl_head01 tbl_wrap">
					<table>
						<colgroup>
							<col width="100">
							<col width="150">
							<col width="150">
							<col>
						</colgroup>
						<thead>
						<tr>
							<th scope="col" id="">
								<input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
							</th>
							<th scope="col" id="">문항형태</th>
							<th scope="col" id="">문항구분</th>
							<th scope="col" id="">문항내용</th>
						</tr>
						</thead>
						<tbody>
						<?php
						for ($i=0; $row=sql_fetch_array($qResult); $i++) {
						?>
						<tr>
							<td>
								<input type="checkbox" class="checkbox" name="chk[]" id="qq_no_<?php echo $row['qq_no']?>" value="<?php echo $row['qq_no']?>">
							</td>
							<td><?php echo $ARR_QUESTION_TYPE[$row['qq_type']]?></td>
							<td><?php echo $ARR_QUESTION_AREA[$row['qq_kind']]?></td>
							<td style="text-align:left"><?php echo $row['qq_title'] ?></td>
						</tr>
						<?php
						}
						?>
						</tbody>
					</table>
				</div>
				<div class="sch_div">
					<input type="submit" class="btn btn_03" value="선택항목추가">
				</div>

			</form>


			<div class="sch_div d-flex justify-content-center mt-2">
				<a href="./rslt_manage.php?no=<?php echo $no?>" class="btn btn_01">닫기</a>
			</div>
		</div>
	</div>

<script>

    $(function(){

        $('.searchPop .sch_div .btn').on('click', function(){
            $(this).parents('.searchPop').hide();
        })
        $('#searchList').on('click', function(e){
            e.preventDefault();
            $('#searchPop-searchList').show();
        });


        $('.closeId').on('click', function(){
            $(this).parents('tr').remove();
        });

        $('.updownTable button.up').bind('click', function(){ moveUp(this) });
        $('.updownTable button.down').bind('click', function(){ moveDown(this) });

        function moveUp(el){
            var $tr = $(el).parent().parent();
            $tr.prev().before($tr);
        }

        function moveDown(el){
            var $tr = $(el).parent().parent();
            $tr.next().after($tr);
        }
    });


    function flistform_submit(f)
    {
        if (!is_checked("chk[]")) {
            alert("추가할 항목을 하나 이상 선택하세요.");
            return false;
        }

    }
 
</script>

<?php
include_once ('./admin.tail.php');
?>
