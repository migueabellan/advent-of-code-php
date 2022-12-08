<?php

namespace App\Year2022\Day08;

final class Treetop
{
    private array $visibilities = [];

    public function __construct(
        private array $grid
    ) {
        foreach ($grid as $row) {
            $this->visibilities[] = array_fill(0, count($row), 0);
        }
    }

    private function isVisible(int $i, int $j): bool
    {
        $tree = $this->grid[$i][$j];
        $row = $this->grid[$i];
        $column = array_column($this->grid, $j);

        $directions = [
            'west' => array_reverse(array_slice($row, 0, $j)),
            'east' => array_slice($row, $j + 1),
            'north' => array_reverse(array_slice($column, 0, $i)),
            'south' => array_slice($column, $i + 1),
        ];

        foreach ($directions as $direction) {
            if (empty($direction)) {
                return true;
            }
            if (max($direction) < $tree) {
                return true;
            }
        }

        return false;
    }

    public function analice(): void
    {
        $rows = count($this->grid);
        $cols = count($this->grid[0]);

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                if ($this->isVisible($i, $j)) {
                    $this->visibilities[$i][$j] = 1;
                }
            }
        }
    }

    public function visibleFromOutside(): int
    {
        $result = 0;

        foreach ($this->visibilities as $row) {
            $result += intval(array_sum($row));
        }

        return $result;
    }








    private function countVisibles(int $i, int $j): int
    {
        $tree = $this->grid[$i][$j];
        $row = $this->grid[$i];
        $column = array_column($this->grid, $j);

        $directions = [
            'west' => array_reverse(array_slice($row, 0, $j)),
            'east' => array_slice($row, $j + 1),
            'north' => array_reverse(array_slice($column, 0, $i)),
            'south' => array_slice($column, $i + 1),
        ];

        $total = 1;
        foreach ($directions as $direction) {
            $count = 0;
            foreach ($direction as $value) {
                $count++;
                if ($value >= $tree) {
                    break;
                }
            }

            $total *= $count;
        }

        return $total;
    }

    public function analice2(): void
    {
        $rows = count($this->grid);
        $cols = count($this->grid[0]);

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                $this->visibilities[$i][$j] = $this->countVisibles($i, $j);
            }
        }
    }


    public function maxScore(): int
    {
        $result = 0;

        foreach ($this->visibilities as $row) {
            $max = max($row);
            if ($max > $result) {
                $result = $max;
            }
        }

        return $result;
    }


    public function print(): void
    {
        $HIDDEN = "\033[1m %s \033[0m";
        $VISIBLE = "\033[32m %s \033[0m";

        foreach ($this->visibilities as $row) {
            foreach ($row as $tree) {
                print_r(sprintf($tree === 1 ? $VISIBLE : $HIDDEN, $tree));
            }
            print_r("\n");
        }
        print_r("\n");
    }
}
