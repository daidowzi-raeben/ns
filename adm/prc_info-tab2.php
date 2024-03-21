<?php
$sub_menu = "300100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['ethics_table']} ";

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
    $sst = "pc_no";
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


$g5['title'] = '과정관리 과정정보';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>

<div class="tbl_frm02 tbl_wrap">
    <!--<p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>-->
    <form id="fsearch" name="fsearch" class="local_sch01 local_sch11" method="get">
        <table>
            <colgroup>
                <col class="grid_4">
                <col>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_year">과정명</label></th>
                <td colspan="3">
                    NS윤리준법 시스템 사이버 교육
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_year">노출</label></th>
                <td >
                    노출
                </td>
                <th scope="row"><label for="mb_year">컨트롤바활성</label></th>
                <td >
                    비활성
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">시험</label></th>
                <td >
                    있음
                </td>
                <th scope="row"><label for="mb_stat">설문</label></th>
                <td >
                    없음
                </td>
            </tr>
            </tbody>
        </table>
        <div class="sch_div d-flex justify-content-center mt-2">
            <a href="prc_reg.php" class="btn btn_02">수정</a>
            <input type="button" class="btn btn_02 m-rl-5" value="삭제">
            <a href="" class="btn btn_02">목록</a>
        </div>
    </form>
</div>

<div>

    <a href="prc_info-tab1.php" class="btn btn_02">과정정보</a>
    <a href="prc_info-tab2.php" class="btn btn_03">수강생</a>
    <a href="prc_info-tab3.php" class="btn btn_02">진도관리</a>
    <a href="prc_info-tab4.php" class="btn btn_02">시험관리</a>
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
                <!--                <a href="./process_ce_form.php" id="member_add" class="btn btn_03">등록</a>-->
                <a href="./" id="member_add" class="btn btn_03">엑셀 다운로드</a>

            <?php } ?>
        </div>
    </div>


    <div class="tbl_head01 tbl_wrap">
        <table>
            <colgroup>
                <col width="100">
                <col>
                <col>
                <col width="130">
            </colgroup>
            <thead>
            <tr>
                <th scope="col" id="cp_list_no">순번</th>
                <th scope="col" id="cp_list_no">아이디</th>
                <th scope="col" id="cp_list_no">이름</th>
                <th scope="col" id="cp_list_no">부서</th>
                <th scope="col" id="cp_list_no">직급</th>
                <th scope="col" id="cp_list_no">직책</th>
                <th scope="col" id="cp_list_no">학습 시작일</th>
                <th scope="col" id="cp_list_no">학습 종료일</th>
                <th scope="col" id="cp_list_no">수료여부</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $i<10; $i++) { ?>
                <tr class="<?php echo $bg; ?>">
                    <td headers="cp_list_"  >1</td>
                    <td headers="cp_list_">20170923</td>
                    <td headers="cp_list_">홍길동</td>
                    <td headers="cp_list_">제품홍보영상 사업부</td>
                    <td headers="cp_list_">과장</td>
                    <td headers="cp_list_">팀장</td>
                    <td headers="cp_list_">2019-10-25</td>
                    <td headers="cp_list_">2019-11-15</td>
                    <td headers="cp_list_">수료</td>
                </tr>
                <?php
            } ?>
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
