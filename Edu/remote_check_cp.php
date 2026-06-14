<?php
if (!isset($_GET['token']) || $_GET['token'] !== 'secret_raeben_2026') {
    die('Unauthorized');
}
header('Content-Type: text/plain; charset=utf-8');

echo "=== ACTIVE CP PROCESSES ===\n";
$output = shell_exec("ps aux | grep cp 2>&1");
echo $output . "\n";

echo "=== SIZE OF process/35 DIRECTORY ===\n";
$output = shell_exec("du -sh ../process/35 2>&1");
echo $output . "\n";

echo "=== SIZE OF gLms2/process/35 DIRECTORY ===\n";
$output = shell_exec("du -sh ../../gLms2/process/35 2>&1");
echo $output . "\n";

echo "=== FILE COUNT IN process/35 ===\n";
$output1 = shell_exec("find ../process/35 -type f | wc -l 2>&1");
$output2 = shell_exec("find ../../gLms2/process/35 -type f | wc -l 2>&1");
echo "gLms/process/35: " . trim($output1) . " files\n";
echo "gLms2/process/35: " . trim($output2) . " files\n\n";

echo "=== SIZE OF contents DIRECTORY ===\n";
$output = shell_exec("du -sh ../contents 2>&1");
echo $output . "\n";

echo "=== SIZE OF gLms2/contents DIRECTORY ===\n";
$output = shell_exec("du -sh ../../gLms2/contents 2>&1");
echo $output . "\n";
?>
