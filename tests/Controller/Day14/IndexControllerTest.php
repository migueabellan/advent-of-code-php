<?php

namespace Tests\Controller\Day14;

use App\Controller\Day14\IndexController;
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
        $this->assertEquals(7440382076205, $this->runner->exec1($this->array));
    }

    public function testExec2(): void
    {
        $this->assertEquals(4200656704538, $this->runner->exec2($this->array));
    }
}
