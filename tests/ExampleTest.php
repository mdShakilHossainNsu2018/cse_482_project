<?php

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testDummy(){
        $string1 = "testing";
        $string2 = "testing";
        $string3 = "testing";


        $this->assertSame($string1, $string2);
        $this->assertSame($string2, $string3);

    }
}