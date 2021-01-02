<?php

namespace App\Year2015\Day05;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private function isValidVowels(string $word): bool
    {
        return preg_match_all('/[aeiou]/', $word) >= 3;
    }

    private function isValidTwice(string $word): bool
    {
        return preg_match('/([a-z])\1+/', $word) !== 0;
    }

    private function isValidNotString(string $word): bool
    {
        return preg_match('/ab|cd|pq|xy/', $word) === 0;
    }

    private function isValid(string $word): bool
    {
        return $this->isValidVowels($word) &&
            $this->isValidTwice($word) &&
            $this->isValidNotString($word);
    }

    public function exec1(array $array = []): string
    {
        $result = 0;
        
        foreach ($array as $word) {
            if ($this->isValid($word)) {
                $result++;
            }
        }

        return (string)$result;
    }

    public function exec2(array $input = []): string
    {
        $result = 0;

        //

        return (string)$result;
    }
}
