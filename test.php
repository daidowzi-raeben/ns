<?php
$link = mysql_connect('175.126.82.119', 'root', 'Rlxk5273');
if (!$link) {
    die('MySQL 접속 실패: ' . mysql_error());
}
echo 'MySQL 접속 성공!';
mysql_close($link);
?>