<?php

namespace App\Year2020\Day10;

use App\Puzzle\AbstractPuzzle;

class IndexController extends AbstractPuzzle
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array[] = (int)$line;
            }
            fclose($file);
        }

        $array[] = 0;
        $array[] = max($array) + 3;

        sort($array);
        
        return $array;
    }

    public function exec1(array $array = []): string
    {
        $diff = [];
        for ($i = 0; $i < (count($array) - 1); $i += 1) {
            $diff[] = $array[$i + 1] - $array[$i];
        }

        $group = array_count_values($diff);

        return (string)($group[1] * $group[3]);
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        $result = [1];
        for ($i = 1; $i < count($array); $i++) {
            $aux = 0;
            for ($j = max(0, $i - 3); $j < $i; $j++) {
                if (($array[$i] - $array[$j]) <= 3) {
                    $aux += $result[$j];
                }
            }
            $result[] = $aux;
        }

        return (string)end($result);
    }
}
