<?php

namespace App\Utils;

class ArrayUtil
{
    /**
     * Permutation array
     *
     * $array [0, 1, 2] -> [0,1,2], [0,2,1], [1,0,2], [1, 2, 0] ...
     */
    public static function permutations(array $array, array $perms = []): array
    {
        if (empty($array)) {
            $return = [$perms];
        } else {
            $return = [];
            for ($i = count($array) - 1; $i >= 0; --$i) {
                $newarray = $array;
                $newperms = $perms;
                list($foo) = array_splice($newarray, $i, 1);
                array_unshift($newperms, $foo);
                $return = array_merge($return, self::permutations($newarray, $newperms));
            }
        }
        return $return;
    }
}
