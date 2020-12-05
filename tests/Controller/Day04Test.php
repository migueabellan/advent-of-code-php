<?php

namespace Tests\Controller;

use App\Controller\Day04;
use PHPUnit\Framework\TestCase;

class Day04Test extends TestCase
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
        $this->runner = new Day04();

        $this->array = $this->runner->read();
    }

    public function testExec1(): void
    {
        $this->assertEquals(2, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(2, $this->runner->exec2($this->array));
    }
}
