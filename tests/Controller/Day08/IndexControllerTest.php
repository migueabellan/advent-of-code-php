<?php

namespace Tests\Controller\Day08;

use App\Controller\Day08\IndexController;
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
        $this->assertEquals(1810, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(969, $this->runner->exec2($this->array));
    }
}
