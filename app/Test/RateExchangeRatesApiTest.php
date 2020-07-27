<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 27.07.2020
 * Time: 7:20
 */

namespace ComCalc\Test;
use ComCalc\RateExchangeRatesApi;

class testRateExchangeRatesApi extends \PHPUnit\Framework\TestCase
{
    public function testGetAmntFixedByCurrencyCode() {
        $rateExchangeRatesApi = new RateExchangeRatesApi("EUR");
        $this->assertTrue(10.11 === $rateExchangeRatesApi->getAmntFixedByCurrencyCode(10.11));

        $rateExchangeRatesApi = new RateExchangeRatesApi("USD");
        $this->assertTrue($rateExchangeRatesApi->getAmntFixedByCurrencyCode(100) > 0);
    }
}