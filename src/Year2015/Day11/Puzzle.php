<?php

namespace App\Year2015\Day11;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    private array $threeLetters = [];

    private function threeLetters(): array
    {
        $alphabet = array_values(range('a', 'z'));

        $array = [];
        for ($i = 0; $i < count($alphabet) - 2; $i++) {
            $array[] = $alphabet[$i] . $alphabet[$i + 1] . $alphabet[$i + 2];
        }

        return $array;
    }

    private function isValid(string $str): bool
    {
        if (preg_match('/([i|o|l]+)/', $str, $matches)) {
            return false;
        }

        if (!preg_match('/(.)\1.*(.)\2/', $str, $matches)) {
            return false;
        }

        $regex = sprintf('/(%s)/', implode('|', $this->threeLetters));
        if (!preg_match($regex, $str, $matches)) {
            return false;
        }

        return true;
    }

    public function exec1(array $input = []): string
    {
        $password = current($input);

        $this->threeLetters = $this->threeLetters();

        do {
            $password++;
        } while (!$this->isValid((string)$password));

        return (string)$password;
    }

    public function exec2(array $input = []): string
    {
        $password = $this->exec1($input);

        do {
            $password++;
        } while (!$this->isValid((string)$password));

        return (string)$password;
    }
}
