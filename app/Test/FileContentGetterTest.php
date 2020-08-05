<?php

namespace ComCalc\Test;

class testFileContentGetter extends \PHPUnit\Framework\TestCase
{
    public function testFileGetContents() {
        $this->assertTrue(extension_loaded('curl'));
    }
}