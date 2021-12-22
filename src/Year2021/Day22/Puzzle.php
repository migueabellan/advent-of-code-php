<?php

namespace App\Year2021\Day22;

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
                preg_match("~^(?'op'.*) x=(?'x'.*),y=(?'y'.*),z=(?'z'.*)$~", trim($line), $matches);
                
                $x = array_map('intval', explode('..', $matches['x']));
                $y = array_map('intval', explode('..', $matches['y']));
                $z = array_map('intval', explode('..', $matches['z']));

                $array[] = [
                    'op' => $matches['op'] === Cuboid::ON,
                    'x' => new Point($x[0], $x[1]),
                    'y' => new Point($y[0], $y[1]),
                    'z' => new Point($z[0], $z[1]),
                ];
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $cuboid = new Cuboid();

        foreach ($input as $step) {
            $cuboid->steps($step['op'], $step['x'], $step['y'], $step['z']);
        }

        return (string)$cuboid->calc();
    }

    public function exec2(array $input = []): string
    {
        $result = 0;

        return (string)$result;
    }
}
