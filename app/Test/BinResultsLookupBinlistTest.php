<?php
namespace ComCalc\Test;

use ComCalc\BinResultsLookupBinlist;
use ComCalc\FileContentGetter;

class testBinResultsLookupBinlist extends \PHPUnit\Framework\TestCase
{
    public function testGetCountryCodeByBin() {
        $fileContentGetter = $this->createMock(FileContentGetter::class);
        $fileContentGetter->expects($this->atLeastOnce())
            ->method('fileGetContents')
            ->willReturn('{"number":{"length":16,"luhn":true},"scheme":"visa","type":"debit","brand":"Visa/Dankort","prepaid":false,"country":{"numeric":"208","alpha2":"DK","name":"Denmark","emoji":"��","currency":"DKK","lat  itude":56,"longitude":10},"bank":{"name":"Jyske Bank","url":"www.jyskebank.dk","phone":"+4589893300","city":"Hjørring"}}');
        $binResultsLookupBinlist = new BinResultsLookupBinlist($fileContentGetter);
        $this->assertEquals("DK", $binResultsLookupBinlist->getCountryCodeByBin(45717360));
    }
}