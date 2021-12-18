<?php

namespace App\Year2021\Day16;

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
                $arr = array_map(function (string $c): string {
                    return sprintf('%04d', base_convert($c, 16, 2));
                }, str_split(trim($line)));

                $binary = implode($arr);

                $array[] = $binary;
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $binary = $input[0];

        $packet = new Packet($binary);

        return (string)$packet->getVersionSum();
    }

    public function exec2(array $input = []): string
    {
        $binary = $input[0];

        $packet = new Packet($binary);

        return (string)$packet->getValue();
    }
}
