<?php
 
namespace App\Year2024\Day13;
 
final class Claw
{
    public function __construct(
        private Button $a,
        private Button $b,
        private Prize $p,
    ) {
    }

    public function cramer(): int
    {
        $x = (($this->p->x * $this->b->y) - ($this->b->x * $this->p->y)) /
            (($this->a->x * $this->b->y) - ($this->b->x * $this->a->y));
        $y = (($this->a->x * $this->p->y) - ($this->p->x * $this->a->y)) /
            (($this->a->x * $this->b->y) - ($this->b->x * $this->a->y));

        if (($x * $this->a->x + $y * $this->b->x === $this->p->x) &&
            ($x * $this->a->y + $y * $this->b->y === $this->p->y)
        ) {
            return $x * 3 + $y * 1;
        }

        return 0;
    }

    /*
    public function min(): int
    {
        $min = PHP_INT_MAX;

        for ($i = 0; $i <= 100; $i++) {
            for ($j = 0; $j <= 100; $j++) {
                if ($this->a->x * $i + $this->b->x * $j === $this->p->x &&
                    $this->a->y * $i + $this->b->y * $j === $this->p->y
                ) {
                    $min = min($min, $i * 3 + $j);
                }
            }
        }

        if ($min === PHP_INT_MAX) {
            return 0;
        }

        return $min;
    }
    */
}
