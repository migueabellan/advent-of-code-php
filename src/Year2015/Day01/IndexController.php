<?php

namespace App\Year2015\Day01;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private const UP = '(';
    private const DOWN = ')';

    public function exec1(array $input = []): string
    {
        $directions = current($input);

        $up = substr_count($directions, self::UP);
        $down = substr_count($directions, self::DOWN);
        
        return (string)($up - $down);
    }

    public function exec2(array $input = []): string
    {
        $result = 0;

        $directions = str_split(current($input));

        $floor = 0;
        foreach ($directions as $key => $character) {
            switch ($character) {
                case self::UP:
                    $floor++;
                    break;
                case self::DOWN:
                    $floor--;
                    break;
            }

            if (-1 === $floor) {
                $result = $key + 1;
                break;
            }
        }

        return (string)$result;
    }
}
