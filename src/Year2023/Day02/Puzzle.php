<?php

namespace App\Year2023\Day02;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input as $str) {
            $cube = Cube::from($str);
            if ($cube->isPossible()) {
                $result += $cube->game;
            }
        }

        return $result;
    }

    public function exec2(array $input = []): int
    {
        $result = 0;

        foreach ($input as $str) {
            $cube = Cube::from($str);
            if ($cube->isPossible()) {
                $result += $cube->game;
            }
        }

        return $result;
    }
}
