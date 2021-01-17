<?php

namespace App\Year2015\Day16;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    const TICKER = [
        'children' => 3,
        'cats' => 7,
        'samoyeds' => 2,
        'pomeranians' => 3,
        'akitas' => 0,
        'vizslas' => 0,
        'goldfish' => 5,
        'trees' => 3,
        'cars' => 2,
        'perfumes' => 1,
    ];

    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match('/Sue (\d+): (.*)/', $line, $matches);
                $sue = $matches[1];
                $instructions = explode(', ', $matches[2]);
                foreach ($instructions as $instruction) {
                    list($inst, $qty) = explode(': ', $instruction);
                    $array[$sue][$inst] = (int)$qty;
                }
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $result = 0;

        foreach ($array as $sue_id => $instructions) {
            $intersect = array_intersect_assoc(self::TICKER, $instructions);
            if (count($intersect) === count($instructions)) {
                $result = $sue_id;
                break;
            }
        }

        return (string)$result;
    }

    private function arrayIntersectAssocRange(array $ticker, array $instructions): array
    {
        $intersect = [];

        foreach ($instructions as $inst => $qty) {
            switch ($inst) {
                case 'cats':
                case 'trees':
                    if ($qty > $ticker[$inst]) {
                        $intersect[$inst] = $qty;
                    }
                    break;
                case 'pomeranians':
                case 'goldfish':
                    if ($qty < $ticker[$inst]) {
                        $intersect[$inst] = $qty;
                    }
                    break;
                default:
                    if ($qty === $ticker[$inst]) {
                        $intersect[$inst] = $qty;
                    }
            }
        }

        return $intersect;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        foreach ($array as $sue_id => $instructions) {
            $intersect = $this->arrayIntersectAssocRange(self::TICKER, $instructions);
            if (count($intersect) === count($instructions)) {
                $result = $sue_id;
                break;
            }
        }

        return (string)$result;
    }
}
