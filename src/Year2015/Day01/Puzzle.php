<?php

namespace App\Year2015\Day01;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    private const UP    = '(';
    private const DOWN  = ')';

    public function exec1(array $input = []): int
    {
        $directions = current($input);

        $up = substr_count($directions, self::UP);
        $down = substr_count($directions, self::DOWN);
        
        return $up - $down;
    }

    public function exec2(array $input = []): int
    {
        $directions = str_split(current($input));

        $floor = 0;
        foreach ($directions as $key => $character) {
            switch ($character) {
                case self::UP:
                    $floor++;
                    break;
                case self::DOWN:
                    $floor--;
                    break;
            }

            if (-1 === $floor) {
                return $key + 1;
            }
        }

        return 0;
    }
}
