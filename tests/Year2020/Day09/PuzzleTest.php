<?php

namespace Tests\Year2020\Day09;

use App\Year2020\Day09\Puzzle;
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
        $this->assertEquals(105950735, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(13826915, $this->runner->exec2($this->array));
    }
}
