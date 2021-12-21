<?php

namespace App\Year2021\Day21;

class Player
{
    private const MAX_POSITION      = 10;

    private int $position           = 0;
    private int $score              = 0;

    public function __construct(int $position)
    {
        $this->position = $position;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function addScore(int $score): self
    {
        $this->score += $score;

        return $this;
    }

    public function addPosition(int $position): self
    {
        $this->position += $position;

        $this->position--;
        $this->position = ($this->position % self::MAX_POSITION);
        $this->position++;

        return $this;
    }

    public function __toString(): string
    {
        return sprintf('Position: %d, Score: %d', $this->position, $this->score);
    }
}
