<?php

namespace App\Year2024\Day06;

final class Map
{
    public const GUARD = '^';
    public const OBSTRUCTION = '#';
    public const VISITED = 'X';

    public function __construct(
        private array $array,
        private Guard $guard,
    ) {
    }

    public function array(): array
    {
        return $this->array;
    }

    public function walk(): void
    {
        $obstructions = [];

        while (true) {
            $this->array[$this->guard->y()][$this->guard->x()] = self::VISITED;

            $x = $this->guard->nextX();
            $y = $this->guard->nextY();

            if (!isset($this->array[$y][$x])) {
                break;
            }

            if ($this->array[$y][$x] === self::OBSTRUCTION) {
                if (isset($obstructions[$this->guard->__toString()])) {
                    throw new \Exception('Infinite loop');
                }
                $obstructions[$this->guard->__toString()] = true;

                $this->guard->turnRight();
            } else {
                $this->guard->move();
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
