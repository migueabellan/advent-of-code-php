<?php

namespace App\Day02;

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
        
    public function exec1(): void
    {       
        $array = $this->read();

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

        $this->write((string)$result);
    }

    public function exec2(): void
    {       
        $array = $this->read();

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

        $this->write((string)$result);
    }
}
