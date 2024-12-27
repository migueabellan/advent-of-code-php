<?php
 
namespace App\Year2024\Day13;
 
use App\Puzzle\AbstractPuzzle;
 
class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match("~^Button A: X+(?'x'.*), Y+(?'y'.*)$~", trim($line), $matches);
                $a = new Button(intval($matches['x']), intval($matches['y']), 3);
                $line = fgets($file);

                preg_match("~^Button B: X+(?'x'.*), Y+(?'y'.*)$~", (string)$line, $matches);
                $b = new Button(intval($matches['x']), intval($matches['y']), 1);
                $line = fgets($file);

                preg_match("~^Prize: X=(?'x'.*), Y=(?'y'.*)$~", (string)$line, $matches);
                $p = new Prize(intval($matches['x']), intval($matches['y']));
                $line = fgets($file);

                $array[] = [
                    'a' => $a,
                    'b' => $b,
                    'p' => $p,
                ];
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input as $machine) {
            $claw = new Claw($machine['a'], $machine['b'], $machine['p']);
            $result += $claw->cramer();
        }

        return $result;
    }
 
    public function exec2(array $input = []): int
    {
        $result = 0;

        // https://es.wikipedia.org/wiki/Regla_de_Cramer

        foreach ($input as $machine) {
            $prize = new Prize($machine['p']->x + 10000000000000, $machine['p']->y + 10000000000000);
            $claw = new Claw($machine['a'], $machine['b'], $prize);
            $result += $claw->cramer();
        }

        return $result;
    }
}
