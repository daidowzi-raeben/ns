<?php
if (!isset($_GET['token']) || $_GET['token'] !== 'secret_raeben_2026') {
    die('Unauthorized');
}
header('Content-Type: text/plain; charset=utf-8');

echo "=== CURRENT DIRECTORY ===\n";
echo getcwd() . "\n\n";

echo "=== GIT STATUS ===\n";
$output = shell_exec("git status 2>&1");
echo $output . "\n";

echo "=== DEVIATIONS / DIFF ===\n";
$output = shell_exec("git diff 2>&1");
echo $output . "\n";

echo "=== LS parent directory ===\n";
$output = shell_exec("ls -la ../ 2>&1");
echo $output . "\n";

echo "=== LS SEJONG HOME DIRECTORY ===\n";
$output = shell_exec("ls -la ../../ 2>&1");
echo $output . "\n";

echo "=== LS GLMS2 DIRECTORY ===\n";
$output = shell_exec("ls -la ../../gLms2/ 2>&1");
echo $output . "\n";

echo "=== LS PROCESS/35/COMMON ===\n";
$output = shell_exec("ls -la ../process/35/common/ 2>&1");
echo $output . "\n";

echo "=== LS PROCESS/35/COMMON/JS ===\n";
$output = shell_exec("ls -la ../process/35/common/js/ 2>&1");
echo $output . "\n";
?>
