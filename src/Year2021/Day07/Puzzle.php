<?php

namespace App\Year2021\Day07;

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

    public function exec1(array $input = []): string
    {
        $max = max($input);

        $horizontals = [];
        for ($i = 0; $i <= $max; $i++) {
            $sum = 0;
            foreach ($input as $position) {
                $sum += abs($position - $i);
            }
            $horizontals[$i] = $sum;
        }

        return (string)min($horizontals);
    }

    public function exec2(array $input = []): string
    {
        $max = max($input);

        $horizontals = [];
        for ($i = 0; $i <= $max; $i++) {
            $sum = 0;
            foreach ($input as $position) {
                $position = abs($position - $i);
                $sum += ((1 + $position) / 2) * $position;
            }
            $horizontals[$i] = $sum;
        }

        return (string)min($horizontals);
    }
}
