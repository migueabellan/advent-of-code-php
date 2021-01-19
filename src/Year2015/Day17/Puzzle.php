<?php

namespace App\Year2015\Day17;

use App\Puzzle\AbstractPuzzle;
use App\Utils\ArrayUtil;

class Puzzle extends AbstractPuzzle
{
    private const VALUE = 150;

    public function exec1(array $input = []): string
    {
        ini_set('memory_limit', '-1');
        
        $combinations = ArrayUtil::combinations($input);

        foreach ($combinations as $combination) {
            $sum = array_sum($combination);
            if (self::VALUE === $sum) {
                $candidates[] = $combination;
            }
        }

        return (string)count($candidates);
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        //

        return (string)$result;
    }
}
