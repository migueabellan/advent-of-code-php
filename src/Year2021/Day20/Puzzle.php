<?php

namespace App\Year2021\Day20;

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
            if (($line = fgets($file)) !== false) {
                $array['algorithm'] = trim($line);
            }
            while (($line = fgets($file)) !== false) {
                if (trim($line)) {
                    $array['input'][] = str_split(trim($line));
                }
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $algorithm = $input['algorithm'];
        $input = $input['input'];

        $image = new Image($algorithm, $input);
        $image->enhancement(2);

        return (string)$image->calc();
    }

    public function exec2(array $input = []): string
    {
        $algorithm = $input['algorithm'];
        $input = $input['input'];

        $image = new Image($algorithm, $input);
        $image->enhancement(50);

        return (string)$image->calc();
    }
}
