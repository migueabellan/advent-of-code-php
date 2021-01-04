<?php

namespace App\Year2020\Day12;

use App\Puzzle\AbstractPuzzle;
use stdClass;

class Puzzle extends AbstractPuzzle
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

    private function moveBoard(stdClass &$board, string $dir, int $dis): void
    {
        switch ($dir) {
            case self::NORTH:
                $board->dy += $dis;
                break;
            case self::EAST:
                $board->dx += $dis;
                break;
            case self::SOUTH:
                $board->dy -= $dis;
                break;
            case self::WEST:
                $board->dx -= $dis;
                break;
        }
    }

    private function turnBoard(stdClass &$board, string $to, int $deg): void
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
                case self::EAST:
                case self::SOUTH:
                case self::WEST:
                    $this->moveBoard($board, $action['ins'], $action['val']);
                    break;

                case self::FORDWARD:
                    $this->moveBoard($board, $board->dir, $action['val']);
                    break;

                case self::LEFT:
                case self::RIGHT:
                    $this->turnBoard($board, $action['ins'], $action['val']);
                    break;
            }
        }

        $result = abs($board->dx) + abs($board->dy);

        return (string)$result;
    }


    
    private function moveWaipoint(stdClass &$waypoint, string $dir, int $dis): void
    {
        switch ($dir) {
            case self::NORTH:
                $waypoint->y += $dis;
                break;
            case self::EAST:
                $waypoint->x += $dis;
                break;
            case self::SOUTH:
                $waypoint->y -= $dis;
                break;
            case self::WEST:
                $waypoint->x -= $dis;
                break;
        }
    }

    private function turnWaipoint(stdClass &$waypoint, string $to, int $deg): void
    {
        switch ($to) {
            case self::LEFT:
                $deg *= -1;
                $deg += 360;
                break;
            case self::RIGHT:
                break;
        }

        $deg %= 360;

        switch ((string)array_search($deg, self::DIRS)) {
            case self::NORTH:
                // $waypoint->x = $x;
                // $waypoint->y = $y;
                break;
            case self::EAST:
                $aux = $waypoint->x;
                $waypoint->x = $waypoint->y;
                $waypoint->y = $aux * -1;
                break;
            case self::SOUTH:
                $waypoint->x *= -1;
                $waypoint->y *= -1;
                break;
            case self::WEST:
                $aux = $waypoint->x;
                $waypoint->x = $waypoint->y * -1;
                $waypoint->y = $aux;
                break;
        }
    }

    private function moveBoardToWaypoint(stdClass &$board, stdClass &$waypoint, int $times): void
    {
        $board->dx += ($times * $waypoint->x);
        $board->dy += ($times * $waypoint->y);
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        $board = new stdClass();
        $board->dir = self::EAST;
        $board->dx = 0;
        $board->dy = 0;

        $waypoint = new stdClass();
        $waypoint->x = 10;
        $waypoint->y = 1;

        foreach ($array as $action) {
            switch ($action['ins']) {
                case self::NORTH:
                case self::EAST:
                case self::SOUTH:
                case self::WEST:
                    $this->moveWaipoint($waypoint, $action['ins'], $action['val']);
                    break;

                case self::FORDWARD:
                    $this->moveBoardToWaypoint($board, $waypoint, $action['val']);
                    break;

                case self::LEFT:
                case self::RIGHT:
                    $this->turnWaipoint($waypoint, $action['ins'], $action['val']);
                    $this->turnBoard($board, $action['ins'], $action['val']);
                    break;
            }
        }

        $result = abs($board->dx) + abs($board->dy);

        return (string)$result;
    }
}
