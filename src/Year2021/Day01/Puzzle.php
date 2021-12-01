<?php

namespace App\Year2021\Day01;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    private function countMeasurement(array $measurements): int
    {
        $result = 0;

        $previous = $measurements[0];

        foreach ($measurements as $measurement) {
            if ($measurement > $previous) {
                $result++;
            }
            $previous = $measurement;
        }

        return $result;
    }

    public function exec1(array $input = []): string
    {
        return (string)$this->countMeasurement($input);
    }

    public function exec2(array $input = []): string
    {
        $windows = [];
        for ($i = 0; $i < count($input) - 2; $i++) {
            $windows[] = $input[$i] + $input[$i + 1] + $input[$i + 2];
        }

        return (string)$this->countMeasurement($windows);
    }
}
