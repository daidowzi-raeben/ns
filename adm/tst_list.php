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

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "qq_no";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

if(!$rows)
	$rows = $config['cf_page_rows'];	

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$strNo = $total_count - (($page-1) * $rows);
//$strNo = $total_count;


$g5['title'] = '문항관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 6;
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
                <th scope="row"><label for="mb_year">검색</label></th>
                <td>
                    <select>
                        <option value="">문항형태</option>
                        <?php
						foreach( $ARR_QUESTION_TYPE as $tk => $tv ) {
							if( $type == $tk ) $ck =" selected";
							else $ck = "";
						?>
						<option value="<?=$tk?>"<?=$ck?>><?=$tv?></option>
						<?php
						}
						?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">문항내용</label></th>
                <td >
                    <input type="text" class="new__input">
                    <select name="rows">
                        <option value=""<?php if($rows=="15") echo " selected"?>>15개씩 보기</option>
						<option value="30"<?php if($rows=="30") echo " selected"?>>30개씩 보기</option>
						<option value="50"<?php if($rows=="50") echo " selected"?>>50개씩 보기</option>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="sch_div">
            <input type="submit" class="btn btn_02" value="검색">
        </div>
    </form>
</div>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="local_ov02">
        <div class="l_div">
            <span class="btn_ov01"><span class="ov_txt">Total </span><span class="ov_num"> <?php echo number_format($total_count) ?> 건 </span></span>
        </div>
        <div class="r_div">
            <?php if ($is_admin == 'super') { ?>
                <a href="tst_reg.php" id="member_add" class="btn btn_03">신규등록</a>
            <?php } ?>
        </div>
    </div>

    <div class="tbl_head01 tbl_wrap">
        <table>
            <colgroup>
                <col width="100">
                <col>
                <col>
                <col>
                <col>
                <col width="150">
            </colgroup>
            <thead>
            <tr>
                <th scope="col" id="cp_list_no">문제번호</th>
                <th scope="col" id="cp_list_no">문항형태</th>
                <th scope="col" id="cp_list_no">문항구분</th>
                <th scope="col" id="cp_list_no">문항내용</th>
                <th scope="col" id="cp_list_no">점수</th>
                <th scope="col" id="cp_list_no">기능</th>
            </tr>
            </thead>
            <tbody>
			<?php
			for ($i=0; $row=sql_fetch_array($result); $i++) {
			?>
            <tr>
                <td><?php echo $strNo ?></td>
                <td><?php echo $ARR_QUESTION_TYPE[$row['qq_type']]?></td>
                <td><?php echo $ARR_QUESTION_AREA[$row['qq_kind']]?></td>
                <td><?php echo $row['qq_title'] ?>(<?php echo $row['qq_std_answerA']?>)</td>
                <td><?php echo $row['qq_point'] ?> 점</td>
                <td>
                    <a href="./tst_reg.php?<?php echo $qstr?>&amp;w=u&amp;no=<?php echo $row['qq_no']?>" class="btn btn_02">수정</a>
                    <a href="#//" onclick="window.open('_preview.php?no=<?php echo $row['qq_no']?>', '_blank', 'width=1050, height=750')" class="btn btn_03">미리보기</a>
                </td>
            </tr>
			<?php
				$strNo--;
			}
			if ($i == 0)
				echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
			?>
            </tbody>
        </table>
    </div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
    function fmemberlist_submit(f)
    {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if(document.pressed == "선택삭제") {
            if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
                return false;
            }
        }

        return true;
    }


    function view_priview(v_dir) {

        var size_w = 1280;
        var size_h = 720;

        if( v_dir.length > 0 ) {
            window.open("<?php echo G5_URL ?>/process/ethics/"+v_dir+"/01/01.htm","content_preview","width="+size_w+"px,height="+size_h+"px");
        } else {
            alert("URL 입력후 미리보기가 가능합니다.")
        }
    }
</script>

<?php
include_once ('./admin.tail.php');
?>
