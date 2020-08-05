<?php
namespace ComCalc;

class FileContentGetter
{
    public function fileGetContents($url, $additionalParams = array()) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        foreach ($additionalParams as $curlOpt => $additionalParamValue) {
            curl_setopt($ch, $curlOpt, $additionalParamValue);
        }

        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}