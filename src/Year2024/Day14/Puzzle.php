<?php
 
namespace App\Year2024\Day14;
 
use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match("~^p=(?'p'.*) v=(?'v'.*)$~", trim($line), $matches);

                $p = array_map('intval', explode(',', $matches['p']));
                $v = array_map('intval', explode(',', $matches['v']));
                $array[] = new Robot($p[0], $p[1], $v[0], $v[1]);
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): int
    {
        $restroom = new Restroom($input);
        $restroom->elapsed(100);

        return $restroom->result();
    }
 
    public function exec2(array $input = []): int
    {
        $restroom = new Restroom($input);
        $result = $restroom->easterEgg();

        return $result;
    }
}
