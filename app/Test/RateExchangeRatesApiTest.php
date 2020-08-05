<?php

namespace ComCalc\Test;

use ComCalc\FileContentGetter;
use ComCalc\RateExchangeRatesApi;

class testRateExchangeRatesApi extends \PHPUnit\Framework\TestCase
{
    public function testGetAmntFixedByCurrencyCode() {
        $fileContentGetter = $this->createMock(FileContentGetter::class);
        $fileContentGetter->expects($this->atLeastOnce())
            ->method('fileGetContents')
            ->willReturn('{"rates":{"CAD":1.5773,"HKD":9.1179,"ISK":160.0,"PHP":57.774,"DKK":7.4462,"HUF":344.73,"CZK":26.221,"AUD":1.6495,"RON":4.8358,"SEK":10.3025,"IDR":17276.9,"INR":88.3805,"BRL":6.2743,"RUB":86.7275,"HRK":7.4683,"JPY":124.78,"THB":36.608,"CHF":1.0761,"SGD":1.6195,"PLN":4.4055,"BGN":1.9558,"TRY":8.199,"CNY":8.2157,"NOK":10.7568,"NZD":1.7807,"ZAR":20.4879,"USD":1.1765,"MXN":26.7401,"ILS":4.0292,"GBP":0.90335,"KRW":1406.49,"MYR":4.9654},"base":"EUR","date":"2020-08-04"}');

        $rateExchangeRatesApi = new RateExchangeRatesApi($fileContentGetter);

        $this->assertEquals(10, $rateExchangeRatesApi->getAmntFixedByCurrencyCode(10, "EUR"));
        $this->assertEquals(0.625, $rateExchangeRatesApi->getAmntFixedByCurrencyCode(100, "ISK"));
    }
}