<?php

namespace App\Year2021\Day09;

class Point
{
    private int $x = 0;
    private int $y = 0;
    private int $value = 0;

    public function __construct(int $x, int $y, int $value)
    {
        $this->x = $x;
        $this->y = $y;
        $this->value = $value;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return sprintf('%d,%d', $this->x, $this->y);
    }
}
