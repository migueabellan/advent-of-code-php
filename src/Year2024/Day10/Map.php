<?php
 
namespace App\Year2024\Day10;
 
final class Map
{
    private const COORDINATES = [[0, 1], [0, -1], [1, 0], [-1, 0]];

    private int $length = 0;

    public function __construct(private array $array)
    {
        $this->length = count($array);
    }

    private function allRoutes(int $i, int $j, array $acc = [], array &$routes = []): array
    {
        if ($this->array[$i][$j] === 9) {
            $acc[$this->array[$i][$j]] = sprintf('%d,%d', $i, $j);
            $routes[] = $acc;
        }

        foreach (self::COORDINATES as $c) {
            $_i = $i + $c[0];
            $_j = $j + $c[1];
            if ($this->array[$i][$j] + 1 === ($this->array[$_i][$_j] ?? 0)) {
                $acc[$this->array[$i][$j]] = sprintf('%d,%d', $i, $j);
                $this->allRoutes($_i, $_j, $acc, $routes);
            }
        }

        return $routes;
    }

    public function routes(): array
    {
        $routes = [];

        for ($i = 0; $i < $this->length; $i++) {
            for ($j = 0; $j < $this->length; $j++) {
                if ($this->array[$i][$j] === 0) {
                    $all = $this->allRoutes($i, $j);
                    $routes = array_merge($routes, $all);
                }
            }
        }

        return $routes;
    }
}
