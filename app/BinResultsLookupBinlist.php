<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 27.07.2020
 * Time: 7:19
 */

namespace ComCalc;


class BinResultsLookupBinlist implements BinResultsInterface
{
    const API_URL = 'https://lookup.binlist.net/';
    public function getCountryCodeByBin($bin)
    {
        $bin_results = $this->file_get_contents_curl(self::API_URL.$bin);
        // if could not get contsnts CURL returns false
        if (!$bin_results) {
            throw new \Exception("Error: could not get BIN results from remote server ".self::API_URL." for BIN $bin");
        }
        $bin_results = json_decode($bin_results, true);
        // if could not decode JSON returns false
        if ($bin_results === false) {
            throw new \Exception("Error: could not decode BIN results from remote server ".self::API_URL." for BIN $bin");
        }
        // if got unexpected format there is no point to continue
        if (!isset($bin_results['country']['alpha2']) && empty($bin_results['country']['alpha2'])) {
            throw new \Exception("Error: unset or empty value for country code of BIN $bin");
        }

        return $bin_results['country']['alpha2'];
    }

    private function file_get_contents_curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        // @todo: add Authorization header as example authentication
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}