<?php

namespace App\Year2015\Day13;

use App\Puzzle\AbstractPuzzle;
use App\Utils\ArrayUtil;

class Puzzle extends AbstractPuzzle
{
    private const GAIN = 'gain';
    private const LOSE = 'lose';

    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match(
                    "/^(?'p1'.*) would (?'opt'.*) (?'happiness'.*) happiness units by sitting next to (?'p2'.*).$/",
                    $line,
                    $matches
                );

                switch ($matches['opt']) {
                    case self::GAIN:
                        $array[$matches['p1']][$matches['p2']] = (int)$matches['happiness'];
                        break;
                    case self::LOSE:
                        $array[$matches['p1']][$matches['p2']] = -1 * (int)$matches['happiness'];
                        break;
                }
            }
            fclose($file);
        }

        return $array;
    }

    private function getHappiness(array $array): array
    {
        $permutations = ArrayUtil::permutations(array_keys($array));

        $happiness = [];
        foreach ($permutations as &$permutation) {
            $happy = 0;
            $permutation[] = $permutation[0];
            for ($i = 0; $i < count($permutation) - 1; $i++) {
                $happy += $array[$permutation[$i]][$permutation[$i + 1]];
                $happy += $array[$permutation[$i + 1]][$permutation[$i]];
            }
            $happiness[] = $happy;
        }

        return $happiness;
    }

    public function exec1(array $array = []): string
    {
        $happiness = $this->getHappiness($array);

        return (string)max($happiness);
    }

    public function exec2(array $array = []): string
    {
        ini_set('memory_limit', '-1');

        foreach (array_keys($array) as $person) {
            $array[$person]['me'] = 0;
            $array['me'][$person] = 0;
        }

        $happiness = $this->getHappiness($array);

        return (string)max($happiness);
    }
}
