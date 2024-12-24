<?php
 
namespace App\Year2024\Day10;
 
use App\Puzzle\AbstractPuzzle;
 
class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array[] = array_map(fn ($el) => $el === '.' ? -1 : intval($el), str_split($line));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): int
    {
        $map = new Map($input);
        $routes = $map->routes();


        $trailheads = [];
        foreach ($routes as $route) {
            $reset = reset($route);
            $end = end($route);
            $trailheads[sprintf('%s-%s', $reset, $end)] = true;
        }

        return count($trailheads);
    }
 
    public function exec2(array $input = []): int
    {
        $map = new Map($input);
        $routes = $map->routes();

        return count($routes);
    }
}
