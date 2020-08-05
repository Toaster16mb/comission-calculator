<?php
namespace ComCalc;

interface RateInterface
{
    public function getAmntFixedByCurrencyCode($amount, $currencyCode);
}