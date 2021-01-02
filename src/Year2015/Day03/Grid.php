<?php

namespace App\Year2015\Day03;

class Grid
{
    private array $grid;

    public function __construct(int $x = 0, int $y = 0)
    {
        $this->grid[$x][$y] = 0;
    }

    public function addPresent(int $x, int $y): void
    {
        if (!isset($this->grid[$x][$y])) {
            $this->grid[$x][$y] = 0;
        }

        $this->grid[$x][$y]++;
    }

    public function getPresents(): int
    {
        $presents = 0;

        foreach ($this->grid as $v) {
            $presents += count($v);
        }

        return $presents;
    }
}
