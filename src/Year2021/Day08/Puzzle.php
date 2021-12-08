<?php

namespace App\Year2021\Day08;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $explode = explode('|', $line);
                $array[] = [
                    'pattern' => array_map(function ($el) {
                        $a = str_split($el);
                        sort($a);
                        return implode($a);
                    }, explode(' ', trim($explode[0]))),
                    'output' => array_map(function ($el) {
                        $a = str_split($el);
                        sort($a);
                        return implode($a);
                    }, explode(' ', trim($explode[1])))
                ];
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $outputs = array_reduce($input, function ($carry, $el) {
            return array_merge($carry, $el['output']);
        }, []);

        $uniques = array_filter($outputs, function ($el) {
            return in_array(strlen($el), [2, 3, 4, 7]);
        });

        return (string)count($uniques);
    }

    public function exec2(array $input = []): string
    {
        $result = 0;

        foreach ($input as $entry) {
            $display = new Display($entry['pattern']);
            $digits = '';
            foreach ($entry['output'] as $output) {
                $digit = $display->getNumberBy($output);
                $digits = intval(sprintf('%d%d', $digits, $digit));
            }
            $result += $digits;
        }
        return (string)$result;
    }
}
