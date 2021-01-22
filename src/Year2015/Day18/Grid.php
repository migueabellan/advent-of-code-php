<?php

namespace App\Year2015\Day18;

class Grid
{
    private const COORDINATES = [
        [-1, -1], [-1, +0], [-1, 1],
        [+0, -1], /*******/ [+0, 1],
        [+1, -1], [+1, +0], [+1, 1],
    ];

    private const ON = '#';
    private const OFF = '.';

    private array $grid;

    private int $width;
    private int $height;

    public function __construct(array $array)
    {
        $this->width = strlen($array[0]);
        $this->height = strlen($array[0]);

        foreach ($array as $i => $row) {
            for ($j = 0; $j < strlen($row); $j++) {
                switch ($array[$i][$j]) {
                    case self::ON:
                        $this->grid[$i][$j] = true;
                        break;
                    case self::OFF:
                        $this->grid[$i][$j] = false;
                        break;
                }
            }
        }
    }

    public function animate(): void
    {
        $aux = [];

        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->height; $y++) {
                $count = $this->getNumNeighbors($x, $y);

                if ($this->grid[$x][$y] && (2 !== $count && 3 !== $count)) {
                    $aux[$x][$y] = false;
                }
        
                if (!$this->grid[$x][$y] && 3 === $count) {
                    $aux[$x][$y] = true;
                }
            }
        }

        for ($i = 0; $i < $this->width; $i++) {
            for ($j = 0; $j < $this->height; $j++) {
                if (isset($aux[$i][$j])) {
                    $this->grid[$i][$j] = $aux[$i][$j];
                }
            }
        }
    }

    public function getNumNeighbors(int $x, int $y): int
    {
        $count = 0;

        foreach (self::COORDINATES as $c) {
            if (isset($this->grid[$x + $c[0]][$y + $c[1]])) {
                if ($this->grid[$x + $c[0]][$y + $c[1]]) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function fixCorners(): void
    {
        $corners = [
            [0, 0],
            [0, $this->width - 1],
            [$this->width - 1, 0],
            [$this->width - 1, $this->width - 1]
        ];

        foreach ($corners as $corner) {
            $this->grid[$corner[0]][$corner[1]] = true;
        }
    }

    public function getNumLights(): int
    {
        $lights = 0;

        for ($i = 0; $i < $this->width; $i++) {
            for ($j = 0; $j < $this->height; $j++) {
                if ($this->grid[$i][$j]) {
                    $lights++;
                }
            }
        }

        return $lights;
    }
}
