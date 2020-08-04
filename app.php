<?php
require_once 'vendor/autoload.php';

use ComCalc\CommissionCalculate;

if (!isset($argv[1])) {
    die("Usage: php app.php {filename}");
}

$filename = $argv[1];

if (!is_file($filename)) {
    die("File not found");
}

$fp = fopen($filename, 'r');

try {
    $commissionCalculate = new CommissionCalculate();
    // We provide link to file to keep compatibility to relative paths
    $commissionCalculate->calclulateFromFile($fp, $filename);
} catch (Exception $e) {
    // Simple error logger
    $f_err = fopen('error.log', 'a');
    fputs($f_err, "[".date("Y-m-d H:i:s")."] ".$e->getMessage());
}

