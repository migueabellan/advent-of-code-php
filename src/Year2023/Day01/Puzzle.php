<?php

namespace App\Year2023\Day01;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input as $str) {
            $trebuchet = new Trebuchet($str);
            $result += $trebuchet->calibration();
        }

        return $result;
    }

    public function exec2(array $input = []): int
    {
        $result = 0;

        foreach ($input as $str) {
            $trebuchet = new Trebuchet($str);
            $trebuchet->clean();

            $result += $trebuchet->calibration();
        }

        return $result;
    }
}
