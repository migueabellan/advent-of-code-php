<?php

namespace App\Year2020\Day01;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    private const YEAR = 2020;

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

            sort($array, SORT_NUMERIC);
        }

        return $array;
    }
    
        
    public function exec1(array $array = []): string
    {
        $result = 0;

        foreach ($array as $number) {
            $diff = self::YEAR - $number;
            if (in_array($diff, $array, true)) {
                $result = $number * $diff;
                break;
            }
        }

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        for ($i = 0; $i < count($array); $i++) {
            $diff = self::YEAR - $array[$i];
            for ($j = $i + 1; $j < count($array); $j++) {
                $diff = $diff - $array[$j];
                if (in_array($diff, $array, true)) {
                    $result = $array[$i] * $array[$j] * $diff;
                    break;
                }
            }
        }

        return (string)$result;
    }
}
