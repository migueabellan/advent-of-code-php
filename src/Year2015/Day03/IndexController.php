<?php

namespace App\Year2015\Day03;

use App\Controller\AbstractController;
use App\Utils\Grid;

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
            $result++;
            $grid = new Grid();
            $grid->setFill(0, 0, true);
            foreach ($movement as $location) {
                switch ($location) {
                    case self::UP:
                        $grid->move(Grid::NORTH);
                        break;
                    case self::LEFT:
                        $grid->move(Grid::EAST);
                        break;
                    case self::DOWN:
                        $grid->move(Grid::SOUTH);
                        break;
                    case self::RIGHT:
                        $grid->move(Grid::WEST);
                        break;
                }
                if (!$grid->getFill($grid->getX(), $grid->getY())) {
                    $grid->setFill($grid->getX(), $grid->getY(), true);
                    $result++;
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
