<?php

namespace Tests\Controller;

use App\Controller\Day03;
use PHPUnit\Framework\TestCase;

class Day03Test extends TestCase
{
    /**
     * @var object
     */
    private object $runner;

    /**
     * @var array
     */
    private array $array;

    protected function setUp(): void
    {
        $this->runner = new Day03();

        $this->array = $this->runner->read();
    }

    public function testExec1(): void
    {
        $this->assertEquals(7, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(336, $this->runner->exec2($this->array));
    }
}
