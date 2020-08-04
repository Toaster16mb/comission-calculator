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
    public function getCountryCodeByBin($bin)
    {
        $fileContentGetter = new FileContentGetter(Configs::$binResultsApiUrl.$bin);

        $bin_results = $fileContentGetter->fileGetContents();
        // if could not get contsnts CURL returns false
        if (!$bin_results) {
            throw new \Exception("Error: could not get BIN results from remote server ".Configs::$binResultsApiUrl." for BIN $bin");
        }
        $bin_results = json_decode($bin_results, true);
        // if could not decode JSON returns false
        if ($bin_results === false) {
            throw new \Exception("Error: could not decode BIN results from remote server ".Configs::$binResultsApiUrl." for BIN $bin");
        }
        // if got unexpected format there is no point to continue
        if (!isset($bin_results['country']['alpha2']) && empty($bin_results['country']['alpha2'])) {
            throw new \Exception("Error: unset or empty value for country code of BIN $bin");
        }

        return $bin_results['country']['alpha2'];
    }
}