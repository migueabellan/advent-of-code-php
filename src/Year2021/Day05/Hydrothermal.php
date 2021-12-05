<?php

namespace App\Year2021\Day05;

class Hydrothermal
{
    private array $lines = [];

    public function getLines(): array
    {
        return $this->lines;
    }

    public function add(Line $line): self
    {
        $this->lines[] = $line;

        return $this;
    }

    public function calc(): int
    {
        $points = [];
        
        foreach ($this->lines as $line) {
            foreach ($line->getPoints() as $point) {
                $xy = sprintf('%d,%d', $point->getX(), $point->getY());
                if (!isset($points[$xy])) {
                    $points[$xy] = 0;
                }

                $points[$xy]++;
            }
        }

        return count(array_filter($points, function ($el) {
            return $el >= 2;
        }));
    }
}
