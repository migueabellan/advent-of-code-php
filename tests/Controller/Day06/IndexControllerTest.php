<?php

namespace Tests\Controller\Day06;

use App\Controller\Day06\IndexController;
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
        $this->assertEquals(6273, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(3254, $this->runner->exec2($this->array));
    }
}
