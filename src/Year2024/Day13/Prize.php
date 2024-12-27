<?php
 
namespace App\Year2024\Day13;
 
final class Prize
{
    public function __construct(
        public int $x,
        public int $y
    ) {
    }

    public function __toString(): string
    {
        return sprintf('(%d,%d)', $this->x, $this->y);
    }
}
