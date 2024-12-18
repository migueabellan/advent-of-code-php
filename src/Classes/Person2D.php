<?php

namespace App\Classes;

abstract class Person2D
{
    public const UP = '^';
    public const RIGHT = '>';
    public const DOWN = 'v';
    public const LEFT = '<';

    protected int $x;
    protected int $y;
    protected string $direction;

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function direction(): string
    {
        return $this->direction;
    }

    public function move(int $step = 1): void
    {
        switch ($this->direction) {
            case self::UP:
                $this->y -= $step;
                break;
            case self::RIGHT:
                $this->x += $step;
                break;
            case self::DOWN:
                $this->y += $step;
                break;
            case self::LEFT:
                $this->x -= $step;
                break;
        }
    }


    public function turn(string $direction): void
    {
        switch ($direction) {
            case self::RIGHT:
                $this->turnRight();
                break;
            case self::LEFT:
                $this->turnLeft();
                break;
        }
    }

    public function turnRight(): void
    {
        switch ($this->direction) {
            case self::UP:
                $this->direction = self::RIGHT;
                break;
            case self::RIGHT:
                $this->direction = self::DOWN;
                break;
            case self::DOWN:
                $this->direction = self::LEFT;
                break;
            case self::LEFT:
                $this->direction = self::UP;
                break;
        }
    }

    public function turnLeft(): void
    {
        switch ($this->direction) {
            case self::UP:
                $this->direction = self::LEFT;
                break;
            case self::RIGHT:
                $this->direction = self::UP;
                break;
            case self::DOWN:
                $this->direction = self::RIGHT;
                break;
            case self::LEFT:
                $this->direction = self::DOWN;
                break;
        }
    }

    public function __toString(): string
    {
        return sprintf('%s (%d, %d)', $this->direction, $this->x, $this->y);
    }
}
