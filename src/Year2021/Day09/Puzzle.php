<?php

namespace App\Year2021\Day09;

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
                $array[] = array_map('intval', str_split(trim($line)));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $cave = new Cave($input);
        $low_points = $cave->getLowPoints();

        return (string)intval(count($low_points) + array_reduce($low_points, function ($carry, $el) {
            return $carry + $el->getValue();
        }, 0));
    }

    public function exec2(array $input = []): string
    {
        $cave = new Cave($input);
        $basins = $cave->getBasins();

        rsort($basins);

        return ((string) array_product(array_slice($basins, 0, 3)));
    }
}
