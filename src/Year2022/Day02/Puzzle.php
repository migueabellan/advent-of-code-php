<?php

namespace App\Year2022\Day02;

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
                $round = explode(' ', trim($line));

                $array[] = [
                    $this->decrypt($round[0]),
                    $this->decrypt($round[1])
                ];
            }
            fclose($file);
        }

        return $array;
    }

    private function decrypt(string $shape): int
    {
        return match ($shape) {
            'A', 'X' => Game::ROCK,
            'B', 'Y' => Game::PAPPER,
            'C', 'Z' => Game::SCISSORS,
            default => 0
        };
    }

    public function exec1(array $input = []): int
    {
        $game = new Game();

        foreach ($input as [$opponent, $response]) {
            $game->addRound($opponent, $response);
        }

        return $game->getScore();
    }

    public function exec2(array $input = []): int
    {
        $game = new Game();

        foreach ($input as [$opponent, $response]) {
            $response = $game->trap($opponent, $response);
            $game->addRound($opponent, $response);
        }

        return $game->getScore();
    }
}
