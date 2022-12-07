<?php

namespace App\Year2022\Day07;

final class Computer
{
    private ?Directory $root = null;
    private ?Directory $current = null;

    public function __construct(
        public readonly array $history
    ) {
        foreach ($history as $row) {
            if (preg_match('/\$ cd (.*)/', $row, $matches)) {
                $name = $matches[1];

                if ($name === '/') {
                    $this->root = new Directory($name);
                    $this->current = $this->root;
                } elseif ($name === '..') {
                    $this->current = $this->current->getParent();
                } else {
                    $directory =  new Directory($name);
                    $directory->setParent($this->current);
                    $this->current = $directory;
                }
            } elseif (preg_match('/(\d+) ([a-z\.]+)/', $row, $matches)) {
                $file = new File($matches[2], intval($matches[1]));
                $this->current->addFile($file);
                $this->current->addSize($file->size);
            }
        }
    }

    public function getDirectoriesAtMost(int $max_size): array
    {
        $sizes = $this->root->sizes();

        return array_filter($sizes, function (int $size) use ($max_size) {
            return $size <= $max_size;
        });
    }

    public function getSizeToRemove(): int
    {
        $sizes = $this->root->sizes();

        $total = end($sizes);

        $total_disc_available = 70000000;
        $space_for_update = 30000000;

        $unused = $total_disc_available - $total;
        $to_remove = $space_for_update - $unused;

        foreach ($sizes as $size) {
            if ($to_remove <= $size) {
                return $size;
            }
        }

        return 0;
    }

    public function print(): void
    {
        $this->root->print();
    }
}
