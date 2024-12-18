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

    private function permutations(int $length, array $operators): array
    {
        $permutations = [];

        for ($i = 0; $i < pow(count($operators), $length); $i++) {
            $converted = base_convert($i, 10, count($operators));
            $str = str_pad($converted, $length, '0', STR_PAD_LEFT);

            $permutations[] = str_split(str_replace(range(0, count($operators)), $operators, $str));
        }

        return $permutations;
    }

    private function eval(array $operation): int
    {
        $result = $operation[0];

        for ($i = 1; $i < count($operation); $i+=2) {
            if ($operation[$i] === '+') {
                $result += intval($operation[$i + 1]);
            } else {
                $result *= intval($operation[$i + 1]);
            }
        }

        return $result;
    }

    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input as $line) {
            $permutations = $this->permutations(count($line['numbers']) - 1, ['+', '*']);

            foreach ($permutations as $permutation) {
                $equation = [];
                foreach ($line['numbers'] as $k => $number) {
                    $equation[] = $number;
                    if (isset($permutation[$k])) {
                        $equation[] = $permutation[$k];
                    }
                }

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
        $result = 0;

        return $result;
    }
}
