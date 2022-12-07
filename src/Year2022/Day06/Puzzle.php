<?php

namespace App\Year2022\Day06;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    private function subroutine(string $buffer, int $num = 4): int
    {
        for ($i = 0; $i < strlen($buffer); $i++) {
            $substr = substr($buffer, $i, $num);
            if (count(array_unique(str_split($substr))) === $num) {
                return $i + $num;
            }
        }

        return 0;
    }

    public function exec1(array $input = []): int
    {
        return $this->subroutine($input[0], 4);
    }

    public function exec2(array $input = []): int
    {
        return $this->subroutine($input[0], 14);
    }
}
