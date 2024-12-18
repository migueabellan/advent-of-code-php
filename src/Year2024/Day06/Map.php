<?php

namespace App\Year2024\Day06;

use App\Enums\Direction;

final class Map
{
    private const GUARD = '^';
    private const OBSTRUCTION = '#';
    private const VISITED = 'X';

    private Direction $direction;
    private int $x;
    private int $y;

    public function __construct(private array $array)
    {
        for ($i = 0; $i < count($this->array); $i++) {
            for ($j = 0; $j < count($this->array); $j++) {
                if ($this->array[$i][$j] === self::GUARD) {
                    $this->direction = Direction::UP;
                    $this->x = $i;
                    $this->y = $j;
                }
            }
        }
    }

    public function move(): bool
    {
        $exist = [];

        while (true) {
            $this->array[$this->x][$this->y] = self::VISITED;

            $x = $this->x;
            $y = $this->y;
            switch ($this->direction) {
                case Direction::UP:
                    $x = $this->x - 1;
                    break;
                case Direction::RIGHT:
                    $y = $this->y + 1;
                    break;
                case Direction::DOWN:
                    $x = $this->x + 1;
                    break;
                case Direction::LEFT:
                    $y = $this->y - 1;
                    break;
            }

            if (!isset($this->array[$x][$y])) {
                return true;
            }

            if ($this->array[$x][$y] === self::OBSTRUCTION) {

                // part2
                if (isset($exist[$this->x][$this->y][$this->direction->value])) { // phpcs:disable
                    return false;
                }
                $exist[$this->x][$this->y][$this->direction->value] = true; // phpcs:disable
                // part2

                $this->direction = $this->direction->turnLeft();
            } else {
                $this->x = $x;
                $this->y = $y;
            }
        }
    }

    public function visited(): int
    {
        $result = 0;

        for ($i = 0; $i < count($this->array); $i++) {
            for ($j = 0; $j < count($this->array); $j++) {
                if ($this->array[$i][$j] === self::VISITED) {
                    $result++;
                }
            }
        }

        return $result;
    }

    public function print(): void
    {
        $WHITE = "\033[1m %s \033[0m";
        $GREEN = "\033[32m %s \033[0m";

        for ($i = 0; $i < count($this->array); $i++) {
            for ($j = 0; $j < count($this->array); $j++) {
                if ($this->array[$i][$j] === self::OBSTRUCTION) {
                    print_r(sprintf($GREEN, $this->array[$i][$j]));
                } else {
                    print_r(sprintf($WHITE, $this->array[$i][$j]));
                }
            }
            print_r("\n");
        }
    }
}
