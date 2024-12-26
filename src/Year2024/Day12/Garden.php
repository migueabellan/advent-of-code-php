<?php
 
namespace App\Year2024\Day12;
 
final class Garden
{
    private const COORDINATES = [[0, 1], [0, -1], [1, 0], [-1, 0]];

    private array $groups;

    public function __construct(private array $array)
    {
    }

    public function groups(): void
    {
        $length = count($this->array);

        for ($i = 0; $i < $length; $i++) {
            for ($j = 0; $j < $length; $j++) {
                if ($this->array[$i][$j] !== null) {
                    $plant = $this->array[$i][$j];
                    $group = array_fill(0, $length, array_fill(0, $length, null));
                    $this->groups[] = $this->findAdyacents($i, $j, $plant, $group);
                }
            }
        }
    }

    private function findAdyacents(int $i, int $j, string $plant, array &$group = []): array
    {
        $this->array[$i][$j] = null;
        $group[$i][$j] = $plant;

        foreach (self::COORDINATES as $c) {
            $_i = $i + $c[0];
            $_j = $j + $c[1];
            if (isset($this->array[$_i][$_j]) && $this->array[$_i][$_j] === $plant) {
                $this->findAdyacents($_i, $_j, $plant, $group);
            }
        }

        return $group;
    }

    public function price(): int
    {
        $result = 0;
        foreach ($this->groups as &$group) {
            $area = 0;
            $perimeter = 0;
            for ($i = 0; $i < count($group); $i++) {
                for ($j = 0; $j < count($group); $j++) {
                    if ($group[$i][$j] !== null) {
                        $area++;
                        $perimeter += 4;
                        foreach (self::COORDINATES as $c) {
                            $_i = $i + $c[0];
                            $_j = $j + $c[1];
                            if (isset($group[$_i][$_j]) && $group[$_i][$_j] !== null) {
                                $perimeter--;
                            }
                        }
                    }
                }
            }

            $result += ($area * $perimeter);
        }

        return $result;
    }

    public function sides(): int
    {
        $result = 0;
        foreach ($this->groups as &$group) {
            $area = 0;
            $perimeter = 0;
            for ($i = 0; $i < count($group); $i++) {
                for ($j = 0; $j < count($group); $j++) {
                    if ($group[$i][$j] !== null) {
                        $area++;
                        $perimeter += 4;
                        $walls = 4;
                        foreach (self::COORDINATES as $c) {
                            $_i = $i + $c[0];
                            $_j = $j + $c[1];
                            if (isset($group[$_i][$_j]) && $group[$_i][$_j] !== null) {
                                $perimeter--;
                                $walls--;
                            }
                        }
                        $group[$i][$j] = $walls;
                    }
                }
            }

            $result += ($area * $perimeter);
        }

        return $result;
    }

    public function print(): void
    {
        $WHITE = "\033[1m %s \033[0m";
        $GREEN = "\033[32m %s \033[0m";
 
        foreach ($this->groups as $group) {
            for ($i = 0; $i < count($group); $i++) {
                for ($j = 0; $j < count($group); $j++) {
                    if ($group[$i][$j] !== null) {
                        print_r(sprintf($GREEN, $group[$i][$j]));
                    } else {
                        print_r(sprintf($WHITE, '.'));
                    }
                }
                print_r("\n");
            }
            print_r("\n");
        }
    }
}
