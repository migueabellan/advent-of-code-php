<?php

namespace App\Year2018\Day02;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $two_chars = 0;
        $three_chars = 0;

        foreach ($input as $box) {
            $occurrences = (array)count_chars($box, 1);
            if (in_array(2, $occurrences)) {
                $two_chars++;
            }
            if (in_array(3, $occurrences)) {
                $three_chars++;
            }
        }

        return $two_chars * $three_chars;
    }

    public function exec2(array $input = []): string
    {
        $result = '';

        for ($i = 0; $i < count($input); $i++) {
            for ($j = $i + 1; $j < count($input); $j++) {
                $diff = array_diff_assoc(str_split($input[$i]), str_split($input[$j]));
                if (count($diff) === 1) {
                    $pos = key($diff);
                    $result = substr($input[$i], 0, $pos) . substr($input[$i], $pos + 1);
                }
            }
        }

        return $result;
    }
}
