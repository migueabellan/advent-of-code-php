<?php

namespace Tests\Year2016\Day01;

use App\Year2016\Day01\Puzzle;
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
        $this->assertEquals(300, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(159, $this->runner->exec2($this->array));
    }
}
