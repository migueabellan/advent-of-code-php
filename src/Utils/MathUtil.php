<?php

namespace App\Utils;

class MathUtil
{
    /**
     * Return divisor
     */
    public static function divisors(int $number): array
    {
        $divisors = [];

        $sqrt = sqrt($number);

        for ($i = 1; $i <= $sqrt; $i++) {
            if ($number % $i === 0) {
                $divisors[] = $i;
                $divisors[] = $number / $i;
            }
        }

        return array_unique($divisors);
    }
}
