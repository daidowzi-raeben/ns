<?php
if (!isset($_GET['token']) || $_GET['token'] !== 'secret_raeben_2026') {
    die('Unauthorized');
}
header('Content-Type: text/plain; charset=utf-8');

define('_GNUBOARD_', true);
include_once('../data/dbconfig.php');

$cache_dir = '../data/cache';
echo "=== Cache Directory: $cache_dir ===\n";
if (is_dir($cache_dir)) {
    echo "Permissions: " . substr(sprintf('%o', fileperms($cache_dir)), -4) . "\n";
    echo "Owner ID: " . fileowner($cache_dir) . "\n";
    echo "Group ID: " . filegroup($cache_dir) . "\n";
    echo "Readable: " . (is_readable($cache_dir) ? 'Yes' : 'No') . "\n";
    echo "Writable: " . (is_writable($cache_dir) ? 'Yes' : 'No') . "\n";
    
    echo "\n=== Cache Files ===\n";
    $files = glob($cache_dir . "/*notice*");
    if (!empty($files)) {
        foreach ($files as $file) {
            echo "File: " . basename($file) . "\n";
            echo "Size: " . filesize($file) . " bytes\n";
            echo "Modified: " . date("Y-m-d H:i:s", filemtime($file)) . "\n";
            echo "Contents:\n";
            echo file_get_contents($file) . "\n\n";
        }
    } else {
        echo "No cache files matching *notice* found.\n";
    }
} else {
    echo "Cache directory does not exist or is not a directory!\n";
}

if (isset($_GET['clear']) && $_GET['clear'] === 'yes') {
    echo "=== Clearing Cache ===\n";
    $files = glob($cache_dir . "/*");
    foreach ($files as $file) {
        if (is_file($file)) {
            if (@unlink($file)) {
                echo "Deleted: " . basename($file) . "\n";
            } else {
                echo "Failed to delete: " . basename($file) . "\n";
            }
        }
    }
}
?>
