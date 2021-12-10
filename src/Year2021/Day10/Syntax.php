<?php

namespace App\Year2021\Day10;

class Syntax
{
    private const STATUS_CORRUPTED  = 1;
    private const STATUS_INCOMPLETE = 2;

    private const CHARS = [
        '(' => ')',
        '[' => ']',
        '{' => '}',
        '<' => '>',
    ];

    private const SCORES = [
        ')' => 3,
        ']' => 57,
        '}' => 1197,
        '>' => 25137,
        '(' => 1,
        '[' => 2,
        '{' => 3,
        '<' => 4,
    ];

    private string $line;
    private int $status = 0;
    private int $score = 0;

    public function __construct(string $line)
    {
        $this->line = $this->optimize($line);

        $checker = $this->checker();
        if (0 !== $checker) {
            $this->status = self::STATUS_CORRUPTED;
            $this->score = $checker;
        } else {
            $this->status = self::STATUS_INCOMPLETE;
            $this->score = $this->missing();
        }
    }

    private function optimize(string $line): string
    {
        $patterns = ['/\(\)/', '/\[\]/', '/\{\}/', '/\<\>/'];

        do {
            $line = preg_replace($patterns, '', $line);

            $exist = false;
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $line, $matches)) {
                    $exist = true;
                    break;
                }
            }
        } while ($exist);

        return $line;
    }

    private function checker(): int
    {
        $score = 0;
        
        for ($i = 0; $i < strlen($this->line); $i++) {
            if (in_array($this->line[$i], self::CHARS)) {
                $score = self::SCORES[$this->line[$i]];
                break;
            }
        }

        return $score;
    }

    private function missing(): int
    {
        $score = 0;

        for ($i = strlen($this->line) - 1; $i >= 0; $i--) {
            $score *= 5;
            $score += self::SCORES[$this->line[$i]];
        }

        return $score;
    }

    public function isCorrupted(): bool
    {
        return $this->status === self::STATUS_CORRUPTED;
    }

    public function isIncomplete(): bool
    {
        return $this->status === self::STATUS_INCOMPLETE;
    }

    public function getScore(): int
    {
        return $this->score;
    }
}
