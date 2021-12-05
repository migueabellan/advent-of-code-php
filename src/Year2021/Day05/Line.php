<?php

namespace App\Year2021\Day05;

class Line
{
    private int $x1;
    private int $x2;
    private int $y1;
    private int $y2;

    public function __construct(Point $ini, Point $end)
    {
        $this->x1 = $ini->getX();
        $this->x2 = $end->getX();
        $this->y1 = $ini->getY();
        $this->y2 = $end->getY();
    }

    public function isHorizontal(): bool
    {
        return $this->x1 === $this->x2;
    }

    public function isVertical(): bool
    {
        return $this->y1 === $this->y2;
    }

    public function isDiagonal(): bool
    {
        return (abs($this->x2 - $this->x1) === abs($this->y2 - $this->y1));
    }

    public function getPoints(): array
    {
        $points = [];

        if ($this->isHorizontal() || $this->isVertical()) {
            foreach (range($this->x1, $this->x2) as $x) {
                foreach (range($this->y1, $this->y2) as $y) {
                    $points[] = new Point($x, $y);
                }
            }
        }

        if ($this->isDiagonal()) {
            $x = $this->x1;
            $y = $this->y1;
            $points[] = new Point($x, $y);

            for ($i = 0; $i < max(abs($this->x2 - $this->x1), abs($this->y2 - $this->y1)); $i++) {
                $x += $this->x2 <=> $this->x1;
                $y += $this->y2 <=> $this->y1;
                $points[] = new Point($x, $y);
            }
        }

        return $points;
    }
}
