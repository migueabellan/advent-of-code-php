<?php
 
namespace App\Year2024\Day13;
 
final class Button
{
    public function __construct(
        public int $x,
        public int $y,
        public int $cost
    ) {
    }

    public function __toString(): string
    {
        return sprintf('(%d,%d)', $this->x, $this->y);
    }
}
