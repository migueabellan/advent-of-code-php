<?php
 
namespace App\Year2024\Day08;
 
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

        $width = count($input);
        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $width; $j++) {
                $frecuency = $input[$i][$j];
                if (preg_match('/[A-Za-z0-9]/', $frecuency)) {
                    $map->antinodes($i, $j, $frecuency);
                }
            }
        }
 
        return $map->result();
    }
 
    public function exec2(array $input = []): int
    {
        $map = new Map($input);

        $width = count($input);
        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $width; $j++) {
                $frecuency = $input[$i][$j];
                if (preg_match('/[A-Za-z0-9]/', $frecuency)) {
                    $map->harmonics($i, $j, $frecuency);
                }
            }
        }
 
        return $map->result();
    }
}
