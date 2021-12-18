<?php

namespace App\Year2021\Day17;

class Probe
{
    private int $min_x = 0;
    private int $max_x = 0;
    private int $min_y = 0;
    private int $max_y = 0;

    public array $trajectory;

    public function __construct(array $target_x, array $target_y)
    {
        $this->min_x = min($target_x);
        $this->max_x = max($target_x);
        $this->min_y = min($target_y);
        $this->max_y = max($target_y);
    }

    public function getMaxX(): int
    {
        return $this->max_x;
    }

    public function getMinY(): int
    {
        return $this->min_y;
    }

    public function launch(int $x, int $y): bool
    {
        $current_x = 0;
        $current_y = 0;

        $this->trajectory = [];

        while ($current_x <= $this->max_x && $current_y >= $this->min_y) {
            $current_x += $x;
            $current_y += $y;

            $this->trajectory[] = [$current_x, $current_y];

            if ($current_x >= $this->min_x && $current_x <= $this->max_x &&
                $current_y <= $this->max_y && $current_y >= $this->min_y) {
                return true;
            }

            if ($x > 0) {
                $x--;
            } elseif ($x < 0) {
                $x++;
            }

            $y--;
        }

        return false;
    }

    public function getMaxHeight(): int
    {
        $result = 0;

        foreach ($this->trajectory as $point) {
            $result = max($result, $point[1]);
        }

        return $result;
    }
}
