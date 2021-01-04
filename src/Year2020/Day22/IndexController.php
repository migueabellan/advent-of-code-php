<?php

namespace App\Year2020\Day22;

use App\Puzzle\AbstractPuzzle;

class IndexController extends AbstractPuzzle
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



    private function playRound(array &$game, array &$p1, array &$p2): ?int
    {
        $key = implode(',', $p1) . '~' . implode(',', $p2);
        if (!empty($game[$key])) {
            return 1;
        }
    
        $game[$key] = true;
    
        $c1 = array_shift($p1);
        $c2 = array_shift($p2);

        $winner = null;
    
        if (count($p1) >= $c1 && count($p2) >= $c2) {
            $newp1 = array_slice($p1, 0, $c1);
            $newp2 = array_slice($p2, 0, $c2);
            $winner = $this->playGame($newp1, $newp2);
        } else {
            $winner = ($c1 > $c2) ? 1 : 2;
        }
    
        if ($winner == 1) {
            $p1[] = $c1;
            $p1[] = $c2;
        } else {
            $p2[] = $c2;
            $p2[] = $c1;
        }
    
        return null;
    }
    
    private function playGame(array &$p1, array &$p2): int
    {
        $winner = null;
        $game = [];

        while (!$winner) {
            $winner = $this->playRound($game, $p1, $p2);
    
            if (empty($p1)) {
                $winner = 2;
            }
    
            if (empty($p2)) {
                $winner = 1;
            }
        }
    
        return $winner;
    }

    public function exec2(array $array = []): string
    {
        $p1 = $array[1];
        $p2 = $array[2];

        $this->playGame($p1, $p2);

        $result = $this->calculateScore($this->getWinner($p1, $p2));

        return (string)$result;
    }
}
