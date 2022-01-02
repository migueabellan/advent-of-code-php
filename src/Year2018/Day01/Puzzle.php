<?php

namespace App\Year2018\Day01;

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
                $array[] = intval(trim($line));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): int
    {
        return intval(array_sum($input));
    }

    public function exec2(array $input = []): int
    {
        $frequency = 0;

        $i = 0;
        while (!isset($found[$frequency])) {
            $found[$frequency] = true;

            $frequency += $input[$i];

            $i = (++$i % count($input));
        }

        return $frequency;
    }
}
