<?php
 
namespace App\Year2023\Day03;

use App\Utils\ColorUtil;

final class Engine
{
    private const COORDINATES = [
        [-1, -1], [-1, +0], [-1, 1],
        [+0, -1], ///////// [+0, 1],
        [+1, -1], [+1, +0], [+1, 1],
    ];

    private function __construct(
        private array $schematic,
        private array $numbers
    ) {
    }

    public static function from(array $schematic): self
    {
        $numbers = [];

        foreach ($schematic as $r => $row) {
            preg_match_all('/\d+/', $row, $matches, PREG_OFFSET_CAPTURE);

            foreach ($matches[0] as $match) {
                $number = $match[0];
                $coordinates = [];
                for ($i = 0; $i < strlen($number); $i++) {
                    $coordinates[] = [$r, $match[1] + $i];
                }

                $numbers[] = new Number($number, $coordinates);
            }
        }

        return new self($schematic, $numbers);
    }

    public function adjacents(): int
    {
        $result = 0;

        foreach ($this->numbers as $number) {
            foreach ($number->coordinates as $coord) {
                foreach (self::COORDINATES as $COORDINATE) {
                    $value = $this->schematic[$coord[0] + $COORDINATE[0]][$coord[1] + $COORDINATE[1]] ?? null;
                    if ($value !== null && !is_numeric($value) && $value !== '.') {
                        $result += $number->value;
                        break 2;
                    }
                }
            }
        }

        return $result;
    }

    public function gears(): int
    {
        $result = 0;

        foreach ($this->schematic as $r => $row) {
            foreach (str_split($row) as $c => $value) {
                if ($value === '*') {
                    $gears = [];
                    foreach (self::COORDINATES as $COORDINATE) {
                        foreach ($this->numbers as $number) {
                            foreach ($number->coordinates as $coord) {
                                if ($coord[0] === $r + $COORDINATE[0] &&
                                    $coord[1] === $c + $COORDINATE[1]
                                ) {
                                    $gears[$number->value] = $number->value;
                                    break;
                                }
                            }
                        }
                    }
                    if (count($gears) === 2) {
                        array_reduce($gears, fn ($acc, $el) => $acc*$el, 1);
                        $result += array_reduce($gears, fn ($acc, $el) => $acc*$el, 1);
                    }
                }
            }
        }

        return $result;
    }

    public function print(): void
    {
        foreach ($this->schematic as $row) {
            foreach (str_split($row) as $value) {
                if ($value === '.') {
                    print_r(ColorUtil::grey($value));
                } elseif (is_numeric($value)) {
                    print_r(ColorUtil::green($value));
                } else {
                    print_r(ColorUtil::red($value));
                }
            }
            print_r("\n");
        }
        print_r("\n");
    }
}
