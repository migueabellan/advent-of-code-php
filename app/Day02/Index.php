<?php

namespace App\Day02;

class Index
{   
    private static function read(): array
    {
        $path = dirname(__FILE__).'/_in.txt';

        $file = fopen($path, "r");
        while (($line = fgets($file)) !== false) {
            [$policy, $letter, $pass] = explode(' ', $line);

            [$min, $max] = explode('-', $policy);
            $letter = str_replace(':', '', $letter);

            $array[] = [
                'min' => (int)$min,
                'max' => (int)$max,
                'letter' => $letter,
                'pass' => $pass
            ];
        }
        fclose($file);

        return $array;
    }

    private static function write(int $result): void
    {
        $out = fopen(dirname(__FILE__).'/_out.txt', 'w');
        fwrite($out, $result);
        fclose($out);
    }
        
    public function puzzle1(): void
    {       
        $array = self::read();

        $result = 0;
        foreach ($array as $case) {
            $appear = 0;
            for($i = 0; $i < strlen($case['pass']); $i++) {
                if ($case['letter'] === $case['pass'][$i]) {
                    $appear++;
                }
            }

            if ($appear >= $case['min'] && $appear <= $case['max']) {
                $result++;
            }
        }

        self::write($result);
    }

    public function puzzle2(): void
    {       
        $array = self::read();

        $result = 0;
        foreach ($array as $case) {
            $validate = 0;
            $min = $case['min'] - 1;
            $max = $case['max'] - 1;

            if ($case['letter'] === $case['pass'][$min]) {
                $validate++;
            }
            if ($case['letter'] === $case['pass'][$max]) {
                $validate++;
            }

            if ($validate === 1) {
                $result++;
            }
        }

        self::write($result);
    }
}
