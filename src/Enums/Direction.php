<?php

namespace App\Enums;

// phpcs:disable
enum Direction: string {
    case NORTH  = 'NORTH';
    case EAST   = 'EAST';
    case SOUTH  = 'SOUTH';
    case WEST   = 'WEST';

    public function turnLeft(): self
    {
        return match ($this) {
            self::NORTH => self::WEST,
            self::EAST  => self::NORTH,
            self::SOUTH => self::EAST,
            self::WEST  => self::SOUTH
        };
    }

    public function turnRight(): self
    {
        return match ($this) {
            self::NORTH => self::EAST,
            self::EAST  => self::SOUTH,
            self::SOUTH => self::WEST,
            self::WEST  => self::NORTH
        };
    }
}
// phpcs:enable
