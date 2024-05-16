<?php
include_once('./_common.php');

$base_dir = SJ_PROCESS_PATH . '/_Img/lssn_img';

$df = opendir($base_dir);

while( $f = readdir($df) ) {
	if( $f == "." ||  $f == ".." ||  is_dir($base_dir."/".$f) ) continue;
	$res["directory"][] = $f;
}

sort($res["directory"]);
$res["result"] = true;

echo json_encode($res);
?>