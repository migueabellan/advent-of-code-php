<?php
 
namespace App\Year2024\Day07;
 
use App\Puzzle\AbstractPuzzle;
 
class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $result = 0;
 
        foreach ($input as $line) {
            $bridge = new Bridge($line);
            if ($bridge->isValid(['+', '*'])) {
                $result += $bridge->result();
            }
        }
 
        return $result;
    }
 
    public function exec2(array $input = []): int
    {
        $result = 0;
 
        foreach ($input as $line) {
            $bridge = new Bridge($line);
            if ($bridge->isValid(['+', '*', '|'])) {
                $result += $bridge->result();
            }
        }
 
        return $result;
    }
}
