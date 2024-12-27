<?php
 
namespace App\Year2023\Day01;
 
final class Trebuchet
{
    public function __construct(private string $str)
    {
    }

    public function clean(): void
    {
        $mappings = [
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
            'five' => 5,
            'six' => 6,
            'seven' => 7,
            'eight' => 8,
            'nine' => 9
        ];

        foreach ($mappings as $k => $n) {
            // eightwo -> e8tt2o -> 82
            $this->str = str_replace($k, substr($k, 0, 1) . $n . substr($k, -1, 1), $this->str);
        }
    }

    public function calibration(): int
    {
        $numbers = preg_replace('/[a-z]/', '', $this->str);

        return intval(substr($numbers, 0, 1) . substr($numbers, -1, 1));
    }
}
