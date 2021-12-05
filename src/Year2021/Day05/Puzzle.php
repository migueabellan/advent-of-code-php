<?php

namespace App\Year2021\Day05;

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
                preg_match("~^(?'ini'.*) -> (?'end'.*)$~", trim($line), $matches);

                $ini = new Point(
                    intval(explode(',', $matches['ini'])[0]),
                    intval(explode(',', $matches['ini'])[1]),
                );
                $end = new Point(
                    intval(explode(',', $matches['end'])[0]),
                    intval(explode(',', $matches['end'])[1]),
                );

                $array[] = new Line($ini, $end);
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $hydrothermal = new Hydrothermal();
        foreach ($input as $line) {
            if ($line->isHorizontal() || $line->isVertical()) {
                $hydrothermal->add($line);
            }
        }

        return (string)$hydrothermal->calc();
    }

    public function exec2(array $input = []): string
    {
        $hydrothermal = new Hydrothermal();
        foreach ($input as $line) {
            if ($line->isHorizontal() || $line->isVertical() || $line->isDiagonal()) {
                $hydrothermal->add($line);
            }
        }

        return (string)$hydrothermal->calc();
    }
}
