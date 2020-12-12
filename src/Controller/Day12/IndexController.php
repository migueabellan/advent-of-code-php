<?php

namespace App\Controller\Day12;

use App\Controller\AbstractController;
use stdClass;

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

    private function move(object &$board, string $dir, int $dis): void
    {
        switch ($dir) {
            case self::NORTH:
                $board->dy += $dis;
                break;
            case self::SOUTH:
                $board->dy -= $dis;
                break;
            case self::EAST:
                $board->dx += $dis;
                break;
            case self::WEST:
                $board->dx -= $dis;
                break;
        }
    }

    private function turn(object &$board, string $to, int $deg): void
    {
        $current = self::DIRS[$board->dir];

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

        $board->dir = (string)array_search($current, self::DIRS);
    }

    public function exec1(array $array = []): string
    {
        $result = 0;

        $board = new stdClass();
        $board->dir = self::EAST;
        $board->dx = 0;
        $board->dy = 0;

        foreach ($array as $action) {
            switch ($action['ins']) {
                case self::NORTH:
                case self::SOUTH:
                case self::EAST:
                case self::WEST:
                    $this->move($board, $action['ins'], $action['val']);
                    break;

                case self::FORDWARD:
                    $this->move($board, $board->dir, $action['val']);
                    break;

                case self::LEFT:
                case self::RIGHT:
                    $this->turn($board, $action['ins'], $action['val']);
                    break;
            }
        }

        $result = abs($board->dx) + abs($board->dy);

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        return (string)$result;
    }
}
