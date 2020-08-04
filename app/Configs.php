<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 04.08.2020
 * Time: 22:27
 */

namespace ComCalc;


class Configs
{
    public static $rateExchangeApiUrl     = 'https://api.exchangeratesapi.io/latest';
    public static $binResultsApiUrl       = 'https://api.exchangeratesapi.io/latest';
    public static $commissionPercentEU    = 0.01;
    public static $commissionPercentNonEU = 0.02;
    public static $EUList                 = Array(
        'AT',
        'BE',
        'BG',
        'CY',
        'CZ',
        'DE',
        'DK',
        'EE',
        'ES',
        'FI',
        'FR',
        'GR',
        'HR',
        'HU',
        'IE',
        'IT',
        'LT',
        'LU',
        'LV',
        'MT',
        'NL',
        'PO',
        'PT',
        'RO',
        'SE',
        'SI',
        'SK',
    );
}