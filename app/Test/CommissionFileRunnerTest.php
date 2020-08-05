<?php

namespace ComCalc\Test;

use ComCalc\CommissionCalculator;
use ComCalc\CommissionFileRunner;

class testCommissionFileRunner extends \PHPUnit\Framework\TestCase
{
    public function testPrintCommissionFromFile() {
        $commissionCalculator = $this->createMock(CommissionCalculator::class);
        $commissionCalculator->expects($this->atLeastOnce())
            ->method("calculateComission")
            ->willReturn(10);
        $commissionFileRunner = new CommissionFileRunner($commissionCalculator);
        $filename = dirname(__FILE__)."/test.txt";
        $fp = fopen($filename, "r");

        $this->assertNotFalse($fp);

        ob_start();
        try {
            $commissionFileRunner->printCommissionFromFile($fp, $filename);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        $results = ob_get_contents();
        ob_end_clean();

        $this->assertTrue($results === "10".PHP_EOL);
    }
}