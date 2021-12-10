<?php

namespace App\Year2021\Day10;

class Syntax
{
    private const PARENTESHE_OPEN   = '(';
    private const PARENTESHE_CLOSE  = ')';
    private const BRACKET_OPEN      = '[';
    private const BRACKET_CLOSE     = ']';
    private const CURLY_OPEN        = '{';
    private const CURLY_CLOSE       = '}';
    private const SYMBOL_OPEN       = '<';
    private const SYMBOL_CLOSE      = '>';

    private const OPEN = [
        self::PARENTESHE_OPEN,
        self::BRACKET_OPEN,
        self::CURLY_OPEN,
        self::SYMBOL_OPEN,
    ];

    private const CLOSE = [
        self::PARENTESHE_CLOSE,
        self::BRACKET_CLOSE,
        self::CURLY_CLOSE,
        self::SYMBOL_CLOSE,
    ];

    private const SCORE_CHECKER = [
        self::PARENTESHE_CLOSE  => 3,
        self::BRACKET_CLOSE     => 57,
        self::CURLY_CLOSE       => 1197,
        self::SYMBOL_CLOSE      => 25137
    ];

    private const SCORE_MISSING = [
        self::PARENTESHE_OPEN  => 1,
        self::BRACKET_OPEN     => 2,
        self::CURLY_OPEN       => 3,
        self::SYMBOL_OPEN      => 4
    ];

    private array $chunks;

    public function __construct(array $chunks)
    {
        $this->chunks = $chunks;
    }

    public function checker(): int
    {
        $stack = [];

        foreach ($this->chunks as $char) {
            if (in_array($char, self::OPEN)) {
                array_push($stack, $char);
            } elseif (in_array($char, self::CLOSE)) {
                $last = array_pop($stack);
                if (array_search($char, self::CLOSE) !== array_search($last, self::OPEN)) {
                    return self::SCORE_CHECKER[$char];
                }
            }
        }

        return 0;
    }

    public function missing(): int
    {
        $stack = [];

        foreach ($this->chunks as $char) {
            if (in_array($char, self::OPEN)) {
                array_push($stack, $char);
            } elseif (in_array($char, self::CLOSE)) {
                array_pop($stack);
            }
        }

        $stack = array_reverse($stack);

        $score = 0;
        foreach ($stack as $char) {
            $score *=5;
            $score += self::SCORE_MISSING[$char];
        }

        return $score;
    }
}
