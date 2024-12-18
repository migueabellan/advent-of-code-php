<?php
 
namespace App\Year2024\Day07;
 
use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                [$result, $numbers] = explode(':', $line);

                $numbers = array_map('intval', explode(' ', trim($numbers)));

                $array[] = [
                    'result' => intval($result),
                    'numbers' => $numbers
                ];
            }
            fclose($file);
        }

        return $array;
    }

    private function equations(array $numbers, array $operators): array
    {
        $length = count($numbers) - 1;

        $equations = [];

        for ($i = 0; $i < pow(count($operators), $length); $i++) {
            $converted = base_convert((string)$i, 10, count($operators));
            $str = str_pad($converted, $length, '0', STR_PAD_LEFT);

            $permutation = str_split(str_replace(range(0, count($operators)), $operators, $str));

            $equation = [];
            foreach ($numbers as $k => $number) {
                $equation[] = $number;
                if (isset($permutation[$k])) {
                    $equation[] = $permutation[$k];
                }
            }

            $equations[] = $equation;
        }


        return $equations;
    }

    private function eval(array $equation): int
    {
        $result = $equation[0];

        for ($i = 1; $i < count($equation); $i+=2) {
            if ($equation[$i] === '+') {
                $result += intval($equation[$i + 1]);
            } elseif ($equation[$i] === '*') {
                $result *= intval($equation[$i + 1]);
            }
        }

        return $result;
    }

    /*
    private function concatenate(array $equation): array
    {
        // print_r($equation);

        for ($i = 1; $i < count($equation); $i+=2) {
            if ($equation[$i] === '|') {
                $equation[$i] = intval($equation[$i - 1].$equation[$i + 1]);
                unset($equation[$i - 1]);
                unset($equation[$i + 1]);
            }
        }

        // print_r($equation); die;

        return array_values($equation);
    }
    */

    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input as $line) {
            $equations = $this->equations($line['numbers'], ['+', '*']);
            foreach ($equations as $equation) {
                if ($this->eval($equation) === $line['result']) {
                    $result += $line['result'];
                    break;
                }
            }
        }

        return $result;
    }
 
    public function exec2(array $input = []): int
    {
        // ini_set('memory_limit', '-1');

        $result = 0;

        /*
        foreach ($input as $line) {
            $equations = $this->equations($line['numbers'], ['+', '*', '|']);

            // $equation = $this->concatenate($equations[6]);
            // print_r($equation); die;


            foreach ($equations as $equation) {
                $equation = $this->concatenate($equation);
                if ($this->eval($equation) === $line['result']) {
                    $result += $line['result'];
                    break;
                }
            }
        }

        // tolow: 5837989715841
        */

        return $result;
    }
}
