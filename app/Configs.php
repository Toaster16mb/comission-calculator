<?php
namespace ComCalc;

class Configs
{
    public static $rateExchangeApiUrl      = 'https://api.exchangeratesapi.io/latest';
    public static $binResultsApiUrl        = 'https://lookup.binlist.net/';
    public static $commissionPercentEU     = 0.01;
    public static $commissionPercentNonEU  = 0.02;
    public static $euList                  = Array(
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