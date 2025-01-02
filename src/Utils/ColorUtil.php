<?php

namespace App\Utils;

class ColorUtil
{
    private const GREY = "\033[30m %s \033[0m";
    private const RED = "\033[31m %s \033[0m";
    private const GREEN = "\033[32m %s \033[0m";
    private const YELLOW = "\033[33m %s \033[0m";
    private const BLUE = "\033[34m %s \033[0m";
    private const WHITE = "\033[37m %s \033[0m";

    public static function grey(string $str): string
    {
        return sprintf(self::GREY, $str);
    }

    public static function red(string $str): string
    {
        return sprintf(self::RED, $str);
    }

    public static function green(string $str): string
    {
        return sprintf(self::GREEN, $str);
    }

    public static function yellow(string $str): string
    {
        return sprintf(self::YELLOW, $str);
    }

    public static function blue(string $str): string
    {
        return sprintf(self::BLUE, $str);
    }

    public static function white(string $str): string
    {
        return sprintf(self::WHITE, $str);
    }
}
