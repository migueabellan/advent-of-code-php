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

        foreach ([[-1, 0], [0, 1], [1, 0], [0, -1]] as [$i, $j]) {
            if (isset($this->map[$x + $i][$y + $j])) {
                $adyacents[] = new Point($x + $i, $y + $j, $this->map[$x + $i][$y + $j]);
            }
        }
        
        return $adyacents;
    }


    private function checkAdjacents(Point $point, array &$result = []): array
    {
        $this->map[$point->getX()][$point->getY()] = PHP_INT_MAX;

        $result[] = $point->__toString();

        $adyacents = $this->getAdyacents($point->getX(), $point->getY());
        $adyacents = array_filter($adyacents, function ($el) {
            return $el->getValue() < 9;
        });

        foreach ($adyacents as $point) {
            if ($this->map[$point->getX()][$point->getY()] < 9) {
                $this->checkAdjacents($point, $result);
            }
        }

        return $result;
    }

    public function getLowPoints(): array
    {
        $low_points = [];

        foreach ($this->map as $x => $row) {
            foreach ($row as $y => $value) {
                $adyacents = $this->getAdyacents($x, $y);

                $adyacents_lower = array_filter($adyacents, function ($el) use ($value) {
                    return $value < $el->getValue();
                });

                if (count($adyacents) === count($adyacents_lower)) {
                    $low_points[] = new Point($x, $y, $value);
                }
            }
        }

        return $low_points;
    }

    public function getBasins(): array
    {
        $basins = [];

        foreach ($this->getLowPoints() as $point) {
            $result = $this->checkAdjacents($point);
            $basins[] = count($result);
        }

        return $basins;
    }
}
