<?php

namespace App\Year2020\Day14;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        $mask = null;
        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                if (strstr($line, 'mask')) {
                    preg_match("~^mask = (?'mask'.*)$~", $line, $matches);

                    $mask = $matches['mask'];
                }
                if (strstr($line, 'mem')) {
                    preg_match("~^mem\[(?'mem'.*)] = (?'decimal'.*)$~", $line, $matches);

                    $array[] = [
                        'mask' => $mask,
                        'memory' => $matches['mem'],
                        'decimal' => $matches['decimal'],
                        'binary' => sprintf('%036s', decbin($matches['decimal'])),
                    ];
                }
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $result = [];

        foreach ($array as $instruction) {
            $umask = $instruction['binary'];
            foreach (str_split($instruction['mask']) as $k => $v) {
                switch ($v) {
                    case '0':
                    case '1':
                        $umask[$k] = $v;
                        break;
                }
            }

            $result[$instruction['memory']] = bindec($umask);
        }

        return (string)array_sum($result);
    }

    public function exec2(array $array = []): string
    {
        $result = [];

        foreach ($array as $instruction) {
            $umemory = strrev(sprintf('%036s', decbin($instruction['memory'])));
            $mask = strrev($instruction['mask']);
            
            $memory = 0;
            $pows = [];
            foreach (str_split($mask) as $k => $v) {
                switch ($v) {
                    case '0':
                        $memory += (int)$umemory[$k] * pow(2, $k);
                        break;
                    case '1':
                        $memory += (int)$v * pow(2, $k);
                        break;
                    case 'X':
                        $pows[] = $k;
                        break;
                }
            }

            for ($i = 0; $i < pow(2, count($pows)); $i++) {
                $aux = $memory;
                $bin = sprintf('%0'.count($pows).'s', decbin($i));
                foreach ($pows as $k => $pow) {
                    $aux += (int)$bin[$k] * pow(2, $pow);
                }
                $result[$aux] = $instruction['decimal'];
            }
        }

        return (string)array_sum($result);
    }
}
