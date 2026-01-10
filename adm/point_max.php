<?php
$sub_menu = "700200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from sj_mileage_policy ";

$sql_search = " where use_yn = 'Y' ";

if (!$sst) {
    $sst = "rel_table";
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

//List -> No
$strNo = $total_count;

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '마일리지적립관리';
include_once('./admin.head.php');

$sql = " select mp_id, rel_table, title, max_point, use_yn {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
?>

<form method="post" action="point_max_update.php">
    <div class="tbl_head01 tbl_wrap">
        <table>
            <thead>
                <tr>
                    <th>코드</th>
                    <th>항목명</th>
                    <th>최대 적립 점수</th>
                    <th>사용여부</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sql_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $row['rel_table']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td>
                        <input type="number" name="max_point[<?php echo $row['mp_id']; ?>]"
                            value="<?php echo $row['max_point']; ?>" class="frm_input" size="6">
                    </td>
                    <td><?php echo $row['use_yn']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="btn_confirm">
        <input type="submit" value="저장" class="btn_submit">
    </div>
</form>

<?php
include_once ('./admin.tail.php');
?>