<?php

namespace App\Year2020\Day03;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array[] = $line;
            }
            fclose($file);
        }
        
        return $array;
    }
    
    public function exec1(array $array = []): int
    {
        $result = 0;
        $right = 3;
        
        $mod = 0;
        foreach ($array as $line) {
            if ($line[$mod] === '#') {
                $result++;
            }
            $mod = ($mod = $mod + $right) % (strlen($line) - 1);
        }

        return $result;
    }

    public function exec2(array $array = []): int
    {
        $cases = [
            ['right' => 1, 'bottom' => 1],
            ['right' => 3, 'bottom' => 1],
            ['right' => 5, 'bottom' => 1],
            ['right' => 7, 'bottom' => 1],
            ['right' => 1, 'bottom' => 2]
        ];
        
        $results = [];
        foreach ($cases as $c => $case) {
            $mod = 0;
            $results[$c] = 0;
            foreach ($array as $k => $line) {
                if ($k % $case['bottom'] === 0) {
                    if ($line[$mod] === '#') {
                        $results[$c]++;
                    }
                    $mod = ($mod = $mod + $case['right']) % (strlen($line) - 1);
                }
            }
        }

        $result = 1;
        foreach ($results as $v) {
            $result *= $v;
        }

        return $result;
    }
}
