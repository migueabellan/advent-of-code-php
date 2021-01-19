<?php

namespace App\Utils;

class ArrayUtil
{
    /**
     * Return an array with all permutations
     */
    public static function permutations(array $array, array $perms = []): array
    {
        if (empty($array)) {
            return [$perms];
        }

        $return = [];

        for ($i = count($array) - 1; $i >= 0; --$i) {
            $newarray = $array;
            $newperms = $perms;
            list($foo) = array_splice($newarray, $i, 1);
            array_unshift($newperms, $foo);
            $return = array_merge($return, self::permutations($newarray, $newperms));
        }

        return $return;
    }

    /**
     * Return an array with all combinations
     */
    public static function combinations(array $array): array
    {
        $combinations = [[]];

        foreach ($array as $element) {
            foreach ($combinations as $combination) {
                $combinations[] = array_merge([$element], $combination);
            }
        }

        return $combinations;
    }
}
