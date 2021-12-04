<?php

namespace App\Year2021\Day04;

class Bingo
{
    private const EMPTY = [[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]];

    private array $boards = [];
    private array $marks = [];
    private array $wins = [];

    private int $num_boards = 0;

    public function __construct(array $boards)
    {
        $this->boards = $boards;

        $this->num_boards = count($boards);

        foreach ($boards as $boards) {
            $this->marks[] = self::EMPTY;
        }
    }

    public function getNumBoards(): int
    {
        return $this->num_boards;
    }

    public function play(int $number): void
    {
        foreach ($this->boards as $num_board => $board) {
            $row = false;
            $col = false;

            for ($i = 0; $i < 5; $i++) {
                if (false !== array_search($number, $board[$i])) {
                    $row = $i;
                }
                if (false !== array_search($number, array_column($board, $i))) {
                    $col = $i;
                }
            }

            if (false !== $row && false !== $col) {
                $this->marks[$num_board][$row][$col] = 1;
            }
        }
    }

    public function win(): array
    {
        foreach ($this->marks as $num_board => $board) {

            for ($i = 0; $i < 5; $i++) {
                if (array_sum($board[$i]) === 5) {
                    if (false === array_search($num_board, $this->wins)) {
                        $this->wins[] = $num_board;
                    }
                }
                if (array_sum(array_column($board, $i)) === 5) {
                    if (false === array_search($num_board, $this->wins)) {
                        $this->wins[] = $num_board;
                    }
                }
            }
        }

        return $this->wins;
    }

    public function calc(int $number, int $num_board): int
    {
        $result = 0;

        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                if (!$this->marks[$num_board][$i][$j]) {
                    $result += $this->boards[$num_board][$i][$j];
                }
            }
        }

        return $result * $number;
    }
}
