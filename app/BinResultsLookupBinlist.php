<?php
namespace ComCalc;

class BinResultsLookupBinlist implements BinResultsInterface
{
    private $fileContentGetter;

    public function __construct($fileContentGetter)
    {
        $this->fileContentGetter = $fileContentGetter;
    }

    public function getCountryCodeByBin($bin)
    {
        $binResults = $this->fileContentGetter->fileGetContents(Configs::$binResultsApiUrl.$bin);
        // if could not get contsnts CURL returns false
        if (!$binResults) {
            throw new \Exception("Error: could not get BIN results from remote server ".Configs::$binResultsApiUrl." for BIN $bin");
        }
        $binResults = json_decode($binResults, true);
        // if could not decode JSON returns false
        if ($binResults === false) {
            throw new \Exception("Error: could not decode BIN results from remote server ".Configs::$binResultsApiUrl." for BIN $bin");
        }
        // if got unexpected format there is no point to continue
        if (!isset($binResults['country']['alpha2']) && empty($binResults['country']['alpha2'])) {
            throw new \Exception("Error: unset or empty value for country code of BIN $bin");
        }

        return $binResults['country']['alpha2'];
    }
}