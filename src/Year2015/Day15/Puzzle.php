<?php

namespace App\Year2015\Day15;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match(
                    "/^(?'ingredient'.*): capacity (?'capacity'.*), durability (?'durability'.*), flavor (?'flavor'.*), texture (?'texture'.*), calories (?'calories'.*)$/", //phpcs:ignore
                    $line,
                    $matches
                );

                $array[] = [
                    'ingredient' => $matches['ingredient'],
                    'capacity' => (int)$matches['capacity'],
                    'durability' => (int)$matches['durability'],
                    'flavor' => (int)$matches['flavor'],
                    'texture' => (int)$matches['texture'],
                    'calories' => (int)$matches['calories'],
                ];
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $maxScore = 0;

        $properties = ['capacity', 'durability', 'flavor', 'texture'];

        for ($a = 0; $a <= 100; $a++) {
            for ($b = 0; $b <= 100 - $a; $b++) {
                for ($c = 0; $c <= 100 - $a - $b; $c++) {
                    $d = 100 - $a - $b - $c;

                    $score = 1;
                    foreach ($properties as $property) {
                        $sum = $a * $array[0][$property];
                        $sum += $b * $array[1][$property];
                        $sum += $c * $array[2][$property];
                        $sum += $d * $array[3][$property];

                        $score *= max(0, $sum);
                    }
        
                    if ($score > $maxScore) {
                        $maxScore = $score;
                    }
                }
            }
        }

        return (string)$maxScore;
    }

    public function exec2(array $array = []): string
    {
        $maxScore = 0;

        $properties = ['capacity', 'durability', 'flavor', 'texture'];

        for ($a = 0; $a <= 100; $a++) {
            for ($b = 0; $b <= 100 - $a; $b++) {
                for ($c = 0; $c <= 100 - $a - $b; $c++) {
                    $d = 100 - $a - $b - $c;

                    $calories = $a * $array[0]['calories'];
                    $calories += $b * $array[1]['calories'];
                    $calories += $c * $array[2]['calories'];
                    $calories += $d * $array[3]['calories'];
                    if ($calories === 500) {
                        $score = 1;
                        foreach ($properties as $property) {
                            $sum = $a * $array[0][$property];
                            $sum += $b * $array[1][$property];
                            $sum += $c * $array[2][$property];
                            $sum += $d * $array[3][$property];

                            $score *= max(0, $sum);
                        }
            
                        if ($score > $maxScore) {
                            $maxScore = $score;
                        }
                    }
                }
            }
        }

        return (string)$maxScore;
    }
}
