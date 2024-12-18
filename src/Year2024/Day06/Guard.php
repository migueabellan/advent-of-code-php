<?php

namespace App\Year2024\Day06;

use App\Classes\Person2D;

final class Guard extends Person2D
{
    public function __construct(
        protected int $x,
        protected int $y,
    ) {
        $this->direction = self::UP;
    }

    public function nextX(): int
    {
        switch ($this->direction()) {
            case self::RIGHT:
                return $this->x + 1;
            case self::LEFT:
                return $this->x - 1;
            default:
                return $this->x;
        }
    }

    public function nextY(): int
    {
        switch ($this->direction()) {
            case self::UP:
                return $this->y - 1;
            case self::DOWN:
                return $this->y + 1;
            default:
                return $this->y;
        }
    }
}
