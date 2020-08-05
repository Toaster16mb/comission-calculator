<?php
require_once 'vendor/autoload.php';

use ComCalc\CommissionFileRunner;
use ComCalc\CommissionCalculator;
use ComCalc\BinResultsLookupBinlist;
use ComCalc\EUDetector;
use ComCalc\FileContentGetter;
use ComCalc\RateExchangeRatesApi;

if (!isset($argv[1])) {
    die("Usage: php app.php {filename}");
}

$filename = $argv[1];

if (!is_file($filename)) {
    die("File not found");
}

$fp = fopen($filename, 'r');

try {
    $fileContentGetter = new FileContentGetter();
    $binResultsLookupBinlist = new BinResultsLookupBinlist($fileContentGetter);
    $rateExchangeRatesApi = new RateExchangeRatesApi($fileContentGetter);
    $euDetector = new EUDetector();
    $commissionCalculator = new CommissionCalculator($binResultsLookupBinlist, $rateExchangeRatesApi, $euDetector);
    $commissionFileRunner = new CommissionFileRunner($commissionCalculator);
    // We provide link to file to keep compatibility to relative paths
    $commissionFileRunner->printCommissionFromFile($fp, $filename);
} catch (Exception $e) {
    // Simple error logger
    $f_err = fopen('error.log', 'a');
    fputs($f_err, "[".date("Y-m-d H:i:s")."] ".$e->getMessage().PHP_EOL);
}

