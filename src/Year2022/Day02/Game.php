<?php

namespace App\Year2022\Day02;

final class Game
{
    public const ROCK = 1;
    public const PAPPER = 2;
    public const SCISSORS = 3;

    private const POINTS_LOST = 0;
    private const POINTS_DRAW = 3;
    private const POINTS_WIN = 6;

    private const DEFEATS = [
        self::ROCK => self::SCISSORS,
        self::PAPPER => self::ROCK,
        self::SCISSORS => self::PAPPER,
    ];

    private array $score = [];

    public function addRound(int $opponent, int $response): void
    {
        $result = $response;

        if ($opponent === $response) {
            $result += self::POINTS_DRAW;
        } elseif (self::DEFEATS[$opponent] === $response) {
            $result += self::POINTS_LOST;
        } else {
            $result += self::POINTS_WIN;
        }

        $this->score[] = $result;
    }

    public function trap(string $opponent, string $response): int
    {
        switch ($response) {
            case self::ROCK:
                $response = self::DEFEATS[$opponent];
                break;
            case self::PAPPER:
                $response = $opponent;
                break;
            case self::SCISSORS:
                $response = array_search($opponent, self::DEFEATS);
                break;
        }

        return $response;
    }

    public function getScore(): int
    {
        return intval(array_sum($this->score));
    }
}
