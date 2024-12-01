<?php

namespace App\Year2023\Day01;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input as $str) {
            $str = preg_replace('/[a-z]/', '', $str);
            $result += intval(substr($str, 0, 1) . substr($str, -1, 1));
        }

        return $result;
    }

    public function exec2(array $input = []): int
    {
        $result = 0;

        return $result;
    }
}
