<?php

namespace App\Year2021\Day12;

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
                $array[] = explode('-', trim($line));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $cave = new Cave();
        foreach ($input as $row) {
            $n1 = new Node($row[0]);
            $n2 = new Node($row[1]);
            $cave->addConnection($n1, $n2);
        }
        // $cave->print();

        return (string)count($cave->getPathsSingle());
    }

    public function exec2(array $input = []): string
    {
        $cave = new Cave();
        foreach ($input as $row) {
            $n1 = new Node($row[0]);
            $n2 = new Node($row[1]);
            $cave->addConnection($n1, $n2);
        }
        // $cave->print();

        return (string)count($cave->getPathsTwice());
    }
}
