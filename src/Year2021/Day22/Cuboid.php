<?php

namespace App\Year2021\Day22;

class Cuboid
{
    public const ON = 'on';
    public const OFF = 'off';

    public array $visited;

    public function __construct()
    {
        $this->visited = [];
    }

    public function steps(bool $op, Point $x, Point $y, Point $z): void
    {
        for ($i = $x->getMin(); $i <= $x->getMax(); $i++) {
            for ($j = $y->getMin(); $j <= $y->getMax(); $j++) {
                for ($k = $z->getMin(); $k <= $z->getMax(); $k++) {
                    if (true === $op) {
                        $this->visited[$i.','.$j.','.$k] = true;
                    } else {
                        if (isset($this->visited[$i.','.$j.','.$k])) {
                            unset($this->visited[$i.','.$j.','.$k]);
                        }
                    }
                }
            }
        }
    }

    public function calc(): int
    {
        return count($this->visited);
    }
}
