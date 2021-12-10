<?php

namespace App\Year2021\Day10;

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
                $array[] = array_map('strval', str_split(trim($line)));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $result = 0;

        foreach ($input as $line) {
            $checker = new Syntax($line);
            $result += $checker->checker();
        }

        return (string)$result;
    }

    public function exec2(array $input = []): string
    {
        $incompletes = [];
        foreach ($input as $line) {
            $checker = new Syntax($line);
            if (0 === $checker->checker()) {
                $incompletes[] = $line;
            }
        }

        $result = [];
        foreach ($incompletes as $line) {
            $checker = new Syntax($line);
            $result[] = $checker->missing();
        }

        sort($result);

        return (string)$result[count($result) / 2];
    }
}
