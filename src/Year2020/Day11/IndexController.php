<?php

namespace App\Year2020\Day11;

use App\Puzzle\AbstractPuzzle;

class IndexController extends AbstractPuzzle
{
    private const FLOOR = '.';
    private const OCCUPIED = '#';
    private const UNOCCUPIED = 'L';

    private const COORDINATES = [
        [-1, -1], [-1, +0], [-1, 1],
        [+0, -1], /*******/ [+0, 1],
        [+1, -1], [+1, +0], [+1, 1],
    ];

    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = str_split(trim($line));
                $array[] = $line;
            }
            fclose($file);
        }
        
        return $array;
    }

    private function countOccupied(array $array): int
    {
        $result = 0;

        for ($i = 0; $i < count($array); $i++) {
            for ($j = 0; $j < count($array[$i]); $j++) {
                if ($array[$i][$j] === self::OCCUPIED) {
                    $result++;
                }
            }
        }

        return $result;
    }

    private function occupiedAdyacentBy(array $array, int $row, int $col): int
    {
        $count = 0;

        foreach (self::COORDINATES as $seat) {
            $i = $row + $seat[0];
            $j = $col + $seat[1];

            if (isset($array[$i][$j]) && $array[$i][$j] === self::OCCUPIED) {
                $count++;
            }
        }

        return $count;
    }

    public function exec1(array $array = []): string
    {
        $aux = $array;

        do {
            $changes = 0;
            for ($i = 0; $i < count($array); $i++) {
                for ($j = 0; $j < count($array[$i]); $j++) {
                    switch ($array[$i][$j]) {
                        case self::FLOOR:
                            break;
                        case self::UNOCCUPIED:
                            if ($this->occupiedAdyacentBy($array, $i, $j) === 0) {
                                $aux[$i][$j] =  self::OCCUPIED;
                                $changes++;
                            }
                            break;
                        case self::OCCUPIED:
                            if ($this->occupiedAdyacentBy($array, $i, $j) >= 4) {
                                $aux[$i][$j] =  self::UNOCCUPIED;
                                $changes++;
                            }
                            break;
                    }
                }
            }

            $array = $aux;
        } while ($changes > 0);

        return (string)$this->countOccupied($array);
    }

    private function occupiedDiagonalBy(array $array, int $row, int $col): int
    {
        $count = 0;

        foreach (self::COORDINATES as $seat) {
            $i = $row + $seat[0];
            $j = $col + $seat[1];

            while (isset($array[$i][$j])) {
                if ($array[$i][$j] === self::OCCUPIED) {
                    $count++;
                    break;
                }
                if ($array[$i][$j] === self::UNOCCUPIED) {
                    break;
                }

                $i += $seat[0];
                $j += $seat[1];
            }
        }

        return $count;
    }

    public function exec2(array $array = []): string
    {
        $aux = $array;

        do {
            $changes = 0;
            for ($i = 0; $i < count($array); $i++) {
                for ($j = 0; $j < count($array[$i]); $j++) {
                    switch ($array[$i][$j]) {
                        case self::FLOOR:
                            break;
                        case self::UNOCCUPIED:
                            if ($this->occupiedDiagonalBy($array, $i, $j) === 0) {
                                $aux[$i][$j] =  self::OCCUPIED;
                                $changes++;
                            }
                            break;
                        case self::OCCUPIED:
                            if ($this->occupiedDiagonalBy($array, $i, $j) >= 5) {
                                $aux[$i][$j] =  self::UNOCCUPIED;
                                $changes++;
                            }
                            break;
                    }
                }
            }

            $array = $aux;
        } while ($changes > 0);

        return (string)$this->countOccupied($array);
    }
}
