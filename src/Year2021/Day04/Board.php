<?php

namespace App\Year2021\Day04;

class Board
{
    private array $board = [];
    private array $marks = [
        [0,0,0,0,0],
        [0,0,0,0,0],
        [0,0,0,0,0],
        [0,0,0,0,0],
        [0,0,0,0,0]
    ];

    public function __construct(array $board)
    {
        $this->board = $board;
    }

    public function search(int $number): void
    {
        $row = false;
        $col = false;

        for ($i = 0; $i < 5; $i++) {
            if (false !== array_search($number, $this->board[$i])) {
                $row = $i;
            }
            if (false !== array_search($number, array_column($this->board, $i))) {
                $col = $i;
            }
        }

        if (false !== $row && false !== $col) {
            $this->marks[$row][$col] = 1;
        }
    }

    public function isWin(): bool
    {
        for ($i = 0; $i < 5; $i++) {
            if (array_sum($this->marks[$i]) === 5) {
                return true;
            }
            if (array_sum(array_column($this->marks, $i)) === 5) {
                return true;
            }
        }

        return false;
    }

    public function calc(): int
    {
        $result = 0;

        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                if (!$this->marks[$i][$j]) {
                    $result += $this->board[$i][$j];
                }
            }
        }

        return $result;
    }

    /**
     * Util print matrix
     */
    public function print(): void
    {
        $WHITE = "\033[1m %s \033[0m";
        $GREEN = "\033[32m %s \033[0m";

        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                if ($this->marks[$i][$j]) {
                    print_r(sprintf($GREEN, $this->board[$i][$j]));
                } else {
                    print_r(sprintf($WHITE, $this->board[$i][$j]));
                }
            }
            print_r("\n");
        }
    }
}
