<?php

namespace App\Year2019\Day03;

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
                $array[] = array_map(function ($el) {
                    preg_match("/([ULDR])(\d+)/", $el, $match);
                    return [
                        'turn' => $match[1],
                        'steps' => intval($match[2])
                    ];
                }, explode(',', trim($line)));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): int
    {
        $manhattan = new Manhattan();
        $manhattan->move(0, $input[0]);
        $manhattan->move(1, $input[1]);

        return $manhattan->getClosest();
    }

    public function exec2(array $input = []): int
    {
        $manhattan = new Manhattan();
        $manhattan->move(0, $input[0]);
        $manhattan->move(1, $input[1]);

        return $manhattan->getLowerSteps();
    }
}
