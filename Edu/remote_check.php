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

if (isset($_GET['action']) && $_GET['action'] === 'restore') {
    echo "=== RUNNING RESTORATION ===\n";
    
    $commands = [
        "cp -rp ../../gLms2/config.php ../config.php",
        "cp -r ../../gLms2/contents ../contents",
        "cp -r ../../gLms2/cyber ../cyber",
        "cp -r ../../gLms2/data ../data",
        "cp -r ../../gLms2/ebook ../ebook",
        "cp -r ../../gLms2/extend ../extend",
        "cp -r ../../gLms2/install ../install",
        "cp -r ../../gLms2/mobile ../mobile",
        "cp -r ../../gLms2/ns_view ../ns_view",
        "cp -r ../../gLms2/plugin ../plugin",
        "mkdir -p ../process",
        "cp -rn ../../gLms2/process/* ../process/"
    ];
    
    foreach ($commands as $cmd) {
        echo "Running: $cmd\n";
        $out = shell_exec($cmd . " 2>&1");
        echo "Result: " . ($out ? trim($out) : "Success") . "\n\n";
    }
    
    echo "=== POST-RESTORE PARENT DIRECTORY ===\n";
    $output = shell_exec("ls -la ../ 2>&1");
    echo $output . "\n";
    exit;
}

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
