<?php

namespace App\Year2017\Day03;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $memory = new Memory();

        $memory->espiral(intval(current($input)));

        return $memory->getManhattanDistance();
    }

    public function exec2(array $input = []): int
    {
        $cells[0][0] = 1;

        $memory = new Memory([], $cells);

        $memory->espiral(intval(current($input)));

        return $memory->getSum();
    }
}
