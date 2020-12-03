<?php

namespace App\Day01;

use App\AbstractController;
use App\InterfaceController;

class Index extends AbstractController implements InterfaceController
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

    /**
     * @see AbstractController
     */
    public function write(string $string): void
    {
        $out = fopen($this->getPathOut(), 'w');

        fwrite($out, $string);
        
        fclose($out);
    }
        
    public function execFor(): void
    {       
        $array = $this->read();

        $result = [];    
        for($i = 0; $i < count($array); $i++) {
            for($j = $i + 1; $j < count($array); $j++) {
                for($k = $j + 1; $k < count($array); $k++) {
                    if ($array[$i] + $array[$j] + $array[$k] === 2020) {
                        $result = $array[$i] * $array[$j] * $array[$k];
                    }
                }
            }
        }

        $this->write((string)$result);
    }

    public function execWhile(): void
    {       
        $array = $this->read();

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

        $this->write((string)$result);
    }
}
