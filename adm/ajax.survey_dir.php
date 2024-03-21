<?php
include_once('./_common.php');

$base_dir = SJ_SURVEY_PATH . "/form";

$df = opendir($base_dir);

while( $f = readdir($df) ) {
	//if( $f == "." ||  $f == ".." ||  $f == "css" ||  $f == "images" ||  $f == "common" ||  !is_dir($base_dir."/".$f) ) continue;
	if( $f == "." ||  $f == ".." ||  $f == "css" ||  $f == "images" ) continue;
	$res["directory"][] = $f;
}

sort($res["directory"]);
$res["result"] = true;

echo json_encode($res);
?>