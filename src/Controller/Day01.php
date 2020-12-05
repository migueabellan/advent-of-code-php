<?php

namespace App\Controller;

use App\AbstractController;

class Day01 extends AbstractController
{   
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $file = fopen($this->getPathIn(), "r");

        while (($line = fgets($file)) !== false) {
            $array[] = (int)$line;
        }
        fclose($file);
        
        sort($array);

        return $array;
    }
        
    public function exec1(array $array = []): string
    {       
        $result = [];    
        for($i = 0; $i < count($array); $i++) {
            for($j = $i + 1; $j < count($array); $j++) {
                if ($array[$i] + $array[$j] === 2020) {
                    $result = $array[$i] * $array[$j];
                }
            }
        }

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {       
        $result = [];
        $i = 0;
        do {
            $one = $array[$i];
            $j = $i + 1;
            do {
                $two = $array[$i] + $array[$j];
                $k = $j + 1;
                do {
                    $three = $array[$i] + $array[$j] + $array[$k];
                    if ($three === 2020) {
                        $result = $array[$i] * $array[$j] * $array[$k];
                    }
                } while($k++ && $three < 2020 && $k < count($array) - 1);
            } while($j++ && $two < 2020 && $j < count($array) - 1);
        } while($i++ && $one < 2020 && $i < count($array) - 1);

        return (string)$result;
    }
}
