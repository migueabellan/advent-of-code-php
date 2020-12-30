<?php

namespace Tests\Year2020\Day01;

use App\Year2020\Day01\IndexController;
use PHPUnit\Framework\TestCase;

class IndexControllerTest extends TestCase
{
    /**
     * @var IndexController
     */
    private object $runner;

    /**
     * @var array
     */
    private array $array;

    protected function setUp(): void
    {
        $this->runner = new IndexController();

        $this->array = $this->runner->read();
    }

    public function testExec1(): void
    {
        $this->assertEquals(800139, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(59885340, $this->runner->exec2($this->array));
    }
}
