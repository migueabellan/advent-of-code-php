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

    private function calculateScore(array $array): int
    {
        $score = 0;

        $i = 1;
        while ($v = array_pop($array)) {
            $score += ($i++ * $v);
        }

        return $score;
    }

    public function exec1(array $array = []): string
    {
        $result = 0;

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

        if (!empty($p1)) {
            $result = $this->calculateScore($p1);
        } else {
            $result = $this->calculateScore($p2);
        }

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        //

        return (string)$result;
    }
}
