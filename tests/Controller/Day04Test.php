<?php

namespace Tests\Controller;

use App\Controller\Day04;
use PHPUnit\Framework\TestCase;

class Day04Test extends TestCase
{
    public function testExec1(): void
    {
        $runner = new Day04();

        $array = $runner->read();
        
        $this->assertEquals(2, $runner->exec1($array));
    }

    public function testExec2(): void
    {
        $runner = new Day04();

        $array = $runner->read();
        
        $this->assertEquals(2, $runner->exec2($array));
    }
}
