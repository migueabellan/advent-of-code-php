<?php

namespace App\Year2016\Day02;

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
                $array[] = str_split(trim($line));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $map = [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9]
        ];

        $bathroom = new Bathroom($map, 1, 1);

        foreach ($input as $instructions) {
            $bathroom->move($instructions);
        }

        return $bathroom->code();
    }

    public function exec2(array $input = []): string
    {
        $map = [
            [null, null,   1, null, null],
            [null,    2,   3,    4, null],
            [   5,    6,   7,    8,    9],
            [null,  'A', 'B',  'C', null],
            [null, null, 'D', null, null],
        ];

        $bathroom = new Bathroom($map, 2, 0);

        foreach ($input as $instructions) {
            $bathroom->move($instructions);
        }

        return $bathroom->code();
    }
}
