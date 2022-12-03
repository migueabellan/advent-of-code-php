<?php

namespace App\Year2022\Day03;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $rucksack = new Rucksack();

        $sum = 0;
        foreach ($input as $item) {
            /** @var int<1,max> $length */
            $length = intval(strlen($item) / 2);
            $items = str_split($item, $length);

            $sum += $rucksack->findErrors($items[0], $items[1]);
        }

        return $sum;
    }

    public function exec2(array $input = []): int
    {
        $rucksack = new Rucksack();

        $sum = 0;
        for ($i = 0; $i < count($input); $i+=3) {
            $sum += $rucksack->findErrors($input[$i], $input[$i + 1], $input[$i + 2]);
        }

        return $sum;
    }
}
