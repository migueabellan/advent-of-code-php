<?php

namespace App\Utils;

class MatrixUtil
{
    public static function slice(
        array $array,
        int $rowOffset,
        int $rowLength,
        int $colOffset,
        int $colLength
    ): array {
        $slice = [];
        for ($i = $rowOffset; $i < $rowLength; $i++) {
            $row = [];
            for ($j = $colOffset; $j < $colLength; $j++) {
                $row[] = $array[$i][$j];
            }
            $slice[] = $row;
        }

        return $slice;
    }

    public static function sum(array $array): int
    {
        return array_reduce($array, fn ($acc, $row) => $acc += array_sum($row), 0);
    }

    /*
    public static function rotate(array $array): array
    {
        $rotate = [];

        for ($i = 0; $i < count($array); $i++) {
            for ($j = 0; $j < count($array[$i]); $j++) {
                $rotate[$j][$i] = $array[$i][$j];
            }
        }

        return $rotate;
    }
    */
}
