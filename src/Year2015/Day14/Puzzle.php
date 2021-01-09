<?php

namespace App\Year2015\Day14;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    private const SECONDS = 2503;

    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match(
                    "/^(?'reinder'.*) can fly (?'speed'.*) km\/s for (?'duration'.*) seconds, but then must rest for (?'rest'.*) seconds.$/", //phpcs:ignore
                    $line,
                    $matches
                );

                $array[$matches['reinder']] = [
                    'speed' => (int)$matches['speed'],
                    'duration' => (int)$matches['duration'],
                    'rest' => (int)$matches['rest'],
                ];
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $distances = [];

        for ($i = 0; $i < self::SECONDS; $i++) {
            foreach ($array as $k => $value) {
                $d = $i % ($value['duration'] + $value['rest']);
                if ($d < $value['duration']) {
                    if (!isset($distances[$k])) {
                        $distances[$k] = 0;
                    }
                    $distances[$k] += $value['speed'];
                }
            }
        }

        return (string)max($distances);
    }

    public function exec2(array $array = []): string
    {
        $distances = [];
        $points = [];

        for ($i = 0; $i < self::SECONDS; $i++) {
            foreach ($array as $k => $value) {
                $d = $i % ($value['duration'] + $value['rest']);
                if ($d < $value['duration']) {
                    if (!isset($distances[$k])) {
                        $distances[$k] = 0;
                    }
                    $distances[$k] += $value['speed'];
                }
            }
          
            foreach ($distances as $k => $v) {
                if ($v === max($distances)) {
                    if (!isset($points[$k])) {
                        $points[$k] = 0;
                    }
                    $points[$k]++;
                }
            }
        }

        return (string)max($points);
    }
}
