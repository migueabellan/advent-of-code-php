<?php

namespace App\Year2022\Day07;

final class Directory
{
    private ?Directory $parent = null;
    private array $directories = [];
    private array $files = [];
    private int $size = 0;

    public function __construct(
        public readonly string $name
    ) {
    }

    public function setParent(Directory $parent): void
    {
        $this->parent = $parent;
        $this->parent->addDirectory($this);
    }

    public function getParent(): ?Directory
    {
        return $this->parent;
    }

    public function addDirectory(Directory $directory): void
    {
        $this->directories[] = $directory;
    }

    public function getDirectories(): array
    {
        return $this->directories;
    }

    public function addFile(File $file): void
    {
        $this->files[] = $file;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function addSize(int $size): void
    {
        $this->size += $size;

        if ($this->parent) {
            $this->parent->addSize($size);
        }
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function sizes(array &$sizes = []): array
    {
        $sizes[$this->name] = $this->size;

        foreach ($this->directories as $directory) {
            $directory->sizes($sizes);
        }

        sort($sizes);

        return $sizes;
    }

    public function print(int $depth = 0): void
    {
        print_r(sprintf("%s %s %s", str_repeat("  ", $depth), $this->__toString(), PHP_EOL));

        foreach ($this->directories as $directory) {
            $directory->print($depth + 1);
        }

        foreach ($this->files as $file) {
            print_r(sprintf("%s %s %s", str_repeat("  ", $depth + 1), $file->__toString(), PHP_EOL));
        }
    }

    public function __toString(): string
    {
        return sprintf('%s (dir, %s)', $this->name, $this->size);
    }
}
