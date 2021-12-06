<?php

namespace App\Year2021\Day06;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array = array_map('intval', explode(',', $line));
            }
            fclose($file);
        }

        return $array;
    }

    private function solve(array $input, int $total_days): int
    {
        $fishes = array_fill(0, 9, 0);

        foreach ($input as $age) {
            $fishes[$age]++;
        }

        for ($day = 0; $day < $total_days; $day++) {
            $fishes = [
                0 => $fishes[1],
                1 => $fishes[2],
                2 => $fishes[3],
                3 => $fishes[4],
                4 => $fishes[5],
                5 => $fishes[6],
                6 => $fishes[7] + $fishes[0],
                7 => $fishes[8],
                8 => $fishes[0],
            ];
        }
        
        return intval(array_sum($fishes));
    }

    public function exec1(array $input = []): string
    {
        return (string)$this->solve($input, 80);
    }

    public function exec2(array $input = []): string
    {
        return (string)$this->solve($input, 256);
    }
}
