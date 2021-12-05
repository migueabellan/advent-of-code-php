<?php

namespace App\Year2021\Day05;

class Point
{
    private int $x = 0;
    private int $y = 0;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function __toString(): string
    {
        return sprintf('%d,%d', $this->x, $this->y);
    }
}
