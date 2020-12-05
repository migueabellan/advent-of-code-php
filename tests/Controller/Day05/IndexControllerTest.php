<?php

namespace Tests\Controller\Day05;

use App\Controller\Day05\IndexController;
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
        $this->assertEquals(901, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(661, $this->runner->exec2($this->array));
    }
}
