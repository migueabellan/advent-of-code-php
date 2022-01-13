<?php

namespace App\Year2016\Day04;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input as $instruction) {
            $room = new Room($instruction);
            
            if ($room->getIsReal()) {
                $result += $room->getId();
            }
        }

        return $result;
    }

    public function exec2(array $input = []): int
    {
        foreach ($input as $instruction) {
            $room = new Room($instruction);
            
            if ($room->getPhrase() === Room::PHRASE) {
                return $room->getId();
            }
        }

        return 0;
    }
}
