<?php

namespace App\Year2015\Day09;

use App\Controller\AbstractController;
use App\Utils\ArrayUtil;

class IndexController extends AbstractController
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match("/^(?'from'.*) to (?'to'.*) = (?'distance'.*)$/", $line, $matches);

                $array[$matches['from']][$matches['to']] = (int)$matches['distance'];
                $array[$matches['to']][$matches['from']] = (int)$matches['distance'];
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $permutations = ArrayUtil::permutations(array_keys($array));

        $distances = [];
        foreach ($permutations as $permutation) {
            $distance = 0;
            for ($i = 0; $i < count($permutation) - 1; $i++) {
                $distance += $array[$permutation[$i]][$permutation[$i+1]];
            }
            $distances[] = $distance;
        }

        return (string)min($distances);
    }

    public function exec2(array $array = []): string
    {
        $permutations = ArrayUtil::permutations(array_keys($array));

        $distances = [];
        foreach ($permutations as $permutation) {
            $distance = 0;
            for ($i = 0; $i < count($permutation) - 1; $i++) {
                $distance += $array[$permutation[$i]][$permutation[$i+1]];
            }
            $distances[] = $distance;
        }

        return (string)max($distances);
    }
}
