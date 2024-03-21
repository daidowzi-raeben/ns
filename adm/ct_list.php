<?php
$sub_menu = "300300";
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


$g5['title'] = '콘텐츠정보목록';
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
                        <option value="">분류선택</option>
                        <option value="">윤리교육</option>
                        <option value="">준법교육</option>
                        <option value="">청렴교육</option>
                        <option value="">윤리준법교육</option>
                        <option value="">윤리준법청렴교육</option>
                    </select>
                    <select>
                        <option value="">타입선택</option>
                        <option value="">WBT</option>
                        <option value="">WEB</option>
                        <option value="">동영상</option>
                    </select>
                    <select>
                        <option value="">사용여부</option>
                        <option value="">사용</option>
                        <option value="">미사용</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">컨텐츠명</label></th>
                <td >
                    <input type="text" class="new__input">
                    <select>
                        <option value="">10개 보기</option>
                        <option value="">50개 보기</option>
                        <option value="">100개 보기</option>
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
            <span class="btn_ov01"><span class="ov_txt">Total </span><span class="ov_num"> 3 건 </span></span>
        </div>
        <div class="r_div">
            <?php if ($is_admin == 'super') { ?>
                <a href="./ct_reg.php" id="member_add" class="btn btn_03">신규등록</a>
            <?php } ?>
        </div>
    </div>

    <div class="tbl_head01 tbl_wrap">
        <table>
            <thead>
            <tr>
                <th scope="col" id="cp_list_no">번호</th>
                <th scope="col" id="cp_list_no">활성</th>
                <th scope="col" id="cp_list_no">분류</th>
                <th scope="col" id="cp_list_no">타입</th>
                <th scope="col" id="cp_list_no">컨텐츠정보명</th>
                <th scope="col" id="cp_list_no">등록자</th>
                <th scope="col" id="cp_list_no">등록일</th>
                <th scope="col" id="cp_list_no">수정일</th>
                <th scope="col" id="cp_list_no">관리</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>활성</td>
                    <td>준법</td>
                    <td>WBT</td>
                    <td>오리엔테이션</td>
                    <td>Admin</td>
                    <td>2019 10 25</td>
                    <td>2019 10 25</td>
                    <td>
                        <form action=""><button type="submit" class="btn btn_01">삭제</button></form>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>활성</td>
                    <td>준법</td>
                    <td>WBT</td>
                    <td>오리엔테이션</td>
                    <td>Admin</td>
                    <td>2019 10 25</td>
                    <td>2019 10 25</td>
                    <td>
                        <form action=""><button type="submit" class="btn btn_01">삭제</button></form>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>활성</td>
                    <td>준법</td>
                    <td>WBT</td>
                    <td>오리엔테이션</td>
                    <td>Admin</td>
                    <td>2019 10 25</td>
                    <td>2019 10 25</td>
                    <td>
                        <form action=""><button type="submit" class="btn btn_01">삭제</button></form>
                    </td>
                </tr>
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
