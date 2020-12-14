<?php

namespace App\Controller\Day14;

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
                if ($v !== 'X') {
                    $umask[$k] = $v;
                }
            }

            $result[$instruction['memory']] = bindec($umask);
        }

        return (string)array_sum($result);
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        //

        return (string)$result;
    }
}
