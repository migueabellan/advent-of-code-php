<?php

namespace App\Year2016\Day01;

use App\Enums\Direction;
use UnexpectedValueException;

final class Taxicab
{
    public function __construct(
        private Direction $direction = Direction::UP,
        private int $x = 0,
        private int $y = 0,
        private int $first_x = 0,
        private int $first_y = 0,
        private array $visited = []
    ) {
        $this->visited[$this->x][$this->y] = true;
    }

    public function move(string $turn, int $steps): void
    {
        $this->direction = match (Direction::from($turn)) {
            Direction::LEFT  => $this->direction->turnLeft(),
            Direction::RIGHT => $this->direction->turnRight(),
            default => throw new UnexpectedValueException()
        };

        for ($i = 0; $i < $steps; $i++) {
            switch ($this->direction) {
                case Direction::UP:
                    $this->y++;
                    break;
                case Direction::LEFT:
                    $this->x++;
                    break;
                case Direction::DOWN:
                    $this->y--;
                    break;
                case Direction::RIGHT:
                    $this->x--;
                    break;
            }

            if ($this->first_x === 0 &&
                $this->first_y === 0 &&
                isset($this->visited[$this->x][$this->y])
            ) {
                $this->first_x = $this->x;
                $this->first_y = $this->y;
            }

            $this->visited[$this->x][$this->y] = true;
        }
    }

    public function length(bool $is_first_location = false): int
    {
        if ($is_first_location) {
            return abs($this->first_x) + abs($this->first_y);
        }

        return abs($this->x) + abs($this->y);
    }
}
