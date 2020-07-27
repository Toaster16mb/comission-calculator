<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 27.07.2020
 * Time: 7:49
 */

namespace ComCalc;


class ComissionCalculate
{
    public function CalclulateFromFile($fp, $filename) {
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
            $country_code = $binResLookup->getCountryCodeByBin($row_data['bin']);
            $rateExchangeRatesApi = new RateExchangeRatesApi($row_data['currency']);
            $amt_fixed = $rateExchangeRatesApi->getAmntFixedByCurrencyCode($row_data['amount']);
            $comission = EUDetector::isEu($country_code) ? 0.01 : 0.02;
            echo (ceil($amt_fixed * $comission * 100) / 100).PHP_EOL;
        }
    }
}