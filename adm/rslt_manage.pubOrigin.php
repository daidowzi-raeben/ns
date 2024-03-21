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


$g5['title'] = '시험관리/시험지관리';
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
                <th scope="row"><label for="mb_year">시험지명</label></th>
                <td>
                    NS윤리준법 시스템 사이버 교육 시험
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">시험 문항수</label></th>
                <td >
                    30 개
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

    <div class="local_ov02">
        <div class="l_div">
            <span class="btn_ov01"><span class="ov_txt">Total </span><span class="ov_num"> 3 건 </span></span>
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
                <col width="150">
                <col width="80">
            </colgroup>
            <thead>
            <tr>
                <th scope="col" id="cp_list_no">문제번호</th>
                <th scope="col" id="cp_list_no">문항형태</th>
                <th scope="col" id="cp_list_no">문항구분</th>
                <th scope="col" id="cp_list_no">문항내용</th>
                <th scope="col" id="cp_list_no">점수</th>
                <th scope="col" id="cp_list_no"></th>
                <th scope="col" id="cp_list_no"></th>
            </tr>
            </thead>
            <tbody>
            <tr data-id="row1">
                <td>30</td>
                <td>객관식단일형1</td>
                <td>2차시</td>
                <td></td>
                <td>10 점</td>
                <td>
                    <button type="button" class="btn btn_03 up">위로</button>
                    <button type="button" class="btn btn_02 down">아래로</button>
                </td>
                <td>
                    <button type="button" class="btn btn_01 closeId">삭제</button>
                </td>
            </tr>
            <tr data-id="row2">
                <td>30</td>
                <td>객관식단일형2</td>
                <td>2차시</td>
                <td></td>
                <td>10 점</td>
                <td>
                    <button type="button" class="btn btn_03 up">위로</button>
                    <button type="button" class="btn btn_02 down">아래로</button>
                </td>
                <td>
                    <button type="button" class="btn btn_01 closeId">삭제</button>
                </td>
            </tr>
            <tr data-id="row3">
                <td>30</td>
                <td>객관식단일형3</td>
                <td>2차시</td>
                <td></td>
                <td>10 점</td>
                <td>
                    <button type="button" class="btn btn_03 up">위로</button>
                    <button type="button" class="btn btn_02 down">아래로</button>
                </td>
                <td>
                    <button type="button" class="btn btn_01 closeId">삭제</button>
                </td>
            </tr>
            <tr data-id="row4">
                <td>30</td>
                <td>객관식단일형4</td>
                <td>2차시</td>
                <td></td>
                <td>10 점</td>
                <td>
                    <button type="button" class="btn btn_03 up">위로</button>
                    <button type="button" class="btn btn_02 down">아래로</button>
                </td>
                <td>
                    <button type="button" class="btn btn_01 closeId">삭제</button>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
    <p>사용자는 랜덤으로 문제지가 생성 되므로 순서는 무관함</p>

<div class="searchPop" id="searchPop-searchList" style="display: none;">
    <div class="searchPop__content">


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

        <form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
            <div class="local_ov02">
                <div class="l_div">
                    <span class="btn_ov01"><span class="ov_txt">Total </span><span class="ov_num"> 3 건 </span></span>
                </div>
            </div>

            <div class="tbl_head01 tbl_wrap">
                <table>
                    <colgroup>
                        <col width="100">
                        <col width="200">
                        <col width="150">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col" id="">
                            <input type="checkbox" id="select-all" >
                        </th>
                        <th scope="col" id="">문항형태</th>
                        <th scope="col" id="">문항구분</th>
                        <th scope="col" id="">문항내용</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input type="checkbox" class="checkbox">
                        </td>
                        <td>객관식단일형</td>
                        <td>1차시</td>
                        <td>윤리 라운드와 직접 관계없는 기관은?</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" class="checkbox">
                        </td>
                        <td>객관식단일형</td>
                        <td>1차시</td>
                        <td>윤리 라운드와 직접 관계없는 기관은?</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" class="checkbox">
                        </td>
                        <td>객관식단일형</td>
                        <td>1차시</td>
                        <td>윤리 라운드와 직접 관계없는 기관은?</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="sch_div">
                <input type="submit" class="btn btn_03" value="선택항목추가">
            </div>

        </form>


        <div class="sch_div d-flex justify-content-center mt-2">
            <a href="#//" class="btn btn_01">닫기</a>
        </div>
    </div>
</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

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
