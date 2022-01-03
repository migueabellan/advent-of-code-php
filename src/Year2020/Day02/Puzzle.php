<?php

namespace App\Year2020\Day02;

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
                /* @phpstan-ignore-next-line */
                [$min, $max, $letter, $pass] = preg_split('/[- :]+/', $line);
                $array[] = [
                    'min' => intval($min),
                    'max' => intval($max),
                    'letter' => $letter,
                    'pass' => $pass
                ];
            }
            fclose($file);
        }

        return $array;
    }
        
    public function exec1(array $array = []): int
    {
        $result = 0;

        foreach ($array as $case) {
            $min = $case['min'];
            $max = $case['max'];
            $letter = $case['letter'];
            $pass = $case['pass'];

            $count = substr_count($pass, $letter);
            if ($min <= $count && $count <= $max) {
                $result++;
            }
        }

        return $result;
    }

    public function exec2(array $array = []): int
    {
        $result = 0;
        foreach ($array as $case) {
            $min = $case['min'] - 1;
            $max = $case['max'] - 1;
            $letter = $case['letter'];
            $pass = $case['pass'];

            if (($letter === $pass[$min]) !== ($letter === $pass[$max])) {
                $result++;
            }
        }

        return $result;
    }
}
