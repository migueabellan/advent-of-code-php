<?php

namespace Tests\Year2020\Day18;

use App\Year2020\Day18\IndexController;
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
        $this->assertEquals(86311597203806, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(276894767062189, $this->runner->exec2($this->array));
    }
}
