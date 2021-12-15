<?php

namespace App\Year2021\Day15;

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
        $cavern = new Cavern($input);

        $cavern->run();

        return (string)$cavern->getRisk();
    }

    public function exec2(array $input = []): string
    {
        $cavern = new Cavern($input);
        
        $cavern->mirror();

        $cavern->run();

        return (string)$cavern->getRisk();
    }
}
