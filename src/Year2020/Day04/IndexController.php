<?php

namespace App\Year2020\Day04;

use App\Puzzle\AbstractPuzzle;

class IndexController extends AbstractPuzzle
{
    private const REGEX = [
        'byr' => '/^(19[2-9][0-9])|(200[0-2])$/',                       // 1920 to 2002
        'iyr' => '/^20(1\d|20)$/',                                      // 2010 to 2020
        'eyr' => '/^20(2\d|30)$/',                                      // 2020 to 2030
        'hgt' => '/^((59|6\d|7[0-6])in)|(((1[5-8]\d)|(19[0-3]))cm)$/',  // 59in to 79in or 150cm to 193cm
        'hcl' => '/^#[0-9abcdef]{6}$/',
        'ecl' => '/^amb|blu|brn|gry|grn|hzl|oth$/',
        'pid' => '/^\d{9}$/'
    ];

    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            $i = 0;
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if (empty($line)) {
                    $i++;
                    continue;
                }

                $fields = explode(' ', $line);
                foreach ($fields as $field) {
                    [$key, $value] = explode(':', $field);
                    if ($key !== '') {
                        $array[$i][$key] = $value;
                    }
                }
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $array = $this->read();

        $result = 0;

        foreach ($array as $passport) {
            foreach (self::REGEX as $key => $regex) {
                if (!isset($passport[$key])) {
                    continue 2;
                }
            }
            $result++;
        }

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        foreach ($array as $passport) {
            foreach (self::REGEX as $key => $regex) {
                if (!isset($passport[$key]) || preg_match($regex, $passport[$key]) !== 1) {
                    continue 2;
                }
            }
            $result++;
        }

        return (string)$result;
    }
}
