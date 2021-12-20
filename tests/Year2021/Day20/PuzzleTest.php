<?php

namespace Tests\Year2021\Day20;

use App\Year2021\Day20\Puzzle;
use PHPUnit\Framework\TestCase;

class PuzzleTest extends TestCase
{
    /**
     * @var Puzzle
     */
    private object $runner;

    /**
     * @var array
     */
    private array $array;

    protected function setUp(): void
    {
        $this->runner = new Puzzle();

        $this->array = $this->runner->read();
    }

    public function testExec1(): void
    {
        $this->assertEquals(5486, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(20210, $this->runner->exec2($this->array));
    }
}
