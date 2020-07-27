<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 27.07.2020
 * Time: 7:34
 */

namespace ComCalc\Test;
use ComCalc\EUDetector;

class testEUDetector extends \PHPUnit\Framework\TestCase
{
    public function testIsEu() {
        $this->assertFalse(EUDetector::isEu("RU"));
        $this->assertFalse(EUDetector::isEu("NOT_EXISTING_COUNTRY"));
        $this->assertTrue(EUDetector::isEu("FR"));
    }
}