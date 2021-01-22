<?php

namespace App\Year2015\Day18;

use App\Puzzle\AbstractPuzzle;
use App\Year2015\Day18\Grid;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $array = []): string
    {
        $grid = new Grid($array);

        foreach (range(0, 99) as $_) {
            $grid->animate();
        }

        return (string)$grid->getNumLights();
    }

    public function exec2(array $array = []): string
    {
        $grid = new Grid($array);

        foreach (range(0, 99) as $_) {
            $grid->animate();
            $grid->fixCorners();
        }

        return (string)$grid->getNumLights();
    }
}
