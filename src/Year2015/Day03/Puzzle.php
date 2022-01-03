<?php

namespace App\Year2015\Day03;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array = str_split(trim($line));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): int
    {
        $grid = new Grid();
        $grid->addPresent(0, 0);

        $santa = new Person();

        foreach ($array as $location) {
            $santa->move($location);
            $grid->addPresent($santa->getX(), $santa->getY());
        }
        
        return $grid->getPresents();
    }

    public function exec2(array $array = []): int
    {
        $grid = new Grid();
        $grid->addPresent(0, 0);

        $santa = new Person();
        $elf = new Person();

        foreach ($array as $k => $location) {
            if ($k % 2 === 0) {
                $santa->move($location);
                $grid->addPresent($santa->getX(), $santa->getY());
            } else {
                $elf->move($location);
                $grid->addPresent($elf->getX(), $elf->getY());
            }
        }

        return $grid->getPresents();
    }
}
