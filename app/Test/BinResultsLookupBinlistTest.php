<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 27.07.2020
 * Time: 7:19
 */

namespace ComCalc\Test;
use ComCalc\BinResultsLookupBinlist;

class testBinResultsLookupBinlist extends \PHPUnit\Framework\TestCase
{
    public function testGetCountryCodeByBin()
    {
        $this->assertTrue("DK" === (new BinResultsLookupBinlist())->getCountryCodeByBin(45717360));
    }
}