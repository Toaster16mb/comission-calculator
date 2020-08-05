<?php
namespace ComCalc;

class CommissionCalculator
{
    private $binResLookup;
    private $rateExchangeRatesApi;
    
    public function __construct(BinResultsInterface $binResLookup, RateInterface $rateExchangeRatesApi) {
        $this->binResLookup = $binResLookup;
        $this->rateExchangeRatesApi = $rateExchangeRatesApi;
    }

    public function calculateComission($bin, $currency, $amount) {
        $country_code = $this->binResLookup->getCountryCodeByBin($bin);
        $amtFixed = $this->rateExchangeRatesApi->getAmntFixedByCurrencyCode($amount, $currency);
        $euDetector = new EUDetector();
        $commission = $euDetector->isEu($country_code) ? Configs::$commissionPercentEU : Configs::$commissionPercentNonEU;
        return (ceil($amtFixed * $commission * 100) / 100);
    }
}