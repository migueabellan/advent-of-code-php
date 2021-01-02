<?php

namespace App\Year2015\Day05;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private function hasThreeVowels(string $word): bool
    {
        return preg_match_all('/[aeiou]/', $word) >= 3;
    }

    private function hasDuplicatedLetter(string $word): bool
    {
        return preg_match('/(.)\1/', $word) >= 1;
    }

    private function hasNoBadStrings(string $word): bool
    {
        return preg_match('/ab|cd|pq|xy/', $word) === 0;
    }

    public function exec1(array $array = []): string
    {
        $result = 0;
        
        foreach ($array as $word) {
            if ($this->hasThreeVowels($word) &&
                $this->hasDuplicatedLetter($word) &&
                $this->hasNoBadStrings($word)) {
                $result++;
            }
        }

        return (string)$result;
    }

    private function hasDoublePairLetters(string $word): bool
    {
        return preg_match('/(..).*\1/', $word) >= 1;
    }

    private function hasLettersBetween(string $word): bool
    {
        return preg_match('/(.).\1/', $word) >= 1;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;
        
        foreach ($array as $word) {
            if ($this->hasDoublePairLetters($word) &&
                $this->hasLettersBetween($word)) {
                $result++;
            }
        }

        return (string)$result;
    }
}
