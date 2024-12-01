<?php

namespace App\Year2024\Day01;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array['left'] = [];
        $array['right'] = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match('/(\d+)   (\d+)/', $line, $matches);

                $array['left'][] = intval($matches[1]);
                $array['right'][] = intval($matches[2]);
            }
            fclose($file);
        }

        sort($array['left']);
        sort($array['right']);

        return $array;
    }

    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input['left'] as $k => $v) {
            $result += intval(abs($v - $input['right'][$k]));
        }

        return $result;
    }

    public function exec2(array $input = []): int
    {
        $result = 0;

        $rigth = array_count_values($input['right']);

        foreach ($input['left'] as $v) {
            $result += $v * ($rigth[$v] ?? 0);
        }

        return $result;
    }
}
