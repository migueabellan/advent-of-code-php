<?php

namespace App\Year2020\Day23;

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
                $line = trim($line);
                $array = str_split($line);
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $cups = array_map('intval', $array);

        $max = max($cups);
        $min = min($cups);

        for ($i = 0; $i < 100; $i++) {
            $current = $destination = array_shift($cups);
            $pickups = array_splice($cups, 0, 3);

            do {
                $destination--;
                if ($destination < $min) {
                    $destination = $max;
                }
                $destination_key = array_search($destination, $cups);
            } while ($destination_key === false);

            array_splice($cups, (int)$destination_key + 1, 0, $pickups);

            $cups[] = $current;
        }

        $one = (int)array_search(1, $cups);

        $result = implode('', array_slice($cups, $one + 1)) . implode('', array_slice($cups, 0, $one));

        return $result;
    }

    public function exec2(array $array = []): string
    {
        ini_set('memory_limit', '-1');

        $cups = array_map('intval', $array);

        $nextCups_key = [];
        $current_key = 0;

        $max = max($cups);
        $min = min($cups);

        for (; $max < 1000000;) {
            $cups[] = ++$max;
        }
        for ($i = 0; $i < $max - 1; $i++) {
            $nextCups_key[$i] = $i + 1;
        }
        $nextCups_key[$max - 1] = 0;
        $cup_key = array_flip($cups);

        for ($i = 0; $i < 10000000; $i++) {
            $pickups_key = [];
            $pickups = [];
            $aux = $current_key;
            for ($j = 0; $j < 3; $j++) {
                $aux = $nextCups_key[$aux];
                $pickups_key[] = $aux;
                $pickups[] = $cups[$aux];
            }
            
            $destination = $cups[$current_key];
            do {
                if (--$destination < $min) {
                    $destination = $max;
                }
            } while (in_array($destination, $pickups));

            $destination_key = $cup_key[$destination];
            $nextCups_key[$current_key] = $nextCups_key[$pickups_key[2]];
            $nextCups_key[$pickups_key[2]] = $nextCups_key[$destination_key];
            $nextCups_key[$destination_key] = $pickups_key[0];
            $current_key = $nextCups_key[$current_key];
        }

        $one = $cup_key[1];
        
        $result = $cups[$nextCups_key[$one]] * $cups[$nextCups_key[$nextCups_key[$one]]];

        return (string)$result;
    }
}
