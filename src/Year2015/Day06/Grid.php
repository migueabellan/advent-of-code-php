<?php

namespace App\Year2015\Day06;

class Grid
{
    private const ON = 'turn on';
    private const OFF = 'turn off';
    private const TOOGLE = 'toggle';

    private array $grid;
    private int $width;
    private int $height;

    public function __construct(int $width = 1000, int $height = 1000)
    {
        $this->width = $width;
        $this->height = $height;

        for ($i = 0; $i < $this->width; $i++) {
            for ($j = 0; $j < $this->height; $j++) {
                $this->grid[$i][$j] = 0;
            }
        }
    }

    public function setLight(int $x, int $y, string $option): void
    {
        switch ($option) {
            case self::ON:
                $this->grid[$x][$y] = 1;
                break;
            case self::OFF:
                $this->grid[$x][$y] = 0;
                break;
            case self::TOOGLE:
                $this->grid[$x][$y] = !$this->grid[$x][$y];
                break;
        }
    }

    public function getNumLights(): int
    {
        $lights = 0;

        for ($i = 0; $i < $this->width; $i++) {
            for ($j = 0; $j < $this->height; $j++) {
                $lights += $this->grid[$i][$j] ? 1 : 0;
            }
        }

        return $lights;
    }

    public function setBrightness(int $x, int $y, string $option): void
    {
        switch ($option) {
            case self::ON:
                $this->grid[$x][$y]++;
                break;
            case self::OFF:
                if ($this->grid[$x][$y] > 0) {
                    $this->grid[$x][$y]--;
                }
                break;
            case self::TOOGLE:
                $this->grid[$x][$y] += 2;
                break;
        }
    }

    public function getNumBrightness(): int
    {
        $brightness = 0;

        for ($i = 0; $i < $this->width; $i++) {
            for ($j = 0; $j < $this->height; $j++) {
                $brightness += $this->grid[$i][$j];
            }
        }

        return $brightness;
    }
}
