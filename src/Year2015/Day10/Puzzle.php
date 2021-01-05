<?php

namespace App\Year2015\Day10;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    private function lookAndSay(string $number): string
    {
        $number .= '$';

        $count = 1;
        $str = '';

        for ($i = 0; $i < strlen($number) - 1; $i++) {
            if ($number[$i] !== $number[$i + 1]) {
                $str .= (string)$count.(string)$number[$i];
                $count = 1;
            } else {
                $count++;
            }
        }

        return $str;
    }

    public function exec1(array $input = []): string
    {
        $times = 40;

        $number = current($input);

        for ($i = 0; $i < $times; $i++) {
            $number = $this->lookAndSay($number);
        }

        return (string)strlen($number);
    }

    public function exec2(array $input = []): string
    {
        $times = 50;

        $number = current($input);

        for ($i = 0; $i < $times; $i++) {
            $number = $this->lookAndSay($number);
        }

        return (string)strlen($number);
    }
}
