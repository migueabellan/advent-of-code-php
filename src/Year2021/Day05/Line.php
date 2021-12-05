<?php

namespace App\Year2021\Day05;

class Line
{
    private Point $ini;
    private Point $end;

    public function __construct(Point $ini, Point $end)
    {
        $this->ini = $ini;
        $this->end = $end;
    }

    public function getIni(): Point
    {
        return $this->ini;
    }

    public function getEnd(): Point
    {
        return $this->end;
    }

    public function isHorizontalOrVertical(): bool
    {
        return ($this->ini->getX() === $this->end->getX() ||
            $this->ini->getY() === $this->end->getY());
    }

    public function isDiagonal(): bool
    {
        $x1 = $this->ini->getX();
        $x2 = $this->end->getX();
        $y1 = $this->ini->getY();
        $y2 = $this->end->getY();

        return (abs($y2 - $y1) === abs($x2 - $x1));
    }

    public function getPoints(): array
    {
        $points = [];
        if ($this->isHorizontalOrVertical()) {
            $ini_x = min($this->ini->getX(), $this->end->getX());
            $end_x = max($this->ini->getX(), $this->end->getX());
            $ini_y = min($this->ini->getY(), $this->end->getY());
            $end_y = max($this->ini->getY(), $this->end->getY());

            for ($i = $ini_x; $i <= $end_x; $i++) {
                for ($j = $ini_y; $j <= $end_y; $j++) {
                    $points[] = new Point($i, $j);
                }
            }
        }

        if ($this->isDiagonal()) {
            $xs = [];
            if ($this->ini->getX() > $this->end->getX()) {
                for ($i = $this->ini->getX(); $i >= $this->end->getX(); $i--) {
                    $xs[] = $i;
                }
            } else {
                for ($i = $this->ini->getX(); $i <= $this->end->getX(); $i++) {
                    $xs[] = $i;
                }
            }
            $ys = [];
            if ($this->ini->getY() > $this->end->getY()) {
                for ($i = $this->ini->getY(); $i >= $this->end->getY(); $i--) {
                    $ys[] = $i;
                }
            } else {
                for ($i = $this->ini->getY(); $i <= $this->end->getY(); $i++) {
                    $ys[] = $i;
                }
            }

            for ($i = 0; $i < count($xs); $i++) {
                $points[] = new Point($xs[$i], $ys[$i]);
            }
        }

        return $points;
    }
}
