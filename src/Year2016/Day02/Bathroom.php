<?php

namespace App\Year2016\Day02;

use App\Enums\Direction;

final class Bathroom
{
    public function __construct(
        private array $map,
        private int $row,
        private int $col,
        private string $code = ''
    ) {
    }

    public function move(array $instructions): void
    {
        foreach ($instructions as $instruction) {
            switch (Direction::from($instruction)) {
                case Direction::UP:
                    if (isset($this->map[$this->row - 1][$this->col])) {
                        $this->row--;
                    }
                    break;
                case Direction::LEFT:
                    if (isset($this->map[$this->row][$this->col - 1])) {
                        $this->col--;
                    }
                    break;
                case Direction::DOWN:
                    if (isset($this->map[$this->row + 1][$this->col])) {
                        $this->row++;
                    }
                    break;
                case Direction::RIGHT:
                    if (isset($this->map[$this->row ][$this->col + 1])) {
                        $this->col++;
                    }
                    break;
            }
        }

        $this->code .= $this->map[$this->row][$this->col];
    }

    public function code(): string
    {
        return $this->code;
    }
}
