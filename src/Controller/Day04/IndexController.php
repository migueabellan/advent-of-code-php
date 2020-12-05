<?php

namespace App\Controller\Day04;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            $i = 0;
            while (($line = fgets($file)) !== false) {
                if ($line === "\n") {
                    $i++;
                    continue;
                }

                $fields = explode(' ', trim($line));
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

        $fields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid', /*'cid'*/];

        foreach ($array as $passport) {
            $i = 0;
            foreach ($passport as $key => $value) {
                if (in_array($key, $fields)) {
                    $i++;
                }
            }
            if ($i === 7) {
                $result++;
            }
        }

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;
        foreach ($array as $passport) {
            $i = 0;
            foreach ($passport as $key => $value) {
                $i += $this->valid($key, $value);
            }
            if ($i === 7) {
                $result++;
            }
        }

        return (string)$result;
    }

    public function valid(string $key, string $value): int
    {
        switch ($key) {
            case 'byr':
                if ($value >= 1920 && $value <= 2002) {
                    return 1;
                }
                break;
            case 'iyr':
                if ($value >= 2010 && $value <= 2020) {
                    return 1;
                }
                break;
            case 'eyr':
                if ($value >= 2020 && $value <= 2030) {
                    return 1;
                }
                break;
            case 'hgt':
                if (strpos($value, 'cm') !== false) {
                    $num = explode('cm', $value);
                    if ($num[0] >= 150 && $num[0] <= 193) {
                        return 1;
                    }
                }
                if (strpos($value, 'in') !== false) {
                    $num = explode('in', $value);
                    if ($num[0] >= 59 && $num[0] <= 76) {
                        return 1;
                    }
                }
                break;
            case 'hcl':
                if (strpos($value, '#') !== false) {
                    $hcl = explode('#', $value);
                    if (preg_match('/^[0-9a-f]/', $hcl[1]) && strlen($hcl[1]) === 6) {
                        return 1;
                    }
                }
                break;
            case 'ecl':
                $ecl = ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'];
                if (in_array($value, $ecl)) {
                    return 1;
                }
                break;
            case 'pid':
                if (preg_match('/^[0-9]/', $value) && strlen($value) === 9) {
                    return 1;
                }
                break;
        }

        return 0;
    }
}
