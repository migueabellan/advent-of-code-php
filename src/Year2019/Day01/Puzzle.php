<?php

namespace App\Year2019\Day01;

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
        $result = 0;

        foreach ($input as $mass) {
            $result += intval(floor($mass / 3)) - 2;
        }

        return $result;
    }

    public function exec2(array $input = []): int
    {
        $result = 0;

        foreach ($input as $mass) {
            while ($mass > 0) {
                $mass = intval(floor($mass / 3)) - 2;
                if ($mass > 0) {
                    $result += $mass;
                }
            }
        }

        return $result;
    }
}
