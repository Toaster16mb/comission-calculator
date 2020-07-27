<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 27.07.2020
 * Time: 7:49
 */

namespace ComCalc\Test;
use ComCalc\ComissionCalculate;

class testComissionCalculate extends \PHPUnit\Framework\TestCase
{
    public function testCalclulateFromFile() {
        $filename = "test.txt";
        $fp = fopen($filename, 'r');
        $comissionCalculate = new ComissionCalculate();
        ob_start();
        $comissionCalculate->CalclulateFromFile($fp, $filename);
        $res = ob_end_clean();
        $this->assertTrue($res == "10");
    }
}