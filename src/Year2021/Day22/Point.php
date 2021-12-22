<?php

namespace App\Year2021\Day22;

class Point
{
    public const MIN = -50;
    public const MAX = 50;

    private int $min = 0;
    private int $max = 0;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function getMin(): int
    {
        return max($this->min, self::MIN);
    }

    public function getMax(): int
    {
        return min($this->max, self::MAX);
    }
}
