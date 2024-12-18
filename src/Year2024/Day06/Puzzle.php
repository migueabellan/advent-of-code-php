<?php
 
namespace App\Year2024\Day06;
 
use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
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

    
    public function init(array $input): array
    {
        for ($y = 0; $y < count($input); $y++) {
            for ($x = 0; $x < count($input); $x++) {
                if ($input[$y][$x] === Map::GUARD) {
                    return [$x, $y];
                }
            }
        }

        return [];
    }


    public function exec1(array $input = []): int
    {
        [$x, $y] = $this->init($input);

        $map = new Map($input, new Guard($x, $y));
        $map->walk();

        return $map->visited();
    }
 
    public function exec2(array $input = []): int
    {
        $result = 0;

        [$x, $y] = $this->init($input);

        $map = new Map($input, new Guard($x, $y));
        $map->walk();

        $input = $map->array();
        $input[$y][$x] = Map::GUARD;

        for ($i = 0; $i < count($input); $i++) {
            for ($j = 0; $j < count($input); $j++) {
                if ($input[$i][$j] === Map::VISITED) {
                    $aux = $input;
                    $aux[$i][$j] = Map::OBSTRUCTION;
                    
                    $map = new Map($aux, new Guard($x, $y));

                    try {
                        $map->walk();
                    } catch (\Exception $e) {
                        $result++;
                    }
                }
            }
        }

        return $result;
    }
}
