<?php
 
namespace App\Year2024\Day03;
 
use App\Puzzle\AbstractPuzzle;
 
class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];
 
        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match_all('/mul\(\d+,\d+\)|do\(\)|don\'t\(\)/', $line, $matches, PREG_SET_ORDER);
 
                $enabled = true;
                foreach ($matches as $match) {
                    if ($match[0] === 'do()') {
                        $enabled = true;
                    } elseif ($match[0] === "don't()") {               
                        $enabled = false;
                    } elseif ($enabled) {
                        $array[] = $match[0];
                    }
                }

                // preg_match_all('/mul\(\d+,\d+\)/', $line, $matches, PREG_SET_ORDER);
                // foreach ($matches as $match) {
                //     $array[] = $match[0];
                // }
            }
            fclose($file);
        }
  
        return $array;
    }
 
    public function exec1(array $input = []): int
    {
        $result = 0;
 
        foreach ($input as $instruction) {
            preg_match('/mul\((?<x>\d+),(?<y>\d+)\)/', $instruction, $matches);
            $result += ($matches['x'] * $matches['y']);
        }
 
        return $result;
    }
 
    public function exec2(array $input = []): int
    {
        $result = 0;

        foreach ($input as $instruction) {
            preg_match('/mul\((?<x>\d+),(?<y>\d+)\)/', $instruction, $matches);
            $result += ($matches['x'] * $matches['y']);
        }
 
        return $result;
    }
}
 