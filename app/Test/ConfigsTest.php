<?php

namespace ComCalc\Test;

use ComCalc\Configs;

class testConfigs extends \PHPUnit\Framework\TestCase
{
    public function testConfigExists() {
        $this->assertClassHasAttribute("commissionPercentNonEU", Configs::class);
        $this->assertClassHasAttribute("commissionPercentEU", Configs::class);
        $this->assertClassHasAttribute("euList", Configs::class);
    }
}