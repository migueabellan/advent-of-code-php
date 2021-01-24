<?php

namespace Tests\Year2015\Day19;

use App\Year2015\Day19\Puzzle;
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
        $this->assertEquals(518, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(200, $this->runner->exec2($this->array));
    }
}
