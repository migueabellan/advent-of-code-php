<?php
 
namespace App\Year2024\Day02;
 
use App\Puzzle\AbstractPuzzle;
 
class Puzzle extends AbstractPuzzle
{
    private function isSafe(array $row): bool
    {
        $differences = [];
        for ($i = 0; $i < count($row) - 1; $i++) {
            $differences[] = $row[$i] - $row[$i + 1];
        }
 
        $min = min($differences);
        $max = max($differences);
 
        if (($min >= 1 && $max <= 3) || ($min >= -3 && $max <= -1)) {
            return true;
        }
 
        return false;
    }
 
    private function isAnySafe(array $row): bool
    {
        for ($i = 0; $i < count($row); $i++) {
            $_row = $row;
            array_splice($_row, $i, 1);
 
            if ($this->isSafe($_row)) {
                return true;
            }
        }
 
        return false;
    }
 
    public function exec1(array $input = []): int
    {
        $result = 0;
 
        foreach ($input as $row) {
            if ($this->isSafe(explode(' ', $row))) {
                $result++;
            }
        }
 
        return $result;
    }
 
    public function exec2(array $input = []): int
    {
        $result = 0;
 
        foreach ($input as $row) {
            if ($this->isSafe(explode(' ', $row))) {
                $result++;
            } elseif ($this->isAnySafe(explode(' ', $row))) {
                $result++;
            }
        }
 
        return $result;
    }
}
