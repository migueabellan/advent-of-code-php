<?php
 
namespace App\Year2024\Day09;
 
use App\Puzzle\AbstractPuzzle;
 
class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $id = 0;
                $position = 0;
                $blocks = [];
                for ($i = 0; $i < strlen($line); $i++) {
                    $size = (int)$line[$i];
                    if ($i % 2 === 0) {
                        for ($j = 0; $j < $size; $j++) {
                            $blocks[$position++] = $id;
                        }
                        $id++;
                    } else {
                        for ($j = 0; $j < $size; $j++) {
                            $blocks[$position++] = -1;
                        }
                    }
                }

                $array[] = $blocks;
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): int
    {
        $input = $input[0];

        $disk = new Disk($input);
        $disk->compact();
       

        return $disk->checksum();
    }
 
    public function exec2(array $input = []): int
    {
        $input = $input[0];

        $disk = new Disk($input);
        $disk->whole();
       

        return $disk->checksum();
    }
}
