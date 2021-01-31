<?php

namespace App\Year2015\Day20;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    private function getDivisors(int $number): array
    {
        $divisors = [];
        $sqrt = sqrt($number);

        for ($i = 1; $i <= $sqrt; $i++) {
            if ($number % $i === 0) {
                $divisors[] = $i;
                $divisors[] = $number / $i;
            }
        }

        return array_unique($divisors);
    }

    public function exec1(array $input = []): string
    {
        $presents = 0;
        $house = 1;

        while (true) {
            $presents = array_sum($this->getDivisors($house)) * 10;

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
            $divisors = $this->getDivisors($house);

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
