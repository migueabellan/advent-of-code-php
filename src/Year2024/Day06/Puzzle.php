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

    public function exec1(array $input = []): int
    {
        $map = new Map($input);

        $map->move();

        return $map->visited();
    }
 
    public function exec2(array $input = []): int
    {
        $result = 0;

        // $map = new Map($input);
        // $map->move();
        // $input = $map->array;

        // print_r($input); die;

        for ($i = 0; $i < count($input); $i++) {
            for ($j = 0; $j < count($input); $j++) {
                if ($input[$i][$j] === '.') {
                    $aux = $input;
                    $aux[$i][$j] = '#';

                    $map = new Map($aux);
                    if (!$map->move()) {
                        $result++;
                    }
                }
            }
        }

        return $result;
    }
}
