<?php

namespace App\Year2018\Day03;

final class Chimney
{
    public function __construct(
        private array $overlaps = []
    ) {
    }

    public function add(array $claim): void
    {
        for ($i = $claim['x1']; $i < $claim['x2']; $i++) {
            for ($j = $claim['y1']; $j < $claim['y2']; $j++) {
                if (!isset($this->overlaps[$i][$j])) {
                    $this->overlaps[$i][$j] = 0;
                }
                $this->overlaps[$i][$j]++;
            }
        }
    }

    public function getOverlaps(): int
    {
        $result = 0;

        foreach ($this->overlaps as $row) {
            foreach ($row as $col) {
                if ($col > 1) {
                    $result++;
                }
            }
        }

        return $result;
    }

    public function isOverlaps(array $claim): bool
    {
        for ($i = $claim['x1']; $i < $claim['x2']; $i++) {
            for ($j = $claim['y1']; $j < $claim['y2']; $j++) {
                if ($this->overlaps[$i][$j] > 1) {
                    return true;
                }
            }
        }

        return false;
    }
}
