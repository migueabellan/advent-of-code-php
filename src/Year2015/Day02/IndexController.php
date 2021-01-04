<?php

namespace App\Year2015\Day02;

use App\Puzzle\AbstractPuzzle;

class IndexController extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match("~^(?'l'.*)x(?'w'.*)x(?'h'.*)$~", $line, $matches);
                $l = (int)$matches['l'];
                $w = (int)$matches['w'];
                $h = (int)$matches['h'];

                $array[] = [
                    'l' => $l,
                    'w' => $w,
                    'h' => $h
                ];
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $result = 0;

        foreach ($array as $present) {
            $areas = [
                $present['l'] * $present['w'],
                $present['w'] * $present['h'],
                $present['h'] * $present['l']
            ];

            $surface = array_reduce($areas, function ($surface, $area) {
                return $surface += (2 * $area);
            }, 0);

            $result += ($surface + min($areas));
        }
        
        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        foreach ($array as $present) {
            $perimeter = [
                2 * $present['l'],
                2 * $present['w'],
                2 * $present['h']
            ];
            sort($perimeter);
            $perimeter = $perimeter[0] + $perimeter[1];

            $volume = $present['l'] * $present['w'] * $present['h'];

            $result += ($perimeter + $volume);
        }
        
        return (string)$result;
    }
}
