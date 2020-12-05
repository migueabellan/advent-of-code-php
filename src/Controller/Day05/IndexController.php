<?php

namespace App\Controller\Day05;

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
                // $binary = preg_replace(['/F|L/', '/B|R/'], [0, 1], $line);
                $binary = strtr($line, 'FBLR', '0101');
                $decimal = bindec($binary);

                $array[$decimal] = $decimal;
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $result = max($array);

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        $array_complete = range(min($array), max($array));

        $result = current((array_diff($array_complete, $array)));

        /*
        for ($i = min($array); $i < max($array); $i++) {
            if (!isset($array[$i])) {
                $result = $array[$i - 1] + 1;
                break;
            }
        }
        */

        return (string)$result;
    }
}
