<?php

namespace App\Year2016\Day01;

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
                $array = array_map(function ($el) {
                    preg_match("/([LR])(\d+)/", $el, $match);
                    return [
                        'turn' => $match[1],
                        'steps' => intval($match[2])
                    ];
                }, explode(', ', trim($line)));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $taxicab = new Taxicab();

        foreach ($input as $instruction) {
            $taxicab->move($instruction['turn'], $instruction['steps']);
        }

        return (string)$taxicab->length();
    }

    public function exec2(array $input = []): string
    {
        $taxicab = new Taxicab();

        foreach ($input as $instruction) {
            $taxicab->move($instruction['turn'], $instruction['steps']);
        }

        return (string)$taxicab->length(true);
    }
}
