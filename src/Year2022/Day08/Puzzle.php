<?php

namespace App\Year2022\Day08;

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
        }

        return $array;
    }

    public function exec1(array $input = []): int
    {
        $treetop = new Treetop($input);

        return $treetop->visibleFromOutside();
    }

    public function exec2(array $input = []): int
    {
        $treetop = new Treetop($input);

        return $treetop->maxScenicScore();
    }
}
