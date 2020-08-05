<?php
namespace ComCalc;

class EUDetector
{
    public static function isEu($country) {
        return in_array($country, Configs::$euList);
    }
}