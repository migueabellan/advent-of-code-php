<?php

namespace App\Year2022\Day05;

final class Crane
{
    public function __construct(
        private array $stacks
    ) {
        foreach ($this->stacks as $k => $_) {
            $this->stacks[$k] = array_reverse($this->stacks[$k]);
        }
    }

    public function move(int $qty, int $from, int $to): void
    {
        for ($i = 0; $i < $qty; $i++) {
            $crate = array_pop($this->stacks[$from]);

            array_push($this->stacks[$to], $crate);
        }
    }

    public function move9001(int $qty, int $from, int $to): void
    {
        $crates = [];
        for ($i = 0; $i < $qty; $i++) {
            $crates[] = array_pop($this->stacks[$from]);
        }
        $crates = array_reverse($crates);

        foreach ($crates as $crate) {
            array_push($this->stacks[$to], $crate);
        }
    }

    public function end(): string
    {
        $top = '';

        foreach ($this->stacks as $k => $_) {
            $top .= end($this->stacks[$k]);
        }

        return $top;
    }
}
