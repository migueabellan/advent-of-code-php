<?php

namespace App\Day03;

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
            $array[] = $line;
        }

        fclose($file);

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

    public function exec1(): void
    {
        $array = $this->read();

        $result = 0;
        $right = 3;
        
        $mod = 0;
        foreach ($array as $line) {
            if ($line[$mod] === '#') {
                $result++;
            }
            $mod = ($mod = $mod + $right) % (strlen($line) - 1);
        }

        $this->write((string)$result);
    }

    public function exec2(): void
    {
        $array = $this->read();

        $cases = [
            ['right' => 1, 'bottom' => 1],
            ['right' => 3, 'bottom' => 1],
            ['right' => 5, 'bottom' => 1],
            ['right' => 7, 'bottom' => 1],
            ['right' => 1, 'bottom' => 2]
        ];
        
        $results = [];
        foreach ($cases as $c => $case) {
            $mod = 0;
            foreach ($array as $k => $line) {
                if ($k % $case['bottom'] === 0) {
                    if ($line[$mod] === '#') {
                        $results[$c]++;
                    }
                    $mod = ($mod = $mod + $case['right']) % (strlen($line) - 1);
                }
            }
        }

        $result = 1;
        foreach ($results as $v) {
            $result *= $v; 
        }

        $this->write((string)$result);
    }
}
