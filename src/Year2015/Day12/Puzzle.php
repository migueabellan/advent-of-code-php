<?php

namespace App\Year2015\Day12;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): string
    {
        $json = current($input);

        $result = 0;

        $decode = json_decode($json, true);

        array_walk_recursive($decode, function ($el) use (&$result) {
            if (is_numeric($el)) {
                return $result += $el;
            }
        });

        return (string)$result;
    }

    /**
    * @param  mixed  $array
    */
    private function sumRecursive($array): int
    {
        if (is_object($array) && false !== array_search('red', (array) $array, true)) {
            return 0;
        }
        $sum = 0;
        foreach ((array) $array as $value) {
            if (is_object($value) || is_array($value)) {
                $sum += $this->sumRecursive($value);
            } elseif (is_int($value)) {
                $sum += $value;
            }
        }
        return $sum;
    }

    public function exec2(array $input = []): string
    {
        $json = current($input);

        $decode = json_decode($json);
        
        $result = $this->sumRecursive($decode);

        return (string)$result;
    }
}
