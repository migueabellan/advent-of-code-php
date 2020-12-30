<?php

namespace App\Year2015\Day01;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array[] = $line;
            }
            fclose($file);
        }

        return $array;
    }
    
        
    public function exec1(array $array = []): string
    {
        $directions = current($array);

        $up = substr_count($directions, '(');
        $down = substr_count($directions, ')');
        
        return (string)($up - $down);
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        $directions = str_split(current($array));

        $floor = 0;
        foreach ($directions as $key => $character) {
            switch ($character) {
                case '(':
                    $floor++;
                    break;
                case ')':
                    $floor--;
                    break;
            }

            if (-1 === $floor) {
                $result = $key + 1;
                break;
            }
        }

        return (string)$result;
    }
}
