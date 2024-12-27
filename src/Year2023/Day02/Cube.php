<?php
 
namespace App\Year2023\Day02;
 
final class Cube
{
    private const RED = 12;
    private const GREEN = 13;
    private const BLUE = 14;

    private function __construct(
        public int $game,
        public array $rounds
    ) {
    }

    public static function from(string $str): self
    {
        preg_match('/Game (\d+): (.+)/', $str, $matches);
        $id = intval($matches[1]);

        $rounds = [];
        foreach (explode(';', $matches[2]) as $v) {
            preg_match_all('/(\d+) (red|green|blue)/', $v, $matches, PREG_SET_ORDER);
            $color = [
                'red' => 0,
                'green' => 0,
                'blue' => 0,
            ];
            foreach ($matches as $match) {
                $color[$match[2]] = $match[1];
            }

            $rounds[] = $color;
        }

        return new self($id, $rounds);
    }

    public function isPossible(): bool
    {
        foreach ($this->rounds as $round) {
            if ($round['red'] > self::RED || $round['green'] > self::GREEN || $round['blue'] > self::BLUE) {
                return false;
            }
        }

        return true;
    }
}
