<?php

namespace App\Year2021\Day11;

class Cavern
{
    private const COORDS = [
        [-1, 1], [0, 1], [1, 1],
        [-1, 0]        , [1, 0],
        [-1,-1], [0,-1], [1,-1]
    ];

    private array $octopuses;
    private int $rows = 0;
    private int $cols = 0;
    private int $flashes = 0;

    public function __construct(array $octopuses)
    {
        $this->octopuses = $octopuses;

        $this->rows = count($this->octopuses);
        $this->cols = count($this->octopuses[0]);
    }

    public function getFlashes(): int
    {
        return $this->flashes;
    }

    private function getAdyacents(int $x, int $y, array &$visited): int
    {
        $flashes = 1;
        $this->octopuses[$x][$y] = 0;
        $visited[] = [$x, $y];

        foreach (self::COORDS as [$i, $j]) {
            if (isset($this->octopuses[$x + $i][$y + $j]) && !in_array([$x + $i, $y + $j], $visited)) {
                $this->octopuses[$x + $i][$y + $j]++;

                if ($this->octopuses[$x + $i][$y + $j] === 10) {
                    $flashes += $this->getAdyacents($x + $i, $y + $j, $visited);
                }
            }
        }

        return $flashes;
    }

    public function step(): void
    {
        for ($x = 0; $x < $this->rows; $x++) {
            for ($y = 0; $y < $this->cols; $y++) {
                $this->octopuses[$x][$y]++;
            }
        }

        $visited = [];
        $this->flashes = 0;
        for ($x = 0; $x < $this->rows; $x++) {
            for ($y = 0; $y < $this->cols; $y++) {
                if ($this->octopuses[$x][$y] > 9) {
                    $this->flashes += $this->getAdyacents($x, $y, $visited);
                }
            }
        }
    }

    public function isAllFlash(): bool
    {
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                if ($this->octopuses[$i][$j] !== 0) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Util print matrix
     */
    public function print(): void
    {
        $WHITE = "\033[1m %s \033[0m";
        $GREEN = "\033[32m %s \033[0m";

        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                if ($this->octopuses[$i][$j] === 0) {
                    print_r(sprintf($GREEN, $this->octopuses[$i][$j]));
                } else {
                    print_r(sprintf($WHITE, $this->octopuses[$i][$j]));
                }
            }
            print_r("\n");
        }
        print_r("\n");
    }
}
