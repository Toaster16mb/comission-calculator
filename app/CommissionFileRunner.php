<?php
namespace ComCalc;

class CommissionFileRunner
{
    private $commissionCalculator;
    private $filename;
    private $lineNumber = 0;

    public function __construct($commissionCalculator) {
        $this->commissionCalculator = $commissionCalculator;
    }

    public function printCommissionFromFile($fp, $filename) {
        $this->filename = $filename;
        while ($row = fgets($fp)) {
            $this->lineNumber++;
            if (empty($row)) {
                continue;
            }
            $rowData = $this->parseRow($row);
            echo $this->commissionCalculator->calculateComission($rowData['bin'], $rowData['currency'], $rowData['amount']).PHP_EOL;
        }
    }

    private function parseRow($row) {
        $rowData = json_decode($row, true);
        if ($rowData === false) {
            throw new \Exception("Error: could not parse JSON string from input file $this->filename in line $this->lineNumber");
        }
        if (!isset($rowData['bin']) || empty($rowData['bin'])) {
            throw new \Exception("Error: BIN not found for row in $this->filename in line $this->lineNumber");
        }
        if (!isset($rowData['amount']) || empty($rowData['amount'])) {
            throw new \Exception("Error: amount not found for row in $this->filename in line $this->lineNumber");
        }
        if (!isset($rowData['currency']) || empty($rowData['currency'])) {
            throw new \Exception("Error: currency not found for row in $this->filename in line $this->lineNumber");
        }
        return $rowData;
    }
}