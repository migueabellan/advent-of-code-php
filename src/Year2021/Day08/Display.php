<?php

namespace App\Year2021\Day08;

class Display
{
    private array $digits;

    public function __construct(array $digits)
    {
        $one = current(array_filter($digits, fn ($el) => count($el) === 2));
        $seven = current(array_filter($digits, fn ($el) => count($el) === 3));
        $four = current(array_filter($digits, fn ($el) => count($el) === 4));
        $eight = current(array_filter($digits, fn ($el) => count($el) === 7));

        $digits_with_five = array_filter($digits, fn ($el) => count($el) === 5);
        $digits_with_six = array_filter($digits, fn ($el) => count($el) === 6);

        $two = [];
        $three = [];
        $five = [];
        foreach ($digits_with_five as $digit) {
            $merge_with_seven = array_unique(array_merge($digit, $seven));
            if (count($merge_with_seven) === 5) {
                $three = $digit;
            } else {
                $merge_with_four = array_unique(array_merge($digit, $four));
                if (count($merge_with_four) === 6) {
                    $five = $digit;
                } elseif (count($merge_with_four) === 7) {
                    $two = $digit;
                }
            }
        }

        $zero = [];
        $six = [];
        $nine = [];
        foreach ($digits_with_six as $digit) {
            $merge_with_four_seven = array_unique(array_merge($digit, $four, $seven));
            if (count($merge_with_four_seven) === 6) {
                $nine = $digit;
            } else {
                $merge_with_five = array_unique(array_merge($digit, $five));
                if (count($merge_with_five) === 6) {
                    $six = $digit;
                } elseif (count($merge_with_five) === 7) {
                    $zero = $digit;
                }
            }
        }

        $this->digits = [
            0 => $zero,
            1 => $one,
            2 => $two,
            3 => $three,
            4 => $four,
            5 => $five,
            6 => $six,
            7 => $seven,
            8 => $eight,
            9 => $nine,
        ];
    }

    public function getNumberBy(array $segments): int
    {
        foreach ($this->digits as $k => $digit) {
            if ($digit === $segments) {
                return $k;
            }
        }

        return 0;
    }
}
