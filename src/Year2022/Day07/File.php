<?php

namespace App\Year2022\Day07;

final class File
{
    public function __construct(
        public readonly string $name,
        public readonly int $size
    ) {
    }

    public function __toString(): string
    {
        return sprintf('%s (file, %d)', $this->name, $this->size);
    }
}
