<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 27.07.2020
 * Time: 7:49
 */

namespace ComCalc;


class CommissionCalculate
{
    public function calclulateFromFile($fp, $filename) {
        $line_number = 0;
        while ($row = fgets($fp)) {
            $line_number++;
            if (empty($row)) {
                continue;
            }
            $row_data = json_decode($row, true);
            if ($row_data === false) {
                throw new \Exception("Error: could not parse JSON string from input file $filename in line $line_number");
            }
            if (!isset($row_data['bin']) || empty($row_data['bin'])) {
                throw new \Exception("Error: BIN not found for row in $filename in line $line_number");
            }
            if (!isset($row_data['amount']) || empty($row_data['amount'])) {
                throw new \Exception("Error: amount not found for row in $filename in line $line_number");
            }
            if (!isset($row_data['currency']) || empty($row_data['currency'])) {
                throw new \Exception("Error: currency not found for row in $filename in line $line_number");
            }
            $binResLookup = new BinResultsLookupBinlist();
            // Here we can change class that implements BinResultsInterface
            $country_code = $binResLookup->getCountryCodeByBin($row_data['bin']);
            $rateExchangeRatesApi = new RateExchangeRatesApi($row_data['currency']);
            // Here we can change class that implements RateInterface
            $amt_fixed = $rateExchangeRatesApi->getAmntFixedByCurrencyCode($row_data['amount']);
            $commission = EUDetector::isEu($country_code) ? Configs::$commissionPercentEU : Configs::$commissionPercentNonEU;
            echo (ceil($amt_fixed * $commission * 100) / 100).PHP_EOL;
        }
    }
}