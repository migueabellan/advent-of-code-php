<?php

namespace App\Year2020\Day24;

use App\Puzzle\AbstractPuzzle;

class IndexController extends AbstractPuzzle
{
    private const N     = 'n';
    private const NE    = 'ne';
    private const E     = 'e';
    private const SE    = 'se';
    private const S     = 's';
    private const SW    = 'sw';
    private const W     = 'w';
    private const NW    = 'nw';

    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                $array[] = $line;
            }
            fclose($file);
        }

        return $array;
    }


    private function findTile(array $direction, int $x = 0, int $y = 0): array
    {
        foreach ($direction as $point) {
            switch ($point) {
                case self::NW:
                    if (abs($y % 2) === 0) {
                        $x -= 1;
                    }
                    $y -= 1;
                    break;
                case self::NE:
                    if (abs($y % 2) === 1) {
                        $x += 1;
                    }
                    $y -= 1;
                    break;
                case self::SW:
                    if (abs($y % 2) === 0) {
                        $x -= 1;
                    }
                    $y += 1;
                    break;
                case self::SE:
                    if (abs($y % 2) === 1) {
                        $x += 1;
                    }
                    $y += 1;
                    break;
                case self::W:
                    $x -= 1;
                    break;
                case self::E:
                    $x += 1;
                    break;
            }
        }
        return [$x, $y];
    }

    private function getInitialFloor(array $input): array
    {
        $directions = [];
        while (!empty($input)) {
            $line = trim(array_shift($input));
            if (!$line) {
                continue;
            }
            $direction = [];
            $line = str_split($line);
            while (!empty($line)) {
                $point = array_shift($line);
                if ($point === self::N || $point === self::S) {
                    $point .= array_shift($line);
                }
                $direction[] = $point;
            }
            $directions[] = $direction;
        }
        $floor = [];
        foreach ($directions as $direction) {
            list($x, $y) = $this->findTile($direction);
            if (!isset($floor[$y])) {
                $floor[$y] = [];
            }
            if (!isset($floor[$y][$x])) {
                $floor[$y][$x] = true;
            } else {
                $floor[$y][$x] = !$floor[$y][$x];
            }
        }
        return $floor;
    }

    private function countTiles(array $floor): int
    {
        return array_reduce($floor, function ($sum, $row) {
            return $sum + count(array_filter($row));
        }, 0);
    }

    public function exec1(array $array = []): string
    {
        $result = $this->getInitialFloor($array);

        return (string)$this->countTiles($result);
    }


    private function countTilesAfterXDays(array $input, int $days): int
    {
        $floor = $this->getInitialFloor($input);
        for ($i = 1; $i <= $days; $i++) {
            ksort($floor);
            $lowestRow = (int)min(array_keys($floor));
            $highestRow = (int)max(array_keys($floor));
            $lowestCol = (int)array_reduce($floor, function ($lowest, $row) {
                if (min(array_keys($row)) < $lowest) {
                    return min(array_keys($row));
                }
                return $lowest;
            }, 0);
            $highestCol = (int)array_reduce($floor, function ($highest, $row) {
                if (max(array_keys($row)) > $highest) {
                    return max(array_keys($row));
                }
                return $highest;
            }, 0);
            $newFloor = $floor;
            for ($y = ($lowestRow - 1); $y <= ($highestRow + 1); $y++) {
                for ($x = ($lowestCol - 1); $x <= ($highestCol + 1); $x++) {
                    $current = $floor[$y][$x] ?? false;
                    $blackNeighbours = $this->countNeighbours($floor, $x, $y);
                    $new = $current;
                    if ($current && ($blackNeighbours === 0 || $blackNeighbours > 2)) {
                        $new = false;
                    } elseif (!$current && $blackNeighbours === 2) {
                        $new = true;
                    }
                    if (!isset($newFloor[$y])) {
                        $newFloor[$y] = [];
                    }
                    $newFloor[$y][$x] = $new;
                }
            }
            $floor = $newFloor;
        }

        return $this->countTiles($floor);
    }

    private function countNeighbours(array $floor, int $x, int $y): int
    {
        $neighbours = [self::NW, self::NE, self::E, self::SE, self::SW, self::W];
        $count = 0;
        foreach ($neighbours as $neighbour) {
            list($neighbourX, $neighbourY) = $this->findTile([$neighbour], $x, $y);
            if (isset($floor[$neighbourY][$neighbourX]) && $floor[$neighbourY][$neighbourX]) {
                $count++;
            }
        }

        return $count;
    }

    public function exec2(array $array = []): string
    {
        $result = $this->countTilesAfterXDays($array, 100);
        
        return (string)$result;
    }
}
