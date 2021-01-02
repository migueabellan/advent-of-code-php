<?php

namespace App\Year2015\Day03;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private const UP = '^';
    private const LEFT = '>';
    private const DOWN = 'v';
    private const RIGHT = '<';

    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array[] = str_split(trim($line));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $result = 0;

        foreach ($array as $movement) {
            $x = $y = 0;
            $grid = [];
            $grid[$x][$y] = true;
            $result++;
            foreach ($movement as $location) {
                switch ($location) {
                    case self::UP:
                        $y++;
                        break;
                    case self::LEFT:
                        $x++;
                        break;
                    case self::DOWN:
                        $y--;
                        break;
                    case self::RIGHT:
                        $x--;
                        break;
                }
                if (!isset($grid[$x][$y])) {
                    $result++;
                    $grid[$x][$y] = true;
                }
            }
        }
        
        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        
        
        return (string)$result;
    }
}
