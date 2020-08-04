<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 27.07.2020
 * Time: 7:49
 */

namespace ComCalc\Test;
use ComCalc\CommissionCalculate;

class testCommissionCalculate extends \PHPUnit\Framework\TestCase
{
    public function testcalclulateFromFile() {
        $filename = "test.txt";
        $fp = fopen($filename, 'r');
        $commissionCalculate = new CommissionCalculate();
        ob_start();
        $commissionCalculate->calclulateFromFile($fp, $filename);
        $res = ob_end_clean();
        $this->assertTrue($res == "10");
    }
}