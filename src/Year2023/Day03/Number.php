<?php
 
namespace App\Year2023\Day03;

final class Number
{
    public function __construct(
        public int $value,
        public array $coordinates
    ) {
    }
}
