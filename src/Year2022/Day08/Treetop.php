<?php

namespace App\Year2022\Day08;

final class Treetop
{
    private array $visibilities = [];
    private int $rows = 0;
    private int $cols = 0;

    public function __construct(
        private array $grid
    ) {
        $this->rows = count($grid);
        $this->cols = count($grid[0]);

        $this->visibilities = array_fill(0, $this->rows, array_fill(0, $this->cols, 0));
    }

    private function getAdyacents(int $i, int $j): array
    {
        $row = $this->grid[$i];
        $column = array_column($this->grid, $j);

        return [
            'top' => array_reverse(array_slice($column, 0, $i)),
            'right' => array_slice($row, $j + 1),
            'bottom' => array_slice($column, $i + 1),
            'left' => array_reverse(array_slice($row, 0, $j)),
        ];
    }

    public function visibleFromOutside(): int
    {
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                $directions = $this->getAdyacents($i, $j);
                foreach ($directions as $direction) {
                    if (empty($direction) || max($direction) < $this->grid[$i][$j]) {
                        $this->visibilities[$i][$j] = 1;
                    }
                }
            }
        }

        return array_reduce(
            $this->visibilities,
            static fn(int $result, array $row) => $result + intval(array_sum($row)),
            initial: 0
        );
    }

    public function maxScenicScore(): int
    {
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                $directions = $this->getAdyacents($i, $j);

                $total = 1;
                foreach ($directions as $direction) {
                    $count = 0;
                    foreach ($direction as $value) {
                        $count++;
                        if ($value >= $this->grid[$i][$j]) {
                            break;
                        }
                    }
                    $total *= $count;
                }

                $this->visibilities[$i][$j] = $total;
            }
        }

        return max(array_map(
            static fn(array $row) => max($row),
            $this->visibilities
        ));
    }

    /**
     * Util print matrix
     */
    public function print(): void
    {
        $HIDDEN = "\033[1m %s \033[0m";
        $VISIBLE = "\033[32m %s \033[0m";

        foreach ($this->visibilities as $row) {
            foreach ($row as $tree) {
                print_r(sprintf($tree ? $VISIBLE : $HIDDEN, $tree));
            }
            print_r("\n");
        }
        print_r("\n");
    }
}
