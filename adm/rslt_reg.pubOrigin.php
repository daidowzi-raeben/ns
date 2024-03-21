<?php
$sub_menu = "300420";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['quiz_table']} ";

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
    $sst = "quiz_code";
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

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
?>




<script>
    $(document).ready(function(){
        $('.datepicker').datepicker();
    })
</script>

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
                <th scope="row"><label for="mb_year">시험지 분류</label></th>
                <td>
                    <input type="text" class="new__input">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_year">시험지 명</label></th>
                <td>
                    <input type="text" class="new__input w100">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_year">등록일</label></th>
                <td>
                    <input type="text" class="new__input datepicker">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_year">수정일</label></th>
                <td>
                    <input type="text" class="new__input datepicker">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_year">총 문항수</label></th>
                <td>
                    <input type="text" class="new__input"> 문항
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_year">출제 문항수</label></th>
                <td>
                    <input type="text" class="new__input"> 문항
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_year">개별 문항점수</label></th>
                <td>
                    <input type="text" class="new__input"> 점
                </td>
            </tr>

            </tbody>
        </table>
        <div class="sch_div">
            <input type="submit" class="btn btn_03" value="등록">
            <a href="rslt_list.php" class="btn btn_02">닫기</a>
        </div>
    </form>
</div>


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
