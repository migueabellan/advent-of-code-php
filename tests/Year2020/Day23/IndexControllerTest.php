<?php

namespace Tests\Year2020\Day23;

use App\Year2020\Day23\Puzzle;
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
        $this->assertEquals(54896723, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(146304752384, $this->runner->exec2($this->array));
    }
}
