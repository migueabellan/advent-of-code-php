<?php

namespace App\Year2021\Day11;

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
                $array[] = array_map('intval', str_split(trim($line)));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $carvern = new Cavern($input);

        $flashes = 0;
        for ($i = 0; $i < 100; $i++) {
            $carvern->step();
            $flashes += $carvern->getFlashes();
            // $carvern->print();
        }

        return (string)$flashes;
    }

    public function exec2(array $input = []): string
    {
        $carvern = new Cavern($input);

        $step = 0;
        do {
            $step++;
            $carvern->step();
        } while (!$carvern->isAllFlash());
        
        return (string)$step;
    }
}
