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


$g5['title'] = '과정관리/과정목록';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>


<link rel="stylesheet" href="/_Js/jquery-ui/jquery-ui.min.css" />
<script src="/_Js/jquery-ui/jquery-ui.min.js"></script>
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
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_year">과정 분류</label></th>
                <td>
                    <select name="" id="">
                        <option value="">과정분류</option>
                        <option value="">윤리교육</option>
                        <option value="">준법교육</option>
                        <option value="">청렴교육</option>
                        <option value="">윤리준법교육</option>
                        <option value="">윤리준법청렴교육</option>
                    </select>
                </td>
                <th scope="row">과정개설연도</th>
                <td>
                    <select name="" id="">
                        <option value="">2019년도</option>
                        <option value="">2020년도</option>
                        <option value="">2021년도</option>
                        <option value="">2022년도</option>
                        <option value="">2023년도</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">과정명</th>
                <td colspan="3">
                    <input type="text" class="new__input w100">
                </td>
            </tr>
            <tr>
                <th scope="row">개설기간</th>
                <td>
                    <input type="text" class="new__input datepicker"> ~ <input type="text" class="new__input datepicker">
                </td>
                <th scope="row">컨트롤바 활성</th>
                <td>
                    <label for="ck3">
                        <input type="radio" name="ck2" id="ck3"> 활성
                    </label>
                    <label for="ck4">
                        <input type="radio" name="ck2" id="ck4"> 비활성
                    </label>
                </td>
            </tr>
            <tr>
                <th scope="row">노출</th>
                <td>
                    <label for="ck6">
                        <input type="radio" name="ck3" id="ck6"> 노출
                    </label>
                    <label for="ck5">
                        <input type="radio" name="ck3" id="ck5"> 숨김
                    </label>
                </td>
                <th scope="row">인정시간</th>
                <td>
                    <select name="" id="">
                        <option value="">0시간</option>
                        <option value="">1시간</option>
                        <option value="">2시간</option>
                        <option value="">3시간</option>
                        <option value="">4시간</option>
                        <option value="">5시간</option>
                        <option value="">6시간</option>
                        <option value="">7시간</option>
                        <option value="">8시간</option>
                        <option value="">9시간</option>
                        <option value="">10시간</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">과정구분</th>
                <td>
                    <label for="ck7">
                        <input type="radio" name="ck4" id="ck7"> 온라인과정
                    </label>
                    <label for="ck8">
                        <input type="radio" name="ck4" id="ck8"> 집합과정
                    </label>
                </td>
                <th scope="row">수료조건</th>
                <td>
                    <select name="" id="">
                        <?php for($i=0; $i<=20; $i++) { ?>
                        <option value=""><?= $i*5; ?>%</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_year">파일</label></th>
                <td colspan="3">
                    <input type="file">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_year">수료증</label></th>
                <td colspan="3">
                    <input type="file">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_year">과정소개</label></th>
                <td colspan="3">
                    <textarea name="" id=""></textarea>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="mb_year">시험</label></th>
                <td >
                    <button class="btn btn_02" id="findTst" type="button">찾아보기</button>
                </td>
                <th scope="row"><label for="mb_year">합격점수</label></th>
                <td >
                    <input type="text" class="new__input"> 점 이상
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_year">설문</label></th>
                <td colspan="3">
                    <button class="btn btn_02" id="findRslt" type="button">찾아보기</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="sch_div">
            <input type="submit" class="btn btn_03" value="과정등록">
            <a href="./prc_list.php" class="btn btn_02">돌아가기</a>
        </div>
    </form>
</div>


<div class="searchPop" id="searchPop-tst" style="display: none;">
    <div class="searchPop__content">
        <div class="searchPop__row searchPop__row--title">
            <h3 class="searchPop__row-title">과정명</h3>
            <p>
                NS윤리준법 시스템 사이버 교육 설문
            </p>
        </div>
        <div class="searchPop__row searchPop__row--search">
            <h3 class="searchPop__row-title">검색어</h3>
            <div>
                <input type="text" class="new__input"> <button type="button" class="btn btn_03">검색</button>
            </div>
        </div>
        <div class="searchPop__row searchPop__row--table">
            <table>
                <colgroup>
                    <col width="90">
                    <col width="50">
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th>선택</th>
                    <th>번호</th>
                    <th>시험지분류</th>
                    <th>시험지명</th>
                    <th>문항수</th>
                    <th>관리자</th>
                    <th>등록일시</th>
                    <th>수정일시</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <button class="btn btn_02">선택</button>
                    </td>
                    <td>4</td>
                    <td></td>
                    <td>NS윤리준법 시스템 사이버 교육 시험</td>
                    <td>10</td>
                    <td>admin</td>
                    <td>2018-06-24</td>
                    <td>2018-06-24</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="sch_div d-flex justify-content-center mt-2">
            <a href="#//" class="btn btn_01">닫기</a>
        </div>
    </div>
</div>


<div class="searchPop" id="searchPop-rslt" style="display: none;">
    <div class="searchPop__content">
        <div class="searchPop__row searchPop__row--title">
            <h3 class="searchPop__row-title">과정명</h3>
            <p>
                NS윤리준법 시스템 사이버 교육 설문
            </p>
        </div>
        <div class="searchPop__row searchPop__row--search">
            <h3 class="searchPop__row-title">검색어</h3>
            <div>
                <input type="text" class="new__input"> <button type="button" class="btn btn_03">검색</button>
            </div>
        </div>
        <div class="searchPop__row searchPop__row--table">
            <table>
                <colgroup>
                    <col width="90">
                    <col width="50">
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th>선택</th>
                    <th>번호</th>
                    <th>설문명</th>
                    <th>문항수</th>
                    <th>참여자 수</th>
                    <th>수정일시</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <button class="btn btn_02">선택</button>
                    </td>
                    <td>4</td>
                    <td>NS윤리준법 시스템 사이버 교육 설문</td>
                    <td>10</td>
                    <td>2</td>
                    <td>2018-06-24</td>
                </tr>
               
                </tbody>
            </table>
        </div>
        <div class="sch_div d-flex justify-content-center mt-2">
            <a href="#//" class="btn btn_01">닫기</a>
        </div>
    </div>
</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
    $('.searchPop .sch_div .btn').on('click', function(){
        $(this).parents('.searchPop').hide();
    })
    $('#findTst').on('click', function(){
        $('#searchPop-tst').show();
    });
    $('#findRslt').on('click', function(){
        $('#searchPop-rslt').show();
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
