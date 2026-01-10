<?php
include_once('./_common.php');

auth_check($auth['700200'], 'w');

if (!isset($_POST['max_point']) || !is_array($_POST['max_point'])) {
    alert('잘못된 접근입니다.');
}

foreach ($_POST['max_point'] as $mp_id => $max_point) {
    $mp_id = (int)$mp_id;
    $max_point = (int)$max_point;

    sql_query("
        UPDATE sj_mileage_policy
        SET max_point = '{$max_point}'
        WHERE mp_id = '{$mp_id}'
    ");
}

alert('최대 적립 점수가 저장되었습니다.', './point_max.php');