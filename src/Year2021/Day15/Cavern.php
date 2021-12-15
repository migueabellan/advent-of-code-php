<?php

namespace App\Year2021\Day15;

class Cavern
{
    private const COORDS = [
                [0, 1],
        [-1, 0]       , [1, 0],
                [0,-1]
    ];

    private array $map = [];
    private int $rows = 0;
    private int $cols = 0;

    private int $risk = PHP_INT_MAX;

    public function __construct(array $map)
    {
        $this->map = $map;

        $this->rows = count($this->map);
        $this->cols = count($this->map[0]);
    }

    public function getRisk(): int
    {
        return $this->risk;
    }

    public function run(): void
    {
        $visited[0][0] = 0;

        $queue = [[0, 0]];
        while (!empty($queue)) {
            [$x, $y] = array_shift($queue);

            foreach (self::COORDS as [$i, $j]) {
                $newX = $x + $i;
                $newY = $y + $j;

                if (isset($this->map[$newX][$newY]) && !isset($visited[$newX][$newY])) {
                    $risk = $visited[$x][$y] + $this->map[$newX][$newY];
                    $visited[$newX][$newY] = $risk;

                    if ($newX === $this->rows - 1 && $newY === $this->rows - 1) {
                        $this->risk = $risk;
                        return;
                    }

                    $inserted = false;
                    foreach ($queue as $i => $newPoint) {
                        if ($risk <= $visited[$newPoint[0]][$newPoint[1]]) {
                            array_splice($queue, $i, 0, [[$newX, $newY]]);
                            $inserted = true;
                            break;
                        }
                    }
                    if (!$inserted) {
                        $queue[] = [$newX, $newY];
                    }
                }
            }
        }
    }

    public function mirror(): void
    {
        $map = $this->map;

        $rows = max(array_keys($this->map));
        $cols = max(array_keys($this->map[0]));
        
        foreach (range(0, 4) as $iterationY) {
            $additionalY = $iterationY * (1 + $rows);
            foreach (range(0, 4) as $iterationX) {
                if ($iterationY === 0 && $iterationX === 0) {
                    continue;
                }

                $additionalX = $iterationX * (1 + $cols);
                foreach ($map as $y => $row) {
                    foreach ($row as $x => $_) {
                        $result = 1 + ($map[$y][$x] + $iterationX + $iterationY - 1) % 9;
                        $this->map[$y + $additionalY][$x + $additionalX] = $result;
                    }
                }
            }
        }

        $this->rows = count($this->map);
        $this->cols = count($this->map[0]);
    }

    /**
     * Util print matrix
     */
    public function print(array $levels): void
    {
        $WHITE = "\033[1m %s \033[0m";
        $GREEN = "\033[32m %s \033[0m";

        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                if (isset($levels[$i][$j])) {
                    print_r(sprintf($GREEN, $levels[$i][$j]));
                } else {
                    print_r(sprintf($WHITE, ' '));
                }
            }
            print_r("\n");
        }
        print_r("\n");
    }
}
