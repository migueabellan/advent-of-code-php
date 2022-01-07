<?php

namespace App\Year2017\Day03;

use App\Enums\Direction;

final class Memory
{
    private const COORDINATES = [
        [-1, -1], [-1, +0], [-1, 1],
        [+0, -1], /*******/ [+0, 1],
        [+1, -1], [+1, +0], [+1, 1],
    ];

    public function __construct(
        private array $cells = [],
        private array $squares = [],
        private int $width = 0,
        private int $height = 0,
        private int $sum = 0
    ) {
    }

    public function getManhattanDistance(): int
    {
        return $this->width + $this->height;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function espiral(int $cell): void
    {
        $min_x = $min_y = $max_x = $max_y = 0;

        $direction = Direction::RIGHT;

        for ($i = 1; $i < $cell; $i++) {
            // First puzzle
            $this->cells[$this->width][$this->height] = $i;

            // Second puzzle
            $sum = 0;
            foreach (self::COORDINATES as $coordinate) {
                $x = $this->width + $coordinate[0];
                $y = $this->height + $coordinate[1];
    
                $sum += $this->squares[$x][$y] ?? 0;
            }
            if ($sum > 0) {
                $this->squares[$this->width][$this->height] = $sum;
                if ($sum > $cell) {
                    $this->sum = intval($sum);
                    break;
                }
            }

            switch ($direction) {
                case Direction::UP:
                    $this->height += 1;
                    if ($this->height === $max_y + 1) {
                        $direction = Direction::LEFT;
                        $max_y += 1;
                    }
                    break;
                case Direction::LEFT:
                    $this->width -= 1;
                    if ($this->width === $min_x - 1) {
                        $direction = Direction::DOWN;
                        $min_x -= 1;
                    }
                    break;
                case Direction::DOWN:
                    $this->height -= 1;
                    if ($this->height === $min_y - 1) {
                        $direction = Direction::RIGHT;
                        $min_y -= 1;
                    }
                    break;
                case Direction::RIGHT:
                    $this->width += 1;
                    if ($this->width === $max_x + 1) {
                        $direction = Direction::UP;
                        $max_x += 1;
                    }
                    break;
            }
        }

        $this->width = abs($this->width);
        $this->height = abs($this->height);
    }
}
