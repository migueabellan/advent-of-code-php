<?php

namespace App\Controller\Day23;

use App\Controller\AbstractController;

class IndexController extends AbstractController
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
        $result = 0;

        return (string)$result;
    }
}
