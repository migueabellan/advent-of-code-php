<?php

namespace App\Year2020\Day18;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array[] = trim($line);
            }
            fclose($file);
        }

        return $array;
    }

    private function calculate(string $exp, string $precedence): int
    {
        $exp = '('.$exp.')';

        while (preg_match('/\(([^()]+)\)/', $exp, $inner)) {
            while (preg_match("/\d+ [$precedence] \d+/", $inner[1], $single)) {
                $inner[1] = preg_replace('/'.preg_quote($single[0]).'/', eval('return '.$single[0].';'), $inner[1], 1);
            }
            $exp = str_replace($inner[0], eval('return '.$inner[1].';'), $exp);
        }

        return (int)$exp;
    }

    public function exec1(array $array = []): string
    {
        $result = 0;

        foreach ($array as $exp) {
            $result += $this->calculate($exp, '+*');
        }

        return (string)$result;
    }
    

    public function exec2(array $array = []): string
    {
        $result = 0;

        foreach ($array as $exp) {
            $result += $this->calculate($exp, '+');
        }

        return (string)$result;
    }
}
