<?php

namespace App\Year2021\Day03;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $cols = str_split(trim($line), 1);
                foreach ($cols as $k => $col) {
                    $cols[$k] = intval($cols[$k]);
                }

                $array[] = $cols;
            }
            fclose($file);
        }

        return $array;
    }

    private function getCommonBit(array $array, int $column): int
    {
        $sum = array_sum(array_column($array, $column));
        
        return intval($sum >= count($array) / 2);
    }

    private function getCommonArray(array $array, int $column, int $more): array
    {
        if ($this->getCommonBit($array, $column)) {
            return array_filter($array, function ($el) use ($column, $more) {
                return $el[$column] === $more;
            });
        } else {
            return array_filter($array, function ($el) use ($column, $more) {
                return $el[$column] !== $more;
            });
        }
    }

    public function exec1(array $input = []): string
    {
        $gamma_rate = '';
        $epsilon_rate = '';

        for ($i = 0; $i < count($input[0]); $i++) {
            $common_bit = $this->getCommonBit($input, $i);

            $gamma_rate .= (string)$common_bit;
            $epsilon_rate .= (string)($common_bit ? 0 : 1);
        }

        $gamma = bindec($gamma_rate);
        $epsilon = bindec($epsilon_rate);

        return (string)($gamma * $epsilon);
    }

    public function exec2(array $input = []): string
    {
        $i = 0;
        $aux = $input;
        do {
            $aux = $this->getCommonArray($aux, $i++, 1);
        } while (count($aux) > 1);

        $oxygen_rating = bindec(implode('', array_shift($aux)));
        

        $i = 0;
        $aux = $input;
        do {
            $aux = $this->getCommonArray($aux, $i++, 0);
        } while (count($aux) > 1);
        

        $co2_rating = bindec(implode('', array_shift($aux)));
        

        return (string)($oxygen_rating * $co2_rating);
    }
}
