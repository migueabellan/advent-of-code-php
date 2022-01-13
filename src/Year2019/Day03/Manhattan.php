<?php

namespace App\Year2019\Day03;

use App\Enums\Direction;

final class Manhattan
{
    public function __construct(
        private array $visited = []
    ) {
    }

    public function move(int $wire, array $instructions): void
    {
        $x = $y = $steps = 0;

        foreach ($instructions as $instruction) {
            for ($i = 0; $i < $instruction['steps']; $i++) {
                switch ($instruction['turn']) {
                    case Direction::UP->value:
                        $y++;
                        break;
                    case Direction::LEFT->value:
                        $x--;
                        break;
                    case Direction::DOWN->value:
                        $y--;
                        break;
                    case Direction::RIGHT->value:
                        $x++;
                        break;
                }

                $this->visited[$wire]["$x,$y"] = ++$steps;
            }
        }
    }

    private function getDistances(): array
    {
        $one = array_keys($this->visited[0]);
        $two = array_keys($this->visited[1]);

        $intersect = array_intersect($one, $two);

        return array_map(function ($el) {
            $coord = array_map('intval', explode(',', (string)$el));
            return [
                'x' => $coord[0],
                'y' => $coord[1],
                'distance' => abs($coord[0]) + abs($coord[1])
            ];
        }, $intersect);
    }

    public function getClosest(): int
    {
        $distance = PHP_INT_MAX;

        foreach ($this->getDistances() as $point) {
            if ($point['distance'] < $distance) {
                $distance = $point['distance'];
            }
        }

        return $distance;
    }

    public function getLowerSteps(): int
    {
        $sum = [];

        foreach ($this->getDistances() as $point) {
            $x = $point['x'];
            $y = $point['y'];
            $sum[] = $this->visited[0]["$x,$y"] + $this->visited[1]["$x,$y"];
        }

        return intval(min($sum));
    }
}
