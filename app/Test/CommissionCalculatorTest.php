<?php

namespace ComCalc\Test;

use ComCalc\CommissionCalculator;
use ComCalc\BinResultsLookupBinlist;
use ComCalc\EUDetector;
use ComCalc\RateExchangeRatesApi;
use ComCalc\Configs;

class testCommissionCalculator extends \PHPUnit\Framework\TestCase
{
    public function testCalculateComission() {
        Configs::$commissionPercentEU = 0.01;
        Configs::$commissionPercentNonEU = 0.02;
        $binResLookup = $this->createMock(BinResultsLookupBinlist::class);
        $binResLookup->expects($this->atLeastOnce())
            ->method("getCountryCodeByBin")
            ->willReturnMap(
                array(
                    array(
                        45717360, "DK"
                    ),
                    array(
                        516793, "LT"
                    ),
                    array(
                        45417360, "JP"
                    ),
                )
            );

        $rateExchangeRatesApi = $this->createMock(RateExchangeRatesApi::class);
        $rateExchangeRatesApi->expects($this->atLeastOnce())
            ->method("getAmntFixedByCurrencyCode")
            ->willReturnMap(
                array(
                    array(
                        100, "EUR", 100
                    ),
                    array(
                        50, "USD", 42.498937526562
                    ),
                    array(
                        10000, "JPY", 80.141048244911
                    ),
                )
            );

        $euDetector = new EUDetector();

        $commissionCalculator = new CommissionCalculator($binResLookup, $rateExchangeRatesApi, $euDetector);

        $testCases = array(
            array(
                'bin' => 45717360,
                'currency' => "EUR",
                'amount' => 100,
                'expected_result' => 1
            ),
            array(
                'bin' => 516793,
                'currency' => "USD",
                'amount' => 50,
                'expected_result' => 0.43
            ),
            array(
                'bin' => 45417360,
                'currency' => "JPY",
                'amount' => 10000,
                'expected_result' => 1.61
            ),
        );

        foreach ($testCases as $tc) {
            $this->assertEquals($tc['expected_result'], $commissionCalculator->calculateComission($tc['bin'], $tc['currency'], $tc['amount']));
        }
    }
}