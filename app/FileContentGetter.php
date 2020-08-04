<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 04.08.2020
 * Time: 21:54
 */

namespace ComCalc;


class FileContentGetter
{
    private $url;
    private $additionalParams;

    public function __construct($url, $additionalParams = array()) {
        $this->url = $url;
        // Expected format of $additionalParams is array of CURLOPT_* key and corresponding value
        if (!empty($additionalParams) && is_array($additionalParams)) {
            $this->additionalParams = $additionalParams;
        }
    }

    public function fileGetContents() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $this->url);

        foreach ($this->additionalParams as $curlOpt => $additionalParamValue) {
            curl_setopt($ch, $curlOpt, $additionalParamValue);
        }

        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}