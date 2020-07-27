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
    const API_URL = 'https://api.exchangeratesapi.io/latest';
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
        $rate = $this->file_get_contents_curl(self::API_URL);
        if (!$rate) {
            throw new \Exception("Error: could not get exchange rate from ".self::API_URL);
        }
        $rate = json_decode($rate, true);
        if ($rate === false) {
            throw new \Exception("Error: could not decode exchange rate results from remote server ".self::API_URL." for currency $this->currency_code");
        }
        if (!isset($rate['rates'][$this->currency_code]) || empty($rate['rates'][$this->currency_code])) {
            throw new \Exception("Error: could not find exchange rate for $this->currency_code in API ".self::API_URL);
        }
        if ($rate['rates'][$this->currency_code] > 0) {
            return $amount / $rate['rates'][$this->currency_code];
        } else {
            return $amount;
        }
    }

    private function file_get_contents_curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        // @todo: add Authorization header as example authentication
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}