<?php

namespace App\Year2020\Day09;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private const PREAMBLE = 25;

    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array[] = (int)$line;
            }
            fclose($file);
        }
        
        return $array;
    }

    private function isSumOfTwo(array $array, int $search): bool
    {
        sort($array);

        foreach ($array as $number) {
            $diff = $search - $number;
            if (in_array($diff, $array, true)) {
                return true;
            }
        }

        return false;
    }
    
    public function exec1(array $array = []): string
    {
        $result = 0;

        for ($i = self::PREAMBLE; $i < count($array); $i++) {
            $subset = array_slice($array, $i - self::PREAMBLE, self::PREAMBLE);

            if (!$this->isSumOfTwo($subset, $array[$i])) {
                $result = $array[$i];
                break;
            }
        }

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $invalid_number = (int)$this->exec1($array);

        $result = 0;

        for ($i = 0; $i < count($array); $i++) {
            for ($j = 1; $j < count($array); $j++) {
                $subset = array_slice($array, $i, $j);
                $sum = (int)array_sum($subset);
            
                if ($sum === $invalid_number) {
                    $result = (int)min($subset) + (int)max($subset);
                    break 2;
                }
            
                if ($sum > $invalid_number) {
                    break;
                }
            }
        }

        return (string)$result;
    }
}
