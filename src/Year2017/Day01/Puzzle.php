<?php

namespace App\Year2017\Day01;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $list = array_map('intval', str_split(current($input)));

        $result = 0;

        $length = count($list);
        for ($i = 0; $i < $length; $i++) {
            $search = ($length + $i - 1) % $length;
            if ($list[$i] === $list[$search]) {
                $result += $list[$i];
            }
        }
        
        return $result;
    }

    public function exec2(array $input = []): int
    {
        $list = array_map('intval', str_split(current($input)));

        $result = 0;

        $length = count($list);
        for ($i = 0; $i < $length; $i++) {
            $search = ($i + ($length / 2)) % $length;
            if ($list[$i] === $list[$search]) {
                $result += $list[$i];
            }
        }
        
        return $result;
    }
}
