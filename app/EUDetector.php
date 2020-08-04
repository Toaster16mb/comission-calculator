<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 27.07.2020
 * Time: 7:34
 */

namespace ComCalc;


class EUDetector
{
    public static function isEu($country) {
        return in_array($country, Configs::$EUList);
    }
}