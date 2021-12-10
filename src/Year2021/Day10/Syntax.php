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

        $this->line = $line;


        // Corrupted
        for ($i = 0; $i < strlen($this->line); $i++) {
            if (in_array($this->line[$i], self::CHARS)) {
                $this->status = self::STATUS_CORRUPTED;
                $this->score = self::SCORES[$this->line[$i]];
                return;
            }
        }

        
        // Incomplete
        $this->status = self::STATUS_INCOMPLETE;
        $this->score = 0;
        for ($i = strlen($this->line) - 1; $i >= 0; $i--) {
            $this->score = $this->score * 5 + self::SCORES[$this->line[$i]];
        }
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
