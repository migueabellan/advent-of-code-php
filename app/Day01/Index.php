<?php

namespace App\Day01;

class Index
{   
    private static function read(): array
    {
        $path = dirname(__FILE__).'/_in.txt';

        $file = fopen($path, "r");
        while (($line = fgets($file)) !== false) {
            $array[] = (int)$line;
        }
        fclose($file);
        
        sort($array);

        return $array;
    }

    private static function write(array $array): void
    {
        $out = fopen(dirname(__FILE__).'/_out.txt', 'w');
        foreach ($array as $value) {
            fwrite($out, $value."\n");
        }
        fclose($out);
    }
        
    public function withFor(): void
    {       
        $array = self::read();

        $result = [];    
        for($i = 0; $i < count($array); $i++) {
            for($j = $i + 1; $j < count($array); $j++) {
                for($k = $j + 1; $k < count($array); $k++) {
                    if ($array[$i] + $array[$j] + $array[$k] === 2020) {
                        $result[] = $array[$i] * $array[$j] * $array[$k];
                    }
                }
            }
        }

        self::write($result);
    }

    public function withDoWhile(): void
    {       
        $array = self::read();

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
                        $result[] = $array[$i] * $array[$j] * $array[$k];
                    }
                } while($k++ && $three < 2020 && $k < count($array) - 1);
            } while($j++ && $two < 2020 && $j < count($array) - 1);
        } while($i++ && $one < 2020 && $i < count($array) - 1);

        self::write($result);
    }
}
