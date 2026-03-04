<?php
include_once("./_common.php");

$sql = "SELECT * FROM sj_mileage_policy";
$result = sql_query($sql);

while ($row = sql_fetch_array($result)) {
    print_r($row);
}
?>