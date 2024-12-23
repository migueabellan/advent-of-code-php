<?php
 
namespace App\Year2024\Day08;
 
final class Map
{
    private const ANTINODE = '#';
 
    private array $result;
 
    public function __construct(private array $grid)
    {
        $length = count($grid);
        $this->result = array_fill(0, $length, array_fill(0, $length, '.'));
    }
 
    public function antinodes(int $i, int $j, string $frecuency): void
    {
        $width = count($this->grid);
 
        for ($_i = 0; $_i < $width; $_i++) {
            for ($_j = 0; $_j < $width; $_j++) {
                $p = sprintf('(%d,%d)', $i, $j);
                $_p = sprintf('(%d,%d)', $_i, $_j);
                if ($this->grid[$_i][$_j] === $frecuency && $p !== $_p) {
                    $newi = $_i + ($_i - $i);
                    $newj = $_j + ($_j - $j);
                    if (isset($this->result[$newi][$newj])) {
                        $this->result[$newi][$newj] = self::ANTINODE;
                    }
                }
            }
        }
    }
  
    public function harmonics(int $i, int $j, string $frecuency): void
    {
        $width = count($this->grid);

        for ($_i = 0; $_i < $width; $_i++) {
            for ($_j = 0; $_j < $width; $_j++) {
                $p = sprintf('(%d,%d)', $i, $j);
                $_p = sprintf('(%d,%d)', $_i, $_j);
                if ($this->grid[$_i][$_j] === $frecuency && $p !== $_p) {
                    $iteration = 0;
                    while (true) {
                        $newi = $_i + ($_i - $i) * $iteration;
                        $newj = $_j + ($_j - $j) * $iteration;
                        if (!isset($this->result[$newi][$newj])) {
                            break;
                        }
 
                        $this->result[$newi][$newj] = self::ANTINODE;
                        $iteration++;
                    }
                }
            }
        }
    }
 
    public function result(): int
    {
        $result = 0;
 
        $width = count($this->result);
        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $width; $j++) {
                if ($this->result[$i][$j] === self::ANTINODE) {
                    $result++;
                }
            }
        }
 
        return $result;
    }
 
    public function print(): void
    {
        $WHITE = "\033[1m %s \033[0m";
        $GREEN = "\033[32m %s \033[0m";
 
        for ($i = 0; $i < count($this->result); $i++) {
            for ($j = 0; $j < count($this->result); $j++) {
                if ($this->result[$i][$j] === self::ANTINODE) {
                    if ($this->grid[$i][$j] !== '.') {
                        print_r(sprintf($GREEN, $this->grid[$i][$j]));
                    } else {
                        print_r(sprintf($WHITE, $this->result[$i][$j]));
                    }
                } else {
                    if ($this->grid[$i][$j] !== '.') {
                        print_r(sprintf($WHITE, $this->grid[$i][$j]));
                    } else {
                        print_r(sprintf($WHITE, $this->result[$i][$j]));
                    }
                }
            }
            print_r("\n");
        }
    }
}
