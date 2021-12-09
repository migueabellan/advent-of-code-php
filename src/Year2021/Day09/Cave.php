<?php

namespace App\Year2021\Day09;

class Cave
{
    private array $map;

    public function __construct(array $map)
    {
        $this->map = $map;
    }

    private function getAdyacents(int $x, int $y): array
    {
        $adyacents = [];

        $adyacents[] = new Point($x - 1, $y, $this->map[$x - 1][$y] ?? PHP_INT_MAX);
        $adyacents[] = new Point($x, $y + 1, $this->map[$x][$y + 1] ?? PHP_INT_MAX);
        $adyacents[] = new Point($x + 1, $y, $this->map[$x + 1][$y] ?? PHP_INT_MAX);
        $adyacents[] = new Point($x, $y - 1, $this->map[$x][$y - 1] ?? PHP_INT_MAX);

        return $adyacents;
    }

    public function getLowPoints(): array
    {
        $low_points = [];

        $rows = count($this->map);
        $cols = count($this->map[0]);

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                $value = $this->map[$i][$j];

                $adyacents = $this->getAdyacents($i, $j);
                $adyacents = array_filter($adyacents, function ($el) use ($value) {
                    return $value < $el->getValue();
                });

                if (count($adyacents) === 4) {
                    $low_points[] = new Point($i, $j, $value);
                }
            }
        }

        return $low_points;
    }

    public function checkAdjacents(int $x, int $y): int
    {
        $this->map[$x][$y] = PHP_INT_MAX;

        $area = 1;
        foreach ([[-1, 0], [0, 1], [1, 0], [0, -1]] as [$i, $j]) {
            if (isset($this->map[$x + $i][$y + $j]) && $this->map[$x + $i][$y + $j] < 9) {
                $area += $this->checkAdjacents($x + $i, $y + $j);
            }
        }

        return $area;
    }
}
