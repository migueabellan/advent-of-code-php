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



        $maxScore = 0;

        for ($a = 0; $a <= 100; $a++) {
            echo $a . "\n";
            for ($b = 0; $b <= 100 - $a; $b++) {
                for ($c = 0; $c <= 100 - $a - $b; $c++) {
                    $d = 100 - $a - $b - $c;
                    $eSum = $a * $input[0][4] + $b * $input[1][4] + $c * $input[2][4] + $d * $input[3][4];

                    if ($eSum !== 500) {
                        continue;
                    }

                    $aSum = $a * $input[0][0] + $b * $input[1][0] + $c * $input[2][0] + $d * $input[3][0];
                    $bSum = $a * $input[0][1] + $b * $input[1][1] + $c * $input[2][1] + $d * $input[3][1];
                    $cSum = $a * $input[0][2] + $b * $input[1][2] + $c * $input[2][2] + $d * $input[3][2];
                    $dSum = $a * $input[0][3] + $b * $input[1][3] + $c * $input[2][3] + $d * $input[3][3];

                    $aSum = max(0, $aSum);
                    $bSum = max(0, $bSum);
                    $cSum = max(0, $cSum);
                    $dSum = max(0, $dSum);

                    $score = $aSum * $bSum * $cSum * $dSum;

                    if ($score > $maxScore) {
                        $maxScore = $score;
                    }
                }
            }
        }

        return (string)$maxScore;
    }
}
