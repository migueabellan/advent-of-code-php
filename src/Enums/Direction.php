<?php

namespace App\Enums;

// phpcs:disable
enum Direction: string {
    case UP     = 'U';
    case LEFT   = 'L';
    case DOWN   = 'D';
    case RIGHT  = 'R';

    public function turnLeft(): self
    {
        return match ($this) {
            self::UP    => self::RIGHT,
            self::LEFT  => self::UP,
            self::DOWN  => self::LEFT,
            self::RIGHT => self::DOWN
        };
    }

    public function turnRight(): self
    {
        return match ($this) {
            self::UP    => self::LEFT,
            self::LEFT  => self::DOWN,
            self::DOWN  => self::RIGHT,
            self::RIGHT => self::UP
        };
    }
}
// phpcs:enable
