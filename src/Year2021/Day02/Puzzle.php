<?php

namespace App\Year2021\Day02;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): string
    {
        $submarine = new Submarine();

        foreach ($input as $instruction) {
            $submarine->move1($instruction);
        }

        return (string)$submarine->getX() * $submarine->getY();
    }

    public function exec2(array $input = []): string
    {
        $submarine = new Submarine();

        foreach ($input as $instruction) {
            $submarine->move2($instruction);
        }

        return (string)$submarine->getX() * $submarine->getY();
    }
}
