<?php

namespace App\Year2021\Day21;

class Game
{
    private const MAX_DICE  = 100;
    private const MAX_SCORE = 1000;

    private int $dice;
    private int $rolls;

    private Player $p1;
    private Player $p2;
    private Player $win;
    private Player $lose;

    public function __construct(Player $p1, Player $p2)
    {
        $this->dice = 1;
        $this->rolls = 0;

        $this->p1 = $p1;
        $this->p2 = $p2;
    }

    public function getRolls(): int
    {
        return $this->rolls;
    }

    public function getWin(): Player
    {
        return $this->win;
    }

    public function getLose(): Player
    {
        return $this->lose;
    }

    private function isMaxScore(Player $player): bool
    {
        return $player->getScore() >= self::MAX_SCORE;
    }

    private function rolls(int $times = 3): int
    {
        $this->rolls += $times;

        $result = 0;

        foreach (range(1, $times) as $_) {
            $result += $this->dice;

            $this->dice = ($this->dice % self::MAX_DICE) + 1;
        }

        return $result;
    }

    public function play(): void
    {
        while (true) {
            $dice = $this->rolls();
            $this->p1->addPosition($dice);
            $this->p1->addScore($this->p1->getPosition());

            if ($this->isMaxScore($this->p1)) {
                $this->win = $this->p1;
                $this->lose = $this->p2;
                return;
            }

            $dice = $this->rolls();
            $this->p2->addPosition($dice);
            $this->p2->addScore($this->p2->getPosition());

            if ($this->isMaxScore($this->p2)) {
                $this->win = $this->p2;
                $this->lose = $this->p1;
                return;
            }
        }
    }
}
