<?php

namespace App\Year2023\Day03;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $engine = Engine::from($input);

        return $engine->adjacents();
    }

    public function exec2(array $input = []): int
    {
        $engine = Engine::from($input);

        return $engine->gears();
    }
}
