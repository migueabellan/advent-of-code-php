<?php
 
namespace App\Year2024\Day12;
 
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
        $garden = new Garden($input);
        $garden->groups();

        return $garden->price();
    }
 
    public function exec2(array $input = []): int
    {
        $garden = new Garden($input);
        $garden->groups();
        $garden->sides();
        $garden->print();

        return $garden->sides();
    }
}
