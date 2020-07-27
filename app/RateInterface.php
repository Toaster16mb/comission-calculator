<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 27.07.2020
 * Time: 7:18
 */

namespace ComCalc;


interface RateInterface
{
    public function getAmntFixedByCurrencyCode($amount);
    public function __construct($currency_code);
}