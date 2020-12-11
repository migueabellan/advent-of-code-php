<?php

namespace App\Controller\Day11;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private const FLOOR = '.';
    private const OCCUPIED = '#';
    private const UNOCCUPIED = 'L';

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

    private function occupiedSeatsBy(array $array, int $row, int $col): int
    {
        $coordinates = [
            [-1, -1], [-1, +0], [-1, 1],
            [+0, -1], /*******/ [+0, 1],
            [+1, -1], [+1, +0], [+1, 1],
        ];

        $count = 0;

        foreach ($coordinates as $seat) {
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
                            if ($this->occupiedSeatsBy($array, $i, $j) === 0) {
                                $aux[$i][$j] =  self::OCCUPIED;
                                $changes++;
                            }
                            break;
                        case self::OCCUPIED:
                            if ($this->occupiedSeatsBy($array, $i, $j) >= 4) {
                                $aux[$i][$j] =  self::UNOCCUPIED;
                                $changes++;
                            }
                            break;
                    }
                }
            }

            $array = $aux;
        } while ($changes > 0);

        $result = 0;
        for ($i = 0; $i < count($array); $i++) {
            for ($j = 0; $j < count($array[$i]); $j++) {
                if ($array[$i][$j] === self::OCCUPIED) {
                    $result++;
                }
            }
        }

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        //

        return (string)$result;
    }
}
