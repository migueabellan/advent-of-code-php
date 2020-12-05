<?php

namespace Tests\Controller;

use App\Controller\Day05;
use PHPUnit\Framework\TestCase;

class Day05Test extends TestCase
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
        $this->runner = new Day05();

        $this->array = $this->runner->read();
    }

    public function testExec1(): void
    {
        $this->assertEquals(820, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(120, $this->runner->exec2($this->array));
    }
}
