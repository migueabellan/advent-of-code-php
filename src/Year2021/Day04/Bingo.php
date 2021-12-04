<?php

namespace App\Year2021\Day04;

class Bingo
{
    private array $numbers = [];
    private array $boards = [];
    private array $wins = [];

    public function __construct(array $numbers)
    {
        $this->numbers = $numbers;
    }

    public function getNumbers(): array
    {
        return $this->numbers;
    }

    public function add(Board $board): self
    {
        $this->boards[] = $board;

        return $this;
    }

    public function play(int $number): void
    {
        foreach ($this->boards as $k => $board) {
            $board->search($number);

            if ($board->isWin()) {
                if (false === array_search($k, $this->wins)) {
                    $this->wins[] = $k;
                }
            }
        }
    }

    public function getFirstWin(): ?Board
    {
        $first = 0;

        if (isset($this->wins[$first])) {
            return $this->boards[$this->wins[$first]];
        }

        return null;
    }

    public function getLastWin(): ?Board
    {
        $last = count($this->boards) - 1;

        if (isset($this->wins[$last])) {
            return $this->boards[$this->wins[$last]];
        }
        
        return null;
    }
}
