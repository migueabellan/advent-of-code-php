<?php

namespace App\Year2021\Day12;

class Node
{
    public const START = 'start';
    public const END = 'end';

    private string $value;
    private bool $is_start;
    private bool $is_end;
    private bool $is_small;

    private array $children = [];

    public function __construct(string $value)
    {
        $this->value = $value;

        $this->is_start = $value === self::START;
        $this->is_end = $value === self::END;
        $this->is_small = ctype_lower($value) && !$this->is_start && !$this->is_end;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getIsStart(): bool
    {
        return $this->is_start;
    }

    public function getIsEnd(): bool
    {
        return $this->is_end;
    }

    public function getIsSmall(): bool
    {
        return $this->is_small;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function addChildren(Node $node): self
    {
        $this->children[] = $node;

        return $this;
    }

    public function __toString()
    {
        return sprintf('%s', $this->value);
    }
}
