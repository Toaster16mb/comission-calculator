<?php
namespace ComCalc;

class CommissionCalculator
{
    private $binResLookup;
    private $rateExchangeRatesApi;
    private $euDetector;

    public function __construct(BinResultsInterface $binResLookup, RateInterface $rateExchangeRatesApi, $euDetector) {
        $this->binResLookup = $binResLookup;
        $this->rateExchangeRatesApi = $rateExchangeRatesApi;
        $this->euDetector = $euDetector;
    }

    public function calculateComission($bin, $currency, $amount) {
        $country_code = $this->binResLookup->getCountryCodeByBin($bin);
        $amtFixed = $this->rateExchangeRatesApi->getAmntFixedByCurrencyCode($amount, $currency);
        $commission = $this->euDetector->isEu($country_code) ? Configs::$commissionPercentEU : Configs::$commissionPercentNonEU;
        return (ceil($amtFixed * $commission * 100) / 100);
    }
}