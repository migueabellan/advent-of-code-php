<?php

namespace App\Year2022\Day04;

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
                $elfs = explode(',', trim($line));
                $array[] = array_map(static function (string $pair): array {
                    [$from, $to] = explode('-', $pair);
                    return range($from, $to);
                }, $elfs);
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input as $elfs) {
            $common = array_values(array_intersect($elfs[0], $elfs[1]));
            if ($common === $elfs[0] || $common === $elfs[1]) {
                $result++;
            }
        }

        return $result;
    }

    public function exec2(array $input = []): int
    {
        $result = 0;

        foreach ($input as $elfs) {
            $common = array_values(array_intersect($elfs[0], $elfs[1]));
            if (count($common) > 0) {
                $result++;
            }
        }

        return $result;
    }
}
