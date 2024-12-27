<?php

namespace App\Year2022\Day07;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $computer = new Computer($input);

        $sizes = $computer->getDirectoriesAtMost(100000);

        return intval(array_sum($sizes));
    }

    public function exec2(array $input = []): int
    {
        $computer = new Computer($input);

        return $computer->getSizeToRemove();
    }
}
