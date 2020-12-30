<?php

namespace App\Year2020\Day15;

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

    private function game(array $array, int $turns): int
    {
        $said = array_flip($array);
        $result = end($array);

        $array[count($array)] = 0;
                
        for ($i = count($array); $i <= $turns; $i++) {
            if (array_key_exists($result, $said)) {
                $aux = $i - 2 - $said[$result];
                $said[$result] = $i - 2;
                $result = $aux;
            } else {
                $said[$result] = $i - 2;
                $result = 0;
            }
        }

        return $result;
    }

    public function exec1(array $array = []): string
    {
        return (string)$this->game($array, 2020);
    }

    public function exec2(array $array = []): string
    {
        ini_set('memory_limit', '-1');

        return (string)$this->game($array, 30000000);
    }
}
