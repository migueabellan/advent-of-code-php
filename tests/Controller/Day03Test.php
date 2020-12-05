<?php

namespace Tests\Controller;

use App\Controller\Day03;
use PHPUnit\Framework\TestCase;

class Day03Test extends TestCase
{
    public function testExec1(): void
    {
        $runner = new Day03();

        $array = $runner->read();
        
        $this->assertEquals(247, $runner->exec1($array));
    }

    public function testExec2(): void
    {
        $runner = new Day03();

        $array = $runner->read();
        
        $this->assertEquals(2983070376, $runner->exec2($array));
    }
}
