<?php

namespace App\Year2021\Day21;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match("~^Player (?'player'.*) starting position: (?'position'.*)$~", trim($line), $matches);
                
                $array[$matches['player']] = $matches['position'];
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $p1 = new Player($input[1]);
        $p2 = new Player($input[2]);

        $game = new Game($p1, $p2);
        $game->play();

        return (string)($game->getLose()->getScore() * $game->getRolls());
    }

    public function exec2(array $input = []): string
    {
        $result = 0;

        return (string)$result;
    }
}
