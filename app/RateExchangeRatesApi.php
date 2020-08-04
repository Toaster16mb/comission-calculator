<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 27.07.2020
 * Time: 7:20
 */

namespace ComCalc;


class RateExchangeRatesApi implements RateInterface
{
    public $currency_code;

    public function __construct($currency_code)
    {
        $this->currency_code = $currency_code;
    }

    public function getAmntFixedByCurrencyCode($amount)
    {
        if ($this->currency_code == "EUR") {
            return $amount;
        }
        $fileContentGetter = new FileContentGetter(Configs::$rateExchangeApiUrl);
        $rate = $fileContentGetter->fileGetContents();
        if (!$rate) {
            throw new \Exception("Error: could not get exchange rate from ".Configs::$rateExchangeApiUrl);
        }
        $rate = json_decode($rate, true);
        if ($rate === false) {
            throw new \Exception("Error: could not decode exchange rate results from remote server ".Configs::$rateExchangeApiUrl." for currency $this->currency_code");
        }
        if (!isset($rate['rates'][$this->currency_code]) || empty($rate['rates'][$this->currency_code])) {
            throw new \Exception("Error: could not find exchange rate for $this->currency_code in API ".Configs::$rateExchangeApiUrl);
        }
        if ($rate['rates'][$this->currency_code] > 0) {
            return $amount / $rate['rates'][$this->currency_code];
        } else {
            return $amount;
        }
    }
}