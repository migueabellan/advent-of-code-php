<?php

namespace App\Year2015\Day03;

class Grid
{
    public const NORTH = '^';
    public const EAST = '>';
    public const SOUTH = 'v';
    public const WEST = '<';

    private array $grid;
    private int $x;
    private int $y;

    private int $presents;

    public function __construct(int $x = 0, int $y = 0)
    {
        $this->x = $x;
        $this->y = $y;

        $this->presents = 0;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getPresents(): int
    {
        return $this->presents;
    }

    public function move(string $direction, int $step = 1): void
    {
        switch ($direction) {
            case self::NORTH:
                $this->y += $step;
                break;
            case self::EAST:
                $this->x += $step;
                break;
            case self::SOUTH:
                $this->y -= $step;
                break;
            case self::WEST:
                $this->x -= $step;
                break;
        }
    }

    public function addPresent(int $x, int $y): void
    {
        if (!isset($this->grid[$x][$y])) {
            $this->grid[$x][$y] = true;
            $this->presents++;
        }
    }
}
