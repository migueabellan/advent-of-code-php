<?php

namespace App\Year2017\Day04;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input as $value) {
            $passphrases = new Passphrases(explode(' ', $value));
            if ($passphrases->getIsValid()) {
                $result++;
            }
        }

        return $result;
    }

    public function exec2(array $input = []): int
    {
        $result = 0;

        foreach ($input as $value) {
            $passphrases = new Passphrases(explode(' ', $value));

            $passphrases->sort();

            if ($passphrases->getIsValid()) {
                $result++;
            }
        }

        return $result;
    }
}
