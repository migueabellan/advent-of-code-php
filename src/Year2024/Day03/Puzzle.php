<?php
 
namespace App\Year2024\Day03;
 
use App\Puzzle\AbstractPuzzle;
 
class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $result = 0;
 
        foreach ($input as $line) {
            preg_match_all('/mul\(\d+,\d+\)/', $line, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                preg_match('/mul\((?<x>\d+),(?<y>\d+)\)/', $match[0], $m);
                $result += ($m['x'] * $m['y']);
            }
        }
 
        return $result;
    }
 
    public function exec2(array $input = []): int
    {
        $result = 0;

        foreach ($input as $line) {
            preg_match_all('/mul\(\d+,\d+\)|do\(\)|don\'t\(\)/', $line, $matches, PREG_SET_ORDER);

            $enabled = true;
            foreach ($matches as $match) {
                if ($match[0] === 'do()') {
                    $enabled = true;
                } elseif ($match[0] === "don't()") {
                    $enabled = false;
                } elseif ($enabled) {
                    preg_match('/mul\((?<x>\d+),(?<y>\d+)\)/', $match[0], $m);
                    $result += ($m['x'] * $m['y']);
                }
            }
        }

        return $result;
    }
}
