<?php

namespace App\Year2021\Day10;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): string
    {
        $result = 0;

        foreach ($input as $line) {
            $checker = new Syntax($line);
            if ($checker->isCorrupted()) {
                $result += $checker->getScore();
            }
        }

        return (string)$result;
    }

    public function exec2(array $input = []): string
    {
        $result = [];

        foreach ($input as $line) {
            $checker = new Syntax($line);
            if ($checker->isIncomplete()) {
                $result[] = $checker->getScore();
            }
        }

        sort($result);

        return (string)$result[count($result) / 2];
    }
}
