<?php
namespace ComCalc;

class RateExchangeRatesApi implements RateInterface
{
    private $fileContentGetter;

    public function __construct($fileContentGetter) {
        $this->fileContentGetter = $fileContentGetter;
    }

    public function getAmntFixedByCurrencyCode($amount, $currencyCode) {
        if ($currencyCode == "EUR") {
            return $amount;
        }

        $rate = $this->fileContentGetter->fileGetContents(Configs::$rateExchangeApiUrl);
        if (!$rate) {
            throw new \Exception("Error: could not get exchange rate from ".Configs::$rateExchangeApiUrl);
        }
        $rate = json_decode($rate, true);
        if ($rate === false) {
            throw new \Exception("Error: could not decode exchange rate results from remote server ".Configs::$rateExchangeApiUrl." for currency $currencyCode");
        }
        if (!isset($rate['rates'][$currencyCode]) || empty($rate['rates'][$currencyCode])) {
            throw new \Exception("Error: could not find exchange rate for $currencyCode in API ".Configs::$rateExchangeApiUrl);
        }
        if ($rate['rates'][$currencyCode] > 0) {
            return $amount / $rate['rates'][$currencyCode];
        } else {
            return $amount;
        }
    }
}