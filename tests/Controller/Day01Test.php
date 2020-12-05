<?php

namespace Tests\Controller;

use App\Controller\Day01;
use PHPUnit\Framework\TestCase;

class Day01Test extends TestCase
{
    public function testExec1(): void
    {
        $runner = new Day01();

        $array = $runner->read();
        
        $this->assertEquals(800139, $runner->exec1($array));
    }

    public function testExec2(): void
    {
        $runner = new Day01();

        $array = $runner->read();
        
        $this->assertEquals(59885340, $runner->exec2($array));
    }
}
