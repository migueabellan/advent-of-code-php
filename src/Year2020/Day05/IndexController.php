<?php

namespace App\Year2020\Day05;

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
                // $binary = preg_replace(['/F|L/', '/B|R/'], [0, 1], $line);
                $binary = strtr($line, 'FBLR', '0101');
                $decimal = bindec($binary);

                $array[$decimal] = $decimal;
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $result = max($array);

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        $array_complete = range(min($array), max($array));

        $result = current(array_diff($array_complete, $array));

        return (string)$result;
    }
}
