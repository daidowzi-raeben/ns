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


$g5['title'] = '콘텐츠신규등록';
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
                <col class="grid_4">
                <col>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_year">과정분류</label></th>
                <td>
                    <select>
                        <option value="">분류선택</option>
                        <option value="">윤리교육</option>
                        <option value="">준법교육</option>
                        <option value="">청렴교육</option>
                        <option value="">윤리준법교육</option>
                        <option value="">윤리준법청렴교육</option>
                    </select>
                </td>
                <th scope="row"><label for="mb_year">타입</label></th>
                <td colspan="3">
                    <select>
                        <option value="">타입선택</option>
                        <option value="">WBT</option>
                        <option value="">WEB</option>
                        <option value="">동영상</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">콘텐츠명</label></th>
                <td colspan="5">
                    <input type="text" class="new__input w100">

                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">URL</label></th>
                <td colspan="5">
                    <input type="text" class="new__input w50" placeholder="/ 이하 폴더만 입력">
                    <a href="#//" class="btn btn_02" id="findRslt">찾아보기</a>
                    <a href="#//" onclick="window.open('_preview.php', '_blank', 'width=1050, height=750')"  class="btn btn_03">미리보기</a>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">창크기</label></th>
                <td colspan="5">
                    <input type="text" class="new__input " placeholder=""> px
                    <span style="display:inline-block;margin:0 5px;">*</span>
                    <input type="text" class="new__input" placeholder=""> px
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">콘텐츠 시간</label></th>
                <td>
                    <input type="text" class="new__input"> 분
                </td>
                <th scope="row"><label for="mb_stat">콘텐츠 페이지</label></th>
                <td>
                    <input type="text" class="new__input"> 페이지
                </td>
                <th scope="row"><label for="mb_stat">학습시간</label></th>
                <td>
                    <input type="text" class="new__input"> 분
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">콘텐츠 시간</label></th>
                <td colspan="5">
                    <textarea>에디터영역</textarea>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">활성</label></th>
                <td colspan="5">
                    <label for="ck1">
                        <input type="radio" name="ck" id="ck1"> 활성
                    </label>
                    <label for="ck2">
                        <input type="radio" name="ck" id="ck2"> 비활성
                    </label>

                    <span style="display:inline-block;vertical-align: middle;margin-left: 1em;">(비활성 활성시에만 사용자가 강의를 볼 수 있음)</span>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_stat">상태</label></th>
                <td colspan="5">
                    <label for="ck3">
                        <input type="radio" name="ck2" id="ck3"> 사용
                    </label>
                    <label for="ck4">
                        <input type="radio" name="ck2" id="ck4"> 중지
                    </label>

                    <span style="display:inline-block;vertical-align: middle;margin-left: 1em;">(사용시에만 사용자가 강의를 추가 할 수 있음)</span>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="sch_div">
            <input type="submit" class="btn btn_03" value="신규등록">
            <a href="ct_list.php" class="btn btn_02">돌아가기</a>
        </div>
    </form>
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
    $('#findRslt').on('click', function(e){
        e.preventDefault();
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
