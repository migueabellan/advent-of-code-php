<?php

namespace App\Year2015\Day08;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    private function strReplace(string $str): string
    {
        $str = trim($str, '"');
        $str = preg_replace('#\\\x[0-9a-f]{2}#', '%', $str);
        $str = str_replace('\"', '"', $str);
        $str = str_replace("\\\\", '\\', $str);

        return $str;
    }

    public function exec1(array $input = []): string
    {
        $result = 0;

        foreach ($input as $str) {
            $code = strlen($str);
            $char = strlen($this->strReplace($str));

            $result += ($code - $char);
        }

        return (string)$result;
    }

    public function strEncode(string $str): string
    {
        $str = str_replace('\\', '\\\\', $str);
        $str = str_replace('"', '\"', $str);

        return '"' . $str . '"';
    }

    public function exec2(array $input = []): string
    {
        $result = 0;

        foreach ($input as $str) {
            $encode = strlen($this->strEncode($str));
            $code = strlen($str);

            $result += ($encode - $code);
        }

        return (string)$result;
    }
}
