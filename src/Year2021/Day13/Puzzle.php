<?php

namespace App\Year2021\Day13;

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
                if (str_starts_with($line, 'fold')) {
                    preg_match("~^fold along (?'fold'.*)=(?'value'.*)$~", trim($line), $matches);
                    $array['instructions'][] = [
                        'fold' => $matches['fold'],
                        'value' => $matches['value']
                    ];
                }
                if (str_contains($line, ',')) {
                    preg_match("~^(?'x'.*),(?'y'.*)$~", trim($line), $matches);
                    $array['points'][] = [
                        'x' => $matches['x'],
                        'y' => $matches['y']
                    ];
                }
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $paper = new Paper($input['points']);

        $paper->fold($input['instructions'][0]);

        return (string)$paper->calc();
    }

    public function exec2(array $input = []): string
    {
        $paper = new Paper($input['points']);

        foreach ($input['instructions'] as $instruction) {
            $paper->fold($instruction);
        }

        // $paper->print();

        return (string)$paper->calc();
    }
}
