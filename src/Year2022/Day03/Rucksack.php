<?php

namespace App\Year2022\Day03;

final class Rucksack
{
    private const ABC = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function findErrors(string ...$items): int
    {
        $array = str_split($items[0]);

        foreach ($items as $item) {
            $array = array_unique(array_intersect($array, str_split($item)));
        }

        return strpos(self::ABC, (string)reset($array)) + 1;
    }
}
