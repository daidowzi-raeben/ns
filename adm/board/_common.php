<?php
define('G5_IS_ADMIN', true);
include_once ('../../common.php');
if ($board['bo_table']  == "notice") {
	$sub_menu = "800100";
}
else if ($board['bo_table']  == "e_campaign") {
	$sub_menu = "400100";
}
else if ($board['bo_table']  == "e_story") {
	$sub_menu = "400200";
}
else if ($board['bo_table']  == "p_campaign") {
	$sub_menu = "300100";
}
else if ($board['bo_table']  == "lglsup") {
	$sub_menu = "800200";
}
else if ($board['bo_table']  == "free") {
	$sub_menu = "800300";
}
else if ($board['bo_table']  == "data") {
	$sub_menu = "800400";
}
else if ($board['bo_table']  == "qa") {
	$sub_menu = "800600";
}
else if ($board['bo_table']  == "schedule") {
	$sub_menu = "500100";
}
else if ($board['bo_table']  == "cns") {
	$sub_menu = "800700";
}
include_once(G5_ADMIN_PATH.'/admin.lib.php');
?>