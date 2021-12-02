<?php

namespace App\Year2021\Day02;

class Submarine
{
    private const FORWARD   = 'forward';
    private const UP        = 'up';
    private const DOWN      = 'down';

    private int $x;
    private int $y;
    private int $aim;

    public function __construct(int $x = 0, int $y = 0, int $aim = 0)
    {
        $this->x = $x;
        $this->y = $y;
        $this->aim = $aim;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getAim(): int
    {
        return $this->aim;
    }

    public function move1(string $instruction): void
    {
        [$direction, $units] = explode(' ', $instruction);

        switch ($direction) {
            case self::FORWARD:
                $this->x += $units;
                break;
            case self::UP:
                $this->y -= $units;
                break;
            case self::DOWN:
                $this->y += $units;
                break;
        }
    }

    public function move2(string $instruction): void
    {
        [$direction, $units] = explode(' ', $instruction);

        switch ($direction) {
            case self::FORWARD:
                $this->x += $units;
                $this->y += ($units * $this->aim);
                break;
            case self::UP:
                $this->aim -= $units;
                break;
            case self::DOWN:
                $this->aim += $units;
                break;
        }
    }
}
