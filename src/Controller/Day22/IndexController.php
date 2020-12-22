<?php

namespace App\Controller\Day22;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        $player = 1;
        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if ($line !== '') {
                    if (preg_match("~^Player (?'player'.*):$~", $line, $matches)) {
                        $player = $matches['player'];
                    }

                    if (preg_match('/^[0-9]+$/', $line)) {
                        $array[$player][] = (int)$line;
                    }
                }
            }
            fclose($file);
        }

        return $array;
    }

    private function getWinner(array $p1, array $p2): array
    {
        return count($p1) > count($p2) ? $p1 : $p2;
    }

    private function calculateScore(array $array): int
    {
        $score = 0;

        foreach (array_reverse($array) as $i => $v) {
            $score += ($i + 1) * $v;
        }

        return $score;
    }

    public function exec1(array $array = []): string
    {
        $p1 = $array[1];
        $p2 = $array[2];

        while (!empty($p1) && !empty($p2)) {
            $c1 = array_shift($p1);
            $c2 = array_shift($p2);
            if ($c1 > $c2) {
                array_push($p1, $c1);
                array_push($p1, $c2);
            } else {
                array_push($p2, $c2);
                array_push($p2, $c1);
            }
        }

        $result = $this->calculateScore($this->getWinner($p1, $p2));

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;
        
        $p1 = $array[1];
        $p2 = $array[2];


        return (string)$result;
    }
}
