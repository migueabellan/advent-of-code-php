<?php

namespace App\Year2021\Day20;

class Image
{
    private const LIGHT = '#';
    private const DARK  = '.';

    private array $inverted = [
        self::DARK => self::LIGHT,
        self::LIGHT => self::DARK,
    ];

    private const COORDS = [
        [-1, -1], [-1, 0], [-1, 1],
        [ 0, -1], [ 0, 0], [ 0, 1],
        [ 1, -1], [ 1, 0], [ 1, 1],
    ];

    private string $algorithm;
    private array $input;
    private array $output;


    public function __construct(string $algorithm, array $input)
    {
        $this->algorithm = $algorithm;

        $this->input = $input;
    }

    private function getBinaryNumber(int $x, int $y, string $default = self::DARK): int
    {
        $pattern = '';

        foreach (self::COORDS as [$i, $j]) {
            $pattern .= $this->input[$x + $i][$y + $j] ?? $default;
        }

        return (int)bindec(strtr($pattern, self::LIGHT.self::DARK, '10'));
    }

    public function enhancement(int $loop = 1): void
    {
        $default = self::DARK;

        $startX = $startY = 0;
        $width = count($this->input);

        for ($i = 1; $i <= $loop; ++$i) {
            $this->output = [];
            for ($y = $startY - $i; $y < $width + $i; ++$y) {
                for ($x = $startX - $i; $x < $width + $i; ++$x) {
                    $number = $this->getBinaryNumber($y, $x, $default);
                    $this->output[$y][$x] = $this->algorithm[$number];
                }
            }

            if ($default === self::DARK) {
                $default = $this->algorithm[0];
            } else {
                $default = $this->inverted[$this->algorithm[0]];
            }

            $this->input = $this->output;
        }
    }

    public function calc(): int
    {
        $result = 0;

        foreach ($this->output as $row) {
            foreach ($row as $point) {
                if ($point === self::LIGHT) {
                    $result++;
                }
            }
        }

        return $result;
    }

    /**
     * Util print output
     */
    public function print(): void
    {
        $WHITE = "\033[1m %s \033[0m";
        $GREEN = "\033[32m %s \033[0m";

        $rows = count($this->output);

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $rows; $j++) {
                if (isset($this->output[$i][$j]) && $this->output[$i][$j] === self::LIGHT) {
                    print_r(sprintf($GREEN, self::LIGHT));
                } else {
                    print_r(sprintf($WHITE, self::DARK));
                }
            }
            print_r("\n");
        }
        print_r("\n");
    }
}
