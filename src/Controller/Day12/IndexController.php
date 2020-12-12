<?php

namespace App\Controller\Day12;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private const NORTH = 'N';
    private const SOUTH = 'S';
    private const EAST = 'E';
    private const WEST = 'W';
    private const LEFT= 'L';
    private const RIGHT = 'R';
    private const FORDWARD = 'F';

    private const DIRS = [
        self::NORTH => 0,
        self::EAST => 90,
        self::SOUTH => 180,
        self::WEST => 270,
    ];

    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match("~^(?'ins'.)(?'val'.*)$~", $line, $matches);

                $array[] = [
                    'ins' => $matches['ins'],
                    'val' => (int)$matches['val']
                ];
            }
            fclose($file);
        }
        
        return $array;
    }

    private function move(int $x, int $y, string $dir, int $dis): array
    {
        switch ($dir) {
            case self::NORTH:
                return [$x, $y + $dis];
            case self::SOUTH:
                return [$x, $y - $dis];
            case self::EAST:
                return [$x + $dis, $y];
            case self::WEST:
                return [$x - $dis, $y];
        }

        return [];
    }

    private function turn(string $dir, string $to, int $deg): string
    {
        $current = self::DIRS[$dir];

        switch ($to) {
            case self::LEFT:
                $current -= $deg;
                $current += 360;
                break;
            case self::RIGHT:
                $current += $deg;
                break;
        }

        $current %= 360;

        return (string)array_search($current, self::DIRS);
    }

    public function exec1(array $array = []): string
    {
        $result = 0;

        $dir = self::EAST;
        $x = 0;
        $y = 0;

        foreach ($array as $action) {
            switch ($action['ins']) {
                case self::NORTH:
                case self::SOUTH:
                case self::EAST:
                case self::WEST:
                    [$x, $y] = $this->move($x, $y, $action['ins'], $action['val']);
                    break;

                case self::FORDWARD:
                    [$x, $y] = $this->move($x, $y, $dir, $action['val']);
                    break;

                case self::LEFT:
                case self::RIGHT:
                    $dir = $this->turn($dir, $action['ins'], $action['val']);
                    break;
            }
        }

        $result = abs($x) + abs($y);

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        return (string)$result;
    }
}
