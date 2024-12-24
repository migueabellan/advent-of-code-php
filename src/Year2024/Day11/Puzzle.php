<?php
 
namespace App\Year2024\Day11;
 
use App\Puzzle\AbstractPuzzle;
 
class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array = array_map('intval', explode(' ', $line));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): int
    {
        $plutonian = new Plutonian($input);

        for ($i = 0; $i < 25; $i++) {
            $plutonian->blink();
        }

        return $plutonian->result();
    }
 
    public function exec2(array $input = []): int
    {
        $plutonian = new Plutonian($input);

        for ($i = 0; $i < 75; $i++) {
            $plutonian->blink();
        }

        return $plutonian->result();
    }
}
