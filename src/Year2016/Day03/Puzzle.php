<?php

namespace App\Year2016\Day03;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $sides = array_map('intval', (array)preg_split("/[\s]+/", trim($line)));

                $array[] = $sides;
            }
            fclose($file);
        }

        return $array;
    }

    private function isTriangle(array $sides): bool
    {
        sort($sides);

        return $sides[0] + $sides[1] > $sides[2];
    }

    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input as $sides) {
            if ($this->isTriangle($sides)) {
                $result++;
            }
        }
        
        return $result;
    }

    public function exec2(array $input = []): int
    {
        $result = 0;

        $groups = array_chunk($input, 3);

        foreach ($groups as $group) {
            for ($i = 0; $i < 3; $i++) {
                $sides = [$group[0][$i], $group[1][$i], $group[2][$i]];
                if ($this->isTriangle($sides)) {
                    $result++;
                }
            }
        }
        
        return $result;
    }
}
