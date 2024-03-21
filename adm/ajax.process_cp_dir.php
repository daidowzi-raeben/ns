<?php
include_once('./_common.php');

$base_dir = SJ_PROCESS_PATH . "/compliance";

$df = opendir($base_dir);

while( $f = readdir($df) ) {
	if( $f == "." ||  $f == ".." ||  $f == "flv" ||  $f == "down" ||  $f == "common" ||  !is_dir($base_dir."/".$f) ) continue;
	$res["directory"][] = $f;
}

sort($res["directory"]);
$res["result"] = true;

echo json_encode($res);
?>