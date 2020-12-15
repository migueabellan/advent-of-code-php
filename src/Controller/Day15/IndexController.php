<?php

namespace App\Controller\Day15;

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
                $array = explode(',', $line);
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $array[count($array)] = 0;

        for ($i = count($array); $i < 2020; $i++) {
            $aux = 0;
            for ($j = $i - 2; $j >= 0; $j--) {
                if ($array[$i - 1] == $array[$j]) {
                    $aux = $i - $j - 1;
                    break;
                }
            }
            $array[$i] = $aux;
        }

        return (string)end($array);
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        //

        return (string)$result;
    }
}
