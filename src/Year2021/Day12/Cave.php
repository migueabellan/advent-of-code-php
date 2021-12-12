<?php

namespace App\Year2021\Day12;

class Cave
{
    private array $nodes = [];
    private array $paths = [];

    public function __construct()
    {
        $this->nodes = [];
    }

    public function addConnection(Node $n1, Node $n2): self
    {
        if (!isset($this->nodes[$n1->getValue()])) {
            $this->nodes[$n1->getValue()] = $n1;
        }

        $this->nodes[$n1->getValue()]->addChildren($n2);

        if (!isset($this->nodes[$n2->getValue()])) {
            $this->nodes[$n2->getValue()] = $n2;
        }

        $this->nodes[$n2->getValue()]->addChildren($n1);

        return $this;
    }

    public function getPaths(): array
    {
        $this->paths = [];

        $this->setPath($this->nodes[Node::START]);

        return $this->paths;
    }

    private function setPath(Node $node, array $paths = [], array $visited = []): void
    {
        $paths[] = $node->getValue();

        if ($node->getIsEnd()) {
            $this->paths[] = $paths;
            return;
        }

        if ($node->getIsSmall()) {
            $visited[] = $node->getValue();
        }

        $children = array_filter($node->getChildren(), function ($el) use ($visited) {
            return !$el->getIsStart() && !in_array($el->getValue(), $visited);
        });

        foreach ($children as $child) {
            $this->setPath($this->nodes[$child->getValue()], $paths, $visited);
        }
    }


    /**
     * Util print cavern
     */
    public function print(): void
    {
        $WHITE = "\033[1m %s \033[0m";
        $GREEN = "\033[32m %s \033[0m:";

        foreach ($this->nodes as $node) {
            print_r(sprintf($GREEN, $node->__toString()));
            foreach ($node->getChildren() as $children) {
                print_r(sprintf($WHITE, $children->__toString()));
            }
            print_r("\n");
        }
        print_r("\n");
    }
}
