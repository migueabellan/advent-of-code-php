<?php

namespace Tests\Controller;

use App\Controller\Day01;
use PHPUnit\Framework\TestCase;

class Day01Test extends TestCase
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
        $this->runner = new Day01();

        $this->array = $this->runner->read();
    }

    public function testExec1(): void
    {
        $this->assertEquals(514579, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(0, $this->runner->exec2($this->array));
    }
}
