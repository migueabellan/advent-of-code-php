<?php
 
namespace App\Year2024\Day14;

use App\Utils\MatrixUtil;

final class Restroom
{
    private const WIDE = 101;
    private const TALL = 103;
    private array $map;

    public function __construct(private array $robots)
    {
    }

    public function elapsed(int $seconds): void
    {
        for ($i = 0; $i < $seconds; $i++) {
            foreach ($this->robots as $robot) {
                $robot->step();

                $robot->x = ($robot->x % self::WIDE + self::WIDE) % self::WIDE;
                $robot->y = ($robot->y % self::TALL + self::TALL) % self::TALL;
            }
        }

        $this->map = array_fill(0, self::TALL, array_fill(0, self::WIDE, 0));
        foreach ($this->robots as $robot) {
            $this->map[$robot->y][$robot->x]++;
        }
    }

    public function result(): int
    {
        $this->print($this->map);

        $height = intval(floor(self::TALL / 2));
        $width = intval(floor(self::WIDE / 2));

        $q1 = MatrixUtil::slice($this->map, 0, $height, 0, $width);
        $q2 = MatrixUtil::slice($this->map, 0, $height, $width + 1, self::WIDE);
        $q3 = MatrixUtil::slice($this->map, $height + 1, self::TALL, 0, $width);
        $q4 = MatrixUtil::slice($this->map, $height + 1, self::TALL, $width + 1, self::WIDE);

        return MatrixUtil::sum($q1) *
            MatrixUtil::sum($q2) *
            MatrixUtil::sum($q3) *
            MatrixUtil::sum($q4);
    }

    public function findTree(): bool
    {
        $rows = count($this->map);
        $cols = count($this->map[0]);
        for ($i = 0; $i < $rows / 2; $i++) {
            for ($j = 0; $j < $cols / 2; $j++) {
                // hack
                if ($this->map[$i][$j] === 1 &&
                    $this->map[$i][$j + 1] === 1 &&
                    $this->map[$i][$j + 2] === 1 &&
                    $this->map[$i][$j + 3] === 1 &&
                    $this->map[$i][$j + 4] === 1 &&
                    $this->map[$i][$j + 5] === 1 &&
                    $this->map[$i][$j + 6] === 1 &&
                    $this->map[$i][$j + 7] === 1
                    ) {
                    return true;
                }
            }
        }

        return false;
    }
    
    public function easterEgg(): int
    {
        $seconds = 1;

        while (true) {
            $this->map = array_fill(0, self::TALL, array_fill(0, self::WIDE, 0));
            foreach ($this->robots as $robot) {
                $robot->step();

                $robot->x = ($robot->x % self::WIDE + self::WIDE) % self::WIDE;
                $robot->y = ($robot->y % self::TALL + self::TALL) % self::TALL;

                $this->map[$robot->y][$robot->x]++;
            }

            if ($this->findTree()) {
                $this->print($this->map);
                return $seconds;
            }

            
            $seconds++;
        }
    }

    public function print(array $matrix): void
    {
        $WHITE = "\033[1m%s\033[0m";
        $GREEN = "\033[32m%s\033[0m";

        foreach ($matrix as $row) {
            foreach ($row as $v) {
                if ($v === 0) {
                    print_r(sprintf($WHITE, '.'));
                } else {
                    print_r(sprintf($GREEN, $v));
                }
            }
            print_r("\n");
        }
    }
}
