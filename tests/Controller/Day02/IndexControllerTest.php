<?php

namespace Tests\Controller\Day02;

use App\Controller\Day02\IndexController;
use PHPUnit\Framework\TestCase;

class IndexControllerTest extends TestCase
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
        $this->runner = new IndexController();

        $this->array = $this->runner->read();
    }

    public function testExec1(): void
    {
        $this->assertEquals(454, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(649, $this->runner->exec2($this->array));
    }
}
