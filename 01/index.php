<?php

function read(): array
{
    $array = [];

    if ($file = fopen(getcwd().'/base/_in.txt', 'r')) {
        while(!feof($file)) {
            if ($line = fgets($file)) {
                $array[] = $line;
            }
        }
        fclose($file);
    }

    return $array;
}

function write(array $array): void
{
    $base = dirname(__FILE__);
    $file = fopen($base.'/_out.txt', 'w');

    foreach ($array as $key => $value) {
        fwrite($file, $value);
        if ($key !== count($array) - 1) {
            fwrite($file, "\n");
        }
    }

    fclose($file);
}

// main

$array = read();

$result = [];

for($i = 0; $i < count($array); $i++) {
    for($j = $i + 1; $j < count($array); $j++) {
        for($k = $j + 1; $k < count($array); $k++) {
            if ($array[$i] + $array[$j] + $array[$k] === 2020) {
                $result[] = $array[$i] * $array[$j] * $array[$k];
            }
        }
    }
}

write($result);
