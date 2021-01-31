<?php

namespace App\Year2015\Day20;

use App\Puzzle\AbstractPuzzle;
use App\Utils\MathUtil;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): string
    {
        $presents = 0;
        $house = 1;

        while (true) {
            $presents = array_sum(MathUtil::divisors($house)) * 10;

            if ($presents >= $input[0]) {
                break;
            }

            $house++;
        }
    
        return (string)$house;
    }

    public function exec2(array $input = []): string
    {
        $presents = 0;
        $house = 1;

        while (true) {
            $divisors = MathUtil::divisors($house);

            foreach ($divisors as $key => $divisor) {
                if ($divisor * 50 < $house) {
                    unset($divisors[$key]);
                }
            }

            $presents = array_sum($divisors) * 11;

            if ($presents >= $input[0]) {
                break;
            }

            $house++;
        }

        return (string)$house;
    }
}
