<?php
require_once 'vendor/autoload.php';

use ComCalc\ComissionCalculate;

if (!isset($argv[1])) {
    die("Usage: php app.php {filename}");
}

$filename = $argv[1];

if (!is_file($filename)) {
    die("File not found");
}

$fp = fopen($filename, 'r');

try {
    $comissionCalculate = new ComissionCalculate();
    // We provide link to file to keep compatibility to relative paths
    $comissionCalculate->CalclulateFromFile($fp, $filename);
} catch (Exception $e) {
    // Simple error logger
    $f_err = fopen('error.log', 'a');
    fputs($f_err, "[".date("Y-m-d H:i:s")."] ".$e->getMessage());
}

