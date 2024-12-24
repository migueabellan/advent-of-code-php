<?php
 
namespace App\Year2024\Day11;
 
final class Plutonian
{
    private array $map = [];

    public function __construct(private array $stones)
    {
        foreach ($this->stones as $stone) {
            $this->map[$stone] = ($this->map[$stone] ?? 0) + 1;
        }
    }

    public function blink(): void
    {
        $aux = [];

        foreach ($this->map as $stone => $count) {
            if ($stone == 0) {
                $aux[1] = ($aux[1] ?? 0) + $count;
            } elseif (mb_strlen($stone) % 2 === 0) {
                /* @phpstan-ignore-next-line */
                $split = array_map('intval', str_split((string)$stone, strlen($stone) / 2));
                $aux[$split[0]] = ($aux[$split[0]] ?? 0) + $count;
                $aux[$split[1]] = ($aux[$split[1]] ?? 0) + $count;
            } else {
                $aux[$stone * 2024] = ($aux[$stone * 2024] ?? 0) + $count;
            }
        }

        $this->map = $aux;
    }

    public function result(): int
    {
        return intval(array_sum($this->map));
    }

    /*
    public function blink(): void
    {
        $stones = [];

        foreach ($this->stones as $item) {
            if ($item === 0) {
                $stones[] = 1;
            } else if (mb_strlen($item) % 2 === 0) {
                $split = str_split((string)$item, mb_strlen($item) / 2);
                $stones[] = intval($split[0]);
                $stones[] = intval($split[1]);
            } else {
                $stones[] = $item * 2024;
            }
        }

        $this->stones = $stones;
    }

    public function result(): int
    {
        return count($this->stones);
    }
    */
}
