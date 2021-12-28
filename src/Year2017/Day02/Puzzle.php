<?php

namespace App\Year2017\Day02;

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
                $array[] = array_map('intval', explode(' ', trim($line)));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input as $row) {
            $min = min($row);
            $max = max($row);

            $result += ($max - $min);
        }
        
        return $result;
    }

    public function exec2(array $input = []): int
    {
        $result = 0;

        foreach ($input as $row) {
            for ($i = 0; $i < count($row); $i++) {
                for ($j = $i + 1; $j < count($row); $j++) {
                    $max = max($row[$i], $row[$j]);
                    $min = min($row[$i], $row[$j]);

                    if ($max % $min === 0) {
                        $result += $max / $min;
                    }
                }
            }
        }
        
        return $result;
    }
}
