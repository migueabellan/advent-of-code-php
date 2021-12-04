<?php

namespace App\Year2021\Day04;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        $row = 0;
        $board = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = trim(str_replace('  ', ' ', $line));
                if ($line !== '') {
                    if (str_contains($line, ',')) {
                        $array['numbers'] = array_map('intval', explode(',', $line));
                    } else {
                        $board[$row] = array_map('intval', explode(' ', $line));
                        $row++;
                    }
                }

                if ($row === 5) {
                    $array['boards'][] = $board;
                    $board = [];
                    $row = 0;
                }
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $bingo = new Bingo($input['boards']);

        foreach ($input['numbers'] as $number) {
            $bingo->play($number);

            $wins = $bingo->win();
            if (count($wins)) {
                return (string)$bingo->calc($number, $wins[0]);
            }
        }

        return (string)'';
    }

    public function exec2(array $input = []): string
    {
        $bingo = new Bingo($input['boards']);

        foreach ($input['numbers'] as $number) {
            $bingo->play($number);

            $wins = $bingo->win();
            if (count($wins) === $bingo->getNumBoards()) {
                $last_board = $bingo->getNumBoards() - 1;
                return (string)$bingo->calc($number, $wins[$last_board]);
            }
        }

        return (string)'';
    }
}
