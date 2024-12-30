<?php
 
namespace App\Year2024\Day14;

final class Robot
{
    public function __construct(
        public int $x,
        public int $y,
        public int $vx,
        public int $vy,
    ) {
    }

    public function step(): void
    {
        $this->x += $this->vx;
        $this->y += $this->vy;
    }

    public function __toString(): string
    {
        return sprintf('(%d, %d)', $this->x, $this->y);
    }
}
