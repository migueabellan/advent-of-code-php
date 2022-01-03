<?php

namespace App\Year2019\Day02;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    private const OUTPUT = 19690720;

    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array = array_map('intval', explode(',', trim($line)));
            }
            fclose($file);
        }

        return $array;
    }

    private function processing(array $data): array
    {
        $i = 0;

        while ($data[$i] !== 99) {
            switch ($data[$i]) {
                case 1:
                    $pos_1 = $data[$i + 1];
                    $pos_2 = $data[$i + 2];
                    $pos_3 = $data[$i + 3];
                    $data[$pos_3] = $data[$pos_1] + $data[$pos_2];
                    break;
                case 2:
                    $pos_1 = $data[$i + 1];
                    $pos_2 = $data[$i + 2];
                    $pos_3 = $data[$i + 3];
                    $data[$pos_3] = $data[$pos_1] * $data[$pos_2];
                    break;
            }
            $i += 4;
        }

        return $data;
    }

    public function exec1(array $input = []): int
    {
        $input[1] = 12;
        $input[2] = 2;

        $data = $this->processing($input);

        return $data[0];
    }

    public function exec2(array $input = []): int
    {
        $result = 0;

        $length = count($input);

        for ($noun = 0; $noun < $length; $noun++) {
            for ($verb = 0; $verb < $length; $verb++) {
                $input[1] = $noun;
                $input[2] = $verb;

                $data = $this->processing($input);

                if ($data[0] === self::OUTPUT) {
                    $result = 100 * $noun + $verb;
                }
            }
        }

        return $result;
    }
}
