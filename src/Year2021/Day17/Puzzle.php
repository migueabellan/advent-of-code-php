<?php

namespace App\Year2021\Day17;

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
                preg_match("~^target area: x=(?'x'.*), y=(?'y'.*)$~", trim($line), $matches);
                
                $array = [
                    'x' => explode('..', $matches['x']),
                    'y' => explode('..', $matches['y']),
                ];
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $probe = new Probe($input['x'], $input['y']);

        $result = 0;

        for ($x = 0; $x <= $probe->getMaxX(); $x++) {
            for ($y = 0; $y <= $probe->getMaxX(); $y++) {
                if ($probe->launch($x, $y)) {
                    $result = max($probe->getMaxHeight(), $result);
                }
            }
        }

        return (string)$result;
    }

    public function exec2(array $input = []): string
    {
        $probe = new Probe($input['x'], $input['y']);

        $result = 0;
        
        for ($x = 0; $x <= $probe->getMaxX(); $x++) {
            for ($y = $probe->getMinY(); $y <= abs($probe->getMinY()); $y++) {
                if ($probe->launch($x, $y)) {
                    $result++;
                }
            }
        }

        return (string)$result;
    }
}
