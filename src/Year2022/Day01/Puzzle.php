<?php

namespace App\Year2022\Day01;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        $total = 0;
        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if($line !== ''){
                    $total += intval($line);
                } else {
                    $array[] = $total;
                    $total = 0;
                }
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): int
    {
        return intval(max($input));
    }

    public function exec2(array $input = []): int
    {
        arsort($input);

        return intval(array_sum(array_slice($input, 0, 3)));
    }
}
