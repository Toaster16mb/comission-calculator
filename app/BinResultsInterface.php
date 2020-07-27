<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 27.07.2020
 * Time: 7:17
 */

namespace ComCalc;


interface BinResultsInterface
{
    public function getCountryCodeByBin($bin);
}