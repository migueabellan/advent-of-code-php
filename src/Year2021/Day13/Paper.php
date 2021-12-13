<?php

namespace App\Year2021\Day13;

class Paper
{
    private const DOT = '#';
    private const EMPTY = '.';

    private array $points = [];
    private array $paper = [];

    public function __construct(array $points)
    {
        $this->points = $points;

        $width = max(array_map(fn ($el) => $el['x'], $points));
        $height = max(array_map(fn ($el) => $el['y'], $points));

        for ($i = 0; $i <= $height; $i++) {
            $this->paper[$i] = array_fill(0, $width + 1, '.');
            ;
        }

        foreach ($points as $p) {
            $this->paper[$p['y']][$p['x']] = self::DOT;
        }
    }

    public function fold(array $instruction): void
    {
        $fold = $instruction['fold'];
        $value = $instruction['value'];

        switch ($fold) {
            case 'y':
                $this->foldUp($value);
                break;
            case 'x':
                $this->foldLeft($value);
                break;
        }
    }

    private function foldUp(int $fold): void
    {
        $paper = [];

        $rows = count($this->paper);
        $cols = count($this->paper[0]);

        for ($i = 0, $i2 = $rows - 1; $i < $fold; $i++, $i2--) {
            for ($j = 0; $j < $cols; $j++) {
                if ($this->paper[$i][$j] === self::DOT || $this->paper[$i2][$j] === self::DOT) {
                    $paper[$i][$j] = self::DOT;
                } else {
                    $paper[$i][$j] = self::EMPTY;
                }
            }
        }

        $this->paper = $paper;
    }

    private function foldLeft(int $fold): void
    {
        $paper = [];

        $rows = count($this->paper);
        $cols = count($this->paper[0]);

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0, $j2 = $cols -1; $j < $fold; $j++, $j2--) {
                if ($this->paper[$i][$j] === self::DOT || $this->paper[$i][$j2] === self::DOT) {
                    $paper[$i][$j] = self::DOT;
                } else {
                    $paper[$i][$j] = self::EMPTY;
                }
            }
        }

        $this->paper = $paper;
    }

    public function calc(): int
    {
        $result = 0;

        foreach ($this->paper as $row) {
            foreach ($row as $point) {
                if ($point === self::DOT) {
                    $result++;
                }
            }
        }

        return $result;
    }


    /**
     * Util print cavern
     */
    public function print(): void
    {
        $WHITE = "\033[1m %s \033[0m";
        $GREEN = "\033[32m %s \033[0m";

        foreach ($this->paper as $row) {
            foreach ($row as $point) {
                if ($point === self::EMPTY) {
                    print_r(sprintf($WHITE, $point));
                }
                if ($point === self::DOT) {
                    print_r(sprintf($GREEN, $point));
                }
            }
            print_r("\n");
        }
        print_r("\n");
    }
}
